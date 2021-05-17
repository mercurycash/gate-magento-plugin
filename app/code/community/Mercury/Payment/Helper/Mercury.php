<?php

declare(strict_types=1);

require_once Mage::getBaseDir('lib') . '/mercury-cash-sdk/vendor/autoload.php';

use MercuryCash\SDK\Adapter;
use MercuryCash\SDK\Auth\APIKey;
use MercuryCash\SDK\Endpoints\Transaction;

class Mercury_Payment_Helper_Mercury
{
    const API_HOST = 'https://api-way.mercury.cash';
    const API_HOST_DEV = 'https://api-way.mercurydev.tk';

    const CRYPTO = [
        'ETH' => 'ethereum',
        'BTC' => 'bitcoin',
        'DASH' => 'dash',
    ];

    const TRANSACTION_APROVED = 'TRANSACTION_APROVED';
    const TRANSACTION_RECEIVED = 'TRANSACTION_RECEIVED';

    public static function getApiInstance()
    {
        $api = new APIKey(Mercury_Payment_Helper_Data::getPublishableKey(), Mercury_Payment_Helper_Data::getPrivateKey());

        $host = Mercury_Payment_Helper_Data::isSandbox() ? self::API_HOST_DEV : self::API_HOST;

        return new Transaction(
            new Adapter($api, $host)
        );
    }
}
