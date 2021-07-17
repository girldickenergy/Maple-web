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
                $mapleLiteExpiresAt = "not subscribed";
                if ($user["MapleLiteExpiresAt"] != null)
                {
                    if (date("Y", strtotime($user["MapleLiteExpiresAt"])) == 2038)
                    {
                        $mapleLiteExpiresAt = "never";
                    }
                    else if ($user["MapleLiteExpiresAt"] > gmdate("Y-m-d H:i:s", time()))
                    {
                        $mapleLiteExpiresAt = date("F jS, Y", strtotime($user["MapleLiteExpiresAt"]));
                    }
                }

                $mapleFullExpiresAt = "not subscribed";
                if ($user["MapleFullExpiresAt"] != null)
                {
                    if (date("Y", strtotime($user["MapleFullExpiresAt"])) == 2038)
                    {
                        $mapleFullExpiresAt = "never";
                    }
                    else if ($user["MapleFullExpiresAt"] > gmdate("Y-m-d H:i:s", time()))
                    {
                        $mapleFullExpiresAt = date("F jS, Y", strtotime($user["MapleFullExpiresAt"]));
                    }
                }

                constructResponse(SUCCESS, array(
                    'UID' => $user["ID"],
                    'MaplePoints' => $user["MaplePoints"],
                    'MapleLiteExpiresAt' => $mapleLiteExpiresAt,
                    'MapleFullExpiresAt' => $mapleFullExpiresAt));
            }

		    constructResponse(USER_NOT_FOUND);
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