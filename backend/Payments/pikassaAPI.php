<?php
    define("PIKASSA_API_KEY", "d1a9b885-071d-4e4a-a894-69b5cbe697d1");
    define("PIKASSA_SECRET_PHRASE", "f33ee71cd15849e18deee4ed5b3773b9");
    define("PIKASSA_CREATE_ORDER_ENDPOINT", "https://pikassa.io/merchant-api/api/v2/invoices");

    function CreateOrder($name, $amount, $amountInRubles, $userID, $productID, $successURL, $failURL)
    {
        $payload = json_encode(array(
            "externalId" => uniqid(),
            "amount" => $amount,
            "currency" => "EUR",
            "description" => $name,
            "customData" => array("amountInRubles" => $amountInRubles, "userID" => $userID, "productID" => $productID),
            "successUrl" => $successURL,
            "failUrl" => $failURL,
            "deliveryMethod" => "URL",
            "locale" => "en"
        ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $sign = base64_encode(md5($payload . PIKASSA_SECRET_PHRASE, true));

        $curl = curl_init(PIKASSA_CREATE_ORDER_ENDPOINT);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Content-Type:application/json",
            "X-Api-Key:" . PIKASSA_API_KEY,
            "X-Sign:" . $sign
        ));

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
                'gatewayURL' => $response['data']["paymentLink"]
            );
        }
        else
        {
            return array(
                'code' => 1,
                'error' => $response['error']['message']
            );
        }
    }

    function Redirect($gatewayURL)
    {
        header("Location: ".$gatewayURL);
    }
?>