CREATE TABLE IF NOT EXISTS `#__itpm_global_tags` (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `type` varchar(64) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `content` text NOT NULL,
  `output` text NOT NULL,
  `ordering` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `published` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__itpm_tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `type` varchar(64) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `content` text NOT NULL,
  `output` text NOT NULL,
  `ordering` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `url_id` smallint(6) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_itpmeta_url_id` (`url_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__itpm_urls` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uri` varchar(2048) NOT NULL,
  `after_body_tag` text,
  `before_body_tag` text,
  `published` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `autoupdate` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `parent_menu_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'This URI is connected to that menu item.',
  `menu_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'This is the menu item of current URI.',
  `primary_url` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `checked` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_itpm_uri` (`uri`(191)) USING BTREE,
  KEY `idx_itpm_uri_checked` (`uri`(191),`checked`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;