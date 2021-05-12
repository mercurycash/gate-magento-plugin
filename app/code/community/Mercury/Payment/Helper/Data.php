<?php

class Mercury_Payment_Helper_Data extends Mage_Core_Helper_Data
{
    public static function isActive()
    {
        return Mage::getStoreConfigFlag('payment/mercury_payment/active');
    }

    public static function getTitle()
    {
        return Mage::getStoreConfig('payment/mercury_payment/title');
    }

    public static function getDescription()
    {
        return Mage::getStoreConfig('payment/mercury_payment/description');
    }

    public static function getBitcoinMin()
    {
        return Mage::getStoreConfig('payment/mercury_payment/bitcoinmin');
    }

    public static function getEthereumMin()
    {
        return Mage::getStoreConfig('payment/mercury_payment/ethereummin');
    }

    public static function getDashMin()
    {
        return Mage::getStoreConfig('payment/mercury_payment/dashmin');
    }

    public static function getPublishableKey()
    {
        return Mage::getStoreConfig('payment/mercury_payment/publishable_key');
    }

    public static function getPrivateKey()
    {
        return Mage::getStoreConfig('payment/mercury_payment/private_key');
    }
}
