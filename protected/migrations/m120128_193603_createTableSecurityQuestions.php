<?php

class m120128_193603_createTableSecurityQuestions extends CDbMigration
{
	public function up()
	{
		$this->execute("DROP TABLE IF EXISTS `security_questions`;
		CREATE TABLE `security_questions` (
		  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
		  `text` varchar(255) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		$this->execute("INSERT INTO `security_questions` (`id`, `text`) VALUES
		(1,	'Mother\'s Maiden Name'),
		(2,	'City of Birth'),
		(3,	'Highschool Name'),
		(4,	'Name of Your First Love'),
		(5,	'Favorite Pet'),
		(6,	'Favorite Book'),
		(7,	'Favorite TV Show/Sitcom'),
		(8,	'Favorite Movie'),
		(9,	'Favorite Flower'),
		(10,	'Favorite Color');");
	}

	public function down()
	{
		echo "m120128_193603_createTableSecurityQuestions does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}