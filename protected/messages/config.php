<?php
/**
 * Usage commands (*nix way):
 * $ cd PATH_TO_PROTECTED_FOLDER
 * $ ./yiic message ./messages/config.php 
 */
return array(
	'sourcePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'../..',
	'messagePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'messages',
	'languages'=>array('ru','en'),
	'fileTypes'=>array('php'),
	'exclude'=>array('.svn','.git'),
	'translator'=>'Yii::t',
	'overwrite'=>true,
);
