<?php
    /*
     * Heartbeat for the Maple Loader(?) and the Maple Cheat, this will house a few bits of information to determine
     * the legitimacy of the copy running and some other shit
     */

    // A heartbeat should occur once Maple is loaded, and then every 15 minutes, this will make it more annoying
    // for Network Debuggers to Debug and Analyze, and make it less straining on the server.+

    // Returns 0 for invalid, 1 for valid
    // This result is never sent to the client running Maple but instead to the server
    // The server will then send a TCP packet to the client running Maple, telling it to kill itself
    function Heartbeat($session, $hwid, $ip)
    {
        require_once "../Database/databaseHandler.php";
        require_once "../Sessions/sessionHandler.php";
        global $dbConn;
        $sessionDB = getSessionFromId($dbConn, $session);
        if ($sessionDB == null)
            return 0; // invalid

        $userId = $sessionDB["UserID"];
        $user = getUserById($dbConn, $userId);

        // This ip check will check against the last known IP, which should be written on the LoginFromServer function
        // therefore the IP should be identical, so it's fair to check against it here.
        // (even if it's overkill, rather have more security than have too little)
        if ($user["LastIP"] != $ip)
            return 0; // invalid

        if ($user["HWID"] != $hwid)
            return 0; // invalid

        return 1;
    }
?>