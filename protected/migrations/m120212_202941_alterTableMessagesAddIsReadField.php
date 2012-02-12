<?php

class m120212_202941_alterTableMessagesAddIsReadField extends CDbMigration
{
	public function up()
	{
		$this->execute("ALTER TABLE `messages` ADD COLUMN `is_read` TINYINT(1) NULL AFTER `stamp`;");
	}

	public function down()
	{
		echo "m120212_202941_alterTableMessagesAddIsReadField does not support migration down.\n";
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