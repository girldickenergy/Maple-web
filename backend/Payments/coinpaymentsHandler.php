<?php
    define('COINPAYMENTS_MERCHANT_ID', '136b74ecfb21dfa565a36aee1aa94137');
    define('COINPAYMENTS_IPN_SECRET', 'mapleserver-azukiishellacute-nobodycanthinkofthis-ohyeahmaplealsocute');
    define('COINPAYMENTS_CREATE_ORDER', 'https://www.coinpayments.net/index.php');
    define('PAYDASH_CHECKOUT_URL', 'https://paydash.co.uk/checkout/');

    function GetURL()
    {
        return COINPAYMENTS_CREATE_ORDER;
    }

    function GenerateFields($amount)
    {
        $orderData = array(
            "cmd" => "_pay",
            "reset" => "1",
            "merchant" => COINPAYMENTS_MERCHANT_ID,
            "currency" => "EUR"
            "amountf" => $amount,
            "item_name" => "Maple Points",
            "ipn_url" => COINPAYMENTS_IPN_URL
        );
        return $orderData;
    }

    function CreateOrder($email, $amount, $webhookURL, $returnURL): array
    {
        $orderData = "cmd=_pay&reset=1&merchant=" . COINPAYMENTS_MERCHANT_ID . "&currency=EUR&amountf=".$amount."&item_name=Maple Points&ipn_url=". COINPAYMENTS_IPN_URL;

        $curl = curl_init(PAYDASH_CREATE_ORDER_URL);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $orderData);

        $jsonResponse = curl_exec($curl);
    }


?>