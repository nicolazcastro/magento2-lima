<?php

declare(strict_types=1);

namespace Nico\Basicmodule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class DisplayLink implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $block = $observer->getBlock();
        $fullActionName = $block->getRequest()->getFullActionName();
        $blockName = $block->getNameInLayout();

        if ($fullActionName === 'nicomodule_index_index' && $blockName === 'basicmodule_index_index') {
            $block->setDisplayLink('https://www.google.com');
        }
    }
}
