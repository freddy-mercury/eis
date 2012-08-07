<?php

class m120426_170850_createTableTransaction extends CDbMigration
{
	public function up()
	{
		$this->execute("CREATE TABLE  `transactions` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`member_id` INT( 11 ) NOT NULL ,
`parent_id` INT( 11 ) NOT NULL ,
`type` ENUM(  'd',  'w',  'e',  'r',  'b',  'p',  'i' ) NOT NULL ,
`amount` FLOAT NOT NULL ,
`status` TINYINT( 1 ) NOT NULL DEFAULT  '0',
`time` INT( 11 ) NOT NULL ,
`batch` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY (  `id` )
)");
	}

	public function down()
	{
		echo "m120426_170850_createTableTransaction does not support migration down.\n";
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