-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 07 Juin 2014 à 23:56
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
  `tel` int(10) DEFAULT NULL,
  `adresse` int(11) NOT NULL,
  `orientation` char(1) NOT NULL,
  `semestre` char(4) NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `age` int(2) NOT NULL,
  `sexe` char(1) NOT NULL,
  PRIMARY KEY (`loginEtudiant`),
  UNIQUE KEY `loginEtudiant` (`loginEtudiant`),
  KEY `avatar` (`avatar`),
  KEY `infos_profil_ibfk_1` (`adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `infos_profil`
--

INSERT INTO `infos_profil` (`loginEtudiant`, `tel`, `adresse`, `orientation`, `semestre`, `avatar`, `age`, `sexe`) VALUES
('brascore', 659010101, 1, 'F', 'GI02', 1, 21, 'H'),
('gdietsch', 659010638, 2, 'F', 'GI02', 2, 21, 'H'),
('herbinir', 659456255, 3, 'H', 'GI02', 6, 21, 'H'),
('veroclar', 659235865, 4, 'B', 'TC04', 4, 17, 'H');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `infos_profil`
--
ALTER TABLE `infos_profil`
  ADD CONSTRAINT `infos_profil_ibfk_1` FOREIGN KEY (`adresse`) REFERENCES `quartier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `infos_profil_ibfk_2` FOREIGN KEY (`avatar`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `infos_profil_ibfk_3` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
