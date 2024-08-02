<?php
    require_once "../../backend/database/usersDatabase.php";
    require_once "../../backend/database/sessionsDatabase.php";
    require_once "../../backend/database/gamesDatabase.php";
    require_once "../../backend/database/cheatsDatabase.php";
    require_once "../../backend/database/productsDatabase.php";

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
        header("Location: ../../auth/pendingActivation");
        die();
    }

    if ($user["Permissions"] & perm_banned)
    {
        header("Location: ../banned");
        die();
    }

    $games = GetAllGames();
    $cheats = GetAllCheats();
    $products = GetAllProducts();

    $success = false;
    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_POST["checkout"]) && isset($_POST["plan-radio"]) && isset($_POST["payment-method-radio"]))
        {
            if ($currentSession["IP"] == "85.249.175.170" || $currentSession["IP"] == "85.249.172.176" || $currentSession["IP"] == "85.249.170.183") // chargeback/fraud
            {
                header("Location: https://maple.software");
                die();
            }

            if ($currentSession["IP"] == "45.130.202.100") // chargeback/fraud
            {
                header("Location: https://maple.software");
                die();
            }

            if ($currentSession["IP"] == "176.49.79.155" || $currentSession["IP"] == "2.63.28.25") // chargeback/fraud
            {
                header("Location: https://maple.software");
                die();
            }

            if ($currentSession["IP"] == "151.249.166.201") // chargeback/fraud
            {
                header("Location: https://maple.software");
                die();
            }

            $buyForSomeoneElse = isset($_POST["buyForSomeoneElseCheckbox"]) && $_POST["buyForSomeoneElseCheckbox"] == "on";
            if ($buyForSomeoneElse && empty($_POST["checkoutUserID"]))
                $message = "Please specify who you want to make a purchase for!";
            else
            {
                $checkoutUser = $buyForSomeoneElse ? GetUserByID($_POST["checkoutUserID"]) : $user;
                if ($checkoutUser != null)
                {
                    $product = GetProductByID($_POST["plan-radio"]);
                    $cheat = GetCheatByID($product["CheatID"]);
                    $game = GetGameByID($cheat["GameID"]);

                    if ($product != null && $cheat != null && $game != null)
                    {
                        if ($product["IsAvailable"] == 1)
                        {
                            if ($product["Price"] > 0)
                            {
                                require_once "../../backend/currency/currencyConverter.php";

                                $productFullName = $cheat["Name"]." ".$product["Name"]." for ".$game["Name"];
                                $priceInUSD = ConvertEURToUSD($product["Price"]);
                                $priceInRUB = ConvertEURToRUB($product["Price"]);
                                switch ($_POST["payment-method-radio"])
                                {
                                    case 0:
                                        $message = "This payment method is temporarily unavailable.";

                                        break;
                                    case 1:
                                        require_once "../../backend/Payments/sellixAPI.php";

                                        $orderResult = CreateOrder($productFullName, $product["Price"], $priceInRUB, "EUR", $checkoutUser["ID"], $checkoutUser['Email'], $product["ID"], "https://maple.software/dashboard/store?s=0");
                                        if ($orderResult['code'] == 0)
                                            Redirect($orderResult['gatewayURL']);

                                        $message = $orderResult['error'];

                                        break;
                                    case 2:
                                        header("Location: resellers");
                                        break;
                                    default:
                                        $message = "Unknown payment method!";
                                }
                            }
                            else $message = "An internal error occurred.";
                        }
                        else $message = "This product is not available yet.";
                    }
                    else $message = "An internal error occurred";
                }
                else $message = "User not found!";
            }
        }
        else $message = "An internal error occurred.";
    }
    else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["s"]))
    {
        if ($_GET["s"] == 0)
        {
            $success = true;
            $message = "Your transaction has been completed successfully!";
        }
        else if ($_GET["s"] == 1)
        {
            $message = "Transaction cancelled!";
        }
        else if ($_GET["s"] == 2)
        {
            $message = "Transaction failed!";
        }
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Store - Maple</title>
        <link rel="icon" href="../../assets/web/images/mapleleaf.svg?v=1.4">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/web/dependencies/bootstrap/css/bootstrap.min.css?v=1.4">
        <link rel="stylesheet" href="../../assets/web/dependencies/aos/css/aos.css?v=1.4"/>
        <link rel="stylesheet" href="../../assets/web/css/main.css?v=1.7">
        <link rel="stylesheet" href="../../assets/web/css/store.css?v=1.4">

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
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-shopping-cart"></i> Store</a></li>
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

        <div class="full-height-container d-flex flex-column justify-content-center align-items-center">
            <div class="alert alert-<?= $success ? "success" : "danger" ?>" role="alert" <?= $message == "" ? "hidden" : "" ?> data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">
                <?= $message ?>
            </div>

            <div class="alert alert-danger text-center" role="alert" data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">
                Maple is currently outdated on the latest version of osu!<br>You can still use Maple offline or on private servers, join our <a href="../../discord">discord server</a> for the setup guide.<br>Keep an eye on the <a href="../status">status page</a> and our <a href="../../discord">discord server</a> for updates.
            </div>

            <h1 class="fw-bold" data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">Store</h1>

            <form action="<?php
                $path = explode('.', htmlspecialchars($_SERVER['PHP_SELF']));
                echo $path[0];
            ?>" method="post" id="subform">
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
                                                              <label class="btn btn-primary" for="'.$game["ID"].'-game-radio"><img src="../../assets/games/icons/'.$game["ID"].'.png"> '.$game["Name"].'</label>');
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
                            <div class="col" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">
                                <div class="panel">
                                    <div class="d-flex p-3">
                                        <div class="panel-icon me-3 align-items-center justify-content-center d-flex">
                                            <i class="fa-solid fa-clock"></i>
                                        </div>
                                        <div>
                                            <h3 class="fw-bold">Plan</h3>
                                            <?php
                                                foreach($cheats as $cheat)
                                                {
                                                    echo('<div class="selector-combo-bg p-1" id="'.$cheat["ID"].'-plans">');
                                                    foreach($products as $product)
                                                    {
                                                        if ($product["CheatID"] == $cheat["ID"] && $product["IsAvailable"] == 1)
                                                        {
                                                            echo('<input type="radio" class="btn-check" name="plan-radio" id="'.$product["ID"].'-product-radio" value="'.$product["ID"].'" autocomplete="off">
                                                                  <label class="btn btn-primary" for="'.$product["ID"].'-product-radio">'.$product["Name"].'</label>');
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
                                    <i class="fa-solid fa-cash-register"></i>
                                </div>
                                <div class="w-100">
                                    <h3 class="fw-bold">Checkout</h3>
                                    <div class="checkout-bg row row-cols-1 m-0 p-2">
                                        <div class="col p-0">
                                            <input type="radio" class="btn-check" name="payment-method-radio" id="card-radio" value="0" autocomplete="off" checked>
                                            <label class="btn btn-primary w-100 p-2" for="card-radio">
                                                <div class="row p-2">
                                                    <div class="col-8 d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0">Debit/Credit Card</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 d-flex justify-content-end align-items-center">
                                                        <h2 class="mb-0 me-1"><i class="fa-brands fa-cc-visa"></i></h2>
                                                        <h2 class="mb-0"><i class="fa-brands fa-cc-mastercard"></i></h2>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col p-0 mt-2">
                                            <input type="radio" class="btn-check" name="payment-method-radio" id="cryptocurrency-radio" value="1" autocomplete="off">
                                            <label class="btn btn-primary w-100 p-2" for="cryptocurrency-radio">
                                                <div class="row p-2">
                                                    <div class="col-8 d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0">Cryptocurrency</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 d-flex justify-content-end align-items-center">
                                                        <h2 class="m-0"><i class="fa-brands fa-bitcoin"></i></h2>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col p-0 mt-2">
                                            <input type="radio" class="btn-check" name="payment-method-radio" id="reseller-radio" value="2" autocomplete="off">
                                            <label class="btn btn-primary w-100 p-2" onclick="location.href='resellers';" for="reseller-radio">
                                                <div class="row p-2">
                                                    <div class="col-8 d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0">Reseller</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 d-flex justify-content-end align-items-center">
                                                        <h2 class="m-0"><i class="fa-brands fa-cc-paypal"></i></h2>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <label class="mt-2">
                                        <input type="checkbox" name="buyForSomeoneElseCheckbox" id="buyForSomeoneElseCheckbox" />
                                        Buy for someone else
                                    </label>
                                    <input type="number" id="checkoutUserID" name="checkoutUserID" placeholder="User ID" min="1" class="form-control mt-2">
                                    <button type="submit" name="checkout" class="btn btn-primary w-100 p-2 mt-2">
                                        Checkout
                                        <?php
                                            foreach($products as $product)
                                                if ($product["IsAvailable"] == 1)
                                                    echo('<span class="badge price-badge" id="'.$product["ID"].'-price" hidden>€'.$product["Price"].'</span>');
                                        ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

        onGameChange(<?= $games[0]["ID"] ?>);
        toggleUserIDInput($('#buyForSomeoneElseCheckbox').is(':checked'));

        $('#buyForSomeoneElseCheckbox').change(function ()
        {
            toggleUserIDInput($(this).is(':checked'));
        });

        $('input[type=radio][name=game-radio]').on('change', function()
        {
            onGameChange($(this).val());
        });

        $('input[type=radio][name=cheat-radio]').on('change', function()
        {
            onCheatChange($(this).val());
        });

        $('input[type=radio][name=plan-radio]').on('change', function()
        {
            onPlanChange($(this).val());
        });

        function toggleUserIDInput(toggled)
        {
            if (toggled)
            {
                $('#checkoutUserID').attr('hidden', false);
            }
            else
            {
                $('#checkoutUserID').attr('hidden', true);
            }
        }

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
            if (!$('#' + value + '-cheat-radio').is(":checked"))
                $('#' + value + '-cheat-radio').prop('checked', true);

            for (let i = 0; i < <?= count($cheats) ?>; i++)
                $('#' + i + '-plans').attr('hidden', true);

            $('#' + value + '-plans').attr('hidden', false);
            $('#' + value + '-plans').children().first().prop('checked', true);

            onPlanChange($('#' + value + '-plans').children().first().val());
        }

        function onPlanChange(value)
        {
            for (let i = 0; i < <?= count($products) ?>; i++)
                $('#' + i + '-price').attr('hidden', true);

            $('#' + value + '-price').attr('hidden', false);
        }
    </script>
</html>
