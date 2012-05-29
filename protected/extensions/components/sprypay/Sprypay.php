<?php

Yii::import('application.components.Curl');

class Sprypay extends CApplicationComponent
{
    private $_url = 'https://sprypay.ru/sppi/';
    public $enable, $shop_id, $secret_key;

    /**
     * @var Curl
     */
    private $_curl = null;

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

    public function getLanguage($language = null)
    {
        $language = $language ? : Yii::app()->getLanguage();
        $language = in_array($language, array('ru', 'en')) ? $language : 'en';
        return $language;
    }

    public function getPaymentUrl($sum, $transaction_id, $description, array $extra_data = array()) {
        return $this->_url. '?' . http_build_query(array(
            'spShopId' => $this->shop_id,
            'spShopPaymentId' => $transaction_id,
            'spAmount' => $sum,
            'spCurrency' => 'rur',
            'spPurpose' => CHtml::encode($description),
            'spUserEmail' => $extra_data['email'],
            'lang' => $this->getLanguage(),
        ));
    }
}
