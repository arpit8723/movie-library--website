-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 04:48 PM
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
-- Database: `library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(110) NOT NULL,
  `password` varchar(110) NOT NULL,
  `type` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `type`) VALUES
(1, 'arpitsharma23@gmail.com', '1234', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `issuemovie`
--

CREATE TABLE `issuemovie` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `issuename` varchar(25) NOT NULL,
  `issuemovie` varchar(25) NOT NULL,
  `issuetype` varchar(25) NOT NULL,
  `issuedays` int(11) NOT NULL,
  `issuedate` varchar(25) NOT NULL,
  `issuereturn` varchar(25) NOT NULL,
  `fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuemovie`
--

INSERT INTO `issuemovie` (`id`, `userid`, `issuename`, `issuemovie`, `issuetype`, `issuedays`, `issuedate`, `issuereturn`, `fine`) VALUES
(1, 3, 'hoody', 'Shawshank Redemption', 'student', 2, '18/11/2023', '20/11/2023', 0),
(2, 4, 'ram', 'Shawshank Redemption', 'student', 7, '20/11/2023', '27/11/2023', 0);

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `moviepic` varchar(25) NOT NULL,
  `moviename` varchar(25) NOT NULL,
  `moviedetail` varchar(110) NOT NULL,
  `moviedirector` varchar(25) NOT NULL,
  `movieprod` varchar(25) NOT NULL,
  `country` varchar(110) NOT NULL,
  `movierating` varchar(25) NOT NULL,
  `moviequantity` varchar(25) NOT NULL,
  `movieavail` int(11) NOT NULL,
  `movierent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `moviepic`, `moviename`, `moviedetail`, `moviedirector`, `movieprod`, `country`, `movierating`, `moviequantity`, `movieavail`, `movierent`) VALUES
(1, '1632063.jpg', 'Shawshank Redemption', 'prison drama film', 'Frank Darabont', 'niki marvin', 'hollywood', '9', '20', 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `requestmovie`
--

CREATE TABLE `requestmovie` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `movieid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `usertype` varchar(25) NOT NULL,
  `moviename` varchar(25) NOT NULL,
  `issuedays` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requestmovie`
--

INSERT INTO `requestmovie` (`id`, `userid`, `movieid`, `username`, `usertype`, `moviename`, `issuedays`) VALUES
(1, 3, 1, 'hoody', 'student', 'Shawshank Redemption', '7'),
(2, 3, 1, 'hoody', 'student', 'Shawshank Redemption', '7'),
(3, 3, 1, 'hoody', 'student', 'Shawshank Redemption', '7');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `email` varchar(110) NOT NULL,
  `pass` varchar(110) NOT NULL,
  `type` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `name`, `email`, `pass`, `type`) VALUES
(1, 'arpit', 'arpitsharma23@gmail.com', '1234', 'subscriber'),
(3, 'hoody', '123@gmail.com', '123', 'student'),
(4, 'ram', 'ram@gmail.com', '12345', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuemovie`
--
ALTER TABLE `issuemovie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestmovie`
--
ALTER TABLE `requestmovie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `issuemovie`
--
ALTER TABLE `issuemovie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requestmovie`
--
ALTER TABLE `requestmovie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
