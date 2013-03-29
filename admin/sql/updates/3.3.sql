SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE `#__itpm_tags` DROP FOREIGN KEY `FK_tags_urls`;
ALTER TABLE `#__itpm_tags` ADD `ordering` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `output`;
ALTER TABLE `#__itpm_tags` ADD `published` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' AFTER `ordering`;

ALTER TABLE `#__itpm_global_tags` ADD `ordering` TINYINT UNSIGNED NOT NULL DEFAULT '0' AFTER `output`;

ALTER TABLE `#__itpm_urls` ADD `after_body_tag` TEXT NULL AFTER `uri`; 
ALTER TABLE `#__itpm_urls` ADD `before_body_tag` TEXT NULL AFTER `after_body_tag` ;

SET FOREIGN_KEY_CHECKS=1;