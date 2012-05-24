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
	            $mavro_transaction->setAttributes(array(
		            'member_id' => Yii::app()->user->id,
					'type' => 'buy',
		            'amount' => $model->amount,
		            'time' => time(),
		            'status' => 0,
	            ));
	            $mavro_transaction->save();
	            /* @var $robokassa Robokassa */
	            $robokassa = Yii::app()->robokassa;
	            $this->redirect($robokassa->url . '/Index.aspx?'
		            .'MrchLogin='.$robokassa->merchant_login.'&'
		            .'OutSum='.$model->amount.'&'
		            .'InvId='.$mavro_transaction->id.'&'
		            .'Desc='.urlencode(Yii::t('mavro', 'Buy MAVRO {amount}', array('{amount}' => $model->amount))).'&'
		            .'SignatureValue='.$robokassa->getSignature1($model->amount, $mavro_transaction->id).'&'
		            .'IncCurrLabel=&'
		            .'Culture='.$robokassa->getLanguage());
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
			    return;
		    }
	    }
	    $this->render('sell', array('model'=>$model));
    }

	public function actionHistory() {
		$this->render('history', array('model' => Yii::app()->user->model));
	}
}