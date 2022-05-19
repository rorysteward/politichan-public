<?php

namespace App\Libraries;

include("../vendor/autoload.php");

use App\Models\BoardModel;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;

class Finnhub
{
    public function test()
    {
    
    $MY_config = new \Config\MY_config\Finnhub();
    $token = $MY_config->token;
    $config = \Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', $token);
    $client = new DefaultApi(
        new Client(),
        $config
    );
    echo "<pre>";
    print_r($client->cryptoExchanges());
    }
}