<?php

class MavroDepositForm extends DepositForm {

    public function rules()
    {
        return array(
            array('amount', 'required'),
            array('amount', 'numerical'),

        );
    }

    public function attributeLabels()
    {
        return array(
            'amount'=>Yii::t('mavro', 'Buy at'),
        );
    }

}