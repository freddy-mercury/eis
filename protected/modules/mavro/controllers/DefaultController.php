<?php
Yii::import('member.components.*');

class DefaultController extends MemberController
{
	public function actionIndex()
	{
        $model=new MavroBuyForm;


        if(isset($_POST['MavroBuyForm']))
        {
            $model->attributes=$_POST['MavroBuyForm'];
            if($model->validate())
            {
	            $mavro_transaction = new MavroTransaction();
	            $sum = round($model->sum,2);
	            $mavro_transaction->setAttributes(array(
		            'member_id' => Yii::app()->user->id,
					'type' => 'buy',
		            'amount' => $model->amount,
		            'sum' => $sum,
		            'time' => time(),
		            'status' => 0,
	            ));
	            $mavro_transaction->save();

	            /* @var $robokassa Robokassa */
	            $robokassa = Yii::app()->robokassa;
                /* @var $sprypay SpryPay */
                $sprypay = Yii::app()->sprypay;
                if ($robokassa->enable) {
                    $this->redirect($robokassa->getPaymentUrl($sum, $mavro_transaction->id,
                        Yii::t('mavro', 'Buying MAVRO {amount}', array('{amount}' => $model->amount))));
                }
                elseif ($sprypay->enable) {
                    $this->redirect($sprypay->getPaymentUrl($sum, $mavro_transaction->id,
                        Yii::t('mavro', 'Buying MAVRO {amount}', array('{amount}' => $model->amount)), array('email' => Yii::app()->user->model->email)));
                }

                return;
            }
        }
        $this->render('index', array('model'=>$model));
	}

    public function actionSell() {

	    $model=new MavroSellForm;


	    if(isset($_POST['MavroSellForm']))
	    {
		    $model->attributes=$_POST['MavroSellForm'];
		    if($model->validate())
		    {
			    $rates = Yii::app()->mavro->getTodayRates();
			    $mavro_transaction = new MavroTransaction();
			    $mavro_transaction->setAttributes(array(
				    'member_id' => Yii::app()->user->id,
				    'type' => 'sell',
				    'amount' => $model->amount,
				    'sum' => round($rates[1] * $model->amount, 2),
				    'time' => time(),
				    'status' => 0,
			    ));
			    $mavro_transaction->save();

			    $rates = Yii::app()->mavro->getTodayRates();
			    $mavro_sell_request = new MavroSellRequest();
			    $mavro_sell_request->setAttributes(array(
				    'member_id' => Yii::app()->user->id,
				    'transaction_id' => $mavro_transaction->id,
				    'amount' => $model->amount,
				    'rate' => $rates[1],
				    'payment_info' => $model->payment_info,
				    'time' => time(),
				    'status' => 0,
			    ));
			    $mavro_sell_request->save();
			    Yii::app()->user->setFlash('mavro_sell_request', Yii::t('mavro', 'Your sell request has been accepted. It will be executed in 24 hours.'));
			    $this->refresh();
		    }
	    }
	    $this->render('sell', array('model'=>$model));
    }

	public function actionHistory() {
		$this->render('history', array('model' => Yii::app()->user->model));
	}
}