<?php
	session_start();
	if (isset($_SESSION["isLoggedIn"]))
	{
		$params = session_get_cookie_params();
		setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
		session_destroy();
	}
	
	header('Location: https://maple.software/');
	die();
?>