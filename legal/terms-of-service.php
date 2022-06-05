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

        <title>Terms of Service - Maple</title>
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
                                <a href="../help/faq" class="dropdown-item">FAQ</a>
                                <a href="../help/payment-issues" class="dropdown-item">Payment issues</a>
                                <a href="../help/software-issues" class="dropdown-item">Software issues</a>
                                <a href="../help/report-a-bug" class="dropdown-item">Report a bug</a>
                                <a href="../help/suggest-a-feature" class="dropdown-item">Suggest a feature</a>
                                <a href="../help/resellers" class="dropdown-item">Resellers</a>
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
            <h1 class="fw-bold">Terms of Service</h1>

            <div class="info-container text-start mt-4">
                <div class="p-4">
                    <p>By accessing this web site, you are agreeing to be bound by this site’s Terms and Conditions of Use, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site’s content. This web site is only available to users who are at least 13 years old. If you are younger than this, please do not register for this site. If you register for this site, you represent that you are this age or older. Materials contained in this site are protected by applicable copyright and trade mark law.</p>
                    <h4 class="fw-bold">Use License</h4>
                    <p>Permission is granted to temporarily download one copy of the materials (information or software) on this web site for personal, noncommercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not</p>
                    <ul>
                        <li>Modify or copy the materials.</li>
                        <li>Use the materials for any commercial purpose or for any public display (commercial or noncommercial).</li>
                        <li>Use our services if you, or someone you are in connection with, are associated with anti-cheat development.</li>
                        <li>Attempt to decompile or reverse engineer any software contained on this web site.</li>
                        <li>Share your account with a 3rd-party.</li>
                        <li>Remove any copyright or other proprietary notations from the materials.</li>
                        <li>Transfer the materials to another person or “mirror” the materials on any other server.</li>
                    </ul>
                    <p>Each copy of the materials is private for the user that acquires it. In case that we find a borrowed/stolen copy, we will invalidate that copy for future updates.</p>
                    <p>This license shall automatically terminate if you violate any of these restrictions and may be terminated by the operator of this web site at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession, whether in electronic or print format.</p>
                    <h4 class="fw-bold">Disclaimer</h4>
                    <p>The materials on this web site are provided “as is.” The author of the site makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular use, or non-infringement of intellectual property or other violation of rights. Further, the site’s maintainer does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on this Internet web site or otherwise relating to such materials or on any sites linked to this site.</p>
                    <p>We reserve the right to completely block your access to our services without giving any reason.</p>
                    <p>These terms may be changed at any time without notice.</p>
                    <h4 class="fw-bold">Refund Policy</h4>
                    <p>All purchases are eligible for a refund within 3 days of purchase or exchange, depending on your case.</p>
                    <p>Refunds are applicable in the following cases:</p>
                    <ul>
                        <li>Maple doesn't work on your PC. (One of the administrators will ask you to reproduce the issue before proceeding with the refund.)</li>
                        <li>You haven't exchanged the purchased Maple Points.</li>
                    </ul>
                    <p>However, if you believe your situation warrants an exception, you can <a href="../help/contact-us">contact us</a>.</p>
                    <br>
                    <p class="m-0">If you wish to exchange the product that you originally exchanged for another product, or if you exchanged for the wrong product, please <a href="../help/contact-us">contact us</a>. You're eligible to do so within 3 days of the original exchange.</p>
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
