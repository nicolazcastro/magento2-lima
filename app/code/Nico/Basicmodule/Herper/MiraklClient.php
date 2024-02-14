<?php

namespace Nico\Basicmodule\Helper;

use GuzzleHttp\Client;

class MiraklClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function callMiraklApi($method, $url, $headers, $body = null)
    {
        $response = $this->client->request($method, $url, [
            'headers' => $headers,
            'body' => $body
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
