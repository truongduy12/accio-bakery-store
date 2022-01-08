-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2020 at 09:34 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accio`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Cat_ID` int(11) NOT NULL,
  `Cat_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Cat_ID`, `Cat_Name`) VALUES
(1, 'Butter Cake'),
(2, 'Pound Cake'),
(3, 'Sponge Cake'),
(4, 'Opera Cake'),
(5, 'Cheese Cake'),
(6, 'Hummingbird Cake'),
(7, 'Chiffon Cake'),
(8, 'Carrot Cake'),
(9, 'Cup Cake');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Email` varchar(200) NOT NULL,
  `Fullname` varchar(150) NOT NULL,
  `Telephone` varchar(12) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `Type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Email`, `Fullname`, `Telephone`, `Password`, `Address`, `Type`) VALUES
('abcde@123.fgh', 'Truong Duy', '0111111112', 'e10adc3949ba59abbe56e057f20f883e', 'New York', 0),
('albus@hotmail.com', 'Albus Dumbledore', '0112233445', 'f379eaf3c831b04de153469d1bec345e', '128 - 30/4 - An Phu - Ninh Kieu - Can Tho', 0),
('duynntgcc19026@fpt.edu.vn', 'Nguyen Ngoc Truong Duy', '0366123124', 'e10adc3949ba59abbe56e057f20f883e', 'Tra Vinh', 1),
('harry@gmail.com', 'Harry Potter', '0123456789', '25d55ad283aa400af464c76d713c07ad', 'Mac Thien Tich - Xuan Khanh - Ninh Kieu - Can Tho', 0),
('jhahgdja@bb.xn--fea', 'jsb', '0852369852', 'b7e6923f6de66497d51789db0ef3571d', 'vzhbsbs', 0),
('nguyenvcgcc19118@fpt.edu.vn', 'nguyen van abcde', '0123456777', 'e10adc3949ba59abbe56e057f20f883e', 'Can Tho', 0),
('ronald@yahoo.com', 'Ronal Weasley', '0987654321', '4297f44b13955235245b2497399d7a93', 'Nguyen Van Linh - Hung Phu - Ninh Kieu - Can Tho', 0),
('test@gmail.com', 'testing website', '0987654320', '202865e57d5957f4ea462e744ae95141', 'Can Tho', 0),
('webdev@gmail.com', 'Nguyen Ngoc Truong Duy', '0123454321', 'e6e061838856bf47e1de730719fb2609', 'Ninh Kieu, Can Tho', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `DeliveryDate` datetime DEFAULT NULL,
  `Status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `Email`, `OrderDate`, `DeliveryDate`, `Status`) VALUES
