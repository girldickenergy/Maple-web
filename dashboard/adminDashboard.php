<?php
// if a non admin user tried to access the admin dashboard
$isAdmin = false;

session_start();
if (isset($_SESSION["isLoggedIn"])) {
    require_once "databaseHandler.php";
    $userid = $_SESSION["uid"];

    $user = getUserById($userid);
    if ($user["Permissions"] & perm_admin) {
        $isAdmin = true;
    }

    if (!$isAdmin) {
        echo("<!DOCTYPE html>\n\n<meta charset=\"utf-8\">\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\n\n<html>\n<head>\n    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">\n    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\">\n    <link href=\"https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap\" rel=\"stylesheet\">\n    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css\">\n    <link href=\"https://unpkg.com/aos@2.3.1/dist/aos.css\" rel=\"stylesheet\">\n    <link rel=\"stylesheet\" href=\"assets/css/style.css?v=1\">\n    <link rel=\"stylesheet\" href=\"assets/css/index.css?v=1.4\">\n\n    <script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>\n    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js\" integrity=\"sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k\" crossorigin=\"anonymous\"></script>\n    <script src=\"assets/js/bs-init.js\"></script>\n    <script src=\"https://kit.fontawesome.com/d1269851a5.js\" crossorigin=\"anonymous\"></script>\n    <script src=\"https://unpkg.com/aos@2.3.1/dist/aos.js\"></script>\n\n    <link rel=\"icon\" href=\"assets/favicon.png\">\n    <title>Home - Maple</title>\n</head>\n<body>\n<nav class=\"navbar navbar-dark navbar-expand-lg fixed-top\">\n    <a class=\"navbar-brand\" href=\"#\">\n        <img src=\"assets/favicon.png\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\" alt=\"\">\n        Maple\n    </a>\n    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\n        <span class=\"navbar-toggler-icon\"></span>\n    </button>\n    <div class=\"collapse navbar-collapse\" id=\"navbarNav\">\n        <ul class=\"navbar-nav mx-auto\">\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"\"><i class=\"fas fa-user\"></i> Profile</a>\n            </li>\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"subscriptions\"><i class=\"fas fa-money-bill\"></i> Subscriptions</a>\n            </li>\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"accsettings\"><i class=\"fas fa-tools\"></i> Account Settings</a>\n            </li>\n        </ul>\n        <span class=\"navbar-dashboard-or-sign-in\">\n\t\t\t\t\t<button type=\"button\" class=\"btn btn-outline-primary\">Logout</button>\n\t\t\t\t</span>\n    </div>\n</nav>\n\n<div id=\"pricing\" class=\"d-flex flex-column justify-content-center align-items-center\">\n    <div class=\"section-header mx-auto text-center\" data-aos=\"fade-up\" data-aos-duration=\"1000\" data-aos-once=\"true\">\n        <h2>nothing here yet..</h2>\n        i will probably add some add sub options here or something later, but not useful now.\n    </div>\n</div>\n\n<footer class=\"footer mt-auto\">\n    <div class=\"footer-container container d-flex justify-content-between\">\n        <p class=\"my-auto\">Copyright © 2021 maple.software. All rights reserved.</p>\n        <ul class=\"nav flex-column flex-sm-row\">\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"terms-of-service\">Terms of Service</a>\n            </li>\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"privacy-policy\">Privacy Policy</a>\n            </li>\n        </ul>\n    </div>\n</footer>\n<script>\n    AOS.init();\n</script>\n</body>\n</html>");
        die();
    }
} else {
    header("Location: ../auth/login");
    die();
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
                <a class="nav-link" href=""><i class="fas fa-user"></i> Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="subscriptions"><i class="fas fa-money-bill"></i> Subscriptions</a>
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
        <h2>this is the real admin dashboard hi</h2>
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
    AOS.init();
</script>
</body>
</html>