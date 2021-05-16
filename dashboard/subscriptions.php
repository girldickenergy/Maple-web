<?php
include 'subType.php';

$attempted = false;
$success = false;
$subType = 0;

session_start();
if (isset($_SESSION["isLoggedIn"])) {
    // dunno what i'll add here but its here
} else {
    header("Location: ../auth/login");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (check() == 0)
        createStuff();
}

// TODO: add everything to handle payment and database shit here
function createStuff() {
    global $subType, $success;
    $subType = $_POST["subtype"];

    $success = true;
}

function check() {
    global $subType, $success, $attempted;
    if (!is_int($_POST["subtype"])) {
        $success = false;
    }

    $x = $_POST["subtype"];
    if ($x == SubType_MapleLite_Monthly)
        $success = true;

    $attempted = true;
    if ($success == false)
        return -1;
    else
        return 0;
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
					<a class="nav-link" href="dashboard"><i class="fas fa-user"></i> Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href=""><i class="fas fa-money-bill"></i> Subscriptions</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="accsettings"><i class="fas fa-tools"></i> Account Settings</a>
				</li>
			</ul>
			<span class="navbar-dashboard-or-sign-in">
					<button type="button" class="btn btn-outline-primary">Logout</button>
				</span>
		</div>
	</nav>

    <div id="pricing" class="d-flex flex-column justify-content-center align-items-center">
        <div class="section-header mx-auto text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
            <h2>Manage your subscriptions</h2>
            <!-- <p>some text here i guess</p>
             <br><br> spacing-->

            <?php
            if($success == true && $attempted == true)
            {
                echo "<div class=\"alert alert-success\" role=\"alert\">
                        Thanks for purchasing Maple! Your purchase will be processed shortly...
                      </div>";
            }
            if ($success == false && $attempted == true)
            {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
                        Sorry, but purchasing anything other than Maple Lite is disabled!
                      </div>";
            }
            ?>

            <form action="<?php
            $path = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
            echo $path[0].".".$path[1];
            
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
                <div class="form-group">
                    <label for="subscriptionType">Choose Subscription Type</label>
                    <select class="form-control" id="subscriptionType" name="subtype" form="subform">
                        <option value="1">Monthly - 20€ / Month</option>
                        <option value="2">Quarterly - 45€ / 3 Months</option>
                        <option value="3">Annually - 120€ / Year</option>
                        <option value="4">Lifetime - 300€ / ∞</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary w-100 btn btn-lg btn-outline-primary">Buy now!</button>
                </div>
            </form>
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
		<script>
            var f = false;
		  AOS.init();

		  function a(){
                if (f) {
                    document.getElementById("subscriptionType").innerHTML =
                        `<option value="1">Monthly - 20€ / Month</option>
                        <option value="2">Quarterly - 45€ / 3 Months</option>
                        <option value="3">Annually - 120€ / Year</option>
                        <option value="4">Lifetime - 300€ / ∞</option>`;
                }
                else {
                    document.getElementById("subscriptionType").innerHTML =
                        `<option value="5">Monthly - 10€ / Month</option>`;
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
		</script>
	</body>
</html>