SET FOREIGN_KEY_CHECKS=0;

ALTER TABLE `#__itpm_tags` DROP FOREIGN KEY `FK_tags_urls` ;

DROP TABLE IF EXISTS `tmp_#__itpm_global_tags`;
RENAME TABLE `#__itpm_global_tags` TO `tmp_#__itpm_global_tags`;

DROP TABLE IF EXISTS `tmp_#__itpm_tags`;
RENAME TABLE `#__itpm_tags` TO `tmp_#__itpm_tags`;

DROP TABLE IF EXISTS `tmp_#__itpm_urls`;
RENAME TABLE `#__itpm_urls` TO `tmp_#__itpm_urls`;

SET FOREIGN_KEY_CHECKS=1;
