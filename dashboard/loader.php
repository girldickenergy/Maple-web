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

	$file = "C:\Loader.exe";
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
?>