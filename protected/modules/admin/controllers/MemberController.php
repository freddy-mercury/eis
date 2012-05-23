<?php

class MemberController extends AdminController
{
    protected $model_name = 'Member';

	public function actionStats($id) {
		$this->render('stats', array('model' => $this->loadModel($id)));
	}
	public function actionMavro_stats($id) {
		$this->render('mavro_stats', array('model' => $this->loadModel($id)));
	}

}
