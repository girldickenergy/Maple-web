<?php
	require_once "../backend/Database/databaseHandler.php";
	require_once "../backend/Sessions/sessionHandler.php";
	require_once "../backend/Discord/discordHandler.php";
	$currentSession = getSession($dbConn);
	if ($currentSession == null)
	{
		header("Location: ../auth/login");
		die();
	}
	
	$self = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
	$self = $self[0];
	
	$hwidResets = 0;
	$user = getUserById($dbConn, $currentSession["UserID"]);
    if ($user == null)
    {
        header("Location: https://maple.software");
        die();
    }

    if ($user["Permissions"] & perm_banned)
    {
        header("Location: banned");
        die();
    }

    $hwidResets = $user["HWIDResets"];
	
	$ip = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'];
	if ($user != null && $user["LastIP"] != NULL)
	{
		$ip = $user["LastIP"];
	}
	$location = isset($_SERVER["HTTP_CF_IPCOUNTRY"]) ? $_SERVER["HTTP_CF_IPCOUNTRY"] : json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"))->country;

	$discordLinked = $user != null && $user["DiscordID"] != null;
	$discordUsername = "No account linked.";
	if ($discordLinked)
	{
		$discordLinked = true;
		$discordUsername = getUserFullNameFromID($user["DiscordID"]);
	}
	
	$status = "";
	$currentPasswordFailure = false;
	$newPasswordFailure = false;
	$hwidFailure = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (isset($_POST["submit"]))
		{
			$result = changePassword($dbConn, $currentSession["UserID"]);
			if ($result == 0)
			{
				$status = "Your password has been updated.";
			}
			else if ($result == 1)
			{
				$currentPasswordFailure = true;
				$newPasswordFailure = true;
			}
			else if ($result == 2)
			{
				$currentPasswordFailure = true;
			}
			else
			{
				$newPasswordFailure = true;
			}
		}
		else if (isset($_POST["terminateAllSessions"]))
		{
			terminateAllSessions($dbConn, $currentSession["UserID"]);
			$status = "All sessions except this one have been terminated.";
		}
		else if (isset($_POST["resetHWID"]))
		{
			if ($hwidResets > 0)
			{
				if ($user["HWID"] != NULL)
				{
					$hwidResets = $hwidResets - 1;
					setHWID($dbConn, $currentSession["UserID"], NULL);
					setHWIDResets($dbConn, $currentSession["UserID"], $hwidResets);
					$status = "Your HWID has been successfully reset.";
				}
				else
				{
					$hwidFailure = true;
					$status = "Your HWID has already been reset!";
				}
			}
			else
			{
				$hwidFailure = true;
				$status = "You have no HWID resets left!";
			}
		}
		else if (isset($_POST["linkDiscord"]) && $user != null)
		{
			if (!$discordLinked)
			{
				redirectToDiscordOAUTH();
			}
			else
			{
				setDiscordID($dbConn, $currentSession["UserID"], NULL);
				header('Location: ' . $self);
			}
		}
	}
	else if (isset($_GET["code"]) && $user != null && !$discordLinked)
	{
		setDiscordID($dbConn, $currentSession["UserID"], getUserIDFromCode($_GET["code"]));
		header('Location: ' . $self);
	}

	function changePassword($dbConn, $userID)
	{
		$user = getUserById($dbConn, $userID);
		if ($user == null)
		{
			return 1;
		}
		
		if (!password_verify($_POST["currentPassword"], $user["Password"]))
		{
			return 2;
		}
		
		if ($_POST["newPassword"] != $_POST["confirmNewPassword"])
		{
			return 3;
		}
		
		setPassword($dbConn, $userID, $_POST["newPassword"]);
	}
?>

