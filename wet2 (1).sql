-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2017 at 03:19 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wet2`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(333) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(333) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address`, `zip`, `city`) VALUES
(3, 'admin', 1200, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bestellung`
--

CREATE TABLE `bestellung` (
  `invoice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderedproducts`
--

CREATE TABLE `orderedproducts` (
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `anrede` varchar(333) NOT NULL,
  `vorname` varchar(333) NOT NULL,
  `nachname` varchar(333) NOT NULL,
  `email` varchar(333) NOT NULL,
  `payment` varchar(333) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `a_id`, `anrede`, `vorname`, `nachname`, `email`, `payment`) VALUES
(3, 3, 'Male', 'admin', 'admin', 'admin@admin', 'Credit card');

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `productCategory_id` int(11) NOT NULL,
  `description` varchar(333) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`productCategory_id`, `description`) VALUES
(1, 'Fruits'),
(2, 'Vegetables'),
(3, 'Costumes'),
(4, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `products_id` int(11) NOT NULL,
  `name` varchar(333) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `picture` varchar(999) NOT NULL,
  `rating` int(11) NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`products_id`, `name`, `price`, `categoryid`, `picture`, `rating`, `featured`) VALUES
(1, 'Tomato', '0.99', 1, 'res\\img\\Fruits\\tomato.jpg', 5, 1),
(4, 'Banana', '1.99', 1, 'res/img/Fruits/Banana.jpg', 5, 1),
(5, 'Mango', '1.50', 1, 'res/img/Fruits/mango.jpg', 5, 1),
(6, 'Watermelon Costume', '29.99', 3, 'res/img/Costumes/meloncostume.jpg', 5, 1),
(7, 'African Cucumber', '5.99', 1, 'res/img/Fruits/africancucamber.jpg', 0, 1),
(8, 'Avocado', '1.29', 1, 'res/img/Fruits/avocado.jpg', 0, 0),
(9, 'Guava', '3.99', 1, 'res/img/Fruits/guava.jpg', 0, 1),
(10, 'Lichi', '4.99', 1, 'res/img/Fruits/lichi.jpg', 0, 1),
(11, 'Pear', '0.99', 1, 'res/img/Fruits/pear.jpg', 0, 0),
(12, 'Ananas Costume', '29.99', 3, 'res/img/Costumes/ananascostume.jpg', 0, 1),
(13, 'Avocado Costume', '19.99', 3, 'res/img/Costumes/avocadocostume.jpg', 0, 0),
(14, 'Banana Costume', '39.99', 3, 'res/img/Costumes/bananacostume.jpg', 0, 0),
(15, 'Grape Costume', '99.99', 3, 'res/img/Costumes/grapecostume.jpg', 0, 0),
(16, 'Lemon Costumes', '39.99', 3, 'res/img/Costumes/lemoncostume.jpg', 0, 0),
(17, 'Strawberry Costume', '9.99', 3, 'res/img/Costumes/strawberrycostume.jpg', 0, 0),
(18, 'Tomato Costume', '29.99', 3, 'res/img/Costumes/Tomatocostume.jpg', 0, 0),
(19, 'Bialetti Espresso Maker', '39.99', 4, 'res/img/Accessories/Bialetti Espresso Maker.jpg', 0, 0),
(20, 'Dry Boxes', '9.99', 4, 'res/img/Accessories/Dry Boxes.jpg', 0, 0),
(21, 'Knife Set', '39.99', 4, 'res/img/Accessories/knifeset.jpg', 0, 0),
(22, 'Salad Cutter', '9.99', 4, 'res/img/Accessories/saladcutter.jpg', 0, 0),
(23, 'Seal a Meal', '69.99', 4, 'res/img/Accessories/sealameal.jpg', 0, 0),
(24, 'Teavana Starter Kit', '19.99', 4, 'res/img/Accessories/Teavanastarterkit.jpg', 0, 0),
(25, 'Wine Opener', '5.99', 4, 'res/img/Accessories/Wine opener.jpg', 0, 0),
(26, 'Spice Box', '19.99', 4, 'res/img/Accessories/Spice box.jpg', 0, 0),
(27, 'Carrot', '0.59', 2, 'res/img/Vegetables/carrot.jpg', 0, 0),
(28, 'Basilikum', '0.99', 2, 'res/img/Vegetables/basilikum.jpg', 0, 0),
(29, 'Cucumber', '0.99', 2, 'res/img/Vegetables/cucumber.jpg', 0, 0),
(30, 'Garlic', '0.79', 2, 'res/img/Vegetables/garlic.jpg', 0, 0),
(31, 'Onion', '0.39', 2, 'res/img/Vegetables/onion.jpg', 0, 0),
(32, 'Petersilie', '1.29', 2, 'res/img/Vegetables/petersilie.jpg', 0, 0),
(33, 'Red Onion', '0.89', 2, 'res/img/Vegetables/redonion.jpg', 0, 0),
(34, 'Salat', '1.29', 2, 'res/img/Vegetables/Salat.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `username` varchar(333) NOT NULL,
  `password` varchar(333) NOT NULL,
  `category` varchar(333) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `p_id`, `username`, `password`, `category`, `status`) VALUES
(2, 3, 'admin', '649f175f95cf672a4fea9c9d544a4581', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `code` varchar(500) NOT NULL,
  `value` varchar(500) NOT NULL,
  `validdate` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`code`, `value`, `validdate`) VALUES
('3WCP9R', '100', '2018-04-29'),
('7AK3T3', '23432', '2026-04-20'),
('K9NUUR', '123', '2018-04-29'),
('KFMV4J', '12312', '2017-10-13'),
('MCPJKA', '100', '2017-10-13'),
('W9VKF7', '234', '2023-11-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orderedproducts`
--
ALTER TABLE `orderedproducts`
  ADD UNIQUE KEY `invoice_id` (`invoice_id`,`product_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`productCategory_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`products_id`),
  ADD KEY `Categoryid` (`categoryid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `p_id` (`p_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `productCategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bestellung`
--
ALTER TABLE `bestellung`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `a_id` FOREIGN KEY (`a_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Categoryid` FOREIGN KEY (`categoryid`) REFERENCES `productcategory` (`productCategory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `p_id` FOREIGN KEY (`p_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
