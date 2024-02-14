<?php

namespace Nico\Basicmodule\Model;

use Nico\Basicmodule\Model\MiraklStockUpdater;
use Magento\Framework\App\RequestInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;

class StockUpdaterModel
{
    protected $miraklStockUpdater;
    protected $request;
    protected $stockRegistry;

    public function __construct(
        MiraklStockUpdater $miraklStockUpdater,
        RequestInterface $request,
        StockRegistryInterface $stockRegistry
    ) {
        $this->miraklStockUpdater = $miraklStockUpdater;
        $this->request = $request;
        $this->stockRegistry = $stockRegistry;
    }

    public function updateStockInMirakl()
    {
        $productId = $this->request->getParam('product_id');
        $quantity = $this->request->getParam('quantity');

        return $this->miraklStockUpdater->updateStock($productId, $quantity);
    }

    public function updateStockFromMiraklNotification($notificationData)
    {
        // Process Mirakl notification data and update stock in Magento
        $productSku = $notificationData['product_sku']; // Assuming 'product_sku' is the key for product ID in the notification data
        $quantity = $notificationData['quantity']; // Assuming 'quantity' is the key for quantity in the notification data

        try {
            $stockItem = $this->stockRegistry->getStockItemBySku($productSku);
            $stockItem->setQty($quantity);
            $stockItem->setIsInStock((bool)$quantity);
            $this->stockRegistry->updateStockItemBySku($productSku, $stockItem);

            return true; // Return true on success
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return false; // Return false on failure
        }
    }
}
