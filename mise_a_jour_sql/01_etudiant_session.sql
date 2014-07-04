-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 04 Juillet 2014 à 13:56
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
-- Structure de la table `etudiant_sessions`
--

CREATE TABLE IF NOT EXISTS `etudiant_sessions` (
  `login` varchar(255) NOT NULL,
  `id_temporaire` varchar(255) NOT NULL,
  `date_expiration` datetime NOT NULL,
  KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `etudiant_sessions`
--
ALTER TABLE `etudiant_sessions`
  ADD CONSTRAINT `etudiant_sessions_ibfk_1` FOREIGN KEY (`login`) REFERENCES `etudiant` (`login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
