-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2016 at 06:14 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bird_review`
--

-- --------------------------------------------------------

--
-- Table structure for table `birds`
--

CREATE TABLE `birds` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `_order` varchar(255) NOT NULL,
  `binomial_name` varchar(255) NOT NULL,
  `species` varchar(255) NOT NULL,
  `genus` varchar(255) NOT NULL,
  `family` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `birds`
--

INSERT INTO `birds` (`id`, `name`, `image_url`, `_order`, `binomial_name`, `species`, `genus`, `family`) VALUES
(1, 'Red tailed Hawk Buteo jamaicensis', 'Red-tailed_Hawk_Buteo_jamaicensis_Full_Body_1880px.jpg', ' 	Phaethontiformes', 'Phaethon lepturus', ' 	P. lepturus', 'Tauraco', 'Phaethontidae'),
(2, 'Brushland Tinamou', '745px-Brushland_Tinamou.jpg', ' 	Sphenisciformes', 'Pygoscelis papua', 'B. bubo', ' 	Bubo', 'Strigidae'),
(3, 'Andean Tinamou RWD', 'Andean_Tinamou_RWD.jpg', ' 	Phaethontiformes', 'Tauraco erythrolophus', 'P. papua', 'Tauraco', 'Spheniscidae'),
(4, 'Athene noctua', 'Athene_noctua_(cropped).jpg', 'Strigiformes', 'Bubo bubo', 'T. erythrolophus', 'Pygoscelis', 'Phaethontidae'),
(5, 'California Condor', 'California_Condor.jpg', ' 	Musophagiformes', 'Tauraco erythrolophus', ' 	P. lepturus', 'Phaethon', 'Musophagidae');

-- --------------------------------------------------------

--
-- Table structure for table `bird_review`
--

CREATE TABLE `bird_review` (
  `id` int(11) NOT NULL,
  `birds_id` int(11) NOT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `viewer_key` int(11) NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL,
  `review_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `viewer_email` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bird_review`
--

INSERT INTO `bird_review` (`id`, `birds_id`, `reviewer_name`, `viewer_key`, `review`, `rating`, `review_date`, `viewer_email`) VALUES
(1, 1, 'Nikil Sharma', 4756, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 4, '2016-09-21 20:20:55', 'a@yahoo.com'),
(2, 1, 'jamesh golshign', 2005, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 5, '2016-09-21 20:20:55', 'b@yahoo.com'),
(4, 2, 'Saagar Sharam', 2313, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 4, '2016-09-21 20:20:55', 'd@hotmail.com'),
(5, 3, 'Sumrabin Sharma', 4442, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 3, '2016-09-21 20:20:55', 'e@gmail.com'),
(6, 3, 'Anish lin', 7567, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 2, '2016-09-21 20:20:55', 'f@gmail.com'),
(7, 4, 'alex links', 1222, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 4, '2016-09-21 20:20:55', 'g@yahoo.com'),
(8, 4, 'Spana Kol', 8686, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 5, '2016-09-21 20:20:55', 'h@hotmail.com'),
(12, 5, 'Lorem', 8978, 'this is review', 4, '2016-09-21 20:20:55', 'i@gmail.com'),
(13, 2, 'suman', 4657, 'fasfasdf', 4, '2016-09-21 20:20:55', 'j@yahoo.com'),
(14, 5, 'Test', 7897, 'Hello this is test', 3, '2016-09-21 20:20:55', 'k@yahoo.com'),
(15, 5, 'Rabinn Bhadd', 4567, 'Hello can u hear me ?', 4, '2016-09-21 20:20:55', 'oram@gmail.com'),
(16, 4, 'this is test nam', 4578, 'Hrllo ', 4, '2016-09-21 20:20:55', 'ra@yahoo.com'),
(10, 5, 'Lorem Sharma', 6685, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 5, '2016-09-21 20:20:55', 'lorem@gmail.com'),
(17, 5, 'hello', 4687, 'fjlsakdf', 4, '2016-09-21 20:20:55', 'yupman@gmail.com'),
(18, 1, 'test ', 1234, 'hello this is test', 4, '2016-09-21 23:24:07', 'rabin.bhandari999@gmail.com'),
(19, 1, 'checkjing', 1546, 'checking is checking', 5, '2016-09-21 23:27:56', 'check@gmail.com'),
(20, 1, 'fdsfasdfadsf', 2342, 'checking is checkingdfasdfsaf', 5, '2016-09-21 23:28:23', 'ddcheck@gmail.com'),
(21, 1, 'sir', 5786, 'checking soir', 4, '2016-09-21 23:29:57', 'sir@gmail.com'),
(22, 1, 'Raaa', 7896, 'hellos ', 4, '2016-09-21 23:31:26', 'rab@gmail.com'),
(23, 3, 'Enter Comments', 4768, 'Checking all connection ', 4, '2016-09-21 23:35:13', 'hah@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birds`
--
ALTER TABLE `birds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bird_review`
--
ALTER TABLE `bird_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bird_key` (`birds_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birds`
--
ALTER TABLE `birds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `bird_review`
--
ALTER TABLE `bird_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
