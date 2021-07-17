<?php
	function createSession($dbConn, $userID, $rememberMe)
	{
		$sessionID = bin2hex(random_bytes(16));
		$expiresAt = time() + ($rememberMe ? (86400 * 30) : 3600);
		setcookie("m_Session", $sessionID, $expiresAt, "/", NULL, true);
		
		$expiresAt = date('Y-m-d H:i:s', $expiresAt);
		$query = "INSERT INTO Sessions (SessionID, UserID, ExpiresAt) VALUES (?, ?, ?);";
		$stmt = mysqli_stmt_init($dbConn);
		if (mysqli_stmt_prepare($stmt, $query))
		{
			mysqli_stmt_bind_param($stmt, "sis", $sessionID, $userID, $expiresAt);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}

    function createCheatSession($dbConn, $userID)
    {
        terminateAllCheatSessions($dbConn, $userID);

        $sessionID = bin2hex(random_bytes(16));
        $expiresAt = time() + (60*60) /*1 hour timeout after session*/;

        $expiresAt = date('Y-m-d H:i:s', $expiresAt);
        $query = "INSERT INTO CheatSessions (SessionID, UserID, ExpiresAt) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($dbConn);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            mysqli_stmt_bind_param($stmt, "sis", $sessionID, $userID, $expiresAt);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        return $sessionID;
    }
	
	function destroySession($dbConn)
	{
		$currentSession = getSession($dbConn);
		if ($currentSession != null)
		{
			$query = "DELETE FROM Sessions WHERE SessionID = ?;";
			$stmt = mysqli_stmt_init($dbConn);
			if (mysqli_stmt_prepare($stmt, $query))
			{
				mysqli_stmt_bind_param($stmt, "s", $currentSession["SessionID"]);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_close($stmt);
			}
		}
		
		setcookie("m_Session", "", time() - 3600, "/");
	}
	
	function getSession($dbConn)
	{
		if (isset($_COOKIE["m_Session"]))
		{
			$query = "SELECT * FROM Sessions WHERE SessionID = ? LIMIT 1;";
			$stmt = mysqli_stmt_init($dbConn);
			if (!mysqli_stmt_prepare($stmt, $query))
			{
				return null;
			}
			
			mysqli_stmt_bind_param($stmt, "s", $_COOKIE["m_Session"]);
			mysqli_stmt_execute($stmt);
			
			$result = mysqli_stmt_get_result($stmt);
			return mysqli_fetch_assoc($result);
		}
		
		return null;
	}

    function getCheatSession($dbConn, $sessionID)
    {
        $query = "SELECT * FROM CheatSessions WHERE SessionID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($dbConn);
        if (!mysqli_stmt_prepare($stmt, $query))
        {
            return null;
        }

        mysqli_stmt_bind_param($stmt, "s", $sessionID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }
	
	function terminateAllSessions($dbConn, $userID)
	{
		$currentSession = getSession($dbConn);
		$query = $currentSession == null ? "DELETE FROM Sessions WHERE UserID = ?;" : "DELETE FROM Sessions WHERE UserID = ? AND SessionID <> ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (mysqli_stmt_prepare($stmt, $query))
		{
			if ($currentSession == null)
			{
				mysqli_stmt_bind_param($stmt, "i", $userID);
			}
			else
			{
				mysqli_stmt_bind_param($stmt, "is", $userID, $currentSession["SessionID"]);
			}
			
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}

    function terminateAllCheatSessions($dbConn, $userID)
    {
        $query = "DELETE FROM CheatSessions WHERE UserID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            mysqli_stmt_bind_param($stmt, "i", $userID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    function setCheatSessionExpiry($dbConn, $sessionID, $expiry)
    {
        $query = "UPDATE CheatSessions SET ExpiresAt = ? WHERE SessionID = ?;";
        $stmt = mysqli_stmt_init($dbConn);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            mysqli_stmt_bind_param($stmt, "ss", $expiry, $sessionID);
            mysqli_stmt_execute($stmt);
        }
    }
?>