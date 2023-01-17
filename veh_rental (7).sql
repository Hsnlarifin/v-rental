-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 10:54 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTotalStaff` (OUT `total` INT(10))  BEGIN
SELECT COUNT(*)
INTO total
FROM staff;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetTotalStaffByBranch` (OUT `branchid` INT(10), OUT `branchname` VARCHAR(255), OUT `total` INT(10))  BEGIN
SELECT b.branch_ID, b.branch_Name, COUNT(s.staff_ID)
INTO branchid, branchname, total
FROM staff s INNER JOIN branch b
ON s.branch_ID = b.branch_ID
GROUP BY b.branch_ID, b.branch_Name
ORDER BY COUNT(s.staff_ID) DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getuserinfo` (IN `username` VARCHAR(255))  SELECT * FROM user JOIN customer ON user.user_ID = customer.user_ID where customer.user_ID = (select user_ID from customer where cust_Username = username)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_userid` (IN `fname` VARCHAR(255), IN `lname` VARCHAR(255), OUT `userID` INT(10))  SELECT @userID = user_ID FROM user WHERE f_name = @fname AND l_name = @lname$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatetotaldays` ()  UPDATE reservation set total_days = datediff(to_Date,from_Date)$$

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
(6, 'Mazda', '2022-12-31 07:43:55', NULL),
(7, 'BMW', '2023-01-17 13:59:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_ID` int(10) NOT NULL,
  `user_ID` int(10) DEFAULT NULL,
  `cust_Username` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `cust_Pass` varchar(120) CHARACTER SET utf8mb4 DEFAULT NULL,
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
(1, 16, 'aimnfarihin_', '4imaN', 'No 45, Jln Jasin, Taman Belia', 75450, 'Malacca', 'Melaka', '2023-01-15 17:43:05', '2023-01-17 20:57:44'),
(2, 17, '_Aleesa', 'Aleesa123', 'No 73, Jln Tanah Merah, Taman Keris', 81300, 'Skudai', 'Johor', '2023-01-15 17:43:05', NULL),
(3, 18, 'fthah22', 'Fatehah0', 'No 6, Jln Ciku, Taman Merdeka', 81300, 'Skudai', 'Johor', '2023-01-15 17:43:05', NULL),
(4, 19, 'haziiq@yahoo.com', 'haziq99', 'No 33, Jln Manggis, Taman Melati', 40000, 'Shah Alam', 'Selangor', '2023-01-15 17:43:05', NULL),
(5, 20, 'abdulrazak@gmail.com', 'Razakk3', 'Lot 14, Jln Melawati, Taman Kasih', 40000, 'Shah Alam', 'Selangor', '2023-01-15 17:43:05', NULL),
(7, 1, 'Hsnl@gmail.com', '12345', 'NO.30 Jalan Teliti 4/U8', 34500, 'Ayer Keroh', 'Malacca', '2023-01-02 20:25:09', NULL),
(13, NULL, 'Arifin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, NULL, NULL, '2023-01-17 20:11:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

CREATE TABLE `license` (
  `license_ID` int(10) NOT NULL,
  `cust_ID` int(10) NOT NULL,
  `license_Type` varchar(20) NOT NULL,
  `expiration` date NOT NULL
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
  `resv_ID` int(10) NOT NULL,
  `payment_Method` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `payment_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_Status` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_ID`, `resv_ID`, `payment_Method`, `payment_Date`, `payment_Status`, `amount`) VALUES
(12, 50, 'ONLINE', '2023-01-17 03:48:13', 'PAID', 600),
(13, 52, 'CASH', '2023-01-17 03:58:45', 'PAID', 840),
(14, 53, 'CASH', '2023-01-17 13:33:37', 'PAID', 200);

--
-- Triggers `payment`
--
DELIMITER $$
CREATE TRIGGER `update_bookingstatus` AFTER INSERT ON `payment` FOR EACH ROW UPDATE reservation SET STATUS = 'CONFIRMED' WHERE resv_ID = new.resv_ID
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `resv_ID` int(10) NOT NULL,
  `Booking_Key` int(11) DEFAULT NULL,
  `cust_ID` int(10) DEFAULT NULL,
  `veh_ID` int(10) DEFAULT NULL,
  `payment_ID` int(10) DEFAULT NULL,
  `from_Date` date DEFAULT NULL,
  `to_Date` date DEFAULT NULL,
  `Message` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `Status` varchar(30) COLLATE utf8mb4_bin DEFAULT NULL,
  `total_days` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`resv_ID`, `Booking_Key`, `cust_ID`, `veh_ID`, `payment_ID`, `from_Date`, `to_Date`, `Message`, `Status`, `total_days`) VALUES
(50, 7613, 7, 1, 12, '2023-01-17', '2023-01-20', NULL, 'CONFIRMED', 3),
(52, 5183, 7, 2, NULL, '2023-01-17', '2023-01-20', NULL, 'CONFIRMED', 3),
(53, 8133, 5, 1, NULL, '2023-02-16', '2023-02-17', NULL, 'CONFIRMED', 1),
(54, 3067, 4, 1, NULL, '2023-01-24', '2023-01-25', NULL, 'PENDING', 1),
(55, 4933, 7, 1, NULL, '2023-03-02', '2023-03-11', NULL, 'PENDING', 9);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `branch_ID` int(10) NOT NULL,
  `staff_Username` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `staff_Pass` varchar(120) CHARACTER SET utf8mb4 NOT NULL,
  `staff_Position` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `staff_Salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_ID`, `user_ID`, `branch_ID`, `staff_Username`, `staff_Pass`, `staff_Position`, `staff_Salary`) VALUES
(1, 1, 1, 'amrl_', '1234', 'Director', 19198.4),
(2, 2, 1, 'sakinah', 'Sakina#', 'Admin', 3500),
(3, 3, 1, 'nrnsyhrh', 'Nurin99', 'Accountant', 4550),
(4, 4, 1, '_ain', 'N4jihah', 'Consultant', 9360),
(5, 5, 1, 'nabeel_', 'mnabll', 'Manager', 11400.3),
(6, 6, 2, 'nuraliyah_', 'aliya#', 'Manager', 11400.3),
(7, 7, 2, 'haafiz', 'Haf1z', 'Admin', 3500),
(8, 8, 2, 'aliff_', 'Alif7', 'Consultant', 9360),
(9, 9, 2, '__anis', 'Ani2', 'Clerk', 2300),
(10, 10, 2, 'kama', 'kama00', 'Accountant', 4550),
(11, 11, 3, 'lukman22', 'Lukm4n', 'Manager', 11400.3),
(12, 12, 3, 'faizz', 'Abc123', 'Accountant', 4550),
(13, 13, 3, 'mhdhilman', 'hilman#2', 'Consultant', 9360),
(14, 14, 2, 'aatiqah', 'Atiqa#4', 'Clerk', 2400);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sup_id` int(10) NOT NULL,
  `sup_name` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `sup_email` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `sup_phone` varchar(15) COLLATE utf8mb4_bin DEFAULT NULL,
  `username` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`sup_id`, `sup_name`, `sup_email`, `sup_phone`, `username`, `password`, `company_name`, `address`) VALUES
(1, 'supp1', 'supp@gmail.com', '0123', 'supp', 'supp123', 'Supplier Inc', 'No. 555 Supplier Street'),
(1001, 'john', 'john@gmail.com', '0123456789', 'john', '1234', 'john & james co.', '18 Taman Ria'),
(1002, 'james', 'james@yahoo.com', '0123456780', 'james', '12345', ' james co.', '11 jalan mas');

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
(1, 'Hasanul', 'Arifin', 'Male', 25, 'Hsnlarifin@yahoo.com', '0123456789'),
(2, 'Nur', 'Sakina', 'Female', 29, 'sakina@gmail.com', '0175832111'),
(3, 'Nurin', 'Syahirah', 'Female', 26, 'nurinsyrh@gmail.com', '01123196774'),
(4, 'Ain', 'Najihah', 'Female', 26, 'najihah@gmail.com', '0142312241'),
(5, 'Muhd', 'Nabeel', 'Male', 28, 'mhdnabeel@gmail.com', '0194231122'),
(6, 'Nur', 'Aliyah', 'Female', 31, 'aliyah@gmail.com', '0175224313'),
(7, 'Muhd', 'Hafiz', 'Male', 32, 'hafizz@gmail.com', '0162534116'),
(8, 'Muhd Aliff', 'Najmi', 'Male', 27, 'muhdaliff@gmail.com', '01191317562'),
(9, 'Anis', 'Syahirah', 'Female', 25, 'anis@gmail.com', '0107425641'),
(10, 'Nur', 'Kamalia', 'Female', 27, 'kamalia@gmail.com', '0142313786'),
(11, 'Lukman', 'Hakim', 'Male', 36, 'lukman@gmail.com', '0146279912'),
(12, 'Muhammad', 'Faiz', 'Male', 33, 'faiz@gmail.com', '0186861844'),
(13, 'Muhd', 'Hilman', 'Male', 27, 'hilman@gmail.com', '0147733482'),
(14, 'Nurul', 'Atiqah', 'Female', 25, 'atiqah@gmail.com', '0186861855'),
(15, 'Nur', 'Hazwani', 'Female', 26, 'hazwani@gmail.com', '0172631818'),
(16, 'Tester', 'lol', 'Male', 23, 'aimanfarihin@gmail.com', '0128846432'),
(17, 'Nur', 'Aleesa', 'Female', 25, 'aleesa@gmail.com', '01196234419'),
(18, 'Nurul', 'Fatehah', 'Female', 27, 'nrlfatehah@gmail.com', '01143233196'),
(19, 'Muzammil', 'Haziq', 'Male', 25, 'haziq@gmail.com', '0178827322'),
(20, 'Abdul', 'Razak', 'Male', 42, 'abdulrazak@gmail.com', '0172631819'),
(21, 'Hasanul', 'Arifin', 'Male', 25, 'Hsnlarifin@yahoo.com', '0123456789'),
(22, 'Siti Nur', 'Aqilah', 'Female', 22, 'aqilahh@gmail.com', '0123456333'),
(23, 'Nur', 'Shakirah', 'Female', 22, 'shakirah@yahoo.com', '0123456444'),
(24, 'Afiq', 'Haiqal', 'Male', 24, 'afiq@gmail.com', '0123456555'),
(25, 'Ahmad', 'Hazim', 'Male', 21, 'hazim@yahoo.com', '0123456666'),
(26, 'Hazim', 'Aziz', 'Male', 27, 'hazimaziz@gmail.com', '0123456777'),
(27, 'Hakim', 'Ahmad', 'Male', 30, 'hakim@gmail.com', '01134567772'),
(28, 'Nur', 'Aisyah', 'Female', 29, 'aisyah@gmail.com', '0123456777'),
(29, 'Nur', 'Hakimah', 'Female', 27, 'hakimah@yahoo.com', '0133456777'),
(30, 'Nurin', 'Izzati', 'Female', 25, 'izzati@gmail.com', '0143456777'),
(31, 'Muhd', 'Iman', 'Male', 28, 'iman@gmail.com', '0153456777'),
(32, 'Aina', 'Nabilah', 'Female', 24, 'aina@gmail.com', '0163456777'),
(33, 'Mohd', 'Yusri', 'Male', 33, 'yusri@gmail.com', '0173456777'),
(34, 'Aina', 'Ashiqin', 'Female', 23, 'ashiqin@gmail.com', '0183456777'),
(35, 'Nurul', 'Shazwani', 'Female', 25, 'shazwani@gmail.com', '0193456777'),
(36, 'Alia', 'Fatihah', 'Female', 26, 'alia@gmail.com', '01133563447'),
(37, 'Nur', 'Khalisa', 'Female', 24, 'lisa@gmail.com', '0175432221'),
(38, 'Mohd', 'Khairul', 'Male', 28, 'khairul@gmail.com', '0143256777'),
(39, 'Nur', 'Karisma', 'Female', 23, 'karisma@gmail.com', '0129516777'),
(40, 'Muhd', 'Syaraf', 'Male', 25, 'syaraf@gmail.com', '0182156777'),
(41, 'Muhammad', 'Khaleef', 'Male', 26, 'khaleef@gmail.com', '0192156777'),
(42, 'Mohd', 'Jasmi', 'Male', 32, 'jasmi@gmail.com', '0172156754'),
(43, 'Fadhilah', 'Nor', 'Female', 29, 'fadhilah@gmail.com', '0122156117'),
(44, 'Nurul', 'Diana', 'Female', 27, 'diana@gmail.com', '0192156765'),
(45, 'Siti', 'Athirah', 'Female', 27, 'athirah@gmail.com', '0198765432'),
(46, 'Nurul', 'Hidayah', 'Female', 26, 'hidayah@gmail.com', '0148765234'),
(47, 'Muhd', 'Danish', 'Male', 25, 'danish@gmail.com', '0188765552'),
(48, 'Dina', 'Alia', 'Female', 27, 'dina@gmail.com', '0192165432'),
(49, 'Nur', 'Nazreena', 'Female', 26, 'nazreena@gmail.com', '01102156765'),
(50, 'Muhammad', 'Firdaus', 'Male', 30, 'firdaus@gmail.com', '0114236765'),
(51, 'Muhd', 'Darwish', 'Male', 24, 'darwish@gmail.com', '0192167899');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `veh_ID` int(10) NOT NULL,
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
  `brand_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`veh_ID`, `veh_Model`, `price_per_Day`, `fuel_Type`, `veh_Colour`, `seating_Capacity`, `veh_Transmission`, `plateNo`, `veh_Image_1`, `register_Date`, `update_Date`, `brand_ID`) VALUES
(1, 'Alza', 200, 'Petrol ', 'Silver', '7', 'Automatic', NULL, 'alza.jpg', '2023-01-03 07:45:49', NULL, 1),
(2, 'Exora', 280, 'Petrol', 'Red', '8', 'Automatic', NULL, 'exora.jpg', '2023-01-03 07:47:12', NULL, 2),
(3, 'Altis', 300, 'Petrol ', 'White', '5', 'Automatic', 'TA 1145', 'altis.jpg', '2023-01-17 13:58:29', NULL, 4),
(4, 'X1', 450, 'Petrol ', 'Red', '5', 'Automatic', NULL, 'x1.png', '2023-01-17 14:00:23', NULL, 7),
(5, 'Civic Type-R', 1000, 'Petrol*', 'Red', '5', 'Manual', 'CVR 5555', 'civic_r.jpg', '2023-01-17 14:01:35', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_record`
--

CREATE TABLE `vehicle_record` (
  `red_id` int(10) NOT NULL,
  `veh_ID` int(11) NOT NULL,
  `sup_id` int(10) NOT NULL,
  `policy_no` varchar(255) NOT NULL,
  `ins_plan` varchar(255) NOT NULL,
  `condition_type` varchar(255) NOT NULL,
  `add_date` date NOT NULL,
  `update_date` date DEFAULT NULL,
  `car_loan_status` varchar(255) NOT NULL,
  `Progress` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 1, '2023-01-03 10:02:34', 'Unavailable', 2),
(3, 1, '2023-01-17 14:04:32', 'Unavailable', 2),
(4, 2, '2023-01-17 21:49:35', 'Unavailable', 1),
(5, 1, '2023-01-17 21:49:51', 'Available', 3);

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
  ADD KEY `fk2_res_ID` (`resv_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`resv_ID`),
  ADD KEY `fk2_cust_ID` (`cust_ID`),
  ADD KEY `fk3_veh_ID` (`veh_ID`),
  ADD KEY `fk4_payment_ID` (`payment_ID`);

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
  ADD PRIMARY KEY (`sup_id`);

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
  ADD KEY `fk_brand_ID` (`brand_ID`);

--
-- Indexes for table `vehicle_record`
--
ALTER TABLE `vehicle_record`
  ADD PRIMARY KEY (`red_id`),
  ADD KEY `VEHICLE_SUPPLIER_FK` (`veh_ID`),
  ADD KEY `VEHICLE_SUP_FK` (`sup_id`);

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
  MODIFY `brand_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `payment_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `resv_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sup_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `veh_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle_record`
--
ALTER TABLE `vehicle_record`
  MODIFY `red_id` int(10) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `license`
--
ALTER TABLE `license`
  ADD CONSTRAINT `fk_cust_ID` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk2_resv_ID` FOREIGN KEY (`resv_ID`) REFERENCES `reservation` (`resv_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk2_cust_ID` FOREIGN KEY (`cust_ID`) REFERENCES `customer` (`cust_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_veh_ID` FOREIGN KEY (`veh_ID`) REFERENCES `vehicle` (`veh_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk4_payment_ID` FOREIGN KEY (`payment_ID`) REFERENCES `payment` (`payment_ID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk2_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `fk_branch_ID` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `fk_brand_ID` FOREIGN KEY (`brand_ID`) REFERENCES `brand` (`brand_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_record`
--
ALTER TABLE `vehicle_record`
  ADD CONSTRAINT `VEHICLE_SUPPLIER_FK` FOREIGN KEY (`veh_ID`) REFERENCES `vehicle` (`veh_ID`),
  ADD CONSTRAINT `VEHICLE_SUP_FK` FOREIGN KEY (`sup_id`) REFERENCES `supplier` (`sup_ID`);

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
