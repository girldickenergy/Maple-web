<?php
	require_once "../backend/Database/databaseHandler.php";
	require_once "../backend/Sessions/sessionHandler.php";
	$currentSession = getSession($dbConn);
	if ($currentSession == null)
	{
		header("Location: ../auth/login");
		die();
	}
	
	$self = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
	$self = $self[0];
	
	$status = "";
	$currentPasswordFailure = false;
	$newPasswordFailure = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
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
	
	$hwidResets = 0;
	$user = getUserById($dbConn, $currentSession["UserID"]);
	if ($user != null)
	{
		$hwidResets = $user["HWIDResets"];
	}
	
	$ip = $_SERVER['REMOTE_ADDR']; //todo: fetch it from db
	$location = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"))->country;
	
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
		<link rel="stylesheet" href="../assets/css/index.css?v=1.4">
		
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
						<a class="nav-link" href="underconstruction"><i class="fas fa-money-bill"></i> Subscriptions</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="fas fa-tools"></i> Account Settings</a>
					</li>
				</ul>
				<span>
					<button type="button" onclick="location.href='../auth/logout';" class="btn btn-outline-primary">Log out</button>
				</span>
			</div>
		</nav>
		
		<div id="about" class="d-flex flex-column justify-content-center align-items-center">
			<div class="alert alert-success" role="alert" style="margin-top:20px;" <?= $status == "" ? "hidden" : "" ?>>
				<?= $status ?>
			</div>
			<div class="row justify-content-center text-center" data-aos="zoom-in-down" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true">
				<div class="col-md-6">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">HWID</h4>
						</div>
						<div class="card-body">
							<p>HWID resets left: <?= $hwidResets ?></p>
							<button type="button" class="btn btn-outline-primary" disabled>Reset HWID</button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Security</h4>
						</div>
						<div class="card-body">
							<p>Last log in: <?= $ip ?>, <?= $location ?></p>
							<button type="button" class="btn btn-outline-primary" disabled>Terminate all sessions</button>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card plan-card mb-4 shadow-sm">
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