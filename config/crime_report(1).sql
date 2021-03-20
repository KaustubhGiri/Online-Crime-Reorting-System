-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2020 at 09:15 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crime_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `Comp_id` int(11) NOT NULL,
  `Comp_user_id` int(11) NOT NULL,
  `Comp_name` varchar(50) NOT NULL,
  `Comp_type` varchar(30) NOT NULL,
  `Comp_description` varchar(100) NOT NULL,
  `Comp_address` varchar(256) NOT NULL,
  `Comp_date` datetime NOT NULL,
  `Comp_appby_police` int(11) NOT NULL,
  `Comp_status` tinyint(4) NOT NULL,
  `Comp_img1` varchar(256) NOT NULL,
  `Comp_img2` varchar(256) NOT NULL,
  `Comp_video` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`Comp_id`, `Comp_user_id`, `Comp_name`, `Comp_type`, `Comp_description`, `Comp_address`, `Comp_date`, `Comp_appby_police`, `Comp_status`, `Comp_img1`, `Comp_img2`, `Comp_video`) VALUES
(80, 18, 'rahul missing', '2', 'missing from goreagon went to college did not come back one day ago.', '', '2020-11-09 02:46:28', 2, 1, 'Proofs/8108740530/images/dark.png', '', ''),
(82, 18, 'aman missing', '2', 'aman is missing from 2 days', '', '2020-11-10 10:35:02', 2, 1, 'Proofs/8108740530/images/gpgkey.PNG', '', ''),
(84, 18, 'gaurav missing', '2', 'djufbg gnnf g', '', '2020-11-10 10:37:57', 2, 1, 'Proofs/8108740530/images/smtp2go.png', '', ''),
(85, 18, 'bdbf', '1', 'ndnfd ,dkfj', '', '2020-11-10 12:35:02', 0, 0, 'Proofs/8108740530/images/1d3.png', '', ''),
(86, 18, 'bjgoi hnngfh', '1', 'i nghlfmhglohnj m', '', '2020-11-10 12:36:08', 0, 0, '', '', 'Proofs/8108740530/videos/file_example_MP4_640_3MG.mp4'),
(87, 18, 'fgfgfgbj  kj gnhj j h', '2', 'nfjgjf ', '', '2020-11-10 12:45:12', 0, 0, 'Proofs/8108740530/images/tcp.PNG', 'Proofs/8108740530/images/blockdiagram.PNG', 'Proofs/8108740530/videos/file_example_MP4_640_3MG.mp4'),
(88, 18, 'njbj k  kjh jg ', '4', 'nfgjunf  jb vgf', '', '2020-11-10 12:56:01', 0, 0, 'Proofs/8108740530/images/1b.2.PNG', '', ''),
(89, 18, 'jghjh', '1', 'dfgf', '', '2020-11-10 12:59:16', 0, 0, 'Proofs/8108740530/images/Extinction.jpg', '', ''),
(90, 18, 'hjhj', '1', 'hjh', '', '2020-11-10 01:02:32', 0, 0, 'Proofs/8108740530/images/gpgkey.PNG', '', ''),
(91, 18, 'jmj k ', '1', 'nnk gh', '', '2020-11-10 01:04:25', 0, 0, 'Proofs/8108740530/images/cube1.PNG', '', ''),
(92, 18, 'hkgnh ', '1', 'bkmh;lm', '', '2020-11-10 01:10:12', 0, 0, 'Proofs/8108740530/images/cube3.PNG', '', ''),
(135, 18, 'Kaustya', '1', 'nfng  n fhj ghf ', 'fhbgf g gfnjg', '2020-11-11 01:22:13', 0, 0, 'Proofs/8108740530/images/gpgkey.PNG', 'Proofs/8108740530/images/blockdiagram.PNG', 'Proofs/8108740530/videos/file_example_MP4_640_3MG.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fb_id` int(11) NOT NULL,
  `fb_first_name` varchar(256) NOT NULL,
  `fb_last_name` varchar(256) NOT NULL,
  `fb_subject` varchar(256) NOT NULL,
  `fb_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fb_id`, `fb_first_name`, `fb_last_name`, `fb_subject`, `fb_date`) VALUES
