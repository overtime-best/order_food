-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 07:43 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_username` varchar(150) NOT NULL,
  `admin_password` char(30) NOT NULL,
  `admin_email` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_email`) VALUES
(6, 'moham', 'mamado', 'mamadeo', 'mamadeo@c.gl'),
(7, 'Mustafa Mohammed', 'mohyaldeenmadeboosman123@gmail.com', 'boy', 'mohyaldeenmadeboosman123@gmail'),
(8, 'mohy', 'mohyaldeenmadeboosman123@gmail.com', 'boy', 'dddd@co.c'),
(9, 'overtime', 'over', 'mod', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(10) UNSIGNED NOT NULL,
  `cat_title` varchar(150) NOT NULL,
  `cat_price` decimal(10,2) NOT NULL,
  `cat_imageName` varchar(150) NOT NULL,
  `cat_featured` varchar(10) NOT NULL,
  `cat_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_title`, `cat_price`, `cat_imageName`, `cat_featured`, `cat_status`) VALUES
(1, 'fruits', '0.00', 'cat_922.jpg', 'yes', 'yes'),
(2, 'Vegetables', '0.00', 'cat_320.jpg', 'yes', 'yes'),
(3, 'Meats', '0.00', 'cat_341.jpg', 'yes', 'yes'),
(4, 'pills', '0.00', 'cat_155.jpg', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `food_id` int(11) NOT NULL,
  `food_title` varchar(150) NOT NULL,
  `food_desc` text NOT NULL,
  `food_price` decimal(10,2) NOT NULL,
  `food_imageName` varchar(255) NOT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL,
  `food_featured` char(10) NOT NULL,
  `food_status` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`food_id`, `food_title`, `food_desc`, `food_price`, `food_imageName`, `cat_id`, `food_featured`, `food_status`) VALUES
(1, 'Rize', 'Rice is a cereal classified as either a whole or a refined grain. Whole grains contain the entire grain. When rice is ground, it becomes refined and loses essential nutrients, but it sometimes has better flavor or improved shelf life', '350.00', 'food_822.jpg', 4, 'yes', 'no'),
(2, 'Strawberry', 'Strawberries are very rich in antioxidants and plant compounds, which may have benefits for heart health and blood sugar control', '670.00', 'food_719.jpg', 1, 'yes', 'yes'),
(3, 'Mango', 'Mangos are a good source of protective compounds with antioxidant properties, these plant chemicals include gallotannins and mangiferin. Both have been studied for their ability to counter the oxidative stress associated with day to day living and exposure to toxins.', '400.00', 'food_935.jpg', 1, 'no', 'no'),
(5, 'tomatoes', 'Tomatoes are the major dietary source of the antioxidant lycopene, which has been linked to many health benefits, including reduced risk of heart disease and cancer.', '280.00', 'food_991.jpg', 2, 'yes', 'yes'),
(6, 'potatos', ' longer. Fiber can help prevent heart disease by keeping cholesterol and blood sugar levels in check. Potatoes are also full of antioxidants that work to prevent diseases and vitamins that help your body function properly', '150.00', 'food_587.jpg', 2, 'yes', 'yes'),
(7, 'Pizza', 'The average slice of pizza contains 12 grams of protein. ... Pizza can help you absorb the antioxidant Lycopene. ... Fresh veggies are one of the healthiest toppings! ... Thin-crust pizza offers a better-balanced meal. ... Pizza is a better breakfast option than some cereals', '750.00', 'food_737.jpg', 3, 'yes', 'yes'),
(8, 'purger', ' comes to Chapps\' top notch beef. Protein presents your body\'s source of energy, it builds muscle as well as gives structure to the cells. Depending on their lifestyle and diet, people need between 50 and 175 grams of protein per day.', '1200.00', 'food_401.jpg', 3, 'no', 'yes'),
(9, 'Green Beans', 'Green beans contain no cholesterol. Although your body needs some cholesterol for healthy cell growth, too much is bad for you. High cholesterol may lead to a build-up of fat deposits in your arteries. This can decrease blood flow to your heart and brain and cause a heart attack or stroke', '1500.00', 'food_448.jpg', 4, 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `order_food` varchar(150) NOT NULL,
  `order_price` decimal(10,2) NOT NULL,
  `order_qte` int(11) NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` char(10) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(150) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_food`, `order_price`, `order_qte`, `order_total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(5, 'Pizza', '750.00', 1, '750.00', '2022-05-12 11:41:55', 'orderd', 'mohyaldeen madebo osman ', '90193870', 'overtime@gmail.com', 'Alfasher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
