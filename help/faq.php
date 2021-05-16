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
		<title>Frequently Asked Questions - Maple</title>
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
					<h4 class="my-0 fw-normal text-center">Frequently Asked Questions</h4>
				</div>
				<div class="card-body">
					<h5>Who founded the Maple project?</h5>
					<p>Maple was founded by <b>Maple Syrup</b> and <b>Azuki</b>.</p>
					<h5>When will Maple be released?</h5>
					<p>Maple Lite will be released on June 1, 2021. Release date of Maple Full is TBA.</p>
					<h5>What's the difference between <b>Maple</b> and <b>Maple Lite</b> besides the price?</h5>
					<p>Maple Lite will have limited functionality. It'll only have Relax, Timewarp and Visuals without stream-proof option. For a full list of features refer to our <a href="https://maple.software/#planComparison">comparison table</a>.</p>
					<h5>Is there a way to get Maple before release?</h5>
					<p>No. We understand your impatience, everyone hates waiting, even we do. But understand that for us quality is more important than speed. So please wait patiently while we're doing our best to provide you the smoothest cheating experience in osu!</p>
					<h5>Can I become an early tester?</h5>
					<p>You can't currently. We'll make an announcement if we need testers.</p>
					<h5>Will you need beta testers after release?</h5>
					<p>Definitely!</p>
					<h5>Can I have a trial for Maple before buying it?</h5>
					<p>We do not offer trials.</p>
					<h5>Is Maple undetectable?</h5>
					<p>Like in any other game it's not possible to make an undetectable cheat. Maple can get detected by osu!'s anti-cheat measures at any point in time. However, we're doing our best to prevent this from happening.</p>
					<h5>What will happen if Maple gets detected?</h5>
					<p>We'll update detection status in loader and make an announcement on our discord server. While the fix is being developed, we won't let you to load Maple on bancho and will freeze your subscription. This doesn't apply to those who use Maple on private servers.</p>
					<h5>osu! got an update, can I still use Maple?</h5>
					<p>Maple is developed in a way that it can still be used after most updates. However, if it gets outdated, your subscription will be frozen while we're working on a fix.</p>
					<h5>Can I request a feature or a change?</h5>
					<p>Of course! We love hearing new ideas. Take a look at #suggestions channel on our <a href="https://discord.gg/WNAUYauzrA">discord server</a>.</p>
					<h5>Can I request a refund?</h5>
					<p>You can't, as stated in our <a href="terms-of-service">Terms of Service</a>. Refund can only be issued on admin's decision.</p>
					<h5>My question was not answered!</h5>
					<p>Feel free to join our <a href="https://discord.gg/WNAUYauzrA">discord server</a> and ask your question! We'll reply as soon as possible.</p>
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