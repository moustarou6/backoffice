-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 18 Avril 2013 à 11:14
-- Version du serveur: 5.5.25a-log
-- Version de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `engine`
--
CREATE DATABASE `engine` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `engine`;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `spaceship`
--

INSERT INTO `spaceship` (`id`, `name`, `path`, `price`, `module_limit`, `construct_time`, `power`) VALUES
(1, 'default', 'default.fbx', 1500, 2, 24, 20);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `user_spaceship`
--

INSERT INTO `user_spaceship` (`id`, `spaceship_id`, `user_id`, `life`, `position_X`, `position_Y`, `position_Z`) VALUES
(1, 1, 5, 7, 10, 10, 10);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `password`, `login`, `email`, `credit`) VALUES
(2, '7043f02648377ce9268ae6d5fda3535c', 'mika', 'mickael.hamour@gmail.com', 300),
(5, 'e471a891c22fb1b5b722f57bed71de32', 'mikda', 'mickael.hamour@gmail.com', 300);

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
