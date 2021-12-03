-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 01:09 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

CREATE TABLE `admintbl` (
  `adid` varchar(6) NOT NULL,
  `ademail` varchar(30) NOT NULL,
  `adpassword` varchar(30) NOT NULL,
  `adname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`adid`, `ademail`, `adpassword`, `adname`) VALUES
('AD001', 'nova@gmail.com', '123456', 'Duong');

-- --------------------------------------------------------

--
-- Table structure for table `customertbl`
--

CREATE TABLE `customertbl` (
  `cid` int(6) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `cemail` varchar(30) NOT NULL,
  `cpassword` varchar(30) NOT NULL,
  `cphone` varchar(12) NOT NULL,
  `caddress` varchar(50) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `created_time` int(11) NOT NULL,
  `last_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customertbl`
--

INSERT INTO `customertbl` (`cid`, `cname`, `cemail`, `cpassword`, `cphone`, `caddress`, `total`, `created_time`, `last_update`) VALUES
(1, 'Bruce', 'a123456@gmail.com', '12', '3265897', 'TP', 0, 0, 1625200446),
(2, 'Luca', 'b123456@gmail.com', '1', '5223364', 'TL', 0, 0, 0),
(3, 'Lily', 'c123456@gmail.com', '1', '1232147', 'UK', 0, 0, 0),
(5, 'Xiao', 'e123456@gmail..com', '1', '23657789', 'CN', NULL, 1625200378, 1625200378);

-- --------------------------------------------------------

--
-- Table structure for table `img_librarytbl`
--

CREATE TABLE `img_librarytbl` (
  `proid` int(11) NOT NULL,
  `img` varchar(50) NOT NULL,
  `img1` varchar(50) NOT NULL,
  `img2` varchar(50) NOT NULL,
  `img3` varchar(50) NOT NULL,
  `img4` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `img_librarytbl`
--

INSERT INTO `img_librarytbl` (`proid`, `img`, `img1`, `img2`, `img3`, `img4`) VALUES
(1, 'assets/img/item1.png', 'assets/img/item1.1.png', 'assets/img/item1.2.png', 'assets/img/item1.3.png', 'assets/img/item1.4.png'),
(2, 'assets/img/item2.png', 'assets/img/item2.1.png', 'assets/img/item2.2.png', 'assets/img/item2.3.png', 'assets/img/item2.4.png'),
(3, 'assets/img/item3.png', 'assets/img/item3.1.png', 'assets/img/item3.2.png', 'assets/img/item3.3.png', 'assets/img/item3.4.png'),
(4, 'assets/img/item4.png', 'assets/img/item4.1.png', 'assets/img/item4.2.png', 'assets/img/item4.3.png', 'assets/img/item4.4.png'),
(5, 'assets/img/item5.png', 'assets/img/item5.1.png', 'assets/img/item5.2.png', 'assets/img/item5.3.png', 'assets/img/item5.4.png'),
(6, 'assets/img/item6.png', 'assets/img/item6.1.png', 'assets/img/item6.2.png', 'assets/img/item6.3.png', 'assets/img/item6.4.png'),
(7, 'assets/img/item7.png', 'assets/img/item7.1.png', 'assets/img/item7.2.png', 'assets/img/item7.3.png', 'assets/img/item7.4.png'),
(8, 'assets/img/item8.png', 'assets/img/item8.1.png', 'assets/img/item8.2.png', 'assets/img/item8.3.png', 'assets/img/item8.4.png'),
(9, 'assets/img/item9.png', 'assets/img/item9.1.png', 'assets/img/item9.2.png', 'assets/img/item9.3.png', 'assets/img/item9.4.png'),
(10, 'assets/img/item10.png', 'assets/img/item10.1.png', 'assets/img/item10.2.png', 'assets/img/item10.3.png', 'assets/img/item10.4.png'),
(11, 'assets/img/item11.png', 'assets/img/item11.1.png', 'assets/img/item11.2.png', 'assets/img/item11.3.png', 'assets/img/item11.4.png'),
(12, 'assets/img/item12.png', 'assets/img/item12.1.png', 'assets/img/item12.2.png', 'assets/img/item12.3.png', 'assets/img/item12.4.png'),
(13, 'assets/img/item13.png', 'assets/img/item13.1.png', 'assets/img/item13.2.png', 'assets/img/item13.3.png', 'assets/img/item13.4.png'),
(14, 'assets/img/item14.png', 'assets/img/item14.1.png', 'assets/img/item14.2.png', 'assets/img/item14.3.png', 'assets/img/item14.4.png');

-- --------------------------------------------------------

--
-- Table structure for table `ordertbl`
--

CREATE TABLE `ordertbl` (
  `orderid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `note` text NOT NULL,
  `total` int(11) NOT NULL,
  `payment` int(1) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ordertbl`
--

INSERT INTO `ordertbl` (`orderid`, `name`, `phone`, `address`, `note`, `total`, `payment`, `created_time`, `last_updated`) VALUES
(19, 'Andy', '448417895', 'BD', '', 5595, 0, 1625130375, 1625130375),
(59, 'Ngoc', '0369875421', 'VN', 'sss', 2149, 0, 1625247810, 1625247810),
(60, 'Xu', '0369875421', 'CT', '', 1598, 3, 1625248568, 1625248568),
(94, 'Khoa', '0332555', 'LA', '.....', 5449, 4, 1625473977, 1625473977),
(95, 'Nova', '0393584325', 'VN', '', 1798, 3, 1625491536, 1625491536),
(96, 'Duong', '0325896647', 'GT, BT', '', 6592, 2, 1625537724, 1625537724);

-- --------------------------------------------------------

--
-- Table structure for table `order_detailtbl`
--

CREATE TABLE `order_detailtbl` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `proid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_update` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_detailtbl`
--

INSERT INTO `order_detailtbl` (`id`, `orderid`, `proid`, `quantity`, `price`, `created_time`, `last_update`) VALUES
(9, 19, 6, 3, 999, 1625130375, 1625130375),
(10, 19, 7, 2, 1299, 1625130375, 1625130375),
(50, 59, 1, 1, 899, 1625247810, 1625247810),
(51, 59, 11, 1, 1250, 1625247810, 1625247810),
(52, 60, 4, 1, 899, 1625248568, 1625248568),
(53, 60, 13, 1, 699, 1625248568, 1625248568),
(87, 94, 3, 1, 799, 1625473977, 1625473977),
(88, 94, 10, 3, 1550, 1625473977, 1625473977),
(89, 95, 4, 2, 899, 1625491536, 1625491536),
(90, 96, 1, 2, 899, 1625537724, 1625537724),
(91, 96, 3, 6, 799, 1625537724, 1625537724);

-- --------------------------------------------------------

--
-- Table structure for table `producttbl`
--

CREATE TABLE `producttbl` (
  `proid` int(11) NOT NULL,
  `proname` varchar(50) NOT NULL,
  `available` int(20) NOT NULL,
  `img` text NOT NULL,
  `second_img` text NOT NULL,
  `proprice` int(11) NOT NULL,
  `rate` float NOT NULL,
  `content` text NOT NULL,
  `created_time` int(11) DEFAULT NULL,
  `last_update` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producttbl`
--

INSERT INTO `producttbl` (`proid`, `proname`, `available`, `img`, `second_img`, `proprice`, `rate`, `content`, `created_time`, `last_update`) VALUES
(1, 'Mini Two-tone Canvas and Leather Pocket Bag', 18, 'assets/img/item1.png', 'assets/img/item1.1.png', 899, 5, 'An archive-inspired tote in canvas and topstitched leather, featuring a front pocket stamped with our Horseferry print. Carry by the reinforced top handles or detachable shoulder strap.', 2147483647, 1625474051),
(2, 'Small Quilted Lambskin Lola Bag', 0, 'assets/img/item2.png', 'assets/img/item2.1.png', 899, 4.5, 'A softly structured, quilted runway bag crafted from Italian-tanned lambskin. The style is punctuated with a polished chain shoulder strap and the Thomas Burberry Monogram. Wear it on the shoulder or style as a crossbody.', 2147483647, NULL),
(3, 'Monogram Motif Leather Wallet Detachable Strap', 4, 'assets/img/item3.png', 'assets/img/item3.1.png', 799, 5, 'A compact wallet in contrasting tones of Italian-tanned leather, detailed with a polished Thomas Burberry Monogram. Wear as a miniature bag using the detachable strap.', 2147483647, 1625492446),
(4, 'Mini Topstitched Leather Pocket Bag', 5, 'assets/img/item4.png', 'assets/img/item4.1.png', 899, 3.5, 'An archive-inspired tote in topstitched leather, featuring a front pocket embossed with our logo. Carry by the reinforced top handles or detachable shoulder strap.', 2147483647, NULL),
(5, 'Small Quilted Lambskin Lola Bag', 0, 'assets/img/item5.png', 'assets/img/item5.1.png', 1099, 4.7, 'A softly structured, quilted runway bag crafted from Italian-tanned lambskin. The style is punctuated with a polished chain strap and the Thomas Burberry Monogram. Wear it on the shoulder or style as a crossbody.', 2147483647, NULL),
(6, 'Mini Leather Zip Olympia Bag', 0, 'assets/img/item6.png', 'assets/img/item6.1.png', 999, 4, 'A zipped runway shoulder bag with a curved silhouette, sculpted from a soft matte French leather which develops a natural patina over time. The slim, structured style features a gold-plated chain strap and our embossed logo, and was created in a numbered limited edition of 300.', 2147483647, NULL),
(7, 'Small Topstitched Leather TB Bag', 16, 'assets/img/item7.png', 'assets/img/item7.1.png', 1299, 4.2, 'A structured bag in tri-tone canvas and topstitched leather with a Thomas Burberry Monogram clasp. Wear on the shoulder, across the body or carry as a clutch.', 2147483647, NULL),
(8, 'Mini Leather Two-handle Title Bag', 5, 'assets/img/item8.png', 'assets/img/item8.1.png', 699, 5, 'A refined silhouette in Italian-tanned leather, accented with polished triple-stud detailing. Carry it by the top handles or on the shoulder using the detachable strap.', 2147483647, NULL),
(9, 'Small Check Canvas and Leather TB Bag', 9, 'assets/img/item9.png', 'assets/img/item9.1.png', 899, 3, 'A structured bag in jacquard-woven check canvas and topstitched leather, highlighted with a Thomas Burberry Monogram clasp. Wear on the shoulder, across the body or carry as a clutch.', 2147483647, NULL),
(10, 'Small Horseferry Linen Cotton Canvas Lola Bag', 7, 'assets/img/item10.png', 'assets/img/item10.1.png', 1550, 3.4, 'A softly structured runway bag crafted from linen-cotton canvas, appliquéd with embroidered Horseferry lettering. The style is punctuated with a polished chain strap and the Thomas Burberry Monogram.', 1625205572, 1625215975),
(11, 'Mini Horseferry Linen Cotton Canvas Pocket Bag', 2, 'assets/img/item11.png', 'assets/img/item11.1.png', 1250, 5, 'An archive-inspired tote in linen-cotton canvas and topstitched leather, featuring a front pocket appliquéd with embroidered Horseferry lettering. Carry by the reinforced top handles or detachable shoulder strap.', 1625215082, 1625215082),
(12, 'Topstitched Leather Note Crossbody Bag', 0, 'assets/img/item12.png', 'assets/img/item12.1.png', 899, 4.5, 'A slim crossbody bag in topstitched Italian-tanned leather, detailed with polished logo-engraved press studs. The cotton-canvas shoulder strap is appliquéd with Burberry lettering.', 1625215230, 1625215230),
(13, 'Small Two-tone Canvas and Leather TB Bag', 3, 'assets/img/item13.png', 'assets/img/item13.1.png', 699, 3.4, 'A structured bag in two-tone canvas and topstitched leather with a Thomas Burberry Monogram clasp. Wear on the shoulder, across the body or carry as a clutch.', 1625215366, 1625215366),
(14, 'Mini Leather Zip Olympia Bag', 5, 'assets/img/item14.png', 'assets/img/item14.1.png', 1250, 4.5, 'A zipped runway shoulder bag with a curved silhouette, sculpted from a soft matte French leather which develops a natural patina over time. The slim, structured style features a gold-plated chain strap and our embossed logo.', 1625215503, 1625215503);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintbl`
--
ALTER TABLE `admintbl`
  ADD PRIMARY KEY (`adid`);

--
-- Indexes for table `customertbl`
--
ALTER TABLE `customertbl`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `img_librarytbl`
--
ALTER TABLE `img_librarytbl`
  ADD KEY `img_library_ibfk1` (`proid`);

--
-- Indexes for table `ordertbl`
--
ALTER TABLE `ordertbl`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `order_detailtbl`
--
ALTER TABLE `order_detailtbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detail_ibfk1` (`orderid`),
  ADD KEY `order_detail_ibfk2` (`proid`);

--
-- Indexes for table `producttbl`
--
ALTER TABLE `producttbl`
  ADD PRIMARY KEY (`proid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customertbl`
--
ALTER TABLE `customertbl`
  MODIFY `cid` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ordertbl`
--
ALTER TABLE `ordertbl`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `order_detailtbl`
--
ALTER TABLE `order_detailtbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `producttbl`
--
ALTER TABLE `producttbl`
  MODIFY `proid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `img_librarytbl`
--
ALTER TABLE `img_librarytbl`
  ADD CONSTRAINT `img_library_ibfk1` FOREIGN KEY (`proid`) REFERENCES `producttbl` (`proid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detailtbl`
--
ALTER TABLE `order_detailtbl`
  ADD CONSTRAINT `order_detail_ibfk1` FOREIGN KEY (`orderid`) REFERENCES `ordertbl` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detail_ibfk2` FOREIGN KEY (`proid`) REFERENCES `producttbl` (`proid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
