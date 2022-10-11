CREATE TABLE `user` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    `surname` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    `email` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    `password` VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    `verificationtoken` VARCHAR(100) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    `status` INT(1) NOT NULL DEFAULT '0',
    `last_login_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `register_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`) USING BTREE
)
    COLLATE='utf8mb4_slovak_ci'
    ENGINE=InnoDB
    AUTO_INCREMENT=36;

