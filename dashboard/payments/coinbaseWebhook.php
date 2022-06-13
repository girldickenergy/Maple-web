<?php
    require_once "../../backend/database/usersDatabase.php";
    require_once "../../backend/database/paymentsDatabase.php";
    require_once "../../backend/database/subscriptionsDatabase.php";
    require_once "../../backend/database/productsDatabase.php";
    require_once "../../backend/database/receiptsDatabase.php";
    require_once "../../backend/database/gamesDatabase.php";
    require_once "../../backend/database/cheatsDatabase.php";
    require_once "../../backend/payments/coinbaseAPI.php";
    require_once "../../backend/receipts/ofdAPI.php";

    use CoinbaseCommerce\Webhook;

    $signraturHeader = isset($_SERVER['HTTP_X_CC_WEBHOOK_SIGNATURE']) ? $_SERVER['HTTP_X_CC_WEBHOOK_SIGNATURE'] : null;
    $payload = trim(file_get_contents('php://input'));

    try
    {
        $event = Webhook::buildEvent($payload, $signraturHeader, COINBASE_WEBHOOK_SECRET);
        http_response_code(200);

        if (!PaymentExists($event["id"]))
        {
            $user = GetUserByID($event["data"]["metadata"]["userID"]);
            if ($user != null)
            {
                $product = GetProductByID($event["data"]["metadata"]["productID"]);
                if ($product != null)
                {
                    $cheat = GetCheatByID($product["CheatID"]);
                    if ($cheat != null)
                    {
                        $game = GetGameByID($cheat["GameID"]);
                        if ($game != null)
                        {
                            $amount = $product["Price"];
                            $amountInRubles = $event["data"]["metadata"]["amountInRubles"];

                            AddPayment($user["ID"], $amount, $product["ID"], "coinbase", $event["id"]);
                            AddOrExtendSubscription($user["ID"], $product["CheatID"], $product["Duration"]);

                            $invoiceID = bin2hex(random_bytes(20));
                            $receiptInfo = CreateReceipt($invoiceID, "https://maple.software/dashboard/payments/ofdCallback", $user["Email"], $cheat["Name"] . " " . $product["Name"] . " for " . $game["Name"], $amountInRubles);
                            if ($receiptInfo["code"] == 0)
                                AddReceipt($invoiceID, $receiptInfo["receiptID"], $event["id"], $user["ID"], $product["ID"]);
                        }
                    }
                }
            }
        }
    }
    catch (\Exception $exception)
    {
        http_response_code(400);
    }
?>