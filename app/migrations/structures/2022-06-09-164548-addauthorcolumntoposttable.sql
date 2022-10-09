ALTER TABLE `post`
    ADD CONSTRAINT `FK_post_user` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);