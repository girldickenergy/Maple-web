<?php
    require_once "databaseConfig.php";

    function GetPromocode($code)
    {
        global $DBConnection;

        $query = "SELECT * FROM Promocodes WHERE Code = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "s", $code);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetPromocodeUsage($code, $userId)
    {
        global $DBConnection;

        $query = "SELECT * FROM PromocodeUsage WHERE Code = ? AND UserID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "si", $code, $userId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function AddPromocodeUsage($code, $userId, $paymentId)
    {
        global $DBConnection;

        $query = "INSERT INTO PromocodeUsage (Code, UserID, PaymentID) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "sis", $code, $userId, $paymentId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return true;
    }
?>