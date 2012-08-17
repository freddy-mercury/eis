<?php

class MemberController extends SController
{
	public $layout = '//layouts/column2';

	public $menu = array();

	public function init()
	{
        $this->breadcrumbs = array(
            Yii::t('member', 'Member area') => array('/member/default/index')
        );

		$this->menu[] = array('label' => Yii::t('member', 'Account summary'), 'url' => array('/member/default/index'));

       if (isset(Yii::app()->params['rates'])) {
           $this->menu[] = array('label' => Yii::t('member', 'Buy currency'), 'url' => array('/member/default/buy'));
           $this->menu[] = array('label' => Yii::t('member', 'Sell currency'), 'url' => array('/member/default/sell'));
           $this->menu[] = array('label' => Yii::t('member', 'Buy/Sell history'), 'url' => array('/member/default/history2'));

       }
       elseif (Plan::model()->count()) {
            $this->menu[] = array('label' => Yii::t('member', 'Make deposit'), 'url' => array('/member/default/deposit'));
            $this->menu[] = array('label' => Yii::t('member', 'Request withdrawal'), 'url' => array('/member/default/withdraw'));
	        $this->menu[] = array('label' => Yii::t('member', 'History'), 'url' => array('/member/default/history'));
        }

		$this->menu[] = array('label' => Yii::t('member', 'Messages'), 'url' => array('/member/messages/index'));
		$this->menu[] = array('label' => Yii::t('member', 'Promotion'), 'url' => array('/member/default/promote'));
		$this->menu[] = array('label' => Yii::t('member', 'Edit profile'), 'url' => array('/member/default/profile'));

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

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
}
