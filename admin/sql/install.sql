CREATE TABLE IF NOT EXISTS `#__itpm_tags` (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text,
  `url_id` smallint(6) UNSIGNED NOT NULL,
  PRIMARY KEY(`id`)
)
ENGINE=MYISAM
ROW_FORMAT=default
CHARACTER SET utf8 
COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `#__itpm_urls` (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(1024) NOT NULL,
  `published` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY(`id`)
)
ENGINE=MYISAM
ROW_FORMAT=default
CHARACTER SET utf8 
COLLATE utf8_general_ci ;