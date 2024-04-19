<?php
    define("PLISIO_API_KEY", "j5LBTxCE0eVpukcNpcN1BQu-lJxy4D-wQQFqslBUJxfXuOPwRoPzUrBDkpfuyy-A");
    define("PLISIO_INVOICE_ENDPOINT", "https://api.plisio.net/api/v1/invoices/new");

    function CreateOrder($name, $amount, $amountInRubles, $currency, $userID, $userEmail, $productID)
    {
        $invoiceParams = [
            'currency' => 'BTC',
            'order_name' => $userID.'|'.$productID.'|'.$amountInRubles,
            'order_number' => bin2hex(random_bytes(20)),
            'description' => $name,
            'source_currency' => $currency,
            'source_amount' => $amount,
            'email' => $userEmail,
            'api_key' => PLISIO_API_KEY
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, PLISIO_INVOICE_ENDPOINT.'?'.http_build_query($invoiceParams));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $jsonResponse = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

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

        if ($responseCode == 200)
        {
            return array(
                'code' => 0,
                'gatewayURL' => $response['data']['invoice_url']
            );
        }

        return array(
            'code' => 1,
            'error' => $response['data']['name']
        );
    }

    function Redirect($gatewayURL)
    {
        header("Location: ".$gatewayURL);
    }
?>