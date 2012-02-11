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
}