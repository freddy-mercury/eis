<?php

class MavroBuyForm extends CFormModel {

	public $amount, $sum;

    public function rules()
    {
        return array(
            array('amount, sum', 'required'),
            array('amount, sum', 'numerical'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'amount'=>Yii::t('mavro', 'Quantity of MAVRO'),
            'sum'=>Yii::t('mavro', 'Total amount (roubles)'),
        );
    }

	public function validate($attributes=null, $clearErrors=true) {
		$valid = true;
		if ($this->sum <= 0 || $this->amount <= 0) {
			$this->addErrors(array(
				'amount' => Yii::t('mavro', 'Must be greater than 0!'),
				'sum' => Yii::t('mavro', 'Must be greater than 0!'),
			));
			$valid = false;
		}
		return $valid && parent::validate($attributes, $clearErrors);
	}

}