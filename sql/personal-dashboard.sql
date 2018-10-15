-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2018 at 11:11 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personal-dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `image_id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `uploaded_on` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`image_id`, `file_name`, `uploaded_on`) VALUES
(1, 'download.jpg', '2018-10-12 00:59:33'),
(2, 'download1.jpg', '2018-10-12 00:59:38'),
(3, 'download2.jpg', '2018-10-12 00:59:46'),
(4, 'download3.jpg', '2018-10-12 00:59:46'),
(5, 'image.jpg', '2018-10-12 01:00:01'),
(6, 'images.jpg', '2018-10-12 01:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `task_name` varchar(250) NOT NULL,
  `task_status` tinyint(1) DEFAULT NULL,
  `task_created_on` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `task_name`, `task_status`, `task_created_on`) VALUES
(1, 'This is a test task one', 1, ''),
(2, 'Test task number two', 0, ''),
(3, 'sample task one', 1, ''),
(4, 'Checking task one', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `photopath` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `emailid`, `password`, `photo`, `photopath`) VALUES
(1, 'sneha', 'sneha@sneha.com', 'e10adc3949ba59abbe56e057f20f883e', '', ''),
(2, 'teijin', 'tt@kk.com', 'e10adc3949ba59abbe56e057f20f883e', '', ''),
(3, 'dsdfds', '123456', '426677e865186e5ad4d11119e1ebff10', '', ''),
(4, 'eee', '12', 'ad57484016654da87125db86f4227ea3', '', ''),
(5, 'tt', 'qq', '36eba1e1e343279857ea7f69a597324e', '', ''),
(6, 'fsdfdsf', '121', '3069e3bf88673be572acdb43c9aac33e', '', ''),
(7, 'tia', 'tia', 'c20ad4d76fe97759aa27a0c99bff6710', '', ''),
(8, 'kjkjk', 'ooo', '412566367c67448b599d1b7666f8ccfc', '', ''),
(9, 'kjkjlllll', 'kkkkkkkkkkkk', '771f01104d905386a134a676167edccc', 'lklk', ''),
(10, 'ala', 'ala', 'c20ad4d76fe97759aa27a0c99bff6710', '18424019_1451690524905540_4749970192356351610_n.jpg', ''),
(11, 'mnm', 'mnm', 'c3d6ebaec84ae7a23309342eb5d6b225', '18424019_1451690524905540_4749970192356351610_n.jpg', ''),
(12, 'test', 'test', '098f6bcd4621d373cade4e832627b4f6', '18424019_1451690524905540_4749970192356351610_n.jpg', ''),
(13, 'mia', 'mia', '5102ecd3d47f6561de70979017b87a80', '18424019_1451690524905540_4749970192356351610_n.jpg', ''),
(14, 'test123', 'test123', 'cc03e747a6afbbcbf8be7668acfebee5', 'download.jpg', ''),
(15, 'tez', 'tez', '3546f4f788b7dae54f896f9a03ce6231', 'download.jpg', ''),
(16, 'kk', 'kk', 'dc468c70fb574ebd07287b38d0d0676d', 'download2.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `emailid` (`emailid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
