<?php

class DefaultController extends MemberController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPromote()
	{
		$this->render('promote');
	}

	public function actionProfile()
	{
		/* @var $model Member */
		$model = clone Yii::app()->user->model;
		$model->setScenario('profile');
		if (isset($_POST['Member'])) {
			$model->setAttributes($_POST['Member']);
			if ($model->validate()) {
				$model->password = $model->password ? : Yii::app()->user->model->password;
				$model->login_pin = $model->login_pin ? : Yii::app()->user->model->login_pin;
				$model->master_pin = $model->master_pin ? : Yii::app()->user->model->master_pin;
				if ($model->save(false)) {
					Yii::app()->user->setFlash('profile', Yii::t('global', 'Profile has been saved.'));
					$this->refresh();
				}
			}
		}
		$model->password = '';
		$model->password_repeat = '';
		$model->login_pin = '';
		$model->master_pin = '';
		$this->render('profile', array('model' => $model));
	}

	public function actionDeposit() {
        $model=new DepositForm;

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='deposit-form-deposit-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */

        if(isset($_POST['DepositForm']))
        {
            $model->attributes=$_POST['DepositForm'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('deposit',array('model'=>$model));
	}

    public function actionHistory() {
        $this->render('history', array('model' => Yii::app()->user->model));
    }

	public function actionBuy()
	{
		$model=new BuyForm;

		if(isset($_POST['BuyForm']))
		{
			$model->attributes=$_POST['BuyForm'];
			if($model->validate())
			{
				$rates = Rates::getCurrentRates();
				$quantity = round($model->quantity, 3);
				$amount = round($quantity * $rates['sell'], 3);

				$rates_transaction = new RatesTransaction();
				$rates_transaction->member_id = Yii::app()->user->id;
				$rates_transaction->time = time();
				$rates_transaction->type = 'buy';
				$rates_transaction->rate = $rates['sell'];
				$rates_transaction->quantity = $quantity;
				$rates_transaction->status = 0;
				$rates_transaction->save();

				//@todo переходим к оплате
				$interkassa = Yii::app()->interkassa->getPaymentForm($amount, $rates_transaction->id,
					Yii::t('member', 'Buy {amount} {currency_name}',
						array(
							'{amount}' => $amount,
							'{currency_name}' => Yii::app()->params['rates']['name']
						)
					)
				);
				echo $interkassa;
				return;
			}
		}
		$this->render('buy',array('model'=>$model));
	}

	public function actionSell()
	{
		$model=new SellForm;

		if(isset($_POST['SellForm']))
		{
			$model->attributes=$_POST['SellForm'];
			if($model->validate())
			{
				$rates = Rates::getCurrentRates();
				$quantity = round($model->quantity, 3);
				//@todo Ставим статус pending
				$rates_transaction = new RatesTransaction();
				$rates_transaction->member_id = Yii::app()->user->id;
				$rates_transaction->time = time();
				$rates_transaction->type = 'sell';
				$rates = Rates::getCurrentRates();
				$rates_transaction->rate = $rates['buy'];
				$rates_transaction->quantity = -abs($quantity);
				$rates_transaction->status = 1;
				$rates_transaction->save();
				Yii::app()->user->setFlash('sell', Yii::t('global', 'Your sell request has been queued!'));
				$this->refresh();
			}
		}
		$this->render('sell',array('model'=>$model));
	}

    public function actionHistory2() {
        $this->render('history2', array('model' => Yii::app()->user->model));
    }
}