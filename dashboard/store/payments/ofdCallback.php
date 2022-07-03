<?php
    require_once "../../../backend/database/receiptsDatabase.php";

    $payload = json_decode(trim(file_get_contents('php://input')), true);

    if ($payload["Status"] == "Success")
        SetReceiptStatus($payload["Data"]["InvoiceId"], $payload["Data"]["StatusName"]);
?>