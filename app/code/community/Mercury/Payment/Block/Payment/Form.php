<?php

declare(strict_types=1);

class Mercury_Payment_Block_Payment_Form extends Mage_Payment_Block_Form
{
    protected $template = 'mercurypayment/form.phtml';

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate($this->template);
    }

    public function mercuryData()
    {
    	return [
    		'cart_price' => $this->getQuote()->getGrandTotal(),
    		'currency' => $this->getCurrency(), 
    		'curr_symbol' => $this->getCurrencySymbol(),
    		'btc' => Mercury_Payment_Helper_Data::getBitcoinMin(),
    		'eth' => Mercury_Payment_Helper_Data::getEthereumMin(),
    		'dash' => Mercury_Payment_Helper_Data::getDashMin(),
    		'time' => Mercury_Payment_Helper_Data::getPendingSet(),
    		'url' => Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB),
            'email' => $this->getEmail(),
            'pathCreateTransaction' => $this->getUrlTransactionCreate(),
            'pathCheckTransaction' => $this->getUrlTransactionCheck(),
    	];
    }

    private function getQuote()
    {
    	return Mage::getModel('checkout/cart')->getQuote();
    }

    private function getEmail()
    {
        $quote = $this->getQuote()->getBillingAddress();

        return $quote->getEmail() ?: $quote->getCustomerEmail();
    }

    private function getCurrency()
    {
    	return Mage::app()->getStore()->getCurrentCurrencyCode();
    }

    private function getCurrencySymbol()
    {
    	return Mage::app()->getLocale()->currency($this->getCurrency())->getSymbol();
    }

    private function getUrlTransactionCreate()
    {
        return $this->getUrl('mercurypayment/transaction/create');
    }

    public function getUrlTransactionCheck()
    {
        return $this->getUrl('mercurypayment/transaction/check');
    }
}
