SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `#__itpm_global_tags` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `content` text NOT NULL,
  `output` text NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__itpm_tags` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `content` text NOT NULL,
  `output` text NOT NULL,
  `ordering` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `url_id` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_itpmeta_url_id` (`url_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__itpm_urls` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(2048) NOT NULL,
  `after_body_tag` text,
  `before_body_tag` text,
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `autoupdate` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_itpm_uri` (`uri`(64))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;