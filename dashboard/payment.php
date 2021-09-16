<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

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
    }
?>