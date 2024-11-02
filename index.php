<?php
    require_once "backend/discord/discordAPI.php";

    require_once "backend/database/sessionsDatabase.php";
    require_once "backend/database/gamesDatabase.php";
    require_once "backend/database/cheatsDatabase.php";
    require_once "backend/database/testimonialsDatabase.php";

    $loggedIn = false;
    $currentSession = GetCurrentSession();
    if ($currentSession != null)
    {
        $loggedIn = true;
        SetSessionActivity($currentSession["SessionToken"], gmdate('Y-m-d H:i:s', time()));
    }

    $games = GetAllGames();
    $cheats = GetAllCheats();

    $testimonials = array();
    foreach(GetAllTestimonials() as $testimony)
    {
        $avatarUrl = "../assets/web/images/dashboard/avatar.png";
        $discordID = $testimony[0];
        $username = "";
        if ($discordID != NULL)
        {
            $discordUserInfo = GetDiscordUserInfo($discordID);

            $username = $discordUserInfo->username;
            if (empty($username))
                $username = "Maple user";

            $avatarHash = $discordUserInfo->avatar;
            if ($avatarHash != NULL && !empty($avatarHash))
                $avatarUrl = "https://cdn.discordapp.com/avatars/".$discordID."/".$avatarHash.".png";
        }

        $testimonials[] = array(
            "Username" => $username,
            "AvatarURL" => $avatarUrl,
            "Text" => $testimony[1],
            "AddedOn" => date("F jS, Y", strtotime($testimony[2])));
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Home - Maple</title>
        <meta name="description" content="Maple is the leading provider in the cheating industry primarily focused on osu! cheats right now. Maple's osu! cheat features Relax, Aim Assist, Timewarp, Replay Bot, and more.">
        <link rel="icon" href="assets/web/images/mapleleaf.svg?v1.7">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/web/dependencies/bootstrap/css/bootstrap.min.css?v1.7">
        <link rel="stylesheet" href="assets/web/dependencies/aos/css/aos.css?v1.7"/>
        <link rel="stylesheet" href="assets/web/dependencies/fontawesome/css/all.css">
        <link rel="stylesheet" href="assets/web/css/main.css?v=1.8">
        <link rel="stylesheet" href="assets/web/css/index.css?v=1.7">

        <script src="assets/web/dependencies/bootstrap/js/bootstrap.min.js?v1.7"></script>
        <script src="assets/web/dependencies/jquery/js/jquery-3.6.0.min.js?v1.7"></script>
        <script src="assets/web/dependencies/aos/js/aos.js?v1.7"></script>
    </head>

    <body>
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark py-3">
            <div class="container">
                <a class="navbar-brand" href="https://maple.software">
                    <div class="d-flex align-items-center">
                        <span class="navbar-brand-logo">
                                <img src="assets/web/images/mapleleaf.svg?v1.7" width="30" height="30" class="d-inline-block align-top" alt="">
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
                        <li class="nav-item"><a class="nav-link" href="#why-maple"><i class="fa-solid fa-thumbs-up"></i> Why Maple?</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pricing"><i class="fa-solid fa-money-bills"></i> Pricing</a></li>
                        <li class="nav-item"><a class="nav-link" href="#testimonials"><i class="fa-solid fa-comments"></i> Testimonials</a></li>
                        <div class="nav-item dropdown">
                            <a href="help" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa-solid fa-headset"></i> Help</a>
                            <div class="dropdown-menu">
                                <a href="help/getting-started" class="dropdown-item">Getting started</a>
                                <a href="help/features" class="dropdown-item">Features</a>
                                <a href="help/faq" class="dropdown-item">FAQ</a>
                                <a href="help/payment-issues" class="dropdown-item">Payment issues</a>
                                <a href="help/software-issues" class="dropdown-item">Software issues</a>
                                <a href="help/report-a-bug" class="dropdown-item">Report a bug</a>
                                <a href="help/suggest-a-feature" class="dropdown-item">Suggest a feature</a>
                                <a href="https://maple-software.gitbook.io/maple.software" class="dropdown-item">Maple Mega-Guide</a>
                                <a href="help/contact-us" class="dropdown-item">No, really, I need help!</a>
                            </div>
                        </div>
                    </ul>
                    <span class="ms-md-2">
                        <button type="button" onclick="location.href='<?= $loggedIn ? "dashboard" : "auth/login" ?>';" class="btn btn-primary"><?= $loggedIn ? "Dashboard" : "Log in" ?></button>
                        <button type="button" onclick="location.href='<?= $loggedIn ? "auth/logout" : "auth/signup" ?>';" class="btn btn-primary"><?= $loggedIn ? "Log out" : "Sign up" ?></button>
                    </span>
                </div>
            </div>
        </nav>

        <div class="container py-4 py-xl-5">
            <div class="row gy-4 gy-lg-0">
                <div class="col-lg-5 text-center text-lg-start d-flex d-sm-flex d-md-flex d-lg-flex justify-content-center align-items-center justify-content-lg-start align-items-lg-center justify-content-xl-center" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                    <div>
                        <h1 class="fw-bold">Become a top player in your favorite games with ease and lots of fun</h1>
                        <p>Maple is the leading provider in the cheating industry, we provide the smoothest legit cheating experience, and we're making it even more accessible to others with our simple and modern user interface.<br><br>Start your journey to the top today with our software!</p>
                        <button class="btn btn-primary" type="button" onclick="location.href='dashboard/store'"><i class="fa-solid fa-cart-shopping"></i> Purchase now</button>
                        <button class="btn btn-primary" type="button" onclick="location.href='help/getting-started'">Getting started</button>
                        <button class="btn btn-primary" type="button" onclick="location.href='help/features'">Features</button>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="1250" data-aos-once="true">
                    <div class="carousel slide" data-bs-ride="carousel" data-interval="1500">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/web/images/index/osu-menu-1.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-2.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-3.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-4.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-5.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-6.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-7.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-8.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-9.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-10.png?v=3" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/web/images/index/osu-menu-11.png?v=3" class="d-block w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-4 py-xl-5" id="why-maple">
            <div class="row mb-5" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                <div class="col-lg-8 col-xl-6 text-center mx-auto">
                    <h1 class="fw-bold">Why Maple?</h1>
                    <p>Well we don't know. But here's a list of cool stuff we provide:</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-3 gy-4 justify-content-center">
                <div class="col" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-gears"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold">Rich functionality</h3>
                                <p class="m-0">Maple provides a lot of features to play with (more than anyone else on the market!)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold">Frequent updates</h3>
                                <p class="m-0">User satisfaction comes first for us, and we're trying to release updates with new features, fixes, etc. as frequently as possible.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold">Big experience</h3>
                                <p class="m-0">Our team has been working in this area long before Maple.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-right" data-aos-duration="500" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold">Reliable security</h3>
                                <p class="m-0">We care about our user's accounts, and we're trying our best to protect them from any detections.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-window-maximize"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold">User-friendly interface</h3>
                                <p class="m-0">Our UI is aimed at maximum user convenience and provides a perfect and enjoyable experience.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                    <div class="panel">
                        <div class="d-flex p-3">
                            <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                <i class="fa-solid fa-headset"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold">24/7 Support</h3>
                                <p class="m-0">Our team is ready to help you with any problems day and night.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-4 py-xl-5" id="pricing">
            <div class="row mb-5" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                <div class="col-lg-8 col-xl-6 text-center mx-auto">
                    <h1 class="fw-bold">Pricing</h1>
                    <p>Choose your subscription plan below and start your journey to the top today!</p>
                </div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-8 col-xl-6 text-center mx-auto">
                    <div class="d-flex justify-content-center align-items-center" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                        <div class="selector-bg p-2">
                            <div class="selector-name-bg">
                                <p class="fw-bold mb-1">Game</p>
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
                    </div>

                    <div class="my-2 d-flex justify-content-center align-items-center" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                        <div class="selector-bg p-2">
                            <div class="selector-name-bg">
                                <p class="fw-bold mb-1">Cheat</p>
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
                    </div>
                </div>
            </div>

            <?php
                foreach (GetAllCheats() as $cheat)
                    echo(file_get_contents("assets/web/html/pricing/".$cheat["ID"].".html"));
            ?>
        </div>

        <div class="container py-4 py-xl-5" id="testimonials">
            <div class="row mb-5" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                <div class="col-lg-8 col-xl-6 text-center mx-auto">
                    <h1 class="fw-bold">Recent testimonials</h1>
                    <p>See what others think about Maple</p>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-lg-3 gy-4 justify-content-center">
                <?php
                    if (!empty($testimonials))
                    {
                        for($i= sizeof($testimonials) - 1; $i >= 0; $i--)
                        //foreach($testimonials as $testimony)
                        {
                            $testimony = $testimonials[$i];
                            echo('<div class="col" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                                      <div class="testimony-bg d-flex flex-column p-3 h-100">
                                           <div class="testimony-text-bg d-flex justify-content-center align-items-center text-center p-4 h-100">
                                               <p class="m-0">'.$testimony["Text"].'</p>
                                           </div>
                                          <div class="d-flex p-0 mt-3">
                                              <img class="testimony-avatar flex-shrink-0 me-3 fit-cover" width="50" height="50" src="'.$testimony["AvatarURL"].'">
                                              <div>
                                                  <p class="testimony-username fw-bold mb-0">'.$testimony["Username"].'</p>
                                                  <small class="mb-0">On '.$testimony["AddedOn"].'</small>
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

            <div class="text-center mt-5">
                <p data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">If you want to add your testimony, please <a href="help/contact-us">contact us</a>.</p>
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
                                <a class="discord-icon" href="discord"><i class="fa-brands fa-discord"></i></a>
                                <a class="youtube-icon" href="https://www.youtube.com/channel/UCzyZrNQWaF3iSdqBX4ls42g"><i class="fa-brands fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-inline my-2">
                            <li class="list-inline-item"><a href="legal/terms-of-service">Terms of Service</a></li>
                            <li class="list-inline-item"><a href="legal/privacy-policy">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="legal/contacts">Contacts</a></li>
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
                $('#' + i + '-pricing').attr('hidden', true);

            $('#' + value + '-pricing').attr('hidden', false);
        }
    </script>
</html>
