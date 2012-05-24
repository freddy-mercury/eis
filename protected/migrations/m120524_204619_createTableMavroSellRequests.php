<?php

class m120524_204619_createTableMavroSellRequests extends CDbMigration
{
	public function up()
	{
		$this->execute("CREATE TABLE  `eis`.`mavro_sell_requests` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`member_id` INT( 11 ) NOT NULL ,
`transaction_id` INT( 11 ) NOT NULL ,
`amount` FLOAT NOT NULL ,
`rate` FLOAT NOT NULL ,
`payment_info` TEXT NOT NULL ,
`time` INT ( 11 ) NOT NULL,
`status` TINYINT NOT NULL ,
PRIMARY KEY (  `id` )
)");
	}

	public function down()
	{
		echo "m120524_204619_createTableMavroSellRequests does not support migration down.\n";
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