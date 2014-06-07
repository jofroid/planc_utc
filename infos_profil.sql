-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 07 Juin 2014 à 18:55
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `plancutc`
--

-- --------------------------------------------------------

--
-- Structure de la table `infos_profil`
--

CREATE TABLE IF NOT EXISTS `infos_profil` (
  `loginEtudiant` varchar(255) NOT NULL DEFAULT '',
  `avatar` int(11) NOT NULL,
  `tel` int(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`loginEtudiant`),
  KEY `avatar` (`avatar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `infos_profil`
--
ALTER TABLE `infos_profil`
  ADD CONSTRAINT `infos_profil_ibfk_1` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`),
  ADD CONSTRAINT `infos_profil_ibfk_2` FOREIGN KEY (`avatar`) REFERENCES `image` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
