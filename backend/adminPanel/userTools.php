<?php
    define("GetPermissions", 0);
    define("GetHWID", 1);
    define("GetUniqueHash", 2);
    define("GetDiscordID", 3);
    define("GetBanReason", 4);
    define("GetHWIDResets", 5);
    define("GetMaplePoints", 6);
    define("ApplyChanges", 7);
    define("GetAllUsersRowsJSON", 8);

    require_once "../Database/databaseHandler.php";
    require_once "../Sessions/sessionHandler.php";
    global $dbConn;

    $currentSession = getSession($dbConn);
    if ($currentSession == null)
        die();

    $user = getUserById($dbConn, $currentSession["UserID"]);
    if (($user["Permissions"] & perm_admin) == 0)
        die();

    if (isset($_POST["c"]) && isset($_POST["d"]))
        echo interpretCall(intval($_POST["c"]), $_POST["d"]);
    else
        die();

    function interpretCall($call, $args)
    {
        global $dbConn;
        switch ($call)
        {
            case GetPermissions:
                $userId = intval($args);
                if (!is_int($userId))
                    return 0;

                $user = getUserById($dbConn, $userId);
                $permissions = intval($user["Permissions"]);

                return (is_int($permissions) ? $permissions : 0);
            case GetHWID:
                $userId = intval($args);
                if (!is_int($userId))
                    return 0;

                $user = getUserById($dbConn, $userId);
                return strval($user["HWID"]);
            case GetUniqueHash:
                $userId = intval($args);
                if (!is_int($userId))
                    return 0;

                $user = getUserById($dbConn, $userId);
                return strval($user["UniqueHash"]);
            case GetDiscordID:
                $userId = intval($args);
                if (!is_int($userId))
                    return 0;

                $user = getUserById($dbConn, $userId);
                return strval($user["DiscordID"]);
            case GetBanReason:
                $userId = intval($args);
                if (!is_int($userId))
                    return 0;

                $user = getUserById($dbConn, $userId);
                return strval($user["BanReason"]);
            case GetHWIDResets:
                $userId = intval($args);
                if (!is_int($userId))
                    return 0;

                $user = getUserById($dbConn, $userId);
                $hwidResets = intval($user["HWIDResets"]);

                return (is_int($hwidResets) ? $hwidResets : 0);
            case GetMaplePoints:
                $userId = intval($args);
                if (!is_int($userId))
                    return 0;

                $user = getUserById($dbConn, $userId);
                $maplePoints = intval($user["MaplePoints"]);

                return (is_int($maplePoints) ? $maplePoints : 0);
            case ApplyChanges:
                $exploded = explode("|", $args);
                $permissions = intval($exploded[0]);
                if (!is_int($permissions))
                    return 0;
                $hwid = $exploded[1];
                if (!is_string($hwid))
                    return 0;
                $uniqueHash = $exploded[2];
                if (!is_string($uniqueHash))
                    return 0;
                $discordID = $exploded[3];
                if (!is_string($discordID))
                    return 0;
                $banReason = $exploded[4];
                if (!is_string($banReason))
                    return 0;
                $hwidResets = intval($exploded[5]);
                if (!is_int($hwidResets))
                    return 0;
                $maplePoints = intval($exploded[6]);
                if (!is_int($maplePoints))
                    return 0;
                $userId = intval($exploded[7]);
                if (!is_int($userId))
                    return 0;

                setPermissions($dbConn, $userId, $permissions);
                setHWID($dbConn, $userId, empty($hwid) ? NULL : $hwid);
                setUniqueHash($dbConn, $userId, empty($uniqueHash) ? NULL : $uniqueHash);
                setDiscordID($dbConn, $userId, empty($discordID) ? NULL : $discordID);
                setBanReason($dbConn, $userId, empty($banReason) ? NULL : $banReason);
                setHWIDResets($dbConn, $userId, $hwidResets);
                setMaplePoints($dbConn, $userId, $maplePoints);

                return "s";
            case GetAllUsersRowsJSON:
                $usersJson = array();
                foreach(getAllUsers($dbConn) as $item)
                {
                    $usersJson[] = array(
                        'ID' => $item[0],
                        'Username' => $item[2],
                        'Permissions' => $item[4],
                        'HWID' => $item[9],
                        'Unique Hash' => $item[7],
                        'Discord ID' => $item[14],
                        'Ban Reason' => $item[5],
                        'HWID Resets' => $item[10],
                        'Maple Points' => $item[11]);
                }

                return json_encode($usersJson);
        }
    }
?>