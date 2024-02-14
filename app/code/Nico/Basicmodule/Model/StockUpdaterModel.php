<?php

namespace Nico\Basicmodule\Model;

use Nico\Basicmodule\Model\MiraklStockUpdater;
use Magento\Framework\App\RequestInterface;

class StockUpdaterModel
{
    protected $miraklStockUpdater;
    protected $request;

    public function __construct(
        MiraklStockUpdater $miraklStockUpdater,
        RequestInterface $request
    ) {
        $this->miraklStockUpdater = $miraklStockUpdater;
        $this->request = $request;
    }

    public function updateStockInMirakl()
    {
        $productId = $this->request->getParam('product_id');
        $quantity = $this->request->getParam('quantity');

        return $this->miraklStockUpdater->updateStock($productId, $quantity);
    }
}
