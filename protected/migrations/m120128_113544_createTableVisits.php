<?php

class m120128_113544_createTableVisits extends CDbMigration {

	public function up() {
		$this->execute("DROP TABLE IF EXISTS `visits`;
CREATE TABLE `visits` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `url` text,
  `agent` varchar(255) DEFAULT NULL,
  `ip` int(11) unsigned DEFAULT NULL,
  `stamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
	}

	public function down() {
		echo "m120128_113544_createTableVisits does not support migration down.\n";
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