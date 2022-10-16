<?php
    require_once "../backend/localization/localizationHandler.php";
    require_once "../backend/database/usersDatabase.php";
    require_once "../backend/database/sessionsDatabase.php";
    require_once "../backend/database/subscriptionsDatabase.php";
    require_once "../backend/discord/discordAPI.php";

    $currentLanguage = GetLanguage();

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

    if (($user["Permissions"] & perm_activated) == 0)
    {
        header("Location: ../auth/pendingActivation");
        die();
    }

    if ($user["Permissions"] & perm_banned)
    {
        header("Location: banned");
        die();
    }
    
    $username = $user["Username"];
    $uid = $currentSession["UserID"];
    $creationDate = date("F jS, Y", strtotime($user["CreatedAt"]));

    $avatarUrl = "../assets/web/images/dashboard/avatar.png";
    $discordID = $user["DiscordID"];
    if ($discordID != NULL)
    {
        $avatarHash = getUserAvatarHash($discordID);
        if ($avatarHash != NULL && !empty($avatarHash))
            $avatarUrl = "https://cdn.discordapp.com/avatars/".$discordID."/".$avatarHash.".png";
    }

    $subscriptions = GetAllUserSubscriptions($uid);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title><?= GetLocalizedString("TITLE_PROFILE").' - Maple' ?></title>
        <link rel="icon" href="../assets/web/images/mapleleaf.svg?v=1.4">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/web/dependencies/bootstrap/css/bootstrap.min.css?v=1.4">
        <link rel="stylesheet" href="../assets/web/dependencies/aos/css/aos.css?v=1.4"/>
        <link rel="stylesheet" href="../assets/web/css/main.css?v=1.7">
        <link rel="stylesheet" href="../assets/web/css/dashboard.css?v=1.4">

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
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-user"></i> <?= GetLocalizedString("DASHBOARD_HEADER_PROFILE"); ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="store"><i class="fa-solid fa-shopping-cart"></i> <?= GetLocalizedString("DASHBOARD_HEADER_STORE"); ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="settings"><i class="fa-solid fa-tools"></i> <?= GetLocalizedString("DASHBOARD_HEADER_SETTINGS"); ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="status"><i class="fa-solid fa-shield-halved"></i> <?= GetLocalizedString("DASHBOARD_HEADER_STATUS"); ?></a></li>
                        <div class="nav-item dropdown">
                            <a href="../help" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa-solid fa-headset"></i> <?= GetLocalizedString("HEADER_HELP"); ?></a>
                            <div class="dropdown-menu">
                                <a href="../help/getting-started" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_GETTING_STARTED"); ?></a>
                                <a href="../help/features" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_FEATURES"); ?></a>
                                <a href="../help/faq" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_FAQ"); ?></a>
                                <a href="../help/payment-issues" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_PAYMENT_ISSUES"); ?></a>
                                <a href="../help/software-issues" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_SOFTWARE_ISSUES"); ?></a>
                                <a href="../help/report-a-bug" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_REPORT_A_BUG"); ?></a>
                                <a href="../help/suggest-a-feature" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_SUGGEST_A_FEATURE"); ?></a>
                                <a href="../help/contact-us" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_CONTACT_SUPPORT"); ?></a>
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
                        <button type="button" onclick="location.href='../auth/logout';" class="btn btn-primary"><?= GetLocalizedString("HEADER_LOG_OUT"); ?></button>
                    </span>
                </div>
            </div>
        </nav>

        <div class="full-height-container d-flex flex-column justify-content-center align-items-center">
            <div data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">
                <div class="user-badge d-flex justify-content-center align-items-center p-4">
                    <img class="avatar me-3 fit-cover" width="64" height="64" src="<?= $avatarUrl ?>">
                    <div>
                        <h5 class="fw-bold mb-0"><?= GetLocalizedString("DASHBOARD_PROFILE_WELCOME_BACK") ?></h5>
                        <h5 class="username fw-bold mb-0"><?= $username ?></h5>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center gy-4 mt-2">
                <div class="col-md-4 col-sm-12" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold">User ID</h3>
                                <p class="m-0"><?= $uid ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold"><?= GetLocalizedString("DASHBOARD_PROFILE_JOINED_ON") ?></h3>
                                <p class="m-0"><?= GetLocalizedDate($creationDate) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-key"></i>
                            </div>
                            <div class="subscription-status-container">
                                <h3 class="fw-bold"><?= GetLocalizedString("DASHBOARD_PROFILE_SUBSCRIPTION_STATUS") ?></h3>
                                <?= empty($subscriptions) ? '<p>'.GetLocalizedString("DASHBOARD_PROFILE_SUBSCRIPTION_STATUS_NONE").'</p>' : '' ?>
                                <div class="row row-cols-1 justify-content-start gx-0 gy-2">
                                    <?php
                                        require_once "../backend/database/gamesDatabase.php";
                                        require_once "../backend/database/cheatsDatabase.php";
                                        require_once "../backend/datetime/datetimeUtilities.php";

                                        foreach ($subscriptions as $subscription)
                                        {
                                            $cheat = GetCheatByID($subscription["CheatID"]);
                                            $game = GetGameByID($cheat["GameID"]);

                                            $expiry = GetHumanReadableSubscriptionExpiration($subscription["ExpiresOn"]);
                                            $progress = 100;
                                            if ($subscription["StartedOn"] != NULL && $expiry != "lifetime")
                                            {
                                                $duration = ceil(abs(strtotime($subscription["ExpiresOn"]) - strtotime($subscription["StartedOn"])) / 86400);
                                                $remainingDuration = ceil(abs(strtotime($subscription["ExpiresOn"]) - strtotime(gmdate('Y-m-d'))) / 86400);
                                                $progress = $remainingDuration / $duration * 100;
                                            }

                                            echo('<div class="col-12 subscription-bg">
                                                    <div class="row p-4">
                                                          <div class="col-6 col-md-4 d-flex align-items-center">
                                                              <img class="me-3 fit-cover" width="24" height="24" src="../assets/games/icons/'.$game["ID"].'.png">
                                                              <div>
                                                                  <h5 class="fw-bold mb-0">'.($game == NULL ? "unknown game" : $game["Name"]).'</h5>
                                                                  <p class="cheat-name fw-bold mb-0">'.($cheat == NULL ? "unknown cheat" : $cheat["Name"]).'</p>
                                                              </div>
                                                          </div>
                                                          <div class="col-6 col-md-8 d-flex justify-content-start align-items-center">
                                                              <div class="subscription-progress-container">
                                                                  <p class="mb-0">'.GetLocalizedString("DASHBOARD_PROFILE_SUBSCRIPTION_STATUS_EXPIRES_ON").' '.GetLocalizedDate($expiry).'</p>
                                                                  <div class="subscription-progress-bg">
                                                                      <div class="subscription-progress-fg" style="width:'.$progress.'%;"></div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>');
                                        }
                                    ?>
                                    <?php
                                        if (!empty($subscriptions))
                                            echo "<button class='btn btn-primary' type='button'"."onclick='".'location.href="loader"'.";'><i class='fa-solid fa-download'></i> ".GetLocalizedString("DASHBOARD_PROFILE_SUBSCRIPTION_STATUS_DOWNLOAD_LOADER")."</button>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    </script>
</html>
