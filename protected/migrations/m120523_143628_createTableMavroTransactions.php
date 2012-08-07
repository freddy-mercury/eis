<?php

class m120523_143628_createTableMavroTransactions extends CDbMigration
{
	public function up()
	{
		$this->execute("CREATE TABLE  `mavro_transactions` (
`id` INT NOT NULL AUTO_INCREMENT ,
`member_id` INT( 11 ) NOT NULL ,
`type` ENUM(  'buy',  'sell' ) NOT NULL ,
`amount` FLOAT NOT NULL ,
`time` INT ( 11 ) NOT NULL,
`status` TINYINT NOT NULL ,
PRIMARY KEY (  `id` )
)");
	}

	public function down()
	{
		echo "m120523_143628_createTableMavroTransactions does not support migration down.\n";
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