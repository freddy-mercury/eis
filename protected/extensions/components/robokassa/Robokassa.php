<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Curl.php');

/**
 * @property Curl $curl
 */
class Robokassa extends CApplicationComponent
{

	public $test, $merchant_login, $password1, $password2;
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
		if (!($currencies = Yii::app()->cache->get($cache_key))) {
			$url = $this->_url . '/WebService/Service.asmx/GetCurrencies';
			$language = $language ?: Yii::app()->getLanguage();
			$language = in_array($language, array('ru', 'en')) ? $language : 'en';
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
					$currencies[strval($group['Description'])] =  $items;
				}
			}
			Yii::app()->cache->set($cache_key, $currencies, 24*60*60);
		}
		return $currencies;
	}


}