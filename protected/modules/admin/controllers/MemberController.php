<?php

class MemberController extends AdminController
{
    protected $model_name = 'Member';

	public function actionStats($id) {
		$this->render('stats', array('model' => $this->loadModel($id)));
	}
}
