-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2023 at 07:56 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veh_rental`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getuserinfo` (IN `username` VARCHAR(255))  SELECT * FROM user WHERE user_ID = 
      (SELECT user_ID
       FROM customer
       WHERE cust_Username = username)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_ID` int(10) NOT NULL,
  `location_ID` int(10) NOT NULL,
  `branch_Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `branch_PhoneNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_ID`, `location_ID`, `branch_Name`, `branch_PhoneNo`) VALUES
(1, 1, 'World Car Rental Melaka', 176631251),
(2, 6, 'Car Rental 9 ', 147297039),
(3, 8, 'AutoJoh Car Rental', 1700813600);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_ID` int(10) NOT NULL,
  `brand_Name` varchar(100) NOT NULL,
  `add_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_Date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_ID`, `brand_Name`, `add_Date`, `update_Date`) VALUES
(1, 'Perodua', '2022-12-30 02:22:53', NULL),
(2, 'Proton', '2022-12-30 02:23:02', NULL),
(3, 'Honda', '2022-12-30 02:23:07', NULL),
(4, 'Toyota', '2022-12-30 02:23:13', NULL),
(5, 'Nissan', '2022-12-31 06:10:08', NULL),
(6, 'Mazda', '2022-12-31 07:43:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `cust_Username` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `cust_Pass` varchar(30) COLLATE utf8mb4_bin DEFAULT NULL,
  `street` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `postcode` int(6) DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `Regist_Date` timestamp NULL DEFAULT current_timestamp(),
  `Update_Date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_ID`, `user_ID`, `cust_Username`, `cust_Pass`, `street`, `postcode`, `city`, `state`, `Regist_Date`, `Update_Date`) VALUES
(7, 1, 'Hsnl@gmail.com', '12345', NULL, NULL, NULL, NULL, '2023-01-02 20:25:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drop_point`
--

CREATE TABLE `drop_point` (
  `res_ID` int(10) NOT NULL,
  `location_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `insurance_ID` int(10) NOT NULL,
  `supp_ID` int(10) NOT NULL,
  `ins_Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ins_PhoneNo` int(11) NOT NULL,
  `type_Claim` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ins_ClaimAddress` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

CREATE TABLE `license` (
  `license_ID` int(10) NOT NULL,
  `license_Type` varchar(20) NOT NULL,
  `expiration` date NOT NULL,
  `cust_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_ID` int(10) NOT NULL,
  `location_Street` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `location_PostCode` int(6) NOT NULL,
  `location_City` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `location_State` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_ID`, `location_Street`, `location_PostCode`, `location_City`, `location_State`) VALUES
(1, 'Plaza Melaka Sentral', 75350, 'Melaka Sentral', 'Melaka'),
(2, 'Jalan P6, Taman Pelangi', 75450, 'Ayer Keroh', 'Melaka'),
(3, '218, Jalan Melaka Raya 1', 75000, 'Taman Melaka Raya', 'Melaka'),
(4, '909, Jalan S2 F23, Garden Homes', 70300, 'Seremban', 'Negeri Sembilan'),
(5, 'Taipan', 70450, 'Senawang', 'Negeri Sembilan'),
(6, '1145, Jalan Jasmin 24', 70450, 'Senawang', 'Negeri Sembilan'),
(8, 'Jalan Bahru, Kota Tinggi, 81800', 17518, 'Ulu Tiram', 'Johor');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_ID` int(10) NOT NULL,
  `service_Type` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`maintenance_ID`, `service_Type`) VALUES
(1, 'Major Service'),
(2, 'Minor Service');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_ID` int(10) NOT NULL,
  `res_ID` int(10) NOT NULL,
  `payment_Method` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `payment_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `resv_ID` int(10) NOT NULL,
  `Booking_Key` int(11) DEFAULT NULL,
  `cust_ID` int(10) DEFAULT NULL,
  `veh_ID` int(10) DEFAULT NULL,
  `from_Date` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `to_Date` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `Status` varchar(30) COLLATE utf8mb4_bin DEFAULT NULL,
  `insurance_ID` int(10) DEFAULT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `branch_ID` int(10) NOT NULL,
  `staff_Username` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `staff_Pass` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `staff_Position` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `staff_Salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supp_ID` int(10) NOT NULL,
  `location_ID` int(10) NOT NULL,
  `supp_Name` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(10) NOT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phoneNo` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `f_name`, `l_name`, `gender`, `age`, `email`, `phoneNo`) VALUES
(1, 'Hasanul', 'Arifin', 'Male', 25, 'Hsnlarifin@yahoo.com', '0123456789');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `veh_ID` int(10) NOT NULL,
  `brand_ID` int(10) NOT NULL,
  `veh_Model` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `price_per_Day` int(11) DEFAULT NULL,
  `fuel_Type` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `veh_Colour` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `seating_Capacity` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `veh_Transmission` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `plateNo` varchar(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `veh_Image_1` varchar(155) CHARACTER SET latin1 DEFAULT NULL,
  `register_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_Date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `supp_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`veh_ID`, `brand_ID`, `veh_Model`, `price_per_Day`, `fuel_Type`, `veh_Colour`, `seating_Capacity`, `veh_Transmission`, `plateNo`, `veh_Image_1`, `register_Date`, `update_Date`, `supp_ID`) VALUES
(1, 1, 'Alza', 200, 'Petrol ', 'Silver', '7', 'Automatic', NULL, 'alza.jpg', '2023-01-03 07:45:49', NULL, NULL),
(2, 2, 'Exora', 280, 'Petrol', 'Red', '8', 'Automatic', NULL, 'exora.jpg', '2023-01-03 07:47:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_status`
--

CREATE TABLE `vehicle_status` (
  `veh_ID` int(10) NOT NULL,
  `maintenance_ID` int(10) NOT NULL,
  `service_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `branch_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `vehicle_status`
--

INSERT INTO `vehicle_status` (`veh_ID`, `maintenance_ID`, `service_Date`, `status`, `branch_ID`) VALUES
(1, 1, '2023-01-03 09:59:35', 'Available', 1),
(2, 1, '2023-01-03 10:02:34', 'Unavailable', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_ID`),
  ADD KEY `fk_location_ID` (`location_ID`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_ID`),
  ADD KEY `fk_user_ID` (`user_ID`);

--
-- Indexes for table `drop_point`
--
ALTER TABLE `drop_point`
  ADD PRIMARY KEY (`res_ID`,`location_ID`),
  ADD KEY `fk_drop_point` (`location_ID`,`res_ID`) USING BTREE;

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`insurance_ID`),
  ADD KEY `fk2_supp_ID` (`supp_ID`);

--
-- Indexes for table `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`license_ID`),
  ADD KEY `fk_cust_ID` (`cust_ID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_ID`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_ID`),
  ADD KEY `fk2_res_ID` (`res_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`resv_ID`),
  ADD KEY `fk2_cust_ID` (`cust_ID`),
  ADD KEY `fk3_veh_ID` (`veh_ID`),
  ADD KEY `fk_insurance_ID` (`insurance_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`),
  ADD KEY `fk_branch_ID` (`branch_ID`),
  ADD KEY `fk2_user_ID` (`user_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supp_ID`),
  ADD KEY `fk2_location_ID` (`location_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`veh_ID`),
  ADD KEY `fk_supp_ID` (`supp_ID`),
  ADD KEY `fk_brand_ID` (`brand_ID`);

