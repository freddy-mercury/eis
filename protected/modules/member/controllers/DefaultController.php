<?php

class DefaultController extends MemberController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPromote() {
		$this->render('promote');
	}

	public function actionProfile() {
		/* @var $model Member */
		$model = Yii::app()->user->model;
		$model->setScenario('profile');
		if (isset($_POST['Member'])) {
			$model->attributes = $_POST['Member'];
			if ($model->save()) {
				Yii::app()->user->setFlash('profile', Yii::t('global', ''));
				$this->refresh();
			}
		}
		$this->render('profile', array('model' => $model));
	}
}