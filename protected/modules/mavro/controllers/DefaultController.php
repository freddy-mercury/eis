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
                $this->render('robokassa', array('amount' => $model->amount));
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