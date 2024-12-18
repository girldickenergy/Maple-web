<?php
    define("STRIPE_API_KEY", "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");
    define("STRIPE_CHECKOUT_ENDPOINT", "https://api.stripe.com/v1/checkout/sessions");

    function CreateOrder($name, $amount, $amountInRubles, $promocode, $currency, $userID, $productID, $successURL, $cancelURL)
    {
        $checkoutData = http_build_query([
            'mode' => 'payment',
            'success_url' => $successURL,
            'cancel_url' => $cancelURL,
            'line_items' => [[
                'price_data' => [
                    'currency' => strtolower($currency),
                    'product_data' => [
                        'name' => $name,
                        'description' => 'Maple <3s you!',
                    ],
                    'unit_amount_decimal' => $amount * 100
                ],
                'quantity' => 1
            ]],
            'metadata' => [
                'userID' => $userID,
                'productID' => $productID,
                'identifier' => $amountInRubles,
                'promocode' => $promocode
            ]
        ]);

        $headers = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Authorization: Bearer ".STRIPE_API_KEY
        );

        $curl = curl_init(STRIPE_CHECKOUT_ENDPOINT);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $checkoutData);

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
                'gatewayURL' => $response['url']
            );
        }

        if (isset($response['error']))
        {
            return array(
                'code' => 1,
                'error' => $response['message']
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