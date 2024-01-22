<?php
    require_once "../backend/database/usersDatabase.php";
    require_once "../backend/database/sessionsDatabase.php";
    require_once "../backend/database/gamesDatabase.php";
    require_once "../backend/database/cheatsDatabase.php";
    require_once "../backend/datetime/datetimeUtilities.php";

    $currentSession = GetCurrentSession();
    if ($currentSession == null)
    {
        header("Location: ../auth/login");
        die();
    }
    else
        SetSessionActivity($currentSession["SessionToken"], gmdate('Y-m-d H:i:s', time()));

    $user = GetUserByID($currentSession["UserID"]);
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

    $games = GetAllGames();
    $cheats = GetAllCheats();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Status - Maple</title>
        <link rel="icon" href="../assets/web/images/mapleleaf.svg?v=1.4">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/web/dependencies/bootstrap/css/bootstrap.min.css?v=1.4">
        <link rel="stylesheet" href="../assets/web/dependencies/aos/css/aos.css?v=1.4"/>
        <link rel="stylesheet" href="../assets/web/css/main.css?v=1.8">

        <script src="../assets/web/dependencies/bootstrap/js/bootstrap.min.js?v=1.4"></script>
        <script src="../assets/web/dependencies/jquery/js/jquery-3.6.0.min.js?v=1.4"></script>
        <script src="../assets/web/dependencies/aos/js/aos.js?v=1.4"></script>
        <script src="https://kit.fontawesome.com/d1269851a5.js?v=1.4" crossorigin="anonymous"></script>
    </head>

    <body>
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark py-3">
            <div class="container">
                <a class="navbar-brand" href="https://maple.software">
                    <div class="d-flex align-items-center">
                        <span class="navbar-brand-logo">
                            <img src="../assets/web/images/mapleleaf.svg?v=1.4" width="30" height="30" class="d-inline-block align-top" alt="">
                        </span>
                        <span class="navbar-brand-name">
                            <h2 class="fw-bold m-0">Maple</h2>
                        </span>
                    </div>
                    <p class="navbar-brand-motto m-0 text-center fw-bold">the quickest way to the top</p>
                </a>

                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-6"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse" id="navcol-6">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="../dashboard"><i class="fa-solid fa-user"></i> Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="store"><i class="fa-solid fa-shopping-cart"></i> Store</a></li>
                        <li class="nav-item"><a class="nav-link" href="settings"><i class="fa-solid fa-tools"></i> Settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-shield-halved"></i> Status</a></li>
                        <div class="nav-item dropdown">
                            <a href="../help" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa-solid fa-headset"></i> Help</a>
                            <div class="dropdown-menu">
                                <a href="../help/getting-started" class="dropdown-item">Getting started</a>
                                <a href="../help/features" class="dropdown-item">Features</a>
                                <a href="../help/faq" class="dropdown-item">FAQ</a>
                                <a href="../help/payment-issues" class="dropdown-item">Payment issues</a>
                                <a href="../help/software-issues" class="dropdown-item">Software issues</a>
                                <a href="../help/report-a-bug" class="dropdown-item">Report a bug</a>
                                <a href="../help/suggest-a-feature" class="dropdown-item">Suggest a feature</a>
                                <a href="../help/contact-us" class="dropdown-item">No, really, I need help!</a>
                            </div>
                        </div>
                    </ul>
                    <span class="ms-md-2">
                        <button class="btn btn-primary" type="button" onclick="location.href='../auth/logout';">Log out</button>
                    </span>
                </div>
            </div>
        </nav>

        <div class="full-height-container d-flex flex-column justify-content-center align-items-center">
            <h1 class="fw-bold" data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">Status</h1>

            <div class="row row-cols-1 row-cols-lg-2 gy-4 mt-2 justify-content-center align-items-center w-100">
                <div class="col" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                    <div class="row row-cols-1 gy-4">
                        <div class="col">
                            <div class="panel">
                                <div class="d-flex p-3">
                                    <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                        <i class="fa-solid fa-gamepad"></i>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold">Game</h3>
                                        <div class="selector-combo-bg p-1">
                                            <?php
                                                foreach($games as $game)
                                                {
                                                    echo('<input type="radio" class="btn-check" name="game-radio" id="'.$game["ID"].'-game-radio" value="'.$game["ID"].'" autocomplete="off">
                                                          <label class="btn btn-primary" for="'.$game["ID"].'-game-radio"><img src="../assets/games/icons/'.$game["ID"].'.png"> '.$game["Name"].'</label>');
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                            <div class="panel">
                                <div class="d-flex p-3">
                                    <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                        <i class="fa-solid fa-gears"></i>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold">Cheat</h3>
                                        <?php
                                            foreach($games as $game)
                                            {
                                                echo('<div class="selector-combo-bg p-1" id="'.$game["ID"].'-cheats">');
                                                foreach($cheats as $cheat)
                                                {
                                                    if ($cheat["GameID"] == $game["ID"])
                                                    {
                                                        echo('<input type="radio" class="btn-check" name="cheat-radio" id="'.$cheat["ID"].'-cheat-radio" value="'.$cheat["ID"].'" autocomplete="off">
                                                              <label class="btn btn-primary" for="'.$cheat["ID"].'-cheat-radio">'.$cheat["Name"].'</label>');
                                                    }
                                                }
                                                echo('</div>');
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div class="w-100">
                                <h3 class="fw-bold">Status</h3>
                                <?php
                                    foreach($games as $game)
                                    {
                                        foreach($cheats as $cheat)
                                        {
                                            if ($cheat["GameID"] == $game["ID"])
                                            {
                                                echo('<div id="'.$cheat["ID"].'-status">
                                                          <p class="d-inline fw-bold">Status: </p>
                                                          <p class="d-inline '.($cheat["Status"] == CHEAT_STATUS_UNDETECTED ? "text-success" : ($cheat["Status"] == CHEAT_STATUS_OUTDATED ? "text-warning" : ($cheat["Status"] == CHEAT_STATUS_DETECTED ? "text-danger" : ""))).'">'.($cheat["Status"] == CHEAT_STATUS_UNDETECTED ? "undetected" : ($cheat["Status"] == CHEAT_STATUS_OUTDATED ? "outdated" : ($cheat["Status"] == CHEAT_STATUS_DETECTED ? "detected" : "unknown"))).'</p>
                                                          <p class="m-0"><b>Last status update:</b> '.GetHumanReadableDateTimeDifference($cheat["StatusUpdatedAt"], gmdate("Y-m-d H:i:s", time())).'</p>
                                                          <br>
                                                          <h5 class="fw-bold">Anti-cheat info</h5>
                                                          <p class="m-0"><b>Name:</b> '.$game["AnticheatName"].'</p>
                                                          <p class="m-0"><b>File name:</b> '.$game["AnticheatFileName"].'</p>
                                                          <p class="m-0"><b>File size:</b> '.$game["AnticheatFileSize"].'</p>
                                                          <p class="m-0"><b>File checksum:</b> '.$game["AnticheatFileChecksum"].'</p>
                                                          <p class="m-0"><b>Last update:</b> '.GetHumanReadableDateTimeDifference($game["AnticheatUpdatedAt"], gmdate("Y-m-d H:i:s", time())).'</p>
                                                          <p class="m-0"><b>Last check:</b> '.GetHumanReadableDateTimeDifference($game["AnticheatCheckedAt"], gmdate("Y-m-d H:i:s", time())).'</p>
                                                      </div>');
                                            }
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center py-4">
            <div class="container">
                <div class="row row-cols-2 row-cols-lg-3">
                    <div class="col">
                        <p class="my-2">Copyright © 2024 Bueno Ltd.</p>
                    </div>
                    <div class="col">
                        <ul class="list-inline my-2">
                            <li class="list-inline-item">
                                <a class="discord-icon" href="../discord"><i class="fa-brands fa-discord"></i></a>
                                <a class="youtube-icon" href="https://www.youtube.com/channel/UCzyZrNQWaF3iSdqBX4ls42g"><i class="fa-brands fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-inline my-2">
                            <li class="list-inline-item"><a href="../legal/terms-of-service">Terms of Service</a></li>
                            <li class="list-inline-item"><a href="../legal/privacy-policy">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="../legal/contacts">Contacts</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </body>

    <script>
        AOS.init();

        onGameChange(<?= $games[0]["ID"] ?>);

        $('input[type=radio][name=game-radio]').on('change', function()
        {
            onGameChange($(this).val());
        });

        $('input[type=radio][name=cheat-radio]').on('change', function()
        {
            onCheatChange($(this).val());
        });

        function onGameChange(value)
        {
            if (!$('#' + value + '-game-radio').is(":checked"))
                $('#' + value + '-game-radio').prop('checked', true);

            for (let i = 0; i < <?= count($games) ?>; i++)
                $('#' + i + '-cheats').attr('hidden', true);

            $('#' + value + '-cheats').attr('hidden', false);
            $('#' + value + '-cheats').children().first().prop('checked', true);

            onCheatChange($('#' + value + '-cheats').children().first().val());
        }

        function onCheatChange(value)
        {
            for (let i = 0; i < <?= count($cheats) ?>; i++)
                $('#' + i + '-status').attr('hidden', true);

            $('#' + value + '-status').attr('hidden', false);
        }

    </script>

</html>
