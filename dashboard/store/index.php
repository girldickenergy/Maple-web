<?php
    require_once "../../backend/localization/localizationHandler.php";
    require_once "../../backend/database/usersDatabase.php";
    require_once "../../backend/database/sessionsDatabase.php";
    require_once "../../backend/database/gamesDatabase.php";
    require_once "../../backend/database/cheatsDatabase.php";
    require_once "../../backend/database/productsDatabase.php";

    $currentLanguage = GetLanguage();

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
            $buyForSomeoneElse = isset($_POST["buyForSomeoneElseCheckbox"]) && $_POST["buyForSomeoneElseCheckbox"] == "on";
            if ($buyForSomeoneElse && empty($_POST["checkoutUserID"]))
                $message = GetLocalizedString("DASHBOARD_STORE_INVALID_USER_ID");
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
                                        /*require_once "../../backend/payments/pikassaAPI.php";

                                        $orderResult = CreateOrder($productFullName, $product["Price"], $priceInRUB, $checkoutUser["ID"], $product["ID"], "https://maple.software/dashboard/store?s=0", "https://maple.software/dashboard/store?c=1");
                                        if ($orderResult['code'] == 0)
                                            Redirect($orderResult['gatewayURL']);

                                        $message = empty($orderResult['error']) ? "Unknown error occurred." : $orderResult["error"];*/

                                        $message = GetLocalizedString("DASHBOARD_STORE_PAYMENT_METHOD_NOT_AVAILABLE");

                                        break;
                                    case 1:
                                        require_once "../../backend/Payments/coinbaseAPI.php";

                                        $orderResult = CreateOrder($productFullName, $product["Price"], $priceInRUB, "EUR", $checkoutUser["ID"], $product["ID"], "https://maple.software/dashboard/store?s=0", "https://maple.software/dashboard/store?c=1");
                                        if ($orderResult['code'] == 0)
                                            Redirect($orderResult['gatewayURL']);

                                        $message = $orderResult['error'];

                                        break;
                                    case 2:
                                        header("Location: resellers");
                                        break;
                                    default:
                                        $message = GetLocalizedString("DASHBOARD_STORE_UNKNOWN_PAYMENT_METHOD");
                                }
                            }
                            else $message = GetLocalizedString("DASHBOARD_STORE_INTERNAL_ERROR");
                        }
                        else $message = GetLocalizedString("DASHBOARD_STORE_PLAN_NOT_AVAILABLE");
                    }
                    else $message = GetLocalizedString("DASHBOARD_STORE_INTERNAL_ERROR");
                }
                else $message = GetLocalizedString("DASHBOARD_STORE_USER_NOT_FOUND");
            }
        }
        else $message = GetLocalizedString("DASHBOARD_STORE_INTERNAL_ERROR");
    }
    else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["s"]))
    {
        if ($_GET["s"] == 0)
        {
            $success = true;
            $message = GetLocalizedString("DASHBOARD_STORE_TRANSACTION_SUCCESS");
        }
        else if ($_GET["s"] == 1)
        {
            $message = GetLocalizedString("DASHBOARD_STORE_TRANSACTION_CANCELLED");
        }
        else if ($_GET["s"] == 2)
        {
            $message = GetLocalizedString("DASHBOARD_STORE_TRANSACTION_FAILED");
        }
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title><?= GetLocalizedString("TITLE_STORE").' - Maple' ?></title>
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
                        <li class="nav-item"><a class="nav-link" href="../../dashboard"><i class="fa-solid fa-user"></i> <?= GetLocalizedString("DASHBOARD_HEADER_PROFILE"); ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="fa-solid fa-shopping-cart"></i> <?= GetLocalizedString("DASHBOARD_HEADER_STORE"); ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="../settings"><i class="fa-solid fa-tools"></i> <?= GetLocalizedString("DASHBOARD_HEADER_SETTINGS"); ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="../status"><i class="fa-solid fa-shield-halved"></i> <?= GetLocalizedString("DASHBOARD_HEADER_STATUS"); ?></a></li>
                        <div class="nav-item dropdown">
                            <a href="../../help" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa-solid fa-headset"></i> <?= GetLocalizedString("HEADER_HELP"); ?></a>
                            <div class="dropdown-menu">
                                <a href="../../help/getting-started" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_GETTING_STARTED"); ?></a>
                                <a href="../../help/features" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_FEATURES"); ?></a>
                                <a href="../../help/faq" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_FAQ"); ?></a>
                                <a href="../../help/payment-issues" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_PAYMENT_ISSUES"); ?></a>
                                <a href="../../help/software-issues" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_SOFTWARE_ISSUES"); ?></a>
                                <a href="../../help/report-a-bug" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_REPORT_A_BUG"); ?></a>
                                <a href="../../help/suggest-a-feature" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_SUGGEST_A_FEATURE"); ?></a>
                                <a href="../../help/contact-us" class="dropdown-item"><?= GetLocalizedString("HEADER_HELP_CONTACT_SUPPORT"); ?></a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?= $currentLanguage == "ru" ? '<img src="https://flagicons.lipis.dev/flags/4x3/ru.svg" width="22" height="22"> '.GetLocalizedString("HEADER_LANGUAGE_SELECTOR_RUSSIAN") : '<img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" width="22" height="22"> '.GetLocalizedString("HEADER_LANGUAGE_SELECTOR_ENGLISH") ?></a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item" onclick="location.href='../../localization/change-language.php?l=en&r=' + location.href"><img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" width="22" height="22"> <?= GetLocalizedString("HEADER_LANGUAGE_SELECTOR_ENGLISH"); ?></a>
                                <a href="#" class="dropdown-item" onclick="location.href='../../localization/change-language.php?l=ru&r=' + location.href"><img src="https://flagicons.lipis.dev/flags/4x3/ru.svg" width="22" height="22"> <?= GetLocalizedString("HEADER_LANGUAGE_SELECTOR_RUSSIAN"); ?></a>
                            </div>
                        </div>
                    </ul>
                    <span class="ms-md-2">
                        <button type="button" onclick="location.href='../../auth/logout';" class="btn btn-primary"><?= GetLocalizedString("HEADER_LOG_OUT"); ?></button>
                    </span>
                </div>
            </div>
        </nav>

        <div class="full-height-container d-flex flex-column justify-content-center align-items-center">
            <div class="alert alert-<?= $success ? "success" : "danger" ?>" role="alert" <?= $message == "" ? "hidden" : "" ?> data-aos="fade-down" data-aos-duration="1000" data-aos-once="true">
                <?= $message ?>
            </div>
            <h1 class="fw-bold" data-aos="fade-down" data-aos-duration="1000" data-aos-once="true"><?= GetLocalizedString("DASHBOARD_STORE") ?></h1>

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
                                            <h3 class="fw-bold"><?= GetLocalizedString("GAME") ?></h3>
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
                                            <h3 class="fw-bold"><?= GetLocalizedString("CHEAT") ?></h3>
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
                                            <h3 class="fw-bold"><?= GetLocalizedString("PLAN") ?></h3>
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
                                    <h3 class="fw-bold"><?= GetLocalizedString("DASHBOARD_STORE_CHECKOUT") ?></h3>
                                    <div class="checkout-bg row row-cols-1 m-0 p-2">
                                        <div class="col p-0">
                                            <input type="radio" class="btn-check" name="payment-method-radio" id="card-radio" value="0" autocomplete="off" checked>
                                            <label class="btn btn-primary w-100 p-2" for="card-radio">
                                                <div class="row p-2">
                                                    <div class="col-8 d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0"><?= GetLocalizedString("DASHBOARD_STORE_CHECKOUT_DEBIT_CREDIT") ?></p>
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
                                                            <p class="mb-0"><?= GetLocalizedString("DASHBOARD_STORE_CHECKOUT_CRYPTOCURRENCY") ?></p>
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
                                                            <p class="mb-0"><?= GetLocalizedString("DASHBOARD_STORE_CHECKOUT_RESELLER") ?></p>
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
                                        <?= GetLocalizedString("DASHBOARD_STORE_CHECKOUT_BUY_FOR_SOMEONE_ELSE") ?>
                                    </label>
                                    <input type="number" id="checkoutUserID" name="checkoutUserID" placeholder="User ID" min="1" class="form-control mt-2">
                                    <button type="submit" name="checkout" class="btn btn-primary w-100 p-2 mt-2">
                                        <?= GetLocalizedString("DASHBOARD_STORE_CHECKOUT_BUTTON") ?>
                                        <?php
                                            foreach($products as $product)
                                                if ($product["IsAvailable"] == 1)
                                                    echo('<span class="badge price-badge" id="'.$product["ID"].'-price" hidden>'.$product["Price"].'€</span>');
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
                <div class="row row-cols-2 row-cols-lg-3 align-items-center">
                    <div class="col">
                        <p class="my-2">Copyright © 2022 maple.software</p>
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
                            <li class="list-inline-item"><a href="../../legal/terms-of-service"><?= GetLocalizedString("FOOTER_TERMS_OF_SERVICE"); ?></a></li>
                            <li class="list-inline-item"><a href="../../legal/privacy-policy"><?= GetLocalizedString("FOOTER_PRIVACY_POLICY"); ?></a></li>
                            <li class="list-inline-item"><a href="../../legal/contacts"><?= GetLocalizedString("FOOTER_CONTACTS"); ?></a></li>
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
