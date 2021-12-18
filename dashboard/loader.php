<?php
	require_once "../backend/Database/databaseHandler.php";
	require_once "../backend/Sessions/sessionHandler.php";
	$currentSession = getSession($dbConn);
	if ($currentSession == null)
	{
		header("Location: ../auth/login");
		die();
	}
	
	global $dbConn;
	$user = getUserById($dbConn, $currentSession["UserID"]);
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

    if (getSubscription($dbConn, $currentSession["UserID"], 0) == NULL && getSubscription($dbConn, $currentSession["UserID"], 1) == NULL)
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