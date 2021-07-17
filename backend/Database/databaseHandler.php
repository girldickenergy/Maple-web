<?php
    define("perm_normal", bindec("00000001"));
    define("perm_admin",  bindec("00000010"));

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
	
	function activateAccount($dbConn, $id)
	{
		$query = "UPDATE Users SET IsActivated = 1 WHERE ID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		
		return true;
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

    function setIsActivated($dbConn, $id, $isActivated)
    {
        $query = "UPDATE Users SET IsActivated = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "ii", $isActivated, $id);
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

    function setFullExpiry($dbConn, $id, $fullExpiry)
    {
        $query = "UPDATE Users SET MapleFullExpiresAt = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "si", $fullExpiry, $id);
        mysqli_stmt_execute($stmt);

        return true;
    }

    function setLiteExpiry($dbConn, $id, $liteExpiry)
    {
        $query = "UPDATE Users SET MapleLiteExpiresAt = ? WHERE ID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return false;
        }

        mysqli_stmt_bind_param($stmt, "si", $liteExpiry, $id);
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
	
	function paymentExists($dbConn, $paymentId)
	{
		$query = "SELECT * FROM Payments WHERE PPPaymentID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return true;
		}
		
		mysqli_stmt_bind_param($stmt, "s", $paymentId);
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
	
	function addPayment($dbConn, $userId, $maplePoints, $amount, $paymentId, $payerId, $payerEmail, $status)
	{
		$query = "INSERT INTO Payments (UserID, MaplePoints, Amount, PPPaymentID, PPPayerID, PPPayerEmail, Status, CompletedAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "iidsssss", $userId, $maplePoints, $amount, $paymentId, $payerId, $payerEmail, $status, gmdate("Y-m-d H:i:s", time()));
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
?>