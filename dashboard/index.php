<?php
	require_once "../backend/Database/databaseHandler.php";
	require_once "../backend/Sessions/sessionHandler.php";
	$currentSession = getSession($dbConn);
	if ($currentSession == null)
	{
		header("Location: ../auth/login");
		die();
	}
	
	global $dbConn;
	$user = getUserById($dbConn, $currentSession["UserID"]);
	if ($user["IsActivated"] === 0)
	{
		header("Location: ../auth/pendingActivation");
		die();
	}
	
	$username = $user["Username"];
	$uid = $currentSession["UserID"];
	$creationDate = date("F jS, Y", strtotime($user["CreatedAt"]));
	$maplePoints = $user["MaplePoints"];
	
	$mapleLiteExpiresAt = getSubscriptionExpiry($dbConn, $uid, 0);
	$mapleFullExpiresAt = getSubscriptionExpiry($dbConn, $uid, 1);
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
		<title>Dashboard - Maple</title>
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
						<a class="nav-link" href="store"><i class="fas fa-shopping-cart"></i> Store</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="settings"><i class="fas fa-tools"></i> Settings</a>
					</li>
				</ul>
				<span>
					<button type="button" onclick="location.href='../auth/logout';" class="btn btn-outline-primary">Log out</button>
				</span>
			</div>
		</nav>

		<div id="content" class="d-flex flex-column justify-content-center align-items-center" data-aos="zoom-in-down" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true">
			<div class="content-header mx-auto text-center">
				<h2>Welcome back, <?= $username ?></h2>
			</div>
			<div class="row justify-content-center text-center">
				<div class="col-md-2">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">UID</h4>
						</div>
						<div class="card-body">
							<?= $uid ?>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Creation Date</h4>
						</div>
						<div class="card-body">
							<?= $creationDate ?>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Maple Points</h4>
						</div>
						<div class="card-body">
							<?= $maplePoints ?> <a href="store">top up</a>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Subscription Status</h4>
						</div>
						<div class="card-body">
							<img src="../assets/favicon.png" width="30" height="30" class="d-inline-block" alt="">
								Maple Lite: <?= $mapleLiteExpiresAt ?>
							<br>
							<img src="../assets/favicon.png" width="30" height="30" class="d-inline-block" alt="">
								Maple Full: <?= $mapleFullExpiresAt ?>
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