<?php
define("GetPermissions", 0);
define("GetIsActivated", 1);
define("GetHWID", 2);
define("GetMaplePoints", 3);
define("GetMapleFullExpiry", 4);
define("GetMapleLiteExpiry", 5);
define("GetHWIDResets", 6);
define("ApplyChanges", 7);

require_once "../Database/databaseHandler.php";
require_once "../Sessions/sessionHandler.php";
global $dbConn;

$currentSession = getSession($dbConn);
if ($currentSession != null) {
    $userid = $currentSession["UserID"];
    $isAdmin = false;

    $user = getUserById($dbConn, $userid);
    if ($user["Permissions"] & perm_admin)
        $isAdmin = true;

    if (!$isAdmin)
        die();

    if (isset($_POST["c"]) && isset($_POST["d"]))
        echo interpretCall(intval($_POST["c"]), $_POST["d"]);
    else
        die();
} else
    die();

function interpretCall($call, $args)
{
    global $dbConn;
    switch ($call) {
        case GetPermissions:
            $userId = intval($args);
            if (!is_int($userId))
                return 0;

            $user = getUserById($dbConn, $userId);
            $permissions = intval($user["Permissions"]);

            return (is_int($permissions) ? $permissions : 0);
        case GetIsActivated:
            $userId = intval($args);
            if (!is_int($userId))
                return 0;

            $user = getUserById($dbConn, $userId);
            $isActivated = intval($user["IsActivated"]);

            return (is_int($isActivated) ? $isActivated : 0);
        case GetHWID:
            $userId = intval($args);
            if (!is_int($userId))
                return 0;

            $user = getUserById($dbConn, $userId);
            $HWID = strval($user["HWID"]);

            return $HWID;
        case GetMaplePoints:
            $userId = intval($args);
            if (!is_int($userId))
                return 0;

            $user = getUserById($dbConn, $userId);
            $maplePoints = intval($user["MaplePoints"]);

            return (is_int($maplePoints) ? $maplePoints : 0);
        case GetMapleFullExpiry:
            $userId = intval($args);
            if (!is_int($userId))
                return 0;

            $user = getUserById($dbConn, $userId);
            $fullExpiry = strval($user["MapleFullExpiresAt"]);

            return $fullExpiry;
        case GetMapleLiteExpiry:

            $userId = intval($args);
            if (!is_int($userId))
                return 0;

            $user = getUserById($dbConn, $userId);
            $liteExpiry = strval($user["MapleLiteExpiresAt"]);

            return $liteExpiry;
        case GetHWIDResets:
            $userId = intval($args);
            if (!is_int($userId))
                return 0;

            $user = getUserById($dbConn, $userId);
            $hwidResets = intval($user["HWIDResets"]);

            return (is_int($hwidResets) ? $hwidResets : 0);
        case ApplyChanges:
            $exploded = explode("|", $args);
            $permissions = intval($exploded[0]);
            if (!is_int($permissions))
                return 0;
            $isActivated = intval($exploded[1]);
            if (!is_int($isActivated))
                return 0;
            $hwid = $exploded[2];
            if (!is_string($hwid))
                return 0;
            $maplePoints = intval($exploded[3]);
            if (!is_int($maplePoints))
                return 0;
            $hwidResets = intval($exploded[4]);
            if (!is_int($hwidResets))
                return 0;
            $userId = intval($exploded[5]);
            if (!is_int($userId))
                return 0;

            setPermissions($dbConn, $userId, $permissions);
            setIsActivated($dbConn, $userId, $isActivated);
            setHWID($dbConn, $userId, $hwid);
            setMaplePoints($dbConn, $userId, $maplePoints);
            setHWIDResets($dbConn, $userId, $hwidResets);

            return "s";
        default:
            return null;
    }
}
?>