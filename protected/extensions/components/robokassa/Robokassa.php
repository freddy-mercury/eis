<?php

Yii::import('application.components.Curl');

/**
 * @property Curl $curl
 */
class Robokassa extends CApplicationComponent
{
	public $enable, $test, $merchant_login, $password1, $password2;
	private $_url = 'https://merchant.roboxchange.com';
	/**
	 * @var Curl
	 */
	private $_curl = null;

	public function init()
	{
		parent::init();
		if ($this->test) {
			$this->_url = 'http://test.robokassa.ru';
		}
	}

	public function getUrl()
	{
		return $this->_url;
	}

	public function getCurl()
	{
		if ($this->_curl === null) {
			$this->_curl = new Curl();
			$this->_curl->setOptions(array(
				CURLOPT_SSL_VERIFYPEER => 0,
			));
		}
		return $this->_curl;
	}

	public function getCurrencies($language = null)
	{
		$cache_key = __CLASS__ . __METHOD__ . $this->merchant_login;
		if (!($currencies = Yii::app()->cache->get($cache_key)) || $this->test) {
			$url = $this->_url . '/WebService/Service.asmx/GetCurrencies';
			$language = $this->getLanguage($language);
			$response = $this->curl->getResponse($url, false, array(
				'MerchantLogin' => urlencode($this->merchant_login),
				'Language' => $language,
			));
			$currencies = array();
			if ($response) {
				$xml = simplexml_load_string($response);
				/* @var $group SimpleXMLElement */
				foreach ($xml->Groups->Group as $group) {
					$items = array();
					foreach ($group->Items->Currency as $item) {
						$items[strval($item['Label'])] = strval($item['Name']);
					}
					$currencies[strval($group['Description'])] = $items;
				}
			}
			Yii::app()->cache->set($cache_key, $currencies, 24 * 60 * 60);
		}
		return $currencies;
	}

	public function getLanguage($language = null)
	{
		$language = $language ? : Yii::app()->getLanguage();
		$language = in_array($language, array('ru', 'en')) ? $language : 'en';
		return $language;
	}

	public function getPaymentMethods($language = null)
	{
		$cache_key = __CLASS__ . __METHOD__ . $this->merchant_login;
		if (!($currencies = Yii::app()->cache->get($cache_key)) || $this->test) {
			$url = $this->_url . '/Webservice/Service.asmx/GetPaymentMethods';
			$language = $this->getLanguage($language);
			$response = $this->curl->getResponse($url, false, array(
				'MerchantLogin' => urlencode($this->merchant_login),
				'Language' => $language,
			));
			$payment_methods = array();
			if ($response) {
				$xml = simplexml_load_string($response);
				/* @var $method SimpleXMLElement */
				foreach ($xml->Methods->Method as $method) {
					$payment_methods[strval($method['Code'])] = strval($method['Description']);
				}
			}
			Yii::app()->cache->set($cache_key, $payment_methods, 24 * 60 * 60);
		}
		return $payment_methods;
	}

	public function getSignature1($sum, $invoice)
	{
		return md5($this->merchant_login . ':' . $sum . ':' . $invoice . ':' . $this->password1);
	}

	public function getSignature2($sum, $invoice) {
		return md5($sum . ':' . $invoice . ':' . $this->password2);
	}

    public function getPaymentUrl($sum, $transaction_id, $description) {
        return $this->_url . '/Index.aspx?'
            .'MrchLogin='.$this->merchant_login.'&'
            .'OutSum='.$sum.'&'
            .'InvId='.$transaction_id.'&'
            .'Desc='.urlencode($description).'&'
            .'SignatureValue='.$this->getSignature1($sum, $transaction_id).'&'
            .'IncCurrLabel=&'
            .'Culture='.$this->getLanguage();
    }
}