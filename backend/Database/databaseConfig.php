<?php
	define('DBSERVERNAME', 'localhost');
	define('DBUSERNAME', 'root');
	define('DBPASSWORD', /*'CuNZv9Dp54QM3rHW'*/ 'root');
	define('DBNAME', 'Maple');
	
	$dbConn = mysqli_connect(DBSERVERNAME, DBUSERNAME, DBPASSWORD, DBNAME);
	
	if (!$dbConn)
	{
		die("Database connection failed!");
	}
?>