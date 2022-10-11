-- create table with ROLES
CREATE TABLE `role` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL DEFAULT '0' COLLATE 'utf8_slovak_ci',
    PRIMARY KEY (`id`) USING BTREE
)
    COLLATE='utf8_slovak_ci'
ENGINE=InnoDB
AUTO_INCREMENT=5;


-- create table USER_X_ROLE
CREATE TABLE `user_x_role` (
   `id` INT(11) NOT NULL AUTO_INCREMENT,
   `user_id` INT(11) NOT NULL DEFAULT '0',
   `role_id` INT(11) NOT NULL DEFAULT '0',
   PRIMARY KEY (`id`) USING BTREE,
   INDEX `FK__user` (`user_id`) USING BTREE,
   INDEX `FK__role` (`role_id`) USING BTREE,
   CONSTRAINT `FK__role` FOREIGN KEY (`role_id`) REFERENCES `bw`.`role` (`id`) ON UPDATE RESTRICT ON DELETE RESTRICT,
   CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `bw`.`user` (`id`) ON UPDATE RESTRICT ON DELETE RESTRICT
)
    COMMENT='spojovacia tabulka nemusi mat ID,\r\n\r\n(ID je odporucane uvadzat)'
COLLATE='utf8_slovak_ci'
ENGINE=InnoDB
AUTO_INCREMENT=8;

