<?php
    require_once "../../../backend/database/paymentsDatabase.php";
    require_once "../../../backend/payments/centappAPI.php";

    $ourSignature = strtoupper(md5($_POST["OutSum"] . ":" . $_POST["InvId"] . ":" . CENTAPP_API_TOKEN));

    if ($ourSignature != strtoupper($_POST["SignatureValue"]))
        header("Location: https://maple.software/dashboard/store?s=3");

    if (!PaymentExists($_POST["InvId"]))
        header("Location: https://maple.software/dashboard/store?s=5");

    header("Location: https://maple.software/dashboard/store?s=0");
?>