<?php
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (isset($useragent))
        if ($useragent != "mapleserver/azuki is a cutie")
            dieFake();

    require_once "../backend/Database/databaseHandler.php";
    require_once "../backend/Sessions/sessionHandler.php";
    
    if (isset($_POST["h"]) && isset($_POST["b"]) && isset($_POST["v"]) && isset($_POST["u"])) 
    // h = hash | b = build/release stream of osu | v = internal version | u = update datetime in string
    {
        $ac = getAnticheatByNameAndBuild($dbConn, "osu!auth", $_POST["b"]);

        $acHash = $ac["fileHash"];

        if ($acHash != $_POST["h"])
        {
            addToAnticheatUpdates($dbConn, $ac["id"], $_POST["v"], $_POST["h"], $_POST["u"]);
            setAnticheatDateTime($dbConn, $ac["id"], $_POST["u"]);
            setAnticheatInternalVersion($dbConn, $ac["id"], intval($_POST["v"]));
        }
    }

    function dieFake()
    {
        die("<!DOCTYPE HTML PUBLIC '-//IETF//DTD HTML 2.0//EN'><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this server.</p></body></html>");
    }
?>