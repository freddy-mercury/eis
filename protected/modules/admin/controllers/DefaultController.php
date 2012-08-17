<?php

class DefaultController extends AdminController
{
	
	public $layout='//layouts/column2';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}