-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2018 at 11:17 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linkedece`
--

-- --------------------------------------------------------

--
-- Table structure for table `choucroutte`
--

CREATE TABLE `choucroutte` (
  `IDPswd` int(11) NOT NULL,
  `User` int(11) NOT NULL COMMENT '#IDUser',
  `Hash` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choucroutte`
--

INSERT INTO `choucroutte` (`IDPswd`, `User`, `Hash`) VALUES
(1, 5, '$2y$10$ToKdyustPhqqYIGKpnn3Ke6UXqORHu6S91J07BGDX7pu26UxZEvee'),
(2, 6, '$2y$10$zYGVMJ14KZiD67wFPDduDuPRlMIUwGJ/HllbmJjztv1/kT275tH12'),
(3, 7, '$2y$10$uswByL9CllYlLCfCuqLs/uaWEMIcZ/zXC5ntt7fd67rReNj5IDpUK'),
(4, 8, '$2y$10$9yn1xdX.925HTJej5MK/hudgiLgjwxhfRsQnAPJhzIjQP0ezE/TiS'),
(5, 9, '$2y$10$lW9E8pQRkBj2asyDMbab6uz3MlSTXW25hHYrs47e0raJplbpd9I0a'),
(6, 10, '$2y$10$5xcEX5hP6Yub9mXfA7R.RuLXT9op.1bKStSdjKEJKp13nALxA7hTG'),
(7, 11, '$2y$10$J2gjpFIhSgKqINdMlEz/..MuvG.NPDf8Gwx/7GbXXcbMr41vllpEq');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `IDComment` int(11) NOT NULL,
  `Publication` int(11) NOT NULL COMMENT '#IDPublication',
  `Content` text NOT NULL,
  `DateComment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `User` int(11) NOT NULL COMMENT '#IDUser'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`IDComment`, `Publication`, `Content`, `DateComment`, `User`) VALUES
(1, 1, 'Je préfère Facebook!', '2018-04-29 22:00:00', 2),
(2, 2, 'Je préfère Apple!', '2018-04-28 22:00:00', 3),
(3, 3, 'Je préfère Google!', '2018-04-27 22:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `IDCompany` int(11) NOT NULL,
  `NameCompany` varchar(256) NOT NULL,
  `MailCompany` varchar(256) NOT NULL,
  `PP` int(11) NOT NULL COMMENT '#IDMedia'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`IDCompany`, `NameCompany`, `MailCompany`, `PP`) VALUES
(1, 'Amazon', 'amazon@amazon.com', 5),
(2, 'Apple', 'apple@apple.com', 6),
(3, 'Facebook', 'facebook@facebook.com', 7),
(4, 'Google', 'google@google.com', 8);

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `IDConnection` int(11) NOT NULL,
  `User1` int(11) NOT NULL COMMENT '#IDUser',
  `User2` int(11) NOT NULL COMMENT '#IDUser',
  `Relationship` enum('Friend','Contact') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `connection`
--

INSERT INTO `connection` (`IDConnection`, `User1`, `User2`, `Relationship`) VALUES
(1, 1, 2, 'Friend'),
(2, 1, 3, 'Friend'),
(3, 2, 3, 'Friend'),
(4, 6, 3, 'Friend'),
(5, 9, 10, 'Friend'),
(6, 9, 5, 'Friend'),
(7, 9, 11, 'Friend'),
(10, 11, 10, 'Friend'),
(9, 7, 10, 'Contact');

-- --------------------------------------------------------

--
-- Table structure for table `connectionrequest`
--

CREATE TABLE `connectionrequest` (
  `IDConnectionRequest` int(11) NOT NULL,
  `User1` int(11) NOT NULL COMMENT '#IDUser',
  `User2` int(11) NOT NULL COMMENT '#IDUser',
  `Relationship` enum('Friend','Contact') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `connectionrequest`
--

INSERT INTO `connectionrequest` (`IDConnectionRequest`, `User1`, `User2`, `Relationship`) VALUES
(1, 42, 63, 'Friend'),
(8, 9, 3, 'Friend');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `IDExperience` int(11) NOT NULL,
  `User` int(11) NOT NULL COMMENT '#IDUser',
  `Company` int(11) NOT NULL COMMENT '#IDCompany',
  `Position` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`IDExperience`, `User`, `Company`, `Position`) VALUES
(1, 1, 1, 'Front-end Developer'),
(2, 1, 2, 'DB administrator'),
(3, 2, 3, 'Spyware developer'),
(4, 2, 3, 'Information reseller'),
(5, 2, 4, 'Google Maps developer'),
(6, 3, 1, 'Logistic designer'),
(7, 6, 4, 'something cool');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `IDJob` int(11) NOT NULL,
  `User` int(11) NOT NULL COMMENT '#IDUser',
  `Company` int(11) NOT NULL COMMENT '#IDCompany',
  `Position` varchar(256) NOT NULL,
  `Description` text NOT NULL,
  `DateBegin` timestamp NOT NULL,
  `DateEnd` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`IDJob`, `User`, `Company`, `Position`, `Description`, `DateBegin`, `DateEnd`) VALUES
(1, 1, 1, 'Back-end developer', 'Need a new db architecture', '2018-04-29 22:00:00', '2018-07-29 22:00:00'),
(2, 1, 1, 'API developper', 'Open source Amazon API to help independant developer', '2018-04-30 22:00:00', '2021-04-30 22:00:00'),
(3, 2, 2, 'Harware expert', 'New design for A10 chip', '2018-04-30 22:00:00', '2021-04-30 22:00:00'),
(4, 3, 3, 'Lawyer', 'We did nothing wrong', '2018-04-30 22:00:00', '2024-04-30 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `IDMedia` int(11) NOT NULL,
  `Path` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`IDMedia`, `Path`) VALUES
(1, 'src/PPGab.jpg'),
(2, 'src/BackGab.jpg'),
(3, 'src/CVGab.jpg'),
(4, 'src/logoAmazon'),
(5, 'src/logoAmazon.png'),
(6, 'src/logoApple.jpg'),
(7, 'src/logoFacebook.png'),
(8, 'src/logoGoogle.png'),
(9, 'src/pp_anonymous.jpg'),
(10, 'src/defaultBackground.jpg'),
(11, 'src/5aec722a5186b6.62100038.jpg'),
(12, 'src/5aec737a16e236.24195793.jpg'),
(13, 'src/5aec771304d0e2.82640155.jpg'),
(14, 'src/5aec77444a6cb4.54892728.jpg'),
(15, 'src/5aec7906697a86.99613349.png');

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `IDPublication` int(11) NOT NULL,
  `User` int(11) NOT NULL COMMENT '#IDUser',
  `Description` text,
  `Media` int(11) DEFAULT NULL COMMENT '#IDMedia',
  `DatePublication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateUser` timestamp NULL DEFAULT NULL,
  `PlaceUser` varchar(256) DEFAULT NULL,
  `Visibility` enum('Friends','Professionnals','Everyone') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`IDPublication`, `User`, `Description`, `Media`, `DatePublication`, `DateUser`, `PlaceUser`, `Visibility`) VALUES
(1, 3, 'J\'aime bien Google!', 8, '2018-04-29 22:00:00', '2018-04-29 22:00:00', '0', 'Friends'),
(2, 2, 'J\'aime bien Facebook!', 7, '2018-04-28 22:00:00', '2018-04-28 22:00:00', '1', 'Friends'),
(3, 1, 'J\'aime bien Apple!', 6, '2018-04-27 22:00:00', '2018-04-27 22:00:00', '2', 'Friends'),
(4, 9, 'Hourra ! Nous nous sommes mariÃ©s hier !\r\nXoxo', 12, '2018-05-04 14:51:38', '2018-05-03 22:00:00', 'Paris', 'Friends'),
(6, 10, 'J\'apparait dans l\'anime HxH !', NULL, '2018-05-04 15:13:24', '2018-05-03 22:00:00', 'Paris', 'Friends');

-- --------------------------------------------------------

--
-- Table structure for table `reaction`
--

CREATE TABLE `reaction` (
  `IDReaction` int(11) NOT NULL,
  `Publication` int(11) NOT NULL COMMENT '#IDPublication',
  `User` int(11) NOT NULL COMMENT '#IDUser'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reaction`
