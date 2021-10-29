<?php
	define('TOKEN', 'ODk0ODUxODI2ODM3NTE2Mjk4.YVwBtQ.hgkSaEoKUqa_v4KEg9RGlo3MKbQ');
	define('OAUTH2_CLIENT_ID', '894851826837516298');
	define('OAUTH2_CLIENT_SECRET', 'FfBcjj9s6z8rQOtRgtpwSVWpDh4uNBx9');
	define('AUTHORIZE_URL', 'https://discord.com/api/oauth2/authorize?client_id=894851826837516298&redirect_uri=https%3A%2F%2Fmaple.software%2Fdashboard%2Fsettings&response_type=code&scope=identify');
	define('TOKEN_URL', 'https://discordapp.com/api/oauth2/token');
	define('USER_INFO_URL', 'https://discordapp.com/api/users/');

	function redirectToDiscordOAUTH()
	{
		header('Location: ' . AUTHORIZE_URL);
		die();
	}

	function getUserIDFromCode($code)
	{
		$token = discordAPIRequest(TOKEN_URL, false, null, array(
			"grant_type" => "authorization_code",
			'client_id' => OAUTH2_CLIENT_ID,
			'client_secret' => OAUTH2_CLIENT_SECRET,
			'redirect_uri' => 'https://maple.software/dashboard/settings',
			'code' => $code
		));

		$currentUserInfo = discordAPIRequest(USER_INFO_URL . '@me', false, $token->access_token);
		
		return $currentUserInfo->id;
	}

	function getUserFullNameFromID($id)
	{
		$userInfo = discordAPIRequest(USER_INFO_URL . $id, true, TOKEN);
		
		return $userInfo->username . '#' . $userInfo->discriminator;
	}

	function getUserAvatarHash($id)
	{
		$userInfo = discordAPIRequest(USER_INFO_URL . $id, true, TOKEN);
		
		return $userInfo->avatar;
	}

	function discordAPIRequest($url, $isBot = false, $token = null, $post = null, $headers = array())
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		if(isset($post))
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

		$headers[] = 'Accept: application/json';

		if(isset($token))
			$headers[] = 'Authorization: ' . ($isBot ? 'Bot ' : 'Bearer ') . $token;

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch);
		return json_decode($response);
	}
?>