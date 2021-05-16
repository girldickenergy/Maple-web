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
		<title>Cookie usage - Maple</title>
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
					session_start();
					$LoggedIn = isset($_SESSION["isLoggedIn"]); 
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
					<h4 class="my-0 fw-normal text-center">Cookie usage</h4>
				</div>
				<div class="card-body">
					<p>This page discusses how cookies are used by this site. If you continue to use this site, you are consenting to our use of cookies.</p>
					<h5>What are cookies?</h5>
					<p>Cookies are small text files stored on your computer by your web browser at the request of a site you're viewing. This allows the site you're viewing to remember things about you, such as your preferences and history or to keep you logged in.</p>
					<p>Cookies may be stored on your computer for a short time (such as only while your browser is open) or for an extended period of time, even years. Cookies not set by this site will not be accessible to us.</p>
					<h5>Our cookie usage</h5>
					<p>This site uses cookies for numerous things, including:</p>
					<ul>
						<li>Registration and maintaining your preferences. This includes ensuring that you can stay logged in and keeping the site in the language or appearance that you requested.</li>
						<li>Analytics. This allows us to determine how people are using the site and improve it.</li>
						<li>Advertising cookies (possibly third-party). If this site displays advertising, cookies may be set by the advertisers to determine who has viewed an ad or similar things. These cookies may be set by third parties, in which case this site has no ability to read or write these cookies.</li>
						<li>Other third-party cookies for things like Facebook or Twitter sharing. These cookies will generally be set by the third-party independently, so this site will have no ability to access them.</li>
					</ul>
					<h5>Standard cookies we set</h5>
					<p>These are the main cookies we set during normal operation of the software.</p>
					<ul>
						<li>
							<b>PHPSESSID</b>
							<ul>
								<li>The PHPSESSID cookie is native to PHP and enables websites to store serialised state data. On this website it is used to establish a user session and to pass state data via a temporary cookie, which is commonly referred to as a session cookie. As the PHPSESSID cookie has no timed expiry, it disappears when the client is closed.</li>
							</ul>
						</li>
					</ul>
					<h5>Additional cookies and those set by third parties</h5>
					<p>Additional cookies may be set during the use of the site to remember information as certain actions are being performed, or remembering certain preferences.</p>
					<p>Other cookies may be set by third party service providers which may provide information such as tracking anonymously which users are visiting the site, or set by content embedded into some pages, such as YouTube or other media service providers.</p>
					<h5>Removing/disabling cookies</h5>
					<p>Managing your cookies and cookie preferences must be done from within your browser's options/preferences. Here is a list of guides on how to do this for popular browser software:</p>
					<ul>
						<li><a href="https://support.microsoft.com/en-gb/help/17442/windows-internet-explorer-delete-manage-cookies">Microsoft Internet Explorer</a></li>
						<li><a href="https://privacy.microsoft.com/en-us/windows-10-microsoft-edge-and-privacy">Microsoft Edge</a></li>
						<li><a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer">Mozilla Firefox</a></li>
						<li><a href="https://support.google.com/chrome/answer/95647?hl=en">Google Chrome</a></li>
						<li><a href="https://support.apple.com/en-gb/guide/safari/manage-cookies-and-website-data-sfri11471/mac">Safari for macOS</a></li>
						<li><a href="https://support.apple.com/en-gb/HT201265">Safari for iOS</a></li>
					</ul>
					<h5>More information about cookies</h5>
					<p>To learn more about cookies, and find more information about blocking certain types of cookies, please visit the <a href="https://ico.org.uk/for-the-public/online/cookies/">ICO website Cookies page</a>.</p>
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