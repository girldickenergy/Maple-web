<?php
require_once "databaseConfig.php";

    function GetAllProducts()
    {
        global $DBConnection;

        $query = "SELECT * FROM Products;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function GetProductByID($id)
    {
        global $DBConnection;

        $query = "SELECT * FROM Products WHERE ID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetProductsByCheatID($cheatID)
    {
        global $DBConnection;

        $query = "SELECT * FROM Products WHERE CheatID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "i", $cheatID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>