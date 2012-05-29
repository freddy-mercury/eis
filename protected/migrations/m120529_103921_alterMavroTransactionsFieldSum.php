<?php

class m120529_103921_alterMavroTransactionsFieldSum extends CDbMigration
{
	public function up()
	{
		$this->execute("ALTER TABLE  `mavro_transactions` ADD  `sum` FLOAT NOT NULL AFTER  `amount`");
	}

	public function down()
	{
		echo "m120529_103921_alterMavroTransactionsFieldSum does not support migration down.\n";
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