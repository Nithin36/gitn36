-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2019 at 04:18 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faq_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@kinnor.in', 'YWRtaW5uMzY=');

-- --------------------------------------------------------

--
-- Table structure for table `app_category`
--

CREATE TABLE `app_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `home` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_category`
--

INSERT INTO `app_category` (`id`, `category_name`, `image`, `user_id`, `created_at`, `home`) VALUES
(70, '', 'rg4e_gallery6.jpg', '1', '2018-12-11 14:39:13', 'yes'),
(71, 'fgdyh', 'DxJR_gallery4.jpg', '1', '2018-12-11 15:30:00', ' '),
(72, 'uiii', ' ', '1', '2018-12-11 15:34:46', ''),
(73, 'hhh', 'WrQF_.jpg', '1', '2018-12-11 15:46:27', ''),
(74, 'jjj', 'NEUL_gallery2.jpg', '1', '2018-12-11 15:47:21', ''),
(75, '1', ' ', '1', '2018-12-17 14:31:39', ''),
(76, '2', ' ', '1', '2018-12-17 15:09:32', '');

-- --------------------------------------------------------

--
-- Table structure for table `app_faq`
--

CREATE TABLE `app_faq` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_faq`
--

INSERT INTO `app_faq` (`id`, `title`, `description`, `category`) VALUES
(11, 'ddweeeeeddddd', '', 0),
(12, 'fdsfds', '', 0),
(13, 'sdsafdacxvxcgbdc', '', 0),
(14, 'sdsds', '', 0),
(15, 'sdsafd', '', 0),
(16, '345twe', '', 0),
(17, 'r3qr5q3r', '', 0),
(18, 'dddddddddddddd', 'sdfewdsgfdsa', 75);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_category`
--
ALTER TABLE `app_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_faq`
--
ALTER TABLE `app_faq`
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
-- AUTO_INCREMENT for table `app_category`
--
ALTER TABLE `app_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `app_faq`
--
ALTER TABLE `app_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