--

INSERT INTO `reaction` (`IDReaction`, `Publication`, `User`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 1),
(4, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `realisation`
--

CREATE TABLE `realisation` (
  `IDRealisation` int(11) NOT NULL,
  `Projet` int(11) NOT NULL,
  `User` int(11) NOT NULL COMMENT '#IDUser',
  `Description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realisation`
--

INSERT INTO `realisation` (`IDRealisation`, `Projet`, `User`, `Description`) VALUES
(1, 1, 1, 'LinkedEce'),
(2, 1, 2, 'LinkedEce'),
(3, 1, 3, 'LinkedEce'),
(4, 2, 1, 'LinkedEce'),
(5, 3, 1, 'LinkedEce'),
(6, 3, 2, 'Random Elec Project'),
(7, 2, 3, 'Random Elec Project');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `IDUser` int(11) NOT NULL,
  `NameUser` varchar(256) NOT NULL,
  `FirstNameUser` varchar(256) NOT NULL,
  `MailUser` varchar(256) NOT NULL,
  `PP` int(11) DEFAULT '9' COMMENT '#IDMedia',
  `Background` int(11) DEFAULT '10' COMMENT '#IDMedia',
  `Admin` tinyint(1) NOT NULL,
  `Status` varchar(256) DEFAULT NULL,
  `Pseudo` varchar(256) NOT NULL,
  `CV` int(11) DEFAULT NULL COMMENT '#IDMedia',
  `Occupation` varchar(256) DEFAULT NULL,
  `Company` int(11) DEFAULT NULL COMMENT '#IDCompany',
  `Birthday` timestamp NULL DEFAULT NULL,
  `lastDeconnection` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`IDUser`, `NameUser`, `FirstNameUser`, `MailUser`, `PP`, `Background`, `Admin`, `Status`, `Pseudo`, `CV`, `Occupation`, `Company`, `Birthday`, `lastDeconnection`) VALUES
(2, 'Brisse', 'Romain', 'romain.brisse@edu.ece.fr', 9, 10, 1, 'Student', 'Roro', NULL, '', NULL, NULL, '2018-05-03 12:47:35'),
(3, 'Martin', 'Alexis', 'alexis.martin@edu.ece.fr', 9, 10, 1, 'Student', 'Alexou', NULL, '', NULL, NULL, '2018-05-03 12:47:35'),
(5, 'padis', 'gab', 'gabriel.padis@edu.ece.fr', 9, 10, 0, NULL, 'gab', NULL, NULL, NULL, NULL, '2018-05-04 19:57:30'),
(6, 'Pican', 'Achille', 'a@p.com', 9, 10, 1, 'Learning Life', 'Chiloo', NULL, NULL, NULL, NULL, '2018-05-03 20:41:30'),
(7, 'a', 'a', 'a@b.com', 9, 10, 0, NULL, 'a', NULL, NULL, NULL, NULL, '2018-05-05 07:52:31'),
(8, 'brisse', 'adel', 'ab@gmail.com', 9, 10, 0, NULL, 'dada', NULL, NULL, NULL, NULL, '2018-05-03 20:45:08'),
(9, 'Padis', 'Gabriel', 'gabriel.padis@laposte.net', 11, 13, 0, NULL, 'Gabriel', NULL, NULL, NULL, NULL, '2018-05-05 10:00:03'),
(10, 'Hxh', 'Hisoka', 'hisoka@gmail.com', 15, 10, 1, NULL, 'Hisoka', NULL, NULL, NULL, NULL, '2018-05-05 09:58:00'),
(11, 'Sir', 'Buenvenuto', 'buenvenuto@gmail.com', 9, 10, 0, NULL, 'Buenvenuto', NULL, NULL, NULL, NULL, '2018-05-05 09:55:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choucroutte`
--
ALTER TABLE `choucroutte`
  ADD PRIMARY KEY (`IDPswd`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`IDComment`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`IDCompany`);

--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`IDConnection`);

--
-- Indexes for table `connectionrequest`
--
ALTER TABLE `connectionrequest`
  ADD PRIMARY KEY (`IDConnectionRequest`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`IDExperience`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`IDJob`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`IDMedia`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`IDPublication`);

--
-- Indexes for table `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`IDReaction`);

--
-- Indexes for table `realisation`
--
ALTER TABLE `realisation`
  ADD PRIMARY KEY (`IDRealisation`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IDUser`),
  ADD UNIQUE KEY `MailUser` (`MailUser`),
  ADD UNIQUE KEY `Pseudo` (`Pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choucroutte`
--
ALTER TABLE `choucroutte`
  MODIFY `IDPswd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `IDComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `IDCompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `connection`
--
ALTER TABLE `connection`
  MODIFY `IDConnection` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `connectionrequest`
--
ALTER TABLE `connectionrequest`
  MODIFY `IDConnectionRequest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `IDExperience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `IDJob` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `IDMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `IDPublication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `IDReaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `realisation`
--
ALTER TABLE `realisation`
  MODIFY `IDRealisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `IDUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
