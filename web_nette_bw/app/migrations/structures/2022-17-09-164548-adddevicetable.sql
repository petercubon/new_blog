CREATE TABLE `device` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    `room` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    `image` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `author_id` INT(11) NULL DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE,
    INDEX `author_id` (`author_id`) USING BTREE,
    CONSTRAINT `FK_device_user` FOREIGN KEY (`author_id`) REFERENCES `bw`.`user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
    COLLATE='utf8_slovak_ci'
    ENGINE=InnoDB
    AUTO_INCREMENT=160;