CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `user_password` int(11) NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_role`) VALUES (1, 'hestia', 123456, 1)