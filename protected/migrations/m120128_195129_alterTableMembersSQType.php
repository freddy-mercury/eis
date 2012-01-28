<?php

class m120128_195129_alterTableMembersSQType extends CDbMigration
{
	public function up()
	{
		$this->execute("ALTER TABLE `members`
CHANGE `security_question` `security_question` tinyint(3) unsigned NULL AFTER `email`,
CHANGE `security_question2` `security_question2` tinyint(3) unsigned NULL AFTER `security_answer`;");
		$this->execute("ALTER TABLE `members` DROP `hash`;");
	}

	public function down()
	{
		echo "m120128_195129_alterTableMembersSQType does not support migration down.\n";
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