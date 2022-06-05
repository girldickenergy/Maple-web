<?php
    require_once "databaseConfig.php";

    function PaymentExists($paymentID)
    {
        global $DBConnection;

        $query = "SELECT * FROM Payments WHERE PaymentID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return true;
        }

        mysqli_stmt_bind_param($stmt, "s", $paymentID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_fetch_assoc($result))
        {
            mysqli_stmt_close($stmt);
            return true;
        }

        mysqli_stmt_close($stmt);
        return false;
    }

    function AddPayment($userId, $amount, $productID, $gateway, $paymentId)
    {
        global $DBConnection;

        $query = "INSERT INTO Payments (UserID, Amount, ProductID, Gateway, PaymentID, CompletedAt) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "idisss", $userId, $amount, $productID, $gateway, $paymentId, gmdate("Y-m-d H:i:s", time()));
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return true;
    }
?>