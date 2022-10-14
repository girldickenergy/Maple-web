<?php
    require_once "../../../backend/database/usersDatabase.php";
    require_once "../../../backend/database/paymentsDatabase.php";
    require_once "../../../backend/database/subscriptionsDatabase.php";
    require_once "../../../backend/database/productsDatabase.php";
    require_once "../../../backend/database/receiptsDatabase.php";
    require_once "../../../backend/database/gamesDatabase.php";
    require_once "../../../backend/database/cheatsDatabase.php";
    require_once "../../../backend/payments/pikassaAPI.php";
    require_once "../../../backend/receipts/ofdAPI.php";

    $sign = $_SERVER['HTTP_X_SIGN'] ?? null;
    $payload = json_decode(trim(file_get_contents('php://input')), true);

    if ($sign != null && !empty($payload))
    {
        if (!PaymentExists($payload["externalId"]) && $payload["status"]["name"] == "InvoicePaid")
        {
            $user = GetUserByID($payload["customData"]["userID"]);
            if ($user != null)
            {
                $product = GetProductByID($payload["customData"]["productID"]);
                if ($product != null)
                {
                    $cheat = GetCheatByID($product["CheatID"]);
                    if ($cheat != null)
                    {
                        $game = GetGameByID($cheat["GameID"]);
                        if ($game != null)
                        {
                            $amount = $product["Price"];
                            $amountInRubles = $payload["customData"]["amountInRubles"];

                            AddPayment($user["ID"], $amount, $product["ID"], "pikassa", $payload["externalId"]);
                            AddOrExtendSubscription($user["ID"], $product["CheatID"], $product["Duration"]);

                            $invoiceID = bin2hex(random_bytes(20));
                            $receiptInfo = CreateReceipt($invoiceID, "https://maple.software/dashboard/store/payments/ofdCallback", $user["Email"], $cheat["Name"] . " " . $product["Name"] . " for " . $game["Name"], $amountInRubles);
                            if ($receiptInfo["code"] == 0)
                                AddReceipt($invoiceID, $receiptInfo["receiptID"], $payload["externalId"], $user["ID"], $product["ID"]);

                            echo(json_encode(array(
                                "success" => true,
                                "uuid" => $payload["uuid"]
                            ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
                        }
                    }
                }
            }
        }

        echo(json_encode(array(
            "success" => false,
            "uuid" => $payload["uuid"]
        ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
?>