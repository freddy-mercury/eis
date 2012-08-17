<?php

/**
 *
 */
class BuyForm extends CFormModel {
	public $quantity, $amount;

	public function rules() {
		return array(
			array('quantity, amount', 'numerical'),
			array('quantity, amount', 'required'),
		);
	}

	public function validate($attributes = null, $clearErrors = false) {
		if ($this->quantity < Yii::app()->params['rates']['buy_min']) {
			$this->addError('quantity',
				Yii::t('member', 'Minimal buy quantity is {sell_min} {currency_name}!',
					array(
						'{sell_min}' => Yii::app()->params['rates']['sell_min'],
						'{currency_name}' => Yii::app()->params['rates']['name']
					)));
		}
		return parent::validate($attributes, $clearErrors);
	}

}
