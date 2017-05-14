-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2017 at 06:59 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `ActorID` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`ActorID`, `FirstName`, `LastName`) VALUES
(1, 'Martin', 'Sheen\r'),
(2, 'Deborah Kara', 'Unger\r'),
(3, 'James', 'Nesbitt\r'),
(4, 'Yorick', 'van Wageningen\r'),
(5, 'Emilio', 'Estevez\r'),
(6, 'Asha', 'Bhosle\r'),
(7, 'Duncan', 'Bridgeman\r'),
(8, 'Jamie', 'Catto\r'),
(9, 'Neneh', 'Cherry\r'),
(10, 'Ram', 'Dass\r'),
(11, 'Ron', 'Fricke cinematography\r'),
(12, 'Harrison', 'Ford\r'),
(13, 'Rutger', 'Hauer\r'),
(14, 'Sean', 'Young\r'),
(15, 'Edward James', 'Olmos\r'),
(16, 'Keanu', 'Reeves\r'),
(17, 'Laurence', 'Fishburne\r'),
(18, 'Carrie-Anne', 'Moss\r'),
(19, 'Hugo', 'Weaving\r'),
(20, 'Joe', 'Pantoliano\r'),
(21, 'Jeff', 'Bridges\r'),
(22, 'John', 'Goodman\r'),
(23, 'Julianne', 'Moore\r'),
(24, 'Steve', 'Buscemi\r'),
(25, 'John', 'Turturro\r'),
(26, 'Adrien', 'Brody\r'),
(27, 'Beyonce', 'Knowles'),
(28, 'Jeffrey', 'Wright\r'),
(29, 'Dev', 'Patel\r'),
(30, 'Freida', 'Pinto\r'),
(31, 'Madhur', 'Mittal\r'),
(32, 'Anil', 'Kapoor\r'),
(33, 'Irrfan', 'Khan\r'),
(34, 'Cillian', 'Murphy\r'),
(35, 'Naomie', 'Harris\r'),
(36, 'Christopher', 'Eccleston\r'),
(37, 'Megan', 'Burns\r'),
(38, 'Brendan', 'Gleeson'),
(39, 'Tom', 'Hanks'),
(40, 'Edward', 'Burns'),
(41, 'Matt', 'Damon'),
(42, 'Tom', 'Sizemore');

-- --------------------------------------------------------

