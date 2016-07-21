-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 27, 2016 at 07:46 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shopunified`
--
CREATE DATABASE IF NOT EXISTS `shopunified` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shopunified`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` bigint(20) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'vehicle'),
(2, 'vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `emp_id` bigint(12) NOT NULL,
  `emp_name` varchar(30) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_position` int(2) NOT NULL,
  `emp_add_date` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_email`, `emp_position`, `emp_add_date`) VALUES
(3, 'Yathukrishna K T', 'yathukrishnakt@gmail.com', 1, '2016-03-12'),
(4, 'Abhijith P R', 'abhijithpr22@gmail.com', 2, '2016-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

DROP TABLE IF EXISTS `sell`;
CREATE TABLE `sell` (
  `sell_id` bigint(20) NOT NULL,
  `category_id` int(10) NOT NULL,
  `sub_category_id` bigint(20) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_price` bigint(10) NOT NULL,
  `prod_description` varchar(200) NOT NULL,
  `prod_img` varchar(50) NOT NULL,
  `added_date` varchar(20) NOT NULL,
  `sell_lat` double NOT NULL,
  `sell_lon` double NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sell_id`, `category_id`, `sub_category_id`, `prod_name`, `prod_price`, `prod_description`, `prod_img`, `added_date`, `sell_lat`, `sell_lon`, `user_id`) VALUES
(1, 0, 0, 'Edunified', 0, '', '', '15-03-16', 0, 0, 8),
(2, 0, 0, 'bike', 25000, 'new one', '', '15-03-16', 10.450234544532291, 76.72758984375002, 8),
(3, 0, 0, 'Edunified', 0, '', '15_03_16_10_49_58_PMxhsid.jpeg', '15-03-16', 0, 0, 8),
(4, 1, 4, 'Car', 10000, 'its old one', '15_03_16_10_53_37_PMvxwrk.jpeg', '15-03-16', 10.405664456239851, 76.3911335449219, 8),
(5, 0, 0, 'Baleno', 3000, 'Nice car , it is super one 200 cc milage', '16_03_16_11_29_21_PMmjzul.jpeg', '16-03-16', 10.082680527736558, 77.06267285156252, 8),
(6, 0, 0, 'lory', 80000, 'its old one', '16_03_16_11_38_21_PMprshu.jpeg', '16-03-16 11:38:21', 10.784979125590802, 76.67265820312502, 8);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `shop_id` bigint(20) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `shop_tag` varchar(100) NOT NULL,
  `shop_website` varchar(50) NOT NULL,
  `shop_address` varchar(100) NOT NULL,
  `shop_contact` varchar(10) NOT NULL,
  `shop_lat` double NOT NULL,
  `shop_lon` double NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `shop_name`, `shop_tag`, `shop_website`, `shop_address`, `shop_contact`, `shop_lat`, `shop_lon`, `user_id`) VALUES
(1, 'Jees', 'heee', 'sdfg.com', 'sgtdrfg', '9633450333', 55, 23, 1),
(2, 'Edunified', 'He he', 'edunified.com', 'Pathrayil House,', '9048159692', 11, 77, 0),
(3, 'Mummy', 'silks saree', 'mumy.com', 'Kombath House,', '9048159692', 10.415119250379856, 76.2702839355469, 0),
(4, 'g', 'unity in study', 'edunified.com', 'Pathrayil House,', '7736736668', 10.34217485902655, 76.46391796875002, 0),
(5, 'Jees', 'silks saree', 'edunified.com', 'Pathrayil House,', '9048159692', 10.358386192728073, 76.57927441406252, 0),
(6, 'Jes', 'unity in study', 'edunified.com', 'Pathrayil House,', '7736736667', 10.450234544532291, 76.54631542968752, 8);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE `sub_category` (
  `sub_cat_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `sub_cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_cat_id`, `category_id`, `sub_cat_name`) VALUES
(1, 1, 'jeep'),
(2, 2, 'potato'),
(3, 2, 'tomato'),
(4, 1, 'car');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email_id` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `activation` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_id`, `password`, `activation`) VALUES
(1, 'Jees', 'K Denny', 'jees.jees5@gmail.com', '202cb962ac59075b964b07152d234b70', 'ba51e6158bcaf80fd0d834950251e693'),
(2, 'Jees', 'K Denny', 'jeeskdenny@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(3, 'Jees', 'K Denny', 'jees@gmail.com', '202cb962ac59075b964b', ''),
(4, 'Jees ', 'K Denny', 'chaco@gmail.com', '202cb962ac59075b964b', ''),
(5, 'chaco', 'mash', 'mash@gmail.com', '202cb962ac59075b964b', ''),
(6, 'abhijith', 'PR', 'abhijith@gmail.com', '202cb962ac59075b964b', ''),
(7, 'Jees ', 'K Denny', 'muthu@gmail.com', '202cb962ac59075b964b', ''),
(8, 'Jincy', 'K Denny', 'jincy@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(9, '', '', '', '', ''),
(10, 'Abhijith', 'R', 'abhijithpr22@gmail.com', '202cb962ac59075b964b07152d234b70', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sell_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email id` (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` bigint(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `sell_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_cat_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;