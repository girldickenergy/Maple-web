<?php
    define("SESSION_WEB_PC", 0);
    define("SESSION_WEB_MOBILE", 1);
    define("SESSION_LOADER", 2);
    define("SESSION_CHEAT", 3);

    require_once "databaseConfig.php";

    function CreateSession($userID, $ip, $type, $expiration)
    {
        global $DBConnection;

        $sessionToken = bin2hex(random_bytes(16));
        if ($type == SESSION_WEB_PC || $type == SESSION_WEB_MOBILE)
            setcookie("m_Session", $sessionToken, strtotime($expiration), "/", NULL, true);

        $query = "INSERT INTO Sessions (UserID, IP, Type, SessionToken, ActiveAt, ExpiresAt) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($DBConnection);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            mysqli_stmt_bind_param($stmt, "isisss", $userID, $ip, $type, $sessionToken, gmdate('Y-m-d H:i:s', time()), $expiration);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        return $sessionToken;
    }

    function GetSession($sessionToken)
    {
        global $DBConnection;

        $query = "SELECT * FROM Sessions WHERE SessionToken = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "s", $sessionToken);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetCurrentSession()
    {
        global $DBConnection;

        if (isset($_COOKIE["m_Session"]))
        {
            $query = "SELECT * FROM Sessions WHERE SessionToken = ? LIMIT 1;";
            $stmt = mysqli_stmt_init($DBConnection);
            if (!mysqli_stmt_prepare($stmt, $query))
                return null;

            mysqli_stmt_bind_param($stmt, "s", $_COOKIE["m_Session"]);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            return mysqli_fetch_assoc($result);
        }

        return null;
    }

    function GetAllCheatSessions()
    {
        global $DBConnection;

        $query = "SELECT * FROM Sessions WHERE Type = ".SESSION_CHEAT.";";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function GetAllUserSessions($userID)
    {
        global $DBConnection;

        $query = "SELECT * FROM Sessions WHERE UserID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function TerminateCurrentSession()
    {
        global $DBConnection;

        $currentSession = GetCurrentSession();
        if ($currentSession != null)
        {
            $query = "DELETE FROM Sessions WHERE SessionToken = ?;";
            $stmt = mysqli_stmt_init($DBConnection);
            if (mysqli_stmt_prepare($stmt, $query))
            {
                mysqli_stmt_bind_param($stmt, "s", $currentSession["SessionToken"]);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }

        setcookie("m_Session", "", time() - 3600, "/");
    }

    function TerminateSession($sessionToken)
    {
        global $DBConnection;

        $currentSession = GetCurrentSession();
        if ($currentSession != null && $currentSession["SessionToken"] == $sessionToken)
            setcookie("m_Session", "", time() - 3600, "/");

        $query = "DELETE FROM Sessions WHERE SessionToken = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            mysqli_stmt_bind_param($stmt, "s", $sessionToken);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    function TerminateAllSessions($userID)
    {
        global $DBConnection;

        $currentSession = GetCurrentSession();
        $query = $currentSession == null ? "DELETE FROM Sessions WHERE UserID = ?;" : "DELETE FROM Sessions WHERE UserID = ? AND SessionToken <> ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            if ($currentSession == null)
                mysqli_stmt_bind_param($stmt, "i", $userID);
            else
                mysqli_stmt_bind_param($stmt, "is", $userID, $currentSession["SessionToken"]);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    function TerminateAllNonWebSessions($userID)
    {
        global $DBConnection;

        $query = "DELETE FROM Sessions WHERE UserID = ? AND Type > 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            mysqli_stmt_bind_param($stmt, "i", $userID);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    function SetSessionType($sessionToken, $type)
    {
        global $DBConnection;

        $query = "UPDATE Sessions SET Type = ? WHERE SessionToken = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            mysqli_stmt_bind_param($stmt, "is", $type, $sessionToken);
            mysqli_stmt_execute($stmt);
        }
    }

    function SetSessionActivity($sessionToken, $activeAt)
    {
        global $DBConnection;

        $query = "UPDATE Sessions SET ActiveAt = ? WHERE SessionToken = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            mysqli_stmt_bind_param($stmt, "ss", $activeAt, $sessionToken);
            mysqli_stmt_execute($stmt);
        }
    }

    function SetSessionExpiration($sessionToken, $expiresAt)
    {
        global $DBConnection;

        $query = "UPDATE Sessions SET ExpiresAt = ? WHERE SessionToken = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (mysqli_stmt_prepare($stmt, $query))
        {
            mysqli_stmt_bind_param($stmt, "ss", $expiresAt, $sessionToken);
            mysqli_stmt_execute($stmt);
        }
    }
?>