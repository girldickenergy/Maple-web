<?php
	require_once "../backend/Database/databaseHandler.php";
	require_once "sessionHandler.php";
	
	$currentSession = getSession($dbConn);
	if (isset($_GET["login"]))
	{
		if ($currentSession == null)
		{
			createSession($dbConn, 1, false);
			die("You're now logged in!");
		}
		else
		{
			die("You're already logged in!");
		}
	}
	else if (isset($_GET["logout"]))
	{
		if ($currentSession == null)
		{
			die("You're already logged out!");
		}
		else
		{
			destroySession($dbConn);
			die("You're now logged out!");
		}
	}
	else if (isset($_GET["terminate"]))
	{
		terminateAllSessions($dbConn, 1);
		die("Terminated all sessions!");
	}
	else
	{
		if ($currentSession == null)
		{
			die("You're not logged in!");
		}
		else
		{
			die("You're logged in!");
		}
	}
?>