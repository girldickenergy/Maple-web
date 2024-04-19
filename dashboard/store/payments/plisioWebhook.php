<?php
    require_once "../../../backend/database/usersDatabase.php";
    require_once "../../../backend/database/paymentsDatabase.php";
    require_once "../../../backend/database/subscriptionsDatabase.php";
    require_once "../../../backend/database/productsDatabase.php";
    require_once "../../../backend/database/receiptsDatabase.php";
    require_once "../../../backend/database/gamesDatabase.php";
    require_once "../../../backend/database/cheatsDatabase.php";
    require_once "../../../backend/receipts/ofdAPI.php";
    require_once "../../../backend/payments/plisioAPI.php";

    if (!isset($_POST['verify_hash']))
    {
        http_response_code(400);
        die();
    }

    $post = $_POST;
    $verifyHash = $post['verify_hash'];
    unset($post['verify_hash']);
    ksort($post);

    if (isset($post['expire_utc']))
        $post['expire_utc'] = (string)$post['expire_utc'];

    if (isset($post['tx_urls']))
        $post['tx_urls'] = html_entity_decode($post['tx_urls']);

    $postString = serialize($post);
    $checkKey = hash_hmac('sha1', $postString, PLISIO_API_KEY);

    if ($checkKey != $verifyHash)
    {
        http_response_code(400);
        die();
    }

    if ($post['status'] == 'completed' || $post['status'] == 'mismatch')
    {
        $orderData = explode('|', $post['order_name']);
        $userId = $orderData[0];
        $productId = $orderData[1];
        $amountInRubles = $orderData[2];

        if (!PaymentExists($orderData['order_number']))
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
                            $amount = $product["Price"];

                            AddPayment($user["ID"], $amount, $product["ID"], "plisio", $post['order_number']);
                            AddOrExtendSubscription($user["ID"], $product["CheatID"], $product["Duration"]);

                            $invoiceID = bin2hex(random_bytes(20));
                            $receiptInfo = CreateReceipt($invoiceID, "https://maple.software/dashboard/store/payments/ofdCallback", $user["Email"], $cheat["Name"] . " " . $product["Name"] . " for " . $game["Name"], $amountInRubles);
                            if ($receiptInfo["code"] == 0)
                                AddReceipt($invoiceID, $receiptInfo["receiptID"], $post['order_number'], $user["ID"], $product["ID"]);
                        }
                    }
                }
            }
        }
    }

    http_response_code(200);
?>