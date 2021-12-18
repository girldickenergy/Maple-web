<?php
    require_once "../../backend/Database/databaseHandler.php";
    require_once "../../backend/Payments/centappHandler.php";
    global $dbConn;

    $ourSignature = strtoupper(md5($_POST["OutSum"] . ":" . $_POST["InvId"] . ":" . CENTAPP_API_TOKEN));

    if ($ourSignature != strtoupper($_POST["SignatureValue"]))
        header("Location: https://maple.software/dashboard/store?c=1?e=Signature verification error! (0)");

    if (!centappPaymentExists($dbConn, $_POST["InvId"]))
        header("Location: https://maple.software/dashboard/store?c=1?e=Payment not found!");

    header("Location: https://maple.software/dashboard/store?c=0");
?>