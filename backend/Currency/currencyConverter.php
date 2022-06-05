<?php
    function ConvertEURToRUB($amount)
    {
        $rates = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'), true);

        return round($rates["Valute"]["EUR"]["Value"] * $amount, 2);
    }

    function ConvertUSDToRUB($amount)
    {
        $rates = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'), true);

        return round($rates["Valute"]["USD"]["Value"] * $amount, 2);
    }

    function ConvertEURToUSD($amount)
    {
        $amountInRUB = ConvertEURToRUB($amount);

        $rates = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'), true);

        return round($amountInRUB / $rates["Valute"]["USD"]["Value"], 2);
    }

    function ConvertUSDToEUR($amount)
    {
        $amountInRUB = ConvertUSDToRUB($amount);

        $rates = json_decode(file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js'), true);

        return round($amountInRUB / $rates["Valute"]["EUR"]["Value"], 2);
    }
?>