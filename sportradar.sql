-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2024 at 12:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportradar`
--
CREATE DATABASE IF NOT EXISTS `sportradar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sportradar`;

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE `Event` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `team_1_id_fk` int(11) NOT NULL,
  `team_2_id_fk` int(11) NOT NULL,
  `venue_id_fk` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`id`, `datetime`, `team_1_id_fk`, `team_2_id_fk`, `venue_id_fk`, `description`) VALUES
(8, '2024-12-04 17:28:00', 2, 1, 2, 'Big soccer event!'),
(9, '2024-12-07 17:00:00', 1, 2, 3, 'A Vienna showdown is coming'),
(11, '2024-12-05 18:00:00', 3, 5, 4, 'Baseball fans, buckle up!'),
(12, '2024-12-23 23:00:00', 4, 3, 5, 'A baseball afternoon in Fenway Park'),
(13, '2024-12-05 09:30:00', 6, 7, 7, 'NBA stars at Staples Center!'),
(15, '2024-11-27 16:00:00', 6, 7, 8, 'Lakers vs. Knicks - tonight @ Madison Square Garden! Don&#039;t miss it.'),
(16, '2024-12-17 18:00:00', 2, 1, 1, 'Vienna football madness!'),
(17, '2024-12-09 04:30:00', 5, 4, 6, 'A must see game! Dodgers vs. Red Sex');

-- --------------------------------------------------------

--
-- Table structure for table `Sport`
--

CREATE TABLE `Sport` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Sport`
--

