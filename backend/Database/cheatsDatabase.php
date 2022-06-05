<?php
    define("CHEAT_STATUS_UNDETECTED", 0);
    define("CHEAT_STATUS_OUTDATED", 1);
    define("CHEAT_STATUS_DETECTED", 2);
    define("CHEAT_STATUS_UNKNOWN", 3);

    require_once "databaseConfig.php";

    function GetAllCheats()
    {
        global $DBConnection;

        $query = "SELECT * FROM Cheats;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function GetCheatByID($cheatID)
    {
        global $DBConnection;

        $query = "SELECT * FROM Cheats WHERE ID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "i", $cheatID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function SetStatus($id, $status)
    {
        global $DBConnection;

        $query = "UPDATE Cheats SET Status = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "ii", $status, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetLastStatusUpdate($id, $updatedAt)
    {
        global $DBConnection;

        $query = "UPDATE Cheats SET StatusUpdatedAt = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", $updatedAt, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }
?>