--
-- Stand-in structure for view `actors_fullname`
-- (See below for the actual view)
--
CREATE TABLE `actors_fullname` (
`Actors` varchar(101)
,`ActorID` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `actor_movie`
--

CREATE TABLE `actor_movie` (
  `Actor_MovieID` int(10) UNSIGNED NOT NULL,
  `ActorID` int(10) UNSIGNED DEFAULT NULL,
  `MovieID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actor_movie`
--

INSERT INTO `actor_movie` (`Actor_MovieID`, `ActorID`, `MovieID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 2),
(10, 10, 2),
(11, 11, 3),
(12, 12, 4),
(13, 13, 4),
(14, 14, 4),
(15, 15, 4),
(16, 16, 5),
(17, 17, 5),
(18, 18, 5),
(19, 19, 5),
(20, 20, 5),
(21, 21, 6),
(22, 22, 6),
(23, 23, 6),
(24, 24, 6),
(25, 25, 6),
(26, 26, 7),
(27, 27, 7),
(28, 28, 7),
(29, 29, 8),
(30, 30, 8),
(31, 31, 8),
(32, 32, 8),
(33, 33, 8),
(34, 34, 9),
(35, 35, 9),
(36, 36, 9),
(37, 37, 9),
(38, 38, 9),
(39, 40, 12),
(40, 41, 12),
(41, 39, 12),
(42, 42, 12);

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `DirectorID` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`DirectorID`, `FirstName`, `LastName`) VALUES
(1, 'Emilio', 'Estevez\r'),
(2, 'Duncan', 'Bridgeman\r'),
(3, 'Jamie', 'Catto\r'),
(4, 'Ron', 'Fricke\r'),
(5, 'Ridley', 'Scott\r'),
(6, 'Lana', 'Wachowski\r'),
(7, 'Lilly', 'Wachowski\r'),
(8, 'Joel', 'Coen\r'),
(9, 'Ethan', 'Coen'),
(10, 'Darnell', 'Martin\r'),
(11, 'Danny', 'Boyle'),
(15, 'James', 'Cameron'),
(17, 'Steven', 'Spielberg'),
(18, 'Stanley', 'Kubrick'),
(20, 'Jean Luc', 'Goddard'),
(21, 'Terry', 'Gilliam'),
(22, 'Phil', 'Noyce'),
(23, 'Steven', 'Soderbergh'),
(24, 'George', 'Miller'),
(25, 'Mel', 'Gibson'),
(26, 'Wes', 'Anderson'),
(27, 'Terrence', 'Malick'),
(28, 'Francis Ford', 'Copola');

-- --------------------------------------------------------

--
-- Stand-in structure for view `directors_fullname`
-- (See below for the actual view)
--
CREATE TABLE `directors_fullname` (
`Directors` varchar(101)
,`DirectorID` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `director_movie`
--

CREATE TABLE `director_movie` (
  `Director_MovieID` int(10) UNSIGNED NOT NULL,
  `DirectorID` int(10) UNSIGNED DEFAULT NULL,
  `MovieID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `director_movie`
--

INSERT INTO `director_movie` (`Director_MovieID`, `DirectorID`, `MovieID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 3),
(5, 5, 4),
(6, 6, 5),
(7, 7, 5),
(8, 8, 6),
(9, 9, 6),
(10, 10, 7),
(11, 11, 8),
(12, 11, 9),
(13, 17, 12);

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `DistributorID` int(10) UNSIGNED NOT NULL,
  `Distributor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`DistributorID`, `Distributor`) VALUES
(1, 'Icon Entertainment\r'),
(2, 'Palm Pictures\r'),
(3, 'Oscilloscope Laboratories\r'),
(4, 'Warner Bros.\r'),
(5, 'Gramercy Pictures\r'),
(6, 'TriStar Pictures\r'),
(7, 'Fox Searchlight Pictures'),
(9, 'DreamWorks Pictures');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `GenreID` int(10) UNSIGNED NOT NULL,
  `Genre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`GenreID`, `Genre`) VALUES
(1, 'Drama\r'),
(2, 'Documentary\r'),
(3, 'Science Fiction\r'),
(4, 'Comedy\r'),
(5, 'Biopic\r'),
(6, 'Horror'),
(7, 'War'),
(10, 'Comedy'),
(11, 'Drama'),
(12, 'Science Fiction'),
(13, 'Documentary');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `MemberID` int(10) UNSIGNED NOT NULL,
  `UserType` enum('member','admin') NOT NULL DEFAULT 'member',
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`MemberID`, `UserType`, `FirstName`, `LastName`, `Email`, `Phone`, `UserName`, `Password`) VALUES
(6, 'admin', 'David', 'Sharpe', 'davidasharpe@me.com', '0431677215', 'davidasharpe', '$2y$10$Wxohp0EL2ckuSZJkoFuO1uLcZ.GxrrMlDqheJcOd34kYL5cGvIAW.'),
(7, 'member', 'John', 'Smith', 'jsmith@gmail.com', '0421789445', 'johnsmith', '$2y$10$/4dQtoqJQIj/3tokIf/zOO3sH59tWESJSlNGfrGRNzN6r/dfmfZ4u'),
(8, 'member', 'Joanne', 'Taylor', 'jotaylor@gmail.com', '0433999888', 'jotaylor', '$2y$10$EeIOTuEwA2PsCEiaVY5DFuGNiSx6rK71w8eegzkV2xRjLMLjwMMSy'),
(9, 'member', 'Barry', 'White', 'barrywhite@gmail.com', '0411999000', 'barrywhite', '$2y$10$akUEMjQ1WDLOjKmrfwDnR.la1hbtsPaG2Pq/5xl7dQ5V9XoNSwa5a');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `MovieID` int(10) UNSIGNED NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `RunningTime` int(10) DEFAULT NULL,
  `GenreID` int(10) UNSIGNED DEFAULT NULL,
  `DistributorID` int(10) UNSIGNED DEFAULT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`MovieID`, `Title`, `ReleaseDate`, `RunningTime`, `GenreID`, `DistributorID`, `Image`) VALUES
(1, 'The Way', '2010-09-10', 121, 1, 1, 'https://images-na.ssl-images-amazon.com/images/I/51fmQay0u6L._SX940_.jpg'),
(2, '1 Giant Leap', '2002-09-10', 155, 2, 2, 'https://images.shazam.com/coverart/t10072309-b2581416_s400.jpg'),
(3, 'Samsara', '2011-09-11', 99, 2, 3, 'https://upload.wikimedia.org/wikipedia/en/7/78/Samsara_Film_Poster.jpg'),
(4, 'Blade Runner', '1982-06-25', 116, 3, 4, 'http://sites.psu.edu/ephpassion16/wp-content/uploads/sites/39747/2016/03/Blade-Runner-Movie-Poster-Style-A-43x62-Inch-Bus-Shelter-Size.jpg'),
(5, 'The Matrix', '1999-03-31', 136, 3, 4, 'https://images-na.ssl-images-amazon.com/images/I/51EG732BV3L.jpg'),
(6, 'The Big Lebowski', '1998-03-06', 119, 4, 5, 'http://fringearts.com/wp-content/uploads/2015/07/original-lebowski-poster.jpg'),
(7, 'Cadillac Records', '2008-12-05', 109, 5, 6, 'https://s-media-cache-ak0.pinimg.com/736x/e7/9a/7d/e79a7d355261714b9b0ce237e39544a6.jpg'),
(8, 'Slumdog Millionaire', '2008-08-30', 120, 1, 1, 'https://s-media-cache-ak0.pinimg.com/originals/7d/3f/32/7d3f328846dcfc09984f4a7331b14d8f.jpg'),
(9, '28 Days Later', '2002-11-01', 113, 6, 7, 'https://s-media-cache-ak0.pinimg.com/originals/e0/21/e1/e021e1b067ff468a65c202bf309c5c3c.jpg'),
(12, 'Saving Private Ryan', '1998-07-24', 169, 7, 9, 'https://images-na.ssl-images-amazon.com/images/I/41q18r2JSaL._SX940_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `movie_rating`
--

CREATE TABLE `movie_rating` (
  `Movie_RatingID` int(10) UNSIGNED NOT NULL,
  `MovieID` int(10) UNSIGNED DEFAULT NULL,
  `MemberID` int(10) UNSIGNED DEFAULT NULL,
  `Rating` enum('1','2','3','4','5') DEFAULT NULL,
  `Review` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie_rating`
--

INSERT INTO `movie_rating` (`Movie_RatingID`, `MovieID`, `MemberID`, `Rating`, `Review`) VALUES
(1, 9, 6, '4', 'Great movie'),
(2, 9, 7, '3', 'Good Movie'),
(3, 4, 6, '5', 'My favourite sci-fi');

-- --------------------------------------------------------

--
-- Table structure for table `producers`
--

CREATE TABLE `producers` (
  `ProducerID` int(10) UNSIGNED NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producers`
--

INSERT INTO `producers` (`ProducerID`, `FirstName`, `LastName`) VALUES
(1, 'David', 'Alexanian\r'),
(2, 'Emilio', 'Estevez\r'),
(3, 'Duncan', 'Bridgeman\r'),
(4, 'Jamie', 'Catto\r'),
(5, 'Mark', 'Magidson\r'),
(6, 'Michael', 'Deeley\r'),
(7, 'Joel', 'Silver\r'),
(8, 'Ethan', 'Coen\r'),
(9, 'Joel', 'Coen\r'),
(10, 'Tim', 'Bevan\r'),
(11, 'Eric', 'Fellner\r'),
(12, 'Sofia', 'Sondervan\r'),
(13, 'Andrew', 'Lack\r'),
(14, 'Christian', 'Colson\r'),
(15, 'Andrew', 'Macdonald'),
(16, 'Ian', 'Bryce'),
(17, 'Mark', 'Gordon'),
(18, 'Gary', 'Levinsohn'),
(19, 'Steven', 'Spielberg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `producers_fullname`
-- (See below for the actual view)
--
CREATE TABLE `producers_fullname` (
`Producers` varchar(101)
,`ProducerID` int(10) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `producer_movie`
--

CREATE TABLE `producer_movie` (
  `Producer_MovieID` int(10) UNSIGNED NOT NULL,
  `ProducerID` int(10) UNSIGNED DEFAULT NULL,
  `MovieID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producer_movie`
--

INSERT INTO `producer_movie` (`Producer_MovieID`, `ProducerID`, `MovieID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 5, 3),
(6, 6, 4),
(7, 7, 5),
(8, 8, 6),
(9, 9, 6),
(10, 10, 6),
(11, 11, 6),
(12, 12, 7),
(13, 13, 7),
(14, 14, 8),
(15, 15, 9),
(16, 18, 12),
(17, 16, 12),
(18, 17, 12),
(19, 19, 12);

-- --------------------------------------------------------

--
-- Structure for view `actors_fullname`
--
DROP TABLE IF EXISTS `actors_fullname`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `actors_fullname`  AS  select concat_ws(' ',`actors`.`FirstName`,`actors`.`LastName`) AS `Actors`,`actors`.`ActorID` AS `ActorID` from `actors` order by `actors`.`FirstName` ;

-- --------------------------------------------------------

--
-- Structure for view `directors_fullname`
--
DROP TABLE IF EXISTS `directors_fullname`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `directors_fullname`  AS  select concat_ws(' ',`directors`.`FirstName`,`directors`.`LastName`) AS `Directors`,`directors`.`DirectorID` AS `DirectorID` from `directors` order by `directors`.`FirstName` ;

-- --------------------------------------------------------

--
-- Structure for view `producers_fullname`
--
DROP TABLE IF EXISTS `producers_fullname`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `producers_fullname`  AS  select concat_ws(' ',`producers`.`FirstName`,`producers`.`LastName`) AS `Producers`,`producers`.`ProducerID` AS `ProducerID` from `producers` order by `producers`.`FirstName` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`ActorID`);

--
-- Indexes for table `actor_movie`
--
ALTER TABLE `actor_movie`
  ADD PRIMARY KEY (`Actor_MovieID`),
  ADD KEY `ActorID` (`ActorID`),
  ADD KEY `MovieID` (`MovieID`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`DirectorID`);

--
-- Indexes for table `director_movie`
--
ALTER TABLE `director_movie`
  ADD PRIMARY KEY (`Director_MovieID`),
  ADD KEY `MovieID` (`MovieID`),
  ADD KEY `DirectorID` (`DirectorID`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`DistributorID`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`GenreID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`MovieID`),
  ADD KEY `GenreID` (`GenreID`),
  ADD KEY `DistributorID` (`DistributorID`);

--
-- Indexes for table `movie_rating`
--
ALTER TABLE `movie_rating`
  ADD PRIMARY KEY (`Movie_RatingID`),
  ADD KEY `MovieID` (`MovieID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `producers`
--
ALTER TABLE `producers`
  ADD PRIMARY KEY (`ProducerID`);

--
-- Indexes for table `producer_movie`
--
ALTER TABLE `producer_movie`
  ADD PRIMARY KEY (`Producer_MovieID`),
  ADD KEY `ProducerID` (`ProducerID`),
  ADD KEY `MovieID` (`MovieID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `ActorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `actor_movie`
--
ALTER TABLE `actor_movie`
  MODIFY `Actor_MovieID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `DirectorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `director_movie`
--
ALTER TABLE `director_movie`
  MODIFY `Director_MovieID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `DistributorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `GenreID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `MemberID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `MovieID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `movie_rating`
--
ALTER TABLE `movie_rating`
  MODIFY `Movie_RatingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `producers`
--
ALTER TABLE `producers`
  MODIFY `ProducerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `producer_movie`
--
ALTER TABLE `producer_movie`
  MODIFY `Producer_MovieID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `actor_movie`
--
ALTER TABLE `actor_movie`
  ADD CONSTRAINT `actor_movie_ibfk_1` FOREIGN KEY (`ActorID`) REFERENCES `actors` (`ActorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `actor_movie_ibfk_2` FOREIGN KEY (`MovieID`) REFERENCES `movies` (`MovieID`) ON UPDATE CASCADE;

--
-- Constraints for table `director_movie`
--
ALTER TABLE `director_movie`
  ADD CONSTRAINT `director_movie_ibfk_1` FOREIGN KEY (`MovieID`) REFERENCES `movies` (`MovieID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `director_movie_ibfk_2` FOREIGN KEY (`DirectorID`) REFERENCES `directors` (`DirectorID`) ON UPDATE CASCADE;

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`GenreID`) REFERENCES `genres` (`GenreID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_ibfk_2` FOREIGN KEY (`DistributorID`) REFERENCES `distributors` (`DistributorID`) ON UPDATE CASCADE;

--
-- Constraints for table `movie_rating`
--
ALTER TABLE `movie_rating`
  ADD CONSTRAINT `movie_rating_ibfk_1` FOREIGN KEY (`MovieID`) REFERENCES `movies` (`MovieID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `movie_rating_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `members` (`MemberID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `producer_movie`
--
ALTER TABLE `producer_movie`
  ADD CONSTRAINT `producer_movie_ibfk_1` FOREIGN KEY (`ProducerID`) REFERENCES `producers` (`ProducerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producer_movie_ibfk_2` FOREIGN KEY (`MovieID`) REFERENCES `movies` (`MovieID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
