CREATE TABLE `post` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    `content` TEXT NOT NULL COLLATE 'utf8_slovak_ci',
    `status` INT(1) NOT NULL DEFAULT '0',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `author_id` INT(11) NOT NULL DEFAULT '2',
    PRIMARY KEY (`id`) USING BTREE,
    INDEX `FK_post_user` (`author_id`) USING BTREE,
    CONSTRAINT `FK_post_user` FOREIGN KEY (`author_id`) REFERENCES `bw`.`user` (`id`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
    COLLATE='utf8_slovak_ci'
ENGINE=InnoDB
AUTO_INCREMENT=368;