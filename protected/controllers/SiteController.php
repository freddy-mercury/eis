<?php

class SiteController extends SController
{
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
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->redirect(array(Yii::app()->cms->createUrl('index')));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionFeedback()
	{
		$model = new FeedbackForm;
		if (isset($_POST['FeedbackForm'])) {
			$model->attributes = $_POST['FeedbackForm'];
			if ($model->validate()) {
				$mailing_list = array(
					array(
						'email' => array(Yii::app()->params['adminEmail']),
						'template' => 'contact', // шаблон из папки protected/views/email/contact.php
						'subject' => $model->subject,
						'template_vars' => array(
                            'from' => $model->email,
                            'subject' => $model->subject,
							'body' => $model->body,
						),
					),
				);
				Yii::app()->templatemailer->massSend($mailing_list);
				Yii::app()->user->setFlash('contact', Yii::t('feedback','Thank you for contacting us. We will respond to you as soon as possible.'));
				$this->refresh();
			}
		}
		$this->render('feedback', array('model' => $model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('/');
	}

	public function actionRegister()
	{
		$model = new Member('register');
		if (isset($_POST['Member'])) {
			$model->setAttributes($_POST['Member']);
			if ($model->save()) {
				Yii::app()->user->setFlash('register', Yii::t('registration', 'You have successfully create an account! '
                    . 'You can use your credentials to log in.'));
				$this->refresh();
			}
		}
		$this->render('registration', array('model' => $model));
	}

	public function actionSuccess() {
		$this->render('success');
	}

	public function actionFail() {
		$this->render('fail');
	}

    public function actionRates() {
        $this->render('rates');
    }
}