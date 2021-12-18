<?php
    function ConvertEURToUSD($amount)
    {
        $url = "https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
        $xmlRaw = file_get_contents($url);
        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = FALSE;
        $doc->loadXML($xmlRaw);
        $node1 = $doc->getElementsByTagName('Cube')->item(0);
        foreach ($node1->childNodes as $node2)
        {
            foreach ($node2->childNodes as $node3)
            {
                if ($node3->getAttribute('currency') == "USD")
                    return $amount * $node3->getAttribute('rate');
            }
        }

        return $amount;
    }

    function ConvertUSDToEUR($amount)
    {
        $url = "https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
        $xmlRaw = file_get_contents($url);
        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = FALSE;
        $doc->loadXML($xmlRaw);
        $node1 = $doc->getElementsByTagName('Cube')->item(0);
        foreach ($node1->childNodes as $node2)
        {
            foreach ($node2->childNodes as $node3)
            {
                if ($node3->getAttribute('currency') == "USD")
                    return $amount / $node3->getAttribute('rate');
            }
        }

        return $amount;
    }
?>