<?php
    require_once "databaseConfig.php";

    function GetAllGames()
    {
        global $DBConnection;

        $query = "SELECT * FROM Games;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function GetGameByID($id)
    {
        global $DBConnection;

        $query = "SELECT * FROM Games WHERE ID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function SetAnticheatFileSize($id, $fileSize)
    {
        global $DBConnection;

        $query = "UPDATE Games SET AnticheatFileSize = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", $fileSize, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetAnticheatFileChecksum($id, $fileChecksum)
    {
        global $DBConnection;

        $query = "UPDATE Games SET AnticheatFileChecksum = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", $fileChecksum, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetAnticheatLastUpdate($id, $updatedAt)
    {
        global $DBConnection;

        $query = "UPDATE Games SET AnticheatUpdatedAt = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", $updatedAt, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetAnticheatLastCheck($id, $checkedAt)
    {
        global $DBConnection;

        $query = "UPDATE Games SET AnticheatCheckedAt = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", $checkedAt, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }
?>