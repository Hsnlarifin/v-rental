-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2022 at 11:27 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE DATABASE veh_rental;
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
  `user_ID` int(10) NOT NULL,
  `cust_Username` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `cust_Pass` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `street` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `postcode` int(6) NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
-- Table structure for table `vehicle_Status`
--

CREATE TABLE `vehicle_status` (
  `veh_ID` int(10) NOT NULL,
  `wshop_ID` int(10) NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_bin NOT NULL
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
  `res_ID` int(10) NOT NULL,
  `cust_ID` int(10) NOT NULL,
  `insurance_ID` int(10) NOT NULL,
  `amount` float NOT NULL,
  `date_Reserve` date NOT NULL
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
  `f_Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `l_Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `gender` varchar(6) COLLATE utf8mb4_bin NOT NULL,
  `age` int(3) NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_bin NOT NULL,
  `phoneNo` varchar(11) COLLATE utf8mb4_bin NOT NULL,
  `license_Type` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `expiration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `veh_ID` int(10) NOT NULL,
  `veh_Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `veh_Model` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `colour` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `capacity` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `veh_Transmission` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `plateNo` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `veh_Status` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `roadTax` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `branch_ID` int(10) NOT NULL,
  `supp_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_details`
--

/*
CREATE TABLE `vehicle_details` (
  `veh_ID` int(10) NOT NULL,
  `supp_ID` int(10) NOT NULL,
  `branch_ID` int(10) NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `capacity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
*/
-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance`(
  `maintenance_ID` int(10) NOT NULL,
  `service_Type` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `service_Date` date NOT NULL
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
  ADD PRIMARY KEY (`cust_ID`),
  ADD KEY `fk2_user_ID` (`user_ID`);

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
-- Indexes for table `vehicle_Status`
--
ALTER TABLE `vehicle_status`
  ADD PRIMARY KEY (`veh_ID`,`maintenance_ID`),
  ADD KEY `fk_maintenance_ID` (`maintenance_ID`);

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
  ADD PRIMARY KEY (`res_ID`),
  ADD KEY `fk2_cust_ID` (`cust_ID`),
  ADD KEY `fk_insurance_ID` (`insurance_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`),
  ADD KEY `fk_user_ID` (`user_ID`),
  ADD KEY `fk_branch_ID` (`branch_ID`);

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
  ADD PRIMARY KEY (`veh_ID`)
  ADD KEY `fk_supp_ID` (`supp_ID`),
  ADD KEY `fk3_branch_ID` (`branch_ID`);

/*
-- Indexes for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  ADD PRIMARY KEY (`veh_ID`,`supp_ID`),
  ADD KEY `fk_supp_ID` (`supp_ID`),
  ADD KEY `fk3_branch_ID` (`branch_ID`);
*/
--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_ID`);

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
  MODIFY `cust_ID` int(10) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `res_ID` int(10) NOT NULL AUTO_INCREMENT;

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
  MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `veh_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workshop`
--
ALTER TABLE `workshop`
  MODIFY `wshop_ID` int(10) NOT NULL AUTO_INCREMENT;


------------------------------------------------------------------------
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
  ADD CONSTRAINT `fk2_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drop_point`
--
ALTER TABLE `drop_point`
  ADD CONSTRAINT `fk3_location_ID` FOREIGN KEY (`location_ID`) REFERENCES `location` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_res_ID` FOREIGN KEY (`res_ID`) REFERENCES `reservation` (`res_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `insurance`
--
ALTER TABLE `insurance`
  ADD CONSTRAINT `fk2_supp_ID` FOREIGN KEY (`supp_ID`) REFERENCES `supplier` (`supp_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_Status`
--
ALTER TABLE `Vehice_Status`
  ADD CONSTRAINT `fk_veh_ID` FOREIGN KEY (`veh_ID`) REFERENCES `vehicle` (`veh_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_maintenance_ID` FOREIGN KEY (`maintenance_ID`) REFERENCES `maintenance` (`maintenance_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk2_res_ID` FOREIGN KEY (`res_ID`) REFERENCES `reservation` (`res_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk2_cust_ID` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_insurance_ID` FOREIGN KEY (`insurance_ID`) REFERENCES `insurance` (`insurance_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_branch_ID` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `fk2_location_ID` FOREIGN KEY (`location_ID`) REFERENCES `location` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_details`
--
/*
ALTER TABLE `vehicle_details`
  ADD CONSTRAINT `fk2_veh_ID` FOREIGN KEY (`veh_ID`) REFERENCES `vehicle` (`veh_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_branch_ID` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supp_ID` FOREIGN KEY (`supp_ID`) REFERENCES `supplier` (`supp_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
*/

ALTER TABLE `vehicle`
  ADD CONSTRAINT `fk3_branch_ID` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supp_ID` FOREIGN KEY (`supp_ID`) REFERENCES `supplier` (`supp_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
