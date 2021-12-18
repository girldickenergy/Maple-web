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
?>

<!DOCTYPE html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="../assets/css/style.css?v=1">
    <link rel="stylesheet" href="../assets/css/dashboard.css?v=1.1">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://kit.fontawesome.com/d1269851a5.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>

    <link rel="icon" href="../assets/favicon.png">
    <title>Admin Panel - Maple</title>
</head>

<style>
    table
    {
        border: 1px solid #262626 !important;
        color: #CCCCCC;
    }

    th {
        color: #E85D9B !important;
    }

    th, td {
        text-align: center;
        padding: 16px;
    }

    th:first-child, td:first-child {
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #262626
    }

    tr:nth-child(odd) {
        background-color: #333333
    }
</style>

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
            <h2>Registered Users</h2>
        </div>
        <div class="justify-content-center text-center" style="width: 80%;">
            <table id="table" data-height="460" data-pagination="true" data-search="true">
                <thead>
                    <tr>
                        <th data-field="ID">ID</th>
                        <th data-field="Username">Username</th>
                        <th data-field="Permissions">Permissions</th>
                        <th data-field="HWID">HWID</th>
                        <th data-field="Unique Hash">Unique Hash</th>
                        <th data-field="Discord ID">DiscordID</th>
                        <th data-field="Ban Reason">Ban Reason</th>
                        <th data-field="HWID Resets">HWID Resets</th>
                        <th data-field="Maple Points">Maple Points</th>
                    </tr>
                </thead>
            </table>
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
        AOS.init();

        var $table = $('#table')

        $(function() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../backend/adminPanel/userTools.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function ()
            {
                var resp = JSON.parse(this.responseText);
                $table.bootstrapTable({data: resp});
            };
            xhr.send('c=8&d=0');
        })
    </script>
</body>
</html>