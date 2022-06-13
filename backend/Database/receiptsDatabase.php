<?php
    require_once "databaseConfig.php";

    function AddReceipt($invoiceID, $receiptID, $transactionID, $userID, $productID)
    {
        global $DBConnection;

        $query = "INSERT INTO Receipts (InvoiceID, ReceiptID, TransactionID, UserID, ProductID, CreatedAt, Status) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        $status = "NEW";
        mysqli_stmt_bind_param($stmt, "sssiiss", $invoiceID, $receiptID, $transactionID, $userID, $productID, gmdate('Y-m-d H:i:s', time()), $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return true;
    }

    function GetReceiptByInvoiceID($id)
    {
        global $DBConnection;

        $query = "SELECT * FROM Receipts WHERE InvoiceID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetReceiptByReceiptID($id)
    {
        global $DBConnection;

        $query = "SELECT * FROM Receipts WHERE ReceiptID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetReceiptByTransactionID($id)
    {
        global $DBConnection;

        $query = "SELECT * FROM Receipts WHERE TransactionID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function SetReceiptStatus($invoiceID, $status)
    {
        global $DBConnection;

        $query = "UPDATE Receipts SET Status = ? WHERE InvoiceID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "ss", $status, $invoiceID);
        mysqli_stmt_execute($stmt);

        return true;
    }
?>