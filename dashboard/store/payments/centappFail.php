<?php
    require_once "../../../backend/payments/centappAPI.php";

    $ourSignature = strtoupper(md5($_POST["OutSum"] . ":" . $_POST["InvId"] . ":" . CENTAPP_API_TOKEN));

    if ($ourSignature != strtoupper($_POST["SignatureValue"]))
        header("Location: https://maple.software/dashboard/store?s=4");

    header("Location: https://maple.software/dashboard/store?s=2");
?>