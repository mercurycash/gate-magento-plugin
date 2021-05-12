<?php

declare(strict_types=1);

require_once Mage::getBaseDir('lib') . '/mercury-cash-sdk/vendor/autoload.php';

class Mercury_Payment_Helper_Mercury
{
    const API_HOST = 'https://api-way.mercurydev.tk';

    public static function getApiInstance()
    {
        $api = new APIKey(Mercury_Payment_Helper_Data::getPublishableKey(), Mercury_Payment_Helper_Data::getPrivateKey());

        return new Transaction(
            new Adapter($api, self::API_HOST)
        );
    }
}
