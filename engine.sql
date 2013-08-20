-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 20 Août 2013 à 20:18
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `engine`
--

-- --------------------------------------------------------

--
-- Structure de la table `portal`
--

CREATE TABLE IF NOT EXISTS `portal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `z` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `portal`
--

INSERT INTO `portal` (`id`, `x`, `y`, `z`, `code`) VALUES
(1, 42, 798, 4, 'AZER'),
(2, 897, 435, 798, 'POI');

-- --------------------------------------------------------

--
-- Structure de la table `spaceship`
--

CREATE TABLE IF NOT EXISTS `spaceship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `path` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `module_limit` int(11) NOT NULL,
  `construct_time` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `spaceship`
--

INSERT INTO `spaceship` (`id`, `name`, `path`, `price`, `module_limit`, `construct_time`, `power`) VALUES
(3, 'mod-bomber', 'mod-bomber.prefab', 5000, 5, 360, 500),
(4, 'mod-command', 'mod-command.prefab', 4000, 4, 350, 500),
(5, 'mod-fighter', 'mod-fighter.prefab', 3000, 3, 340, 500),
(6, 'mod-gas_harvester', 'mod-gas_harvester.prefab', 2000, 2, 330, 500);

-- --------------------------------------------------------

--
-- Structure de la table `spaceship_module`
--

CREATE TABLE IF NOT EXISTS `spaceship_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `path` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `contruct_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `tag` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `login` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `credit` int(11) NOT NULL,
  `iridium` int(11) NOT NULL,
  `deuterium` int(11) NOT NULL,
  `belium` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `password`, `login`, `email`, `credit`, `iridium`, `deuterium`, `belium`, `score`) VALUES
(2, 'e471a891c22fb1b5b722f57bed71de32', 'mika', 'mickael.hamour@gmail.com', 300, 40, 50, 60, 10),
(5, 'e471a891c22fb1b5b722f57bed71de32', 'mikda', 'mickael.hamour@gmail.com', 87000, 10, 20, 30, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_spaceship`
--

CREATE TABLE IF NOT EXISTS `user_spaceship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spaceship_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `life` int(11) NOT NULL,
  `position_X` int(11) NOT NULL,
  `position_Y` int(11) NOT NULL,
  `position_Z` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `spaceship_id` (`spaceship_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user_spaceship`
--

INSERT INTO `user_spaceship` (`id`, `spaceship_id`, `user_id`, `life`, `position_X`, `position_Y`, `position_Z`) VALUES
(1, 3, 5, 2000, 10, 10, 10),
(2, 6, 2, 1000, 10, 10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `user_spaceship_module`
--

CREATE TABLE IF NOT EXISTS `user_spaceship_module` (
  `user_spaceship` int(11) NOT NULL,
  `spaceship_module_id` int(11) NOT NULL,
  KEY `user_id` (`user_spaceship`),
  KEY `spaceship_module_id` (`spaceship_module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `spaceship_module`
--
ALTER TABLE `spaceship_module`
  ADD CONSTRAINT `spaceship_module_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `user_spaceship`
--
ALTER TABLE `user_spaceship`
  ADD CONSTRAINT `user_spaceship_ibfk_1` FOREIGN KEY (`spaceship_id`) REFERENCES `spaceship` (`id`),
  ADD CONSTRAINT `user_spaceship_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `user_spaceship_module`
--
ALTER TABLE `user_spaceship_module`
  ADD CONSTRAINT `user_spaceship_module_ibfk_2` FOREIGN KEY (`spaceship_module_id`) REFERENCES `spaceship_module` (`id`),
  ADD CONSTRAINT `user_spaceship_module_ibfk_3` FOREIGN KEY (`user_spaceship`) REFERENCES `user_spaceship` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
