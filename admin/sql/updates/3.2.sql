SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE `#__itpm_tags` DROP FOREIGN KEY `FK_tags_urls`;

ALTER TABLE `#__itpm_tags` ADD `name` VARCHAR( 64 ) NOT NULL DEFAULT '' AFTER `id`;
ALTER TABLE `#__itpm_global_tags` ADD `name` VARCHAR( 64 ) NOT NULL DEFAULT '' AFTER `id`;

ALTER TABLE `#__itpm_tags` ADD CONSTRAINT `FK_tags_urls` FOREIGN KEY (`url_id`) REFERENCES `#__itpm_urls` (`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;