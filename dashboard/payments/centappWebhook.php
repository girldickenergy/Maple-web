<?php
    require_once "../../backend/database/usersDatabase.php";
    require_once "../../backend/database/paymentsDatabase.php";
    require_once "../../backend/database/subscriptionsDatabase.php";
    require_once "../../backend/database/productsDatabase.php";
    require_once "../../backend/payments/centappAPI.php";

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
                $amount = $product["Price"];
                $amountInRubles = $metadata["amountInRubles"];

                AddPayment($user["ID"], $amount, $product["ID"], "cent.app", $_POST["TrsId"]);
                AddOrExtendSubscription($user["ID"], $product["CheatID"], $product["Duration"]);
            }
        }
    }

    http_response_code(200);
?>