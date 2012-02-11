<?php

class m120211_134844_cms_install extends CDbMigration
{
	public function up()
	{
		$this->execute(
"CREATE TABLE IF NOT EXISTS `cms_node` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL,
  `parentId` int(10) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name_deleted` (`name`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
		$this->execute("
CREATE TABLE IF NOT EXISTS `cms_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nodeId` int(10) unsigned NOT NULL,
  `locale` varchar(50) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `body` longtext,
  `css` longtext,
  `url` varchar(255) DEFAULT NULL,
  `pageTitle` varchar(255) DEFAULT NULL,
  `breadcrumb` varchar(255) DEFAULT NULL,
  `metaTitle` varchar(255) DEFAULT NULL,
  `metaDescription` varchar(255) DEFAULT NULL,
  `metaKeywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contentId_locale` (`nodeId`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
		$this->execute("
CREATE TABLE IF NOT EXISTS `cms_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contentId` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `extension` varchar(50) NOT NULL,
  `mimeType` varchar(255) NOT NULL,
  `byteSize` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contentId` (`contentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
		
		$this->execute("
INSERT INTO `cms_content` (`id`, `nodeId`, `locale`, `heading`, `body`, `css`, `url`, `pageTitle`, `breadcrumb`, `metaTitle`, `metaDescription`, `metaKeywords`) VALUES
(1, 1, 'ru', 'О проекте', '<h1>О проекте</h1>\n\n<p>Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla magna quam, consequat et auctor non, vulputate quis arcu. Cras in augue non urna pellentesque mollis. Integer sagittis ipsum id lorem viverra ac facilisis nisl vehicula. Morbi id rutrum ligula. Pellentesque egestas ipsum sit amet nunc dignissim bibendum dignissim nulla lobortis. Donec est erat, tincidunt vitae suscipit sed, aliquam eu ligula. Nam tellus odio, blandit ut mollis id, accumsan quis turpis. Suspendisse pulvinar porttitor nisi, non suscipit felis scelerisque ac. Morbi et ipsum a eros fringilla fringilla. Integer ultrices lorem ut velit consequat vel adipiscing nunc condimentum. Donec consequat, magna rutrum luctus ornare, libero dolor sagittis metus, commodo porta ante mauris ut ligula. Nunc euismod gravida imperdiet. Suspendisse sit amet ipsum eu ligula tristique porttitor. Quisque dictum orci gravida velit condimentum in eleifend massa dapibus. Sed ligula tortor, accumsan ac blandit a, commodo eu arcu.</p>\n\n<p>Aliquam erat volutpat. Ut et neque non tellus faucibus accumsan vel et mauris. In a purus turpis. Duis vestibulum tortor sit amet justo placerat non pellentesque leo imperdiet. Sed mauris elit, sodales vel imperdiet at, vehicula tempus neque. Fusce malesuada malesuada mollis. Ut a orci ac dui auctor placerat non non tellus. Curabitur mattis imperdiet imperdiet. Donec lacinia, lorem elementum mollis laoreet, ligula dolor blandit mauris, eget imperdiet est lectus eu massa. Curabitur et elementum leo. Aenean vitae elit velit. In lobortis molestie tincidunt.</p>\n\n<p>In convallis nisi ut justo accumsan viverra. Donec lorem nunc, posuere vel placerat id, tempus eu purus. Nulla ullamcorper orci id elit consectetur egestas. Integer libero neque, elementum non tincidunt at, aliquet eget lectus. In hac habitasse platea dictumst. Sed luctus blandit eros, quis placerat nulla commodo nec. Donec ut nunc sed velit varius facilisis id id ligula. Aenean quis magna vitae lacus gravida congue ut eget lorem. Maecenas condimentum nunc eu nunc porttitor facilisis.</p>\n\n<p>Pellentesque tempor sollicitudin justo quis laoreet. Donec eu tempor felis. Ut vehicula ullamcorper metus at posuere. Donec massa nisi, fringilla ac ultricies faucibus, semper ac enim. Duis sit amet varius massa. Vestibulum malesuada tellus nec diam gravida eget tristique nibh vulputate. Nunc et tortor ante. Sed vitae lorem erat, ut viverra erat.</p>', '', '', '', 'О проекте', '', '', ''),
(2, 1, 'en', 'About Project', '<h1>About project</h1>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla magna quam, consequat et auctor non, vulputate quis arcu. Cras in augue non urna pellentesque mollis. Integer sagittis ipsum id lorem viverra ac facilisis nisl vehicula. Morbi id rutrum ligula. Pellentesque egestas ipsum sit amet nunc dignissim bibendum dignissim nulla lobortis. Donec est erat, tincidunt vitae suscipit sed, aliquam eu ligula. Nam tellus odio, blandit ut mollis id, accumsan quis turpis. Suspendisse pulvinar porttitor nisi, non suscipit felis scelerisque ac. Morbi et ipsum a eros fringilla fringilla. Integer ultrices lorem ut velit consequat vel adipiscing nunc condimentum. Donec consequat, magna rutrum luctus ornare, libero dolor sagittis metus, commodo porta ante mauris ut ligula. Nunc euismod gravida imperdiet. Suspendisse sit amet ipsum eu ligula tristique porttitor. Quisque dictum orci gravida velit condimentum in eleifend massa dapibus. Sed ligula tortor, accumsan ac blandit a, commodo eu arcu.</p>\n\n<p>Aliquam erat volutpat. Ut et neque non tellus faucibus accumsan vel et mauris. In a purus turpis. Duis vestibulum tortor sit amet justo placerat non pellentesque leo imperdiet. Sed mauris elit, sodales vel imperdiet at, vehicula tempus neque. Fusce malesuada malesuada mollis. Ut a orci ac dui auctor placerat non non tellus. Curabitur mattis imperdiet imperdiet. Donec lacinia, lorem elementum mollis laoreet, ligula dolor blandit mauris, eget imperdiet est lectus eu massa. Curabitur et elementum leo. Aenean vitae elit velit. In lobortis molestie tincidunt.</p>\n\n<p>In convallis nisi ut justo accumsan viverra. Donec lorem nunc, posuere vel placerat id, tempus eu purus. Nulla ullamcorper orci id elit consectetur egestas. Integer libero neque, elementum non tincidunt at, aliquet eget lectus. In hac habitasse platea dictumst. Sed luctus blandit eros, quis placerat nulla commodo nec. Donec ut nunc sed velit varius facilisis id id ligula. Aenean quis magna vitae lacus gravida congue ut eget lorem. Maecenas condimentum nunc eu nunc porttitor facilisis.</p>\n\n<p>Pellentesque tempor sollicitudin justo quis laoreet. Donec eu tempor felis. Ut vehicula ullamcorper metus at posuere. Donec massa nisi, fringilla ac ultricies faucibus, semper ac enim. Duis sit amet varius massa. Vestibulum malesuada tellus nec diam gravida eget tristique nibh vulputate. Nunc et tortor ante. Sed vitae lorem erat, ut viverra erat.</p>\n\n<p>Suspendisse accumsan sem non felis hendrerit consectetur tempus enim interdum. Cras ut augue metus. Morbi in nisi non tellus molestie rutrum. Fusce commodo sem vel dolor iaculis non tempus metus consequat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vel ipsum turpis, sit amet molestie orci. Ut aliquam commodo lacus, non laoreet ante vehicula eget. Donec ac mi odio. Suspendisse potenti.</p>', '', '', '', '', '', '', '');
");
		$this->execute("
INSERT INTO `cms_node` (`id`, `created`, `updated`, `parentId`, `name`, `deleted`) VALUES
(1, '2012-02-11 18:25:54', '2012-02-11 18:31:17', 0, 'about', 0);
			");
		
	}

	public function down()
	{
		echo "m120211_134844_cms_install does not support migration down.\n";
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
