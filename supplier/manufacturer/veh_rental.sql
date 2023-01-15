CREATE TABLE `supplier` (
  `sup_id` int(11)  NOT NULL AUTO_INCREMENT,
  `sup_name` varchar(25) NOT NULL,
  `sup_email` varchar(50) DEFAULT NULL,
  `sup_phone` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
CONSTRAINT VEHICLE_PK PRIMARY KEY (sup_id));

CREATE TABLE `vehicle` (
  `veh_ID` int(10)  NOT NULL AUTO_INCREMENT,
  `veh_Model` varchar(255)  NOT NULL,
  `price_per_day` int(10) DEFAULT NULL,
  `fuel_type` varchar(255)  NOT NULL,
  `veh_Colour` varchar(255)  NOT NULL,
  `seating_Capacity` varchar(255)  NOT NULL,
  `veh_Transmission` varchar(255)  NOT NULL,
  `veh_plateNo` varchar(255)  NOT NULL,
  `veh_Image` varchar(255)  NOT NULL,
  `brand_ID` int(10)  NOT NULL,
CONSTRAINT VEHICLE_PK PRIMARY KEY (veh_ID),
CONSTRAINT VEHICLE_FK FOREIGN KEY (brand_ID) REFERENCES Brand(brand_ID));

CREATE TABLE `Brand`(
  `brand_ID`int(10)  NOT NULL AUTO_INCREMENT,
  `brand_Name` varchar(255)  NOT NULL,
  `add_Date` Date NOT NULL,
  `update_Date` Date NOT NULL,
CONSTRAINT CONDITION_PK PRIMARY KEY (brand_ID));

CREATE TABLE `Vehicle_Record`(
`red_id` int(10) NOT NULL,
`veh_ID` int(11) NOT NULL,
`sup_id` int(10) NOT NULL,
`policy_no` int(11) NOT NULL,
`condition_type`varchar(255) NOT NULL,
`add_date` date NOT NULL,
`update_date` date DEFAULT NULL,
CONSTRAINT VEHICLE_RECORD_PK PRIMARY KEY (red_id),
CONSTRAINT VEHICLE_SUPPLIER_FK FOREIGN KEY(veh_ID) REFERENCES VEHICLE(veh_ID),
CONSTRAINT VEHICLE_SUP_FK FOREIGN KEY (sup_id) REFERENCES	Supplier(sup_id)
CONSTRAINT VEHICLE_SUPP_FK FOREIGN KEY (policy_no) REFERENCES Insurance (policy_no));

CREATE TABLE `Insurance`(
  `policy_no`int(10)  NOT NULL AUTO_INCREMENT,
  `ins_plan` varchar(255)  NOT NULL,
CONSTRAINT INSURANCE_PK PRIMARY KEY (policy_no));

