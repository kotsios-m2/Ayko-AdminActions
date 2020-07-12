<?php

namespace Ayko\AdminActions\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\Http;

class AfterDeleteObserver implements ObserverInterface
{
    const ACTION_DELETE = "Delete";
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return bool|\Magento\Framework\Event\Observer|void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $object = $observer->getEvent()->getObject();

        return true;
    }
}
