CREATE TABLE `comment` (
   `id` INT(11) NOT NULL AUTO_INCREMENT,
   `post_id` INT(11) UNSIGNED NOT NULL,
   `name` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
   `email` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
   `content` TEXT NOT NULL COLLATE 'utf8_slovak_ci',
   `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `author_id` INT(11) NULL DEFAULT '2',
   PRIMARY KEY (`id`) USING BTREE,
   INDEX `post_id` (`post_id`) USING BTREE,
   INDEX `FK_comment_user` (`author_id`) USING BTREE,
   CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `bw`.`post` (`id`) ON UPDATE RESTRICT ON DELETE CASCADE,
   CONSTRAINT `FK_comment_user` FOREIGN KEY (`author_id`) REFERENCES `bw`.`user` (`id`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
    COLLATE='utf8_slovak_ci'
    ENGINE=InnoDB
    AUTO_INCREMENT=153;
