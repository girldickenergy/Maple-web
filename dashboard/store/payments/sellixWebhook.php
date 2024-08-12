<?php
    require_once "../../../backend/database/usersDatabase.php";
    require_once "../../../backend/database/paymentsDatabase.php";
    require_once "../../../backend/database/subscriptionsDatabase.php";
    require_once "../../../backend/database/productsDatabase.php";
    require_once "../../../backend/database/promocodesDatabase.php";
    require_once "../../../backend/database/receiptsDatabase.php";
    require_once "../../../backend/database/gamesDatabase.php";
    require_once "../../../backend/database/cheatsDatabase.php";
    require_once "../../../backend/receipts/ofdAPI.php";
    require_once "../../../backend/payments/sellixAPI.php";

    $payload = file_get_contents('php://input');
    $secret = SELLIX_WEBHOOK_SECRET;
    $header_signature = $_SERVER['HTTP_X_SELLIX_SIGNATURE'];
    $signature = hash_hmac('sha512', $payload, $secret);
    $payload = json_decode($payload, true);

    if (hash_equals($signature, $header_signature))
    {
        if ($payload['event'] == "order:paid")
        {
            $paymentId = $payload['data']['uniqid'];

            $userId = $payload['data']['custom_fields']['userID'];
            $productId = $payload['data']['custom_fields']['productID'];
            $amount = $payload['data']['total_display'];
            $amountInRubles = $payload['data']['custom_fields']['i'];
            $promocode = $payload['data']['custom_fields']['promocode'];

            if (!PaymentExists($paymentId))
            {
                $user = GetUserByID($userId);
                if ($user != null)
                {
                    $product = GetProductByID($productId);
                    if ($product != null)
                    {
                        $cheat = GetCheatByID($product["CheatID"]);
                        if ($cheat != null)
                        {
                            $game = GetGameByID($cheat["GameID"]);
                            if ($game != null)
                            {
                                AddPayment($user["ID"], $amount, $product["ID"], "sellix", $paymentId);
                                AddOrExtendSubscription($user["ID"], $product["CheatID"], $product["Duration"]);
                                if (!empty($promocode))
                                    AddPromocodeUsage($promocode, $user["ID"], $paymentId);

                                $invoiceID = bin2hex(random_bytes(20));
                                $receiptInfo = CreateReceipt($invoiceID, "https://maple.software/dashboard/store/payments/ofdCallback", $user["Email"], $cheat["Name"] . " " . $product["Name"] . " for " . $game["Name"], $amountInRubles);
                                if ($receiptInfo["code"] == 0)
                                    AddReceipt($invoiceID, $receiptInfo["receiptID"], $paymentId, $user["ID"], $product["ID"]);
                            }
                        }
                    }
                }
            }
        }
    }
    else
    {
        http_response_code(400);
        die();
    }

    http_response_code(200);
?>