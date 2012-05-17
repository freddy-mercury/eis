<?php
Yii::import('member.components.*');

class DefaultController extends MemberController
{
	public function actionIndex()
	{
        $model=new MavroDepositForm;


        if(isset($_POST['MavroDepositForm']))
        {
            $model->attributes=$_POST['MavroDepositForm'];
            if($model->validate())
            {
                $this->render('robokassa', array('amount' => $model->amount));
                return;
            }
        }
        $this->render('index', array('model'=>$model));
	}

    public function actionSell() {

        $this->render('sell');
    }
}