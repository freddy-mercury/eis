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
}