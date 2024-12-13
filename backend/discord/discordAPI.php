<?php
    define('TOKEN', '...');
    define('OAUTH2_CLIENT_ID', '921707596589699092');
    define('OAUTH2_CLIENT_SECRET', '...');
    define('AUTHORIZE_URL', 'https://discord.com/api/oauth2/authorize?client_id=921707596589699092&redirect_uri=https%3A%2F%2Fmaple.software%2Fdashboard%2Fsettings&response_type=code&scope=identify');
    define('TOKEN_URL', 'https://discord.com/api/oauth2/token');
    define('USER_INFO_URL', 'https://discord.com/api/users/');

    function RedirectToDiscordOAUTH()
    {
        header('Location: ' . AUTHORIZE_URL);

        die();
    }

    function GetUserIDFromCode($code)
    {
        $token = DiscordAPIRequest(TOKEN_URL, false, null, array(
            "grant_type" => "authorization_code",
            'client_id' => OAUTH2_CLIENT_ID,
            'client_secret' => OAUTH2_CLIENT_SECRET,
            'redirect_uri' => 'https://maple.software/dashboard/settings',
            'code' => $code
        ));

        $currentUserInfo = DiscordAPIRequest(USER_INFO_URL . '@me', false, $token->access_token);

        return $currentUserInfo->id;
    }

    function GetDiscordUserInfo($id)
    {
        return DiscordAPIRequest(USER_INFO_URL . $id, true, TOKEN);
    }

    function DiscordAPIRequest($url, $isBot = false, $token = null, $post = null, $headers = array())
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        if ($post)
        {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        $headers[] = 'Accept: application/json';
        if ($token)
        {
            $headers[] = 'Authorization: ' . ($isBot ? 'Bot ' : 'Bearer ') . $token;
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response);
    }
?>