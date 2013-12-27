-- phpMyAdmin SQL Dump
-- version 4.0.3
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Jeu 26 Décembre 2013 à 14:00
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `instantmessaging`
--
CREATE DATABASE IF NOT EXISTS `instantmessaging` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `instantmessaging`;

-- --------------------------------------------------------

--
-- Structure de la table `connectes`
--

CREATE TABLE IF NOT EXISTS `connectes` (
  `idUtilisateur` int(11) NOT NULL,
  `derniereInteraction` datetime NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `connectes`
--

INSERT INTO `connectes` (`idUtilisateur`, `derniereInteraction`) VALUES
(2, '2013-12-26 13:35:12'),
(3, '2013-12-26 13:35:04');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur1` int(11) NOT NULL,
  `idUtilisateur2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `conversations`
--

INSERT INTO `conversations` (`id`, `idUtilisateur1`, `idUtilisateur2`) VALUES
(1, 2, 3),
(2, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idConversation` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `dateMessage` datetime NOT NULL,
  `contenu` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL DEFAULT 'avatar-defaut.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `mdp`, `photo`) VALUES
(2, 'alexandre', 'ab4f63f9ac65152575886860dde480a1', '322d9f2913164b20e47d63ea776eb21e.jpg'),
(3, 'awavelet', 'ab4f63f9ac65152575886860dde480a1', 'avatar-defaut.jpg'),
(4, 'awav', 'ab4f63f9ac65152575886860dde480a1', 'avatar-defaut.jpg'),
(5, 'alex', 'ab4f63f9ac65152575886860dde480a1', 'avatar-defaut.jpg');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `connectes`
--
ALTER TABLE `connectes`
  ADD CONSTRAINT `connectes_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateurs` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
