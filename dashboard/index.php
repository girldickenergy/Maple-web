<?php
	session_start();
	if (!isset($_SESSION["isLoggedIn"]))
	{
		header("Location: ../auth/login");
		die();
	}
	
	include_once "../backend/Database/databaseHandler.php";
	global $dbConn;
	$user = getUserById($dbConn, $_SESSION["uid"]);
	if ($user["IsActivated"] === 0)
	{
		header("Location: ../auth/pendingActivation");
		die();
	}
	
	$username = $user["Username"];
	$uid = $_SESSION["uid"];
	$creationDate = date("F jS, Y", strtotime($user["CreatedAt"]));
	
	$mapleLiteExpiresAt = "Not subscribed";
	if ($user["MapleLiteExpiresAt"] != null)
	{
		if (date("Y", strtotime($user["MapleLiteExpiresAt"])) == 2038)
		{
			$mapleLiteExpiresAt = "Lifetime";
		}
		else
		{
			$mapleLiteExpiresAt = "Until ".date("F jS, Y", strtotime($user["MapleLiteExpiresAt"]));
		}
	}
	
	$mapleFullExpiresAt = "Not subscribed";
	if ($user["MapleFullExpiresAt"] != null)
	{
		if (date("Y", strtotime($user["MapleFullExpiresAt"])) == 2038)
		{
			$mapleFullExpiresAt = "Lifetime";
		}
		else
		{
			$mapleFullExpiresAt = "Until ".date("F jS, Y", strtotime($user["MapleFullExpiresAt"]));
		}
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
		<title>Dashboard - Maple</title>
		
		<style>
		#profileData {
			padding-left: 15px;
			padding-right: 15px;
			margin-left: auto;
			margin-right: auto;
			min-height: 100vh;
			max-height: 100%;
			padding-top: 50px;
		}
		</style>
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
						<a class="nav-link" href="#"><i class="fas fa-user"></i> Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="underconstruction"><i class="fas fa-money-bill"></i> Subscriptions</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="underconstruction"><i class="fas fa-tools"></i> Account Settings</a>
					</li>
				</ul>
				<span>
					<button type="button" onclick="location.href='../auth/logout';" class="btn btn-outline-primary">Log out</button>
				</span>
			</div>
		</nav>

		<div id="profileData" class="d-flex flex-column justify-content-center">
			<div class="row text-center justify-content-center" data-aos="zoom-in-down" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true">
				<div class="col-md-3">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Username</h4>
						</div>
						<div class="card-body">
							<h6><?= $username ?></h6>
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">UID</h4>
						</div>
						<div class="card-body">
							<h6><?= $uid ?></h6>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Creation Date</h4>
						</div>
						<div class="card-body">
							<h6><?= $creationDate ?></h6>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Subscription Status</h4>
						</div>
						<div class="card-body">
							<h6><img src="../assets/favicon.png" width="30" height="30" class="d-inline-block" alt="">
								Maple Lite: <?= $mapleLiteExpiresAt ?></h6>
							<h6><img src="../assets/favicon.png" width="30" height="30" class="d-inline-block" alt="">
								Maple Full: <?= $mapleFullExpiresAt ?></h6>
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