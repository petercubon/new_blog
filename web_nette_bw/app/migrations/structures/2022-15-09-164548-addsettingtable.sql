CREATE TABLE `setting` (
   `name` VARCHAR(255) NOT NULL COLLATE 'utf8_slovak_ci',
   `value` LONGTEXT NOT NULL COLLATE 'utf8_slovak_ci',
   PRIMARY KEY (`name`) USING BTREE
)
    COLLATE='utf8_slovak_ci'
    ENGINE=InnoDB;