INSERT INTO `Sport` (`id`, `name`, `icon`) VALUES
(1, 'Soccer', 'https://daily.jstor.org/wp-content/uploads/2018/06/soccer_europe_1050x700.jpg'),
(2, 'Baseball', 'https://thatsallsport.com/wp-content/uploads/2023/02/Baseball-mitt-and-bat.jpg'),
(3, 'Basketball', 'https://www.rockstaracademy.com/lib/images/news/basketball.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `Team`
--

CREATE TABLE `Team` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `information` varchar(255) NOT NULL,
  `sport_id_fk` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Team`
--

INSERT INTO `Team` (`id`, `name`, `information`, `sport_id_fk`, `city`, `logo`) VALUES
(1, 'Sportklub Rapid', 'Sportklub Rapid, commonly known as Rapid Wien or Rapid Vienna in English, is an Austrian professional football club playing in the country\'s capital city of Vienna.', 1, 'Vienna', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/47/SK_Rapid_Wien_Logo_without_stars.PNG/1238px-SK_Rapid_Wien_Logo_without_stars.PNG'),
(2, 'FK Austria Wien', 'Fußballklub Austria Wien AG, known in English as Austria Vienna, and Austria Wien in German-speaking countries, is an Austrian professional association football club from the capital city of Vienna.', 1, 'Vienna', 'https://upload.wikimedia.org/wikipedia/de/4/49/Austria_Wien.svg'),
(3, 'New York Yankees', 'The New York Yankees are an American professional baseball team based in the New York City borough of the Bronx. The Yankees compete in Major League Baseball as a member club of the American League East Division.', 2, 'New York', 'https://s.yimg.com/cv/apiv2/default/mlb/20190319/500x500/yankees_wbgs.png'),
(4, 'Boston Red Sox', 'The Boston Red Sox are an American professional baseball team based in Boston. The Red Sox compete in Major League Baseball as a member club of the American League East Division. Founded in 1901, the team\'s home ballpark has been Fenway Park since 1912.', 2, 'Boston', 'https://imageio.forbes.com/i-forbesimg/media/lists/teams/boston-red-sox_416x416.jpg?format=jpg'),
(5, 'Los Angeles Dodgers', 'The Los Angeles Dodgers are an American professional baseball team based in Los Angeles. The Dodgers compete in Major League Baseball as a member club of the National League West Division.', 2, 'Los Angeles', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Los_Angeles_Dodgers_Logo.svg/1920px-Los_Angeles_Dodgers_Logo.svg.png'),
(6, 'Los Angeles Lakers', 'The Los Angeles Lakers are an American professional basketball team based in Los Angeles. The Lakers compete in the National Basketball Association as a member of the Pacific Division of the Western Conference.', 3, 'Los Angeles', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Los_Angeles_Lakers_logo.svg/2560px-Los_Angeles_Lakers_logo.svg.png'),
(7, 'New York Knicks', 'The New York Knickerbockers, more commonly referred to as the Knicks, are an American basketball team based in Manhattan. The Knicks compete in the National Basketball Association as a member of the Atlantic Division of the Eastern Conference.', 3, 'New York', 'https://upload.wikimedia.org/wikipedia/en/thumb/2/25/New_York_Knicks_logo.svg/1920px-New_York_Knicks_logo.svg.png');

-- --------------------------------------------------------

--
-- Table structure for table `Venue`
--

CREATE TABLE `Venue` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Venue`
--

INSERT INTO `Venue` (`id`, `name`, `city`) VALUES
(1, 'Ernst-Happel-Stadion', 'Vienna'),
(2, 'Allianz Stadion', 'Vienna'),
(3, 'Franz Horr Stadium', 'Vienna'),
(4, 'Yankee Stadium', 'New York'),
(5, 'Fenway Park', 'Boston'),
(6, 'Dodger Stadium', 'Los Angeles'),
(7, 'Crypto.com Arena (Staples Center)', 'Los Angeles'),
(8, 'Madison Square Garden', 'New York');

-- --------------------------------------------------------

--
-- Table structure for table `Venue_Sport`
--

CREATE TABLE `Venue_Sport` (
  `id` int(11) NOT NULL,
  `venue_id_fk` int(11) NOT NULL,
  `sport_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Venue_Sport`
--

INSERT INTO `Venue_Sport` (`id`, `venue_id_fk`, `sport_id_fk`) VALUES
(1, 7, 3),
(2, 2, 1),
(3, 6, 2),
(4, 1, 1),
(5, 5, 2),
(6, 3, 1),
(7, 8, 3),
(8, 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_1_id_fk` (`team_1_id_fk`),
  ADD KEY `team_2_id_fk` (`team_2_id_fk`),
  ADD KEY `venue_id_fk` (`venue_id_fk`);

--
-- Indexes for table `Sport`
--
ALTER TABLE `Sport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Team`
--
ALTER TABLE `Team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sport_id_fk` (`sport_id_fk`);

--
-- Indexes for table `Venue`
--
ALTER TABLE `Venue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Venue_Sport`
--
ALTER TABLE `Venue_Sport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venue_id_fk` (`venue_id_fk`),
  ADD KEY `sport_id_fk` (`sport_id_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Event`
--
ALTER TABLE `Event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `Sport`
--
ALTER TABLE `Sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Team`
--
ALTER TABLE `Team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Venue`
--
ALTER TABLE `Venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Venue_Sport`
--
ALTER TABLE `Venue_Sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`team_1_id_fk`) REFERENCES `Team` (`id`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`team_2_id_fk`) REFERENCES `Team` (`id`),
  ADD CONSTRAINT `event_ibfk_3` FOREIGN KEY (`venue_id_fk`) REFERENCES `Venue` (`id`);

--
-- Constraints for table `Team`
--
ALTER TABLE `Team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`sport_id_fk`) REFERENCES `Sport` (`id`);

--
-- Constraints for table `Venue_Sport`
--
ALTER TABLE `Venue_Sport`
  ADD CONSTRAINT `venue_sport_ibfk_1` FOREIGN KEY (`venue_id_fk`) REFERENCES `Venue` (`id`),
  ADD CONSTRAINT `venue_sport_ibfk_2` FOREIGN KEY (`sport_id_fk`) REFERENCES `Sport` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
