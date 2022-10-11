# vytvorenie roli
INSERT INTO `role` (`name`) VALUES ('guest');
INSERT INTO `role` (`name`) VALUES ('user');
INSERT INTO `role` (`name`) VALUES ('moderator');
INSERT INTO `role` (`name`) VALUES ('admin');

# priradenie roli pre vybranych pouzivatelov
INSERT INTO `user_x_role` (`user_id`, `role_id`) VALUES (2, 4);
INSERT INTO `user_x_role` (`user_id`, `role_id`) VALUES (1, 1);
