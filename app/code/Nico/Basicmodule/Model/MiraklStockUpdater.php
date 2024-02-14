<?php

namespace Nico\Basicmodule\Model;

use Nico\Basicmodule\Helper\MiraklClient;

class MiraklStockUpdater
{
    protected $miraklClient;

    public function __construct(MiraklClient $miraklClient)
    {
        $this->miraklClient = $miraklClient;
    }

    public function updateStock($productId, $quantity)
    {
        $url = 'MIRAKL_API_URL_HERE'; // Replace with actual Mirakl API URL
        $headers = [
            'Authorization' => 'Bearer YOUR_MIRAKL_API_TOKEN_HERE',
            'Content-Type' => 'application/json'
        ];
        $body = json_encode([
            'product_id' => $productId,
            'quantity' => $quantity
        ]);

        return $this->miraklClient->callMiraklApi('POST', $url, $headers, $body);
    }
}
