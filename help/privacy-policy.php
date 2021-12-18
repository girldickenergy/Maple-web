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
		<title>Privacy Policy - Maple</title>
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
						<a class="nav-link" href="../discord"><i class="fab fa-discord"></i> Community</a>
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
					<h4 class="my-0 fw-normal text-center">Privacy Policy</h4>
				</div>
				<div class="card-body">
					<p>We are Maple ("we", "our", "us"). We’re committed to protecting and respecting your privacy. If you have questions about your personal information please <a href="contact-us">contact us</a>.</p>
					<h5>What information we hold about you</h5>
					<p>The type of data that we collect and process includes:</p>
					<ul>
						<li>Your name or username.</li>
						<li>Your email address.</li>
						<li>Your IP address.</li>
					</ul>
					<p>We collect some or all of this information in the following cases:</p>
					<ul>
						<li>You register as a member on this site.</li>
						<li>You browse this site. See "Cookie policy" below.</li>
						<li>You fill out fields on your profile.</li>
					</ul>
					<h5>How your personal information is used</h5>
					<p>We may use your personal information in the following ways:</p>
					<ul>
						<li>For the purposes of making you a registered member of our site.</li>
						<li>We may use your email address to inform you of activity on our site.</li>
						<li>Your IP address is recorded when you perform certain actions on our site. Your IP address is never publicly visible.</li>
					</ul>
					<h5>Other ways we may use your personal information.</h5>
					<p>In addition to notifying you of activity on our site which may be relevant to you, from time to time we may wish to communicate with all members any important information such as newsletters or announcements by email. You can opt-in to or opt-out of such emails in your profile.</p>
					<p>We may collect non-personally identifiable information about you in the course of your interaction with our site. This information may include technical information about the browser or type of device you're using. This information will be used purely for the purposes of analytics and tracking the number of visitors to our site.</p>
					<h5>Keeping your data secure</h5>
					<p>We are committed to ensuring that any information you provide to us is secure. In order to prevent unauthorized access or disclosure, we have put in place suitable measures and procedures to safeguard and secure the information that we collect.</p>
					<h5>Cookie policy</h5>
					<p>Cookies are small text files which are set by us on your computer which allow us to provide certain functionality on our site, such as being able to log in, or remembering certain preferences.</p>
					<p>We have a detailed cookie policy and more information about the cookies that we set on <a href="cookie-usage">this page</a>.</p>
					<h5>Rights</h5>
					<p>You have a right to access the personal data we hold about you or obtain a copy of it. To do so please <a href="contact-us">contact us</a>. If you believe that the information we hold for you is incomplete or inaccurate, you may <a href="contact-us">contact us</a> to ask us to complete or correct that information.</p>
					<p>You also have the right to request the erasure of your personal data. Please <a href="contact-us">contact us</a> if you would like us to remove your personal data.</p>
					<h5>Acceptance of this policy</h5>
					<p>Continued use of our site signifies your acceptance of this policy. If you do not accept the policy then please do not use this site. When registering we will further request your explicit acceptance of the privacy policy.</p>
					<h5>Changes to this policy</h5>
					<p>We may make changes to this policy at any time. You may be asked to review and re-accept the information in this policy if it changes in the future.</p>
					<h5>CAPTCHA Policy</h5>
					<p>This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">privacy policy</a> and <a href="https://policies.google.com/terms">terms of service</a> apply.</p>
				</div>
			</div>
		</div>
		
		<footer class="footer mt-auto">
			<div class="footer-container container d-flex justify-content-between">
				<p class="my-auto">Copyright © 2021 maple.software. All rights reserved.</p>
				<ul class="nav flex-column flex-sm-row">
					<li class="nav-item">
						<a class="nav-link" href="contact-us">Contact Us</a>
					</li>
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