(1, 'Ramesh', 'sahu', 'the website is not working welll !!!!', '2020-11-04'),
(2, 'jignesh', 'Singh', 'this is working well on firefox', '2020-11-04'),
(3, 'jignesh', 'Singh', 'this is not working well on chrome', '2020-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `missing`
--

CREATE TABLE `missing` (
  `Miss_id` int(11) NOT NULL,
  `Miss_user_id` int(11) NOT NULL,
  `Miss_name` varchar(50) NOT NULL,
  `Miss_place` varchar(40) NOT NULL,
  `Miss_date` date NOT NULL,
  `Miss_area` varchar(30) NOT NULL,
  `Miss_image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `most_wanted`
--

CREATE TABLE `most_wanted` (
  `mw_id` int(11) NOT NULL,
  `mw_police_id` int(11) NOT NULL,
  `mw_name` varchar(50) NOT NULL,
  `mw_photo` varchar(50) NOT NULL,
  `mw_description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `most_wanted`
--

INSERT INTO `most_wanted` (`mw_id`, `mw_police_id`, `mw_name`, `mw_photo`, `mw_description`) VALUES
(4, 2, 'jitendra singh', 'Mostwanted/ipec2.PNG', 'gfbghfb'),
(6, 2, 'ghj', 'Mostwanted/buzz circuit.PNG', 'hjhg'),
(7, 2, 'rohit singh', 'Mostwanted/cube3.PNG', 'murderer');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `Notice_id` int(11) NOT NULL,
  `Notice_name` varchar(100) NOT NULL,
  `Notice_message` varchar(700) NOT NULL,
  `Notice_by` int(11) NOT NULL,
  `Notice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`Notice_id`, `Notice_name`, `Notice_message`, `Notice_by`, `Notice_date`) VALUES
(5, 'Car Safety', 'Wear seat belts compulsory', 2, '2020-10-15'),
(6, 'Lockdown Notice', 'Lockdown in Mumbai continue til 2021', 2, '2020-10-15'),
(7, 'driving rules', 'You should wear helmet while riding bike else 500 fine ', 2, '2020-10-15');

-- --------------------------------------------------------

--
-- Table structure for table `police`
--

CREATE TABLE `police` (
  `Police_id` int(11) NOT NULL,
  `Police_name` varchar(50) NOT NULL,
  `Police_email` varchar(50) NOT NULL,
  `Police_gender` char(1) NOT NULL,
  `Police_area` varchar(30) NOT NULL,
  `Police_designation` varchar(20) NOT NULL,
  `Police_Phone` decimal(10,0) NOT NULL,
  `Police_password` varchar(256) NOT NULL,
  `Police_photo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`Police_id`, `Police_name`, `Police_email`, `Police_gender`, `Police_area`, `Police_designation`, `Police_Phone`, `Police_password`, `Police_photo`) VALUES
(2, 'Clemen Belly', 'bellclemen18@gmail.com', 'M', 'Nerul', 'Inspector', '8108740530', '2ff48e0da982028ea69679edf1650a74a149706d', ''),
(5, 'Shayan Wangde', 'lalit@gmail.com', 'M', 'Dadar', 'Sub Inspector', '9888888211', 'e1c09ff0ee0ce7dc963b74d7eab9080e49b752e7', 'AdminUser/9888888211/blockdiagram.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `victim`
--

CREATE TABLE `victim` (
  `Victim_id` int(11) NOT NULL,
  `Victim_police_id` int(11) NOT NULL,
  `Victim_email` varchar(50) NOT NULL,
  `Victim_Phoneno` decimal(10,0) NOT NULL,
  `Victim_pass` varchar(128) NOT NULL,
  `Victim_fullname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `victim`
--

INSERT INTO `victim` (`Victim_id`, `Victim_police_id`, `Victim_email`, `Victim_Phoneno`, `Victim_pass`, `Victim_fullname`) VALUES
(17, 0, 'lalit@gmail.com', '9773534579', '69f39fc9d9c7d97c2576bb0aee531b54d11488e2', 'lalit singh'),
(18, 0, 'giriks19dse@student.mes.ac.in', '8108740530', '1dc31001b90b1481b7f8adca00892d02d7240bc2', 'Kaustubh Giri'),
(19, 0, 'sebat59166@faxapdf.com', '8108740882', '50a6f13b4c1ad22487f7d10581d6ab8a33996111', 'shaliesh singh'),
(20, 0, 'dfgf@gmail.com', '9999911111', '1150f48a0068c35beae6f8da1453975e20840ff1\r\n', 'adsdsdsd cddf'),
(21, 0, 'gfgfg@gmail.com', '9773534579', 'd6766ee19dba8b617363a50b581e1d822d986346', 'Ganesh singh'),
(22, 0, 'anushka0302@gmail.com', '1234567890', '1d8a171b179aafd8f30958ea74040d9bcd84ceef', 'anushka lad'),
(23, 0, 'amansingh@gmail.com', '9324629509', '092bc545a3510d41fd064eca4633fa82d2703ac8', 'Aman Singh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`Comp_id`),
  ADD KEY `complaints_ibfk_1` (`Comp_user_id`),
  ADD KEY `Comp_appby_police` (`Comp_appby_police`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fb_id`);

--
-- Indexes for table `missing`
--
ALTER TABLE `missing`
  ADD PRIMARY KEY (`Miss_id`),
  ADD KEY `Miss_user_id` (`Miss_user_id`);

--
-- Indexes for table `most_wanted`
--
ALTER TABLE `most_wanted`
  ADD PRIMARY KEY (`mw_id`),
  ADD KEY `mw_police_id` (`mw_police_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`Notice_id`);

--
-- Indexes for table `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`Police_id`);

--
-- Indexes for table `victim`
--
ALTER TABLE `victim`
  ADD PRIMARY KEY (`Victim_id`),
  ADD KEY `victim_ibfk_1` (`Victim_police_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `Comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `missing`
--
ALTER TABLE `missing`
  MODIFY `Miss_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `most_wanted`
--
ALTER TABLE `most_wanted`
  MODIFY `mw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `Notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `police`
--
ALTER TABLE `police`
  MODIFY `Police_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `victim`
--
ALTER TABLE `victim`
  MODIFY `Victim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`Comp_user_id`) REFERENCES `victim` (`Victim_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `missing`
--
ALTER TABLE `missing`
  ADD CONSTRAINT `missing_ibfk_1` FOREIGN KEY (`Miss_user_id`) REFERENCES `victim` (`Victim_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
