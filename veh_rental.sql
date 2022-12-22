-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2022 at 04:56 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_ID` int(10) NOT NULL,
  `location_ID` int(10) NOT NULL,
  `branch_Name` int(255) NOT NULL,
  `branch_PhoneNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_ID` int(10) NOT NULL,
  `cust_Username` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `F_Name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `L_Name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `PhoneNo` char(11) COLLATE utf8mb4_bin DEFAULT NULL,
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

INSERT INTO `customer` (`cust_ID`, `cust_Username`, `password`, `F_Name`, `L_Name`, `PhoneNo`, `street`, `postcode`, `city`, `state`, `Regist_Date`, `Update_Date`) VALUES
(2, 'hsnlar@gmail.com', 'e99a18c428cb38d5f260853678922e', 'Hasanul', 'Arifin', '01119733475', NULL, NULL, NULL, NULL, '2022-12-22 14:38:11', NULL),
(3, 'test@gmail.com', 'abc123', 'Hasanul', 'Arifin', '01119733235', NULL, NULL, NULL, NULL, '2022-12-22 14:43:37', NULL),
(4, 'test2@gmail.com', '5c428d8875d2948607f3e3fe134d71', 'abu', 'ali', '1234888', NULL, NULL, NULL, NULL, '2022-12-22 15:03:33', NULL);

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
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_ID` int(10) NOT NULL,
  `location_Street` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `location_PostCode` int(6) NOT NULL,
  `location_CIty` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `location_State` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_ID` int(10) NOT NULL,
  `service_Type` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `service_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
  `cust_ID` int(10) NOT NULL,
  `veh_ID` int(10) NOT NULL,
  `from_Date` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `to_Date` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `Status` varchar(30) COLLATE utf8mb4_bin DEFAULT NULL,
  `insurance_ID` int(10) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(10) NOT NULL,
  `branch_ID` int(10) NOT NULL,
  `staff_Username` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `staff_Pass` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `F_Name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `L_Name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
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
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `veh_ID` int(10) NOT NULL,
  `veh_Model` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `veh_Brand` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `price_per_Day` int(11) DEFAULT NULL,
  `fuel_Type` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `manufacture_Year` int(6) DEFAULT NULL,
  `veh_Colour` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `seating_Capacity` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `veh_Transmission` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `plateNo` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `roadTax` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `veh_Image_1` varchar(155) CHARACTER SET latin1 DEFAULT NULL,
  `register_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_Date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `branch_ID` int(10) NOT NULL,
  `supp_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_status`
--

CREATE TABLE `vehicle_status` (
  `veh_ID` int(10) NOT NULL,
  `maintenance_ID` int(10) NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_ID`);

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
  ADD KEY `fk_insurance_ID` (`insurance_ID`),
  ADD KEY `fk3_veh_ID` (`veh_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`),
  ADD KEY `fk_branch_ID` (`branch_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supp_ID`),
  ADD KEY `fk2_location_ID` (`location_ID`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`veh_ID`),
  ADD KEY `fk_supp_ID` (`supp_ID`),
  ADD KEY `fk3_branch_ID` (`branch_ID`);

--
-- Indexes for table `vehicle_status`
--
ALTER TABLE `vehicle_status`
  ADD PRIMARY KEY (`veh_ID`,`maintenance_ID`),
  ADD KEY `fk_maintenance_ID` (`maintenance_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `insurance_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintenance_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `resv_ID` int(10) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `veh_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `fk_location_ID` FOREIGN KEY (`location_ID`) REFERENCES `location` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk3_branch_ID` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supp_ID` FOREIGN KEY (`supp_ID`) REFERENCES `supplier` (`supp_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
