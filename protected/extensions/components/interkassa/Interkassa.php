<?php

Yii::import('application.components.Curl');

/**
 * @property Curl $curl
 */
class Interkassa extends CApplicationComponent
{
    public $enable, $shop_id, $secret_key;

    public function getPaymentForm($amount, $payment_id, $payment_description) {
        return '<form name="payment" action="https://www.interkassa.com/lib/payment.php" method="post"
enctype="application/x-www-form-urlencoded" accept-charset="cp1251">
<input type="hidden" name="ik_shop_id" value="'.$this->shop_id.'">
<input type="hidden" name="ik_payment_amount" value="'.floatval($amount).'">
<input type="hidden" name="ik_payment_id" value="'.htmlspecialchars($payment_id).'">
<input type="hidden" name="ik_payment_desc" value="'.htmlspecialchars($payment_description).'">
</form><script language="Javascript">payment.submit();</script>';
    }

    public function chechPayment(array $data) {
        $sign_hash_str = $data['ik_shop_id'] . ':' .
            $data['ik_payment_amount'] . ':' .
            $data['ik_payment_id'] . ':' .
            $data['ik_paysystem_alias'] . ':' .
            $data['ik_baggage_fields'] . ':' .
            $data['ik_payment_state'] . ':' .
            $data['ik_trans_id'] . ':' .
            $data['ik_currency_exch'] . ':' .
            $data['ik_fees_payer'] . ':' .
            $this->secret_key;

        $sign_hash = strtoupper(md5($sign_hash_str));
        return (($data['ik_sign_hash'] === $sign_hash)
            && ($data['ik_payment_state'] === 'success')
            && ($data['ik_shop_id'] === $this->shop_id));
    }

}