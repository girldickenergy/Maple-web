<?php
	session_start();
	if (isset($_SESSION["isLoggedIn"]))
	{
		header("Location: ../dashboard");
		die();
	}
	
	$self = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
	$self = $self[0];
	
	$status = 0;
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
	{
		$status = login();
		if ($status == 0)
		{
			if (isset($_POST["rememberMe"]))
			{
				$params = session_get_cookie_params();
				setcookie(session_name(), $_COOKIE[session_name()], time() + 60*60*24*30, $params["path"], $params["domain"], true, $params["httponly"]);
			}
			
			header("Location: ../dashboard");
			die();
		}
	}
	
	function login()
	{
		require_once "../backend/Captcha/captcha.php";
		if (!checkCaptchaResponse($_POST["g-recaptcha-response"]))
		{
			return 1;
		}
		
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		require_once '../backend/Database/databaseHandler.php';
		$user = getUserByName($dbConn, $username);

		if ($user == null || !password_verify($password, $user["Password"]))
		{
			return 2;
		}

		$_SESSION["isLoggedIn"] = true;
		$_SESSION["uid"] = $user["ID"];
		
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
		<title>Log in - Maple</title>
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
					<button onclick="location.href='signup'" type="button" class="btn btn-outline-primary">Sign up</button>
				</span>
			</div>
		</nav>
		
		<div id="content" class="d-flex flex-column justify-content-center align-items-center">
			<div class="card plan-card mb-4 shadow-sm">
				<div class="card-header">
					<h4 class="my-0 fw-normal text-center">Log in</h4>
				</div>
				<div class="card-body">
					<form action="<?= $self ?>" method="post">
						<p class="float-center" style="color:tomato" <?= $status == 2 ? "" : "hidden" ?>>Wrong username or password!</p>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" placeholder="Username" class="form-control" required>
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" placeholder="Password" class="form-control" required>
						</div>
						<div class="form-group">
							<p><input type="checkbox" name="rememberMe"> Remember me</p>
						</div>
						<div class="form-group">
							<div class="g-recaptcha" data-sitekey="6Lf7MdYaAAAAAGYJwUeh2Tt7G9USbvvoa9MYDHsh"></div>
						</div>
						<p style="color:tomato" <?= $status == 1 ? "" : "hidden" ?>>We were unable to verify that you are human.</p>
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-outline-primary w-100">Log in</button>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center">
						<p>Don't have an account? <a href="signup">Sign Up</a></p>
					</div>
					<div class="d-flex justify-content-center">
						<a href="forgotPassword">Forgot your password?</a>
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