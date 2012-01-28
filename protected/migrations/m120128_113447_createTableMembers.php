<?php

class m120128_113447_createTableMembers extends CDbMigration {

	public function up() {
		$this->execute("DROP TABLE IF EXISTS `members`;
						CREATE TABLE `members` (
						  `id` int(10) NOT NULL AUTO_INCREMENT,
						  `login` varchar(50) DEFAULT NULL,
						  `password` varchar(255) DEFAULT NULL,
						  `login_pin` varchar(10) DEFAULT NULL,
						  `master_pin` varchar(10) DEFAULT NULL,
						  `email` varchar(150) DEFAULT NULL,
						  `security_question` varchar(255) DEFAULT NULL,
						  `security_answer` varchar(255) DEFAULT NULL,
						  `security_question2` varchar(255) DEFAULT NULL,
						  `security_answer2` varchar(255) DEFAULT NULL,
						  `firstname` varchar(255) DEFAULT NULL,
						  `lastname` varchar(255) DEFAULT NULL,
						  `birthdate` date DEFAULT NULL,
						  `country` smallint(3) DEFAULT NULL,
						  `city` varchar(255) DEFAULT NULL,
						  `zip` varchar(255) DEFAULT NULL,
						  `address` text,
						  `ecurrency` char(2) DEFAULT 'LR',
						  `ecurrency_purse` varchar(255) DEFAULT NULL,
						  `login_notify` tinyint(1) DEFAULT '1',
						  `profile_notify` tinyint(1) DEFAULT '1',
						  `withdrawal_notify` tinyint(1) DEFAULT '1',
						  `transaction_limit` float DEFAULT '0',
						  `daily_limit` float DEFAULT '0',
						  `total_limit` float DEFAULT '0',
						  `lang` char(2) DEFAULT 'en',
						  `status` tinyint(1) DEFAULT '0',
						  `date_registered` int(11) DEFAULT NULL,
						  `hash` varchar(32) DEFAULT NULL,
						  `monitor` tinyint(1) DEFAULT '0',
						  PRIMARY KEY (`id`),
						  UNIQUE KEY `login_email` (`login`,`email`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		$this->execute("INSERT INTO `members` (`id`, `login`, `password`, `login_pin`, `master_pin`, `email`,
`security_question`, `security_answer`, `security_question2`, `security_answer2`, `firstname`, `lastname`, `birthdate`,
`country`, `city`, `zip`, `address`, `ecurrency`, `ecurrency_purse`, `login_notify`, `profile_notify`,
`withdrawal_notify`, `transaction_limit`, `daily_limit`, `total_limit`, `lang`, `status`, `date_registered`, `hash`,
`monitor`) VALUES (1,	'admin',	'admin',	'11111',	'111',	'admin@admin.local',	'question1',	'answer1',
'question2',	'answer2',	'firstname',	'lastname',	'2012-01-28',	NULL,	NULL,	NULL,	NULL,	'LR',
'U1234567',	1,	1,	1,	0,	0,	0,	'en',	1,	NULL,	NULL,	0);");

	}

	public function down() {
		echo "m120128_113447_createTableMembers does not support migration down.\n";
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