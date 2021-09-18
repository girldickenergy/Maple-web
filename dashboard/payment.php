<?php
    require_once "../backend/Payments/coinpaymentsHandler.php";
    global $dbConn;

    if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
        die('IPN Mode is not HMAC');
    }

    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
        die('No HMAC signature sent.');
    }

    $request = file_get_contents('php://input');
    if ($request === FALSE || empty($request)) {
        die('Error reading POST data');
    }

    if (!isset($_POST['merchant']) || $_POST['merchant'] != trim(COINPAYMENTS_MERCHANT_ID)) {
        die('No or incorrect Merchant ID passed');
    }

    $hmac = hash_hmac("sha512", $request, trim(COINPAYMENTS_IPN_SECRET));
    if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
        die('HMAC signature does not match');
    }

    $ipn_type = $_POST['ipn_type'];
    $txn_id = $_POST['txn_id'];
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $amount1 = floatval($_POST['amount1']);
    $amount2 = floatval($_POST['amount2']);
    $currency1 = $_POST['currency1'];
    $currency2 = $_POST['currency2'];
    $status = intval($_POST['status']);
    $status_text = $_POST['status_text'];
    $custom = $_POST['custom'];

    if ($status >= 100 || $status == 2) {
        // payment is complete or queued for nightly payout, success
        $user = getUserByEmail($dbConn, $custom);
        if ($user != null && !paymentExists($dbConn, $_POST["txn_id"]))
        {
            $eurAmount = $amount1;
            $maplePointsAmount = $eurAmount * 100;

            addPayment($dbConn, $user["ID"], $maplePointsAmount, $eurAmount, $amount1, $_POST["fee"], $_POST["txn_id"], $custom);
            setMaplePoints($dbConn, $user["ID"], $user["MaplePoints"] + $maplePointsAmount);
        }
    } else if ($status < 0) {
        //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
    } else {
        //payment is pending, you can optionally add a note to the order page
    }

    /*$_POST = json_decode(file_get_contents('php://input'), true);

	require_once "../backend/Database/databaseHandler.php";
    require_once "../backend/Payments/paydashHandler.php";
    require_once "../backend/Currency/currencyConverter.php";
    global $dbConn;

	if (isset($_POST["apiKey"]) && isset($_POST["paymentID"]) && isset($_POST["email"]) && isset($_POST["amount"]) && isset($_POST["status"]))
    {
        if ($_POST["apiKey"] == PAYDASH_API_KEY && $_POST["status"] == "paid")
        {
            $user = getUserByEmail($dbConn, $_POST["email"]);
            if ($user != null && !paymentExists($dbConn, $_POST["paymentID"]))
            {
                $eurAmount = round(ConvertUSDToEUR($_POST["amount"]), 0);
                $maplePointsAmount = $eurAmount * 100;

                addPayment($dbConn, $user["ID"], $maplePointsAmount, $eurAmount, $_POST["income"], $_POST["fees"], $_POST["paymentID"], $_POST["email"]);
                setMaplePoints($dbConn, $user["ID"], $user["MaplePoints"] + $maplePointsAmount);
            }
        }
    }*/
?>