<?php

class DefaultController extends MemberController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}