<?php
    require_once "../backend/database/sessionsDatabase.php";

    $loggedIn = false;
    $currentSession = GetCurrentSession();
    if ($currentSession != null)
    {
        $loggedIn = true;
        SetSessionActivity($currentSession["SessionToken"], gmdate('Y-m-d H:i:s', time()));
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Cookie usage - Maple</title>
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
                        <button type="button" onclick="location.href='<?= $loggedIn ? "../dashboard" : "../auth/login" ?>';" class="btn btn-primary"><?= $loggedIn ? "Dashboard" : "Log in" ?></button>
                        <button type="button" onclick="location.href='<?= $loggedIn ? "../auth/logout" : "../auth/signup" ?>';" class="btn btn-primary"><?= $loggedIn ? "Log out" : "Sign up" ?></button>
                    </span>
                </div>
            </div>
        </nav>

        <div class="full-height-container d-flex flex-column justify-content-center align-items-center text-center" data-aos="fade" data-aos-duration="1000" data-aos-once="true">
            <h1 class="fw-bold">Cookie usage</h1>

            <div class="info-container text-start mt-4">
                <div class="p-4">
                    <p>This page discusses how cookies are used by this site. If you continue to use this site, you are consenting to our use of cookies.</p>
                    <h4 class="fw-bold">What are cookies?</h4>
                    <p>Cookies are small text files stored on your computer by your web browser at the request of a site you"re viewing. This allows the site you"re viewing to remember things about you, such as your preferences and history or to keep you logged in.</p>
                    <p>Cookies may be stored on your computer for a short time (such as only while your browser is open) or for an extended period of time, even years. Cookies not set by this site will not be accessible to us.</p>
                    <h4 class="fw-bold">Our cookie usage</h4>
                    <p>This site uses cookies for numerous things, including:</p>
                    <ul>
                        <li>Registration and maintaining your preferences. This includes ensuring that you can stay logged in and keeping the site in the language or appearance that you requested.</li>
                        <li>Analytics. This allows us to determine how people are using the site and improve it.</li>
                    </ul>
                    <h4 class="fw-bold">Standard cookies we set</h4>
                    <p>These are the main cookies we set during normal operation of the software.</p>
                    <ul>
                        <li>
                            <b>m_Session</b>
                            <ul>
                                <li>Stores a key, unique to you, which allows us to keep you logged in as you navigate from page to page.</li>
                            </ul>
                        </li>
                    </ul>
                    <h4 class="fw-bold">Additional cookies and those set by third parties</h4>
                    <p>Additional cookies may be set during the use of the site to remember information as certain actions are being performed, or remembering certain preferences.</p>
                    <p>Other cookies may be set by third party service providers which may provide information such as tracking anonymously which users are visiting the site, or set by content embedded into some pages, such as YouTube or other media service providers.</p>
                    <h4 class="fw-bold">Removing/disabling cookies</h4>
                    <p>Managing your cookies and cookie preferences must be done from within your browser"s options/preferences. Here is a list of guides on how to do this for popular browser software:</p>
                    <ul>
                        <li><a href="https://support.microsoft.com/en-gb/help/17442/windows-internet-explorer-delete-manage-cookies">Microsoft Internet Explorer</a></li>
                        <li><a href="https://privacy.microsoft.com/en-us/windows-10-microsoft-edge-and-privacy">Microsoft Edge</a></li>
                        <li><a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer">Mozilla Firefox</a></li>
                        <li><a href="https://support.google.com/chrome/answer/95647?hl=en">Google Chrome</a></li>
                        <li><a href="https://support.apple.com/en-gb/guide/safari/manage-cookies-and-website-data-sfri11471/mac">Safari for macOS</a></li>
                        <li><a href="https://support.apple.com/en-gb/HT201265">Safari for iOS</a></li>
                    </ul>
                    <h4 class="fw-bold">More information about cookies</h4>
                    <p class="m-0">To learn more about cookies, and find more information about blocking certain types of cookies, please visit the <a href="https://ico.org.uk/for-the-public/online/cookies/">ICO website Cookies page</a>.</p>
                    <p class="fw-bold m-0 pt-4">Updated on October 16th, 2022</p>
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
                            <li class="list-inline-item"><a href="terms-of-service">Terms of Service</a></li>
                            <li class="list-inline-item"><a href="privacy-policy">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="contacts">Contacts</a></li>
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
