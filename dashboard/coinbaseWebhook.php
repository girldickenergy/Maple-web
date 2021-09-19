<?php
require_once "../backend/Payments/coinbaseHandler.php";
require_once "../backend/Database/databaseHandler.php";
global $dbConn;

use CoinbaseCommerce\Webhook;

$signraturHeader = isset($_SERVER['HTTP_X_CC_WEBHOOK_SIGNATURE']) ? $_SERVER['HTTP_X_CC_WEBHOOK_SIGNATURE'] : null;
$payload = trim(file_get_contents('php://input'));

try
{
    $event = Webhook::buildEvent($payload, $signraturHeader, COINBASE_WEBHOOK_SECRET);
    http_response_code(200);

    if (!coinbasePaymentExists($dbConn, $event["id"]))
    {
        $user = getUserByID($dbConn, $event["data"]["metadata"]["userID"]);
        if ($user != null)
        {
            $amount = $event["data"]["pricing"]["local"]["amount"];
            $maplePointsAmount = $event["data"]["metadata"]["maplePointsAmount"];

            addCoinbasePayment($dbConn, $user["ID"], $maplePointsAmount, $amount, $event["id"]);
            setMaplePoints($dbConn, $user["ID"], $user["MaplePoints"] + $maplePointsAmount);
        }
    }
}
catch (\Exception $exception)
{
    http_response_code(400);
}