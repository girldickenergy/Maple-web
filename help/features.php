<?php
    require_once "../backend/localization/localizationHandler.php";
    require_once "../backend/database/sessionsDatabase.php";
    require_once "../backend/database/gamesDatabase.php";
    require_once "../backend/database/cheatsDatabase.php";

    $currentLanguage = GetLanguage();

    $loggedIn = false;
    $currentSession = GetCurrentSession();
    if ($currentSession != null)
    {
        $loggedIn = true;
        SetSessionActivity($currentSession["SessionToken"], gmdate('Y-m-d H:i:s', time()));
    }

    $games = GetAllGames();
    $cheats = GetAllCheats();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title><?= GetLocalizedString("TITLE_FEATURES").' - Maple' ?></title>
        <link rel="icon" href="../assets/web/images/mapleleaf.svg?v=1.4">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/web/dependencies/bootstrap/css/bootstrap.min.css?v=1.4">
        <link rel="stylesheet" href="../assets/web/dependencies/aos/css/aos.css?v=1.4"/>
        <link rel="stylesheet" href="../assets/web/css/main.css?v=1.6">
        <link rel="stylesheet" href="../assets/web/css/info.css?v=1.5">

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
                        <li class="nav-item"><a class="nav-link" href="https://maple.software/"><i class="fa-solid fa-house"></i> Home</a></li>
                        <div class="nav-item dropdown">
                            <a href="../help" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa-solid fa-headset"></i> <?= GetLocalizedString("HEADER_HELP"); ?></a>
                            <div class="dropdown-menu">
                                <a href="getting-started" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_GETTING_STARTED"); ?></a>
                                <a href="features" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_FEATURES"); ?></a>
                                <a href="faq" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_FAQ"); ?></a>
                                <a href="payment-issues" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_PAYMENT_ISSUES"); ?></a>
                                <a href="software-issues" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_SOFTWARE_ISSUES"); ?></a>
                                <a href="report-a-bug" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_REPORT_A_BUG"); ?></a>
                                <a href="suggest-a-feature" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_SUGGEST_A_FEATURE"); ?></a>
                                <a href="contact-us" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_CONTACT_SUPPORT"); ?></a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?= $currentLanguage == "ru" ? '<img src="https://flagicons.lipis.dev/flags/4x3/ru.svg" width="22" height="22"> '.GetLocalizedString("HEADER_LANGUAGE_SELECTOR_RUSSIAN") : '<img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" width="22" height="22"> '.GetLocalizedString("HEADER_LANGUAGE_SELECTOR_ENGLISH") ?></a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item" onclick="location.href='../localization/change-language.php?l=en&r=' + location.href"><img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" width="22" height="22"> <?= GetLocalizedString("HEADER_LANGUAGE_SELECTOR_ENGLISH"); ?></a>
                                <a href="#" class="dropdown-item" onclick="location.href='../localization/change-language.php?l=ru&r=' + location.href"><img src="https://flagicons.lipis.dev/flags/4x3/ru.svg" width="22" height="22"> <?= GetLocalizedString("HEADER_LANGUAGE_SELECTOR_RUSSIAN"); ?></a>
                            </div>
                        </div>
                    </ul>
                    <span class="ms-md-2">
                        <button type="button" onclick="location.href='<?= $loggedIn ? "../dashboard" : "../auth/login" ?>';" class="btn btn-primary"><?= $loggedIn ? GetLocalizedString("HEADER_DASHBOARD") : GetLocalizedString("HEADER_LOG_IN") ?></button>
                        <button type="button" onclick="location.href='<?= $loggedIn ? "../auth/logout" : "../auth/signup" ?>';" class="btn btn-primary"><?= $loggedIn ? GetLocalizedString("HEADER_LOG_OUT") : GetLocalizedString("HEADER_SIGN_UP") ?></button>
                    </span>
                </div>
            </div>
        </nav>

        <div class="full-height-container d-flex flex-column justify-content-center align-items-center text-center" data-aos="fade" data-aos-duration="1000" data-aos-once="true">
            <h1 class="fw-bold"><?= GetLocalizedString("HELP_FEATURES"); ?></h1>

            <div class="selector-bg p-2 mt-4">
                <div class="selector-name-bg">
                    <p class="fw-bold mb-1"><?= GetLocalizedString("GAME"); ?></p>
                </div>
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

            <div class="selector-bg p-2 mt-2">
                <div class="selector-name-bg">
                    <p class="fw-bold mb-1"><?= GetLocalizedString("CHEAT"); ?></p>
                </div>

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

            <?php
                foreach (GetAllCheats() as $cheat)
                    echo(file_get_contents("../assets/web/html/features/".$currentLanguage.'/'.$cheat["ID"].".html"));
            ?>
        </div>

        <footer class="text-center py-4">
            <div class="container">
                <div class="row row-cols-2 row-cols-lg-3 align-items-center">
                    <div class="col">
                        <p class="my-2">Copyright © 2022 maple.software</p>
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
                            <li class="list-inline-item"><a href="../legal/terms-of-service"><?= GetLocalizedString("FOOTER_TERMS_OF_SERVICE"); ?></a></li>
                            <li class="list-inline-item"><a href="../legal/privacy-policy"><?= GetLocalizedString("FOOTER_PRIVACY_POLICY"); ?></a></li>
                            <li class="list-inline-item"><a href="../legal/contacts"><?= GetLocalizedString("FOOTER_CONTACTS"); ?></a></li>
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
                $('#' + i + '-features').attr('hidden', true);

            $('#' + value + '-features').attr('hidden', false);
        }
    </script>
</html>
