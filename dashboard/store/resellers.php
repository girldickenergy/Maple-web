<?php
    require_once "../../backend/database/usersDatabase.php";
    require_once "../../backend/database/sessionsDatabase.php";
    require_once "../../backend/database/resellersDatabase.php";

    $currentSession = GetCurrentSession();
    if ($currentSession == null)
    {
        header("Location: ../../auth/login");
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
        header("Location: ../banned");
        die();
    }

    $resellers = GetAllResellers();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Resellers - Maple</title>
        <link rel="icon" href="../../assets/web/images/mapleleaf.svg?v=1.4">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/web/dependencies/bootstrap/css/bootstrap.min.css?v=1.4">
        <link rel="stylesheet" href="../../assets/web/dependencies/aos/css/aos.css?v=1.4"/>
        <link rel="stylesheet" href="../../assets/web/css/main.css?v=1.6">
        <link rel="stylesheet" href="../../assets/web/css/info.css?v=1.5">
        <link rel="stylesheet" href="../../assets/web/css/resellers.css?v=1.1">

        <script src="../../assets/web/dependencies/bootstrap/js/bootstrap.min.js?v=1.4"></script>
        <script src="../../assets/web/dependencies/jquery/js/jquery-3.6.0.min.js?v=1.4"></script>
        <script src="../../assets/web/dependencies/aos/js/aos.js?v=1.4"></script>
        <script src="https://kit.fontawesome.com/d1269851a5.js?v=1.4" crossorigin="anonymous"></script>
    </head>

    <body>
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark py-3">
            <div class="container">
                <a class="navbar-brand" href="https://maple.software">
                    <div class="d-flex align-items-center">
                        <span class="navbar-brand-logo">
                                <img src="../../assets/web/images/mapleleaf.svg?v=1.4" width="30" height="30" class="d-inline-block align-top" alt="">
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
                        <li class="nav-item"><a class="nav-link" href="../../dashboard"><i class="fa-solid fa-user"></i> Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="../store"><i class="fa-solid fa-shopping-cart"></i> Store</a></li>
                        <li class="nav-item"><a class="nav-link" href="../settings"><i class="fa-solid fa-tools"></i> Settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="../status"><i class="fa-solid fa-shield-halved"></i> Status</a></li>
                        <div class="nav-item dropdown">
                            <a href="../../help" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa-solid fa-headset"></i> Help</a>
                            <div class="dropdown-menu">
                                <a href="../../help/getting-started" class="dropdown-item">Getting started</a>
                                <a href="../../help/features" class="dropdown-item">Features</a>
                                <a href="../../help/faq" class="dropdown-item">FAQ</a>
                                <a href="../../help/payment-issues" class="dropdown-item">Payment issues</a>
                                <a href="../../help/software-issues" class="dropdown-item">Software issues</a>
                                <a href="../../help/report-a-bug" class="dropdown-item">Report a bug</a>
                                <a href="../../help/suggest-a-feature" class="dropdown-item">Suggest a feature</a>
                                <a href="../../help/contact-us" class="dropdown-item">No, really, I need help!</a>
                            </div>
                        </div>
                    </ul>
                    <span class="ms-md-2">
                        <button class="btn btn-primary" type="button" onclick="location.href='../../auth/logout';">Log out</button>
                    </span>
                </div>
            </div>
        </nav>

        <div class="full-height-container d-flex flex-column justify-content-center align-items-center text-center" data-aos="fade" data-aos-duration="1000" data-aos-once="true">
            <h1 class="fw-bold">Resellers</h1>

            <div class="info-container text-start mt-4">
                <div class="p-4">
                    <p>Please don't spam our resellers if they didn't respond as fast as you'd wanted to. Wait patiently for a response instead. They have lives too.</p>
                    <p>If you think one of our resellers is charging way too much (more than the original amount + their fee), please <a href="../../help/contact-us">report this</a> immediately.</p>
                    <p class="m-0">Also please triple check reseller's discord handle and ID before proceeding with the payment. We are not responsible for scams done by unofficial resellers.</p>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 mt-4 gy-4 w-100 justify-content-center">
                <?php
                    if (!empty($resellers))
                    {
                        require_once "../../backend/discord/discordAPI.php";

                        foreach($resellers as $reseller)
                        {
                            $avatarUrl = "../../assets/web/images/dashboard/avatar.png";
                            $discordID = $reseller["DiscordID"];
                            if ($discordID != NULL)
                            {
                                $avatarHash = getUserAvatarHash($discordID);
                                if ($avatarHash != NULL && !empty($avatarHash))
                                    $avatarUrl = "https://cdn.discordapp.com/avatars/".$discordID."/".$avatarHash.".png";
                            }

                            $discordHandle = GetUserFullNameFromID($reseller["DiscordID"]);
                            $paymentMethods = preg_split("/\r\n|\n|\r/", $reseller["PaymentMethods"]);

                            echo('<div class="col">
                                      <div class="reseller-badge">
                                          <div class="d-flex p-3">
                                              <img class="reseller-avatar me-3 fit-cover" width="64" height="64" src="'.$avatarUrl.'">
                                              <div class="text-start">
                                                  <p class="m-0"><b>Discord Username: </b>'.((empty($discordHandle) || $discordHandle == NULL) ? "Unknown" : $discordHandle).'</p>
                                                  <p class="m-0"><b>Discord ID: </b>'.$reseller["DiscordID"].'</p>
                                                  <p class="m-0"><b>Payment Methods: </b></p>
                                                  <ul class="m-0">');
                                                      foreach ($paymentMethods as $paymentMethod)
                                                          echo('<li class="m-0">'.$paymentMethod.'</li>');
                            echo('                </ul>
                                                  <p class="m-0"><b>Fee: </b>'.$reseller["Fee"].'%</p>
                                                  <p class="m-0"><b>Timezone: </b>'.$reseller["Timezone"].'</p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>');
                        }
                    }
                    else
                    {
                        echo('<div class="col" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                                      <p class="text-center">None yet!</p>
                              </div>');
                    }
                ?>
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
                                <a class="discord-icon" href="../../discord"><i class="fa-brands fa-discord"></i></a>
                                <a class="youtube-icon" href="https://www.youtube.com/channel/UCzyZrNQWaF3iSdqBX4ls42g"><i class="fa-brands fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-inline my-2">
                            <li class="list-inline-item"><a href="../../legal/terms-of-service">Terms of Service</a></li>
                            <li class="list-inline-item"><a href="../../legal/privacy-policy">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="../../legal/contacts">Contacts</a></li>
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
