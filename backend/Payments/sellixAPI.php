<?php
    define("SELLIX_API_KEY", "...");
    define("SELLIX_WEBHOOK_SECRET", "...");
    define("SELLIX_CHECKOUT_ENDPOINT", "https://dev.sellix.io/v1/payments");

    function CreateOrder($name, $amount, $amountInRubles, $promocode, $currency, $userID, $userEmail, $productID, $returnURL)
    {
        $checkoutData = array(
            'title' => $name,
            'gateways' => array(
                'BITCOIN',
                'LITECOIN',
                'ETHEREUM',
                'MONERO',
				'SOLANA',
				'TRON',
				'POLYGON',
                'USDC:ERC20',
                'USDC:BEP20',
                'USDC:MATIC',
                'USDT:ERC20',
                'USDT:BEP20',
                'USDT:MATIC',
                'USDT:TRC20'
            ),
            'value' => $amount,
            'currency' => $currency,
            'confirmations' => 1,
            'email' => $userEmail,
            'custom_fields' => [
                'userID' => $userID,
                'productID' => $productID,
                'i' => $amountInRubles,
                'promocode' => $promocode,
            ],
            'return_url' => $returnURL
        );

        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".SELLIX_API_KEY
        );

        $curl = curl_init(SELLIX_CHECKOUT_ENDPOINT);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($checkoutData));

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

        if ($response['status'] == 200 && $responseCode == 200)
        {
            return array(
                'code' => 0,
                'gatewayURL' => $response['data']['url']
            );
        }

        if (isset($response['error']))
        {
            return array(
                'code' => 1,
                'error' => $response['error']
            );
        }
        else
        {
            return array(
                'code' => 1,
                'error' => 'Unknown error occurred.'
            );
        }
    }

    function Redirect($gatewayURL)
    {
        header("Location: ".$gatewayURL);
    }
?>