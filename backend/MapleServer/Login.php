<?php
    function LoginFromServer($username, $password, $hwid, $ip)
    {
        // login, try to create session, return session token
        require_once "../Database/databaseHandler.php";
        require_once "../Sessions/sessionHandler.php";
        global $dbConn;

        $user = getUserByName($dbConn, $username);

        if ($hwid != $user["HWID"])
            return "error: wrong hwid"; // maybe return some value to the admin dashboard to ban account sharers?

        setLastIP($dbConn, $user["ID"], $ip);

        if ($user == null || !password_verify($password, $user["Password"]))
            return "error: false credentials";

        return createSessionFromServer($dbConn, $user["ID"]);
    }
?>