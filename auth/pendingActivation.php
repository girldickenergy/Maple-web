<?php
	require_once "../backend/Database/databaseHandler.php";
	require_once "../backend/Sessions/sessionHandler.php";
	$currentSession = getSession($dbConn);
	if ($currentSession != null)
	{
		$user = getUserById($dbConn, $currentSession["UserID"]);
		if ($user == null || $user["Permissions"] & perm_activated)
		{
			header("Location: https://maple.software/");
			die();
		}
		
		$email = $user["Email"];
	}
	else
	{
		header("Location: https://maple.software/");
		die();
	}
	
	$self = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
	$self = $self[0];
	
	$status = "";
	$failed = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
	{
		$result = resendEmail($dbConn, $currentSession["UserID"]);
		if ($result != 0)
		{
			$failed = true;
		}
		
		switch ($result)
		{
			case 0:
				$status = "Email has been resent!";
				break;
			case 1:
				$status = "This email is already in use!";
				break;
			case 2:
				$status = "Email is invalid!";
				break;
			default:
				$status = "Unknown error occured!";
				break;
		}
	}
	
	function resendEmail($dbConn, $userID)
	{
		$user = getUserById($dbConn, $userID);
		if ($user == null)
		{
			return 3;
		}
		$email = $_POST["email"];

		if ($user["Email"] !== $email && isEmailInUse($dbConn, $email))
		{
			return 1;
		}

		if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return 2;
		}

		require_once "../backend/Mail/mailer.php";
		$uniqueHash = md5(rand(0,1000));
		if (!setUniqueHash($dbConn, $userID, $uniqueHash))
		{
			return 3;
		}
		if (!setEmail($dbConn, $userID, $email))
		{
			return 3;
		}
		sendEmailConfirmation($user["Username"], $email, $uniqueHash);

		return 0;
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
		<link rel="stylesheet" href="../assets/css/style.css?v=1">
		<link rel="stylesheet" href="../assets/css/card-page.css?v=1">
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/d1269851a5.js" crossorigin="anonymous"></script>
		
		<link rel="icon" href="../assets/favicon.png">
		<title>Pending activation - Maple</title>
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
						<a class="nav-link" href="https://maple.software/">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://trello.com/b/0fq4vhxu/to-do-list"><i class="fab fa-trello"></i> Trello</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://discord.gg/WNAUYauzrA"><i class="fab fa-discord"></i> Community</a>
					</li>
				</ul>
				<span>
					<button type="button" onclick="location.href='logout';" class="btn btn-outline-primary">Log out</button>
				</span>
			</div>
		</nav>
		
		<div id="content" class="d-flex flex-column justify-content-center align-items-center">
			<div class="card plan-card mb-4 shadow-sm">
				<div class="card-header">
					<h4 class="my-0 fw-normal text-center">Account pending activation</h4>
				</div>
				<div class="card-body justify-content-center text-center">
					<p>Your account has been created!</p>
					<p>Please verify it by clicking the activation link that has been send to your email.</p>
					<p>If you're having trouble with receiving the link, you can request another activation email at any time.</p>
					<form action="<?= $self ?>" method="post">
						<div class="input-group form-group">
							<input type="text" name="email" placeholder="Email" value="<?= $email ?>" class="form-control" required>
						</div>
						<small class="float-left" style="color:<?= $failed ? "tomato" : "springgreen" ?>" <?= empty($status) ? "hidden" : "" ?>><?= $status ?></small>
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-outline-primary w-100">Resend</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<footer class="footer mt-auto">
			<div class="footer-container container d-flex justify-content-between">
				<p class="my-auto">Copyright © 2021 maple.software. All rights reserved.</p>
				<ul class="nav flex-column flex-sm-row">
					<li class="nav-item">
						<a class="nav-link" href="../help/contact-us">Contact Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../help/terms-of-service">Terms of Service</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../help/privacy-policy">Privacy Policy</a>
					</li>
				</ul>
			</div>
		</footer>
	</body>
</html>