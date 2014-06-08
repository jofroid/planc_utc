-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 08 Juin 2014 à 09:17
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
('agdjfueh', 'Gdljfkj', 'Jeanne', 0, 0, NULL),
('brascore', 'Bras', 'Mathilde', 1, 0, NULL),
('gdietsch', 'Dietsch', 'Caroline', 0, 0, NULL),
('herbinir', 'Herbin', 'Iris', 0, 0, NULL),
('pleymari', 'Leymarie', 'Pierre-Gilles', 1, 0, NULL),
('qzsderfd', 'Gertrj', 'Camille', 0, 0, NULL),
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
  KEY `loginEtudiant` (`loginEtudiant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `source`, `visible`, `legende`, `dateUpload`, `loginEtudiant`) VALUES
(1, 'ema12', 1, 'sdfdsfsdf', '2014-06-04', 'pleymari'),
(2, 'vache1', 1, NULL, '2014-06-08', 'pleymari'),
(3, 'scarlet1', 1, NULL, '2014-06-08', 'veroclar'),
(4, 'panda1', 1, NULL, '2014-06-08', 'brascore'),
(5, 'kate1', 1, NULL, '2014-06-08', 'gdietsch'),
(6, 'ema13', 1, NULL, '2014-06-08', 'herbinir'),
(7, 'ema12', 1, NULL, '2014-06-08', 'herbinir'),
(8, 'bob1', 1, NULL, '2014-06-08', 'herbinir');

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
  KEY `adresse` (`adresse`),
  KEY `avatar` (`avatar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `infos_profil`
--

INSERT INTO `infos_profil` (`loginEtudiant`, `tel`, `adresse`, `orientation`, `semestre`, `avatar`, `age`, `sexe`) VALUES
('agdjfueh', 645345645, 10, 'B', 'TC03', 4, 23, 'F'),
('brascore', 645345645, 10, 'H', 'TC03', 1, 21, 'F'),
('gdietsch', 645345645, 10, 'H', 'TC03', 2, 21, 'F'),
('herbinir', 645345645, 10, 'H', 'TC03', 6, 21, 'F'),
('pleymari', 645345645, 10, 'B', 'TC03', 3, 18, 'H'),
('qzsderfd', 645345645, 10, 'B', 'TC03', 5, 17, 'F'),
('veroclar', 645345645, 10, 'B', 'TC03', 8, 17, 'F');

-- --------------------------------------------------------

--
-- Structure de la table `permissions_adr`
--

CREATE TABLE IF NOT EXISTS `permissions_adr` (
  `idPermission` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `loginEtudiant` varchar(8) NOT NULL,
  `loginFriend` varchar(8) NOT NULL,
  PRIMARY KEY (`idPermission`),
  KEY `loginEtudiant` (`loginEtudiant`),
  KEY `loginFriend` (`loginFriend`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  KEY `loginEtudiant` (`loginEtudiant`),
  KEY `loginFriend` (`loginFriend`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  KEY `loginDestinataire` (`loginDestinataire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
('LO21');

-- --------------------------------------------------------

--
-- Structure de la table `uv_etudiant`
--

CREATE TABLE IF NOT EXISTS `uv_etudiant` (
  `codeUV` varchar(255) NOT NULL DEFAULT '',
  `loginEtudiant` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`codeUV`,`loginEtudiant`),
  KEY `loginEtudiant` (`loginEtudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  KEY `loginExpediteur` (`loginExpediteur`),
  KEY `loginDestinataire` (`loginDestinataire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Contenu de la table `wink`
--

INSERT INTO `wink` (`id`, `date`, `loginExpediteur`, `loginDestinataire`) VALUES
(22, '0000-00-00', 'gdietsch', 'pleymari'),
(37, '2014-06-08', 'pleymari', 'herbinir'),
(43, '2014-06-08', 'pleymari', 'veroclar'),
(48, '2014-06-08', 'pleymari', 'gdietsch'),
(49, '2014-06-08', 'pleymari', 'qzsderfd');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`);

--
-- Contraintes pour la table `infos_profil`
--
ALTER TABLE `infos_profil`
  ADD CONSTRAINT `infos_profil_ibfk_1` FOREIGN KEY (`adresse`) REFERENCES `quartier` (`id`),
  ADD CONSTRAINT `infos_profil_ibfk_2` FOREIGN KEY (`avatar`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `infos_profil_ibfk_3` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`);

--
-- Contraintes pour la table `permissions_adr`
--
ALTER TABLE `permissions_adr`
  ADD CONSTRAINT `permissions_adr_ibfk_1` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`),
  ADD CONSTRAINT `permissions_adr_ibfk_2` FOREIGN KEY (`loginFriend`) REFERENCES `etudiant` (`login`);

--
-- Contraintes pour la table `permissions_tel`
--
ALTER TABLE `permissions_tel`
  ADD CONSTRAINT `permissions_tel_ibfk_1` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`),
  ADD CONSTRAINT `permissions_tel_ibfk_2` FOREIGN KEY (`loginFriend`) REFERENCES `etudiant` (`login`);

--
-- Contraintes pour la table `superwink`
--
ALTER TABLE `superwink`
  ADD CONSTRAINT `superwink_ibfk_1` FOREIGN KEY (`loginExpediteur`) REFERENCES `etudiant` (`login`),
  ADD CONSTRAINT `superwink_ibfk_2` FOREIGN KEY (`loginDestinataire`) REFERENCES `etudiant` (`login`);

--
-- Contraintes pour la table `uv_etudiant`
--
ALTER TABLE `uv_etudiant`
  ADD CONSTRAINT `uv_etudiant_ibfk_1` FOREIGN KEY (`codeUV`) REFERENCES `uv` (`codeUV`),
  ADD CONSTRAINT `uv_etudiant_ibfk_2` FOREIGN KEY (`loginEtudiant`) REFERENCES `etudiant` (`login`);

--
-- Contraintes pour la table `wink`
--
ALTER TABLE `wink`
  ADD CONSTRAINT `wink_ibfk_1` FOREIGN KEY (`loginExpediteur`) REFERENCES `etudiant` (`login`),
  ADD CONSTRAINT `wink_ibfk_2` FOREIGN KEY (`loginDestinataire`) REFERENCES `etudiant` (`login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
