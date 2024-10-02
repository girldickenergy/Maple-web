<?php
    if (!isset($_GET["userId"]) || !isset($_GET["productId"]))
    {
        http_response_code(404);
        die();
    }
    else
    {
        require_once "../../backend/database/productsDatabase.php";
        require_once "../../backend/database/cheatsDatabase.php";
        require_once "../../backend/database/gamesDatabase.php";
        require_once "../../backend/database/usersDatabase.php";
        require_once "../../backend/Payments/sellixAPI.php";
        require_once "../../backend/currency/currencyConverter.php";

        $user = GetUserByID($_GET["userId"]);
        $product = GetProductByID($_GET["productId"]);
        $cheat = GetCheatByID($product["CheatID"]);
        $game = GetGameByID($cheat["GameID"]);

        if ($user != null && $product != null && $cheat != null && $game != null)
        {
            if ($product["IsAvailable"])
            {
                $productFullName = $cheat["Name"]." ".$product["Name"]." for ".$game["Name"];

                $price = $product["Price"];
                $priceInUSD = ConvertEURToUSD($product["Price"]);
                $priceInRUB = ConvertEURToRUB($product["Price"]);

                $orderResult = CreateOrder($productFullName, $price, $priceInRUB, "", "EUR", $user["ID"], $user['Email'], $product["ID"], "https://maple.software/dashboard/store?s=0");
                if ($orderResult['code'] == 0)
                    Redirect($orderResult['gatewayURL']);

                die($orderResult['error']);
            }
            else
            {
                die("Product unavailable.");
            }
        }
        else
        {
            die("Invalid parameters.");
        }
    }
?>