<?php
    define('CBR_API_ENDPOINT', 'http://www.cbr.ru/scripts/XML_daily.asp');

    function GetRate($currency)
    {
        $xmlRaw = file_get_contents(CBR_API_ENDPOINT);
        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = FALSE;
        $doc->loadXML($xmlRaw);

        $valutes = $doc->getElementsByTagName('Valute');
        foreach ($valutes as $valute)
        {
            $charCode = $valute->getElementsByTagName('CharCode')->item(0)->nodeValue;
            $value = $valute->getElementsByTagName('Value')->item(0)->nodeValue;

            if ($charCode == $currency)
                return (float)str_replace(',', '.', $value);
        }

        http_response_code(400);
    }

    function ConvertEURToRUB($amount)
    {
        $rate = GetRate("EUR");

        return round($rate * $amount, 2);
    }

    function ConvertUSDToRUB($amount)
    {
        $rate = GetRate("USD");

        return round($rate * $amount, 2);
    }

    function ConvertEURToUSD($amount)
    {
        $amountInRUB = ConvertEURToRUB($amount);

        $rate = GetRate("USD");

        return round($amountInRUB / $rate, 2);
    }

    function ConvertUSDToEUR($amount)
    {
        $amountInRUB = ConvertUSDToRUB($amount);

        $rate = GetRate("EUR");

        return round($amountInRUB / $rate, 2);
    }
?>