<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait FetchApiTrait
{
    public function fetchDataApi($url)
    {
        $client = new Client();
        $response = $client->get($url);
        return json_decode($response->getBody());
    }
}