--
-- Indexes for table `vehicle_status`
--
ALTER TABLE `vehicle_status`
  ADD PRIMARY KEY (`veh_ID`,`maintenance_ID`),
  ADD KEY `fk_maintenance_ID` (`maintenance_ID`),
  ADD KEY `fk2_branch_ID` (`branch_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `insurance_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `license`
--
ALTER TABLE `license`
  MODIFY `license_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintenance_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `resv_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supp_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `veh_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `fk_location_ID` FOREIGN KEY (`location_ID`) REFERENCES `location` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drop_point`
--
ALTER TABLE `drop_point`
  ADD CONSTRAINT `fk3_location_ID` FOREIGN KEY (`location_ID`) REFERENCES `location` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_res_ID` FOREIGN KEY (`res_ID`) REFERENCES `reservation` (`resv_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insurance`
--
ALTER TABLE `insurance`
  ADD CONSTRAINT `fk2_supp_ID` FOREIGN KEY (`supp_ID`) REFERENCES `supplier` (`supp_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `license`
--
ALTER TABLE `license`
  ADD CONSTRAINT `fk_cust_ID` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk2_res_ID` FOREIGN KEY (`res_ID`) REFERENCES `reservation` (`resv_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk2_cust_ID` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_veh_ID` FOREIGN KEY (`veh_ID`) REFERENCES `vehicle` (`veh_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_insurance_ID` FOREIGN KEY (`insurance_ID`) REFERENCES `insurance` (`insurance_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk2_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `fk_branch_ID` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `fk2_location_ID` FOREIGN KEY (`location_ID`) REFERENCES `location` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `fk_brand_ID` FOREIGN KEY (`brand_ID`) REFERENCES `brand` (`brand_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supp_ID` FOREIGN KEY (`supp_ID`) REFERENCES `supplier` (`supp_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_status`
--
ALTER TABLE `vehicle_status`
  ADD CONSTRAINT `fk2_branch_ID` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk4_veh_ID` FOREIGN KEY (`veh_ID`) REFERENCES `vehicle` (`veh_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
