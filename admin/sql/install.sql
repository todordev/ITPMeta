SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `#__itpm_global_tags` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR( 64 ) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `content` text NOT NULL,
  `output` text NOT NULL,
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__itpm_tags` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR( 64 ) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `content` text NOT NULL,
  `output` text NOT NULL,
  `url_id` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_itpmeta_url_id` (`url_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__itpm_urls` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(2048) NOT NULL,
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


ALTER TABLE `#__itpm_tags` ADD CONSTRAINT `FK_tags_urls` FOREIGN KEY (`url_id`) REFERENCES `#__itpm_urls` (`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;