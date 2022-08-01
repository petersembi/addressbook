
CREATE DATABASE IF NOT EXISTS `addressbook` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `addressbook`;

INSERT INTO `addresses` (`id`, `name`, `first_name`, `email`, `street`, `zipcode`, `city`) VALUES
(1, 'Okalo', 'James', 'okalo@gmail.com', 'Burgen', '040-57849', 'JohannesBurg'),
(2, 'Agillo', 'Bernice', 'bern@gmail.com', 'Broadway', '050-768560', 'Mombasa'),
(3, 'Parkash', 'Ouma', 'par@gmail.com', 'Bourburn', '050-77438', 'Nairobi'),
(4, 'Adeo', 'Felix', 'adfe@gmail.com', 'Addan', '090-76470', 'JohannesBurg'),
(5, 'Wendi', 'Jackson', 'wejack@gmail.com', 'Abai', '060-76461', 'Nairobi');

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Mombasa'),
(2, 'Nairobi'),
(3, 'Zurich'),
(4, 'Johannesburg');
