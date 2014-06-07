-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 07 Juin 2014 à 21:52
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
CREATE DATABASE `plancutc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `plancutc`;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`login`, `nom`, `prenom`, `age`, `sexe`) VALUES
('pleymari', 'Leymarie', 'Pierre-Gilles', 19, 'h');

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `source`, `visible`, `legende`, `dateUpload`, `loginEtudiant`) VALUES
(1, 'http://lfskdlfmsdkmf.fr', 1, 'sdfdsfsdf', '2014-06-04', 'pleymari');

--
-- Contenu de la table `infos_profil`
--

INSERT INTO `infos_profil` (`loginEtudiant`, `avatar`, `tel`, `email`, `adresse`, `orientation`) VALUES
('pleymari', 1, 667047496, 'dsffd', 'sdfsfdsf', 'f');

--
-- Contenu de la table `quartier`
--

INSERT INTO `quartier` (`id`, `nom`) VALUES
(1, 'sdfsdfdsf');

--
-- Contenu de la table `uv`
--

INSERT INTO `uv` (`codeUV`) VALUES
(''),
('LO21');

--
-- Contenu de la table `uv_etudiant`
--

INSERT INTO `uv_etudiant` (`codeUV`, `loginEtudiant`) VALUES
('LO21', 'pleymari');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
