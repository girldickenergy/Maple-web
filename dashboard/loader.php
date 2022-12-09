<?php
    require_once "../backend/database/usersDatabase.php";
    require_once "../backend/database/sessionsDatabase.php";
    require_once "../backend/database/subscriptionsDatabase.php";

    $currentSession = GetCurrentSession();
    if ($currentSession == null)
    {
        header("Location: ../auth/login");
        die();
    }

    $user = GetUserByID($currentSession["UserID"]);
    if ($user == null)
    {
        header("Location: https://maple.software");
        die();
    }

    if (($user["Permissions"] & perm_activated) == 0)
    {
        header("Location: ../auth/pendingActivation");
        die();
    }

    if ($user["Permissions"] & perm_banned)
    {
        header("Location: banned");
        die();
    }

    if (empty(GetAllUserSubscriptions($currentSession["UserID"])))
    {
        header("Location: ../dashboard");
        die();
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.bin2hex(random_bytes(rand(6, 16))).'.exe');

    echo file_get_contents("C:\Loader.exe").md5(md5($user["Username"])).md5(time());
?>