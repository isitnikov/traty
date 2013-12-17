ALTER TABLE  `operation` ADD  `user_id` INT( 10 ) UNSIGNED NOT NULL ,
ADD INDEX (  `user_id` );
UPDATE  `operation` SET  `user_id` =2;
ALTER TABLE  `operation` ADD FOREIGN KEY (  `user_id` ) REFERENCES  `users` (
  `id`
) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE  `operation` DROP INDEX  `user_id` ,
ADD INDEX  `user` (  `user_id` );
ALTER TABLE  `operation` DROP FOREIGN KEY  `operation_ibfk_1`;
ALTER TABLE  `operation` CHANGE  `user_id`  `user` INT( 10 ) UNSIGNED NOT NULL;
ALTER TABLE  `operation` ADD FOREIGN KEY (  `user` ) REFERENCES  `users` (
  `id`
) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE  `users` ADD  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;