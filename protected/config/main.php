<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Investment System',
	'theme'=>'eis',
	'language'=>'ru',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'backend',
		// uncomment the following to enable the Gii tool
		//*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		//*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class'=>'application.components.SWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=eis',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableParamLogging' => true,
			'queryCacheID'=>'cache',
			'enableProfiling'=>true,
		),
//		'db2'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		'cache'=>array(
			'class'=>'CFileCache',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
		/**
		 * Mail sending component		 
		 */
		'templatemailer'=>array(
			'class'=>'ext.components.templatemailer.TemplateMailer',

			'charset'=>'UTF-8',
			'from'=>'some@yandex.ru',
			'reply_to'=>'some@yandex.ru',
			'from_name'=>'Администрация сайта',
			'smtp_host'=>'127.0.0.1',


			'service_sending'=>false,
			'service_host'=>'ssl://smtp.yandex.ru',
			'service_port'=>465,
			'service_smtp_auth'=>true,
			'service_username'=>'some@yandex.ru',
			'service_pass'=>'123123',



			// Email subjects 'view file'=>'subject'
			'subjects'=>array(
				'default'=>'Администрация сайта',
			),

			// Themed views
			'themed_views'=>false,

			// Test mode
			'dump_mode'=>false,
			'dump_file'=>Yii::getPathOfAlias('runtime').'/templatemailer.log',
		),
		/**
		 * E-currency component
		 */
		'ecurrency'=>array(
			'class'=>'ext.components.ecurrency.Ecurrency',
			'components'=>array(
				'LR'=>array(
					'class'=>'ext.components.ecurrency.components.LiberyReserveApi',
					'name'=>Yii::t('global', 'Liberty Reserve'),
				),
				'PM'=>array(
					'class'=>'ext.components.ecurrency.components.PerfectMoneyApi',
					'name'=>Yii::t('global', 'Perfect Money'),
				),
				'AP'=>array(
					'class'=>'ext.components.ecurrency.components.AlertPayApi',
					'name'=>Yii::t('global', 'Alert Pay'),
				),
			),
		),
	),
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'member_password_salt' => 'SDIuhfw985h13*^%6123lknasdf78Ksdf0=',
		/*
		 * Temporary here
		 * LR - Liberty Reserve
		 * PM - Perfect Money
		 * AP - Alert Pay
		 */
		'ecurrencies' => array('LR', 'PM', 'AP'),
	),
);