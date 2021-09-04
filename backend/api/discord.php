<?php
    define('INVALID_REQUEST', -1);
    define('SUCCESS', 0);
    define('USER_NOT_FOUND', 1);

    require_once "../Database/databaseHandler.php";

	if (isset($_GET["t"]))
	{
		if ($_GET["t"] == 0 && isset($_GET["u"]))
		{
		    $user = getUserByDiscordID($dbConn, $_GET["u"]);
		    if ($user != null)
		    {
                $mapleLiteExpiresAt = getSubscriptionExpiry($dbConn, $user["ID"], 0);
                $mapleFullExpiresAt = getSubscriptionExpiry($dbConn, $user["ID"], 1);

                constructResponse(SUCCESS, array(
                    'UID' => $user["ID"],
                    'MaplePoints' => $user["MaplePoints"],
                    'MapleLiteExpiresAt' => $mapleLiteExpiresAt,
                    'MapleFullExpiresAt' => $mapleFullExpiresAt));
            }

		    constructResponse(USER_NOT_FOUND);
		}
        else if ($_GET["t"] == 1)
        {
            $anticheats = array();
            foreach(getAllAntiCheats($dbConn) as $anticheat)
                $anticheats[$anticheat[2]] = $anticheat[5];

            constructResponse(SUCCESS, $anticheats);
        }
        else if ($_GET["t"] == 2)
        {
            $subscribedUsers = array();
            foreach(getAllSubscriptions($dbConn) as $subscription)
            {
                $user = getUserById($dbConn, $subscription[0]);
                if ($user != null && $user["DiscordID"] != null && !in_array($user["DiscordID"], $subscribedUsers))
                    array_push($subscribedUsers, $user["DiscordID"]);
            }

            constructResponse(SUCCESS, $subscribedUsers);
        }

		constructResponse(INVALID_REQUEST);
	}

    function constructResponse($code, $params = array())
    {
        $response = array('code' => $code);
        $response = array_merge($response, $params);

        echo json_encode($response);
        die();
    }
?>