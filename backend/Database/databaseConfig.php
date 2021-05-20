<?php
	define('DBSERVERNAME', 'localhost');
	define('DBUSERNAME', 'root');
	define('DBPASSWORD', 'root');
	define('DBNAME', 'Maple');
	
	$dbConn = mysqli_connect(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME);
	
	if (!$dbConn)
	{
		die("Database connection failed!");
	}
?>