<?php

class Mercury_Payment_Helper_Data extends Mage_Core_Helper_Data
{
    public function isActive()
    {
        return Mage::getStoreConfigFlag('payment/mercury_payment/active');
    }

    public function getTitle()
    {
        return Mage::getStoreConfig('payment/mercury_payment/title');
    }

    public function getDescription()
    {
        return Mage::getStoreConfig('payment/mercury_payment/description');
    }

    public function getBitcoinMin()
    {
        return Mage::getStoreConfig('payment/mercury_payment/bitcoinmin');
    }

    public function getEthereumMin()
    {
        return Mage::getStoreConfig('payment/mercury_payment/ethereummin');
    }

    public function getDashMin()
    {
        return Mage::getStoreConfig('payment/mercury_payment/dashmin');
    }
}
