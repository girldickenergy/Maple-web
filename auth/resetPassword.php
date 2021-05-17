<?php
	$failed = false;
	session_start();
	if (isset($_SESSION["isLoggedIn"]))
	{
		header("Location: https://maple.software/");
		die();
	}
	
	$hashFailure = false;
	$passwordFailure = false;
	$attemptedToReset = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
	{
		require_once "../backend/Database/databaseHandler.php";
		$result = resetPassword($dbConn);
		if ($result == 1)
		{
			$hashFailure = true;
		}
		else if ($result == 2)
		{
			$passwordFailure = true;
		}
		$attemptedToReset = true;
	}
	else if (isset($_GET["hash"]) && !empty($_GET["hash"]))
	{
		require_once "../backend/Database/databaseHandler.php";
		$user = getUserByUniqueHash($dbConn, $_GET["hash"]);
		if ($user == null)
		{
			$hashFailure = true;
		}
	}
	
	function resetPassword($dbConn)
	{
		$user = getUserByUniqueHash($dbConn, $_GET["hash"]);
		if ($user == null)
		{
			return 1;
		}
		
		if ($_POST["password"] != $_POST["confirmPassword"])
		{
			return 2;
		}

		setPassword($dbConn, $user["ID"], $_POST["password"]);
		setUniqueHash($dbConn, $user["ID"], NULL);

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
		<title>Password recovery - Maple</title>
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
					<button type="button" onclick="location.href='login';" class="btn btn-outline-primary">Log in</button>
					<button type="button" onclick="location.href='signup';" class="btn btn-outline-primary">Sign up</button>
				</span>
			</div>
		</nav>
		
		<div id="content" class="d-flex flex-column justify-content-center align-items-center">
			<div class="card plan-card mb-4 shadow-sm">
				<div class="card-header">
					<h4 class="my-0 fw-normal text-center">Account activation</h4>
				</div>
				<div class="card-body justify-content-center text-center">
					<?php
						
						if (!$hashFailure && !$passwordFailure && $attemptedToReset)
						{
							echo("<p>Your password has been successfully reset!</p>
							<p>You can now <a href='login'>log into your account</a>.</p>");
						}
						else if ($hashFailure)
						{
							echo("<p>Sorry, we couldn't find a pending password reset request.</p>
							<p>Make sure you're following a valid link and try again.</p>");
						}
						else
						{
							echo("<form action='{$self}?hash={$_GET['hash']}' method='post'>
								<p>Enter new password.</p>
								<div class='input-group form-group'>
									<input type='password' name='password' placeholder='Password' class='form-control' required>
								</div>
								<div class='input-group form-group'>
									<input type='password' name='confirmPassword' placeholder='Confirm password' class='form-control' required>
								</div>");
								
							if ($passwordFailure)
							{
								echo("<p class='float-left' style='color:tomato'>Passwords don't match!</p>");
							}
							
							echo("<div class='form-group'>
									<button type='submit' name='submit' class='btn btn-outline-primary w-100'>Reset password</button>
								</div>
							</form>");
						}
					?>
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