<!DOCTYPE html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/style.css?v=1">
		<link rel="stylesheet" href="../assets/css/dashboard.css?v=1.1">
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="../assets/js/bs-init.js"></script>
		<script src="https://kit.fontawesome.com/d1269851a5.js" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		
		<link rel="icon" href="../assets/favicon.png">
		<title>Account Settings - Maple</title>
	</head>
	<body>
		<nav class="navbar navbar-dark navbar-expand-lg fixed-top">
			<a class="navbar-brand" href="https://maple.software/">
				<img src="../assets/favicon.png" width="30" height="30" class="d-inline-block align-top" alt="">
				Maple
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item">
						<a class="nav-link" href="../dashboard"><i class="fas fa-user"></i> Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="store"><i class="fas fa-shopping-cart"></i> Store</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="fas fa-tools"></i> Settings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="anticheats"><i class="fas fa-shield-alt"></i> Anticheats</a>
					</li>
                    <?php
                    if ($user["Permissions"] & perm_admin)
                        echo '<li class="nav-item"><a class="nav-link" href="adminPanel"><i class="fas fa-tools"></i> Admin Panel</a></li>';
                    ?>
				</ul>
				<span>
					<button type="button" onclick="location.href='../auth/logout';" class="btn btn-outline-primary">Log out</button>
				</span>
			</div>
		</nav>
		
		<div id="content" class="d-flex flex-column justify-content-center align-items-center" data-aos="zoom-in-down" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true">
			<div class="content-header mx-auto text-center">
				<h2>Account Settings</h2>
				<div class="alert alert-<?= $hwidFailure ? "danger" : "success" ?>" role="alert" style="margin-top:20px;" <?= $status == "" ? "hidden" : "" ?>>
					<?= $status ?>
				</div>
			</div>
			<div class="row justify-content-center text-center">
				<div class="col-md-4">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">HWID</h4>
						</div>
						<div class="card-body">
							<p>HWID resets left: <?= $hwidResets ?></p>
							<form action="<?= $self ?>" method="post">
								<button type="submit" name="resetHWID" class="btn btn-outline-primary" <?= $hwidResets == 0 ? "disabled" : "" ?>>Reset HWID</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Security</h4>
						</div>
						<div class="card-body">
							<p>Last log in: <?= $ip ?>, <?= $location ?></p>
							<form action="<?= $self ?>" method="post">
								<button type="submit" name="terminateAllSessions" class="btn btn-outline-primary">Terminate all sessions</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Discord Integration</h4>
						</div>
						<div class="card-body">
							<p><?=$discordUsername?></p>
							<form action="<?= $self ?>" method="post">
								<button type="submit" name="linkDiscord" class="btn btn-outline-primary"><?= $discordLinked ? "Unlink" : "Link"?></button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Password</h4>
						</div>
						<div class="card-body">
							<form action="<?= $self ?>" method="post">
								<div class="form-group">
									<input type="password" name="currentPassword" placeholder="Current password" class="form-control" required>
								</div>
								<p class='float-left' style='color:tomato' <?= $currentPasswordFailure ? "" : "hidden" ?>>Wrong password!</p>
								<div class="form-group">
									<input type="password" name="newPassword" placeholder="New password" class="form-control" required>
								</div>
								<div class="form-group">
									<input type="password" name="confirmNewPassword" placeholder="Confirm new password" class="form-control" required>
								</div>
								<p class='float-left' style='color:tomato' <?= $newPasswordFailure ? "" : "hidden" ?>>Passwords don't match!</p>
								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-outline-primary w-100">Change password</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<footer class="footer mt-auto">
			<div class="footer-container container d-flex justify-content-between">
				<p class="my-auto">Copyright © 2021 maple.software. All rights reserved.</p>
				<ul class="nav flex-column flex-sm-row">
					<li class="nav-item">
						<a class="nav-link" href="../help/terms-of-service">Terms of Service</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../help/privacy-policy">Privacy Policy</a>
					</li>
				</ul>
			</div>
		</footer>
		<script>
		  AOS.init();
		</script>
	</body>
</html>