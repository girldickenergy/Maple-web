<?php
    define("perm_normal", bindec("00000000"));
    define("perm_activated", bindec("00000001"));
    define("perm_admin",  bindec("00000010"));
    define("perm_banned",  bindec("00000100"));

	require "databaseConfig.php";

	function isUsernameTaken($dbConn, $username)
	{
		$query = "SELECT * FROM Users WHERE Username = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return true; //todo: error handler?
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		if (mysqli_fetch_assoc($result))
		{
			mysqli_stmt_close($stmt);
			return true;
		}
		mysqli_stmt_close($stmt);
		return false;
	}
	
	function isEmailInUse($dbConn, $email)
	{
		$query = "SELECT * FROM Users WHERE Email = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return true; //todo: error handler?
		}
		
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		if (mysqli_fetch_assoc($result))
		{
			mysqli_stmt_close($stmt);
			return true;
		}
		
		mysqli_stmt_close($stmt);
		return false;
	}

	function getAllUsers($dbConn)
    {
        $query = "SELECT * FROM Users;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return null;
        }

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result); // fetch all for all entries
    }

	function addUser($dbConn, $username, $email, $password, $uniqueHash)
	{
		$query = "INSERT INTO Users (Username, Email, Password, UniqueHash) VALUES (?, ?, ?, ?);";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "ssss", $username, $email, password_hash($password, PASSWORD_DEFAULT), $uniqueHash);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		return true;
	}
	
	function getUserByName($dbConn, $username)
	{
		$query = "SELECT * FROM Users WHERE Username = ? LIMIT 1;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return null;
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		return mysqli_fetch_assoc($result);
	}
	
	function getUserById($dbConn, $id)
	{
		$query = "SELECT * FROM Users WHERE ID = ? LIMIT 1;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return null;
		}
		
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		return mysqli_fetch_assoc($result);
	}
	
	function getUserByEmail($dbConn, $email)
	{
		$query = "SELECT * FROM Users WHERE Email = ? LIMIT 1;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return null;
		}
		
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		return mysqli_fetch_assoc($result);
	}
	
	function getUserByUniqueHash($dbConn, $uniqueHash)
	{
		$query = "SELECT * FROM Users WHERE UniqueHash = ? LIMIT 1;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return null;
		}
		
		mysqli_stmt_bind_param($stmt, "s", $uniqueHash);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		return mysqli_fetch_assoc($result);
	}

    function getUserByDiscordID($dbConn, $discordID)
    {
        $query = "SELECT * FROM Users WHERE DiscordID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return null;
        }

        mysqli_stmt_bind_param($stmt, "s", $discordID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    function getSubscription($dbConn, $userID, $cheatID)
    {
        $query = "SELECT * FROM Subscriptions WHERE UserID = ? AND CheatID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return null;
        }

        mysqli_stmt_bind_param($stmt, "ii", $userID, $cheatID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    function getSubscriptionExpiry($dbConn, $userID, $cheatID)
    {
        $expiry = "not subscribed";
        $subscription = getSubscription($dbConn, $userID, $cheatID);
        if ($subscription != null)
        {
            if (date("Y", strtotime($subscription["ExpiresAt"])) == 2038)
                $expiry = "lifetime";
            else
                $expiry = date("F jS, Y", strtotime($subscription["ExpiresAt"]));
        }

        return $expiry;
    }

    function getAllSubscriptions($dbConn)
    {
        $query = "SELECT * FROM Subscriptions;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return null;
        }

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result);
    }

    function getAllGames($dbConn)
    {
        $query = "SELECT * FROM Games;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return null;
        }

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result);
    }

    function getAllCheats($dbConn)
    {
        $query = "SELECT * FROM Cheats;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return null;
        }

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result);
    }
	
	function setEmail($dbConn, $id, $email)
	{
		$query = "UPDATE Users SET Email = ? WHERE ID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "si", $email, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}
	
	function setUniqueHash($dbConn, $id, $uniqueHash)
	{
		$query = "UPDATE Users SET UniqueHash = ? WHERE ID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "si", $uniqueHash, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}

	function setPermissions($dbConn, $id, $permissions)
    {
        $query = "UPDATE Users SET Permissions = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ii", $permissions, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }
	
	function setPassword($dbConn, $id, $password)
	{
		$query = "UPDATE Users SET Password = ? WHERE ID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "si", password_hash($password, PASSWORD_DEFAULT), $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}
	
	function setLastIP($dbConn, $id, $lastIP)
	{
		$query = "UPDATE Users SET LastIP = ? WHERE ID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "si", $lastIP, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}
	
	function setHWID($dbConn, $id, $hwid)
    {
        $query = "UPDATE Users SET HWID = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "si", $hwid, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function setMaplePoints($dbConn, $id, $maplePoints)
    {
        $query = "UPDATE Users SET MaplePoints = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ii", $maplePoints, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function setHWIDResets($dbConn, $id, $hwidResets)
    {
        $query = "UPDATE Users SET HWIDResets = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ii", $hwidResets, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function setDiscordID($dbConn, $id, $discordID)
    {
        $query = "UPDATE Users SET DiscordID = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ii", $discordID, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function setBanReason($dbConn, $id, $banReason)
    {
        $query = "UPDATE Users SET BanReason = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ii", $banReason, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function centappPaymentExists($dbConn, $orderID)
    {
        $query = "SELECT * FROM CentappPayments WHERE OrderID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return true;
        }

        mysqli_stmt_bind_param($stmt, "s", $orderID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_fetch_assoc($result))
        {
            mysqli_stmt_close($stmt);
            return true;
        }

        mysqli_stmt_close($stmt);
        return false;
    }

    function addCentappPayment($dbConn, $userId, $maplePoints, $amount, $orderID, $transactionID)
    {
        $query = "INSERT INTO CentappPayments (UserID, MaplePoints, Amount, OrderID, TransactionID, CompletedAt) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "iidsss", $userId, $maplePoints, $amount, $orderID, $transactionID, gmdate("Y-m-d H:i:s", time()));
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return true;
    }
	
	function coinbasePaymentExists($dbConn, $paymentID)
	{
		$query = "SELECT * FROM CoinbasePayments WHERE PaymentID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return true;
		}
		
		mysqli_stmt_bind_param($stmt, "s", $paymentID);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		if (mysqli_fetch_assoc($result))
		{
			mysqli_stmt_close($stmt);
			return true;
		}
		
		mysqli_stmt_close($stmt);
		return false;
	}
	
	function addCoinbasePayment($dbConn, $userId, $maplePoints, $amount, $paymentId)
	{
		$query = "INSERT INTO CoinbasePayments (UserID, MaplePoints, Amount, PaymentID, CompletedAt) VALUES (?, ?, ?, ?, ?);";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "iidss", $userId, $maplePoints, $amount, $paymentId, gmdate("Y-m-d H:i:s", time()));
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		return true;
	}
	
	function addExchange($dbConn, $userId, $product)
	{
		$query = "INSERT INTO Exchanges (UserID, Product, ExchangedAt) VALUES (?, ?, ?);";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "iis", $userId, $product, gmdate("Y-m-d H:i:s", time()));
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		return true;
	}

    function setSubscriptionExpiry($dbConn, $userID, $cheatID, $expiry)
    {
        if (getSubscription($dbConn, $userID, $cheatID))
        {
            $query = "UPDATE Subscriptions SET ExpiresAt = ? WHERE UserID = ? AND CheatID = ?;";
            $stmt = mysqli_stmt_init($dbConn);
            if (!mysqli_stmt_prepare($stmt, $query))
            {
                return false;
            }

            mysqli_stmt_bind_param($stmt, "sii", $expiry, $userID, $cheatID);
            mysqli_stmt_execute($stmt);

            return true;
        }
        else
        {
            $query = "INSERT INTO Subscriptions (UserID, CheatID, ExpiresAt) VALUES (?, ?, ?);";
            $stmt = mysqli_stmt_init($dbConn);
            if (!mysqli_stmt_prepare($stmt, $query))
            {
                return false;
            }

            mysqli_stmt_bind_param($stmt, "iis", $userID, $cheatID, $expiry);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            return true;
        }
    }
    function getAllAntiCheats($dbConn)
    {
        $query = "SELECT * FROM Anticheats;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return null;
        }

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result);
    }

	function addToAnticheatUpdates($dbConn, $acId, $fileHash, $updateDateTime, $internalVersion)
	{
		$query = "INSERT INTO anticheatupdates (anticheatId, internalVersion, updateDateTime, fileHash, detected) VALUES (?, ?, ?, ?, 1);";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return null;
		}
		
		mysqli_stmt_bind_param($stmt, "iiss", $acId, $internalVersion, $updateDateTime, $fileHash);
		
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

	function getAnticheatByNameAndBuild($dbConn, $name, $build)
	{
		$query = "SELECT * FROM Anticheats WHERE acName = ? AND game = ? LIMIT 1;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return null;
		}
		
		mysqli_stmt_bind_param($stmt, "ss", $name, $build);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		return mysqli_fetch_assoc($result);
	}

	function setAnticheatHash($dbConn, $id, $fileHash)
	{
		$query = "UPDATE Anticheats SET fileHash = ? WHERE id = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "si", $fileHash, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}

	function setAnticheatDateTime($dbConn, $id, $dateTime)
	{
		$query = "UPDATE Anticheats SET updateDateTime = ? WHERE id = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "si", $dateTime, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}

	function setAnticheatInternalVersion($dbConn, $id, $internalVersion)
	{
		$query = "UPDATE Anticheats SET internalVersion = ? WHERE id = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "ii", $internalVersion, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}

	function setAnticheatStatus($dbConn, $id, $status)
	{
		$query = "UPDATE Anticheats SET status = ? WHERE id = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "ii", $status, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}

	function setAnticheatLastCheck($dbConn, $id, $lastCheck)
	{
		$query = "UPDATE Anticheats SET lastCheck = ? WHERE id = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "si", $lastCheck, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}
?>