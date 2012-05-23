<?php

class MemberController extends SController
{
	public $layout = '//layouts/column2';

	public $menu = array();

	public function init()
	{
        $this->breadcrumbs = array(
            Yii::t('global', 'Member area') => array('/member/default/index')
        );

		$this->menu[] = array('label' => Yii::t('global', 'Account summary'), 'url' => array('/member/default/index'));

        /* If MAVRO module enabled, add link */
        if (Yii::app()->mavro->enabled) {
            $this->menu[] = array('label' => Yii::t('mavro', 'Buy MAVRO'), 'url' => array('/mavro/default/index'));
            $this->menu[] = array('label' => Yii::t('mavro', 'Sell MAVRO'), 'url' => array('/mavro/default/sell'));
	        $this->menu[] = array('label' => Yii::t('mavro', 'Operation\'s history'), 'url' => array('/mavro/default/history'));
        }

        if (Plan::model()->count()) {
            $this->menu[] = array('label' => Yii::t('global', 'Make deposit'), 'url' => array('/member/default/deposit'));
            $this->menu[] = array('label' => Yii::t('global', 'Request withdrawal'), 'url' => array('/member/default/withdraw'));
	        $this->menu[] = array('label' => Yii::t('global', 'History'), 'url' => array('/member/default/history'));
        }

		$this->menu[] = array('label' => Yii::t('global', 'Messages'), 'url' => array('/member/messages/index'));
		$this->menu[] = array('label' => Yii::t('global', 'Promotion'), 'url' => array('/member/default/promote'));
		$this->menu[] = array('label' => Yii::t('global', 'Edit profile'), 'url' => array('/member/default/profile'));

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
