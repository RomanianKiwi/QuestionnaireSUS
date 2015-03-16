-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 15 Mars 2015 à 16:26
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(256) NOT NULL,
  `PassWord` varchar(20) NOT NULL,
  `Statut` varchar(256) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`ID`, `UserName`, `PassWord`, `Statut`) VALUES
(1, 'Marco', 'test', 'Administrateur'),
(2, 'Jeremy', 'abc', 'Evaluateur');

-- --------------------------------------------------------

--
-- Structure de la table `carnetadresse`
--

CREATE TABLE IF NOT EXISTS `carnetadresse` (
  `IdCarnet` int(11) NOT NULL AUTO_INCREMENT,
  `NomCarnet` varchar(256) NOT NULL,
  `ID` int(11) NOT NULL,
  PRIMARY KEY (`IdCarnet`),
  KEY `FK_CarnetAdresse_ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `carnetadresse`
--

INSERT INTO `carnetadresse` (`IdCarnet`, `NomCarnet`, `ID`) VALUES
(1, 'Sport IRIT', 2);

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE IF NOT EXISTS `participer` (
  `statut_Invitation` tinyint(1) NOT NULL,
  `NumVersion` int(11) NOT NULL,
  `InviteCode` int(11) NOT NULL,
  PRIMARY KEY (`NumVersion`,`InviteCode`),
  KEY `FK_Participer_InviteCode` (`InviteCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questionnaire`
--

CREATE TABLE IF NOT EXISTS `questionnaire` (
  `IdQuest` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(256) DEFAULT NULL,
  `DateCreation` date DEFAULT NULL,
  `ID` int(11) NOT NULL,
  PRIMARY KEY (`IdQuest`),
  KEY `FK_Questionnaire_ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `questionnaire`
--

INSERT INTO `questionnaire` (`IdQuest`, `Nom`, `DateCreation`, `ID`) VALUES
(1, 'Parions Sport', '2015-03-15', 2);

-- --------------------------------------------------------

--
-- Structure de la table `syshash`
--

CREATE TABLE IF NOT EXISTS `syshash` (
  `SysName` varchar(25) NOT NULL,
  `HashCode` varchar(256) DEFAULT NULL,
  `Active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`SysName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `InviteCode` int(11) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `DateNaissance` date DEFAULT NULL,
  `Ville` varchar(25) NOT NULL,
  `IdCarnet` int(11) NOT NULL,
  PRIMARY KEY (`InviteCode`),
  KEY `FK_Utilisateurs_IdCarnet` (`IdCarnet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `versionquestionnaire`
--

CREATE TABLE IF NOT EXISTS `versionquestionnaire` (
  `NumVersion` int(11) NOT NULL,
  `DateExpiration` date DEFAULT NULL,
  `SommeNote` int(11) DEFAULT NULL,
  `NbReponses` int(11) DEFAULT NULL,
  `IdQuest` int(11) NOT NULL,
  PRIMARY KEY (`NumVersion`,`IdQuest`),
  KEY `FK_VersionQuestionnaire_IdQuest` (`IdQuest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `versionquestionnaire`
--

INSERT INTO `versionquestionnaire` (`NumVersion`, `DateExpiration`, `SommeNote`, `NbReponses`, `IdQuest`) VALUES
(1, '2015-03-18', 0, 0, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `carnetadresse`
--
ALTER TABLE `carnetadresse`
  ADD CONSTRAINT `FK_CarnetAdresse_ID` FOREIGN KEY (`ID`) REFERENCES `administrateur` (`ID`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `FK_Participer_InviteCode` FOREIGN KEY (`InviteCode`) REFERENCES `utilisateurs` (`InviteCode`),
  ADD CONSTRAINT `FK_Participer_NumVersion` FOREIGN KEY (`NumVersion`) REFERENCES `versionquestionnaire` (`NumVersion`);

--
-- Contraintes pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `FK_Questionnaire_ID` FOREIGN KEY (`ID`) REFERENCES `administrateur` (`ID`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `FK_Utilisateurs_IdCarnet` FOREIGN KEY (`IdCarnet`) REFERENCES `carnetadresse` (`IdCarnet`);

--
-- Contraintes pour la table `versionquestionnaire`
--
ALTER TABLE `versionquestionnaire`
  ADD CONSTRAINT `FK_VersionQuestionnaire_IdQuest` FOREIGN KEY (`IdQuest`) REFERENCES `questionnaire` (`IdQuest`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
