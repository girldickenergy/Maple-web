<?php
    define("COINBASE_API_KEY", "ea41fee0-e0d2-4ff7-b3e8-a94a2a89f0d0");
    define("COINBASE_WEBHOOK_SECRET", "ca0e8c30-0019-491b-80ff-d1404c2e0c90");

    require_once __DIR__."../../../vendor/autoload.php";

    use CoinbaseCommerce\ApiClient;
    use CoinbaseCommerce\Resources\Charge;

    ApiClient::init(COINBASE_API_KEY);

    function CreateOrder($name, $amount, $amountInRubles, $currency, $userID, $productID, $redirectURL, $cancelURL)
    {
        $charge = new Charge([
            "name" => $name,
            "description" => "Maple <3s you!",
            "metadata" => [
                "amountInRubles" => $amountInRubles,
                "userID" => $userID,
                "productID" => $productID
            ],
            "pricing_type" => "fixed_price",
            "local_price" => [
                "amount" => $amount,
                "currency" => $currency
            ],
            "redirect_url" => $redirectURL,
            "cancel_url" => $cancelURL
        ]);

        try
        {
            $charge->save();

            return array(
                "code" => 0,
                "gatewayURL" => $charge["hosted_url"]
            );
        }
        catch (\Exception $exception)
        {
            return array(
                "code" => 1,
                "error" => $exception->getMessage()
            );
        }
    }

    function Redirect($gatewayURL)
    {
        header("Location: ".$gatewayURL);
    }
?>