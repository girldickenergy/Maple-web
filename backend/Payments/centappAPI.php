<?php
    define("CENTAPP_API_TOKEN", "6984|Rdw7hZsOzKvn5yd9wUF1TgzOr5nrKbs2374M52It");
    define("CENTAPP_SHOP_ID", "4NvoZpD7AD");
    define("CENTAPP_CREATE_ORDER_URL", "https://cent.app/api/v1/bill/create");

    function CreateOrder($name, $amount, $amountInRubles, $currency, $userID, $productID)
    {
        $orderData = json_encode(array(
            'amount' => $amount,
            'order_id' => time(),
            'type' => 'normal',
            'shop_id' => CENTAPP_SHOP_ID,
            'currency_in' => $currency,
            'custom' => json_encode(array(
                'amountInRubles' => $amountInRubles,
                'userID' => $userID,
                'productID' => $productID
            )),
            'payer_pays_commission' => 0,
            'name' => $name
        ));

        $headers = array(
            "Content-type: application/json",
            "Authorization: Bearer ".CENTAPP_API_TOKEN
        );

        $curl = curl_init(CENTAPP_CREATE_ORDER_URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
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

        if ($response['success'] == 'true')
        {
            return array(
                'code' => 0,
                'gatewayURL' => $response['link_page_url']
            );
        }
        else
        {
            return array(
                'code' => 1,
                'error' => $response['message']
            );
        }
    }

    function Redirect($gatewayURL)
    {
        header("Location: ".$gatewayURL);
    }
?>