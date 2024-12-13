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
		<title>Terms of Service - Maple</title>
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
		
		<div id="content" class="d-flex flex-column justify-content-center align-items-center">
			<div class="card plan-card mb-4 shadow-sm">
				<div class="card-header">
					<h4 class="my-0 fw-normal text-center">Terms of Service</h4>
				</div>
				<div class="card-body">
					<p>By accessing this web site, you are agreeing to be bound by this site’s Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site’s content. This web site is only available to users who are at least 13 years old. If you are younger than this, please do not register for this site. If you register for this site, you represent that you are this age or older. Materials contained in this site are protected by applicable copyright and trade mark law.</p>
					<h5>Use License</h5>
					<p>Permission is granted to temporarily download one copy of the materials (information or software) on this web site for personal, noncommercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not</p>
					<ul>
						<li>Modify or copy the materials.</li>
						<li>Use the materials for any commercial purpose or for any public display (commercial or noncommercial).</li>
						<li>Use our services if you, or someone you are in connection with, are associated with anti-cheat development.</li>
						<li>Attempt to decompile or reverse engineer any software contained on this web site.</li>
						<li>Remove any copyright or other proprietary notations from the materials.</li>
						<li>Transfer the materials to another person or “mirror” the materials on any other server.</li>
					</ul>
					<p>Each copy of the materials is private for the user that acquires it. In case that we find a borrowed/stolen copy, we will invalidate that copy for future updates.</p>
					<p>This license shall automatically terminate if you violate any of these restrictions and may be terminated by the operator of this web site at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession, whether in electronic or print format.</p>
					<h5>Disclaimer</h5>
					<p>The materials on this web site are provided “as is.” The author of the site makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular use, or non-infringement of intellectual property or other violation of rights. Further, the site’s maintainer does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on this Internet web site or otherwise relating to such materials or on any sites linked to this site.</p>
					<p>We reserve the right to completely block your access to our services without giving any reason.</p>
					<p>These terms may be changed at any time without notice.</p>
					<h5>Refund Policy</h5>
					<p>Purchases are non-refundable.</p>
					<p>If you believe your situation warrants an exception, you can contact us on our <a href="https://discord.gg/WNAUYauzrA">discord server</a>.</p>
				</div>
			</div>
		</div>
		
		<footer class="footer mt-auto">
			<div class="footer-container container d-flex justify-content-between">
				<p class="my-auto">Copyright © 2021 maple.software. All rights reserved.</p>
				<ul class="nav flex-column flex-sm-row">
					<li class="nav-item">
						<a class="nav-link" href="terms-of-service">Terms of Service</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="privacy-policy">Privacy Policy</a>
					</li>
				</ul>
			</div>
		</footer>
	</body>
</html>