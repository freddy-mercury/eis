<?php

class InterkassaController extends Controller
{
	public function actionIndex()
	{
        if (Yii::app()->interkassa->chechPayment($_REQUEST)) {
            // @todo заносим платеж в БД
        }
	}

}