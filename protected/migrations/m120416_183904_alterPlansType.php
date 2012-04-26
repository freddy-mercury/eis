<?php

class m120416_183904_alterPlansType extends CDbMigration
{
	public function up()
	{
		$this->execute("ALTER TABLE  `plans` CHANGE  `type`  `type` ENUM(  'public',  'user',  'monitor' ) NOT NULL DEFAULT  'public'");
	}

	public function down()
	{
		echo "m120416_183904_alterPlansType does not support migration down.\n";
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