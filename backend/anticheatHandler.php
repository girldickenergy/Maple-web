<?php
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (isset($useragent))
        if ($useragent != "mapleserver/azuki is a cutie")
            dieFake();

    require_once "database/gamesDatabase.php";
    require_once "database/cheatsDatabase.php";

    if (isset($_POST["i"]) && isset($_POST["s"]) && isset($_POST["c"]))
    {
        $game = GetGameByID($_POST["i"]);
        if ($game != NULL)
        {
            SetAnticheatLastCheck($game["ID"], gmdate("Y-m-d H:i:s", time()));

            if ($game["AnticheatFileChecksum"] != $_POST["c"])
            {
                SetAnticheatFileSize($game["ID"], $_POST["s"]);
                SetAnticheatFileChecksum($game["ID"], $_POST["c"]);
                SetAnticheatLastUpdate($game["ID"], gmdate("Y-m-d H:i:s", time()));

                foreach (GetAllCheats() as $cheat)
                {
                    if ($cheat["GameID"] == $game["ID"])
                    {
                        SetStatus($cheat["ID"], CHEAT_STATUS_UNKNOWN);
                        SetLastStatusUpdate($cheat["ID"], gmdate("Y-m-d H:i:s", time()));
                    }
                }

                echo("Success, new data applied");
                die();
            }

            echo("Success");
            die();
        }

        echo("Game not found");
        die();
    }

    echo("Invalid request");
    die();

    function dieFake()
    {
        die("<!DOCTYPE HTML PUBLIC '-//IETF//DTD HTML 2.0//EN'><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this server.</p></body></html>");
    }
?>