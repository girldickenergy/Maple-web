<?php
	session_start();
	if (isset($_SESSION["isLoggedIn"]))
	{
		header("Location: dashboard");
		die();
	}
	
	$self = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
	$self = $self[0];
	
	$status = 0;
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
	{
		$status = signup();
		if ($status == 0)
		{
			header("Location: pendingActivation");
			die();
		}
	}
	
	function signup()
	{
		require_once '../backend/Captcha/captcha.php';
		if (!checkCaptchaResponse($_POST["g-recaptcha-response"]))
		{
			return 1;
		}
		
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$confirmPassword = $_POST["confirmPassword"];
		
		if (empty($username) || empty($email) || empty($password) || empty($confirmPassword))
		{
			return 2;
		}
		
		if (!preg_match("/^[a-zA-Z0-9- ]*$/", $username) || strlen($username) > 24 || strlen($username) < 3)
		{
			return 3;
		}
		
		require_once '../backend/Database/databaseHandler.php';
		
		if (isUsernameTaken($dbConn, $username))
		{
			return 4;
		}
		
		if (isEmailInUse($dbConn, $email))
		{
			return 5;
		}
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			return 6;
		}
		
		if ($password !== $confirmPassword)
		{
			return 7;
		}
		
		$uniqueHash = md5(rand(0,1000));
		if (!addUser($dbConn, $username, $email, $password, $uniqueHash))
		{
			return 8;
		}
		
		require_once '../backend/Mail/mailer.php';
		sendEmailConfirmation($username, $email, $uniqueHash);
		
		$_SESSION["isLoggedIn"] = true;
		$uid = getUserByName($dbConn, $username)["ID"];
		$_SESSION["uid"] = $uid;
		
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
		<link rel="stylesheet" href="../assets/css/login.css?v=1.3">
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/d1269851a5.js" crossorigin="anonymous"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		
		<link rel="icon" href="../assets/favicon.png">
		<title>Sign up - Maple</title>
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
					<button onclick="location.href='login.php'" type="button" class="btn btn-outline-primary">Log in</button>
				</span>
			</div>
		</nav>
		
		<div id="content" class="d-flex flex-column justify-content-center align-items-center">
			<div class="card plan-card mb-4 shadow-sm">
				<div class="card-header">
					<h4 class="my-0 fw-normal text-center">Sign up</h4>
				</div>
				<div class="card-body">
					<form action="<?= $self ?>" method="post">
						<p style="color:tomato" <?= $status == 2 || $status == 8 ? "" : "hidden" ?>><?= $status == 2 ? "Please provide valid input." : "Unknown error occured!"?></p>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" placeholder="Username" class="form-control" required>
						</div>
						<p style="color:tomato" <?= $status == 3 || $status == 4 ? "" : "hidden" ?>><?= $status == 3 ? "Username is invalid!" : "This username is already in use!"?></p>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="text" name="email" placeholder="Email address" class="form-control" required>
						</div>
						<p style="color:tomato" <?= $status == 5 || $status == 6 ? "" : "hidden" ?>><?= $status == 5 ? "This email is already in use!" : "Email is invalid!"?></p>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" placeholder="Password" class="form-control" required>
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-redo-alt"></i></span>
							</div>
							<input type="password" name="confirmPassword" placeholder="Confirm password" class="form-control" required>
						</div>
						<p style="color:tomato" <?= $status == 7 ? "" : "hidden" ?>>Passwords don't match!</p>
						<p><input type="checkbox" required> I agree to the <a href="../help/terms-of-service">Terms of Service</a></p>
						<div class="form-group">
							<div class="g-recaptcha" data-sitekey="6Lf7MdYaAAAAAGYJwUeh2Tt7G9USbvvoa9MYDHsh"></div>
							<p style="color:tomato" <?= $status == 1 ? "" : "hidden" ?>>We were unable to verify that you are human.</p>
						</div>
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-outline-primary w-100">Sign up</button>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center">
						<p>Already have an account? <a href="login">Log in</a></p>
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
	</body>
</html>