(2, 'duynntgcc19026@fpt.edu.vn', '2020-12-21 00:00:00', '2020-12-25 00:00:00', 2),
(3, 'duynntgcc19026@fpt.edu.vn', '2020-12-21 00:00:00', '2020-12-25 00:00:00', -1),
(4, 'duynntgcc19026@fpt.edu.vn', '2020-12-21 00:00:00', '2020-12-25 00:00:00', -1),
(5, 'duynntgcc19026@fpt.edu.vn', '2020-12-21 00:00:00', '2020-12-25 00:00:00', -1),
(6, 'duynntgcc19026@fpt.edu.vn', '2020-12-21 00:00:00', '2020-12-25 00:00:00', 1),
(7, 'duynntgcc19026@fpt.edu.vn', '2020-12-21 00:00:00', '2020-12-25 00:00:00', 2),
(8, 'duynntgcc19026@fpt.edu.vn', '2020-12-21 00:00:00', '2020-12-25 00:00:00', -1),
(9, 'duynntgcc19026@fpt.edu.vn', '2020-12-21 00:00:00', '2020-12-22 00:00:00', 1),
(10, 'harry@gmail.com', '2020-12-24 15:27:01', '2020-12-25 15:27:01', 2),
(11, 'duynntgcc19026@fpt.edu.vn', '2020-12-24 15:34:22', '2020-12-25 15:34:22', 1),
(12, 'harry@gmail.com', '2020-12-25 07:07:34', '2020-12-26 07:07:34', 1),
(13, 'harry@gmail.com', '2020-12-25 14:28:22', '2020-12-26 14:28:22', 1),
(14, 'duynntgcc19026@fpt.edu.vn', NULL, NULL, 0),
(15, 'harry@gmail.com', NULL, NULL, 0),
(16, 'jhahgdja@bb.xn--fea', '2020-12-26 05:33:59', '2020-12-27 05:33:59', 2),
(17, 'jhahgdja@bb.xn--fea', '2020-12-26 05:36:04', '2020-12-27 05:36:04', 2),
(18, 'jhahgdja@bb.xn--fea', NULL, NULL, 0),
(19, 'webdev@gmail.com', '2020-12-26 19:19:29', '2020-12-27 19:19:29', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `No` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Qty` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`No`, `OrderID`, `Product_ID`, `Qty`) VALUES
(2, 2, 1, 6),
(3, 3, 6, 1),
(7, 7, 3, 1),
(8, 7, 3, 1),
(9, 9, 2, 2),
(10, 9, 5, 1),
(12, 11, 3, 1),
(13, 11, 6, 1),
(14, 11, 2, 1),
(15, 11, 1, 2),
(21, 10, 4, 7),
(22, 10, 2, 3),
(23, 12, 5, 1),
(24, 12, 1, 1),
(25, 13, 5, 10),
(26, 14, 1, 1),
(27, 15, 3, 2),
(28, 16, 1, 85),
(29, 17, 2, 99),
(30, 18, 1, 9),
(31, 18, 2, 5),
(32, 18, 3, 1),
(38, 15, 1, 5),
(39, 15, 4, 1),
(40, 15, 2, 4),
(41, 19, 8, 4),
(43, 19, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` varchar(100) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `Price` float NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Product_Img` varchar(1000) NOT NULL,
  `Pro_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Product_Name`, `Cat_ID`, `Price`, `Description`, `Product_Img`, `Pro_Date`, `Status`) VALUES
(1, 'Blue-Ribbon', 1, 4, 'Great recipe..licking your fingers.', 'Blue_Ribbon_Butter_Cake.jpg', '2020-12-22 19:14:23', 1),
(2, 'Gooey', 1, 3.7, 'Rich, sweet, and, well, buttery.', 'Gooey.jpg', '2020-12-22 19:29:22', 1),
(3, 'Caramelized Brown', 1, 4.9, 'Don’t be fooled by its appearance – this is seriously one of the best tasting cakes.', 'BrownButterCake_main.jpg', '2020-12-22 19:29:42', 1),
(4, 'Lemon Pound Cake', 2, 5, 'Flavored with lemon zest and juice, and drizzled with a tart lemon glaze.', 'lemon-pound-cake-500sq.jpg', '2020-12-23 01:36:15', 1),
(5, 'Pumpkin Pound Cake', 2, 2.99, 'Pumpkin pie goodness in a delicious pound cake.', '2019_pumpkin-pound-cake_19440_600x600.jpg', '2020-12-23 01:38:54', 1),
(6, 'Vannilla Pound Cake', 2, 4.6, 'A classic recipe dating all the way back to the 18th century.', 'Vanilla-Pound-Cake-3.jpg', '2020-12-23 01:43:50', 1),
(7, 'America Sponge Cake', 3, 4.9, 'So wonderfully light and moist.', 'americanspongecake.jpg', '2020-12-26 23:42:18', 1),
(8, 'Croissant Cake', 1, 5, 'The preparation of the croissants consists of two main phases: the initial dough, called détrempe, and the laminating, which consists of integrating the butter to the détrempe, forming alternate layers.', 'croissant.jpg', '2020-12-25 20:25:50', 1),
(9, 'Triple Chocolate Cake', 4, 3, 'With a super moist crumb and fudgy, yet light texture, this chocolate cake recipe will soon be your favorite too. Top with chocolate buttercream and chocolate chips for 3x the chocolate flavor.', 'triple-chocolate-cake-4.jpg', '2020-12-26 22:41:59', 1),
(10, 'Red Velvet Cake', 5, 2.5, 'This cake is incredibly soft, moist, buttery, and topped with an easy cream cheese frosting.', 'Red-Velvet-Cake-8.jpg', '2020-12-26 23:34:55', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Cat_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`No`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `Product_ID` (`Product_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `Cat_ID` (`Cat_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Cat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `customer` (`Email`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Cat_ID`) REFERENCES `category` (`Cat_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
