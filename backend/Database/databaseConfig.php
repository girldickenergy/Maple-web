<?php
	define('DBSERVERNAME', 'localhost');
	define('DBUSERNAME', 'root');
	define('DBPASSWORD', '62cuWAFykrzCtBv5');
	define('DBNAME', 'Maple');

    $DBConnection = mysqli_connect(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME);
	
	if (!$DBConnection)
		die("Database connection failed!");
?>