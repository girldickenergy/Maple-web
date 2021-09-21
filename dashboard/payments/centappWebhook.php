<?php
    require_once "../../backend/Database/databaseHandler.php";
    require_once "../../backend/Payments/centappHandler.php";
    global $dbConn;

    $ourSignature = strtoupper(md5($_POST["OutSum"] . ":" . $_POST["InvId"] . ":" . CENTAPP_API_TOKEN));

    if ($ourSignature != strtoupper($_POST["SignatureValue"]))
    {
        http_response_code(400);
        die();
    }

    if ($_POST["Status"] == "SUCCESS" && !centappPaymentExists($dbConn, $_POST["InvId"]))
    {
        $metadata = json_decode($_POST["custom"], true);
        $user = getUserById($dbConn, $metadata["userID"]);
        if ($user != null)
        {
            addCentappPayment($dbConn, $user["ID"], $metadata["maplePointsAmount"], $_POST["OutSum"], $_POST["InvId"], $_POST["TrsId"]);
            setMaplePoints($dbConn, $user["ID"], $user["MaplePoints"] + $metadata["maplePointsAmount"]);
        }
    }

    http_response_code(200);
?>