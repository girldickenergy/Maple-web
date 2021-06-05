<?php
/*
 * Pretty much all data from the database
 */
$allUsers = null;

// if a non admin user tried to access the admin dashboard
$isAdmin = false;


require_once "../backend/Sessions/sessionHandler.php";
require_once "../backend/Database/databaseHandler.php";
global $dbConn;

$currentSession = getSession($dbConn);
if ($currentSession != null)
{
    $userid = $currentSession["UserID"];

    $user = getUserById($dbConn, $userid);
    if ($user["Permissions"] & perm_admin)
        $isAdmin = true;

    if (!$isAdmin) {
        echo("<!DOCTYPE html>\n\n<meta charset=\"utf-8\">\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\n\n<html>\n<head>\n    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">\n    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\">\n    <link href=\"https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap\" rel=\"stylesheet\">\n    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css\">\n    <link href=\"https://unpkg.com/aos@2.3.1/dist/aos.css\" rel=\"stylesheet\">\n    <link rel=\"stylesheet\" href=\"../assets/css/style.css?v=1\">\n    <link rel=\"stylesheet\" href=\"../assets/css/index.css?v=1.4\">\n\n    <script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>\n    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js\" integrity=\"sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k\" crossorigin=\"anonymous\"></script>\n    <script src=\"../assets/js/bs-init.js\"></script>\n    <script src=\"https://kit.fontawesome.com/d1269851a5.js\" crossorigin=\"anonymous\"></script>\n    <script src=\"https://unpkg.com/aos@2.3.1/dist/aos.js\"></script>\n\n    <link rel=\"icon\" href=\"../assets/favicon.png\">\n    <title>Admin Dashboard - Maple</title>\n\n    <style>\n        #profileData {\n            padding-left: 15px;\n            padding-right: 15px;\n            margin-left: auto;\n            margin-right: auto;\n            min-height: 100vh;\n            max-height: 100%;\n            padding-top: 50px;\n        }\n\n        .form-check-label {\n            color: #495057 !important;\n        }\n    </style>\n</head>\n<body>\n<nav class=\"navbar navbar-dark navbar-expand-lg fixed-top\">\n    <a class=\"navbar-brand\" href=\"https://maple.software/\">\n        <img src=\"../assets/favicon.png\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\" alt=\"\">\n        Maple\n    </a>\n    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNav\" aria-controls=\"navbarNav\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">\n        <span class=\"navbar-toggler-icon\"></span>\n    </button>\n    <div class=\"collapse navbar-collapse\" id=\"navbarNav\">\n        <ul class=\"navbar-nav mx-auto\">\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"#\"><i class=\"fas fa-user\"></i> Profile</a>\n            </li>\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"underconstruction\"><i class=\"fas fa-money-bill\"></i> Subscriptions</a>\n            </li>\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"underconstruction\"><i class=\"fas fa-tools\"></i> Account Settings</a>\n            </li>\n        </ul>\n        <span>\n\t\t\t\t\t<button type=\"button\" onclick=\"location.href=\'../auth/logout\';\" class=\"btn btn-outline-primary\">Log out</button>\n\t\t\t\t</span>\n    </div>\n</nav>\n\n<div id=\"profileData\" class=\"d-flex flex-column justify-content-center\">\n    <div class=\"row text-center justify-content-center\" data-aos=\"zoom-in-down\" data-aos-offset=\"200\" data-aos-duration=\"1000\" data-aos-once=\"true\">\n        <div class=\"col-md-3\">\n            <div class=\"card plan-card mb-4 shadow-sm\">\n                <div class=\"card-header\">\n                    <h4 class=\"my-0 fw-normal\">add some options</h4>\n                </div>\n                <div class=\"card-body\">\n                    <h6>some parameters</h6>\n                </div>\n            </div>\n            <div class=\"card plan-card mb-4 shadow-sm\">\n                <div class=\"card-header\">\n                    <h4 class=\"my-0 fw-normal\">add some more options</h4>\n                </div>\n                <div class=\"card-body\">\n                    <h6>some cool stuff</h6>\n                </div>\n            </div>\n            <div class=\"card plan-card mb-4 shadow-sm\">\n                <div class=\"card-header\">\n                    <h4 class=\"my-0 fw-normal\">youre cute</h4>\n                </div>\n                <div class=\"card-body\">\n                    <h6>some more</h6>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>\n\n<footer class=\"footer mt-auto\">\n    <div class=\"footer-container container d-flex justify-content-between\">\n        <p class=\"my-auto\">Copyright © 2021 maple.software. All rights reserved.</p>\n        <ul class=\"nav flex-column flex-sm-row\">\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"terms-of-service\">Terms of Service</a>\n            </li>\n            <li class=\"nav-item\">\n                <a class=\"nav-link\" href=\"privacy-policy\">Privacy Policy</a>\n            </li>\n        </ul>\n    </div>\n</footer>\n<script>\n    AOS.init();\n</script>\n</body>\n</html>");
        die();
    }

    // all checks done, we are free to grab all values
    getAllValues();
} else {
    header("Location: ../auth/login");
    die();
}

function getAllValues()
{
    global $dbConn, $allUsers;
    $allUsers = getAllUsers($dbConn);
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
    <link rel="stylesheet" href="../assets/css/index.css?v=1.4">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://kit.fontawesome.com/d1269851a5.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <link rel="icon" href="../assets/favicon.png">
    <title>Admin Dashboard - Maple</title>

    <style>
        #profileData {
            padding-left: 15px;
            padding-right: 15px;
            margin-left: auto;
            margin-right: auto;
            min-height: 100vh;
            max-height: 100%;
            padding-top: 50px;
        }

        .form-check-label {
            color: #495057 !important;
        }
    </style>
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
<div id="profileData" class="d-flex flex-column justify-content-center">
    <div class="row text-center justify-content-center" data-aos="zoom-in-down" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true">
        <div class="col-md-3">
            <div class="card plan-card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 fw-normal">Users</h4>
                </div>
                <div class="card-body">
                    <h6>Registered Users: <?= count($allUsers) ?></h6>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#userSpecificToolsModal">User Specific Tools</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for User Specific Tools-->
    <div class="modal fade" id="userSpecificToolsModal" tabindex="-1" role="dialog" aria-labelledby="userSpecificToolsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userSpecificToolsModalLabel">User Specific Tools</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class ="row">
                            <div class="form-group col-md-12">
                                <select class="custom-select" id="usersel">
                                    <?php
                                        for($i = 1; $i < count($allUsers)+1; $i += 1) { //count($allUsers)
                                            $x = $allUsers[$i-1][0];
                                            $username = getUserById($dbConn, $x)["Username"];
                                            echo "<option value=\"" . $i . "\"" . ($i==0 ? "selected" : "") . "> ".$username."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class ="row">
                            <div class="form-group col-md-4">
                                <div class="form-check ">
                                    <input class="form-check-input" type="checkbox" id="permNormalCheckbox" value="option1">
                                    <label class="form-check-label" for="permNormalCheckbox">Normal</label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="permAdminCheckbox" value="option2" checked>
                                    <label class="form-check-label" for="permAdminCheckbox">Admin</label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="isActivatedCheckbox" checked>
                                    <label class="form-check-label" for="isActivatedCheckbox">Activated</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hwidInput" class="col-sm-2 col-form-label">HWID</label>
                            <div class="col">
                                <input type="text" class="form-control" id="hwidInput">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="maplePointsInput">Maple Points</label>
                            <div class="col">
                                <input type="number" id="maplePointsInput" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label" for="mapleFullExpiryDate">Maple Full Expiry</label>
                            <div class="col">
                                <input id="mapleFullExpiryDate"  />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label" for="mapleLiteExpiryDate">Maple Lite Expiry</label>
                            <div class="col">
                                <input id="mapleLiteExpiryDate"  />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="hwidResetsInput">HWID Resets</label>
                            <div class="col">
                                <input type="number" id="hwidResetsInput" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="userDataApplyChanges">Apply changes</button>
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

    $("#userDataApplyChanges").bind("click", function() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/AdminDashboard/userUtils.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            var resp = this.responseText;
            if (resp == "s")
            {
                $('#userSpecificToolsModal').modal('hide');
                alert("Success!");
            }
        };

        var permissions = ($("#permNormalCheckbox").is(":checked") ? 1: 0) | ($("#permAdminCheckbox").is(":checked") ? 2 : 0);
        var isActivated = $("#isActivatedCheckbox").is(":checked") ? 1: 0;
        var hwid = $("#hwidInput").val();
        var maplePoints = $("#maplePointsInput").val();
        var fullExpiry = $('#mapleFullExpiryDate').datetimepicker().value();
        var liteExpiry = $('#mapleLiteExpiryDate').datetimepicker().value();
        var hwidResets = $("#hwidResetsInput").val();
        var userId = $("#usersel").val();


        var data = permissions + "|"+isActivated+"|"+hwid+"|"+maplePoints+"|"+fullExpiry+"|"+liteExpiry+"|"+hwidResets+"|"+userId;
        xhr.send('c=7&d='+data);
    });

    $('#mapleFullExpiryDate').datetimepicker({
        uiLibrary: 'bootstrap4',
        modal:true,
        footer:true,
        format: 'yyyy-mm-dd HH:MM'
    });

    $('#mapleLiteExpiryDate').datetimepicker({
        uiLibrary: 'bootstrap4',
        modal:true,
        footer:true,
        format: 'yyyy-mm-dd HH:MM'
    });

    $('#usersel').change(function() {
        // if these are executed on the same tick, the websites breaks
        permissionsCheckbox($(this).val());
    });

    function setCheckboxStatus(cb, checked)
    {
        $(cb).prop("checked", checked);
    }

    function changeDatePickerValue(dtp, val)
    {
        $(dtp).datetimepicker().value(val);
    }

    function permissionsCheckbox(vThis)
    {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/AdminDashboard/userUtils.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            var resp = this.responseText;
            if (Number.isInteger(parseInt(resp))) {
                if (parseInt(resp) & 1)
                    setCheckboxStatus("#permNormalCheckbox", true);
                else
                    setCheckboxStatus("#permNormalCheckbox", false);

                if (parseInt(resp) & 2)
                    setCheckboxStatus("#permAdminCheckbox", true);
                else
                    setCheckboxStatus("#permAdminCheckbox", false);
            }
            isActivatedCheckbox(vThis);
        };
        xhr.send('c=0&d='+vThis);
    }

    function isActivatedCheckbox(vThis)
    {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/AdminDashboard/userUtils.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            var resp = this.responseText;
            if (Number.isInteger(parseInt(resp))) {
                setCheckboxStatus("#isActivatedCheckbox", parseInt(resp)!==0)
            }
            changeHWIDText(vThis);
        };
        xhr.send('c=1&d='+vThis);
    }

    function changeHWIDText(vThis)
    {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/AdminDashboard/userUtils.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            var resp = this.responseText;
            // WE HAVE TO CLEAR FIRST, AFTER EDIT IT WOULDNT CHANGE THE INPUT VALUE ANYMORE
            $("#hwidInput").val("");
            $("#hwidInput").val(resp);
            getMaplePoints(vThis);
        };
        xhr.send('c=2&d='+vThis);
    }

    function getMaplePoints(vThis)
    {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/AdminDashboard/userUtils.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            var resp = this.responseText;
            $("#maplePointsInput").attr("value", parseInt(resp));
            getFullExpiry(vThis);
        };
        xhr.send('c=3&d='+vThis);
    }

    function getFullExpiry(vThis)
    {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/AdminDashboard/userUtils.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            var resp = this.responseText;
            changeDatePickerValue("#mapleFullExpiryDate", resp)
            getLiteExpiry(vThis);
        };
        xhr.send('c=4&d='+vThis);
    }

    function getLiteExpiry(vThis)
    {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/AdminDashboard/userUtils.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            var resp = this.responseText;
            changeDatePickerValue("#mapleLiteExpiryDate", resp)
            getHWIDResets(vThis);
        };
        xhr.send('c=5&d='+vThis);
    }

    function getHWIDResets(vThis)
    {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../backend/AdminDashboard/userUtils.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            var resp = this.responseText;
            $("#hwidResetsInput").attr("value", parseInt(resp));
        };
        xhr.send('c=6&d='+vThis);
    }
</script>
</body>
</html>