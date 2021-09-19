<?php
    require_once "../backend/Sessions/sessionHandler.php";
    require_once "../backend/Database/databaseHandler.php";
    global $dbConn;

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

    if (($user["Permissions"] & perm_admin) == 0)
        die("<!DOCTYPE HTML PUBLIC '-//IETF//DTD HTML 2.0//EN'><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this server.</p></body></html>");

    $users = getAllUsers($dbConn);
    $subscriptions = getAllSubscriptions($dbConn);
    $games = getAllGames($dbConn);
    $cheats = getAllCheats($dbConn);
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
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://kit.fontawesome.com/d1269851a5.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <link rel="icon" href="../assets/favicon.png">
    <title>Dashboard - Maple</title>
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
                    <?php
                    if ($user["Permissions"] & perm_admin)
                        echo '<li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-tools"></i> Admin Panel</a></li>';
                    ?>
                </ul>
                <span>
                    <button type="button" onclick="location.href='../auth/logout';" class="btn btn-outline-primary">Log out</button>
                </span>
            </div>
        </nav>

        <div id="content" class="d-flex flex-column justify-content-center align-items-center" data-aos="zoom-in-down" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true">
            <div class="content-header mx-auto text-center">
                <h2>Admin Panel</h2>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-md-6">
                    <div class="card content-card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal">Users</h4>
                        </div>
                        <div class="card-body">
                            <h6>Registered Users: <?= count($users) ?></h6>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#userSpecificToolsModal">Manage Users</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card content-card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal">Subscriptions</h4>
                        </div>
                        <div class="card-body">
                            <h6>Active Subscriptions: <?= count($subscriptions) ?></h6>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#userSpecificToolsModal">Manage Subscriptions</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card content-card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal">Games</h4>
                        </div>
                        <div class="card-body">
                            <h6>Games Count: <?= count($games) ?></h6>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#userSpecificToolsModal">Manage Games</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card content-card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal">Cheats</h4>
                        </div>
                        <div class="card-body">
                            <h6>Cheats count: <?= count($cheats) ?></h6>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#userSpecificToolsModal">Manage Cheats</button>
                        </div>
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
                                        for($i = 1; $i < count($users)+1; $i += 1) { //count($allUsers)
                                            $x = $users[$i-1][0];
                                            $username = getUserById($dbConn, $x)["Username"];
                                            echo "<option value=\"" . $i . "\"" . ($i==0 ? "selected" : "") . "> ".$username."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class ="row justify-content-center text-center">
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permActivatedCheckbox">
                                        <label class="form-check-label" for="permActivatedCheckbox">Activated</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permAdminCheckbox">
                                        <label class="form-check-label" for="permAdminCheckbox">Admin</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permBannedCheckbox">
                                        <label class="form-check-label" for="permBannedCheckbox">Banned</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hwidInput" class="col-sm-4 col-form-label">HWID</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="hwidInput">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="uniqueHashInput" class="col-sm-4 col-form-label">Unique Hash</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="uniqueHashInput">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discordIDInput" class="col-sm-4 col-form-label">Discord ID</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="discordIDInput">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="banReasonInput" class="col-sm-4 col-form-label">Ban Reason</label>
                                <div class="col">
                                    <input type="text" class="form-control" id="banReasonInput">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="hwidResetsInput">HWID Resets</label>
                                <div class="col">
                                    <input type="number" id="hwidResetsInput" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" for="maplePointsInput">Maple Points</label>
                                <div class="col">
                                    <input type="number" id="maplePointsInput" class="form-control"/>
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

        <footer class="footer mt-auto">
            <div class="footer-container container d-flex justify-content-between">
                <p class="my-auto">Copyright © 2021 maple.software. All rights reserved.</p>
                <ul class="nav flex-column flex-sm-row">
                    <li class="nav-item">
                        <a class="nav-link" href="../help/contact-us">Contact Us</a>
                    </li>
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
            AOS.init();

            updateUserValues($('#usersel').val());

            $('#usersel').change(function()
            {
                updateUserValues($(this).val());
            });

            $("#userDataApplyChanges").bind("click", function()
            {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../backend/adminPanel/userTools.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function ()
                {
                    var resp = this.responseText;
                    if (resp == "s")
                    {
                        alert("Success!");
                    }
                };

                var permissions = 0;
                if ($("#permActivatedCheckbox").is(":checked"))
                    permissions += 1;

                if ($("#permAdminCheckbox").is(":checked"))
                    permissions += 2;

                if ($("#permBannedCheckbox").is(":checked"))
                    permissions += 4;

                var hwid = $("#hwidInput").val();
                var uniqueHash = $("#uniqueHashInput").val();
                var discordID = $("#discordIDInput").val();
                var banReason = $("#banReasonInput").val();
                var hwidResets = $("#hwidResetsInput").val();
                var maplePoints = $("#maplePointsInput").val();
                var userId = $("#usersel").val();


                var data = permissions + "|" + hwid + "|" + uniqueHash + "|" + discordID + "|" + banReason + "|" + hwidResets + "|" + maplePoints + "|" + userId;
                xhr.send('c=7&d='+data);
            });

            function updateUserValues(vThis)
            {
                updatePermissions(vThis);
                updateHWID(vThis);
                updateUniqueHash(vThis);
                updateDiscordID(vThis);
                updateBanReason(vThis);
                updateHWIDResets(vThis);
                updateMaplePoints(vThis);
            }

            function updatePermissions(vThis)
            {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../backend/adminPanel/userTools.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function ()
                {
                    var resp = this.responseText;
                    if (Number.isInteger(parseInt(resp)))
                    {
                        if (parseInt(resp) & 1)
                            setCheckboxStatus("#permActivatedCheckbox", true);
                        else
                            setCheckboxStatus("#permActivatedCheckbox", false);

                        if (parseInt(resp) & 2)
                            setCheckboxStatus("#permAdminCheckbox", true);
                        else
                            setCheckboxStatus("#permAdminCheckbox", false);

                        if (parseInt(resp) & 4)
                            setCheckboxStatus("#permBannedCheckbox", true);
                        else
                            setCheckboxStatus("#permBannedCheckbox", false);
                    }
                };
                xhr.send('c=0&d='+vThis);
            }

            function updateHWID(vThis)
            {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../backend/adminPanel/userTools.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function ()
                {
                    var resp = this.responseText;
                    // WE HAVE TO CLEAR FIRST, AFTER EDIT IT WOULDNT CHANGE THE INPUT VALUE ANYMORE
                    $("#hwidInput").val("");
                    $("#hwidInput").val(resp);
                };
                xhr.send('c=1&d='+vThis);
            }

            function updateUniqueHash(vThis)
            {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../backend/adminPanel/userTools.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function ()
                {
                    var resp = this.responseText;
                    // WE HAVE TO CLEAR FIRST, AFTER EDIT IT WOULDNT CHANGE THE INPUT VALUE ANYMORE
                    $("#uniqueHashInput").val("");
                    $("#uniqueHashInput").val(resp);
                };
                xhr.send('c=2&d='+vThis);
            }

            function updateDiscordID(vThis)
            {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../backend/adminPanel/userTools.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function ()
                {
                    var resp = this.responseText;
                    // WE HAVE TO CLEAR FIRST, AFTER EDIT IT WOULDNT CHANGE THE INPUT VALUE ANYMORE
                    $("#discordIDInput").val("");
                    $("#discordIDInput").val(resp);
                };
                xhr.send('c=3&d='+vThis);
            }

            function updateBanReason(vThis)
            {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../backend/adminPanel/userTools.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function ()
                {
                    var resp = this.responseText;
                    // WE HAVE TO CLEAR FIRST, AFTER EDIT IT WOULDNT CHANGE THE INPUT VALUE ANYMORE
                    $("#banReasonInput").val("");
                    $("#banReasonInput").val(resp);
                };
                xhr.send('c=4&d='+vThis);
            }

            function updateHWIDResets(vThis)
            {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../backend/adminPanel/userTools.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function ()
                {
                    var resp = this.responseText;
                    $("#hwidResetsInput").attr("value", parseInt(resp));
                };
                xhr.send('c=5&d='+vThis);
            }

            function updateMaplePoints(vThis)
            {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../backend/adminPanel/userTools.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function ()
                {
                    var resp = this.responseText;
                    $("#maplePointsInput").attr("value", parseInt(resp));
                };
                xhr.send('c=6&d='+vThis);
            }

            function setCheckboxStatus(cb, checked)
            {
                $(cb).prop("checked", checked);
            }

            function changeDatePickerValue(dtp, val)
            {
                $(dtp).datetimepicker().value(val);
            }
        </script>
    </body>
</html>
