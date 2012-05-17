<?php

class DepositForm extends CFormModel
{
    public $plan_id, $amount;

    public function rules()
    {
        return array(
            array('plan_id, amount', 'required'),
            array('plan_id, amount', 'numerical'),

        );
    }

    public function attributeLabels()
    {
        return array(
            'plan_id'=>Yii::t('global', 'Plan'),
            'amount'=>Yii::t('global', 'Amount'),
        );
    }

}
