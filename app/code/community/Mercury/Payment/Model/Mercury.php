<?php

class Mercury_Payment_Model_Mercury extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'mercurypayment';

    public function isAvailable($quote = null)
    {
        if (!$quote) {
            return false;
        }

        if ($quote->getAllVisibleItems() <= 2) {
            return false;
        }

        return true;
    }

    public function validate()
    {
        parent::validate();

        // This returns Mage_Sales_Model_Quote_Payment, or the Mage_Sales_Model_Order_Payment
        $info = $this->getInfoInstance();

        $no = $info->getCheckNo();
        $date = $info->getCheckDate();

        if (empty($no) || empty($date)) {
            Mage::throwException($this->_getHelper()->__('Check No and Date are required fields'));
        }

        if (strlen($no) < 5) {
            Mage::throwException($this->_getHelper()->__('Number must be five or more characters'));
        }

        return $this;
    }
}