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
		<link rel="stylesheet" href="assets/css/style.css?v=1">
		<link rel="stylesheet" href="assets/css/index.css?v=1.4">
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="assets/js/bs-init.js"></script>
		<script src="https://kit.fontawesome.com/d1269851a5.js" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		
		<link rel="icon" href="assets/favicon.png">
		<title>Home - Maple</title>
	</head>
	<body>
		<nav class="navbar navbar-dark navbar-expand-lg fixed-top">
			<a class="navbar-brand" href="#">
				<img src="assets/favicon.png" width="30" height="30" class="d-inline-block align-top" alt="">
				Maple
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item">
						<a class="nav-link" href="#about">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#features">Features</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#pricing">Pricing</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="help/faq">FAQ</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://trello.com/b/0fq4vhxu/to-do-list"><i class="fab fa-trello"></i> Trello</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="https://discord.gg/WNAUYauzrA"><i class="fab fa-discord"></i> Community</a>
					</li>
				</ul>
				<span>
					<?php
						require_once "backend/Database/databaseHandler.php";
						require_once "backend/Sessions/sessionHandler.php";
						$LoggedIn = getSession($dbConn) != null;
					?>
					<button type="button" onclick="location.href='<?= $LoggedIn ? "../dashboard" : "../auth/login" ?>';" class="btn btn-outline-primary"><?= $LoggedIn ? "Dashboard" : "Log in" ?></button>
					<button type="button" onclick="location.href='<?= $LoggedIn ? "../auth/logout" : "../auth/signup" ?>';" class="btn btn-outline-primary"><?= $LoggedIn ? "Log out" : "Sign up" ?></button>
				</span>
			</div>
		</nav>
		
		<div id="main" class="d-flex flex-column justify-content-center align-items-center">
			<h1>Maple</h1>
			<p>the quickest way to the top</p>
		</div>
		<div id="about" class="d-flex flex-column justify-content-center align-items-center">
			<div class="section-header mx-auto text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<h2>About</h2>
				<p>Maple is a project aimed at providing the best legit cheating experience in osu!<br><br>Start your journey to the top today with our undetected cheat!</p>
			</div>
			<span data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
			<button type="button" class="btn btn-outline-primary" disabled>Get Maple</button>
			</span>
		</div>
		<div id="features" class="d-flex flex-column justify-content-center align-items-center">
			<div class="section-header mx-auto text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<h2>Features</h2>
				<p>Maple provides handful of features such as...</p> 
			</div>
			<div class="container maple-features" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<div class="row features justify-content-center">
					<div class="col-sm-6 col-lg-4 text-left item">
						<span class="fa-stack fa-lg icon-background">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-star fa-stack-1x icon"></i>
						</span>
						<h3 class="name">Relax</h3>
						<p class="description">Give your fingers a break from the heat of things.</p>
					</div>
					<div class="col-sm-6 col-lg-4 item">
						<span class="fa-stack fa-lg icon-background">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-crosshairs fa-stack-1x icon"></i>
						</span>
						<h3 class="name">Aim Assist</h3>
						<p class="description">Tired of trying to hit those 1-2 jumps over and over again? Aim Assist will make your life easier.</p>
					</div>
					<div class="col-sm-6 col-lg-4 item">
						<span class="fa-stack fa-lg icon-background">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-clock fa-stack-1x icon"></i>
						</span>
						<h3 class="name">Timewarp</h3>
						<p class="description">DoubleTime is too fast for you? Not a problem! With Timewarp you can play the game at your own pace.</p>
					</div>
					<div class="col-sm-6 col-lg-4 item">
						<span class="fa-stack fa-lg icon-background">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-low-vision fa-stack-1x icon"></i>
						</span>
						<h3 class="name">Visuals</h3>
						<p class="description">Includes Approach Rate changer, Hidden/Flashlight removers and UI customization.</p>
					</div>
					<div class="col-sm-6 col-lg-4 item">
						<span class="fa-stack fa-lg icon-background">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-cloud-download fa-stack-1x icon"></i>
						</span>
						<h3 class="name">Free osu!direct</h3>
						<p class="description">Not really free since you're paying for Maple anyways...</p>
					</div>
						<div class="col-sm-6 col-lg-4 item">
						<span class="fa-stack fa-lg icon-background">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-paint-brush fa-stack-1x icon"></i>
						</span>
						<h3 class="name">Extra skinnables</h3>
						<p class="description">Ever wanted to skin osu! logo? Now you can!</p>
					</div>
					<div class="col-sm-6 col-lg-4 item">
						<span class="fa-stack fa-lg icon-background">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-list-alt fa-stack-1x icon"></i>
						</span>
						<h3 class="name">And much, much more to come!</h3>
					</div>
				</div>
			</div>
			<div id="menuCarousel" class="carousel slide" data-ride="carousel" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<ol class="carousel-indicators">
					<li data-target="#menuCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#menuCarousel" data-slide-to="1"></li>
					<li data-target="#menuCarousel" data-slide-to="2"></li>
					<li data-target="#menuCarousel" data-slide-to="3"></li>
					<li data-target="#menuCarousel" data-slide-to="4"></li>
					<li data-target="#menuCarousel" data-slide-to="5"></li>
					<li data-target="#menuCarousel" data-slide-to="6"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div class="carousel-item active">
						<div class="img"><img class="d-block img-fluid" src="assets/menu-1.png?v=1.2"></div>
					</div>
					<div class="carousel-item">
						<div class="img"><img class="d-block img-fluid" src="assets/menu-2.png?v=1.2"></div>
					</div>
					<div class="carousel-item">
						<div class="img"><img class="d-block img-fluid" src="assets/menu-3.png?v=1.2"></div>
					</div>
					<div class="carousel-item">
						<div class="img"><img class="d-block img-fluid" src="assets/menu-4.png?v=1.2"></div>
					</div>
					<div class="carousel-item">
						<div class="img"><img class="d-block img-fluid" src="assets/menu-5.png?v=1.2"></div>
					</div>
					<div class="carousel-item">
						<div class="img"><img class="d-block img-fluid" src="assets/menu-6.png?v=1.2"></div>
					</div>
					<div class="carousel-item">
						<div class="img"><img class="d-block img-fluid" src="assets/menu-7.png?v=1.2"></div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#menuCarousel" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#menuCarousel" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div> 
		</div>
		<div id="pricing" class="d-flex flex-column justify-content-center align-items-center">
			<div class="section-header mx-auto text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<h2>Pricing</h2>
				<p>Choose your subscription plan below and start your journey to the top today!</p>
			</div>
			<h5 id="product" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">Maple</h5>
			<div class="row row-cols-1 row-cols-md-3 mb-3 text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<div class="col">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Lifetime</h4>
						</div>
						<div class="card-body">
							<h1 class="card-title pricing-card-title">€→0<small>/ mo</small></h1>
							<small>€300/ ∞</small>
							<ul class="list-unstyled mt-3 mb-4">
								<li class="text-left"><i class="fas fa-check"></i> Includes all features</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited free updates</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited support</li>
							</ul>
							<button type="button" class="btn btn-outline-primary w-100 btn btn-lg btn-outline-primary" disabled>Coming soon!</button>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Annually</h4>
						</div>
						<div class="card-body">
							<h1 class="card-title pricing-card-title">€10<small>/ mo</small></h1>
							<small>€120/ Year</small>
							<ul class="list-unstyled mt-3 mb-4">
								<li class="text-left"><i class="fas fa-check"></i> Includes all features</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited free updates</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited support</li>
							</ul>
							<button type="button" class="btn btn-outline-primary w-100 btn btn-lg btn-outline-primary" disabled>Coming soon!</button>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Quarterly</h4>
						</div>
						<div class="card-body">
							<h1 class="card-title pricing-card-title">€15<small>/ mo</small></h1>
							<small>€45/ 3 Months</small>
							<ul class="list-unstyled mt-3 mb-4">
								<li class="text-left"><i class="fas fa-check"></i> Includes all features</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited free updates</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited support</li>
							</ul>
							<button type="button" class="btn btn-outline-primary w-100 btn btn-lg btn-outline-primary" disabled>Coming soon!</button>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Monthly</h4>
						</div>
						<div class="card-body">
							<h1 class="card-title pricing-card-title">€20<small>/ mo</small></h1>
							<small>€20/ Month</small>
							<ul class="list-unstyled mt-3 mb-4">
								<li class="text-left"><i class="fas fa-check"></i> Includes all features</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited free updates</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited support</li>
							</ul>
							<button type="button" class="btn btn-outline-primary w-100 btn btn-lg btn-outline-primary" disabled>Coming soon!</button>
						</div>
					</div>
				</div>
			</div>
			<h5 id="product" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">Maple Lite</h5>
			<div class="row row-cols-1 row-cols-md-3 mb-3 text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<div class="col">
					<div class="card plan-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Monthly</h4>
						</div>
						<div class="card-body">
							<h1 class="card-title pricing-card-title">€10<small>/ mo</small></h1>
							<small>€10/ Month</small>
							<ul class="list-unstyled mt-3 mb-4">
								<li class="text-left"><i class="fas fa-check"></i> Includes Relax, Timewarp and Visuals</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited free updates</li>
								<li class="text-left"><i class="fas fa-check"></i> Unlimited support</li>
							</ul>
							<button type="button" onclick="location.href='dashboard/store'" class="btn btn-outline-primary w-100 btn btn-lg btn-outline-primary">Get Maple</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="planComparison" class="d-flex flex-column justify-content-center align-items-center">
			<div class="section-header mx-auto text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<h2>Plan Comparison</h2>
				<p>Not sure which plan you should choose? Our comparison table will help you!</p>
			</div>
			<table class="planComparisonTable" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<tr>
					<th style="width:50%">Features</th>
					<th>Maple</th>
					<th>Maple Lite</th>
				</tr>
				<tr>
					<td>Relax</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-check"></i></td>
				</tr>
				<tr>
					<td>Aim Assist</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-remove"></i></td>
				</tr>
				<tr>
					<td>Replay Editor</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-remove"></i></td>
				</tr>
				<tr>
					<td>Timewarp</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-check"></i></td>
				</tr>
				<tr>
					<td>AR Changer</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-check"></i></td>
				</tr>
				<tr>
					<td>HD, FL Remover</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-check"></i></td>
				</tr>
				<tr>
					<td>Stream-proof menu/visuals</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-remove"></i></td>
				</tr>
				<tr>
					<td>Disable score submission</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-check"></i></td>
				</tr>
				<tr>
					<td>Extra skinnables</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-remove"></i></td>
				</tr>
				<tr>
					<td>Free osu! direct</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-remove"></i></td>
				</tr>
				<tr>
					<td>Discord RPC Spoofer</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-check"></i></td>
				</tr>
				<tr>
					<td>Account manager</td>
					<td><i class="fa fa-check"></i></td>
					<td><i class="fa fa-remove"></i></td>
				</tr>
			</table>
		</div>
		
		<footer class="footer mt-auto">
			<div class="footer-container container d-flex justify-content-between">
				<p class="my-auto">Copyright © 2021 maple.software. All rights reserved.</p>
				<ul class="nav flex-column flex-sm-row">
					<li class="nav-item">
						<a class="nav-link" href="help/terms-of-service">Terms of Service</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="help/privacy-policy">Privacy Policy</a>
					</li>
				</ul>
			</div>
		</footer>
		<script>
		  AOS.init();
		</script>
	</body>
</html>