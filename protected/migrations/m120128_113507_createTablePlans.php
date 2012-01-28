<?php

class m120128_113507_createTablePlans extends CDbMigration {

	public function up() {
		$this->execute("DROP TABLE IF EXISTS `plans`;
CREATE TABLE `plans` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `min` float NOT NULL,
  `max` float NOT NULL,
  `percent` float NOT NULL,
  `percent_per` enum('term','periodicity') NOT NULL DEFAULT 'term',
  `periodicity` int(10) NOT NULL DEFAULT '86400',
  `term` int(10) NOT NULL DEFAULT '86400',
  `compounding` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `monfri` tinyint(1) NOT NULL DEFAULT '1',
  `principal_back` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
	}

	public function down() {
		echo "m120128_113507_createTablePlans does not support migration down.\n";
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