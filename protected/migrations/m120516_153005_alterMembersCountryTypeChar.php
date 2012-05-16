<?php

class m120516_153005_alterMembersCountryTypeChar extends CDbMigration
{
	public function up()
	{
		$this->execute("ALTER TABLE  `members` CHANGE  `country`  `country` INT( 2 ) NULL DEFAULT NULL");
	}

	public function down()
	{
		echo "m120516_153005_alterMembersCountryTypeChar does not support migration down.\n";
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