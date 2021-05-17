<?php

declare(strict_types=1);

class Mercury_Payment_Model_Observer
{
    public function savePaymentTransaction(Varien_Event_Observer $observer)
    {
        $orderIds = $observer->getEvent()->getOrderIds();
        if (empty($orderIds) || !is_array($orderIds)) {
            return;
        }

        /** @var Mage_Sales_Model_Order $order */
        $order = Mage::getModel('sales/order')->load($orderIds[0]);
    }
}
