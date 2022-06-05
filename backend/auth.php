<?php
    define('INVALID_REQUEST', -1);
    define('SUCCESS', 0);
    define('INVALID_CREDENTIALS', 1);
    define('HASH_MISMATCH', 2);
    define('HWID_FAILURE', 3);
    define('USER_BANNED', 4);
    define('INVALID_SESSION', 5);

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
                if (isset($_POST["ha"]) && isset($_POST["i"]) && isset($_POST["h"]) && isset($_POST["u"]) && isset($_POST["p"])) //loader hash, ip, hwid, username and password
                {
                    $user = GetUserByName($_POST["u"]);
                    if ($user == null || !password_verify($_POST["p"], $user["Password"]))
                        constructResponse(INVALID_CREDENTIALS);

                    if ($_POST["ha"] != "1B96D22C07388D905D87968CC6AAE7E055F60C7E46DAD33DAF81B3EA75305EAD")
                        constructResponse(HASH_MISMATCH);

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
                    $sessionToken = CreateSession($user["ID"], $_POST["i"], SESSION_LOADER, gmdate('Y-m-d H:i:s', time() + (60 * 20))); //current utc datetime + 5 minutes

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
                            'Name' => $game["Name"],
                            'ProcessName' => $game["ModuleName"]
                        );
                    }

                    $cheats = array();
                    foreach(GetAllCheats() as $cheat)
                    {
                        $subscription = GetSubscription($user["ID"], $cheat["ID"]);

                        $pricePerMonth = 0;
                        foreach (GetProductsByCheatID($cheat["ID"]) as $product)
                        {
                            if ($product["Duration"] == "1 month")
                                $pricePerMonth = $product["Price"];
                        }

                        $cheats[] = array(
                            'ID' => $cheat["ID"],
                            'GameID' => $cheat["GameID"],
                            'ReleaseStreams' => $cheat["ReleaseStreams"],
                            'Name' => $cheat["Name"],
                            'StartsAt' => $pricePerMonth,
                            'Status' => $cheat["Status"],
                            'ExpiresOn' => ($subscription == null ? "not subscribed" : GetHumanReadableSubscriptionExpiration($subscription["ExpiresOn"]))
                        );
                    }

                    constructResponse(SUCCESS, array(
                            'SessionToken' => $sessionToken,
                            'DiscordID' => $discordID,
                            'AvatarHash' => $avatarHash,
                            'Games' => $games,
                            'Cheats' => $cheats
                        )
                    );
                }

                break;
            case 1: //load
                if (isset($_POST["s"]) && isset($_POST["c"])) //SessionToken and CheatID
                {
                    $session = GetSession($_POST["s"]);
                    if ($session != null)
                    {
                        if ($session["Type"] != SESSION_LOADER)
                            constructResponse(INVALID_SESSION);

                        if (GetSubscription($session["UserID"], $_POST["c"]) == null)
                            constructResponse(INVALID_REQUEST);

                        SetSessionType($session["SessionToken"], SESSION_CHEAT);
                        SetSessionActivity($session["SessionToken"], gmdate('Y-m-d H:i:s', time()));
                        SetSessionExpiration($session["SessionToken"], gmdate('Y-m-d H:i:s', time() + (60 * 5))); //current utc datetime + 5 minutes

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
                        SetSessionExpiration($session["SessionToken"], date('Y-m-d H:i:s', strtotime($session["ExpiresAt"].' + 20 minutes')));

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