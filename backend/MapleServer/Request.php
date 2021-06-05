<?php
    require_once "Login.php";
    require_once "Heartbeat.php";

    //                                       V this is PHP7 trickery
    //                                       if useragent == null, return null rather than an error
    $useragent = $_SERVER['HTTP_USER_AGENT'] ?? null;

    if ($useragent != "mapleserver/flash is a cutie")
        DieFake();

    $type = $_POST["type"] ?? null;
    switch($type) {
        case null:
            DieFake();
            break;
        case 'l':
            $username = $_POST["username"] ?? null;
            $password = $_POST["password"] ?? null;
            $hwid = $_POST["hwid"] ?? null;
            $ip = $_POST["ip"] ?? null;
            if ($username == null || $password == null || $hwid == null || $ip == null)
                DieFake();
            return LoginFromServer($username, $password, $hwid, $ip);
        case 'h':
            $session = $_POST["session"] ?? null;
            $hwid = $_POST["hwid"] ?? null;
            $ip = $_POST["ip"] ?? null;
            if ($session == null || $hwid == null || $ip == null)
                DieFake();
            return Heartbeat($session, $hwid, $ip);
        case 'm':
            break;
        case "ml":
            break;
    }

    function DieFake()
    {
        die("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this server.</p><hr><address>Apache/2.4.29 (Ubuntu) Server at maple.software Port 443</address></body></html>");
    }
?>