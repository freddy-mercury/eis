<?php
class MavroSellForm extends CFormModel
{
	public $amount, $payment_info;

	public function rules()
	{
		return array(
			array('amount, payment_info', 'required'),
			array('amount', 'numerical'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'amount'=>Yii::t('mavro', 'Quantity of MAVRO'),
			'payment_info'=>Yii::t('mavro', 'Payment info'),
		);
		}

	public function validate($attributes=null, $clearErrors=true) {
		$valid = true;
		if ($this->amount > Yii::app()->user->model->mavro) {
			$this->addError('amount', Yii::t('mavro', 'Amount is too big!'));
			$valid = false;
		}
		elseif ($this->amount <= 0) {
			$this->addError('amount', Yii::t('mavro', 'Amount is too small!'));
			$valid = false;
		}
		return $valid && parent::validate($attributes, $clearErrors);
	}
}
