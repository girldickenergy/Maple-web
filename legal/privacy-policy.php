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

        <title>Privacy policy - Maple</title>
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
            <h1 class="fw-bold">Privacy policy</h1>

            <div class="info-container text-start mt-4">
                <div class="p-4">
                    <p>We are Maple ("we", "our", "us"). We’re committed to protecting and respecting your privacy. If you have questions about your personal information please <a href="../help/contact-us">contact us</a>.</p>
                    <h4 class="fw-bold">What information we hold about you</h4>
                    <p>The type of data that we collect and process includes:</p>
                    <ul>
                        <li>Your name or username.</li>
                        <li>Your email address.</li>
                        <li>Your IP address.</li>
                    </ul>
                    <p>We collect some or all of this information in the following cases:</p>
                    <ul>
                        <li>You register as a member on this site.</li>
                        <li>You browse this site. See "Cookie policy" below.</li>
                        <li>You fill out fields on your profile.</li>
                    </ul>
                    <h4 class="fw-bold">How your personal information is used</h4>
                    <p>We may use your personal information in the following ways:</p>
                    <ul>
                        <li>For the purposes of making you a registered member of our site.</li>
                        <li>We may use your email address to inform you of activity on our site.</li>
                        <li>Your IP address is recorded when you perform certain actions on our site. Your IP address is never publicly visible.</li>
                    </ul>
                    <h4 class="fw-bold">Other ways we may use your personal information.</h4>
                    <p>In addition to notifying you of activity on our site which may be relevant to you, from time to time we may wish to communicate with all members any important information such as newsletters or announcements by email. You can opt-in to or opt-out of such emails in your profile.</p>
                    <p>We may collect non-personally identifiable information about you in the course of your interaction with our site. This information may include technical information about the browser or type of device you're using. This information will be used purely for the purposes of analytics and tracking the number of visitors to our site.</p>
                    <h4 class="fw-bold">Keeping your data secure</h4>
                    <p>We are committed to ensuring that any information you provide to us is secure. In order to prevent unauthorized access or disclosure, we have put in place suitable measures and procedures to safeguard and secure the information that we collect.</p>
                    <h4 class="fw-bold">Cookie policy</h4>
                    <p>Cookies are small text files which are set by us on your computer which allow us to provide certain functionality on our site, such as being able to log in, or remembering certain preferences.</p>
                    <p>We have a detailed cookie policy and more information about the cookies that we set on <a href="cookie-usage">this page</a>.</p>
                    <h4 class="fw-bold">Rights</h4>
                    <p>You have a right to access the personal data we hold about you or obtain a copy of it. To do so please <a href="../help/contact-us">contact us</a>. If you believe that the information we hold for you is incomplete or inaccurate, you may <a href="../help/contact-us">contact us</a> to ask us to complete or correct that information.</p>
                    <p>You also have the right to request the erasure of your personal data. Please <a href="../help/contact-us">contact us</a> if you would like us to remove your personal data.</p>
                    <h4 class="fw-bold">Acceptance of this policy</h4>
                    <p>Continued use of our site signifies your acceptance of this policy. If you do not accept the policy then please do not use this site. When registering we will further request your explicit acceptance of the privacy policy.</p>
                    <h4 class="fw-bold">Changes to this policy</h4>
                    <p>We may make changes to this policy at any time. You may be asked to review and re-accept the information in this policy if it changes in the future.</p>
                    <h4 class="fw-bold">CAPTCHA Policy</h4>
                    <p class="m-0">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">privacy policy</a> and <a href="https://policies.google.com/terms">terms of service</a> apply.</p>
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
