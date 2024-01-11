<?php
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (isset($useragent))
        if ($useragent != "mapleserver/azuki is a cutie")
            dieFake();

    define("REQUEST_TYPE_USER_INFO", 0);
    define("REQUEST_TYPE_SUBSCRIBERS", 1);
    define("REQUEST_TYPE_ANTICHEAT_INFO", 2);
    define("REQUEST_TYPE_STATUS", 3);
    define("REQUEST_TYPE_SERVER_ONLINE", 4);

    define('INVALID_REQUEST', -1);
    define('SUCCESS', 0);
    define('USER_NOT_FOUND', 1);

    require_once "../database/usersDatabase.php";
    require_once "../database/subscriptionsDatabase.php";
    require_once "../database/productsDatabase.php";
    require_once "../database/gamesDatabase.php";
    require_once "../database/cheatsDatabase.php";
    require_once "../database/sessionsDatabase.php";
    require_once "../datetime/datetimeUtilities.php";

    if (isset($_GET["t"]))
    {
        switch ($_GET["t"])
        {
            case REQUEST_TYPE_USER_INFO:
                if (isset($_GET["u"]))
                {
                    $user = GetUserByDiscordID($_GET["u"]);
                    if ($user != null)
                    {
                        $subscriptions = array();
                        foreach (GetAllUserSubscriptions($user["ID"]) as $subscription)
                        {
                            //TODO: uncomment before release
                            //$product = GetProductByID($subscription["ProductID"]);
                            //$cheat = GetCheatByID($product["CheatID"]);
                            $cheat = GetCheatByID($subscription["CheatID"]);
                            $game = GetGameByID($cheat["GameID"]);
                            $subscriptions[] = array(
                                "Name" => ($cheat["Name"] == NULL ? "unknown cheat" : $cheat["Name"])." for ".($game["Name"] == NULL ? "unknown game" : $game["Name"]),
                                "Expiration" => GetHumanReadableSubscriptionExpiration($subscription["ExpiresOn"]) //TODO: change to ExpiresOn before release
                            );
                        }

                        constructResponse(SUCCESS, array(
                            "UserID" => $user["ID"],
                            "JoinedOn" => GetHumanReadableDate($user["CreatedAt"]),
                            "Subscriptions" => $subscriptions
                        ));
                    }

                    constructResponse(USER_NOT_FOUND);
                }

                break;
            case REQUEST_TYPE_SUBSCRIBERS:
                $subscribers = array();
                foreach (GetAllSubscriptions() as $subscription)
                {
                    $user = GetUserByID($subscription["UserID"]);
                    if ($user != null && $user["DiscordID"] != null && !in_array($user["DiscordID"], $subscribers))
                        $subscribers[] = $user["DiscordID"];
                }

                constructResponse(SUCCESS, $subscribers);

                break;
            case REQUEST_TYPE_ANTICHEAT_INFO:
                $anticheatInfo = array();
                foreach (GetAllGames() as $game)
                    $anticheatInfo[$game["Name"]] = $game["AnticheatFileChecksum"];

                constructResponse(SUCCESS, $anticheatInfo);
                break;
            case REQUEST_TYPE_STATUS:
                $statuses = array();
                foreach (GetAllCheats() as $cheat)
                {
                    $game = GetGameByID($cheat["ID"]);
                    $statuses[] = array(
                        "Name" => ($cheat["Name"] == NULL ? "unknown cheat" : $cheat["Name"])." for ".($game["Name"] == NULL ? "unknown game" : $game["Name"]),
                        "Status" => $cheat["Status"]
                    );
                }

                constructResponse(SUCCESS, array(
                    "Statuses" => $statuses
                ));
                
                break;
            case REQUEST_TYPE_SERVER_ONLINE:
                constructResponse(SUCCESS, array(
                    "OnlineCount" => count(GetAllCheatSessions())
                ));

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