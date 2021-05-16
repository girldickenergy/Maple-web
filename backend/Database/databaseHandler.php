<?php
    define("perm_normal", bindec("00000001"));
    define("perm_admin",  bindec("00000010"));

	require "databaseConfig.php";
	
	function isUsernameTaken($dbConn, $username)
	{
		$query = "SELECT * FROM Users WHERE Username = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return true; //todo: error handler?
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		if (mysqli_fetch_assoc($result))
		{
			mysqli_stmt_close($stmt);
			return true;
		}
		mysqli_stmt_close($stmt);
		return false;
	}
	
	function isEmailInUse($dbConn, $email)
	{
		$query = "SELECT * FROM Users WHERE Email = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return true; //todo: error handler?
		}
		
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		if (mysqli_fetch_assoc($result))
		{
			mysqli_stmt_close($stmt);
			return true;
		}
		
		mysqli_stmt_close($stmt);
		return false;
	}
	
	function addUser($dbConn, $username, $email, $password, $uniqueHash)
	{
		$query = "INSERT INTO Users (Username, Email, Password, UniqueHash) VALUES (?, ?, ?, ?);";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "ssss", $username, $email, password_hash($password, PASSWORD_DEFAULT), $uniqueHash);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		return true;
	}
	
	function getUserByName($dbConn, $username)
	{
		$query = "SELECT * FROM Users WHERE Username = ? LIMIT 1;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return null;
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		return mysqli_fetch_assoc($result);
	}
	
	function getUserById($dbConn, $id)
	{
		$query = "SELECT * FROM Users WHERE ID = ? LIMIT 1;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return null;
		}
		
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		
		$result = mysqli_stmt_get_result($stmt);
		return mysqli_fetch_assoc($result);
	}
	
	function activateAccount($dbConn, $id)
	{
		$query = "UPDATE Users SET IsActivated = 1 WHERE ID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}
	
	function setEmail($dbConn, $id, $email)
	{
		$query = "UPDATE Users SET Email = ? WHERE ID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "si", $email, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}
	
	function setUniqueHash($dbConn, $id, $uniqueHash)
	{
		$query = "UPDATE Users SET UniqueHash = ? WHERE ID = ?;";
		$stmt = mysqli_stmt_init($dbConn);
		if (!mysqli_stmt_prepare($stmt, $query))
		{
			return false;
		}
		
		mysqli_stmt_bind_param($stmt, "si", $uniqueHash, $id);
		mysqli_stmt_execute($stmt);
		
		return true;
	}
?>