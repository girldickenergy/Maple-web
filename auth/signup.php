<?php
    require_once "../backend/database/usersDatabase.php";
    require_once "../backend/database/sessionsDatabase.php";

    $currentSession = GetCurrentSession();
    if ($currentSession != null)
    {
        header("Location: ../dashboard");
        die();
    }

    $self = explode(".", htmlspecialchars($_SERVER["PHP_SELF"]));
    $self = $self[0];

    $status = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
    {
        $status = signUp($_POST["username"], $_POST["email"], $_POST["password"], $_POST["passwordConfirmation"]);
        if ($status == 0)
        {
            header("Location: pendingActivation");
            die();
        }
    }

    function signUp($username, $email, $password, $passwordConfirmation)
    {
        require_once '../backend/captcha/recaptchaAPI.php';

        if (!checkCaptchaResponse($_POST["g-recaptcha-response"]))
            return 1;

        if (empty($username) || empty($email) || empty($password) || empty($passwordConfirmation))
            return 2;

        if (!preg_match("/^[a-zA-Z0-9- ]*$/", $username) || strlen($username) > 24 || strlen($username) < 3)
            return 3;

        if (GetUserByName($username) != null)
            return 4;

        if (GetUserByEmail($email) != null)
            return 5;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return 6;

        if ($password !== $passwordConfirmation)
            return 7;

        $uniqueHash = md5(rand(0,1000));
        if (!addUser($username, $email, $password, $uniqueHash))
            return 8;

        require_once '../backend/mail/mailAPI.php';

        SendEmailConfirmation($username, $email, $uniqueHash);

        $uid = GetUserByName($username)["ID"];
        $ip = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'];
        $isMobile = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));

        CreateSession($uid, $ip, $isMobile ? SESSION_WEB_MOBILE : SESSION_WEB_PC, gmdate('Y-m-d H:i:s', time() + (86400 * 30)));

        return 0;
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Sign up - Maple</title>
        <link rel="icon" href="../assets/web/images/mapleleaf.svg?v=1.6">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/web/dependencies/bootstrap/css/bootstrap.min.css?v=1.6">
        <link rel="stylesheet" href="../assets/web/dependencies/aos/css/aos.css?v=1.6"/>
        <link rel="stylesheet" href="../assets/web/dependencies/fontawesome/css/all.css">
        <link rel="stylesheet" href="../assets/web/css/main.css?v=1.6">
        <link rel="stylesheet" href="../assets/web/css/auth.css?v=1.8">

        <script src="../assets/web/dependencies/bootstrap/js/bootstrap.min.js?v=1.6"></script>
        <script src="../assets/web/dependencies/jquery/js/jquery-3.6.0.min.js?v=1.6"></script>
        <script src="../assets/web/dependencies/aos/js/aos.js?v=1.6"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>

    <body>
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark py-3">
            <div class="container">
                <a class="navbar-brand" href="https://maple.software">
                    <div class="d-flex align-items-center">
                        <span class="navbar-brand-logo">
                            <img src="../assets/web/images/mapleleaf.svg?v=1.6" width="30" height="30" class="d-inline-block align-top" alt="">
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
                        <button type="button" onclick="location.href='login';" class="btn btn-primary">Log in</button>
                    </span>
                </div>
            </div>
        </nav>

        <div class="full-height-container d-flex flex-column justify-content-center align-items-center text-center" data-aos="fade" data-aos-duration="1000" data-aos-once="true">
            <h1 class="fw-bold">Sign up</h1>
            <div class="auth-form mt-4">
                <div class="p-4 text-start">
                    <form action="<?= $self ?>" method="post">
                        <div>
                            <p class="m-0">Username</p>
                            <input type="text" name="username" class="form-control" required>
                            <p class="m-0 text-danger" <?= $status == 3 || $status == 4 ? "" : "hidden" ?>><?= $status == 3 ? "Invalid username" : "This username is already in use"?></p>
                        </div>

                        <div class="mt-3">
                            <p class="m-0">Email address</p>
                            <input type="text" name="email" class="form-control" required>
                            <p class="m-0 text-danger" <?= $status == 5 || $status == 6 ? "" : "hidden" ?>><?= $status == 5 ? "This email is already in use" : "Invalid email"?></p>
                        </div>

                        <div class="mt-3">
                            <p class="m-0">Password</p>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mt-3">
                            <p class="m-0">Confirm your password</p>
                            <input type="password" name="passwordConfirmation" class="form-control" required>
                            <p class="m-0 text-danger"  <?= $status == 7 ? "" : "hidden" ?>>Passwords don't match</p>
                        </div>

                        <div class="mt-2">
                            <input type="checkbox" required> I agree to the <a href="../legal/terms-of-service">Terms of Service</a>
                        </div>

                        <div class="mt-2">
                            <div class="g-recaptcha" data-sitekey="6Lf7MdYaAAAAAGYJwUeh2Tt7G9USbvvoa9MYDHsh"></div>
                            <p class="m-0 text-danger" <?= $status == 1 ? "" : "hidden" ?>>We were unable to verify that you are human</p>
                        </div>

                        <div class="mt-3">
                            <button type="submit" name="submit" class="btn btn-primary w-100">Sign up</button>
                            <p class="m-0 text-danger" <?= $status == 2 || $status == 8 ? "" : "hidden" ?>><?= $status == 2 ? "Please provide a valid input" : "Unknown error occurred"?></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer class="text-center py-4">
            <div class="container">
                <div class="row row-cols-2 row-cols-lg-3">
                    <div class="col">
                        <p class="my-2">Copyright © 2024 maple.software</p>
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
