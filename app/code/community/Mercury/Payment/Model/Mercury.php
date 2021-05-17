<?php

declare(strict_types=1);

class Mercury_Payment_Model_Mercury extends Mage_Payment_Model_Method_Abstract
{
    const CODE = 'mercurypayment';

    protected $_code = self::CODE;

    protected $_canCapture = true;

    protected $_formBlockType = 'mercurypayment/payment_form';

    public function isAvailable($quote = null)
    {
        if ($quote === null || !$this->getConfigData('active')) {
            return false;
        }

        return true;
    }

    public function validate()
    {
        parent::validate();

        $paymentInfo = $this->getInfoInstance();

        if (!$paymentInfo->getData('mercury_transaction')) {
            Mage::throwException(Mage::helper('payment')->__('Payment is required'));
        }

        return $this;
    }
}
