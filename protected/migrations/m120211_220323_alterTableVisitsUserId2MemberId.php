<?php

class m120211_220323_alterTableVisitsUserId2MemberId extends CDbMigration
{
	public function up()
	{
		$this->execute("ALTER TABLE `visits`
			CHANGE COLUMN `user_id` `member_id` INT(10) NOT NULL DEFAULT '0' AFTER `id`;");
	}

	public function down()
	{
		echo "m120211_220323_alterTableVisitsUserId2MemberId does not support migration down.\n";
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