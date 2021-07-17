<?php
	require_once "../backend/Database/databaseHandler.php";
	require_once "../backend/Sessions/sessionHandler.php";
	$currentSession = getSession($dbConn);
	if ($currentSession == null)
	{
		header("Location: https://maple.software/auth/login");
		die();
	}
	
	$error = "";
	if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET))
	{
		require_once "../backend/Payments/paypalConfig.php";
		
		$transaction = $gateway->completePurchase(array(
			'payer_id' => $_GET['PayerID'],
			'transactionReference' => $_GET['paymentId'],
		));
		$response = $transaction->send();
		
		if ($response->isSuccessful())
		{
			$arrBody = $response->getData();
			$userId = $currentSession["UserID"];
			$amount = $arrBody['transactions'][0]['amount']['total'];
			$maplePointsAmount = $amount * 100;
			$paymentId = $arrBody['id'];
			$payerId = $arrBody['payer']['payer_info']['payer_id'];
			$payerEmail = $arrBody['payer']['payer_info']['email'];
			$status = $arrBody['state'];
			
			if (paymentExists($dbConn, $paymentId))
			{
				$error = "This payment has been already completed.";
			}
			else if (addPayment($dbConn, $userId, $maplePointsAmount, $amount, $paymentId, $payerId, $payerEmail, $status))
			{
				$user = getUserById($dbConn, $currentSession["UserID"]);

				setMaplePoints($dbConn, $currentSession["UserID"], $user["MaplePoints"] + $maplePointsAmount);
			}
			else
			{
				$error = "Server side error occured.";
			}
		}
		else
		{
			$error = $response->getMessage();
		}
	}
	else
	{
		$error = "Transaction has been declined.";
	}
?>

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
		<title>Purchase - Maple</title>
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
						<a class="nav-link" href="../dashboard"><i class="fas fa-user"></i> Profile</a>
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
		
		<div id="content" class="d-flex flex-column justify-content-center align-items-center">
			<div class="card plan-card mb-4 shadow-sm">
				<div class="card-header">
					<h4 class="my-0 fw-normal text-center"><?= $error == "" ? "Thank you!" : "There's an issue with your transaction." ?></h4>
				</div>
				<div class="card-body justify-content-center text-center">
					<?php
						if ($error == "")
						{
							echo("<p>Your transaction has been completed successfully!</p>
							<p>You can now see the changes in your profile.</p>");
						}
						else
						{
							echo("<p>$error</p>");
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