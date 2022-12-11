<?php
    define('INVALID_REQUEST', -1);
    define('SUCCESS', 0);
    define('INVALID_CREDENTIALS', 1);
    define('VERSION_MISMATCH', 2);
    define('HWID_FAILURE', 3);
    define('USER_BANNED', 4);
    define('INVALID_SESSION', 5);
    define('NOT_SUBSCRIBED', 6);

    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (isset($useragent))
        if ($useragent != "mapleserver/azuki is a cutie")
            dieFake();

    require_once "database/usersDatabase.php";
    require_once "database/sessionsDatabase.php";
    require_once "database/subscriptionsDatabase.php";
    require_once "database/productsDatabase.php";
    require_once "database/gamesDatabase.php";
    require_once "database/cheatsDatabase.php";
    require_once "datetime/datetimeUtilities.php";
    require_once "discord/discordAPI.php";

    if (isset($_POST["t"])) //request type
    {
        switch ($_POST["t"])
        {
            case 0: //login
                if (isset($_POST["u"]) && isset($_POST["p"]) && isset($_POST["v"]) && isset($_POST["h"]) && isset($_POST["i"])) //username, password, loader version, hwid, ip
                {
                    $user = GetUserByName($_POST["u"]);
                    if ($user == null || !password_verify($_POST["p"], $user["Password"]))
                        constructResponse(INVALID_CREDENTIALS);

                    if ($_POST["v"] != "l-11122022")
                        constructResponse(VERSION_MISMATCH);

                    if ($_POST["h"] == "840ECE1E3D1D64AF7FA7034D572798F8") //medusa's HWID ban (used stolen cc and is extremely retarded)
                        constructResponse(INVALID_REQUEST);

                    if ($_POST["h"] == "0CE1644D3E3BC4DBD9E99BD621C5E748") //uid 1479 hwid ban (big chargeback, fucked up my morning :c)
                        constructResponse(INVALID_REQUEST);

                    if ($user["HWID"] != $_POST["h"])
                    {
                        if ($user["HWID"] != null && $user["HWIDChangedAt"] != null && date('Y-m-d H:i:s', strtotime($user["HWIDChangedAt"] . ' + 1 week')) > gmdate('Y-m-d H:i:s'))
                            constructResponse(HWID_FAILURE);

                        if ($user["HWID"] != null)
                            SetHWIDChangedAt($user["ID"], gmdate("Y-m-d H:i:s", time()));

                        SetHWID($user["ID"], $_POST["h"]);
                    }

                    if ($user["Permissions"] & perm_banned)
                        constructResponse(USER_BANNED);

                    TerminateAllNonWebSessions($user["ID"]);
                    $sessionToken = CreateSession($user["ID"], $_POST["i"], SESSION_LOADER, gmdate('Y-m-d H:i:s', time() + (60 * 20))); //current utc datetime + 20 minutes

                    $discordID = $user["DiscordID"];
                    $avatarHash = "-1";
                    if ($discordID != NULL)
                    {
                        $avatarHash = GetUserAvatarHash($discordID);
                        if ($avatarHash == NULL || empty($avatarHash))
                            $avatarHash = "-1";
                    }
                    else
                        $discordID = "-1";

                    $games = array();
                    foreach(GetAllGames() as $game)
                    {
                        $games[] = array(
                            'ID' => $game["ID"],
                            'Name' => $game["Name"]
                        );
                    }

                    $cheats = array();
                    foreach(GetAllCheats() as $cheat)
                    {
                        $subscription = GetSubscription($user["ID"], $cheat["ID"]);

                        $startsAt = 0;
                        foreach (GetProductsByCheatID($cheat["ID"]) as $product)
                        {
                            if ($product["Duration"] == "1 month")
                                $startsAt = $product["Price"];
                        }

                        $cheats[] = array(
                            'ID' => $cheat["ID"],
                            'GameID' => $cheat["GameID"],
                            'ReleaseStreams' => $cheat["ReleaseStreams"],
                            'Name' => $cheat["Name"],
                            'StartingPrice' => $startsAt,
                            'Status' => $cheat["Status"],
                            'ExpiresOn' => ($subscription == null ? "not subscribed" : GetHumanReadableSubscriptionExpiration($subscription["ExpiresOn"]))
                        );
                    }

                    constructResponse(SUCCESS, array(
                            'SessionToken' => $sessionToken,
                            'DiscordID' => $discordID,
                            'DiscordAvatarHash' => $avatarHash,
                            'Games' => $games,
                            'Cheats' => $cheats
                        )
                    );
                }

                break;
            case 1: //loader or image stream
                if (isset($_POST["st"]) && isset($_POST["s"]) && isset($_POST["c"])) //Stream type, SessionToken and CheatID
                {
                    $session = GetSession($_POST["s"]);
                    if ($session != null)
                    {
                        if ($session["Type"] != SESSION_LOADER)
                            constructResponse(INVALID_SESSION);

                        if (GetSubscription($session["UserID"], $_POST["c"]) == null)
                            constructResponse(NOT_SUBSCRIBED);

                        if ($_POST["st"] == 1) // last stream request
                            SetSessionType($session["SessionToken"], SESSION_CHEAT);

                        SetSessionActivity($session["SessionToken"], gmdate('Y-m-d H:i:s', time()));
                        SetSessionExpiration($session["SessionToken"], gmdate('Y-m-d H:i:s', time() + (60 * 10))); //current utc datetime + 10 minutes

                        constructResponse(SUCCESS);
                    }

                    constructResponse(INVALID_SESSION);
                }

                break;
            case 2: //heartbeat
                if (isset($_POST["s"])) //SessionToken
                {
                    $session = GetSession($_POST["s"]);
                    if ($session != null)
                    {
                        if ($session["Type"] != SESSION_CHEAT)
                            constructResponse(INVALID_SESSION);

                        SetSessionActivity($session["SessionToken"], gmdate('Y-m-d H:i:s', time()));
                        SetSessionExpiration($session["SessionToken"], gmdate('Y-m-d H:i:s', time() + (60 * 15))); //current utc datetime + 15 minutes

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