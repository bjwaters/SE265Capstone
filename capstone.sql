-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2018 at 11:30 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `conversation_id` int(11) NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `number_of_hours` int(11) NOT NULL,
  `pay` int(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `conversation_id` int(11) NOT NULL,
  `comment_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `conversation_id` int(10) UNSIGNED NOT NULL,
  `music_id` int(11) NOT NULL,
  `booker_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` int(50) NOT NULL,
  `radius` int(3) NOT NULL,
  `type` varchar(30) NOT NULL,
  `pay` int(5) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `availability` varchar(300) NOT NULL,
  `comments` varchar(1000) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `video_link` varchar(150) NOT NULL,
  `profileStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rater` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `comments` varchar(1000) NOT NULL,
  `time` datetime NOT NULL,
  `resolved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `type`, `created`) VALUES
(2, 'two@two.two', '$2y$10$v4s2lAxvY.Zg.dPQtSBNWuFstvTLawOkarWVQEP1DG.', 'Musician', '2018-01-24 16:13:02'),
(3, 'one@one.one', '$2y$10$P8XRG2VeteaAxwfsH6t5qOe2/3Y257g09kawYkdeI0G', 'Booker', '2018-01-24 16:14:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD KEY `rated` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
