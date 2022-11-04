<?php
    define("STRIPE_WEBHOOK_SECRET", "whsec_Mq811O02yBdZyHQ32nPiVP0zq3oEdrRZ");
    define("STRIPE_TIMESTAMP_TOLERANCE", 300);

    require_once "../../../backend/database/usersDatabase.php";
    require_once "../../../backend/database/paymentsDatabase.php";
    require_once "../../../backend/database/subscriptionsDatabase.php";
    require_once "../../../backend/database/productsDatabase.php";
    require_once "../../../backend/database/receiptsDatabase.php";
    require_once "../../../backend/database/gamesDatabase.php";
    require_once "../../../backend/database/cheatsDatabase.php";
    require_once "../../../backend/receipts/ofdAPI.php";

    $jsonPayload = file_get_contents('php://input');
    $signatureHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];

    $signatureHeaderItems = explode(',', $signatureHeader);
    $timestamp = -1;
    $signatures = [];
    foreach ($signatureHeaderItems as $item)
    {
        $tokens = explode('=', $item, 2);
        if ($tokens[0] == 't' && is_numeric($tokens[1]))
            $timestamp = $tokens[1];
        else if (trim($tokens[0]) == 'v1')
            $signatures[] = $tokens[1];
    }

    if ($timestamp == -1 || empty($signatures))
    {
        http_response_code(400);
        die();
    }
    else
    {
        $expectedSignature = hash_hmac('sha256', $timestamp.'.'.$jsonPayload, STRIPE_WEBHOOK_SECRET);
        $signatureFound = false;
        foreach ($signatures as $signature)
        {
            if (hash_equals($expectedSignature, $signature))
            {
                $signatureFound = true;

                break;
            }
        }

        if (!$signatureFound)
        {
            http_response_code(400);
            die();
        }

        if ((STRIPE_TIMESTAMP_TOLERANCE > 0) && (abs(time() - $timestamp) > STRIPE_TIMESTAMP_TOLERANCE))
        {
            http_response_code(400);
            die();
        }
    }

    $payload = json_decode(trim($jsonPayload), true);

    if ($payload["type"] == "checkout.session.completed")
    {
        if ($payload["data"]["object"]["status"] != "complete" || $payload["data"]["object"]["payment_status"] != "paid")
        {
            http_response_code(400);
            die();
        }

        if (!PaymentExists($payload["data"]["object"]["id"]))
        {
            $user = GetUserByID($payload["data"]["object"]["metadata"]["userID"]);
            if ($user != null)
            {
                $product = GetProductByID($payload["data"]["object"]["metadata"]["productID"]);
                if ($product != null)
                {
                    $cheat = GetCheatByID($product["CheatID"]);
                    if ($cheat != null)
                    {
                        $game = GetGameByID($cheat["GameID"]);
                        if ($game != null)
                        {
                            $amount = $product["Price"];
                            $amountInRubles = $payload["data"]["object"]["metadata"]["identifier"];

                            AddPayment($user["ID"], $amount, $product["ID"], "stripe", $payload["data"]["object"]["id"]);
                            AddOrExtendSubscription($user["ID"], $product["CheatID"], $product["Duration"]);

                            $invoiceID = bin2hex(random_bytes(20));
                            $receiptInfo = CreateReceipt($invoiceID, "https://maple.software/dashboard/store/payments/ofdCallback", $user["Email"], $cheat["Name"] . " " . $product["Name"] . " for " . $game["Name"], $amountInRubles);
                            if ($receiptInfo["code"] == 0)
                                AddReceipt($invoiceID, $receiptInfo["receiptID"], $payload["data"]["object"]["id"], $user["ID"], $product["ID"]);
                        }
                    }
                }
            }
        }
    }

    http_response_code(200);
?>