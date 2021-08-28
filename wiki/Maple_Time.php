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
		<title>Maple Time - Maple</title>
	</head>

	<style type="text/css">
		.mapleTimeTable {
		border-collapse: collapse;
		border-spacing: 0;
		margin-bottom: 30px;
		width: 75%;
		border: 1px solid #262626;
		color: #CCCCCC;
		}

		.mapleTimeTable th {
			color: #E85D9B !important;
		}

		.mapleTimeTable th, td {
			text-align: center;
			padding: 16px;
		}

		.mapleTimeTable th:first-child, td:first-child {
			text-align: left;
		}

		.mapleTimeTable tr:nth-child(even) {
			background-color: #262626
		}

		.mapleTimeTable tr:nth-child(odd) {
			background-color: #333333
		}
	</style>

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
				<?php
					require_once "../backend/Database/databaseHandler.php";
					require_once "../backend/Sessions/sessionHandler.php";
					$LoggedIn = getSession($dbConn) != null;
				?>
				<span>
					<button type="button" onclick="location.href='<?= $LoggedIn ? "../dashboard" : "../auth/login" ?>';" class="btn btn-outline-primary"><?= $LoggedIn ? "Dashboard" : "Log in" ?></button>
					<button type="button" onclick="location.href='<?= $LoggedIn ? "../auth/logout" : "../auth/signup" ?>';" class="btn btn-outline-primary"><?= $LoggedIn ? "Log out" : "Sign up" ?></button>
				</span>
			</div>
		</nav>
		
		<div id="content" class="d-flex flex-column justify-content-center align-items-center" data-aos="zoom-in-down" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true">
			<div class="content-header mx-auto text-center">
				<h2>Maple Time</h2>
			</div>
			<table class="mapleTimeTable" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<tr>
					<th style="width:50%">Maple Time</th>
					<th>Actual Time</th>
					<th>Item</th>
				</tr>
				<tr>
					<td>Late february/late march</td>
					<td>June 1, 2021</td>
					<td>Maple ETA</td>
				</tr>
				<tr>
					<td>Late april/late may</td>
					<td>June 1, 2021</td>
					<td>Maple ETA</td>
				</tr>
				<tr>
					<td>This spring</td>
					<td>June 1, 2021</td>
					<td>Maple ETA</td>
				</tr>
				<tr>
					<td>Maple Lite will be delayed for one week</td>
					<td>2 months</td>
					<td>Maple Lite delay</td>
				</tr>
				<tr>
					<td>This delay won't be <b>too</b> long</td>
					<td>2 months</td>
					<td>Maple Lite delay</td>
				</tr>
				<tr>
					<td>I'll add a week or two to every active subscription</td>
					<td>3 months</td>
					<td>Delay compensation</td>
				</tr>
				<tr>
					<td>In the next few days</td>
					<td>2 months and counting</td>
					<td>More payment methods</td>
				</tr>
				<tr>
					<td>In the next three days</td>
					<td>4 days</td>
					<td>Maple Lite ETA</td>
				</tr>
			</table>
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