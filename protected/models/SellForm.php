<?php

/**
 *
 */
class SellForm extends CFormModel {
	public $quantity;

	public function rules() {
		return array(
			array('quantity', 'numerical'),
			array('quantity', 'required'),
		);
	}

	public function validate($attributes = null, $clearErrors = false) {
		/* @var $member Member */
		$member = Yii::app()->user->model;
		if (
			$this->quantity <=0
			|| $this->quantity > $member->rates_balance
		) {
			$this->addError('quantity', Yii::t('member', 'You have defined invalid quantity to sell!'));
		}
		elseif ($this->quantity < Yii::app()->params['rates']['buy_min']) {
			$this->addError('quantity',
				Yii::t('member', 'Minimal sell quantity is {buy_min} {currency_name}!',
					array(
						'{buy_min}' => Yii::app()->params['rates']['buy_min'],
						'{currency_name}' => Yii::app()->params['rates']['name']
					)));
		}
		return parent::validate($attributes, $clearErrors);
	}

}
