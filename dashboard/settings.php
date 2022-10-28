<?php
    require_once "../backend/database/usersDatabase.php";
    require_once "../backend/database/sessionsDatabase.php";
    require_once "../backend/datetime/datetimeUtilities.php";
    require_once "../backend/discord/discordAPI.php";

    $currentSession = GetCurrentSession();
    if ($currentSession == null)
    {
        header("Location: ../auth/login");
        die();
    }
    else
        SetSessionActivity($currentSession["SessionToken"], gmdate('Y-m-d H:i:s', time()));

    $self = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
    $self = $self[0];

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

    $sessions = array();
    foreach(GetAllUserSessions($user["ID"]) as $session)
    {
        $sessions[] = array(
            "IsCurrent" => $session["SessionToken"] == $currentSession["SessionToken"],
            "Icon" => $session["Type"] == SESSION_WEB_PC ? "fa-solid fa-desktop" : ($session["Type"] == SESSION_WEB_MOBILE ? "fa-solid fa-mobile-screen-button" : "fa-brands fa-canadian-maple-leaf"),
            "IP" => $session["IP"],
            "Country" => json_decode(file_get_contents("http://ipinfo.io/{$session["IP"]}/json"))->country,
            "LastActivity" => GetHumanReadableDateTimeDifference($session["ActiveAt"], gmdate("Y-m-d H:i:s", time())),
            "Token" => $session["SessionToken"],
            "Checksum" => md5($session["UserID"]."fuckmylife".$session["SessionToken"])
        );
    }

    $discordLinked = $user != null && $user["DiscordID"] != null;
    $discordUsername = $discordLinked ? GetUserFullNameFromID($user["DiscordID"]) : "No account linked";

    $status = "";
    $currentPasswordFailure = false;
    $newPasswordFailure = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_POST["terminate"]))
        {
            foreach($sessions as $key => $session)
            {
                if ($session["Checksum"] == $_POST["terminate"])
                {
                    TerminateSession($session["Token"]);
                    unset($sessions[$key]);

                    if ($session["IsCurrent"])
                    {
                        header("Location: https://maple.software/");
                        die();
                    }

                    break;
                }
            }

            $status = "Session has been terminated.";
        }
        else if (isset($_POST["terminateAllSessions"]))
        {
            TerminateAllSessions($currentSession["UserID"]);
            $status = "All sessions except this one have been terminated.";
        }
        else if (isset($_POST["linkDiscord"]) && $user != null)
        {
            if (!$discordLinked)
            {
                RedirectToDiscordOAUTH();
            }
            else
            {
                SetDiscordID($currentSession["UserID"], NULL);
                header('Location: ' . $self);
            }
        }
        else if (isset($_POST["changePassword"]))
        {
            $result = changePassword($currentSession["UserID"], $_POST["currentPassword"], $_POST["newPassword"], $_POST["newPasswordConfirmation"]);
            if ($result == 0)
            {
                $status = "Your password has been updated.";
            }
            else if ($result == 1)
            {
                $currentPasswordFailure = true;
                $newPasswordFailure = true;
            }
            else if ($result == 2)
            {
                $currentPasswordFailure = true;
            }
            else
            {
                $newPasswordFailure = true;
            }
        }
    }
    else if (isset($_GET["code"]) && $user != null && !$discordLinked)
    {
        SetDiscordID($currentSession["UserID"], getUserIDFromCode($_GET["code"]));
        header('Location: ' . $self);
    }

    function changePassword($userID, $currentPassword, $newPassword, $newPasswordConfirmation)
    {
        $user = GetUserByID($userID);
        if ($user == null)
            return 1;

        if (!password_verify($currentPassword, $user["Password"]))
            return 2;

        if ($newPassword != $newPasswordConfirmation)
        {
            return 3;
        }

        SetPassword($userID, $newPassword);
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Settings - Maple</title>
        <link rel="icon" href="../assets/web/images/mapleleaf.svg?v=1.4">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/web/dependencies/bootstrap/css/bootstrap.min.css?v=1.4">
        <link rel="stylesheet" href="../assets/web/dependencies/aos/css/aos.css?v=1.4"/>
        <link rel="stylesheet" href="../assets/web/css/main.css?v=1.9">
        <link rel="stylesheet" href="../assets/web/css/settings.css?v=1.2">

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
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-tools"></i> Settings</a></li>
                    <li class="nav-item"><a class="nav-link" href="status"><i class="fa-solid fa-shield-halved"></i> Status</a></li>
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

    <div class="modal fade" id="sessionsModal" tabindex="-1" aria-labelledby="sessionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="sessionsModalLabel">Active sessions</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-100">
                        <div class="row row-cols-1 justify-content-start gx-0 gy-2">
                            <?php
                                foreach($sessions as $session)
                                {
                                    echo('<div class="col-12 position-relative session-bg">
                                              '.($session["IsCurrent"] ? '<span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-success mt-2 ms-4">Current</span>' : '').'
                                              <div class="row p-4">
                                                  <div class="col-6 col-md-8 d-flex align-items-center">
                                                      <i class="'.$session["Icon"].' me-3 session-icon"></i>
                                                      <div>
                                                          <h5 class="fw-bold mb-0">'.$session["IP"].', '.$session["Country"].'</h5>
                                                          <p class="fw-bold mb-0">Last activity: '.$session["LastActivity"].'</p>
                                                      </div>
                                                  </div>
                                              <div class="col-6 col-md-4 d-flex justify-content-end align-items-center">
                                                  <form action="'.$self.'" method="post">
                                                      <button class="btn btn-primary" type="submit" name="terminate" value="'.$session["Checksum"].'">Terminate</button>
                                                  </form>
                                              </div>
                                          </div>
                                      </div>');
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="full-height-container d-flex flex-column justify-content-center align-items-center">
        <div class="alert alert-success" <?= $status == "" ? "hidden" : "" ?> data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">
            <?= $status ?>
        </div>

        <h1 class="fw-bold" data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">Settings</h1>

        <div class="row justify-content-center gy-4 mt-2">
            <div class="col-md-4 col-12" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                <div class="panel">
                    <div class="d-flex p-3">
                        <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div class="w-100">
                            <h3 class="fw-bold">Sessions</h3>
                            <form action="<?= $self ?>" method="post">
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#sessionsModal">Show active sessions</button>
                                <button type="submit" name="terminateAllSessions" class="btn btn-primary w-100 mt-2">Terminate all sessions</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                <div class="panel">
                    <div class="d-flex p-3">
                        <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                            <i class="fa-brands fa-discord"></i>
                        </div>
                        <div class="w-100">
                            <h3 class="fw-bold">Discord integration</h3>
                            <p class="m-0"><?=$discordUsername?></p>
                            <form action="<?= $self ?>" method="post">
                                <button type="submit" name="linkDiscord" class="btn btn-primary w-100 mt-3"><?= $discordLinked ? "Unlink" : "Link"?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                <div class="panel">
                    <div class="d-flex p-3">
                        <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                            <i class="fa-solid fa-key"></i>
                        </div>
                        <div class="w-100">
                            <h3 class="fw-bold">Password</h3>
                            <form action="<?= $self ?>" method="post">
                                <div>
                                    <p class="m-0">Current password</p>
                                    <input type="password" name="currentPassword" class="form-control" required>
                                    <p class="m-0 text-danger" <?= $currentPasswordFailure ? "" : "hidden"?>>Wrong password</p>
                                </div>

                                <div class="mt-3">
                                    <p class="m-0">New password</p>
                                    <input type="password" name="newPassword" class="form-control" required>
                                </div>

                                <div class="mt-3">
                                    <p class="m-0">Confirm new password</p>
                                    <input type="password" name="newPasswordConfirmation" class="form-control" required>
                                    <p class="m-0 text-danger" <?= $newPasswordFailure ? "" : "hidden"?>>Passwords don't match</p>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" name="changePassword" class="btn btn-primary w-100">Change password</button>
                                </div>
                            </form>
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
    </script>
</html>
