<?php
    define('INVALID_REQUEST', -1);
    define('SUCCESS', 0);
    define('INVALID_CREDENTIALS', 1);
    define('HWID_MISMATCH', 2);
    define('INVALID_SESSION', 3);

    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (isset($useragent))
        if ($useragent != "mapleserver/azuki is a cutie")
            dieFake();

    require_once "../backend/Database/databaseHandler.php";
    require_once "../backend/Sessions/sessionHandler.php";

    if (isset($_POST["t"])) //request type
    {
        switch ($_POST["t"])
        {
            case 0: //login
                if (isset($_POST["h"]) && isset($_POST["u"]) && isset($_POST["p"])) //hwid, username and password
                {
                    $user = getUserByName($dbConn, $_POST["u"]);
                    if ($user == null || !password_verify($_POST["p"], $user["Password"]))
                        constructResponse(INVALID_CREDENTIALS);

                    if ($user["HWID"] == null)
                        setHWID($dbConn, $user["ID"], $_POST["h"]);
                    else if ($user["HWID"] != $_POST["h"])
                        constructResponse(HWID_MISMATCH);

                    $sessionID = createCheatSession($dbConn, $user["ID"]);

                    $subscriptionExpiresAt = getSubscriptionExpiry($dbConn, $user["ID"], 0);

                    $resp = "&sessionID=" . $sessionID . "&expiresAt=" . $subscriptionExpiresAt;

                    constructResponse(SUCCESS, $resp);
                }

                break;
            case 1: //heartbeat
                if (isset($_POST["s"])) //session
                {
                    $session = getCheatSession($dbConn, $_POST["s"]);
                    if ($session != null)
                    {
                        setCheatSessionExpiry($dbConn, $session["SessionID"], date('Y-m-d H:i:s', strtotime($session["ExpiresAt"]. ' + 20 minutes')));
                        constructResponse(SUCCESS);
                    }

                    constructResponse(INVALID_SESSION);
                }
                break;
        }
    }

    constructResponse(INVALID_REQUEST);

    function dieFake()
    {
        die("<!DOCTYPE HTML PUBLIC '-//IETF//DTD HTML 2.0//EN'><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this server.</p></body></html>");
    }

    function constructResponse($code, $params)
    {
        $response = "code=".$code.$params;

        echo $response;
        die();
    }
?>