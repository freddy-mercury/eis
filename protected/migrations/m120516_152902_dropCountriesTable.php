<?php

class m120516_152902_dropCountriesTable extends CDbMigration
{
	public function up()
	{
		$this->execute('DROP TABLE  `countries`');
	}

	public function down()
	{
		echo "m120516_152902_dropCountriesTable does not support migration down.\n";
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