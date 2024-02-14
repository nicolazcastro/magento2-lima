<?php

namespace Nico\Basicmodule\Controller\MiraklNotification;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Message\ManagerInterface;
use Nico\Basicmodule\Model\StockUpdaterModel;

class Index implements ActionInterface
{
    protected $jsonResultFactory;
    protected $stockUpdaterModel;
    protected $messageManager;
    protected $request;

    public function __construct(
        JsonFactory $jsonResultFactory,
        StockUpdaterModel $stockUpdaterModel,
        ManagerInterface $messageManager,
        RequestInterface $request
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        $this->stockUpdaterModel = $stockUpdaterModel;
        $this->messageManager = $messageManager;
        $this->request = $request;
    }

    public function execute()
    {
        // Get Mirakl notification data
        $requestData = $this->request->getParams(); //product_sku && quantity

        // Process notification data and update stock in Magento
        $result = $this->stockUpdaterModel->updateStockFromMiraklNotification($requestData);

        // Return response
        $response = $this->jsonResultFactory->create();
        $response->setData(['success' => $result]);
        return $response;
    }

    public function dispatch(RequestInterface $request)
    {
        return $this->execute();
    }
}
