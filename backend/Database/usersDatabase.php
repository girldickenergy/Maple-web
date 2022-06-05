<?php
    define("perm_normal", bindec("00000000"));
    define("perm_activated", bindec("00000001"));
    define("perm_admin",  bindec("00000010"));
    define("perm_banned",  bindec("00000100"));

    require_once "databaseConfig.php";

    function GetAllUsers()
    {
        global $DBConnection;

        $query = "SELECT * FROM Users;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result);
    }

    function GetUserByID($id)
    {
        global $DBConnection;

        $query = "SELECT * FROM Users WHERE ID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetUserByName($username)
    {
        global $DBConnection;

        $query = "SELECT * FROM Users WHERE Username = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetUserByEmail($email)
    {
        global $DBConnection;

        $query = "SELECT * FROM Users WHERE Email = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetUserByUniqueHash($uniqueHash)
    {
        global $DBConnection;

        $query = "SELECT * FROM Users WHERE UniqueHash = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "s", $uniqueHash);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetUserByDiscordID($discordID)
    {
        global $DBConnection;

        $query = "SELECT * FROM Users WHERE DiscordID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "s", $discordID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function AddUser($username, $email, $password, $uniqueHash)
    {
        global $DBConnection;

        $query = "INSERT INTO Users (Username, Email, Password, UniqueHash) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, password_hash($password, PASSWORD_DEFAULT), $uniqueHash);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return true;
    }

    function SetEmail($id, $email)
    {
        global $DBConnection;

        $query = "UPDATE Users SET Email = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", $email, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetUniqueHash($id, $uniqueHash)
    {
        global $DBConnection;

        $query = "UPDATE Users SET UniqueHash = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", $uniqueHash, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetPermissions($id, $permissions)
    {
        global $DBConnection;

        $query = "UPDATE Users SET Permissions = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "ii", $permissions, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetPassword($id, $password)
    {
        global $DBConnection;

        $query = "UPDATE Users SET Password = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", password_hash($password, PASSWORD_DEFAULT), $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetHWID($id, $hwid)
    {
        global $DBConnection;

        $query = "UPDATE Users SET HWID = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", $hwid, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetHWIDChangedAt($id, $hwidChangedAt)
    {
        global $DBConnection;

        $query = "UPDATE Users SET HWIDChangedAt = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "si", $hwidChangedAt, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetDiscordID($id, $discordID)
    {
        global $DBConnection;

        $query = "UPDATE Users SET DiscordID = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "ii", $discordID, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function SetBanReason($id, $banReason)
    {
        global $DBConnection;

        $query = "UPDATE Users SET BanReason = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return false;

        mysqli_stmt_bind_param($stmt, "ii", $banReason, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }
?>