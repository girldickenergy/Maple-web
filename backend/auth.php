<?php
    define('INVALID_REQUEST', -1);
    define('SUCCESS', 0);
    define('INVALID_CREDENTIALS', 1);
    define('HASH_MISMATCH', 2);
    define('HWID_MISMATCH', 3);
    define('USER_BANNED', 4);
    define('INVALID_SESSION', 5);

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
                if (isset($_POST["h"]) && isset($_POST["ha"]) && isset($_POST["u"]) && isset($_POST["p"])) //hwid, username and password
                {
                    $user = getUserByName($dbConn, $_POST["u"]);
                    if ($user == null || !password_verify($_POST["p"], $user["Password"]))
                        constructResponse(INVALID_CREDENTIALS);

                    if ($_POST["ha"] != "4AE80E31987300D2A729DD08C09DFBF8A041EAD337D6F64DC560F61E9C098836")
                        constructResponse(HASH_MISMATCH);

                    if ($user["HWID"] == null)
                        setHWID($dbConn, $user["ID"], $_POST["h"]);
                    else if ($user["HWID"] != $_POST["h"])
                        constructResponse(HWID_MISMATCH);
                    else if ($user["Permissions"] & perm_banned)
                        constructResponse(USER_BANNED);

                    $sessionID = createCheatSession($dbConn, $user["ID"]);

                    $games = array();
                    foreach(getAllGames($dbConn) as $game)
                    {
                        $games[] = array(
                            'ID' => $game[0],
                            'Name' => $game[1],
                            'ModuleName' => $game[2]
                        );
                    }

                    $cheats = array();
                    foreach(getAllCheats($dbConn) as $cheat)
                    {
                        $cheats[] = array(
                            'ID' => $cheat[0],
                            'GameID' => $cheat[1],
                            'ReleaseStreams' => $cheat[2],
                            'Name' => $cheat[3],
                            'Price' => $cheat[4],
                            'Status' => $cheat[5],
                            'Features' => $cheat[6],
                            'ExpiresAt' => getSubscriptionExpiry($dbConn, $user["ID"], $cheat[0])
                        );
                    }

                    constructResponse(SUCCESS, array(
                        'sessionID' => $sessionID,
                        'games' => $games,
                        'cheats' => $cheats
                        )
                    );
                }

                break;
            case 1: //heartbeat
                if (isset($_POST["s"]) && isset($_POST["e"])) //session
                {
                    $session = getCheatSession($dbConn, $_POST["s"]);
                    if ($session != null)
                    {
                        if ($_POST["e"] == 1)
                        {
                            setCheatSessionExpiry($dbConn, $session["SessionID"], date('Y-m-d H:i:s', strtotime($session["ExpiresAt"] . ' + 20 minutes')));
                            setCheatSessionLastHeartbeat($dbConn, $session["SessionID"], gmdate('Y-m-d H:i:s'));
                        }

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