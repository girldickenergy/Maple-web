<?php
    define('PAYDASH_API_KEY', '5dac6ca0-6a93-4fdb-a375-9da578358de2');
    define('PAYDASH_CREATE_ORDER_URL', 'https://paydash.co.uk/api/merchant/create');
    define('PAYDASH_CHECKOUT_URL', 'https://paydash.co.uk/checkout/');

    function GetCheckoutURL($paymentID)
    {
        return PAYDASH_CHECKOUT_URL.$paymentID;
    }

    function CreateOrder($email, $amount, $webhookURL, $returnURL): array
    {
        $orderData = json_encode(array(
            'apiKey' => PAYDASH_API_KEY,
            'email' => $email,
            'amount' => $amount,
            'webhookURL' => $webhookURL,
            'returnURL' => $returnURL
        ));

        $curl = curl_init(PAYDASH_CREATE_ORDER_URL);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $orderData);

        $jsonResponse = curl_exec($curl);

        if (curl_errno($curl))
        {
            curl_close($curl);

            return array(
                'code' => 1,
                'error' => curl_error($curl)
            );
        }

        curl_close($curl);

        $response = json_decode($jsonResponse, true);

        if ($response['status'] == 'success')
        {
            return array(
                'code' => 0,
                'paymentID' => $response['response']
            );
        }
        else
        {
            return array(
                'code' => 1,
                'error' => $response['response']
            );
        }
    }

    function Redirect($paymentID)
    {
        header("Location: ".GetCheckoutURL($paymentID));
    }
?>