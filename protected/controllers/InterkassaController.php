<?php

class InterkassaController extends Controller
{
	public function actionIndex()
	{
        if (Yii::app()->interkassa->chechPayment($_REQUEST)) {
	        /* @var $transaction RatesTransaction */
            $transaction = RatesTransaction::model()->findByPk($_REQUEST['ik_payment_id']);
	        if ($transaction !== null) {
		        $transaction->status = 1;
		        $transaction->save();
	        }
        }
	}

}