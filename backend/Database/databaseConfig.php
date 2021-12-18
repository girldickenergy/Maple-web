<?php
	define('DBSERVERNAME', 'localhost');
	define('DBUSERNAME', 'root');
	define('DBPASSWORD', '62cuWAFykrzCtBv5');
	define('DBNAME', 'Maple');
	
	$dbConn = mysqli_connect(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME);
	
	if (!$dbConn)
	{
		die("Database connection failed!");
	}
?>