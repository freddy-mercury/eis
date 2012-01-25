<?php
/**
 * Usage commands (*nix way):
 * $ cd PATH_TO_PROTECTED_FOLDER
 * $ ./yiic message ./extensions/sitemapgenerator/messages/config.php 
 * 
 * 
 * Config file for 'yiic message' for sitemapgenerator extension.
 */
return array(
	'sourcePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'messagePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages',
	'languages'=>array('ru'),
	'fileTypes'=>array('php'),
	'exclude'=>array('.svn'),
	'translator'=>'Yii::t',
	'overwrite'=>true,
);
