<?php

class m120211_214847_createTableMessages extends CDbMigration
{
	public function up()
	{
		$this->execute("CREATE TABLE `messages` (
			`id` INT(10) NULL AUTO_INCREMENT,
			`member_id` INT(10) NULL,
			`subject` VARCHAR(255) NULL,
			`text` TEXT NULL,
			`stamp` INT(10) NULL,
			PRIMARY KEY (`id`)
		)
		COLLATE='utf8_general_ci'
		ENGINE=MyISAM;
		");
	}

	public function down()
	{
		echo "m120211_214847_createTableMessages does not support migration down.\n";
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