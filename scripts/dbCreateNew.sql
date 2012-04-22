SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+02:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `weshare`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `IdEvent` int(11) NOT NULL AUTO_INCREMENT,
  `IdOrganizer` int(11) NOT NULL,
  `DateOfEvent` date NOT NULL,
  `Adress` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `CreationDate` date NOT NULL,
  `PollEnding` date DEFAULT NULL,
  PRIMARY KEY (`IdEvent`),
  KEY `IdOrganizer` (`IdOrganizer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `eventsinvitations`
--

DROP TABLE IF EXISTS `eventsinvitations`;
CREATE TABLE IF NOT EXISTS `eventsinvitations` (
  `IdEvent` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `Status` int(11) DEFAULT '0',
  KEY `IdEvent` (`IdEvent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `eventsselections`
--

DROP TABLE IF EXISTS `eventsselections`;
CREATE TABLE IF NOT EXISTS `eventsselections` (
  `IdEvent` int(11) NOT NULL,
  `IdMovie` int(11) NOT NULL,
  `NumberOfVote` int(11) DEFAULT '0',
  KEY `IdEvent` (`IdEvent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `IdUser` int(11) NOT NULL,
  `IdFriend` int(11) NOT NULL,
  `Status` int(11) DEFAULT '0',
  KEY `IdUser` (`IdUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `IdGroup` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `IdCreator` int(11) NOT NULL,
  PRIMARY KEY (`IdGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `IdMovie` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Synopsis` text NOT NULL,
  `DateOfRecord` date NOT NULL,
  `Poster` longtext,
  PRIMARY KEY (`IdMovie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `moviesmarks`
--

DROP TABLE IF EXISTS `moviesmarks`;
CREATE TABLE IF NOT EXISTS `moviesmarks` (
  `IdMovie` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `Mark` double DEFAULT '0',
  `UserComment` text,
  KEY `IdUser` (`IdUser`),
  KEY `IdMovie` (`IdMovie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `moviesstaffs`
--

DROP TABLE IF EXISTS `moviesstaffs`;
CREATE TABLE IF NOT EXISTS `moviesstaffs` (
  `IdMovie` int(11) NOT NULL,
  `IdStaff` int(11) NOT NULL,
  `StaffWork` enum('acteur','actrice','realisateur','realisatrice') DEFAULT NULL,
  KEY `IdStaff` (`IdStaff`),
  KEY `IdMovie` (`IdMovie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pms`
--

DROP TABLE IF EXISTS `pms`;
CREATE TABLE IF NOT EXISTS `pms` (
  `IdPM` int(11) NOT NULL AUTO_INCREMENT,
  `IdSender` int(11) NOT NULL,
  `Message` text NOT NULL,
  `MessageDate` date NOT NULL,
  PRIMARY KEY (`IdPM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
CREATE TABLE IF NOT EXISTS `staffs` (
  `IdStaff` int(11) NOT NULL AUTO_INCREMENT,
  `LastName` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `BornDate` date DEFAULT NULL,
  `Bio` text,
  `Picture` longtext,
  PRIMARY KEY (`IdStaff`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `usergroups`
--

DROP TABLE IF EXISTS `usergroups`;
CREATE TABLE IF NOT EXISTS `usergroups` (
  `IdUser` int(11) NOT NULL,
  `IdGroup` int(11) NOT NULL,
  KEY `IdUser` (`IdUser`),
  KEY `IdGroup` (`IdGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `usermovies`
--

DROP TABLE IF EXISTS `usermovies`;
CREATE TABLE IF NOT EXISTS `usermovies` (
  `IdUser` int(11) NOT NULL,
  `IdMovie` int(11) NOT NULL,
  `Support` enum('cd','divx','blue-ray','dvd','fichier','VHS') NOT NULL,
  `Available` int(11) DEFAULT '1',
  KEY `IdUser` (`IdUser`),
  KEY `IdMovie` (`IdMovie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `userpms`
--

DROP TABLE IF EXISTS `userpms`;
CREATE TABLE IF NOT EXISTS `userpms` (
  `IdUser` int(11) NOT NULL,
  `IdPM` int(11) NOT NULL,
  `ReadStatus` int(11) DEFAULT '0',
  KEY `IdUser` (`IdUser`),
  KEY `IdPM` (`IdPM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `IdUser` int(11) NOT NULL AUTO_INCREMENT,
  `RegisterDate` date NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `BornDate` date DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Avatar` longtext,
  PRIMARY KEY (`IdUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`IdOrganizer`) REFERENCES `users` (`IdUser`);

--
-- Contraintes pour la table `eventsinvitations`
--
ALTER TABLE `eventsinvitations`
  ADD CONSTRAINT `eventsinvitations_ibfk_1` FOREIGN KEY (`IdEvent`) REFERENCES `events` (`IdEvent`);

--
-- Contraintes pour la table `eventsselections`
--
ALTER TABLE `eventsselections`
  ADD CONSTRAINT `eventsselections_ibfk_1` FOREIGN KEY (`IdEvent`) REFERENCES `events` (`IdEvent`);

--
-- Contraintes pour la table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`);

--
-- Contraintes pour la table `moviesmarks`
--
ALTER TABLE `moviesmarks`
  ADD CONSTRAINT `moviesmarks_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `moviesmarks_ibfk_2` FOREIGN KEY (`IdMovie`) REFERENCES `movies` (`IdMovie`);

--
-- Contraintes pour la table `moviesstaffs`
--
ALTER TABLE `moviesstaffs`
  ADD CONSTRAINT `moviesstaffs_ibfk_1` FOREIGN KEY (`IdStaff`) REFERENCES `staffs` (`IdStaff`),
  ADD CONSTRAINT `moviesstaffs_ibfk_2` FOREIGN KEY (`IdMovie`) REFERENCES `movies` (`IdMovie`);

--
-- Contraintes pour la table `usergroups`
--
ALTER TABLE `usergroups`
  ADD CONSTRAINT `usergroups_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `usergroups_ibfk_2` FOREIGN KEY (`IdGroup`) REFERENCES `groups` (`IdGroup`);

--
-- Contraintes pour la table `usermovies`
--
ALTER TABLE `usermovies`
  ADD CONSTRAINT `usermovies_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `usermovies_ibfk_2` FOREIGN KEY (`IdMovie`) REFERENCES `movies` (`IdMovie`);

--
-- Contraintes pour la table `userpms`
--
ALTER TABLE `userpms`
  ADD CONSTRAINT `userpms_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `users` (`IdUser`),
  ADD CONSTRAINT `userpms_ibfk_2` FOREIGN KEY (`IdPM`) REFERENCES `pms` (`IdPM`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
