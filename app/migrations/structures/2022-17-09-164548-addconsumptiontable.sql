CREATE TABLE `consumption` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `startvalue` INT(11) NULL DEFAULT '0',
    `starttime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `endValue` INT(11) NOT NULL DEFAULT '0',
    `endtime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `hourlyconsumption` INT(11) NULL DEFAULT '0',
    `dailyconsumption` INT(11) NULL DEFAULT '0',
    `yearlyconsumption` INT(11) NULL DEFAULT '0',
    `device_id` INT(11) NULL DEFAULT '0',
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`) USING BTREE,
    INDEX `FK__device` (`device_id`) USING BTREE,
CONSTRAINT `FK__device` FOREIGN KEY (`device_id`) REFERENCES `bw`.`device` (`id`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
    COLLATE='utf8_slovak_ci'
    ENGINE=InnoDB
;
