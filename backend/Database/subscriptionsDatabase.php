<?php
    require "databaseConfig.php";

    function GetSubscription($userID, $cheatID)
    {
        global $DBConnection;

        $query = "SELECT * FROM Subscriptions WHERE UserID = ? AND CheatID = ? LIMIT 1;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "ii", $userID, $cheatID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    function GetAllSubscriptions()
    {
        global $DBConnection;

        $query = "SELECT * FROM Subscriptions;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function GetAllUserSubscriptions($userID)
    {
        global $DBConnection;

        $query = "SELECT * FROM Subscriptions WHERE UserID = ?;";
        $stmt = mysqli_stmt_init($DBConnection);
        if (!mysqli_stmt_prepare($stmt, $query))
            return null;

        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function AddOrExtendSubscription($userID, $cheatID, $duration)
    {
        global $DBConnection;

        $currentSubscription = GetSubscription($userID, $cheatID);
        if ($currentSubscription != null)
        {
            $query = "UPDATE Subscriptions SET ExpiresOn = ? WHERE UserID = ? AND CheatID = ?;";
            $stmt = mysqli_stmt_init($DBConnection);
            if (!mysqli_stmt_prepare($stmt, $query))
            {
                return false;
            }

            $currentExpiry = date("Y-m-d", strtotime($currentSubscription["ExpiresOn"]));
            mysqli_stmt_bind_param($stmt, "sii", date('Y-m-d', strtotime($currentExpiry.' + '.$duration)), $userID, $cheatID);
            mysqli_stmt_execute($stmt);

            return true;
        }
        else
        {
            $query = "INSERT INTO Subscriptions (UserID, CheatID, StartedOn, ExpiresOn) VALUES (?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($DBConnection);
            if (!mysqli_stmt_prepare($stmt, $query))
            {
                return false;
            }

            mysqli_stmt_bind_param($stmt, "iiss", $userID, $cheatID, gmdate('Y-m-d'), gmdate('Y-m-d', strtotime('+'.$duration)));
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            return true;
        }
    }
?>