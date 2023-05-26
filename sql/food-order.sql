-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 11:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Full_Name` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`ID`, `Full_Name`, `Username`, `Password`) VALUES
(34, 'admin2', 'admin2', 'c84258e9c39059a89ab77d846ddab909'),
(38, 'Mwagambo', 'mwagambo', '8747549586b9a370dd86247658d81228'),
(39, 'mwagambo2', 'mwagambo2', '8747549586b9a370dd86247658d81228');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(28, 'Pizza', 'food_category_326.jpg', 'Yes', 'Yes'),
(29, 'Burger', 'food_category_84.jpg', 'Yes', 'Yes'),
(30, 'Dumpling', 'food_category_82.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(97, 'Pizza', 'Hawaiian', '400.00', 'food_name_4014.jpg', 28, 'Yes', 'Yes'),
(98, 'Bazu Burger', 'meat burger', '600.00', 'food_name_8345.jpg', 29, 'Yes', 'Yes'),
(99, 'Momo', 'Special Momo', '500.00', 'food_name_9702.jpg', 30, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(97, 'Pizza', '400.00', 768, '307200.00', '2023-05-25 07:19:29', 'On Delivery', 'Kevyn Rodriguez', '+1 (878) 209-8196', 'filuxesy@mailinator.com', 'Repudiandae aute nih'),
(98, 'Bazu Burger', '600.00', 298, '178800.00', '2023-05-25 07:19:38', 'Ordered', 'Jolene Massey', '+1 (599) 603-7203', 'bopy@mailinator.com', 'Eaque dolor ipsum a'),
(99, 'Momo', '500.00', 849, '424500.00', '2023-05-25 07:19:45', 'Ordered', 'Irma Case', '+1 (179) 182-3096', 'kuwuxade@mailinator.com', 'Fugiat quam sed qua'),
(102, 'Pizza', '400.00', 812, '324800.00', '2023-05-25 07:33:50', 'Cancelled', 'Lila Bridges', '+1 (631) 265-1495', 'raxibykar@mailinator.com', 'Repudiandae est sint'),
(103, 'Bazu Burger', '600.00', 459, '275400.00', '2023-05-25 07:33:57', 'Cancelled', 'Xyla Holder', '+1 (814) 171-5557', 'xurakaj@mailinator.com', 'Reprehenderit omnis'),
(104, 'Pizza', '400.00', 124, '49600.00', '2023-05-25 07:35:02', 'Delivered', 'Cole Hester', '+1 (397) 704-8503', 'radisi@mailinator.com', 'Enim et asperiores n'),
(105, 'Momo', '500.00', 241, '120500.00', '2023-05-25 07:35:10', 'Ordered', 'Jarrod Head', '+1 (712) 184-7243', 'nukijivyri@mailinator.com', 'Corporis sed pariatu'),
(106, 'Momo', '500.00', 485, '242500.00', '2023-05-25 07:37:00', 'Delivered', 'Eden Harding', '+1 (951) 637-6435', 'sytabe@mailinator.com', 'Autem aspernatur odi'),
(107, 'Pizza', '400.00', 1, '400.00', '2023-05-25 07:37:56', 'Ordered', 'Martin Mwagambo', '0792453373', '19/02803@students.kcau.ac.ke', '41584'),
(108, 'Bazu Burger', '600.00', 32, '19200.00', '2023-05-25 09:17:29', 'Delivered', 'Luke Hudson', '+1 (506) 327-2082', 'sabedife@mailinator.com', 'Ut aut fugiat quos t');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
