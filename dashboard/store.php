<?php
define("SubType_MapleFull_Monthly", 1);
define("SubType_MapleFull_Quarterly", 2);
define("SubType_MapleFull_Annually", 3);
define("SubType_MapleFull_Lifetime", 4);
define("SubType_MapleLite_Monthly", 5);

$success = false;
$status = "";

require_once "../backend/Database/databaseHandler.php";
require_once "../backend/Sessions/sessionHandler.php";
$currentSession = getSession($dbConn);
if ($currentSession == null)
{
    header("Location: ../auth/login");
    die();
}

$user = getUserById($dbConn, $currentSession["UserID"]);
if ($user == null)
{
    header("Location: https://maple.software");
    die();
}

if ($user["Permissions"] & perm_banned)
{
    header("Location: banned");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (isset($_POST["topup"]))
	{
		if (isset($_POST["maplePointsAmount"]) && $_POST["maplePointsAmount"] >= 1 && is_numeric($_POST["maplePointsAmount"]) && fmod($_POST["maplePointsAmount"], 1) === 0.00)
		{
			$amount = $_POST["maplePointsAmount"] / 100;
			$status = handleTopUp($amount);
		}
		else
		{
			$status = "Invalid amount of Maple Points!";
		}
	}
    else if (isset($_POST["exchange"]))
	{
		$result = handleExchange($dbConn, $currentSession["UserID"]);
		if ($result == 0)
		{
			$status = "Your subscription status has been updated!";
			$success = true;
		}
		else if ($result == -1)
		{
			$status = "Unknown error occured!";
		}
		else if ($result == 1)
		{
			$status = "Sorry, but purchasing anything other than Maple Lite is disabled!";
		}
		else if ($result == 2)
		{
			$status = "Not enough Maple Points!";
		}
	}
}

function handleTopUp($amount)
{
	try
	{
		require_once "../backend/Payments/paypalConfig.php";
		
		$response = $gateway->purchase(array(
		    'items' => array(
				array(
					'name' => ($amount * 100).' Maple Points',
					'price' => $amount,
					'quantity' => 1
				),
			),
			'amount' => $amount,
			'currency' => PAYPAL_CURRENCY,
			'returnUrl' => PAYPAL_RETURN_URL,
			'cancelUrl' => PAYPAL_CANCEL_URL,
		))->send();

		if ($response->isRedirect())
		{
			$response->redirect();
		}
		else
		{
			return $response->getMessage();
		}
    }
	catch(Exception $e)
	{
        return $e->getMessage();
    }
}

