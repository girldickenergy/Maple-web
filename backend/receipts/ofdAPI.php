<?php
    define("OFD_LOGIN", "45394");
    define("OFD_PASSWORD", "Nh5614933Mf");
    define("OFD_TOKEN_URL", "https://ferma.ofd.ru/api/Authorization/CreateAuthToken");
    define("OFD_CREATE_RECEIPT_URL", "https://ferma.ofd.ru/api/kkt/cloud/receipt?AuthToken=");

    function GetOFDToken()
    {
        $requestData = json_encode(array(
            "Login" => OFD_LOGIN,
            "Password" => OFD_PASSWORD
        ));

        $headers = array(
            "Content-type: application/json",
        );

        $curl = curl_init(OFD_TOKEN_URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestData);

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

        if ($response["Status"] != "Success")
        {
            return array(
                'code' => 2,
                'error' => $response["Error"]["Message"]
            );
        }

        return array(
            'code' => 0,
            'token' => $response["Data"]["AuthToken"]
        );
    }

    function CreateReceipt($id, $callbackURL, $email, $itemName, $amount)
    {
        $token = GetOFDToken();
        if ($token["code"] != 0)
        {
            return array(
                'code' => 1,
                'error' => "Invalid token"
            );
        }

        $requestData = json_encode(array(
            "Request" => array(
                "Inn" => "673108418544",
                "Type" => "Income",
                "InvoiceId" => $id,
                "CallbackUrl" => $callbackURL,
                "CustomerReceipt" => array(
                    "TaxationSystem" => "Patent",
                    "Email" => $email,
                    "PaymentType" => 1,
                    "Items" => array(
                        array(
                            "Label" => $itemName,
                            "Price" => $amount,
                            "Quantity" => 1,
                            "Amount" => $amount,
                            "Vat" => "VatNo",
                            "PaymentMethod" => 4
                        )
                    )
                )
            )
        ));

        $headers = array(
            "Content-type: application/json",
        );

        $curl = curl_init(OFD_CREATE_RECEIPT_URL.$token["token"]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestData);

        $jsonResponse = curl_exec($curl);

        if (curl_errno($curl))
        {
            curl_close($curl);

            return array(
                'code' => 2,
                'error' => curl_error($curl)
            );
        }

        curl_close($curl);

        $response = json_decode($jsonResponse, true);

        if ($response["Status"] != "Success")
        {
            return array(
                'code' => 3,
                'error' => $response["Error"]["Message"]
            );
        }

        return array(
            'code' => 0,
            'receiptID' => $response["Data"]["ReceiptId"]
        );
    }
?>