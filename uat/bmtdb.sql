-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2016 at 03:52 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bmtdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_account_types`
--

CREATE TABLE IF NOT EXISTS `bank_account_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ac_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bank_account_types`
--

INSERT INTO `bank_account_types` (`id`, `ac_type`) VALUES
(1, 'Savings'),
(2, 'Current');

-- --------------------------------------------------------

--
-- Table structure for table `beacons`
--

CREATE TABLE IF NOT EXISTS `beacons` (
  `beacon_id` int(10) NOT NULL AUTO_INCREMENT,
  `tc_id` int(10) NOT NULL,
  `uuid` varchar(250) NOT NULL,
  `major_id` varchar(10) NOT NULL,
  `minor_id` varchar(10) NOT NULL,
  `entry_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`beacon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `beacons`
--

INSERT INTO `beacons` (`beacon_id`, `tc_id`, `uuid`, `major_id`, `minor_id`, `entry_type`) VALUES
(1, 1, 'B9407F30-F5F8-466E-AFF9-25556B57FE6D', '44441', '44442', 'out'),
(2, 1, 'B9407F30-F5F8-466E-AFF9-25556B57FE6D', '55551', '55552', 'in'),
(4, 8, 'B9407F30-F5F8-466E-AFF9-25556B57FE6D', '50', '45653', 'in'),
(5, 8, 'B9407F30-F5F8-466E-AFF9-25556B57FE6D', '23125', '29200', 'out'),
(6, 9, 'B9407F30-F5F8-466E-AFF9-25556B57FE6D', '8', '7777', 'in'),
(7, 9, 'B9407F30-F5F8-466E-AFF9-25556B57FE6D', '4572', '60853', 'out');

-- --------------------------------------------------------

--
-- Table structure for table `beacon_mapping`
--

CREATE TABLE IF NOT EXISTS `beacon_mapping` (
  `beacon_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `beacon_id` int(11) DEFAULT NULL,
  `mobile_device_id` varchar(250) DEFAULT NULL,
  `entry_type` varchar(10) DEFAULT NULL,
  `added_date` datetime DEFAULT NULL,
  PRIMARY KEY (`beacon_map_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `beacon_mapping`
--

INSERT INTO `beacon_mapping` (`beacon_map_id`, `beacon_id`, `mobile_device_id`, `entry_type`, `added_date`) VALUES
(1, 2, 'cnJzVU-AXuo:APA91bHtppDR59hbJAg7zQjNDjCWE-tocpMzCQ7SFm2Mn5IPys2u0Y5EKcvdiSxoquaG1OAdjq0EmyNq56LoBdvu0nW7ZiFC7sHIMQbuIYB7kI3kxPszq6M-0P3IVkujCVVty9luESoc', 'in', '2016-04-14 17:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `bmt_bank_details`
--

CREATE TABLE IF NOT EXISTS `bmt_bank_details` (
  `bank_id` int(10) NOT NULL AUTO_INCREMENT,
  `assigned_id` varchar(20) NOT NULL,
  `tc_id` varchar(20) NOT NULL,
  `bank_name` varchar(30) NOT NULL,
  `bank_address` varchar(50) NOT NULL,
  `type_of_account` varchar(15) NOT NULL,
  `ac_name` varchar(20) NOT NULL,
  `ac_number` bigint(20) NOT NULL,
  `ifsc_code` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL,
  `status_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bmt_bank_details`
--

INSERT INTO `bmt_bank_details` (`bank_id`, `assigned_id`, `tc_id`, `bank_name`, `bank_address`, `type_of_account`, `ac_name`, `ac_number`, `ifsc_code`, `created_date`, `status_flag`) VALUES
(1, '1', '5', 'VIJAYA BANK', 'SRINAGAR COLONY', '1', 'HYDVJATOLL!', 5064673809, 'VJA2345', '2016-02-14 13:38:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bmt_lanes`
--

CREATE TABLE IF NOT EXISTS `bmt_lanes` (
  `lane_id` int(10) NOT NULL AUTO_INCREMENT,
  `tc_id` int(10) NOT NULL,
  `lane_number` int(10) DEFAULT NULL,
  `way_type` tinyint(1) NOT NULL COMMENT '1=from,2=to',
  `created_date` datetime NOT NULL,
  `status_flag` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=active,1=inactive',
  `user_selsect_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lane_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;

--
-- Dumping data for table `bmt_lanes`
--

INSERT INTO `bmt_lanes` (`lane_id`, `tc_id`, `lane_number`, `way_type`, `created_date`, `status_flag`, `user_selsect_status`) VALUES
(71, 3, 1, 1, '2016-01-06 18:19:16', 0, 1),
(72, 3, 2, 1, '2016-01-06 18:19:16', 1, 0),
(73, 3, 3, 1, '2016-01-06 18:19:16', 1, 0),
(74, 3, 4, 1, '2016-01-06 18:19:16', 1, 0),
(75, 3, 1, 2, '2016-01-06 18:19:16', 1, 0),
(76, 3, 2, 2, '2016-01-06 18:19:16', 0, 1),
(77, 3, 3, 2, '2016-01-06 18:19:16', 1, 0),
(78, 3, 4, 2, '2016-01-06 18:19:16', 1, 0),
(85, 4, 1, 1, '2016-01-06 22:49:24', 1, 0),
(86, 4, 2, 1, '2016-01-06 22:49:24', 0, 0),
(87, 4, 3, 1, '2016-01-06 22:49:24', 1, 0),
(88, 4, 4, 1, '2016-01-06 22:49:24', 1, 0),
(89, 4, 1, 2, '2016-01-06 22:49:24', 1, 0),
(90, 4, 2, 2, '2016-01-06 22:49:24', 1, 0),
(91, 4, 3, 2, '2016-01-06 22:49:24', 0, 0),
(92, 4, 4, 2, '2016-01-06 22:49:24', 1, 0),
(113, 1, 1, 1, '2016-01-07 11:29:50', 0, 1),
(114, 1, 2, 1, '2016-01-07 11:29:50', 0, 0),
(115, 1, 1, 2, '2016-01-07 11:29:50', 0, 0),
(116, 1, 2, 2, '2016-01-07 11:29:50', 0, 0),
(123, 2, 1, 1, '2016-01-22 12:19:27', 0, 0),
(124, 2, 2, 1, '2016-01-22 12:19:27', 0, 0),
(125, 2, 3, 1, '2016-01-22 12:19:27', 0, 0),
(126, 2, 1, 2, '2016-01-22 12:19:27', 0, 0),
(127, 2, 2, 2, '2016-01-22 12:19:27', 0, 0),
(128, 2, 3, 2, '2016-01-22 12:19:27', 0, 0),
(129, 5, 1, 1, '2016-02-14 13:28:49', 0, 0),
(130, 5, 2, 1, '2016-02-14 13:28:49', 1, 0),
(131, 5, 3, 1, '2016-02-14 13:28:49', 1, 0),
(132, 5, 4, 1, '2016-02-14 13:28:49', 1, 0),
(133, 5, 5, 1, '2016-02-14 13:28:49', 1, 0),
(134, 5, 6, 1, '2016-02-14 13:28:49', 1, 0),
(135, 5, 1, 2, '2016-02-14 13:28:49', 1, 0),
(136, 5, 2, 2, '2016-02-14 13:28:49', 1, 0),
(137, 5, 3, 2, '2016-02-14 13:28:49', 1, 0),
(138, 5, 4, 2, '2016-02-14 13:28:49', 0, 0),
(139, 5, 5, 2, '2016-02-14 13:28:49', 1, 0),
(140, 5, 6, 2, '2016-02-14 13:28:49', 1, 0),
(141, 6, 1, 1, '2016-02-16 15:13:03', 1, 0),
(142, 6, 2, 1, '2016-02-16 15:13:03', 1, 0),
(143, 6, 3, 1, '2016-02-16 15:13:03', 1, 0),
(144, 6, 4, 1, '2016-02-16 15:13:03', 1, 0),
(145, 6, 1, 2, '2016-02-16 15:13:03', 1, 0),
(146, 6, 2, 2, '2016-02-16 15:13:03', 1, 0),
(147, 6, 3, 2, '2016-02-16 15:13:03', 1, 0),
(148, 6, 4, 2, '2016-02-16 15:13:03', 1, 0),
(165, 7, 1, 1, '2016-04-06 11:54:18', 1, 0),
(166, 7, 2, 1, '2016-04-06 11:54:18', 1, 0),
(167, 7, 3, 1, '2016-04-06 11:54:18', 1, 0),
(168, 7, 4, 1, '2016-04-06 11:54:18', 1, 0),
(169, 7, 1, 2, '2016-04-06 11:54:18', 1, 0),
(170, 7, 2, 2, '2016-04-06 11:54:18', 1, 0),
(171, 7, 3, 2, '2016-04-06 11:54:18', 1, 0),
(172, 7, 4, 2, '2016-04-06 11:54:18', 1, 0),
(203, 8, 1, 1, '2016-04-14 15:09:55', 0, 0),
(204, 8, 2, 1, '2016-04-14 15:09:55', 1, 0),
(205, 8, 3, 1, '2016-04-14 15:09:55', 1, 0),
(206, 8, 4, 1, '2016-04-14 15:09:55', 1, 0),
(207, 8, 5, 1, '2016-04-14 15:09:55', 1, 0),
(208, 8, 1, 2, '2016-04-14 15:09:55', 0, 0),
(209, 8, 2, 2, '2016-04-14 15:09:55', 1, 0),
(210, 8, 3, 2, '2016-04-14 15:09:55', 1, 0),
(211, 8, 4, 2, '2016-04-14 15:09:55', 1, 0),
(212, 8, 5, 2, '2016-04-14 15:09:55', 1, 0),
(213, 9, 1, 1, '2016-04-14 15:10:56', 0, 1),
(214, 9, 2, 1, '2016-04-14 15:10:56', 1, 0),
(215, 9, 3, 1, '2016-04-14 15:10:56', 1, 0),
(216, 9, 4, 1, '2016-04-14 15:10:56', 1, 0),
(217, 9, 5, 1, '2016-04-14 15:10:56', 1, 0),
(218, 9, 1, 2, '2016-04-14 15:10:56', 0, 0),
(219, 9, 2, 2, '2016-04-14 15:10:56', 1, 0),
(220, 9, 3, 2, '2016-04-14 15:10:56', 1, 0),
(221, 9, 4, 2, '2016-04-14 15:10:56', 1, 0),
(222, 9, 5, 2, '2016-04-14 15:10:56', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bmt_lane_mapping`
--

CREATE TABLE IF NOT EXISTS `bmt_lane_mapping` (
  `mapping_id` int(11) NOT NULL AUTO_INCREMENT,
  `ts_id` int(11) NOT NULL,
  `tc_id` int(11) NOT NULL,
  `lane_id` int(11) NOT NULL,
  `way_type` int(1) NOT NULL,
  UNIQUE KEY `mapping_id_2` (`mapping_id`),
  KEY `mapping_id` (`mapping_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `bmt_lane_mapping`
--

INSERT INTO `bmt_lane_mapping` (`mapping_id`, `ts_id`, `tc_id`, `lane_id`, `way_type`) VALUES
(5, 8, 1, 113, 1),
(8, 28, 9, 213, 1);

-- --------------------------------------------------------

--
-- Table structure for table `latlng`
--

CREATE TABLE IF NOT EXISTS `latlng` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tc_id` int(10) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `way` tinyint(1) NOT NULL COMMENT '1=from,2=to',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `latlng`
--

INSERT INTO `latlng` (`id`, `tc_id`, `lat`, `lng`, `way`) VALUES
(1, 2, 17.451548, 78.388733, 1),
(2, 2, 17.451494, 78.389412, 2),
(3, 5, 0.000000, 0.000000, 1),
(4, 5, 17.232727, 78.960571, 2),
(5, 6, 17.232912, 78.960289, 1),
(6, 6, 17.232838, 78.960709, 2),
(7, 1, 17.436800, 78.443901, 1),
(8, 1, 17.416500, 78.438202, 2),
(9, 7, 17.401218, 78.558914, 1),
(10, 7, 17.401457, 78.561661, 2),
(11, 8, 0.000000, 0.000000, 1),
(12, 8, 0.000000, 0.000000, 2),
(13, 9, 0.000000, 0.000000, 1),
(14, 9, 0.000000, 0.000000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `transaction_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `tracking_id`, `order_status`, `amount`, `transaction_date`) VALUES
(1, '1', 3, '305002664663', 'Success', 101, '2016-01-06 16:20:00'),
(2, '2', 3, '305002664676', 'Success', 201, '2016-01-06 16:27:28'),
(3, '3', 3, '305002664687', 'Success', 201, '2016-01-06 16:33:40'),
(4, '5', 7, '305002664722', 'Success', 101, '2016-01-06 16:59:12'),
(5, '4', 8, '305002664723', 'Success', 101, '2016-01-06 16:59:32'),
(6, '6', 9, '305002664734', 'Success', 101, '2016-01-06 17:06:46'),
(7, '7', 7, '305002664738', 'Success', 201, '2016-01-06 17:09:25'),
(8, '8', 8, '305002664739', 'Success', 201, '2016-01-06 17:10:32'),
(9, '9', 7, '305002664749', 'Success', 201, '2016-01-06 17:18:03'),
(10, '11', 10, '305002664765', 'Success', 101, '2016-01-06 17:33:05'),
(11, '10', 6, '305002664766', 'Success', 101, '2016-01-06 17:33:07'),
(12, '12', 10, '305002664767', 'Success', 201, '2016-01-06 17:34:31'),
(13, '13', 10, '305002664901', 'Success', 101, '2016-01-06 23:06:43'),
(14, '14', 10, '305002664902', 'Success', 51, '2016-01-06 23:09:23'),
(15, '15', 10, '305002664906', 'Success', 81, '2016-01-06 23:31:32'),
(16, '17', 12, '305002665079', 'Success', 101, '2016-01-07 12:53:40'),
(17, '16', 8, '305002665093', 'Success', 101, '2016-01-07 13:05:16'),
(18, '19', 8, '305002665110', 'Success', 101, '2016-01-07 13:15:43'),
(19, '20', 13, '305002665117', 'Success', 101, '2016-01-07 13:26:41'),
(20, '18', 3, '305002665595', 'Success', 101, '2016-01-08 10:58:14'),
(21, '22', 3, '305002665610', 'Success', 201, '2016-01-08 11:18:38'),
(22, '27', 5, '305002705554', 'Success', 101, '2016-03-09 12:02:02'),
(23, '28', 8, '305002705630', 'Success', 101, '2016-03-09 13:16:55'),
(24, '33', 22, '305002707718', 'Success', 11, '2016-03-11 16:24:49'),
(25, '35', 23, '305002710128', 'Success', 101, '2016-03-15 14:46:07'),
(26, '36', 24, '305002710156', 'Success', 101, '2016-03-15 15:08:54'),
(27, '37', 24, '305002710253', 'Success', 101, '2016-03-15 16:09:53'),
(28, '38', 25, '305002710262', 'Success', 11, '2016-03-15 16:16:53'),
(29, '29', 8, '305002712396', 'Success', 101, '2016-03-18 11:45:38'),
(30, '39', 28, '305002716876', 'Success', 101, '2016-03-25 17:42:15'),
(31, '41', 8, '305002722202', 'Success', 101, '2016-04-04 10:30:07'),
(32, '42', 8, '305002722291', 'Success', 201, '2016-04-04 11:33:15'),
(33, '43', 8, '305002722914', 'Success', 201, '2016-04-04 17:44:29'),
(34, '44', 8, '305002722932', 'Success', 201, '2016-04-04 17:54:18'),
(35, '45', 8, '305002722966', 'Success', 201, '2016-04-04 18:24:17'),
(36, '50', 5, '305002723906', 'Success', 101, '2016-04-05 17:58:00'),
(37, '54', 30, '305002724239', 'Success', 101, '2016-04-06 10:48:51'),
(38, '55', 30, '305002724253', 'Success', 201, '2016-04-06 10:59:44'),
(39, '56', 30, '305002724267', 'Success', 201, '2016-04-06 11:10:29'),
(40, '60', 5, '305002724296', 'Success', 101, '2016-04-06 11:21:22'),
(41, '62', 5, '305002724421', 'Success', 201, '2016-04-06 12:21:05'),
(42, '64', 31, '305002724656', 'Success', 101, '2016-04-06 14:46:48'),
(43, '71', 7, '305002732186', 'Success', 101, '2016-04-17 17:31:40'),
(44, '72', 7, '305002732200', 'Success', 201, '2016-04-17 18:17:38'),
(45, '74', 7, '305002732216', 'Success', 201, '2016-04-17 20:19:37'),
(46, '76', 33, '305002732218', 'Success', 101, '2016-04-17 20:28:00'),
(47, '77', 33, '305002732220', 'Success', 201, '2016-04-17 20:42:20'),
(48, '73', 33, '305002732250', 'Success', 101, '2016-04-18 08:03:12'),
(49, '79', 34, '305002732256', 'Success', 101, '2016-04-18 09:17:09'),
(50, '80', 34, '305002732258', 'Success', 201, '2016-04-18 09:27:59'),
(51, '82', 34, '305002732266', 'Success', 201, '2016-04-18 09:40:05'),
(52, '83', 34, '305002732270', 'Success', 201, '2016-04-18 09:50:25'),
(53, '84', 34, '305002732542', 'Success', 201, '2016-04-18 13:33:27'),
(54, '87', 36, '305002732717', 'Success', 101, '2016-04-18 15:45:46'),
(55, '88', 34, '305002732724', 'Success', 201, '2016-04-18 15:55:09'),
(56, '89', 7, '305002733034', 'Success', 101, '2016-04-18 19:41:47'),
(57, '91', 7, '305002733845', 'Success', 101, '2016-04-19 17:40:46'),
(58, '92', 7, '305002733862', 'Success', 201, '2016-04-19 17:47:02'),
(59, '93', 33, '305002737140', 'Success', 101, '2016-04-25 00:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `push_status`
--

CREATE TABLE IF NOT EXISTS `push_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` varchar(20) DEFAULT NULL,
  `msg_type` int(1) NOT NULL COMMENT '1=welcome,2=vechicle availability(defaulr or no vehicle),3=bmt lane,4= lane number,5=transaction comleted,6=send success to beacon',
  `date_sent` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2211 ;

--
-- Dumping data for table `push_status`
--

INSERT INTO `push_status` (`id`, `tc_id`, `user_id`, `vehicle_id`, `msg_type`, `date_sent`) VALUES
(1, 8, 30, NULL, 2, '2016-04-14 19:05:58'),
(2, 1, 30, NULL, 1, '2016-04-14 19:06:01'),
(3, 8, 7, NULL, 2, '2016-04-14 19:06:11'),
(4, 9, 30, NULL, 2, '2016-04-14 19:06:12'),
(5, 9, 7, NULL, 2, '2016-04-14 19:06:17'),
(6, 9, 32, NULL, 2, '2016-04-14 19:06:18'),
(7, 1, 32, NULL, 1, '2016-04-14 19:06:33'),
(8, 8, 32, NULL, 2, '2016-04-14 19:07:02'),
(9, 1, 32, NULL, 3, '2016-04-14 19:07:28'),
(10, 1, 30, NULL, 3, '2016-04-14 19:07:48'),
(11, 1, 7, NULL, 2, '2016-04-14 19:10:00'),
(13, 1, 30, NULL, 6, '2016-04-14 19:16:21'),
(2022, 1, 32, NULL, 6, '2016-04-15 09:58:43'),
(2023, 8, 5, NULL, 2, '2016-04-17 14:17:52'),
(2024, 9, 5, NULL, 2, '2016-04-17 14:18:07'),
(2025, 1, 5, NULL, 1, '2016-04-17 14:20:24'),
(2118, 2, 7, NULL, 2, '2016-04-17 17:24:33'),
(2119, 2, 7, NULL, 1, '2016-04-17 17:26:23'),
(2120, 2, 7, NULL, 3, '2016-04-17 17:26:23'),
(2121, 1, 7, NULL, 1, '2016-04-17 17:26:58'),
(2127, 1, 5, NULL, 6, '2016-04-17 17:35:04'),
(2131, 1, 33, NULL, 1, '2016-04-17 20:06:44'),
(2135, 8, 33, NULL, 2, '2016-04-17 20:10:35'),
(2136, 9, 33, NULL, 2, '2016-04-17 20:13:40'),
(2137, 1, 33, NULL, 2, '2016-04-17 20:14:45'),
(2158, 9, 34, NULL, 2, '2016-04-18 09:15:25'),
(2159, 1, 34, NULL, 1, '2016-04-18 09:16:26'),
(2162, 1, 34, NULL, 2, '2016-04-18 09:18:44'),
(2167, 8, 34, NULL, 2, '2016-04-18 09:56:24'),
(2168, 9, 35, NULL, 2, '2016-04-18 13:30:34'),
(2169, 1, 35, NULL, 1, '2016-04-18 13:32:30'),
(2178, 1, 35, NULL, 6, '2016-04-18 13:38:15'),
(2179, 1, 36, NULL, 1, '2016-04-18 15:41:36'),
(2194, 1, 36, NULL, 6, '2016-04-18 15:43:54'),
(2196, 1, 36, NULL, 2, '2016-04-18 15:49:35'),
(2200, 9, 36, NULL, 2, '2016-04-18 15:51:42'),
(2206, 1, 34, NULL, 6, '2016-04-19 12:46:33'),
(2208, 1, 7, NULL, 6, '2016-04-19 17:46:40'),
(2210, 1, 33, NULL, 6, '2016-04-25 00:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `ringroad`
--

CREATE TABLE IF NOT EXISTS `ringroad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `major` int(20) NOT NULL,
  `minor` int(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4928 ;

--
-- Dumping data for table `ringroad`
--

INSERT INTO `ringroad` (`id`, `major`, `minor`, `status`, `user_id`) VALUES
(2614, 4572, 60853, 1, 35),
(2615, 4572, 60853, 1, 35),
(2616, 4572, 60853, 1, 35),
(3640, 55551, 55552, 1, 36),
(4087, 8, 7777, 1, 34),
(4088, 8, 7777, 1, 34),
(4089, 8, 7777, 1, 34),
(4090, 8, 7777, 1, 34),
(4091, 8, 7777, 1, 34),
(4092, 8, 7777, 1, 34),
(4093, 8, 7777, 1, 34),
(4094, 8, 7777, 1, 34),
(4095, 8, 7777, 1, 34),
(4096, 8, 7777, 1, 34),
(4097, 8, 7777, 1, 34),
(4098, 8, 7777, 1, 34),
(4099, 8, 7777, 1, 34),
(4100, 8, 7777, 1, 34),
(4101, 8, 7777, 1, 34),
(4102, 8, 7777, 1, 34),
(4103, 8, 7777, 1, 34),
(4104, 8, 7777, 1, 34),
(4105, 8, 7777, 1, 34),
(4106, 8, 7777, 1, 34),
(4107, 8, 7777, 1, 34),
(4108, 8, 7777, 1, 34),
(4109, 8, 7777, 1, 34),
(4110, 8, 7777, 1, 34),
(4111, 8, 7777, 1, 34),
(4112, 8, 7777, 1, 34),
(4113, 8, 7777, 1, 34),
(4114, 8, 7777, 1, 34),
(4115, 8, 7777, 1, 34),
(4116, 8, 7777, 1, 34),
(4117, 8, 7777, 1, 34),
(4118, 8, 7777, 1, 34),
(4119, 8, 7777, 1, 34),
(4120, 8, 7777, 1, 34),
(4121, 8, 7777, 1, 34),
(4128, 8, 7777, 1, 34),
(4129, 8, 7777, 1, 34),
(4130, 8, 7777, 1, 34),
(4131, 8, 7777, 1, 34),
(4132, 8, 7777, 1, 34),
(4133, 8, 7777, 1, 34),
(4134, 8, 7777, 1, 34),
(4135, 8, 7777, 1, 34),
(4136, 8, 7777, 1, 34),
(4144, 8, 7777, 1, 34),
(4145, 8, 7777, 1, 34),
(4146, 8, 7777, 1, 34),
(4147, 8, 7777, 1, 34),
(4148, 8, 7777, 1, 34),
(4149, 8, 7777, 1, 34),
(4150, 8, 7777, 1, 34),
(4151, 8, 7777, 1, 34),
(4152, 8, 7777, 1, 34),
(4153, 8, 7777, 1, 34),
(4154, 8, 7777, 1, 34),
(4155, 8, 7777, 1, 34),
(4156, 8, 7777, 1, 34),
(4157, 8, 7777, 1, 34),
(4158, 8, 7777, 1, 34),
(4159, 8, 7777, 1, 34),
(4160, 8, 7777, 1, 34),
(4184, 8, 7777, 1, 34),
(4186, 8, 7777, 1, 34),
(4189, 8, 7777, 1, 34),
(4190, 8, 7777, 1, 34),
(4206, 8, 7777, 1, 34),
(4207, 8, 7777, 1, 34),
(4208, 8, 7777, 1, 34),
(4209, 8, 7777, 1, 34),
(4210, 8, 7777, 1, 34),
(4211, 8, 7777, 1, 34),
(4212, 8, 7777, 1, 34),
(4214, 8, 7777, 1, 34),
(4215, 8, 7777, 1, 34),
(4216, 8, 7777, 1, 34),
(4217, 8, 7777, 1, 34),
(4218, 8, 7777, 1, 34),
(4219, 8, 7777, 1, 34),
(4220, 8, 7777, 1, 34),
(4221, 8, 7777, 1, 34),
(4222, 8, 7777, 1, 34),
(4223, 8, 7777, 1, 34),
(4224, 8, 7777, 1, 34),
(4227, 8, 7777, 1, 34),
(4228, 8, 7777, 1, 34),
(4232, 8, 7777, 1, 34),
(4233, 8, 7777, 1, 34),
(4234, 8, 7777, 1, 34),
(4238, 8, 7777, 1, 34),
(4239, 8, 7777, 1, 34),
(4240, 8, 7777, 1, 34),
(4243, 8, 7777, 1, 34),
(4244, 8, 7777, 1, 34),
(4246, 8, 7777, 1, 34),
(4247, 8, 7777, 1, 34),
(4248, 8, 7777, 1, 34),
(4252, 8, 7777, 1, 34),
(4253, 8, 7777, 1, 34),
(4255, 8, 7777, 1, 34),
(4258, 8, 7777, 1, 34),
(4259, 8, 7777, 1, 34),
(4262, 8, 7777, 1, 34),
(4264, 8, 7777, 1, 34),
(4413, 8, 7777, 1, 34),
(4414, 8, 7777, 1, 34),
(4417, 8, 7777, 1, 34),
(4423, 8, 7777, 1, 34),
(4426, 8, 7777, 1, 34),
(4427, 8, 7777, 1, 34),
(4429, 8, 7777, 1, 34),
(4431, 8, 7777, 1, 34),
(4434, 8, 7777, 1, 34),
(4435, 8, 7777, 1, 34),
(4437, 8, 7777, 1, 34),
(4439, 8, 7777, 1, 34),
(4441, 8, 7777, 1, 34),
(4443, 8, 7777, 1, 34),
(4446, 8, 7777, 1, 34),
(4447, 8, 7777, 1, 34),
(4449, 8, 7777, 1, 34),
(4450, 8, 7777, 1, 34),
(4453, 8, 7777, 1, 34),
(4455, 8, 7777, 1, 34),
(4456, 8, 7777, 1, 34),
(4459, 8, 7777, 1, 34),
(4461, 8, 7777, 1, 34),
(4462, 8, 7777, 1, 34),
(4464, 8, 7777, 1, 34),
(4466, 8, 7777, 1, 34),
(4468, 8, 7777, 1, 34),
(4469, 8, 7777, 1, 34),
(4471, 8, 7777, 1, 34),
(4475, 8, 7777, 1, 34),
(4476, 8, 7777, 1, 34),
(4477, 8, 7777, 1, 34),
(4480, 8, 7777, 1, 34),
(4481, 8, 7777, 1, 34),
(4483, 8, 7777, 1, 34),
(4900, 4572, 60853, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(1) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Semi Admin'),
(4, 'Toll Operator');

-- --------------------------------------------------------

--
-- Table structure for table `toll_center`
--

CREATE TABLE IF NOT EXISTS `toll_center` (
  `tc_id` int(10) NOT NULL AUTO_INCREMENT,
  `assigned_id` varchar(30) NOT NULL,
  `tc_name` varchar(30) NOT NULL,
  `tc_location` varchar(30) NOT NULL,
  `from_way_beacon_id` varchar(20) DEFAULT NULL,
  `to_way_beacon_id` varchar(20) DEFAULT NULL,
  `from_way_no_of_lanes` int(10) NOT NULL,
  `from_way_no_of_bmt_lanes` varchar(50) NOT NULL,
  `tc_created_date` datetime NOT NULL,
  `status_flag` tinyint(1) NOT NULL DEFAULT '1',
  `from_way_location` varchar(20) NOT NULL,
  `to_way_location` varchar(20) NOT NULL,
  `to_way_no_of_lanes` int(10) NOT NULL,
  `to_way_no_of_bmt_lanes` varchar(50) NOT NULL,
  `image_url` varchar(250) DEFAULT NULL,
  `lat` float DEFAULT '0',
  `lng` float DEFAULT '0',
  `to_lat` float DEFAULT NULL,
  `to_lag` float DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`tc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `toll_center`
--

INSERT INTO `toll_center` (`tc_id`, `assigned_id`, `tc_name`, `tc_location`, `from_way_beacon_id`, `to_way_beacon_id`, `from_way_no_of_lanes`, `from_way_no_of_bmt_lanes`, `tc_created_date`, `status_flag`, `from_way_location`, `to_way_location`, `to_way_no_of_lanes`, `to_way_no_of_bmt_lanes`, `image_url`, `lat`, `lng`, `to_lat`, `to_lag`, `address`) VALUES
(1, '1', 'Taya', 'Madhapur', '1', '2', 2, '2', '2016-01-06 14:49:20', 0, 'Panjagutta', 'Jubilee Hills', 2, '2', 'http://bookmytoll.com/uploads/documents/1452076379doc.jpeg', 17.4368, 78.4439, 17.4165, 78.4382, ''),
(2, '1', 'Taya-Hyd', 'Taya Technologies', NULL, NULL, 3, '1', '2016-01-06 15:26:45', 0, 'North', 'East', 3, '1', 'http://www.bookmytoll.com/uploads/documents/1452075309.0.pdf', 17.4515, 78.3887, 17.4515, 78.3894, 'Taya Technologies Pvt Ltd, Ayyappa Society Main Road, Madhapur, Hyderabad, Telangana, India'),
(3, '1', 'Yelahanka', 'Bangalore', NULL, NULL, 4, '1', '2016-01-06 17:43:03', 0, 'Hyderabad', 'Hebbal', 4, '1', '', 0, 0, NULL, NULL, ''),
(4, '1', 'Suryapet', 'Kodad', NULL, NULL, 4, '1', '2016-01-06 22:49:24', 0, 'Hyderabad', 'Vijayawada', 4, '1', '', 0, 0, NULL, NULL, ''),
(5, '1', 'PANTHANGI', 'HYD-VJA TOLL 1', NULL, NULL, 6, '1', '2016-02-14 13:28:49', 0, 'Hyderabad', 'Vijayawada', 6, '1', '', 0, 0, 17.2327, 78.9606, ''),
(6, '1', 'GMRTOLL1', 'Panthangi', NULL, NULL, 4, '1', '2016-02-16 15:13:03', 0, 'Hyderabad', 'Vijayawada', 4, '1', '', 17.2329, 78.9603, 17.2328, 78.9607, 'Panthangi Toll Plaza - GMR Hyderabad - Vijayawada Expressway, National Highway 9, Lingoji Guda, Telangana, India'),
(7, '1', 'uppal', 'uppal', '2', '3', 4, '2', '2016-04-06 11:51:47', 0, 'uppa', 'hyd', 4, '1', '', 17.4012, 78.5589, 17.4015, 78.5617, 'Hitech City, Hyderabad, Telangana, India'),
(8, '1', 'gachibowli', 'gachibowli', '5', '5', 5, '1', '2016-04-14 14:57:27', 0, 'GBEntry', 'GBExit', 5, '1', '', 0, 0, 0, 0, ''),
(9, '1', 'shamshabad', 'shamshabad', '6', '7', 5, '1', '2016-04-14 15:05:44', 0, 'shamshabadEntry', 'ShamshabadExit', 5, '2', '', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `toll_charge`
--

CREATE TABLE IF NOT EXISTS `toll_charge` (
  `tcharge_id` int(10) NOT NULL AUTO_INCREMENT,
  `assigned_id` int(10) NOT NULL,
  `tc_id` varchar(10) NOT NULL,
  `type_id` varchar(30) NOT NULL,
  `one_way_charge` int(10) NOT NULL,
  `two_way_charge` int(10) NOT NULL,
  `multi_way_charge` int(10) NOT NULL,
  `tcharge_created_date` datetime NOT NULL,
  `status_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tcharge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `toll_charge`
--

INSERT INTO `toll_charge` (`tcharge_id`, `assigned_id`, `tc_id`, `type_id`, `one_way_charge`, `two_way_charge`, `multi_way_charge`, `tcharge_created_date`, `status_flag`) VALUES
(1, 1, '1', '1', 100, 200, 150, '2016-01-06 16:11:45', 0),
(2, 6, '2', '1', 10, 20, 30, '2016-01-06 16:26:38', 0),
(3, 1, '3', '1', 100, 150, 400, '2016-01-06 22:53:53', 0),
(4, 1, '4', '1', 50, 80, 200, '2016-01-06 22:54:29', 0),
(5, 1, '5', '1', 50, 80, 300, '2016-02-14 13:37:18', 0),
(6, 1, '7', '1', 500, 500, 50, '2016-04-06 11:57:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `toll_staff`
--

CREATE TABLE IF NOT EXISTS `toll_staff` (
  `ts_id` int(10) NOT NULL AUTO_INCREMENT,
  `assigned_id` int(10) NOT NULL,
  `roll_id` int(1) NOT NULL,
  `tc_id` varchar(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `auth_token` varchar(40) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `email_flag` tinyint(1) DEFAULT NULL,
  `status_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ts_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `toll_staff`
--

INSERT INTO `toll_staff` (`ts_id`, `assigned_id`, `roll_id`, `tc_id`, `first_name`, `last_name`, `email_id`, `password`, `mobile_no`, `profile_img`, `auth_token`, `created_date`, `email_flag`, `status_flag`) VALUES
(1, 0, 1, '', 'Venkat', 'Malola', 'malola2508@gmail.com', 'admin123', '', NULL, 'c7727dced9e9a5578539f720d3a75d9a', '0000-00-00 00:00:00', NULL, 0),
(6, 0, 1, '', 'Ram Swaroop ', 'R', 'swaroop@tayatech.com', 'admin123', '', NULL, '76d04630412a305e76a80d7f90b1a275', '0000-00-00 00:00:00', NULL, 0),
(7, 1, 3, '1', 'Lokesh', 't', 'lokesht@tayatech.com', '12345678', '8977212440', NULL, '3c7d368a00ef202bb0d7a6286a535582', '2016-01-06 16:11:06', NULL, 0),
(8, 7, 4, '1', 'ramesh', 'Aleti', 'ramesha@tayatech.com', '12345678', '7207788871', NULL, 'bbf471e5e328b8a9d12672dd8bb6db88', '2016-01-06 16:16:39', NULL, 0),
(9, 6, 3, '2', 'abc', 'xyz', 'abc@tayatech.com', 'abc123', '9885546999', NULL, NULL, '2016-01-06 16:18:02', NULL, 1),
(10, 1, 3, '3', 'Semiadmin1', 'taya', 'semiadmin1taya@gmail.com', 'semiadmin1taya', '1234567890', NULL, '9ff78b6f1483fa9812d06c68f5f0f53e', '2016-01-06 22:51:34', NULL, 0),
(11, 1, 3, '4', 'Semiadmin2', 'taya', 'semiadmin2taya@gmail.com', 'semiadmin2taya', '5555555555', NULL, 'b9d34c8f24b9ecc8e0c10afb1fc0cd3a', '2016-01-06 22:53:06', NULL, 0),
(12, 10, 4, '3', 'tollstaff1', 'taya', 'tollstaff1taya@gmail.com', 'tollstaff1taya', '4545454545', NULL, '89af4031317a0b6af36a820214e6d710', '2016-01-06 22:57:13', NULL, 0),
(13, 10, 4, '3', 'tollstaff2', 'taya', 'tollstaff2taya@gmail.com', 'tollstaff2taya', '5656567878', NULL, '33b74b91bc8c8b3add6d26892b6566b9', '2016-01-06 22:58:35', NULL, 0),
(14, 11, 4, '4', 'tollstaff3', 'taya', 'tollstaff3taya@gmail.com', 'tollstaff3taya', '4343434343', NULL, 'a0d3a2cd7a0db339cc696365275bd8e2', '2016-01-06 23:00:42', NULL, 0),
(15, 11, 4, '4', 'tollstaff4', 'taya', 'tollstaff4taya@gmail.com', 'tollstaff4taya', '2323232323', NULL, 'e06783cbd92185b3886e69ffbb15ab4e', '2016-01-06 23:01:24', NULL, 0),
(16, 1, 3, '5', 'TOLL1SA', 'TOLL1', 'TOLL1SA@gmail.com', 'TOLL1SA', '9550862999', NULL, '7959a894decb5aa05fd089d532dbed03', '2016-02-14 13:36:20', NULL, 0),
(17, 16, 4, '5', 'TOLL1STAFF1', 'STAFF1', 'TOLL1STAFF1@gmail.com', 'toll1staff1', '4564564560', NULL, '58808e7886a61a4f2133ab83826b9525', '2016-02-14 13:44:48', NULL, 0),
(18, 16, 4, '5', 'TOLL1STAFF2', 'STAFF2', 'TOLL1STAFF2@gmail.com', 'toll1staff2', '1231231234', NULL, NULL, '2016-02-14 13:46:07', NULL, 0),
(19, 1, 3, '2', 'semi3', 'm', 'semi3@gmail.com', '12345678', '9988773355', NULL, 'e6884a0db32ea3ffd53bcf1cf637495e', '2016-03-11 13:17:50', NULL, 0),
(20, 19, 4, '2', 'opp1', 'm', 'opp1@gmail.com', '12345678', '9933994488', NULL, 'f15cf335c5f99d530b685e5a1cc36a3e', '2016-03-11 13:20:03', NULL, 0),
(21, 7, 4, '1', 'ramesha', 'a', 'aleti@gmail.com', '12345678', '4356879012', NULL, '44fe323cf61262dc432ce4963dd654a9', '2016-03-25 17:31:05', NULL, 0),
(22, 1, 3, '7', 'lokesh', 'sah', 'stlokesh47@gmail.com', '123456', '8977565332', NULL, '813400aedf118d45494f8ed4737a29b8', '2016-04-06 11:56:57', NULL, 0),
(23, 22, 4, '7', 'staff', 'one', 'staffone@bmt.vom', '123456', '8744565663', NULL, NULL, '2016-04-06 11:59:01', NULL, 0),
(24, 1, 3, '8', 'semi1', 'one', 'semione@gmail.com', '123456', '8522323661', NULL, '0564a90d1e6b6db29986bef5f4c96f43', '2016-04-14 17:28:32', NULL, 0),
(25, 24, 4, '8', 'staff', 'one', 'staffone1@bmt.com', '123456', '8744545226', NULL, 'aa90014eb472310c11ebc60358770299', '2016-04-14 17:29:29', NULL, 0),
(26, 24, 4, '8', 'staff', 'two', 'stafftwo2@gmail.com', '123456', '8966323550', NULL, NULL, '2016-04-14 17:29:55', NULL, 0),
(27, 1, 3, '9', 'malola', 'malola', 'malola@gmail.com', '12345678', '8977545220', NULL, '0bfd2ba5e35e41babc3bffe08bd9d12b', '2016-04-17 18:06:11', NULL, 0),
(28, 27, 4, '9', 'ssss', 'ssss', 'staff12@gmail.com', '12345678', '8633232551', NULL, 'f975599ba7c546b785f2fe108123bf0b', '2016-04-17 18:07:08', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(10) NOT NULL AUTO_INCREMENT,
  `ts_id` int(10) NOT NULL,
  `tc_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `type_id` int(11) NOT NULL,
  `make_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `vehicle_id` int(10) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL,
  `lane_id` int(10) NOT NULL,
  `way_type` tinyint(1) DEFAULT NULL,
  `email_id` varchar(30) NOT NULL,
  `reg_type` varchar(250) DEFAULT NULL,
  `toll_charge` float NOT NULL,
  `paytm_charge` float DEFAULT NULL,
  `bmt_charge` float NOT NULL,
  `total_amount` float NOT NULL,
  `passing_status` tinyint(1) NOT NULL,
  `paid_status` tinyint(1) NOT NULL,
  `refund_status` tinyint(1) NOT NULL DEFAULT '0',
  `transaction_date` datetime NOT NULL,
  UNIQUE KEY `transaction_id` (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `ts_id`, `tc_id`, `user_id`, `type_id`, `make_id`, `model_id`, `vehicle_id`, `vehicle_no`, `lane_id`, `way_type`, `email_id`, `reg_type`, `toll_charge`, `paytm_charge`, `bmt_charge`, `total_amount`, `passing_status`, `paid_status`, `refund_status`, `transaction_date`) VALUES
(1, 8, 1, 3, 1, 1, 1, 1, 'AP 12 HY 1234', 1, NULL, 'ramesha@tayatech.com', 'frnBeAakSzU:APA91bFpKNGciz8GIFEvjFZT8apYip40H3Gysy5qIrSOiS_-FNA8PSvDSEcHyEwBTxq2643r392B2ttPiUw7ohClO30vIjIjd_7_ZGzROHKLN-Ekyzlm57a8woAeYgtB4sidXiwUkRCn', 100, NULL, 1, 101, 1, 1, 0, '2016-01-06 16:20:00'),
(2, 8, 1, 3, 1, 1, 1, 2, 'AP 34 GH 4366', 1, NULL, 'ramesha@tayatech.com', 'frnBeAakSzU:APA91bFpKNGciz8GIFEvjFZT8apYip40H3Gysy5qIrSOiS_-FNA8PSvDSEcHyEwBTxq2643r392B2ttPiUw7ohClO30vIjIjd_7_ZGzROHKLN-Ekyzlm57a8woAeYgtB4sidXiwUkRCn', 200, NULL, 1, 201, 1, 1, 0, '2016-01-06 16:27:28'),
(3, 8, 1, 3, 1, 1, 1, 3, 'zz 22 ff 5555', 1, NULL, 'ramesha@tayatech.com', 'frnBeAakSzU:APA91bFpKNGciz8GIFEvjFZT8apYip40H3Gysy5qIrSOiS_-FNA8PSvDSEcHyEwBTxq2643r392B2ttPiUw7ohClO30vIjIjd_7_ZGzROHKLN-Ekyzlm57a8woAeYgtB4sidXiwUkRCn', 200, NULL, 1, 201, 1, 1, 0, '2016-01-06 16:33:40'),
(4, 8, 1, 8, 1, 1, 2, 4, 'GH 45 GH 3456', 1, NULL, 'mvlakshmi555@gmail.com', 'f-7yHwOmTcc:APA91bEIrpqzTCetPGdrpOrT--8PdYkI8rHAH297JpZLDq-xpXVH6AA9MH2Od-r_ETe_zI_Xc1Oz0NLIlrH_x_s4pmcXMPm0x7dP96EYDPVCI9a0koh88wYYaxEWXls5HwySqsHGbM-y', 100, NULL, 1, 101, 1, 1, 0, '2016-01-06 16:59:32'),
(5, 8, 1, 7, 1, 1, 1, 5, 'aa 99 m 5555', 1, NULL, 'nsunkara@gmail.com', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 100, NULL, 1, 101, 1, 1, 0, '2016-01-06 16:59:12'),
(6, 8, 1, 9, 1, 1, 1, 7, 'ap 34 fg 1234', 1, NULL, 'lokesht@tayatech.com', 'cSBbzgmE9UI:APA91bFdNQ6w5A_0lwVNJg_KzE3UQt9A3G7vgbf_70AWr_OKqtf-C0gJLwmaUloISxOlXx8C69CORNKtKeE_dTLpIC18RkTvE9M5yHkmQTil7o5tvgNxQ3RmVT1sBEBd2ekuUw8VVh6s', 100, NULL, 1, 101, 1, 1, 0, '2016-01-06 17:06:46'),
(7, 8, 1, 7, 1, 1, 2, 6, 'pp 55 GH 5555', 1, NULL, 'nsunkara@gmail.com', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 200, NULL, 1, 201, 1, 1, 0, '2016-01-06 17:09:25'),
(8, 8, 1, 8, 1, 1, 1, 8, 'Hj 56 hj 4567', 1, NULL, 'mvlakshmi555@gmail.com', 'f-7yHwOmTcc:APA91bEIrpqzTCetPGdrpOrT--8PdYkI8rHAH297JpZLDq-xpXVH6AA9MH2Od-r_ETe_zI_Xc1Oz0NLIlrH_x_s4pmcXMPm0x7dP96EYDPVCI9a0koh88wYYaxEWXls5HwySqsHGbM-y', 200, NULL, 1, 201, 1, 1, 0, '2016-01-06 17:10:32'),
(9, 8, 1, 7, 1, 1, 2, 6, 'pp 55 GH 5555', 1, 1, 'nsunkara@gmail.com', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 200, NULL, 1, 201, 1, 1, 0, '2016-01-06 17:18:03'),
(10, 8, 1, 6, 1, 1, 1, 10, 'TS 07 EQ 6555', 1, 1, 'swarooprbobby@gmail.com', NULL, 100, NULL, 1, 101, 1, 1, 0, '2016-01-06 17:33:07'),
(11, 8, 1, 10, 1, 1, 2, 9, 'gh 33 gf 1234', 1, 1, 'nsunkara@gmail.com', NULL, 100, NULL, 1, 101, 0, 1, 0, '2016-01-06 17:33:05'),
(12, 8, 1, 10, 1, 1, 1, 11, 'KL 34 BA 1234', 1, 1, 'nsunkara@gmail.com', NULL, 200, NULL, 1, 201, 0, 1, 0, '2016-01-06 17:34:31'),
(13, 13, 3, 10, 1, 1, 1, 11, 'KL 34 BA 1234', 71, 1, 'nsunkara@gmail.com', NULL, 100, NULL, 1, 101, 0, 1, 0, '2016-01-06 23:06:43'),
(14, 15, 4, 10, 1, 1, 1, 11, 'KL 34 BA 1234', 86, 1, 'nsunkara@gmail.com', NULL, 50, NULL, 1, 51, 0, 1, 0, '2016-01-06 23:09:23'),
(15, 14, 4, 10, 1, 1, 2, 9, 'gh 33 gf 1234', 86, 1, 'nsunkara@gmail.com', NULL, 80, NULL, 1, 81, 0, 1, 0, '2016-01-06 23:31:32'),
(16, 8, 1, 8, 1, 1, 1, 8, 'Hj 56 hj 4567', 113, 1, 'mvlakshmi555@gmail.com', 'f-7yHwOmTcc:APA91bEIrpqzTCetPGdrpOrT--8PdYkI8rHAH297JpZLDq-xpXVH6AA9MH2Od-r_ETe_zI_Xc1Oz0NLIlrH_x_s4pmcXMPm0x7dP96EYDPVCI9a0koh88wYYaxEWXls5HwySqsHGbM-y', 100, NULL, 1, 101, 1, 1, 0, '2016-01-07 13:05:16'),
(17, 8, 1, 12, 1, 1, 1, 12, 'AP 22 SS 4569', 113, 1, 'stlokesh47@gmail.com', NULL, 100, NULL, 1, 101, 0, 1, 0, '2016-01-07 12:53:40'),
(18, 8, 1, 3, 1, 1, 1, 13, 'GH 12 FG 5555', 113, NULL, 'ramesha@tayatech.com', 'e9VjoRWVnDM:APA91bGQ_qisanU_PIyM-27sShP9Bi3et_lipvpUYil_fI9T1h2lSwo5C5kheLpcb61buZrRgC8bAy2KsdHGP-SQZIvHputz0rOBVPGKWWgxPqmV39_ix_suZiXveTuFu_MLOq3vnPvY', 100, NULL, 1, 101, 1, 1, 0, '2016-01-08 10:58:14'),
(19, 8, 1, 8, 1, 1, 1, 14, 'as 45 bu 6789', 113, 1, 'mvlakshmi555@gmail.com', 'f-7yHwOmTcc:APA91bEIrpqzTCetPGdrpOrT--8PdYkI8rHAH297JpZLDq-xpXVH6AA9MH2Od-r_ETe_zI_Xc1Oz0NLIlrH_x_s4pmcXMPm0x7dP96EYDPVCI9a0koh88wYYaxEWXls5HwySqsHGbM-y', 100, NULL, 1, 101, 1, 1, 0, '2016-01-07 13:15:43'),
(20, 12, 3, 13, 1, 1, 1, 15, 'df 45 yu 4567', 76, 2, 'durga.it123@gmail.com', NULL, 100, NULL, 1, 101, 0, 1, 0, '2016-01-07 13:26:41'),
(21, 8, 1, 3, 1, 1, 1, 16, 'ap 55gg 1647', 113, NULL, 'ramesha@tayatech.com', 'e9VjoRWVnDM:APA91bGQ_qisanU_PIyM-27sShP9Bi3et_lipvpUYil_fI9T1h2lSwo5C5kheLpcb61buZrRgC8bAy2KsdHGP-SQZIvHputz0rOBVPGKWWgxPqmV39_ix_suZiXveTuFu_MLOq3vnPvY', 100, NULL, 1, 101, 0, 0, 0, '2016-01-08 08:51:30'),
(22, 8, 1, 3, 1, 1, 1, 17, 'ap55hh1547', 113, NULL, 'ramesha@tayatech.com', 'e9VjoRWVnDM:APA91bGQ_qisanU_PIyM-27sShP9Bi3et_lipvpUYil_fI9T1h2lSwo5C5kheLpcb61buZrRgC8bAy2KsdHGP-SQZIvHputz0rOBVPGKWWgxPqmV39_ix_suZiXveTuFu_MLOq3vnPvY', 200, NULL, 1, 201, 1, 1, 0, '2016-01-08 11:18:38'),
(23, 8, 1, 4, 1, 1, 1, 21, 'AP 09 AP 9999', 113, 1, 'mvrnagendra55@gmail.com', NULL, 100, NULL, 1, 101, 0, 0, 0, '2016-01-08 17:33:07'),
(24, 8, 1, 20, 1, 1, 1, 22, 'AP 12 HY 1289', 113, 1, 'binojrajan@yahoo.com', NULL, 100, NULL, 1, 101, 0, 0, 0, '2016-01-30 18:58:06'),
(25, 8, 1, 8, 1, 1, 1, 25, 'AP1254ff', 113, NULL, 'mvlakshmi555@gmail.com', 'cT-oT3zNyvA:APA91bEPBpz5pxHwEUGPU42YeGkW83WPYMzC3qxj2p2DWRImol3EOqCr8FFP6T3U1i8_-_pca64cDTk_OtpoE42_oJLLe8d0dIpdGvzKbIAgHHd9j7GPErogLPezNUduYxLeci2sjwcD', 100, NULL, 1, 101, 1, 0, 0, '2016-03-09 11:08:12'),
(26, 8, 1, 8, 1, 1, 1, 25, 'AP1254ff', 113, NULL, 'mvlakshmi555@gmail.com', 'cT-oT3zNyvA:APA91bEPBpz5pxHwEUGPU42YeGkW83WPYMzC3qxj2p2DWRImol3EOqCr8FFP6T3U1i8_-_pca64cDTk_OtpoE42_oJLLe8d0dIpdGvzKbIAgHHd9j7GPErogLPezNUduYxLeci2sjwcD', 100, NULL, 1, 101, 1, 0, 0, '2016-03-09 11:08:12'),
(27, 8, 1, 5, 1, 1, 1, 26, 'AS 43 DF 2354', 113, 1, 'test@gmail.com', NULL, 100, NULL, 1, 101, 0, 1, 0, '2016-03-09 12:02:02'),
(28, 8, 1, 8, 1, 1, 1, 25, 'AP1254ff', 114, NULL, 'mvlakshmi555@gmail.com', 'e9VjoRWVnDM:APA91bGQ_qisanU_PIyM-27sShP9Bi3et_lipvpUYil_fI9T1h2lSwo5C5kheLpcb61buZrRgC8bAy2KsdHGP-SQZIvHputz0rOBVPGKWWgxPqmV39_ix_suZiXveTuFu_MLOq3vnPvY', 100, NULL, 1, 101, 1, 1, 0, '2016-03-09 13:16:55'),
(29, 8, 1, 8, 1, 1, 1, 27, 'LA 13 HH 1234', 114, NULL, 'mvlakshmi555@gmail.com', 'f9UaswOy4yU:APA91bH5PNSEYwCY-2G0zHmQvpQ1s_kHKJCMnkKbHREtzZFRuD_uSwbh1qrgc-LXgPVqPZKRJKLrEsKsQoWa-FhnIfcjhF_Qnv5kujH8EPi3gPnKkjK53wzN6pvTjoWo1jZBHG_3qnA-', 100, NULL, 1, 101, 1, 1, 0, '2016-03-18 11:45:38'),
(31, 20, 2, 22, 1, 1, 1, 28, 'AS 23 SD 1234', 123, NULL, 'mvl@gmail.com', 'fqu0XwfIuZE:APA91bG4qZKJvHiApIGdUviGsLq8UAG8o9vCH8SsqXL67DKC_JVZ6jfQdf5ct_9T7aHDZJzUkggd0i-HeTcjzDpHmEvbxRT47bmOS3XuGcCFVfev1OjQfOit6wBuHu3Cvv788nzWQpK-', 10, NULL, 1, 11, 0, 0, 0, '2016-03-11 13:21:20'),
(32, 20, 2, 8, 1, 1, 1, 27, 'LA 13 HH 1234', 123, NULL, 'mvlakshmi555@gmail.com', 'dKi4g8oQg2g:APA91bFFaZP9xN18pLcBgNmnMASDd7SDji4xrnU7yamahx8-5fj3hSMtNunahzq3OO3je9UI7NnXuG3Nuip04nUhgFebVsfuauNM5BPaa32nh4wL-_Yb6KlE2Qb_R3Kup3UZqKTElI0v', 10, NULL, 1, 11, 0, 0, 0, '2016-03-11 15:57:14'),
(33, 20, 2, 22, 1, 1, 1, 29, 'GH 45 Yu 1234', 123, NULL, 'mvl@gmail.com', 'dKi4g8oQg2g:APA91bFFaZP9xN18pLcBgNmnMASDd7SDji4xrnU7yamahx8-5fj3hSMtNunahzq3OO3je9UI7NnXuG3Nuip04nUhgFebVsfuauNM5BPaa32nh4wL-_Yb6KlE2Qb_R3Kup3UZqKTElI0v', 10, NULL, 1, 11, 0, 1, 0, '2016-03-11 16:24:49'),
(34, 8, 1, 23, 1, 1, 1, 31, 'GH 45 fg 7856', 114, 1, 'user1@gmail.com', NULL, 100, NULL, 1, 101, 0, 0, 0, '2016-03-15 13:15:32'),
(35, 12, 3, 23, 1, 1, 1, 31, 'GH 45 fg 7856', 71, 1, 'user1@gmail.com', NULL, 100, NULL, 1, 101, 0, 1, 0, '2016-03-15 14:46:07'),
(36, 8, 1, 24, 1, 1, 2, 32, 'GH 45 fg 6534', 113, 1, 'user2@gmail.com', NULL, 100, NULL, 1, 101, 1, 1, 0, '2016-03-15 15:08:54'),
(37, 8, 1, 24, 1, 1, 1, 33, 'GH 45 fg 1234', 114, 1, 'user2@gmail.com', NULL, 100, NULL, 1, 101, 1, 1, 0, '2016-03-15 16:09:53'),
(38, 20, 2, 25, 1, 1, 2, 34, 'GH 45 fg 1432', 124, 1, 'user3@gmail.com', NULL, 10, NULL, 1, 11, 0, 1, 0, '2016-03-15 16:16:53'),
(39, 8, 1, 28, 1, 1, 1, 35, 'SA 56 HJ 7654', 114, 1, 'user5@gmail.com', NULL, 100, NULL, 1, 101, 1, 1, 0, '2016-03-25 17:42:15'),
(40, 8, 1, 5, 1, 1, 1, 36, 'ZF 45 DF 5643', 114, NULL, 'test@gmail.com', 'fP7ytGIGnHw:APA91bEII9Dtcus05EtJ8dP3vTQNBuX393A4WVuYsgEmNUkpLn_MDZszBUQ1auZpCiaOawUMpW2BcTHJowNMxus0pop3B3UPf6N3zY--meabSsOJJLlB9htiWx6dZVa9YTCUZVZFtGhm', 100, NULL, 1, 101, 0, 0, 0, '2016-03-31 15:57:13'),
(41, 8, 1, 8, 1, 1, 1, 38, 'AP 27 DD 1234', 113, NULL, 'mvlakshmi555@gmail.com', '7ae6050b455da4b81e8999691ecf314439e78be1a681f696664cf40e1454ee4a', 100, NULL, 1, 101, 1, 1, 0, '2016-04-04 10:30:07'),
(42, 8, 1, 8, 1, 1, 1, 39, 'Ap 44  ft  2456', 113, NULL, 'mvlakshmi555@gmail.com', '7ae6050b455da4b81e8999691ecf314439e78be1a681f696664cf40e1454ee4a', 200, NULL, 1, 201, 1, 1, 0, '2016-04-04 11:33:15'),
(43, 8, 1, 8, 1, 1, 1, 40, 'Ap 66 the 1234', 113, NULL, 'mvlakshmi555@gmail.com', '598a38eed272043b2e857375af1c53aeada542bbffd5ea145a55def8fd5462de', 200, NULL, 1, 201, 1, 1, 0, '2016-04-04 17:44:29'),
(44, 8, 1, 8, 1, 1, 1, 42, 'Ash 54 hhh 356', 113, NULL, 'mvlakshmi555@gmail.com', '598a38eed272043b2e857375af1c53aeada542bbffd5ea145a55def8fd5462de', 200, NULL, 1, 201, 1, 1, 0, '2016-04-04 17:54:18'),
(45, 8, 1, 8, 1, 1, 1, 43, 'RR 48 GH 0987', 113, NULL, 'mvlakshmi555@gmail.com', '1f8d1bb1fef66fea9c234b25262e554850f39167725d259d7f0fc0122825da5e', 200, NULL, 1, 201, 1, 1, 0, '2016-04-04 18:24:17'),
(46, 8, 1, 5, 1, 1, 1, 36, 'ZF 45 DF 5643', 113, NULL, 'test@gmail.com', 'eBUri13m1z4:APA91bEPCsO2Rk60zRKXKXdcrKJpkztqw9kyt5BCsFB8GiSDgFsMReGfP2aiN7Um2ldSGIWp5O8bky010GvsvOUELaDJybfHi4_KgC-QmTnHqCzl9-QMYEsLPKJ5oDN_GP_xpLOn_Y-i', 100, NULL, 1, 101, 0, 0, 0, '2016-04-05 11:57:39'),
(47, 8, 1, 5, 1, 1, 1, 36, 'ZF 45 DF 5643', 113, NULL, 'test@gmail.com', 'eBUri13m1z4:APA91bEPCsO2Rk60zRKXKXdcrKJpkztqw9kyt5BCsFB8GiSDgFsMReGfP2aiN7Um2ldSGIWp5O8bky010GvsvOUELaDJybfHi4_KgC-QmTnHqCzl9-QMYEsLPKJ5oDN_GP_xpLOn_Y-i', 100, NULL, 1, 101, 0, 0, 0, '2016-04-05 11:57:39'),
(48, 8, 1, 5, 1, 1, 1, 36, 'ZF 45 DF 5643', 113, NULL, 'test@gmail.com', 'eBUri13m1z4:APA91bEPCsO2Rk60zRKXKXdcrKJpkztqw9kyt5BCsFB8GiSDgFsMReGfP2aiN7Um2ldSGIWp5O8bky010GvsvOUELaDJybfHi4_KgC-QmTnHqCzl9-QMYEsLPKJ5oDN_GP_xpLOn_Y-i', 100, NULL, 1, 101, 0, 0, 0, '2016-04-05 11:57:39'),
(49, 8, 1, 5, 1, 1, 1, 58, 'Ad ghhh 3554', 113, NULL, 'test@gmail.com', '9798c187d4c73056e8cacd873a20aa13e2bcfeb7eedcba51b053cc21208377f1', 100, NULL, 1, 101, 0, 0, 0, '2016-04-05 17:53:50'),
(50, 8, 1, 5, 1, 1, 2, 57, 'Jaha78877', 113, NULL, 'test@gmail.com', '9798c187d4c73056e8cacd873a20aa13e2bcfeb7eedcba51b053cc21208377f1', 100, NULL, 1, 101, 0, 1, 0, '2016-04-05 17:58:00'),
(51, 8, 1, 5, 1, 1, 1, 56, 'Qpq67ha7897', 113, NULL, 'test@gmail.com', 'cad8ccaa8b3dc13cc5eae882d1f88f89f050b9d7fd62dc03d0b355c19f6f261e', 200, NULL, 1, 201, 0, 0, 0, '2016-04-05 19:06:17'),
(52, 8, 1, 5, 1, 1, 1, 56, 'Qpq67ha7897', 113, NULL, 'test@gmail.com', 'cad8ccaa8b3dc13cc5eae882d1f88f89f050b9d7fd62dc03d0b355c19f6f261e', 100, NULL, 1, 101, 0, 0, 0, '2016-04-06 10:09:06'),
(53, 8, 1, 29, 1, 1, 1, 61, 'SA 43 FG 2354', 113, 1, 'saichandana52.mca@gmail.com', NULL, 100, NULL, 1, 101, 0, 0, 0, '2016-04-06 10:31:51'),
(54, 8, 1, 30, 1, 1, 1, 62, 'AS 34 FG 2365', 113, 1, 'saichandana52.mca@gmail.com', NULL, 100, NULL, 1, 101, 1, 1, 0, '2016-04-06 10:48:51'),
(55, 8, 1, 30, 1, 1, 1, 63, 'DG 45 GG 5678', 113, NULL, 'saichandana52.mca@gmail.com', 'fCgYxZ3tik4:APA91bEoWi0a9uKlVRmyXY5T-IYcM6RxOzTr4xyhwZue2Ja129K5FgtLbtcgo9sra_50T70uGFCv4sgTBDXXzuiFAnZskmuvIRZMSs-cB11PuYDiF477-3qQSuMcbZg2WiyqSZosCUX1', 200, NULL, 1, 201, 1, 1, 0, '2016-04-06 10:59:44'),
(56, 8, 1, 30, 1, 1, 2, 65, 'Ap 12 ff 4567', 113, NULL, 'saichandana52.mca@gmail.com', 'fCgYxZ3tik4:APA91bEoWi0a9uKlVRmyXY5T-IYcM6RxOzTr4xyhwZue2Ja129K5FgtLbtcgo9sra_50T70uGFCv4sgTBDXXzuiFAnZskmuvIRZMSs-cB11PuYDiF477-3qQSuMcbZg2WiyqSZosCUX1', 200, NULL, 1, 201, 1, 1, 0, '2016-04-06 11:10:29'),
(57, 8, 1, 30, 1, 1, 2, 65, 'Ap 12 ff 4567', 113, NULL, 'saichandana52.mca@gmail.com', 'fCgYxZ3tik4:APA91bEoWi0a9uKlVRmyXY5T-IYcM6RxOzTr4xyhwZue2Ja129K5FgtLbtcgo9sra_50T70uGFCv4sgTBDXXzuiFAnZskmuvIRZMSs-cB11PuYDiF477-3qQSuMcbZg2WiyqSZosCUX1', 200, NULL, 1, 201, 1, 0, 0, '2016-04-06 11:08:04'),
(58, 8, 1, 30, 1, 1, 2, 65, 'Ap 12 ff 4567', 113, NULL, 'saichandana52.mca@gmail.com', 'fCgYxZ3tik4:APA91bEoWi0a9uKlVRmyXY5T-IYcM6RxOzTr4xyhwZue2Ja129K5FgtLbtcgo9sra_50T70uGFCv4sgTBDXXzuiFAnZskmuvIRZMSs-cB11PuYDiF477-3qQSuMcbZg2WiyqSZosCUX1', 200, NULL, 1, 201, 1, 0, 0, '2016-04-06 11:08:04'),
(59, 8, 1, 29, 1, 1, 1, 66, 'As 12 try 1234', 113, NULL, 'saichandana52.mca123@gmail.com', 'cad8ccaa8b3dc13cc5eae882d1f88f89f050b9d7fd62dc03d0b355c19f6f261e', 100, NULL, 1, 101, 0, 0, 0, '2016-04-06 11:15:41'),
(60, 8, 1, 5, 1, 1, 1, 60, 'Ap 28 DD 1252', 113, NULL, 'test@gmail.com', 'cad8ccaa8b3dc13cc5eae882d1f88f89f050b9d7fd62dc03d0b355c19f6f261e', 100, NULL, 1, 101, 0, 1, 0, '2016-04-06 11:21:22'),
(61, 8, 1, 5, 1, 1, 1, 58, 'Ad ghhh 3554', 113, NULL, 'test@gmail.com', 'cad8ccaa8b3dc13cc5eae882d1f88f89f050b9d7fd62dc03d0b355c19f6f261e', 200, NULL, 1, 201, 0, 0, 0, '2016-04-06 11:22:52'),
(62, 8, 1, 5, 1, 1, 1, 67, 'Ap 12 bb 1457', 113, NULL, 'test@gmail.com', 'cad8ccaa8b3dc13cc5eae882d1f88f89f050b9d7fd62dc03d0b355c19f6f261e', 200, NULL, 1, 201, 0, 1, 0, '2016-04-06 12:21:05'),
(63, 8, 1, 3, 1, 1, 1, 69, 'Ap 56 gig 6899', 113, NULL, 'ramesha@tayatech.com', 'cad8ccaa8b3dc13cc5eae882d1f88f89f050b9d7fd62dc03d0b355c19f6f261e', 100, NULL, 1, 101, 0, 0, 0, '2016-04-06 12:11:00'),
(64, 8, 1, 31, 1, 1, 1, 72, 'AP 34 TT 2754', 113, NULL, 'ramesha@tayatech.com', 'cjDqRwmAPUQ:APA91bHH102kFKbVtwVFto3Kw5pY8tHn4MUHPaxYvzWtSDn3klOBlWJQOT_ks-2f8dPClFYsUHF6iDqvCZi7fzli6Bs8SPRJPlzxgniJOSoti1--QnYe6VD1RenFFlu58d8H1CG-FqL4', 100, NULL, 1, 101, 1, 1, 0, '2016-04-06 14:46:48'),
(65, 8, 1, 5, 1, 1, 1, 70, 'Ap 38 h 5688', 113, NULL, 'test@gmail.com', 'fCgYxZ3tik4:APA91bEoWi0a9uKlVRmyXY5T-IYcM6RxOzTr4xyhwZue2Ja129K5FgtLbtcgo9sra_50T70uGFCv4sgTBDXXzuiFAnZskmuvIRZMSs-cB11PuYDiF477-3qQSuMcbZg2WiyqSZosCUX1', 200, NULL, 1, 201, 0, 0, 0, '2016-04-06 14:44:15'),
(66, 8, 1, 30, 1, 1, 2, 65, 'Ap 12 ff 4567', 115, NULL, 'saichandana52.mca@gmail.com', 'cnJzVU-AXuo:APA91bHtppDR59hbJAg7zQjNDjCWE-tocpMzCQ7SFm2Mn5IPys2u0Y5EKcvdiSxoquaG1OAdjq0EmyNq56LoBdvu0nW7ZiFC7sHIMQbuIYB7kI3kxPszq6M-0P3IVkujCVVty9luESoc', 100, NULL, 1, 101, 1, 0, 0, '2016-04-14 17:46:35'),
(67, 8, 1, 30, 1, 1, 2, 65, 'Ap 12 ff 4567', 113, NULL, 'saichandana52.mca@gmail.com', 'cnJzVU-AXuo:APA91bHtppDR59hbJAg7zQjNDjCWE-tocpMzCQ7SFm2Mn5IPys2u0Y5EKcvdiSxoquaG1OAdjq0EmyNq56LoBdvu0nW7ZiFC7sHIMQbuIYB7kI3kxPszq6M-0P3IVkujCVVty9luESoc', 100, NULL, 1, 101, 1, 0, 0, '2016-04-14 18:11:16'),
(68, 8, 1, 30, 1, 1, 1, 75, 'Gh 45 gh 2345', 113, NULL, 'saichandana52.mca@gmail.com', 'cnJzVU-AXuo:APA91bHtppDR59hbJAg7zQjNDjCWE-tocpMzCQ7SFm2Mn5IPys2u0Y5EKcvdiSxoquaG1OAdjq0EmyNq56LoBdvu0nW7ZiFC7sHIMQbuIYB7kI3kxPszq6M-0P3IVkujCVVty9luESoc', 100, NULL, 1, 101, 0, 0, 0, '2016-04-14 19:15:48'),
(69, 8, 1, 32, 1, 1, 1, 74, 'lk 34 gh 1234', 113, NULL, 'ls@gmail.com', 'c3vDoVkzoHA:APA91bHq8T7KERGCPLgNzzLcB8hn090JZlyhm5Cmw1WTtR13W7-Z8rYxXljhrKCN4Bum87ksw38pZmUBVgPv-QkCirysGLCP0COdgBCvsU4zquYhYkXG1QuZcocxpxTvlGTQY4C-CtSg', 100, NULL, 1, 101, 0, 0, 0, '2016-04-14 19:18:28'),
(70, 8, 1, 5, 1, 1, 1, 77, 'gsgshhshsjsjs', 113, NULL, 'test@gmail.com', 'c3vDoVkzoHA:APA91bHq8T7KERGCPLgNzzLcB8hn090JZlyhm5Cmw1WTtR13W7-Z8rYxXljhrKCN4Bum87ksw38pZmUBVgPv-QkCirysGLCP0COdgBCvsU4zquYhYkXG1QuZcocxpxTvlGTQY4C-CtSg', 100, NULL, 1, 101, 0, 0, 0, '2016-04-17 14:22:39'),
(71, 8, 1, 7, 1, 1, 1, 79, 'ap 12 db 1235', 113, NULL, 'nsunkara@gmail.com', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 100, NULL, 1, 101, 1, 1, 0, '2016-04-17 17:31:40'),
(72, 8, 1, 7, 1, 1, 2, 80, 'ka 51m2874', 113, NULL, 'nsunkara@gmail.com', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 200, NULL, 1, 201, 1, 1, 0, '2016-04-17 18:17:38'),
(73, 8, 1, 33, 1, 1, 2, 81, 'AP 28 DH 4829', 113, NULL, 'kousalya2903@gmail.com', 'cpAXBLXqxmc:APA91bH6HmXp3zXN4hQB3beMNPaBHizFcgAKPwZB1MsltQjwp4D4uKWhYISzOLYVi1HutWJtPUwtrCGKsXIb0806dFxjlQRIivQN5w54ccvHvbhscrGBDg-IvceV_zz-rfmCt3KSB6zY', 100, NULL, 1, 101, 1, 1, 0, '2016-04-18 08:03:12'),
(74, 8, 1, 7, 1, 1, 2, 82, 'KL 01 4927', 113, NULL, 'nsunkara@gmail.com', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 200, NULL, 1, 201, 1, 1, 0, '2016-04-17 20:19:37'),
(75, 8, 1, 33, 1, 1, 2, 83, 'ap08kl1234', 113, NULL, 'kousalya2903@gmail.com', 'cpAXBLXqxmc:APA91bH6HmXp3zXN4hQB3beMNPaBHizFcgAKPwZB1MsltQjwp4D4uKWhYISzOLYVi1HutWJtPUwtrCGKsXIb0806dFxjlQRIivQN5w54ccvHvbhscrGBDg-IvceV_zz-rfmCt3KSB6zY', 100, NULL, 1, 101, 0, 0, 0, '2016-04-17 20:20:10'),
(76, 8, 1, 33, 1, 1, 1, 84, 'MH12M2867', 113, NULL, 'kousalya2903@gmail.com', 'cpAXBLXqxmc:APA91bH6HmXp3zXN4hQB3beMNPaBHizFcgAKPwZB1MsltQjwp4D4uKWhYISzOLYVi1HutWJtPUwtrCGKsXIb0806dFxjlQRIivQN5w54ccvHvbhscrGBDg-IvceV_zz-rfmCt3KSB6zY', 100, NULL, 1, 101, 1, 1, 0, '2016-04-17 20:28:00'),
(77, 8, 1, 33, 1, 1, 1, 85, 'up12m1233', 113, NULL, 'kousalya2903@gmail.com', 'cpAXBLXqxmc:APA91bH6HmXp3zXN4hQB3beMNPaBHizFcgAKPwZB1MsltQjwp4D4uKWhYISzOLYVi1HutWJtPUwtrCGKsXIb0806dFxjlQRIivQN5w54ccvHvbhscrGBDg-IvceV_zz-rfmCt3KSB6zY', 200, NULL, 1, 201, 1, 1, 0, '2016-04-17 20:42:20'),
(78, 8, 1, 33, 1, 1, 1, 86, 'jh23ab1234', 113, NULL, 'kousalya2903@gmail.com', 'cpAXBLXqxmc:APA91bH6HmXp3zXN4hQB3beMNPaBHizFcgAKPwZB1MsltQjwp4D4uKWhYISzOLYVi1HutWJtPUwtrCGKsXIb0806dFxjlQRIivQN5w54ccvHvbhscrGBDg-IvceV_zz-rfmCt3KSB6zY', 200, NULL, 1, 201, 0, 0, 0, '2016-04-17 23:55:56'),
(79, 8, 1, 34, 1, 1, 1, 87, 'AP09 gh 3208', 113, NULL, 'ramchikkam@gmail.com', 'fGwNAxwk_GE:APA91bGo55KkymVIi-sFUCUbbgSTI5wUE7cbQgEtyBvBjEge07t0nDiiL1YCruCgUc3DIL2cSMPXo-H3BcdgNqUHeT-12yFaSL04NX8HwByCtt_TAfhr01d1OaQeJ30aIzCvu1nAOL3w', 100, NULL, 1, 101, 1, 1, 0, '2016-04-18 09:17:09'),
(80, 8, 1, 34, 1, 1, 2, 89, 'AP09 bw 4488', 113, NULL, 'ramchikkam@gmail.com', 'fGwNAxwk_GE:APA91bGo55KkymVIi-sFUCUbbgSTI5wUE7cbQgEtyBvBjEge07t0nDiiL1YCruCgUc3DIL2cSMPXo-H3BcdgNqUHeT-12yFaSL04NX8HwByCtt_TAfhr01d1OaQeJ30aIzCvu1nAOL3w', 200, NULL, 1, 201, 1, 1, 0, '2016-04-18 09:27:59'),
(81, 8, 1, 34, 1, 1, 1, 90, 'AP09 dh 4829', 113, NULL, 'ramchikkam@gmail.com', 'fGwNAxwk_GE:APA91bGo55KkymVIi-sFUCUbbgSTI5wUE7cbQgEtyBvBjEge07t0nDiiL1YCruCgUc3DIL2cSMPXo-H3BcdgNqUHeT-12yFaSL04NX8HwByCtt_TAfhr01d1OaQeJ30aIzCvu1nAOL3w', 200, NULL, 1, 201, 0, 0, 0, '2016-04-18 09:35:07'),
(82, 8, 1, 34, 1, 1, 1, 91, 'Ap10 bw 4489', 113, NULL, 'ramchikkam@gmail.com', 'fGwNAxwk_GE:APA91bGo55KkymVIi-sFUCUbbgSTI5wUE7cbQgEtyBvBjEge07t0nDiiL1YCruCgUc3DIL2cSMPXo-H3BcdgNqUHeT-12yFaSL04NX8HwByCtt_TAfhr01d1OaQeJ30aIzCvu1nAOL3w', 200, NULL, 1, 201, 1, 1, 0, '2016-04-18 09:40:05'),
(83, 8, 1, 34, 1, 1, 1, 92, 'AP09 bw 4499', 113, NULL, 'ramchikkam@gmail.com', 'fGwNAxwk_GE:APA91bGo55KkymVIi-sFUCUbbgSTI5wUE7cbQgEtyBvBjEge07t0nDiiL1YCruCgUc3DIL2cSMPXo-H3BcdgNqUHeT-12yFaSL04NX8HwByCtt_TAfhr01d1OaQeJ30aIzCvu1nAOL3w', 200, NULL, 1, 201, 1, 1, 0, '2016-04-18 09:50:25'),
(84, 8, 1, 34, 1, 1, 1, 94, 'AP09 bw 4444', 113, NULL, 'ramchikkam@gmail.com', 'fGwNAxwk_GE:APA91bGo55KkymVIi-sFUCUbbgSTI5wUE7cbQgEtyBvBjEge07t0nDiiL1YCruCgUc3DIL2cSMPXo-H3BcdgNqUHeT-12yFaSL04NX8HwByCtt_TAfhr01d1OaQeJ30aIzCvu1nAOL3w', 200, NULL, 1, 201, 1, 1, 0, '2016-04-18 13:33:27'),
(85, 8, 1, 35, 1, 1, 1, 93, 'Ap 09 aa 9999', 113, NULL, 'abhimanyu.369@gmail.com', 'evlx1sgh3TA:APA91bFHZ-f6jBc8zMUCh9UsSmUGhjiQ-aRRg0fPwyUhnmPxfcZktfZ_PsHDrX5LdEbVoBrPlvsYBOJ3Uvt5A8wvKxqcDtcmDhCJCa90G9qoxFP_HnjZOkjuqyUZGnoIWoG2TquH0Lo_', 100, NULL, 1, 101, 0, 0, 0, '2016-04-18 13:32:54'),
(86, 8, 1, 33, 1, 1, 1, 98, 'gh 38 fg 5555', 113, NULL, 'kousalya2903@gmail.com', 'cpAXBLXqxmc:APA91bH6HmXp3zXN4hQB3beMNPaBHizFcgAKPwZB1MsltQjwp4D4uKWhYISzOLYVi1HutWJtPUwtrCGKsXIb0806dFxjlQRIivQN5w54ccvHvbhscrGBDg-IvceV_zz-rfmCt3KSB6zY', 200, NULL, 1, 201, 0, 0, 0, '2016-04-18 15:41:36'),
(87, 8, 1, 36, 1, 1, 2, 99, 'ap28aa8888', 113, NULL, 'ravirajak62@gmail.com', 'dG1na05t6Ks:APA91bFhrxIIiagyUuldpwGUT-o-EYXnuLn2i6OAmz-JzL6oO-8gxHsiI7cym8C4jDF-jczWGPhZ1nJEGwQSkgb5Tbm21Gv5KqfdK5tMkysPo8Fi9S9B1nn2Ulapx3zMamXLedytKKdA', 100, NULL, 1, 101, 1, 1, 0, '2016-04-18 15:45:46'),
(88, 8, 1, 34, 1, 1, 2, 96, 'Ts01 aa 1111', 113, NULL, 'ramchikkam@gmail.com', 'fGwNAxwk_GE:APA91bGo55KkymVIi-sFUCUbbgSTI5wUE7cbQgEtyBvBjEge07t0nDiiL1YCruCgUc3DIL2cSMPXo-H3BcdgNqUHeT-12yFaSL04NX8HwByCtt_TAfhr01d1OaQeJ30aIzCvu1nAOL3w', 200, NULL, 1, 201, 0, 1, 0, '2016-04-18 15:55:09'),
(89, 8, 1, 7, 1, 1, 1, 100, 'gh23b4444', 113, NULL, 'nsunkara@gmail.com', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 100, NULL, 1, 101, 0, 1, 0, '2016-04-18 19:41:47'),
(90, 8, 1, 34, 1, 1, 2, 102, 'Erhshsyeuuei', 113, NULL, 'ramchikkam@gmail.com', 'fGwNAxwk_GE:APA91bGo55KkymVIi-sFUCUbbgSTI5wUE7cbQgEtyBvBjEge07t0nDiiL1YCruCgUc3DIL2cSMPXo-H3BcdgNqUHeT-12yFaSL04NX8HwByCtt_TAfhr01d1OaQeJ30aIzCvu1nAOL3w', 100, NULL, 1, 101, 0, 0, 0, '2016-04-19 12:45:57'),
(91, 8, 1, 7, 1, 1, 2, 103, 'jh22h6789', 113, NULL, 'nsunkara@gmail.com', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 100, NULL, 1, 101, 0, 1, 0, '2016-04-19 17:40:46'),
(92, 8, 1, 7, 1, 1, 1, 104, 'mo43m3333', 113, NULL, 'nsunkara@gmail.com', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 200, NULL, 1, 201, 0, 1, 0, '2016-04-19 17:47:02'),
(93, 8, 1, 33, 1, 1, 1, 105, 'gf23f0000', 113, NULL, 'kousalya2903@gmail.com', 'cpAXBLXqxmc:APA91bH6HmXp3zXN4hQB3beMNPaBHizFcgAKPwZB1MsltQjwp4D4uKWhYISzOLYVi1HutWJtPUwtrCGKsXIb0806dFxjlQRIivQN5w54ccvHvbhscrGBDg-IvceV_zz-rfmCt3KSB6zY', 100, NULL, 1, 101, 0, 1, 0, '2016-04-25 00:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE IF NOT EXISTS `user_register` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(10) DEFAULT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `auth_token` varchar(150) DEFAULT NULL,
  `otp` int(4) DEFAULT NULL,
  `otp_flag` tinyint(2) DEFAULT NULL,
  `email_flag` tinyint(2) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `mobile_device_id` varchar(250) DEFAULT NULL,
  `device_type` varchar(10) DEFAULT NULL,
  `facebook_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `mobile_no`, `profile_image`, `created_date`, `auth_token`, `otp`, `otp_flag`, `email_flag`, `activation_code`, `mobile_device_id`, `device_type`, `facebook_id`) VALUES
(1, 'vanga', 'veerababu', 'veerababuvanga@gmail.com', 'ilovekiran', '8466800773', 'http://54.255.128.130/bmtservices/uploads/f1157ba87630da87a0c149f266c5dc301452761706.jpg', '2016-01-06 14:47:49', 'b85092fc72966a696d73168fe427f5b9', 0, 1, 1, '7a8cfd909e82517019e01089efd58c11', NULL, NULL, NULL),
(3, 'ramesh', 'aleti', 'ramesha1@tayatech.com', '12345678', '7207788878', 'http://54.255.128.130/bmtservices/uploads/1459420156.jpg', '2016-01-06 15:01:07', '404bfaaca4e921018b489f26051ba798', 1, 1, NULL, '4800', 'cnJzVU-AXuo:APA91bHtppDR59hbJAg7zQjNDjCWE-tocpMzCQ7SFm2Mn5IPys2u0Y5EKcvdiSxoquaG1OAdjq0EmyNq56LoBdvu0nW7ZiFC7sHIMQbuIYB7kI3kxPszq6M-0P3IVkujCVVty9luESoc', 'android', NULL),
(4, 'nagendra', 'm', 'mvrnagendra55@gmail.com', 'nag@123harish', '9177325679', 'http://54.255.128.130/bmtservices/uploads/1f198dd2b9d37e4aaa71cf608027672e1452249465.jpg', '2016-01-06 15:28:58', '84b16bb263e94f81af5d4437d4d56888', 6049, 1, NULL, '898f34594dbd37802261d04e331d001d', NULL, NULL, NULL),
(5, 'Vijayalakshmi', 'Mundlapati', 'test@gmail.com', '12345678', NULL, 'http://54.255.128.130/bmtservices/uploads/1459859172.jpg', '2016-01-06 15:32:15', '9e0ba9b28feb53969537b6c4fe6baa4e', 5702, 0, 1, NULL, 'c3vDoVkzoHA:APA91bHq8T7KERGCPLgNzzLcB8hn090JZlyhm5Cmw1WTtR13W7-Z8rYxXljhrKCN4Bum87ksw38pZmUBVgPv-QkCirysGLCP0COdgBCvsU4zquYhYkXG1QuZcocxpxTvlGTQY4C-CtSg', 'android', '761058340667359'),
(7, 'Venkat', 'Sunkara', 'nsunkara@gmail.com', 'Tirumala1', '9550851999', 'http://54.255.128.130/bmtservices/uploads/1454396361.jpg', '2016-01-06 16:50:24', 'c1e33b68f888e9db0b634ae450e9f7ca', 7834, 1, NULL, '8077', 'cIH1TRpQ9os:APA91bEUaVNEXkahUTg808GyrC-6q2Gy8RYhtVPCeTroWxxCB_sMqqjsfmA94VqEIzJicIcz_egu21iA4cDan-HBCzTiEptqV16fERrH_q-enkAYJKsyqM9uqZojSbHDEUeeWAufymsG', 'android', NULL),
(8, 'Sumanth', 'T', 'sumanth.thati9@gmail.com', '12345678', '9160606811', 'http://54.255.128.130/bmtservices/uploads/1459492895.jpg', '2016-01-06 16:50:25', 'ada937e5fa3504c88f46998895a9ff16', 5150, 0, 1, '', 'd461f58a194549e1d8f1a161ea6b2d219da09421dc450e6fbdefaba6f7dd332b', 'ios', NULL),
(9, 'lokesh', 't', 'lokesht@tayatech.com', '12345678', '8977212440', NULL, '2016-01-06 16:57:56', 'a81edbf83c082d876d5d0e7c5397c2ed', 0, 1, NULL, '5286', 'fgfsdgsfgadgsadgdsagad', 'ios', NULL),
(10, 'Venkat Narayana', 'Sunkara', 'nsunkara@gmail.com', NULL, NULL, 'http://54.255.128.130/bmtservices/uploads/d9aae8338c02fee21987d171079b77661452080756.jpg', '2016-01-06 17:15:56', '4dd9fe65d3f910149b9a5d4462df6977', NULL, NULL, 1, NULL, NULL, NULL, '1224954937521719'),
(12, 'Lokesh', 'Sahu', 'stlokesh47@gmail.com', NULL, NULL, 'http://54.255.128.130/bmtservices/uploads/57e31787ab3171cf0f662d424ac4e9171452151362.jpg', '2016-01-07 12:52:42', '7b0d727e5ef0a996297c97f76abf1267', NULL, NULL, 1, NULL, NULL, NULL, '903165913112909'),
(13, 'lakshmi', 'keerthi', 'durga.it123@gmail.com', 'sairam123', '9032521718', NULL, '2016-01-07 13:22:49', 'fa9b68407c76f43782e779be76381d65', 0, 1, NULL, '4216', NULL, NULL, NULL),
(14, 'first', 'm', 'test@gmail.com', '12345678', '8967452398', NULL, '2016-01-08 16:44:53', NULL, 0, 1, NULL, '5706', NULL, NULL, NULL),
(15, 'Ram Swaroop', 'Rangisetti', 'swarooprbobby@gmail.com', 'P@ssw0rd', '9885546999', NULL, '2016-01-08 20:30:20', '13a2cf38d8b086fd85debdb93c890f9d', 0, 1, NULL, '5586', NULL, NULL, NULL),
(16, 'Kaladhar', 'Kvk', 'kaladharkvk@gmail.com', NULL, NULL, 'http://54.255.128.130/bmtservices/uploads/7c8586b6ae600c89bdaaa18b0756a6ca1452404988.jpg', '2016-01-10 11:19:48', '9921ed19894a5d0e77f8890358e78ba0', NULL, NULL, 1, NULL, NULL, NULL, '991910937513928'),
(17, 'Vanga', 'Veerababu', 'veerababuvanga@gmail.com', 'ilovekiran', NULL, 'http://54.255.128.130/bmtservices/uploads/f1157ba87630da87a0c149f266c5dc301452591305.jpg', '2016-01-12 15:05:05', 'bdaf07396f8e82d8fd66f414d653af78', NULL, NULL, 1, '7a8cfd909e82517019e01089efd58c11', NULL, NULL, '1561102157546732'),
(18, 'vanga', 'veerababu', 'veerujobs123@gmail.com', 'ilovekiran', '7396382985', NULL, '2016-01-14 12:29:32', NULL, 4833, NULL, NULL, '4833', NULL, NULL, NULL),
(19, 'vanga', 'veerababu', 'veerujobs1234@gmail.com', 'ilovekiran', '9063975593', NULL, '2016-01-14 12:32:37', NULL, 9309, NULL, NULL, '9309', NULL, NULL, NULL),
(20, 'binoj', 'rajan', 'binojrajan@yahoo.com', 'ASDF11111122', '9449830282', NULL, '2016-01-30 18:55:04', '5ba7266469686af7451a803f9e4fa231', 0, 1, NULL, '1341', NULL, NULL, NULL),
(21, 'DFH', 'JKAV', 'SFFJ@GMAIL.COM', 'MIK@125', '9028465729', NULL, '2016-02-03 17:09:45', NULL, 0, 1, NULL, '9586', NULL, NULL, NULL),
(22, 'Mvl', 'M', 'mvl@gmail.com', '12345678', '9988776655', NULL, '2016-03-11 11:32:04', '460c6680658e99e7d55d9c8f7672d05a', 8410, 1, 1, '8410', 'fvojgBfIpBk:APA91bFo8haeZgp9kfVCtOhb0nO1Mtz4Dfu1PJBAE58jTYLXe4gohA2LFWGLUDxn8NmNN8H9_zEE01OhD3ru4eRZ2A0hekujvXW--9PEeT2-Noi-gjHJqPMzQ1_neZ8UkE4vwQIYcxeV', NULL, NULL),
(23, 'user1', 'm', 'user1@gmail.com', '12345678', '9187234567', NULL, '2016-03-15 13:12:48', '624f26a0f817d16b740323e747e69191', 1, 1, NULL, '6185', NULL, NULL, NULL),
(24, 'user2', 'm', 'user2@gmail.com', '12345678', '3214567898', NULL, '2016-03-15 14:48:17', '31fc94938097ed38ca24d42dcc52f49c', 0, 1, 1, '1351', NULL, NULL, NULL),
(25, 'user3', 'm', 'user3@gmail.com', '12345678', '4536781239', NULL, '2016-03-15 16:13:39', '33dfeadbb5f605a88ddd1676a464e57d', 0, 1, 1, '1457', NULL, NULL, NULL),
(26, 'uesr4', 'm', 'user4@gmail.com', '12345678', '2345679812', NULL, '2016-03-16 10:21:30', NULL, 5537, NULL, NULL, '5537', NULL, NULL, NULL),
(27, 'Nagen', 'M', 'mvr@gmail.com', 'nagharish', '1234567891', NULL, '2016-03-16 10:26:17', NULL, 4018, NULL, NULL, '4018', NULL, NULL, NULL),
(28, 'uesr5', 'm', 'user5@gmail.com', '12345678', '6798453221', NULL, '2016-03-16 11:13:30', '7fd1000cb099ba055fcd8db982ebb9d3', 0, 1, NULL, '4159', NULL, NULL, NULL),
(29, 'Vijaya', 'Lakshmi', 'saichandana52.mca123@gmail.com', '12345678', NULL, 'http://54.255.128.130/bmtservices/uploads/e9797959282ef8c75e825084c3c4e5401459918875.jpg', '2016-04-06 10:31:15', '05ad79f1d52543bd401817ac0b329e94', NULL, NULL, 1, NULL, 'cad8ccaa8b3dc13cc5eae882d1f88f89f050b9d7fd62dc03d0b355c19f6f261e', 'ios', '761058340667359'),
(30, 'sai', 'chandana', 'saichandana52.mca@gmail.com', '123456789', '9160606813', 'http://54.255.128.130/bmtservices/uploads/e9797959282ef8c75e825084c3c4e5401459919828.jpg', '2016-04-06 10:42:17', '65c8529de71deabc1a6f7f65bdede14f', 0, 1, NULL, '5396', 'cnJzVU-AXuo:APA91bHtppDR59hbJAg7zQjNDjCWE-tocpMzCQ7SFm2Mn5IPys2u0Y5EKcvdiSxoquaG1OAdjq0EmyNq56LoBdvu0nW7ZiFC7sHIMQbuIYB7kI3kxPszq6M-0P3IVkujCVVty9luESoc', 'android', NULL),
(31, 'Ramesh', 'Aleti', 'ramesha@tayatech.com', '12345678', '7207788873', 'http://54.255.128.130/bmtservices/uploads/1459951231.jpg', '2016-04-06 14:18:45', 'df63943c8a875e078948620de9fc2f99', 0, 1, NULL, '3996', 'dlWorr5Lmzo:APA91bFTSkaiM6R-OJkC7zdx854VWy5Y_9MPAtv5-VTIqGF026UiRZPAPW2hFhe2dJQrwXYNOaHB0nEeVUIIwgjRggydKy-pqH2gciFrGkP_tAqA6b3GXe-m5ok0U33ChDhEUHhPEnyP', 'android', NULL),
(32, 'lokesh', 's', 'ls@gmail.com', '12345678', '9988772244', NULL, '2016-04-14 18:36:28', 'b770651d0f6d7278c528a020c74e040f', 0, 1, 1, '1900', 'c3vDoVkzoHA:APA91bHq8T7KERGCPLgNzzLcB8hn090JZlyhm5Cmw1WTtR13W7-Z8rYxXljhrKCN4Bum87ksw38pZmUBVgPv-QkCirysGLCP0COdgBCvsU4zquYhYkXG1QuZcocxpxTvlGTQY4C-CtSg', 'android', NULL),
(33, 'kousalya', 'sunkara', 'kousalya2903@gmail.com', 'sarita29', '9550862999', NULL, '2016-04-17 20:01:29', '301b41c087569b75bb7c214c646996ef', 0, 1, NULL, '2368', 'cpAXBLXqxmc:APA91bH6HmXp3zXN4hQB3beMNPaBHizFcgAKPwZB1MsltQjwp4D4uKWhYISzOLYVi1HutWJtPUwtrCGKsXIb0806dFxjlQRIivQN5w54ccvHvbhscrGBDg-IvceV_zz-rfmCt3KSB6zY', 'android', NULL),
(34, 'Ramakrishna', 'Chikkam', 'ramchikkam@gmail.com', 'ishan911', '8333836677', NULL, '2016-04-18 09:03:24', '565f3c78a070280ca66ae7acad1df3fd', 0, 1, NULL, '6980', 'fGwNAxwk_GE:APA91bGo55KkymVIi-sFUCUbbgSTI5wUE7cbQgEtyBvBjEge07t0nDiiL1YCruCgUc3DIL2cSMPXo-H3BcdgNqUHeT-12yFaSL04NX8HwByCtt_TAfhr01d1OaQeJ30aIzCvu1nAOL3w', 'android', NULL),
(35, 'Abhimanyu', 'Eati', 'abhimanyu.369@gmail.com', 'anuabhilovers', '7095050954', NULL, '2016-04-18 11:09:19', 'e79e78ee6768b3d24fea078458d5a368', 0, 1, NULL, '8094', 'evlx1sgh3TA:APA91bFHZ-f6jBc8zMUCh9UsSmUGhjiQ-aRRg0fPwyUhnmPxfcZktfZ_PsHDrX5LdEbVoBrPlvsYBOJ3Uvt5A8wvKxqcDtcmDhCJCa90G9qoxFP_HnjZOkjuqyUZGnoIWoG2TquH0Lo_', 'android', NULL),
(36, 'ravi', 'rajak', 'ravirajak62@gmail.com', '1234567890', '8969985577', NULL, '2016-04-18 15:15:17', '7b30b393786c466c8c1da851e420639c', 0, 1, NULL, '3134', 'dG1na05t6Ks:APA91bFhrxIIiagyUuldpwGUT-o-EYXnuLn2i6OAmz-JzL6oO-8gxHsiI7cym8C4jDF-jczWGPhZ1nJEGwQSkgb5Tbm21Gv5KqfdK5tMkysPo8Fi9S9B1nn2Ulapx3zMamXLedytKKdA', 'android', NULL),
(37, 'Ratheesh', 'P K', 'ratheesh.pk@gmail.com', 'achusmom', '9886154560', NULL, '2016-04-19 17:46:55', '2a30b29c139133c67b321388d9852497', 6616, NULL, 1, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `model_id` int(11) NOT NULL,
  `vehicle_no` varchar(50) NOT NULL,
  `way_type` varchar(10) DEFAULT NULL,
  `enable_status` enum('0','1') NOT NULL DEFAULT '1',
  `default_status` enum('0','1') NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `status_flag` enum('0','1') NOT NULL DEFAULT '1',
  `paid_status` enum('0','1') NOT NULL DEFAULT '0',
  `passing_status` enum('0','1') NOT NULL DEFAULT '0',
  UNIQUE KEY `vehicle_id` (`vehicle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `user_id`, `model_id`, `vehicle_no`, `way_type`, `enable_status`, `default_status`, `created_date`, `status_flag`, `paid_status`, `passing_status`) VALUES
(1, 3, 1, 'AP 12 HY 1234', NULL, '1', '0', '2016-01-06 15:02:38', '1', '1', '1'),
(2, 3, 1, 'AP 34 GH 4366', NULL, '1', '0', '2016-01-06 16:24:37', '1', '1', '1'),
(3, 3, 1, 'zz 22 ff 5555', NULL, '1', '0', '2016-01-06 16:31:19', '1', '1', '1'),
(4, 8, 2, 'GH 45 GH 3456', NULL, '1', '0', '2016-01-06 16:55:33', '0', '1', '1'),
(5, 7, 1, 'aa 99 m 5555', NULL, '1', '0', '2016-01-06 16:57:57', '0', '1', '1'),
(6, 7, 2, 'pp 55 GH 5555', NULL, '1', '0', '2016-01-06 17:00:19', '0', '1', '1'),
(7, 9, 1, 'ap 34 fg 1234', NULL, '1', '1', '2016-01-06 17:05:07', '1', '1', '1'),
(8, 8, 1, 'Hj 56 hj 4567', NULL, '1', '0', '2016-01-06 17:09:20', '0', '1', '1'),
(9, 10, 2, 'gh 33 gf 1234', NULL, '1', '1', '2016-01-06 17:32:36', '1', '1', '0'),
(10, 6, 1, 'TS 07 EQ 6555', NULL, '1', '1', '2016-01-06 17:32:38', '1', '1', '1'),
(11, 10, 1, 'KL 34 BA 1234', NULL, '1', '0', '2016-01-06 17:33:35', '1', '1', '0'),
(12, 12, 1, 'AP 22 SS 4569', NULL, '1', '1', '2016-01-07 12:53:00', '1', '1', '0'),
(13, 3, 1, 'GH 12 FG 5555', NULL, '1', '0', '2016-01-07 13:10:46', '1', '1', '1'),
(14, 8, 1, 'as 45 bu 6789', NULL, '1', '0', '2016-01-07 13:15:01', '1', '1', '1'),
(15, 13, 1, 'df 45 yu 4567', NULL, '1', '1', '2016-01-07 13:25:35', '1', '1', '0'),
(16, 3, 1, 'ap 55gg 1647', NULL, '1', '0', '2016-01-07 14:34:31', '1', '0', '0'),
(17, 3, 1, 'ap55hh1547', NULL, '1', '0', '2016-01-08 08:50:33', '1', '1', '1'),
(18, 3, 1, 'ap 16 hj 1715', NULL, '1', '0', '2016-01-08 15:02:50', '1', '0', '0'),
(19, 3, 2, 'hk 65hg 7165', NULL, '1', '0', '2016-01-08 15:03:31', '1', '0', '0'),
(20, 12, 1, 'Ap 23 fr 2345', NULL, '1', '0', '2016-01-08 17:04:53', '1', '0', '0'),
(21, 4, 1, 'AP 09 AP 9999', NULL, '1', '1', '2016-01-08 17:32:50', '1', '0', '0'),
(22, 20, 1, 'AP 12 HY 1289', NULL, '1', '1', '2016-01-30 18:57:05', '1', '0', '0'),
(23, 7, 1, 'Ap05 8788', NULL, '1', '0', '2016-02-01 16:28:29', '0', '0', '0'),
(24, 7, 2, 'AP06 tg 1233', NULL, '1', '0', '2016-02-02 12:32:11', '0', '0', '0'),
(25, 8, 1, 'AP1254ff', NULL, '0', '0', '2016-03-04 16:17:39', '1', '1', '1'),
(26, 5, 1, 'AS 43 DF 2354', NULL, '1', '0', '2016-03-09 12:01:23', '1', '1', '0'),
(27, 8, 1, 'LA 13 HH 1234', NULL, '1', '0', '2016-03-10 11:25:51', '1', '1', '1'),
(29, 22, 1, 'GH 45 Yu 1234', NULL, '1', '0', '2016-03-11 16:20:26', '1', '1', '0'),
(30, 22, 2, 'SW 45 FG 5634', NULL, '1', '1', '2016-03-11 16:30:58', '1', '0', '0'),
(31, 23, 1, 'GH 45 fg 7856', NULL, '1', '1', '2016-03-15 13:15:24', '1', '1', '0'),
(32, 24, 2, 'GH 45 fg 6534', NULL, '1', '0', '2016-03-15 14:49:00', '1', '1', '1'),
(33, 24, 1, 'GH 45 fg 1234', NULL, '1', '1', '2016-03-15 16:08:36', '1', '1', '1'),
(34, 25, 2, 'GH 45 fg 1432', NULL, '1', '1', '2016-03-15 16:14:40', '1', '1', '0'),
(35, 28, 1, 'SA 56 HJ 7654', NULL, '1', '1', '2016-03-25 17:42:01', '1', '1', '1'),
(36, 5, 1, 'ZF 45 DF 5643', NULL, '1', '0', '2016-03-31 15:56:37', '1', '0', '0'),
(37, 3, 1, 'fhhgfg', NULL, '1', '0', '2016-04-01 12:05:29', '1', '0', '0'),
(38, 8, 1, 'AP 27 DD 1234', NULL, '1', '0', '2016-04-04 10:29:01', '0', '1', '1'),
(39, 8, 1, 'Ap 44  ft  2456', NULL, '1', '0', '2016-04-04 11:05:09', '0', '1', '1'),
(40, 8, 1, 'Ap 66 the 1234', NULL, '1', '0', '2016-04-04 17:40:50', '0', '1', '1'),
(41, 8, 1, 'We 55 666775', NULL, '1', '0', '2016-04-04 17:47:01', '0', '0', '0'),
(42, 8, 1, 'Ash 54 hhh 356', NULL, '1', '0', '2016-04-04 17:52:17', '0', '1', '1'),
(43, 8, 1, 'RR 48 GH 0987', NULL, '0', '1', '2016-04-04 18:23:26', '1', '1', '1'),
(44, 5, 1, 'Ap45gh654', NULL, '1', '0', '2016-04-05 12:05:12', '1', '0', '0'),
(45, 5, 2, 'Are 56 gh 689', NULL, '1', '0', '2016-04-05 12:05:33', '1', '0', '0'),
(46, 5, 2, 'Awesome 78 hj 5678', NULL, '1', '0', '2016-04-05 12:05:57', '1', '0', '0'),
(47, 5, 2, 'Ap 45 yy 6789', NULL, '1', '0', '2016-04-05 12:06:36', '1', '0', '0'),
(48, 5, 1, 'Ad 56 ty 6890', NULL, '1', '0', '2016-04-05 12:06:54', '1', '0', '0'),
(49, 5, 1, 'Ap 28 dd 1252', NULL, '1', '0', '2016-04-05 12:07:23', '1', '0', '0'),
(50, 5, 1, 'At 45 yh6889', NULL, '1', '0', '2016-04-05 12:07:40', '1', '0', '0'),
(51, 5, 1, 'Ac 67 tt 6789', NULL, '1', '0', '2016-04-05 12:08:09', '1', '0', '0'),
(52, 5, 1, 'At gym 6888 hb', NULL, '1', '0', '2016-04-05 12:08:28', '1', '0', '0'),
(53, 5, 2, 'Ap test', NULL, '1', '0', '2016-04-05 12:09:25', '1', '0', '0'),
(54, 5, 1, 'Apty56hh685', NULL, '1', '0', '2016-04-05 12:15:57', '1', '0', '0'),
(55, 8, 2, 'Bbbbbh', NULL, '1', '0', '2016-04-05 12:16:53', '0', '0', '0'),
(56, 5, 1, 'Qpq67ha7897', NULL, '1', '0', '2016-04-05 12:28:55', '1', '0', '0'),
(57, 5, 2, 'Jaha78877', NULL, '1', '0', '2016-04-05 12:29:17', '1', '1', '0'),
(58, 5, 1, 'Ad ghhh 3554', NULL, '1', '0', '2016-04-05 16:50:54', '1', '0', '0'),
(59, 3, 1, 'Ap 45 gh 4567', NULL, '1', '0', '2016-04-05 16:55:00', '1', '0', '0'),
(60, 5, 1, 'Ap 28 DD 1252', NULL, '1', '0', '2016-04-05 19:18:14', '1', '1', '0'),
(61, 29, 1, 'SA 43 FG 2354', NULL, '1', '0', '2016-04-06 10:31:45', '1', '0', '0'),
(62, 30, 1, 'AS 34 FG 2365', NULL, '1', '0', '2016-04-06 10:47:23', '1', '1', '1'),
(63, 30, 1, 'DG 45 GG 5678', NULL, '1', '0', '2016-04-06 10:51:13', '1', '1', '1'),
(64, 30, 1, 'Fg 56 ty 3557', NULL, '1', '0', '2016-04-06 11:04:18', '1', '0', '0'),
(65, 30, 2, 'Ap 12 ff 4567', NULL, '1', '0', '2016-04-06 11:05:05', '1', '0', '1'),
(66, 29, 1, 'As 12 try 1234', NULL, '1', '1', '2016-04-06 11:14:48', '1', '0', '0'),
(67, 5, 1, 'Ap 12 bb 1457', NULL, '1', '0', '2016-04-06 11:31:54', '1', '1', '0'),
(68, 5, 1, 'Ap 23 gh 1356', NULL, '1', '0', '2016-04-06 11:56:33', '1', '0', '0'),
(69, 3, 1, 'Ap 56 gig 6899', NULL, '1', '1', '2016-04-06 12:06:27', '1', '0', '0'),
(70, 5, 1, 'Ap 38 h 5688', NULL, '1', '0', '2016-04-06 14:23:36', '1', '0', '0'),
(71, 31, 1, 'Ap 65 yy 1234', NULL, '1', '0', '2016-04-06 14:30:01', '1', '0', '0'),
(72, 31, 1, 'AP 34 TT 2754', NULL, '1', '0', '2016-04-06 14:39:06', '1', '1', '1'),
(73, 31, 1, 'Ts07eq6555', NULL, '1', '1', '2016-04-06 19:33:08', '1', '0', '0'),
(74, 32, 1, 'lk 34 gh 1234', NULL, '1', '1', '2016-04-14 18:38:30', '1', '0', '0'),
(75, 30, 1, 'Gh 45 gh 2345', NULL, '1', '1', '2016-04-14 19:04:54', '1', '0', '0'),
(76, 5, 1, '123456788', NULL, '1', '0', '2016-04-17 14:17:18', '1', '0', '0'),
(77, 5, 1, 'gsgshhshsjsjs', NULL, '1', '1', '2016-04-17 14:19:25', '1', '0', '0'),
(78, 5, 1, 'yyuuuyuuh', NULL, '1', '0', '2016-04-17 16:41:43', '1', '0', '0'),
(79, 7, 1, 'ap 12 db 1235', NULL, '1', '0', '2016-04-17 17:26:00', '0', '1', '1'),
(80, 7, 2, 'ka 51m2874', NULL, '1', '0', '2016-04-17 18:03:52', '0', '1', '1'),
(81, 33, 2, 'AP 28 DH 4829', NULL, '1', '0', '2016-04-17 20:03:10', '1', '1', '1'),
(82, 7, 2, 'KL 01 4927', NULL, '1', '0', '2016-04-17 20:18:25', '1', '1', '1'),
(83, 33, 2, 'ap08kl1234', NULL, '1', '0', '2016-04-17 20:19:16', '1', '0', '0'),
(84, 33, 1, 'MH12M2867', NULL, '1', '0', '2016-04-17 20:24:18', '1', '1', '1'),
(85, 33, 1, 'up12m1233', NULL, '1', '0', '2016-04-17 20:36:53', '1', '1', '1'),
(86, 33, 1, 'jh23ab1234', NULL, '1', '0', '2016-04-17 21:13:16', '1', '0', '0'),
(87, 34, 1, 'AP09 gh 3208', NULL, '1', '0', '2016-04-18 09:07:24', '0', '1', '1'),
(88, 34, 1, 'AP09 cc 3208', NULL, '1', '0', '2016-04-18 09:21:20', '0', '0', '0'),
(89, 34, 2, 'AP09 bw 4488', NULL, '1', '0', '2016-04-18 09:25:19', '0', '1', '1'),
(90, 34, 1, 'AP09 dh 4829', NULL, '1', '0', '2016-04-18 09:32:55', '0', '0', '0'),
(91, 34, 1, 'Ap10 bw 4489', NULL, '1', '0', '2016-04-18 09:36:15', '0', '1', '1'),
(92, 34, 1, 'AP09 bw 4499', NULL, '1', '0', '2016-04-18 09:41:40', '0', '1', '1'),
(93, 35, 1, 'Ap 09 aa 9999', NULL, '1', '0', '2016-04-18 11:11:23', '1', '0', '0'),
(94, 34, 1, 'AP09 bw 4444', NULL, '1', '0', '2016-04-18 13:30:54', '1', '1', '1'),
(95, 35, 2, 'Ap 9 cm 1234', NULL, '1', '1', '2016-04-18 13:56:58', '1', '0', '0'),
(96, 34, 2, 'Ts01 aa 1111', NULL, '1', '0', '2016-04-18 13:57:30', '1', '1', '0'),
(97, 36, 1, 'ta07b4090', NULL, '1', '0', '2016-04-18 15:18:13', '1', '0', '0'),
(98, 33, 1, 'gh 38 fg 5555', NULL, '1', '0', '2016-04-18 15:20:50', '1', '0', '0'),
(99, 36, 2, 'ap28aa8888', NULL, '1', '1', '2016-04-18 15:31:19', '1', '1', '1'),
(100, 7, 1, 'gh23b4444', NULL, '1', '0', '2016-04-18 19:38:08', '1', '1', '0'),
(101, 34, 1, 'Ap10 cc 3205', NULL, '1', '0', '2016-04-18 19:39:46', '1', '0', '0'),
(102, 34, 2, 'Erhshsyeuuei', NULL, '1', '1', '2016-04-19 12:45:25', '1', '0', '0'),
(103, 7, 2, 'jh22h6789', NULL, '1', '0', '2016-04-19 17:34:20', '1', '1', '0'),
(104, 7, 1, 'mo43m3333', NULL, '1', '1', '2016-04-19 17:41:34', '1', '1', '0'),
(105, 33, 1, 'gf23f0000', NULL, '1', '1', '2016-04-25 00:11:11', '1', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_make`
--

CREATE TABLE IF NOT EXISTS `vehicle_make` (
  `make_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `make_name` varchar(50) NOT NULL,
  UNIQUE KEY `make_id` (`make_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vehicle_make`
--

INSERT INTO `vehicle_make` (`make_id`, `type_id`, `make_name`) VALUES
(1, 1, 'Honda'),
(2, 1, 'Maruthi');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_model`
--

CREATE TABLE IF NOT EXISTS `vehicle_model` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `make_id` int(11) DEFAULT NULL,
  `model_name` varchar(16) DEFAULT NULL,
  UNIQUE KEY `model_id` (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vehicle_model`
--

INSERT INTO `vehicle_model` (`model_id`, `type_id`, `make_id`, `model_name`) VALUES
(1, 1, 1, 'City'),
(2, 1, 2, 'Swift');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE IF NOT EXISTS `vehicle_type` (
  `type_id` int(10) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL,
  UNIQUE KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`type_id`, `type_name`) VALUES
(1, 'Car or Jeep Or Van'),
(2, 'LCV'),
(3, 'Bus or Truck'),
(4, 'Upto 3 Axle Vehicle'),
(5, '4 to 6 Axle '),
(6, 'HCM/EME'),
(7, '7 or More Axle');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE IF NOT EXISTS `wallet` (
  `wallet_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `wallet_amount` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `wallet_id` (`wallet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
