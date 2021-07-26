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

    if (isset($_GET["t"])) //request type
    {
        switch ($_GET["t"])
        {
            case 0: //login
                if (isset($_GET["h"]) && isset($_GET["u"]) && isset($_GET["p"])) //hwid, username and password
                {
                    $user = getUserByName($dbConn, $_GET["u"]);
                    if ($user == null || !password_verify($_GET["p"], $user["Password"]))
                        constructResponse(INVALID_CREDENTIALS);

                    if ($user["HWID"] == null)
                        setHWID($dbConn, $user["ID"], $_GET["h"]);
                    else if ($user["HWID"] != $_GET["h"])
                        constructResponse(HWID_MISMATCH);

                    $sessionID = createCheatSession($dbConn, $user["ID"]);

                    $subscriptionExpiresAt = "not subscribed";
                    if ($user["MapleLiteExpiresAt"] != null)
                    {
                        if (date("Y", strtotime($user["MapleLiteExpiresAt"])) == 2038)
                        {
                            $subscriptionExpiresAt = "never";
                        }
                        else if ($user["MapleLiteExpiresAt"] > gmdate("Y-m-d H:i:s", time()))
                        {
                            $subscriptionExpiresAt = date("F jS, Y", strtotime($user["MapleLiteExpiresAt"]));
                        }
                    }

                    constructResponse(SUCCESS, array(
                        'sessionID' => $sessionID,
                        'expiresAt' => $subscriptionExpiresAt));
                }

                break;
            case 1: //heartbeat
                if (isset($_GET["s"])) //session
                {
                    $session = getCheatSession($dbConn, $_GET["s"]);
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

    function constructResponse($code, $params = array())
    {
        $response = array('code' => $code);
        $response = array_merge($response, $params);

        echo json_encode($response);
        die();
    }
?>