<?php

declare(strict_types=1);

class Mercury_Payment_MercuryController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $endpoint = Mercury_Payment_Helper_Mercury::getApiInstance();

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
        $endpoint = Mercury_Payment_Helper_Mercury::getApiInstance();

        $status = $endpoint->status($this->getRequest()->getParam('uuid'));

        return $this->getResponse()->representJson(
            $this->serializer->serialize([
                'status' => $status,
            ])
        );
    }
}
