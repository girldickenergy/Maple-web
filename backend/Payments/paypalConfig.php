<?php
require_once __DIR__."../../../vendor/autoload.php";

use Omnipay\Omnipay;

define('CLIENT_ID', 'ATWW1zHMIAZYbdrVGcdOE2rdT98sJdhe1EeWnb9lEZH2huOgz1fzCkc2EXSU-5ZUmZHHGTvZzSuYDokx');
define('CLIENT_SECRET', 'ENm1nMcdUxGRlFxNe1P0uo_t21UetV2a4JBceltZXnf8DvwWLPPB0KcoJJTpMqz0KSO686OFYsYJrgCU');

define('PAYPAL_RETURN_URL', 'https://maple.software/dashboard/payment');
define('PAYPAL_CANCEL_URL', 'https://maple.software/dashboard/paymentCancelled');
define('PAYPAL_CURRENCY', 'EUR');

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(false);