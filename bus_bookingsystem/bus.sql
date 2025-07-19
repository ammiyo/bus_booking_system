-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 25, 2025 at 01:27 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uemail` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `uphone` varchar(100) NOT NULL,
  `ugender` varchar(100) NOT NULL,
  `uaddress` varchar(100) NOT NULL,
  `ucity` varchar(100) NOT NULL,
  `ustate` varchar(100) NOT NULL,
  `upin` varchar(100) NOT NULL,
  `upassword` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `uemail`, `uname`, `uphone`, `ugender`, `uaddress`, `ucity`, `ustate`, `upin`, `upassword`) VALUES
(4, 's@gmail.com', 'Harjinder Singh', '07002345114', 'Male', 'Dhsk College, Dibrugarh\r\nPODUM NAGAR BYE LANE 2 OPPOSITE PUBLIC HIGH SCHOOL', 'Dibrugarh', 'Assam', '786001', '111'),
(5, 'a@gmail.com', 'ABHISHEK KR SINGH', '', 'Male', 'Paltan Bazar\r\nTHANA CHARIALI', 'Dibrugarh', 'Assam', '786001', '123'),
(6, 'aryan@gmail.com', 'Aryan kr Ekka', '8022222222', 'Male', 'Paltan Bazar, Near Masjid\r\nPODUM NAGAR BYE LANE 2 OPPOSITE PUBLIC HIGH SCHOOL', 'DIBRUGARH', 'Assam', '786001', '123');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adminid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminid`) VALUES
(1, 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bus_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `travel_date` varchar(100) NOT NULL,
  `notes` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `bus_id`, `user_email`, `travel_date`, `notes`) VALUES
(9, 8, 's@gmail.com', '2025-05-10', 'dcdchbdchbhdcbh'),
(11, 9, 'aryan@gmail.com', '2025-05-19', 'dcbcdhbdch'),
(12, 9, 's@gmail.com', '2025-05-10', 'hbh');

-- --------------------------------------------------------

--
-- Table structure for table `bus_details`
--

DROP TABLE IF EXISTS `bus_details`;
CREATE TABLE IF NOT EXISTS `bus_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bid` int NOT NULL,
  `bstart` varchar(100) NOT NULL,
  `bend` varchar(100) NOT NULL,
  `btype` varchar(100) NOT NULL,
  `fare` varchar(50) NOT NULL,
  `bstatus` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bus_details`
--

INSERT INTO `bus_details` (`id`, `bid`, `bstart`, `bend`, `btype`, `fare`, `bstatus`) VALUES
(12, 9, 'Dibrugarh', 'Golaghat', 'AC', '800', ''),
(11, 8, 'Margherita', 'Jorhat', 'AC', '800', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `bus_route`
--

DROP TABLE IF EXISTS `bus_route`;
CREATE TABLE IF NOT EXISTS `bus_route` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bid` int NOT NULL,
  `route` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bus_route`
--

INSERT INTO `bus_route` (`id`, `bid`, `route`) VALUES
(35, 8, 'Margherita 8 AM\r\nDibrugarh 10 AM\r\nMoran 11 AM\r\nSibsagar 1 PM\r\nJorhat 3 PM'),
(36, 9, 'Dib: 8 AM\r\nMoran: 9 AM\r\nSibsagar: 11 AM\r\nJorhat: 1 PM\r\nGolaghat: 3 PM');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `oname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `bno` varchar(100) NOT NULL,
  `bchasis` varchar(100) NOT NULL,
  `bengine` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `bname`, `oname`, `email`, `phone`, `bno`, `bchasis`, `bengine`) VALUES
(9, 'Malavika', 'Pratham Debnath', 'p@gmail.com', '8011223344', 'AS23AG1234', 'AGAG1111', 'BHCDBHDB1991919199'),
(8, 'Shiva Travels', 'Ammiyo Paul', 'a@gmail.com', '7002345114', 'AS06AG1879', 'SHBDCDCB', 'DCBHDCBHDC9191919');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
