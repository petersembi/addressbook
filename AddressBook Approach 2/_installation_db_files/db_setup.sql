
CREATE DATABASE IF NOT EXISTS `addressbook` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `addressbook`;

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `street` varchar(40) NOT NULL,
  `zipcode` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cities` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

