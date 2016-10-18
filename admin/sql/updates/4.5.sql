ALTER TABLE `#__itpm_urls` ADD `checked` DATETIME NOT NULL DEFAULT '1000-01-01' AFTER `primary_url`;

ALTER TABLE `#__itpm_urls` ADD INDEX `idx_itpm_uri_checked` (`uri`(191), `checked`);
ALTER TABLE `#__itpm_urls` DROP INDEX `idx_itpm_uri`, ADD INDEX `idx_itpm_uri` (`uri`(191)) USING BTREE;