function handleExchange($dbConn, $userID)
{
    global $success, $attempted;
	$subType = $_POST["subtype"];

    if ($subType == SubType_MapleLite_Monthly)
	{
		$user = getUserById($dbConn, $userID);
		if ($user == null)
		{
			return -1;
		}
		
		if ($user["MaplePoints"] < 1000)
		{
			return 2;
		}

		$mapleLiteExpiry = gmdate('Y-m-d', strtotime('+1 month'));
		$currentSubscription = getSubscription($dbConn, $userID, 0);
		if ($currentSubscription != null)
		{
			$mapleLiteExpiry = date("Y-m-d", strtotime($currentSubscription["ExpiresAt"]));
			$mapleLiteExpiry = date('Y-m-d', strtotime($mapleLiteExpiry. ' + 1 month'));
		}
		
		$maplePointsNew = $user["MaplePoints"] - 1000;
		setMaplePoints($dbConn, $userID, $maplePointsNew);
		setSubscriptionExpiry($dbConn, $userID, 0, $mapleLiteExpiry);
		addExchange($dbConn, $userID, $subType);
		
		return 0;
	}
	else
	{
		return 1;
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
		<link rel="stylesheet" href="../assets/css/dashboard.css?v=1.1">
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="assets/js/bs-init.js"></script>
		<script src="https://kit.fontawesome.com/d1269851a5.js" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		
		<link rel="icon" href="../assets/favicon.png">
		<title>Store - Maple</title>
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
						<a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Store</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="settings"><i class="fas fa-tools"></i> Settings</a>
					</li>
                    <?php
                    if ($user["Permissions"] & perm_admin)
                        echo '<li class="nav-item"><a class="nav-link" href="adminpanel"><i class="fas fa-tools"></i> Admin Panel</a></li>';
                    ?>
				</ul>
				<span>
					<button type="button" onclick="location.href='../auth/logout';" class="btn btn-outline-primary">Log out</button>
				</span>
			</div>
		</nav>

		<div id="content" class="d-flex flex-column justify-content-center align-items-center" data-aos="zoom-in-down" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true">
			<div class="content-header mx-auto text-center">
				<h2>Store</h2>
				<p style="color: #E85D9B;">Store is closed due to a maintenance.<br>Sorry for the inconvenience. ♡</p>
				<div class="alert alert-<?= $success ? "success" : "danger" ?>" role="alert" style="margin-top:20px;" <?= $status == "" ? "hidden" : "" ?>>
					<?= $status ?>
				</div>
			</div>
			<div class="row justify-content-center text-center" style="width: 80%;">
				<div class="col-md-6">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Manage your subscriptions</h4>
						</div>
						<div class="card-body">
							<form action="<?php
							$path = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
							echo $path[0];
							
							?>" method="post" id="subform">
								<div class="form-group">
									<label for="exampleFormControlSelect1">Choose Maple Version</label><br>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="maplefullRadio" name="mapleRadio" class="custom-control-input" checked>
										<label class="custom-control-label" for="maplefullRadio">Maple Full</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="mapleliteRadio" name="mapleRadio" class="custom-control-input">
										<label class="custom-control-label" for="mapleliteRadio">Maple Lite</label>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="subscriptionType">Choose Subscription Type</label>
									<select class="form-control" id="subscriptionType" name="subtype" form="subform">
										<option value="1">Monthly - 2000 Maple Points / Month</option>
										<option value="2">Quarterly - 4500 Maple Points / 3 Months</option>
										<option value="3">Annually - 12000 Maple Points / Year</option>
										<option value="4">Lifetime - 30000 Maple Points / ∞</option>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" name="exchange" class="btn btn-outline-primary w-100 btn btn-lg btn-outline-primary" disabled>Exchange</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card content-card mb-4 shadow-sm">
						<div class="card-header">
							<h4 class="my-0 fw-normal">Top up</h4>
						</div>
						<div class="card-body">
							<form action="<?php
							$path = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
							echo $path[0];
							
							?>" method="post" id="topupform">
							<div class="form-group">
								<p id="totalText">Total: 0€</p>
								<div class="form-group">
									<input type="number" id="maplePointsAmount" name="maplePointsAmount" placeholder="Amount (1 Maple Point = 0.01€)" min="1" class="form-control" required>
								</div>
								<div class="form-group">
									<label for="paymentGateway">Choose payment gateway</label>
									<select class="form-control" id="paymentGateway" name="paymentGateway" form="subform">
										<option value="1">PayPal</option>
										<!--<option value="2">Stripe</option>-->
									</select>
								</div>
								<div class="form-group">
									<button type="submit" name="topup" class="btn btn-outline-primary w-100 btn btn-lg btn-outline-primary" disabled>Checkout</button>
								</div>
							</div>
							</form>
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
            var f = false;
		  AOS.init();

		  function a(){
                if (f) {
                    document.getElementById("subscriptionType").innerHTML =
                        `<option value="1">Monthly - 2000 Maple Points / Month</option>
                        <option value="2">Quarterly - 4500 Maple Points / 3 Months</option>
                        <option value="3">Annually - 12000 Maple Points / Year</option>
                        <option value="4">Lifetime - 30000 Maple Points / ∞</option>`;
                }
                else {
                    document.getElementById("subscriptionType").innerHTML =
                        `<option value="5">Monthly - 1000 Maple Points / Month</option>`;
                }
          }

          $("#maplefullRadio").change(function () {
              if ($(this).is(':checked')) {
                  f = true;
                  a();
              }
          });
          $("#mapleliteRadio").change(function () {
              if ($(this).is(':checked')) {
                  f = false;
                  a();
              }
          });
		  $("#maplePointsAmount").change(function () {
			  document.getElementById('totalText').innerHTML = "Total: " + (this.value / 100) + "€";
		  });
		</script>
	</body>
</html>