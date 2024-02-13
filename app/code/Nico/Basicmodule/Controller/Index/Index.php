<?php

namespace Nico\Basicmodule\Controller\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\App\ActionInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

/**
 * Class Index
 * @package Nico\Basicmodule\Controller\Index
 * @method setTopic(string $topic)
 */
class Index implements ActionInterface
{
    /** @var PageFactory */
    private $pageFactory;

    /** @var _categoryFactory */
    protected $categoryFactory;

    /** @var categoryCollectionFactory */
    protected $categoryCollectionFactory;

    /**
     *  Index constructor
     * @param PageFactory $pageFactory
     */
    public function __construct(
        PageFactory $pageFactory,
        CategoryFactory $categoryFactory,
        CollectionFactory $categoryCollectionFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->categoryFactory = $categoryFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    /**
     * @return Page
     */
    public function execute(): Page
    {
        $categories = $this->categoryFactory->create()->getCollection()->addAttributeToSelect('*');

        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set('Page Title set from the controller');
        $page->getLayout()->getBlock('basicmodule_index_index')->setTopic('Pass data from controller to block');
        $page->getLayout()->getBlock('basicmodule_index_index')->setCategories($categories);

        return $page;
    }
}
