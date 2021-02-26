<?php

require_once __DIR__ . '/../../sdk/vendor/autoload.php';

class Mercury_Payment_MercuryController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $apiKey = new APIKey($this->config->getPublishableKey(), $this->config->getPrivateKey());
        $adapter = new Adapter($apiKey, 'https://api-way.mercurydev.tk');
        $endpoint = new Transaction($adapter);

        $transaction = $endpoint->create([
            'email' => null !== $quote->getBillingAddress() ? $quote->getBillingAddress()->getEmail() : '',
            'crypto' => $this->getRequest()->getParam('crypto'),
            'fiat' => $this->storeManager->getStore()->getCurrentCurrencyCode(),
            'amount' => $quote->getGrandTotal(),
            'tip' => 0,
        ]);

        $endpoint->process($transaction->getUuid());

        return $this->getResponse()->representJson(
            $this->serializer->serialize([
                'uuid' => $transaction->getUuid(),
                'cryptoAmount' => $transaction->getCryptoAmount(),
                'fiatIsoCode' => $transaction->getFiatIsoCode(),
                'fiatAmount' => $transaction->getFiatAmount(),
                'rate' => $transaction->getRate(),
                'address' => $transaction->getAddress(),
                'fee' => $transaction->getFee()
            ])
        );
    }

    public function checkAction()
    {
        $apiKey = new APIKey($this->config->getPublishableKey(), $this->config->getPrivateKey());
        $adapter = new Adapter($apiKey, 'https://api-way.mercurydev.tk');
        $endpoint = new Transaction($adapter);

        $status = $endpoint->status($this->getRequest()->getParam('uuid'));

        return $this->getResponse()->representJson(
            $this->serializer->serialize([
                'status' => $status,
            ])
        );
    }
}
