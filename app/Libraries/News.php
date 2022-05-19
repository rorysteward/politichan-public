<?php

namespace App\Libraries;

use App\Models\BoardModel;

class News
{
    /**
     *
     *   	
     * 
     */

    function fetchNews()
    {
        $BoardModel = new BoardModel();
        $news = new \Config\MY_config\News();
        $client = \Config\Services::curlrequest();
        $category = 'business';
        $q = 'bitcoin';
        $language = 'en';
        $from = '';
        $excludeDomains = '';
        $response = $client->request('GET', $news->endpoint_headlines .
            '?category=' . $category .
            '&q=' . $q .
            '&language=' . $language .
            '&from=' . $from .
            '&excludeDomains=' . $excludeDomains, [
            'headers' => [
                'x-api-key' => $news->apiKey,
            ],

        ]);
        $response = $response->getBody();
        echo "<pre>";
        print_r($response);
        exit();

        return $response;
    }
}
/**
 * EOF
 */
