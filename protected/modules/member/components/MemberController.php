<?php

class MemberController extends SController
{
	public $layout = '//layouts/column2';

	public $menu = array();

	public function init()
	{
		$this->menu = array(
			array('label' => Yii::t('global', 'Account summary'), 'url' => array('index')),
			array('label' => Yii::t('global', 'Make deposit'), 'url' => array('deposit')),
			array('label' => Yii::t('global', 'Request withdrawal'), 'url' => array('withdraw')),
			array('label' => Yii::t('global', 'History'), 'url' => array('history')),
			array('label' => Yii::t('global', 'Messages'), 'url' => array('messages')),
			array('label' => Yii::t('global', 'Promotion'), 'url' => array('promote')),
			array('label' => Yii::t('global', 'Edit profile'), 'url' => array('profile')),
		);
		parent::init();
	}
	/**
	 * Declares class-based actions.
	 * @return array
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}
}
