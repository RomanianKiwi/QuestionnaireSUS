-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 04 Mars 2015 à 14:57
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
  `ID` int(6) NOT NULL DEFAULT '0',
  `UserName` varchar(250) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`ID`, `UserName`, `Password`) VALUES
(1, 'Marco', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `IdUser` int(6) NOT NULL DEFAULT '0',
  `IdQuest` int(6) NOT NULL DEFAULT '0',
  `Note` int(3) DEFAULT NULL,
  `VersonSysteme` int(6) DEFAULT NULL,
  PRIMARY KEY (`IdUser`,`IdQuest`),
  KEY `IdQuest` (`IdQuest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `participant`
--

INSERT INTO `participant` (`IdUser`, `IdQuest`, `Note`, `VersonSysteme`) VALUES
(1, 1, 50, 1),
(2, 1, 55, 1),
(3, 1, 70, 1),
(4, 1, 80, 1),
(5, 2, 62, 1),
(6, 2, 90, 1),
(7, 3, 40, 1),
(8, 3, 47, 1),
(9, 4, 97, 1),
(10, 4, 100, 1);

-- --------------------------------------------------------

--
-- Structure de la table `questionnaire`
--

CREATE TABLE IF NOT EXISTS `questionnaire` (
  `IdQuest` int(6) NOT NULL DEFAULT '0',
  `Nom` varchar(20) DEFAULT NULL,
  `IdCreateur` int(6) DEFAULT NULL,
  `DateCreation` datetime DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdQuest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `questionnaire`
--

INSERT INTO `questionnaire` (`IdQuest`, `Nom`, `IdCreateur`, `DateCreation`, `url`) VALUES
(1, 'Parions Sport', 1, '2015-02-26 00:00:00', 'http://localhost/projet_SUS_test/questionnaire.php?nomSysteme=Parions Sport'),
(2, 'Parions Sport', 1, '2015-03-03 00:00:00', 'http://localhost/projet_SUS_test/questionnaire.php?nomSysteme=Parions Sport'),
(3, 'GPS', 1, '2015-03-02 00:00:00', 'http://localhost/QuestionnaireSUS/pages/questionnaire.php?nomSysteme=GPS'),
(4, 'GPS', 1, '2015-03-02 05:20:00', 'http://localhost/QuestionnaireSUS/pages/questionnaire.php?nomSysteme=GPS');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`IdQuest`) REFERENCES `questionnaire` (`IdQuest`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
