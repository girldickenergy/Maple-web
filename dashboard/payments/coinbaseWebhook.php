<?php
    require_once "../../backend/database/usersDatabase.php";
    require_once "../../backend/database/paymentsDatabase.php";
    require_once "../../backend/database/subscriptionsDatabase.php";
    require_once "../../backend/database/productsDatabase.php";
    require_once "../../backend/payments/coinbaseAPI.php";

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
                    $amount = $product["Price"];
                    $amountInRubles = $event["data"]["metadata"]["amountInRubles"];

                    AddPayment($user["ID"], $amount, $product["ID"], "coinbase", $event["id"]);
                    AddOrExtendSubscription($user["ID"], $product["CheatID"], $product["Duration"]);
                }
            }
        }
    }
    catch (\Exception $exception)
    {
        http_response_code(400);
    }
?>