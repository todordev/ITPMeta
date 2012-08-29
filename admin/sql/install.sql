SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `#__itpm_global_tags` (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `content` text NOT NULL,
  `output` text NOT NULL,
  `published` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY(`id`)
)
ENGINE=INNODB
CHARACTER SET utf8 
COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `#__itpm_urls` (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uri` varchar(2048) NOT NULL,
  `published` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY(`id`)
)
ENGINE=INNODB
CHARACTER SET utf8 
COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `#__itpm_tags` (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `output` text NOT NULL,
  `url_id` smallint(6) UNSIGNED NOT NULL,
  PRIMARY KEY(`id`),
  INDEX `idx_itpmeta_url_id`(`url_id`),
  CONSTRAINT `FK_tags_urls` FOREIGN KEY (`url_id`)
    REFERENCES `m7hxu_itpm_urls`(`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT
)
ENGINE=INNODB
CHARACTER SET utf8 
COLLATE utf8_general_ci ;

SET FOREIGN_KEY_CHECKS=1;