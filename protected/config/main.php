<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'МММ-2011',
	'theme' => 'mmm2011',
	'language' => 'en',

	// preloading 'log' component
	'preload' => array('log'),

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
		'application.components.*',
		'application.modules.cms.CmsModule',
	),
	'behaviors' => array(
		'onBeginRequest' => array(
			'class' => 'application.components.behaviors.BeginRequest'
		),
	),

	'modules' => array(
		'cms',
		'admin',
		'member',
		'mavro',
		// uncomment the following to enable the Gii tool
		//*
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
		),
		//*/
	),

	// application components
	'components' => array(
		'mavro' => array(
			'class' => 'mavro.components.Mavro',
		),
		'cms' => array(
			'class' => 'cms.components.Cms',
			'users' => array('admin'),
			'attachmentPath' => '/files/',
			'allowedFileSize' => 1024,
			'defaultLanguage' => 'en',
			'appLayout' => '//layouts/column1',
			'languages' => array(
				'ru' => 'Русский',
				'en' => 'English',
			),
		),
		'user' => array(
			'class' => 'application.components.SWebUser',
			// enable cookie-based authentication
			'allowAutoLogin' => true,
		),
		'request' => array(
			'enableCookieValidation' => true,
			'enableCsrfValidation' => true,
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => array(
				'page/<name>-<id:\d+>.html' => 'cms/node/page', // clean URLs for pages
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=eis',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableParamLogging' => true,
			'queryCacheID' => 'cache',
			'enableProfiling' => true,
		),
//		'db2'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		'cache' => array(
			'class' => 'CFileCache',
		),
		'errorHandler' => array(
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				array(
					'class' => 'CWebLogRoute',
				),
			),
		),
		/**
		 * Mail sending component
		 */
		'templatemailer' => array(
			'class' => 'ext.components.templatemailer.TemplateMailer',

			'charset' => 'UTF-8',
			'from' => 'info@mmm2011-auto.com',
			'reply_to' => 'info@mmm2011-auto.com',
			'from_name' => Yii::t('global','MMM2011-AUTO.COM'),
			'smtp_host' => '127.0.0.1',


			'service_sending' => true,
			'service_host' => '127.0.0.1',
			'service_port' => 25,
			'service_smtp_auth' => true,
			'service_username' => 'info@mmm2011-auto.com',
			'service_pass' => '7EL2M9OSccIR6',


			// Email subjects 'view file'=>'subject'
			'subjects' => array(
				'default' => 'Администрация сайта',
			),

			// Themed views
			'themed_views' => false,

			// Test mode
			'dump_mode' => false,
			'dump_file' => Yii::getPathOfAlias('runtime') . DIRECTORY_SEPARATOR . 'templatemailer.log',
		),
		'robokassa' => array(
            'enable' => false,
			'class' => 'ext.components.robokassa.Robokassa',
			'test' => true,
			'merchant_login' => 'mmm2011-auto',
			'password1' => 'aPo01cMRAHAkA',
			'password2' => '8eUwYhTrtfiy2',
		),
        'sprypay' => array(
            'enable' => true,
            'class' => 'ext.components.sprypay.Sprypay',
            'shop_id' => '209141',
            'secret_key' => '41e045cdbaf82e687a7d33da70212c6f',
        ),
		/**
		 * E-currency component
		 */
		'ecurrency' => array(
			'class' => 'ext.components.ecurrency.Ecurrency',
			'components' => array(
				'LR' => array(
					'enabled' => false,
					'class' => 'ext.components.ecurrency.components.LiberyReserveApi',
					'name' => Yii::t('global', 'Liberty Reserve'),
				),
				'PM' => array(
					'enabled' => false,
					'class' => 'ext.components.ecurrency.components.PerfectMoneyApi',
					'name' => Yii::t('global', 'Perfect Money'),
				),
				'AP' => array(
					'enabled' => false,
					'class' => 'ext.components.ecurrency.components.AlertPayApi',
					'name' => Yii::t('global', 'Alert Pay'),
				),
			),
		),
	),
	'params' => array(
		'adminEmail' => 'merchant@mmm2011-auto.com',
		'member_password_salt' => 'SDIuhfw985h13*^%6123lknasdf78Ksdf0=',
		'languages' => array(
			'ru' => 'Русский',
			'en' => 'English',
		)
	),
);