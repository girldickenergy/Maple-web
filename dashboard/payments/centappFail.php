<?php
    require_once "../../backend/Payments/centappHandler.php";

    $ourSignature = strtoupper(md5($_POST["OutSum"] . ":" . $_POST["InvId"] . ":" . CENTAPP_API_TOKEN));

    if ($ourSignature != strtoupper($_POST["SignatureValue"]))
        header("Location: https://maple.software/dashboard/store?c=1?e=Signature verification error! (1)");

    header("Location: https://maple.software/dashboard/store?c=1&e=Payment failed!");
?>