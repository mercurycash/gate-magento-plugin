<?php

declare(strict_types=1);

class Mercury_Payment_Helper_Data extends Mage_Core_Helper_Data
{
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_ACTIVE = 'payment/mercurypayment/active';
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_TITLE = 'payment/mercurypayment/title';
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_DESCRIPTION = 'payment/mercurypayment/description';
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_BITCOIN_MIN = 'payment/mercurypayment/bitcoinmin';
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_ETHEREUM_MIN = 'payment/mercurypayment/ethereummin';
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_DASH_MIN = 'payment/mercurypayment/dashmin';
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_PUBLISHABLE_KEY = 'payment/mercurypayment/publishable_key';
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_PRIVATE_KEY = 'payment/mercurypayment/private_key';
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_PENDING_SET = 'payment/mercurypayment/pending_set';
    const XML_PATH_PAYMENT_MERCURY_PAYMENT_SANDBOX = 'payment/mercurypayment/sandbox';

    public static function isActive()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_ACTIVE);
    }

    public static function getTitle()
    {
        return Mage::getStoreConfig(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_TITLE);
    }

    public static function getDescription()
    {
        return Mage::getStoreConfig(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_DESCRIPTION);
    }

    public static function getBitcoinMin()
    {
        return Mage::getStoreConfig(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_BITCOIN_MIN);
    }

    public static function getEthereumMin()
    {
        return Mage::getStoreConfig(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_ETHEREUM_MIN);
    }

    public static function getDashMin()
    {
        return Mage::getStoreConfig(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_DASH_MIN);
    }

    public static function getPublishableKey()
    {
        return Mage::getStoreConfig(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_PUBLISHABLE_KEY);
    }

    public static function getPrivateKey()
    {
        return Mage::getStoreConfig(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_PRIVATE_KEY);
    }

    public static function getPendingSet()
    {
        return Mage::getStoreConfig(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_PENDING_SET);
    }

    public static function isSandbox()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_PAYMENT_MERCURY_PAYMENT_SANDBOX);
    }
}
