DROP DATABASE IF EXISTS `vechtstreekfruit`;

CREATE DATABASE `vechtstreekfruit` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `vechtstreekfruit`;

CREATE TABLE IF NOT EXISTS `boom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rasnaam` varchar(200) NOT NULL,
  `soort` varchar(200) NOT NULL,
  `aantal` int NOT NULL,
  `tijdvak` varchar(200) NOT NULL,
  `tijdcheck` int NOT NULL,
  `latitude` DOUBLE DEFAULT 0,
  `longitude` DOUBLE DEFAULT 0,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

CREATE TABLE `gebruikers_accounts` (
  `id` int(11) NOT NULL,
  `vollenaam` varchar(48) NOT NULL,
  `password` varchar(55) NOT NULL,
  `email` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gebruikers_accounts` (`id`, `vollenaam`, `password`, `email`) VALUES
(1, '', 'bit_academy', 'bit_academy@gmail.com'),
(2, 'BABABOEEY', 'ben123', 'Noorieboorieman123@jemoer.ben'),
(3, 'de', 'ben1256', 'ben@ben.ben'),
(4, 'kain', 'kain123', 'kain123@gmail.com'),
(5, 'nooman', 'nooman', 'nooman178@gmail.com'),
(6, 'test', 'test123', 'test@gmail.com'),
(7, 'Test gebruiker', 'Wachtwoord', 'test@gmail.com');


CREATE TABLE `user_help` (
  `id` int(11) NOT NULL,
  `emails` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `gebruikers_accounts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user_help`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `gebruikers_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `user_help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;