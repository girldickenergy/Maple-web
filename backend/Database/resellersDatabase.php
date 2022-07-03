<?php
    require_once "databaseConfig.php";

    function GetAllResellers()
    {
        global $DBConnection;

        $query = "SELECT * FROM Resellers;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>