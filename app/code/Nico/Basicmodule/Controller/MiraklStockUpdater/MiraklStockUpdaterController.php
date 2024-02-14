<?php

namespace Nico\Basicmodule\Controller\MiraklStockUpdater;

use Magento\Framework\App\ActionInterface;
use Nico\Basicmodule\Model\StockUpdaterModel;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class MiraklStockUpdaterController implements ActionInterface
{
    protected $stockUpdaterModel;
    protected $request;
    protected $context;
    protected $resultFactory;
    protected $messageManager;
    protected $resultJsonFactory;

    public function __construct(
        Context $context,
        StockUpdaterModel $stockUpdaterModel,
        RequestInterface $request,
        JsonFactory $resultJsonFactory
    ) {
        $this->context = $context;
        $this->stockUpdaterModel = $stockUpdaterModel;
        $this->request = $request;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        // Use model to update stock in Mirakl
        $result = $this->stockUpdaterModel->updateStockInMirakl();

        $result = $this->resultJsonFactory->create();
        $result->setHttpResponseCode(200);
        $result->setData(['message' => 'Update Stock processed successfully']);

        return $result;
    }

    public function dispatch(RequestInterface $request)
    {
        return $this->execute();
    }
}
