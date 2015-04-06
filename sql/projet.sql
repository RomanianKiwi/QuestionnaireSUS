-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Avril 2015 à 11:02
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`ID`, `UserName`, `PassWord`, `Statut`) VALUES
(1, 'Admin1', 'test', 'Administrateur'),
(2, 'Eval1', 'test', 'Evaluateur'),
(3, 'Eval2', 'test', 'Evaluateur');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `carnetadresse`
--

INSERT INTO `carnetadresse` (`IdCarnet`, `NomCarnet`, `ID`) VALUES
(1, 'Reseaux Sociaux', 2),
(2, 'Carnet Temporaire', 2);

-- --------------------------------------------------------

--
-- Structure de la table `gerer`
--

CREATE TABLE IF NOT EXISTS `gerer` (
  `IdCarnet` int(11) NOT NULL,
  `InviteCode` varchar(255) NOT NULL,
  PRIMARY KEY (`IdCarnet`,`InviteCode`),
  KEY `FK_Gerer_InviteCode` (`InviteCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `gerer`
--

INSERT INTO `gerer` (`IdCarnet`, `InviteCode`) VALUES
(1, '63367819150588506824860404288842822646'),
(1, '89854776697302320204482004426400426268'),
(2, '89854776697302320204482004426400426268');

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE IF NOT EXISTS `participer` (
  `statut_Invitation` tinyint(1) NOT NULL,
  `NumVersion` int(11) NOT NULL,
  `InviteCode` varchar(255) NOT NULL,
  `IdQuest` int(11) NOT NULL,
  `Reponses` varchar(250) DEFAULT NULL,
  `Score` float DEFAULT NULL,
  PRIMARY KEY (`NumVersion`,`InviteCode`,`IdQuest`),
  KEY `FK_Participer_IdQuest` (`IdQuest`),
  KEY `FK_Participer_InviteCode` (`InviteCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `participer`
--

INSERT INTO `participer` (`statut_Invitation`, `NumVersion`, `InviteCode`, `IdQuest`, `Reponses`, `Score`) VALUES
(0, 7, '63367819150588506824860404288842822646', 2, NULL, NULL),
(0, 7, '89854776697302320204482004426400426268', 2, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `questionnaire`
--

INSERT INTO `questionnaire` (`IdQuest`, `Nom`, `DateCreation`, `ID`) VALUES
(1, 'Twitter', '2015-04-01', 2),
(2, 'Facebook', '2015-04-01', 2);

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

--
-- Contenu de la table `syshash`
--

INSERT INTO `syshash` (`SysName`, `HashCode`, `Active`) VALUES
('Facebook', '287555991562433206886428640488088806246', 0),
('Twitter', '48608916384192418606822400648886420408', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `InviteCode` varchar(255) NOT NULL,
  `Email` varchar(25) NOT NULL,
  PRIMARY KEY (`InviteCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`InviteCode`, `Email`) VALUES
('119563580860034384888882442862428042848', 'flavien@gmail.com'),
('63367819150588506824860404288842822646', 'equipetix@gmail.com'),
('89854776697302320204482004426400426268', 'bocchi31@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `versionquestionnaire`
--

CREATE TABLE IF NOT EXISTS `versionquestionnaire` (
  `NumVersion` int(11) NOT NULL,
  `DateExpiration` date DEFAULT NULL,
  `IdQuest` int(11) NOT NULL,
  PRIMARY KEY (`NumVersion`,`IdQuest`),
  KEY `FK_VersionQuestionnaire_IdQuest` (`IdQuest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `versionquestionnaire`
--

INSERT INTO `versionquestionnaire` (`NumVersion`, `DateExpiration`, `IdQuest`) VALUES
(1, '2015-04-20', 1),
(1, '2015-04-15', 2),
(2, '2015-04-25', 1),
(2, '2015-04-25', 2),
(3, '2015-05-02', 1),
(3, '2015-05-02', 2),
(4, '2015-06-08', 1),
(4, '2015-05-15', 2),
(5, '2015-06-08', 2),
(6, '2015-06-10', 2),
(7, '2015-06-13', 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `carnetadresse`
--
ALTER TABLE `carnetadresse`
  ADD CONSTRAINT `FK_CarnetAdresse_ID` FOREIGN KEY (`ID`) REFERENCES `administrateur` (`ID`);

--
-- Contraintes pour la table `gerer`
--
ALTER TABLE `gerer`
  ADD CONSTRAINT `FK_Gerer_IdCarnet` FOREIGN KEY (`IdCarnet`) REFERENCES `carnetadresse` (`IdCarnet`),
  ADD CONSTRAINT `FK_Gerer_InviteCode` FOREIGN KEY (`InviteCode`) REFERENCES `utilisateurs` (`InviteCode`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `FK_Participer_IdQuest` FOREIGN KEY (`IdQuest`) REFERENCES `versionquestionnaire` (`IdQuest`),
  ADD CONSTRAINT `FK_Participer_InviteCode` FOREIGN KEY (`InviteCode`) REFERENCES `utilisateurs` (`InviteCode`),
  ADD CONSTRAINT `FK_Participer_NumVersion` FOREIGN KEY (`NumVersion`) REFERENCES `versionquestionnaire` (`NumVersion`);

--
-- Contraintes pour la table `questionnaire`
--
ALTER TABLE `questionnaire`
  ADD CONSTRAINT `FK_Questionnaire_ID` FOREIGN KEY (`ID`) REFERENCES `administrateur` (`ID`);

--
-- Contraintes pour la table `versionquestionnaire`
--
ALTER TABLE `versionquestionnaire`
  ADD CONSTRAINT `FK_VersionQuestionnaire_IdQuest` FOREIGN KEY (`IdQuest`) REFERENCES `questionnaire` (`IdQuest`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
