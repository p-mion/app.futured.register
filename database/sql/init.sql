CREATE DATABASE IF NOT EXISTS `futured_register`
    DEFAULT CHARACTER SET = `utf8mb4`;

USE `futured_register`;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `registers`;
SET FOREIGN_KEY_CHECKS = 1;
CREATE TABLE `registers`
(
    `id`    int(11) unsigned NOT NULL AUTO_INCREMENT,
    `token` varchar(128) DEFAULT NULL,
    `label` varchar(200) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `token` (`token`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `bills`;
SET FOREIGN_KEY_CHECKS = 1;
CREATE TABLE `bills`
(
    `id`          int(11) unsigned NOT NULL AUTO_INCREMENT,
    `register_id` int(11) unsigned NOT NULL,
    `price`       decimal(10, 2)   NOT NULL DEFAULT '0.00',
    `amount`      int(11)          NOT NULL DEFAULT '1',
    `created_at`  datetime         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

ALTER TABLE `bills`
    ADD CONSTRAINT `bill_register_bind` FOREIGN KEY (`register_id`)
        REFERENCES `registers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

INSERT INTO `registers`
SET `token` = '9de4a97425678c5b1288aa70c1669a64',
    `label` = 'Futured Register';
