<?php

declare(strict_types=1);

class Mercury_Payment_TransactionController extends Mage_Core_Controller_Front_Action
{
    public function createAction()
    {
        $endpoint = Mercury_Payment_Helper_Mercury::getApiInstance();

        $crypto = $this->getRequest()->getParam('crypto');

        $transaction = $endpoint->create([
            'email' => $this->getRequest()->getParam('email'),
            'crypto' => $crypto,
            'fiat' => $this->getRequest()->getParam('currency'),
            'amount' => $this->getRequest()->getParam('price'),
            'tip' => 0,
        ]);

        $endpoint->process($transaction->getUuid());

        $cryptoName = Mercury_Payment_Helper_Mercury::CRYPTO[$crypto];
        $address = $transaction->getAddress();
        $amount = $transaction->getCryptoAmount();

        $qrCodeText = '';
        $qrCodeText .= $cryptoName . ':' . $address . '?';
        $qrCodeText .= 'amount=' . $amount . '&';
        $qrCodeText .= 'cryptoCurrency=' . $crypto;

        return $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(['data' => [
            'uuid' => $transaction->getUuid(),
            'cryptoAmount' => $amount,
            'fiatIsoCode' => $transaction->getFiatIsoCode(),
            'fiatAmount' => $transaction->getFiatAmount(),
            'exchangeRate' => $transaction->getRate(),
            'address' => $address,
            'networkFee' => $transaction->getFee(),
            'cryptoCurrency' => $crypto,
            'qrCodeText' => $qrCodeText,
        ]]));
    }

    public function checkAction()
    {
        $endpoint = Mercury_Payment_Helper_Mercury::getApiInstance();

        $uuid = $this->getRequest()->getParam('uuid');
        $status = $endpoint->status($uuid);

        if ($status->getStatus() === Mercury_Payment_Helper_Mercury::TRANSACTION_APROVED) {
            $payment = $this->getQuote()->getPayment();
            $payment->setMercuryTransaction($uuid)->save();
        }

        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(['data' => [
            'status' => $status->getStatus(),
            'confirmations' => $status->getConfirmations(),
        ]]));
    }

    /**
     * @return Mage_Sales_Model_Quote
     */
    private function getQuote()
    {
        return Mage::getSingleton('checkout/session')->getQuote();
    }
}
