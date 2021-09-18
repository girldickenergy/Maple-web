<?php
    define('COINPAYMENTS_MERCHANT_ID', '136b74ecfb21dfa565a36aee1aa94137');
    define('COINPAYMENTS_IPN_SECRET', 'mapleserver-azukiishellacute-nobodycanthinkofthis-ohyeahmaplealsocute');
    define('COINPAYMENTS_CREATE_ORDER', 'https://www.coinpayments.net/index.php');
    define('COINPAYMENTS_IPN_URL', 'https://maple.software/dashboard/payment');

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
            "currency" => "EUR",
            "amountf" => $amount,
            "item_name" => "Maple Points",
            "ipn_url" => COINPAYMENTS_IPN_URL
        );
        return $orderData;
    }
?>