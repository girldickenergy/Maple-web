<?php
	require_once "../backend/Database/databaseHandler.php";
	require_once "../backend/Sessions/sessionHandler.php";
	destroySession($dbConn);

	header('Location: https://maple.software/');
	die();
?>