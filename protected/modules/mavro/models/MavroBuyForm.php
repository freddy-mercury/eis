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
            'sum'=>Yii::t('mavro', 'Total sum'),
        );
    }

}