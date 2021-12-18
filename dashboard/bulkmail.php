<?php
	require_once "../backend/Mail/mailer.php";
	require_once "../backend/Database/databaseHandler.php";
	$users = getAllUsers($dbConn);
	set_time_limit(0);
	foreach ($users as &$user)
	{
		if (($user[4] & perm_activated) && (($user[4] & perm_banned) == 0) && $user[0] > 14)
		{
			echo 'email sent to '.$user[1].' ('.$user[2].')<br>';
			sendDiscordEmail($user[2], $user[1]);
		}
	}
?>