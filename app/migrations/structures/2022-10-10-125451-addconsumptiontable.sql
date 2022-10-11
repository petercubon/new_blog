CREATE TABLE `consumption` (
   `id` INT(11) NOT NULL AUTO_INCREMENT,
   `startvalue` INT(11) NULL DEFAULT '0',
   `starttime` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_slovak_ci',
   `endvalue` INT(11) NOT NULL DEFAULT '0',
   `endtime` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_slovak_ci',
   `hourlyconsumption` INT(11) NULL DEFAULT '0',
   `dailyconsumption` INT(11) NULL DEFAULT '0',
   `yearlyconsumption` BIGINT(255) NULL DEFAULT NULL,
   `device_id` INT(11) NULL DEFAULT '0',
   `author_id` INT(11) NULL DEFAULT '33',
   `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`) USING BTREE,
   INDEX `FK__device` (`device_id`) USING BTREE,
   INDEX `FK_consumption_user` (`author_id`) USING BTREE,
   CONSTRAINT `FK__device` FOREIGN KEY (`device_id`) REFERENCES `bw`.`device` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
   CONSTRAINT `FK_consumption_user` FOREIGN KEY (`author_id`) REFERENCES `bw`.`user` (`id`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
    COLLATE='utf8_slovak_ci'
    ENGINE=InnoDB
    AUTO_INCREMENT=5;
