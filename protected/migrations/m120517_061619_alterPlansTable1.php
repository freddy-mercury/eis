<?php

class m120517_061619_alterPlansTable1 extends CDbMigration
{
	public function up()
	{
        $this->execute("ALTER TABLE  `plans` ADD  `periodicity_value` ENUM(  'h',  'd',  'w',  'm',  'y' ) NOT NULL AFTER  `periodicity`");
        $this->execute("ALTER TABLE  `plans` ADD  `term_value` ENUM(  'h',  'd',  'w',  'm',  'y' ) NOT NULL AFTER  `term`");
	}

	public function down()
	{
		echo "m120517_061619_alterPlansTable1 does not support migration down.\n";
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