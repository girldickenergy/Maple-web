<?php
	define("COINBASE_API_KEY", "50c884b1-d452-4721-ba33-6aaccd885974");
	define("COINBASE_WEBHOOK_SECRET", "ce8057ab-3680-441d-8192-6d9ad07ae255");

	require_once __DIR__."../../../vendor/autoload.php";

	use CoinbaseCommerce\ApiClient;
	use CoinbaseCommerce\Resources\Charge;

	ApiClient::init(COINBASE_API_KEY);

	function CreateOrder($amount, $name, $userID, $maplePointsAmount, $redirectURL, $cancelURL)
	{
		$charge = new Charge([
			"name" => $name,
			"description" => "Maple <3s you!",
			"metadata" => [
				"userID" => $userID,
				"maplePointsAmount" => $maplePointsAmount
			],
			"pricing_type" => "fixed_price",
			"local_price" => [
				"amount" => $amount,
				"currency" => "EUR"
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