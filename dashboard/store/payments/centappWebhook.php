<?php
    require_once "../../../backend/database/usersDatabase.php";
    require_once "../../../backend/database/paymentsDatabase.php";
    require_once "../../../backend/database/subscriptionsDatabase.php";
    require_once "../../../backend/database/productsDatabase.php";
    require_once "../../../backend/database/receiptsDatabase.php";
    require_once "../../../backend/database/gamesDatabase.php";
    require_once "../../../backend/database/cheatsDatabase.php";
    require_once "../../../backend/payments/centappAPI.php";
    require_once "../../../backend/receipts/ofdAPI.php";

    $ourSignature = strtoupper(md5($_POST["OutSum"] . ":" . $_POST["InvId"] . ":" . CENTAPP_API_TOKEN));

    if ($ourSignature != strtoupper($_POST["SignatureValue"]))
    {
        http_response_code(400);
        die();
    }

    if ($_POST["Status"] == "SUCCESS" && !PaymentExists($_POST["InvId"]))
    {
        $metadata = json_decode($_POST["custom"], true);
        $user = GetUserByID($metadata["userID"]);
        if ($user != null)
        {
            $product = GetProductByID($metadata["productID"]);
            if ($product != null)
            {
                $cheat = GetCheatByID($product["CheatID"]);
                if ($cheat != null)
                {
                    $game = GetGameByID($cheat["GameID"]);
                    if ($game != null)
                    {
                        $amount = $product["Price"];
                        $amountInRubles = $metadata["amountInRubles"];

                        AddPayment($user["ID"], $amount, $product["ID"], "cent.app", $_POST["TrsId"]);
                        AddOrExtendSubscription($user["ID"], $cheat["ID"], $product["Duration"]);

                        $invoiceID = bin2hex(random_bytes(20));
                        $receiptInfo = CreateReceipt($invoiceID, "https://maple.software/dashboard/store/payments/ofdCallback", $user["Email"], $cheat["Name"]." ".$product["Name"]." for ".$game["Name"], $amountInRubles);
                        if ($receiptInfo["code"] == 0)
                            AddReceipt($invoiceID, $receiptInfo["receiptID"], $_POST["TrsId"], $user["ID"], $product["ID"]);
                    }
                }
            }
        }
    }

    http_response_code(200);
?>