-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 07 Juin 2014 à 23:45
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
CREATE DATABASE IF NOT EXISTS `plancutc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `plancutc`;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE IF NOT EXISTS `etudiant` (
  `login` varchar(8) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `is_adult` tinyint(1) DEFAULT '0',
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`login`, `nom`, `prenom`, `is_admin`, `is_adult`, `email`) VALUES
('brascore', 'Bras', 'Corentin', 1, 0, NULL),
('gdietsch', 'Dietsch', 'Geoffroy', 0, 0, NULL),
('herbinir', 'Herbin', 'Iris', 0, 0, NULL),
('pleymari', 'Leymarie', 'Pierre-Gilles', 1, 0, NULL),
('veroclar', 'Veron', 'Clarisse', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `legende` text,
  `dateUpload` date NOT NULL,
  `loginEtudiant` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_ibfk_1` (`loginEtudiant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `source`, `visible`, `legende`, `dateUpload`, `loginEtudiant`) VALUES
(1, 'http://lfskdlfmsdkmf.fr', 1, 'sdfdsfsdf', '2014-06-04', 'pleymari'),
(2, 'profile01', 1, NULL, '2014-06-08', 'pleymari'),
(3, 'profile02', 1, NULL, '2014-06-08', 'veroclar'),
(4, 'profile03', 1, NULL, '2014-06-08', 'brascore'),
(5, 'profile04', 1, NULL, '2014-06-08', 'gdietsch'),
(6, 'profile05', 1, NULL, '2014-06-08', 'herbinir');

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
  `avatar` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Structure de la table `permissions_tel`
--

CREATE TABLE IF NOT EXISTS `permissions_tel` (
  `idPermission` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `loginEtudiant` varchar(8) NOT NULL,
  `loginFriend` varchar(8) NOT NULL,
  PRIMARY KEY (`idPermission`),
  KEY `permissions_tel_ibfk_1` (`loginEtudiant`),
  KEY `permissions_tel_ibfk_2` (`loginFriend`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `permissions_tel`
--

INSERT INTO `permissions_tel` (`idPermission`, `date`, `loginEtudiant`, `loginFriend`) VALUES
(1, '2014-06-08', 'gdietsch', 'herbinir'),
(2, '2014-06-08', 'gdietsch', 'brascore');

-- --------------------------------------------------------

--
-- Structure de la table `quartier`
--

CREATE TABLE IF NOT EXISTS `quartier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `quartier`
--

INSERT INTO `quartier` (`id`, `nom`) VALUES
(1, 'Bellicart'),
(2, 'Les Capucins - Saint Germain'),
(3, 'Centre Ville'),
(4, 'Le Clos des Roses'),
(5, 'Les Jardins'),
(6, 'Le Petit Margny'),
(7, 'Royalieu - Pompidou'),
(8, 'La Victoire - Les Maréchaux'),
(9, 'Saint Lazare - Les Avenues'),
(10, 'Margny');

-- --------------------------------------------------------

--
-- Structure de la table `superwink`
--

CREATE TABLE IF NOT EXISTS `superwink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `loginExpediteur` varchar(8) NOT NULL,
  `loginDestinataire` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loginExpediteur` (`loginExpediteur`),
  KEY `superwink_ibfk_2` (`loginDestinataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `superwink`
--

INSERT INTO `superwink` (`id`, `date`, `loginExpediteur`, `loginDestinataire`) VALUES
(1, '2014-06-08', 'brascore', 'veroclar'),
(2, '2014-06-08', 'gdietsch', 'veroclar');

-- --------------------------------------------------------

--
-- Structure de la table `uv`
--

CREATE TABLE IF NOT EXISTS `uv` (
  `codeUV` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`codeUV`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `uv`
--

INSERT INTO `uv` (`codeUV`) VALUES
('BL01'),
('CM11'),
('IA01'),
('LO21'),
('MI01'),
('MT90');

-- --------------------------------------------------------

--
-- Structure de la table `uv_etudiant`
--

CREATE TABLE IF NOT EXISTS `uv_etudiant` (
  `codeUV` varchar(255) NOT NULL DEFAULT '',
  `loginEtudiant` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`codeUV`,`loginEtudiant`),
  KEY `uv_etudiant_ibfk_2` (`loginEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `uv_etudiant`
--

INSERT INTO `uv_etudiant` (`codeUV`, `loginEtudiant`) VALUES
('IA01', 'brascore'),
('LO21', 'brascore'),
('MI01', 'brascore'),
('BL01', 'veroclar'),
('CM11', 'veroclar');

-- --------------------------------------------------------

--
-- Structure de la table `wink`
--

CREATE TABLE IF NOT EXISTS `wink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `loginExpediteur` varchar(8) NOT NULL,
  `loginDestinataire` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `wink_ibfk_1` (`loginExpediteur`),
  KEY `wink_ibfk_2` (`loginDestinataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `wink`
--

INSERT INTO `wink` (`id`, `date`, `loginExpediteur`, `loginDestinataire`) VALUES
(1, '2014-06-08', 'brascore', 'veroclar'),
(2, '2014-06-08', 'gdietsch', 'veroclar'),
(3, '2014-06-08', 'herbinir', 'pleymari'),
(4, '2014-06-08', 'herbinir', 'gdietsch'),
(5, '2014-06-08', 'herbinir', 'brascore');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `infos_profil`
--
ALTER TABLE `infos_profil`
  ADD CONSTRAINT `infos_profil_ibfk_2` FOREIGN KEY (`avatar`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `infos_profil_ibfk_1` FOREIGN KEY (`adresse`) REFERENCES `quartier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `infos_profil_ibfk_3` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `permissions_tel`
--
ALTER TABLE `permissions_tel`
  ADD CONSTRAINT `permissions_tel_ibfk_2` FOREIGN KEY (`loginFriend`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permissions_tel_ibfk_1` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `superwink`
--
ALTER TABLE `superwink`
  ADD CONSTRAINT `superwink_ibfk_2` FOREIGN KEY (`loginDestinataire`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `superwink_ibfk_1` FOREIGN KEY (`loginExpediteur`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `uv_etudiant`
--
ALTER TABLE `uv_etudiant`
  ADD CONSTRAINT `uv_etudiant_ibfk_2` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uv_etudiant_ibfk_1` FOREIGN KEY (`codeUV`) REFERENCES `uv` (`codeUV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `wink`
--
ALTER TABLE `wink`
  ADD CONSTRAINT `wink_ibfk_2` FOREIGN KEY (`loginDestinataire`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wink_ibfk_1` FOREIGN KEY (`loginExpediteur`) REFERENCES `etudiant` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
