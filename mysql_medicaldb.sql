-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 07:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysql_medicaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressid` int UNSIGNED NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(60) NOT NULL,
  `region` varchar(60) NOT NULL,
  `country` varchar(60) NOT NULL,
  `postal_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `checkup`
--

CREATE TABLE `checkup` (
  `visitid` int UNSIGNED NOT NULL,
  `weight` decimal(6,3) NOT NULL,
  `height` decimal(6,3) NOT NULL,
  `systolic_blood_pressure` decimal(6,3) NOT NULL,
  `diastolic_blood_pressure` decimal(6,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorid` int UNSIGNED NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `middlename` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `addressid` int UNSIGNED NOT NULL,
  `specialty` varchar(90) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `dateofbirth` date NOT NULL,
  `sex` ENUM('Male', 'Female', 'Other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitalized`
--

CREATE TABLE `hospitalized` (
  `hospitalizedid` int UNSIGNED NOT NULL,
  `entrydate` date NOT NULL,
  `exitdate` date DEFAULT NULL,
  `amka` varchar(60) NOT NULL,
  `hospitalclinicid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_clinic`
--

CREATE TABLE `hospital_clinic` (
  `hospitalclinicid` int UNSIGNED NOT NULL,
  `hosp_name` varchar(60) NOT NULL,
  `addressid` int UNSIGNED NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `fax` varchar(14) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `includes`
--

CREATE TABLE `includes` (
  `includesid` int UNSIGNED NOT NULL,
  `medicineid` int UNSIGNED NOT NULL,
  `prescriptionid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `visitid` int UNSIGNED NOT NULL,
  `statebetween` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineid` int UNSIGNED NOT NULL,
  `med_name` varchar(60) NOT NULL,
  `med_type` varchar(60) NOT NULL,
  `expirationdate` date NOT NULL,
  `activeingredients` varchar(255) NOT NULL,
  `med_usage` varchar(255) NOT NULL,
  `sideeffects` varchar(255) NOT NULL,
  `indications` varchar(255) NOT NULL,
  `prescreptionneeded` ENUM('Yes', 'No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newissue`
--

CREATE TABLE `newissue` (
  `visitid` int UNSIGNED NOT NULL,
  `initialdiagnosis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `amka` varchar(60) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `middlename` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `fathername` varchar(60) NOT NULL,
  `addressid` int UNSIGNED NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `telephone` varchar(14) NOT NULL,
  `dateofbirth` date NOT NULL,
  `sex` ENUM('Male', 'Female', 'Other') NOT NULL,
  `insurancename` varchar(60) NOT NULL,
  `insuranceid` varchar(30) NOT NULL,
  `weight` decimal(6,3) NOT NULL,
  `height` decimal(6,3) NOT NULL,
  `bloodtype` ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NOT NULL,
  `familystatus` ENUM('Divorced', 'Married', 'Single', 'Widowed', 'Separated') NOT NULL,
  `insuredby` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionid` int UNSIGNED NOT NULL,
  `presc_type` varchar(60) NOT NULL,
  `startdate` date NOT NULL,
  `expirationdate` date DEFAULT NULL,
  `comments` varchar(255) NOT NULL,
  `eligibility` ENUM('Yes', 'No') NOT NULL,
  `dosage` int(30) NOT NULL,
  `doctorid` int UNSIGNED NOT NULL,
  `amka` varchar(60) NOT NULL,
  `visitid` int UNSIGNED NOT NULL,
  `is_renewable` ENUM('Yes', 'No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `renewable`
--

CREATE TABLE `renewable` (
  `prescriptionid` int UNSIGNED NOT NULL,
  `renewabletimes` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supervise`
--

CREATE TABLE `supervise` (
  `recordid` int UNSIGNED NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `amka` varchar(60) NOT NULL,
  `doctorid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `visitid` int UNSIGNED NOT NULL,
  `visit_date` datetime NOT NULL,
  `visit_type` ENUM('CheckUp', 'Inspection', 'NewIssue') NOT NULL,
  `amka` varchar(60) NOT NULL,
  `doctorid` int UNSIGNED NOT NULL,
  `hospitalclinicid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workson`
--

CREATE TABLE `workson` (
  `worksonid` int UNSIGNED NOT NULL,
  `doctorid` int UNSIGNED NOT NULL,
  `hospitalclinicid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressid`);

--
-- Indexes for table `checkup`
--
ALTER TABLE `checkup`
  ADD PRIMARY KEY (`visitid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorid`);

--
-- Indexes for table `hospitalized`
--
ALTER TABLE `hospitalized`
  ADD PRIMARY KEY (`hospitalizedid`),
  ADD KEY `hospitalclinicid` (`hospitalclinicid`),
  ADD KEY `amka` (`amka`);

--
-- Indexes for table `hospital_clinic`
--
ALTER TABLE `hospital_clinic`
  ADD PRIMARY KEY (`hospitalclinicid`);

--
-- Indexes for table `includes`
--
ALTER TABLE `includes`
  ADD PRIMARY KEY (`includesid`),
  ADD KEY `medicineid` (`medicineid`),
  ADD KEY `prescriptionid` (`prescriptionid`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`visitid`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineid`);

--
-- Indexes for table `newissue`
--
ALTER TABLE `newissue`
  ADD PRIMARY KEY (`visitid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`amka`),
  ADD KEY `insuredby` (`insuredby`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionid`),
  ADD KEY `amka` (`amka`),
  ADD KEY `doctorid` (`doctorid`),
  ADD KEY `visitid` (`visitid`);

--
-- Indexes for table `renewable`
--
ALTER TABLE `renewable`
  ADD PRIMARY KEY (`prescriptionid`);

--
-- Indexes for table `supervise`
--
ALTER TABLE `supervise`
  ADD PRIMARY KEY (`recordid`),
  ADD KEY `amka` (`amka`),
  ADD KEY `doctorid` (`doctorid`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visitid`),
  ADD KEY `doctorid` (`doctorid`),
  ADD KEY `amka` (`amka`),
  ADD KEY `hospitalclinicid` (`hospitalclinicid`);

--
-- Indexes for table `workson`
--
ALTER TABLE `workson`
  ADD PRIMARY KEY (`worksonid`),
  ADD KEY `doctorid` (`doctorid`),
  ADD KEY `hospitalclinicid` (`hospitalclinicid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospital_clinic`
--
ALTER TABLE `hospital_clinic`
  MODIFY `hospitalclinicid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitalized`
--
ALTER TABLE `hospitalized`
  MODIFY `hospitalizedid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `includes`
--
ALTER TABLE `includes`
  MODIFY `includesid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescriptionid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supervise`
--
ALTER TABLE `supervise`
  MODIFY `recordid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visitid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workson`
--
ALTER TABLE `workson`
  MODIFY `worksonid` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hospital_clinic`
--
ALTER TABLE `hospital_clinic`
  ADD CONSTRAINT `hospital_clinic_ibfk_1` FOREIGN KEY (`addressid`) REFERENCES `address` (`addressid`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`addressid`) REFERENCES `address` (`addressid`);

--
-- Constraints for table `checkup`
--
ALTER TABLE `checkup`
  ADD CONSTRAINT `checkup_ibfk_1` FOREIGN KEY (`visitid`) REFERENCES `visit` (`visitid`) ON DELETE CASCADE;

--
-- Constraints for table `hospitalized`
--
ALTER TABLE `hospitalized`
  ADD CONSTRAINT `hospitalized_ibfk_1` FOREIGN KEY (`hospitalclinicid`) REFERENCES `hospital_clinic` (`hospitalclinicid`),
  ADD CONSTRAINT `hospitalized_ibfk_2` FOREIGN KEY (`amka`) REFERENCES `patient` (`amka`);

--
-- Constraints for table `includes`
--
ALTER TABLE `includes`
  ADD CONSTRAINT `includes_ibfk_1` FOREIGN KEY (`medicineid`) REFERENCES `medicine` (`medicineid`),
  ADD CONSTRAINT `includes_ibfk_2` FOREIGN KEY (`prescriptionid`) REFERENCES `prescription` (`prescriptionid`) ON UPDATE RESTRICT ON DELETE RESTRICT;

--
-- Constraints for table `inspection`
--
ALTER TABLE `inspection`
  ADD CONSTRAINT `inspection_ibfk_1` FOREIGN KEY (`visitid`) REFERENCES `visit` (`visitid`) ON DELETE CASCADE;

--
-- Constraints for table `newissue`
--
ALTER TABLE `newissue`
  ADD CONSTRAINT `newissue_ibfk_1` FOREIGN KEY (`visitid`) REFERENCES `visit` (`visitid`) ON DELETE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`insuredby`) REFERENCES `patient` (`amka`) ON DELETE SET NULL,
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`addressid`) REFERENCES `address` (`addressid`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`amka`) REFERENCES `patient` (`amka`) ON UPDATE RESTRICT ON DELETE RESTRICT,
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`doctorid`),
  ADD CONSTRAINT `prescription_ibfk_3` FOREIGN KEY (`visitid`) REFERENCES `visit` (`visitid`) ON UPDATE RESTRICT ON DELETE RESTRICT;

--
-- Constraints for table `renewable`
--
ALTER TABLE `renewable`
  ADD CONSTRAINT `renewable_ibfk_1` FOREIGN KEY (`prescriptionid`) REFERENCES `prescription` (`prescriptionid`) ON DELETE CASCADE;

--
-- Constraints for table `supervise`
--
ALTER TABLE `supervise`
  ADD CONSTRAINT `supervise_ibfk_1` FOREIGN KEY (`amka`) REFERENCES `patient` (`amka`),
  ADD CONSTRAINT `supervise_ibfk_2` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`doctorid`);

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`doctorid`) ON UPDATE RESTRICT ON DELETE RESTRICT,
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`amka`) REFERENCES `patient` (`amka`) ON UPDATE RESTRICT ON DELETE RESTRICT,
  ADD CONSTRAINT `visit_ibfk_3` FOREIGN KEY (`hospitalclinicid`) REFERENCES `hospital_clinic` (`hospitalclinicid`) ON UPDATE RESTRICT ON DELETE RESTRICT;

--
-- Constraints for table `workson`
--
ALTER TABLE `workson`
  ADD CONSTRAINT `workson_ibfk_1` FOREIGN KEY (`doctorid`) REFERENCES `doctor` (`doctorid`),
  ADD CONSTRAINT `workson_ibfk_2` FOREIGN KEY (`hospitalclinicid`) REFERENCES `hospital_clinic` (`hospitalclinicid`);

--
-- Adding CHECK Constraint to Existing CheckUp Table
--
ALTER TABLE `checkup`
  ADD CONSTRAINT chk_patient_systolic_blood_pressure CHECK (systolic_blood_pressure BETWEEN 50 AND 250),
  ADD CONSTRAINT chk_patient_diastolic_blood_pressure CHECK (diastolic_blood_pressure BETWEEN 30 AND 150);

--
-- Adding CHECK Constraint to Existing prescription Table
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `chk_prescription_dates` CHECK (`startdate` <= `expirationdate`);

--
-- Adding CHECK Constraint to Existing hospitalized Table
--
ALTER TABLE `hospitalized`
  ADD CONSTRAINT `chk_hospitalized_dates` CHECK (`exitdate` IS NULL OR `entrydate` <= `exitdate`);

--
-- Ensure that only one subtype entry per visit will exist
--
ALTER TABLE `visit`
  ADD CONSTRAINT `unique_visit_subtype` UNIQUE (`visitid`, `visit_type`);

--
-- Ading triggers to ensure that doctors date of birth is not in the future
--
DELIMITER //
CREATE TRIGGER check_dateofbirth_before_insert BEFORE INSERT ON doctor
FOR EACH ROW
BEGIN
    IF NEW.dateofbirth > CURDATE() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date of birth cannot be in the future';
    END IF;
END//
DELIMITER ;

DELIMITER //
CREATE TRIGGER check_dateofbirth_before_update BEFORE UPDATE ON doctor
FOR EACH ROW
BEGIN
    IF NEW.dateofbirth > CURDATE() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date of birth cannot be in the future';
    END IF;
END//
DELIMITER ;

--
-- Ading triggers to ensure that patients date of birth is not in the future
--
DELIMITER //
CREATE TRIGGER check_dateofbirth_before_insert_patient BEFORE INSERT ON patient
FOR EACH ROW
BEGIN
    IF NEW.dateofbirth > CURDATE() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date of birth cannot be in the future';
    END IF;
END//
DELIMITER ;

DELIMITER //
CREATE TRIGGER check_dateofbirth_before_update_patient BEFORE UPDATE ON patient
FOR EACH ROW
BEGIN
    IF NEW.dateofbirth > CURDATE() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Date of birth cannot be in the future';
    END IF;
END//
DELIMITER ;

--
-- This trigger will prevent the insertion of a record into the checkup table if the associated visitid does not exist in the visit table or if the associated visit is not of type 'CheckUp'.
--
DELIMITER //

CREATE TRIGGER enforce_checkup_visit_type
BEFORE INSERT ON checkup
FOR EACH ROW
BEGIN
    DECLARE v_visit_type ENUM('CheckUp');
    SELECT visit_type INTO v_visit_type FROM visit WHERE visitid = NEW.visitid;

    IF v_visit_type IS NULL OR v_visit_type != 'CheckUp' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'A checkup must be associated with a visit of type CheckUp';
    END IF;
END;
//

DELIMITER ;

--
-- This trigger will prevent the insertion of a record into the newissue table if the associated visitid does not exist in the visit table or if the associated visit is not of type 'NewIssue'.
--
DELIMITER //

CREATE TRIGGER enforce_newissue_visit_type
BEFORE INSERT ON newissue
FOR EACH ROW
BEGIN
    DECLARE v_visit_type ENUM('NewIssue');
    SELECT visit_type INTO v_visit_type FROM visit WHERE visitid = NEW.visitid;

    IF v_visit_type IS NULL OR v_visit_type != 'NewIssue' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'A newissue must be associated with a visit of type NewIssue';
    END IF;
END;
//

DELIMITER ;

--
-- This trigger will prevent the insertion of a record into the inspection table if the associated visitid does not exist in the visit table or if the associated visit is not of type 'Inspection'.
--
DELIMITER //

CREATE TRIGGER enforce_inspection_visit_type
BEFORE INSERT ON inspection
FOR EACH ROW
BEGIN
    DECLARE v_visit_type ENUM('Inspection');
    SELECT visit_type INTO v_visit_type FROM visit WHERE visitid = NEW.visitid;

    IF v_visit_type IS NULL OR v_visit_type != 'Inspection' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'An inspection must be associated with a visit of type Inspection';
    END IF;
END;
//

DELIMITER ;

--
-- Create a trigger to enforce that a prescription can only be marked as renewable when is_renewable is set to 'Yes'
--
DELIMITER //

CREATE TRIGGER enforce_renewable_condition
BEFORE INSERT ON `renewable`
FOR EACH ROW
BEGIN
    DECLARE v_is_renewable ENUM('Yes', 'No');
    SELECT is_renewable INTO v_is_renewable FROM `prescription` WHERE prescriptionid = NEW.prescriptionid;

    IF v_is_renewable != 'Yes' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot mark prescription as renewable if is_renewable is not set to Yes';
    END IF;
END;
//

DELIMITER ;

--
-- INSERT STATEMENTS to fill the date with sample data
--

INSERT INTO address (street, city, region, country, postal_code) VALUES
('101 Maple St', 'Springfield', 'IL', 'USA', '62704'),
('202 Pine St', 'Shelbyville', 'IL', 'USA', '62705'),
('303 Cedar St', 'Capital City', 'IL', 'USA', '62706'),
('404 Birch St', 'Ogdenville', 'IL', 'USA', '62707'),
('505 Walnut St', 'North Haverbrook', 'IL', 'USA', '62708'),
('606 Willow St', 'Brockway', 'IL', 'USA', '62709'),
('123 Main St', 'Springfield', 'IL', 'USA', '62701'),
('456 Elm St', 'Shelbyville', 'IL', 'USA', '62702'),
('789 Oak St', 'Capital City', 'IL', 'USA', '62703'),
('123 Oak Street', 'Springfield', 'IL', 'USA', '62701'),
('456 Elm Street', 'Birmingham', 'AL', 'USA', '35203'),
('789 Maple Avenue', 'Anchorage', 'AK', 'USA', '99501'),
('101 Pine Street', 'Phoenix', 'AZ', 'USA', '85001'),
('202 Cedar Avenue', 'Little Rock', 'AR', 'USA', '72201'),
('303 Birch Street', 'Los Angeles', 'CA', 'USA', '90001'),
('404 Walnut Avenue', 'Denver', 'CO', 'USA', '80201'),
('505 Oak Street', 'Hartford', 'CT', 'USA', '06101'),
('606 Elm Avenue', 'Dover', 'DE', 'USA', '19901'),
('707 Maple Street', 'Washington', 'DC', 'USA', '20001'),
('808 Pine Avenue', 'Tallahassee', 'FL', 'USA', '32301'),
('909 Cedar Street', 'Atlanta', 'GA', 'USA', '30301'),
('1010 Birch Avenue', 'Honolulu', 'HI', 'USA', '96801'),
('1111 Walnut Street', 'Boise', 'ID', 'USA', '83701'),
('1212 Oak Avenue', 'Springfield', 'IL', 'USA', '62701'),
('1313 Elm Street', 'Indianapolis', 'IN', 'USA', '46201'),
('1414 Maple Avenue', 'Des Moines', 'IA', 'USA', '50301'),
('1515 Pine Street', 'Topeka', 'KS', 'USA', '66601'),
('1616 Cedar Avenue', 'Frankfort', 'KY', 'USA', '40601'),
('1717 Birch Street', 'Baton Rouge', 'LA', 'USA', '70801'),
('1818 Walnut Avenue', 'Augusta', 'ME', 'USA', '04330'),
('1919 Oak Street', 'Annapolis', 'MD', 'USA', '21401'),
('2020 Elm Avenue', 'Boston', 'MA', 'USA', '02101'),
('2121 Maple Street', 'Lansing', 'MI', 'USA', '48901'),
('2222 Pine Avenue', 'St. Paul', 'MN', 'USA', '55101'),
('2323 Cedar Street', 'Jackson', 'MS', 'USA', '39201'),
('2424 Birch Avenue', 'Jefferson City', 'MO', 'USA', '65101'),
('2525 Walnut Street', 'Helena', 'MT', 'USA', '59601'),
('2626 Oak Avenue', 'Lincoln', 'NE', 'USA', '68501');

INSERT INTO hospital_clinic (hosp_name, addressid, telephone, fax, email) VALUES
('Mercy General Hospital', 1, '555-555-0001', '555-555-0002', 'clinic1@example.com'),
('Cedar Sinai Medical Center', 2, '555-555-0003', '555-555-0004', 'clinic2@example.com'),
('Johns Hopkins Hospital', 3, '555-555-0005', '555-555-0006', 'clinic3@example.com'),
('Massachusetts General Hospital', 4, '555-555-0032', '555-555-1112', 'hospital1@example.com'),
('Mayo Clinic', 5, '555-555-6711', '555-555-2223', 'hospital2@example.com'),
('Cleveland Clinic', 6, '555-555-1019', '555-555-3334', 'hospital3@example.com'),
('Mount Sinai Hospital', 7, '555-555-1122', '555-555-4445', 'hospital4@example.com');

INSERT INTO doctor (firstname, middlename, lastname, addressid, specialty, email, telephone, dateofbirth, sex) VALUES
('John', 'A', 'Doe', 8, 'Cardiology', 'johndoe@example.com', '555-555-1092', '1970-01-15', 'Male'),
('Jane', 'B', 'Smith', 9, 'Neurology', 'janesmith@example.com', '555-555-7685', '1980-05-25', 'Female'),
('Jim', 'C', 'Beam', 10, 'Orthopedics', 'jimbeam@example.com', '555-555-0985', '1975-11-30', 'Male'),
('Emma', 'A', 'Johnson', 11, 'Pediatrics', 'emma@example.com', '555-555-1980', '1976-05-20', 'Female'),
('Noah', 'B', 'Martinez', 12, 'Cardiology', 'noah@example.com', '555-555-1762', '1983-08-15', 'Male'),
('Olivia', 'C', 'Lopez', 13, 'Orthopedics', 'olivia@example.com', '555-555-1094', '1988-11-10', 'Female'),
('Liam', 'D', 'Gonzalez', 14, 'Neurology', 'liam@example.com', '555-555-0975', '1975-02-25', 'Other'),
('Ava', 'E', 'Perez', 15, 'Dermatology', 'ava@example.com', '555-555-0097', '1990-07-30', 'Female'),
('William', 'F', 'Robinson', 16, 'Oncology', 'william@example.com', '555-555-2375', '1980-12-05', 'Male'),
('Sophia', 'G', 'Jackson', 17, 'Endocrinology', 'sophia@example.com', '555-555-7644', '1987-03-18', 'Other'),
('James', 'H', 'Harris', 18, 'Psychiatry', 'james@example.com', '555-555-9897', '1979-09-20', 'Male'),
('Isabella', 'I', 'Clark', 19, 'Gastroenterology', 'isabella@example.com', '555-555-5467', '1985-04-12', 'Female'),
('Logan', 'J', 'Lewis', 20, 'Urology', 'logan@example.com', '555-555-4565', '1982-10-30', 'Male');

INSERT INTO patient (amka, firstname, middlename, lastname, fathername, addressid, email, telephone, dateofbirth, sex, insurancename, insuranceid, weight, height, bloodtype, familystatus, insuredby) VALUES
(01069000111, 'Alice', 'M', 'Wonderland', 'George', 21, 'alice@example.com', '555-555-1111', '1990-06-01', 'Other', 'InsureCoEX', 'INS12345', 55.5, 165.2, 'A+', 'Single', NULL),
(15128500112, 'Bob', 'L', 'Builder', 'Frank', 22, 'bob@example.com', '555-555-2222', '1985-12-15', 'Male', 'InsureCoFULL', 'INS67890', 80.0, 175.0, 'B+', 'Married', NULL),
(20010000113, 'Charlie', 'K', 'Chocolate', 'Henry', 23, 'charlie@example.com', '555-555-3333', '2000-03-20', 'Other', 'InsureCoA', 'INS13579', 70.0, 180.0, 'O-', 'Divorced', NULL),
(10098200124, 'Emily', 'N', 'Taylor', 'David', 24, 'emily@example.com', '555-555-4444', '1982-09-10', 'Female', 'InsureCoB', 'INS24680', 60.0, 170.0, 'A-', 'Married', '15128500112'),
(25037800125, 'Michael', 'P', 'Johnson', 'Robert', 25, 'michael@example.com', '555-555-5555', '1978-03-25', 'Male', 'InsureCoC', 'INS13578', 85.0, 180.0, 'B+', 'Married', NULL),
(15119500126, 'Sophia', 'R', 'Martinez', 'William', 26, 'sophia@example.com', '555-555-6666', '1995-11-15', 'Female', 'InsureCoB', 'INS97531', 55.0, 160.0, 'O-', 'Single', NULL),
(20078900127, 'Alexander', 'S', 'Brown', 'James', 27, 'alexander@example.com', '555-555-7777', '1989-07-20', 'Male', 'InsureCoV', 'INS86420', 75.0, 175.0, 'AB+', 'Single', NULL),
(30088000130, 'Ava', 'V', 'Hernandez', 'Matthew', 28, 'ava@example.com', '555-555-1010', '1980-08-30', 'Female', 'InsureCoK', 'INS53097', 65.0, 165.0, 'B-', 'Married', NULL),
(05010100128, 'Olivia', 'T', 'Garcia', 'Daniel', 29, 'olivia@example.com', '555-555-8888', '2001-01-05', 'Female', 'InsureCoG', 'INS75309', 50.0, 155.0, 'A+', 'Single', '30088000130'),
(12059300129, 'William', 'U', 'Rodriguez', 'John', 30, 'william@example.com', '555-555-9999', '1993-05-12', 'Male', 'InsureCoH', 'INS64285', 90.0, 185.0, 'O+', 'Married', '25037800125'),
(18047500131, 'James', 'W', 'Lopez', 'Joseph', 31, 'james@example.com', '555-555-2020', '1975-04-18', 'Male', 'InsureCoJ', 'INS41938', 70.0, 170.0, 'AB-', 'Married', '30088000130'),
(08129800132, 'Charlotte', 'X', 'Lee', 'Christopher', 32, 'charlotte@example.com', '555-555-3030', '1998-12-08', 'Female', 'InsureCoU', 'INS82674', 55.0, 160.0, 'A-', 'Single', NULL),
(03108700133, 'Mason', 'Y', 'Walker', 'Andrew', 33, 'mason@example.com', '555-555-4040', '1987-10-03', 'Male', 'InsureCoP', 'INS71348', 80.0, 180.0, 'B+', 'Windowed', NULL);

INSERT INTO visit (visit_date, visit_type, amka, doctorid, hospitalclinicid) VALUES
('2024-06-01', 'CheckUp', 01069000111, 1, 1),
('2024-06-02', 'Inspection', 15128500112, 2, 2),
('2024-06-03', 'NewIssue', 20010000113, 3, 3),
('2024-06-10', 'CheckUp', 01069000111, 1, 1),
('2024-06-11', 'NewIssue', 15128500112, 2, 2),
('2024-06-12', 'Inspection', 20010000113, 3, 3),
('2024-06-13', 'CheckUp', 10098200124, 4, 4),
('2024-06-14', 'NewIssue', 25037800125, 5, 5),
('2024-06-15', 'Inspection', 15119500126, 6, 6),
('2024-06-16', 'CheckUp', 20078900127, 7, 7),
('2024-06-17', 'NewIssue', 05010100128, 8, 7),
('2024-06-18', 'Inspection', 12059300129, 9, 5),
('2024-06-19', 'CheckUp', 30088000130, 10, 4);

INSERT INTO checkup (visitid, weight, height, systolic_blood_pressure, diastolic_blood_pressure) VALUES
(1, 55.5, 165.2, 120, 80),
(4, 65.5, 167.2, 130, 90),
(7, 95.5, 185.2, 140, 70),
(10, 115.5, 205.2, 90, 50),
(13, 45.5, 155.2, 110, 60);

INSERT INTO newissue (visitid, initialdiagnosis) VALUES
(3, 'Diabetes Mellitus'),
(5, 'Fever and cough'),
(8, 'Abdominal pain and nausea'),
(11, 'Joint pain and swelling');

INSERT INTO inspection (visitid, statebetween) VALUES
(2, 'Stable condition, requires follow-up'),
(6, 'Improved symptoms, not-required follow-up'),
(9, 'No significant changes observed, no-required follow-up'),
(12, 'Worsening of symptoms, requires follow-up');

INSERT INTO medicine (med_name, med_type, expirationdate, activeingredients, med_usage, sideeffects, indications, prescreptionneeded) VALUES
('Paracetamol', 'Analgesic', '2025-12-31', 'Paracetamol 500mg', 'Pain relief', 'Nausea, Rash', 'Pain, Fever', 'No'),
('Ibuprofen', 'Anti-inflammatory', '2027-11-30', 'Ibuprofen 200mg', 'Anti-inflammatory', 'Stomach pain, Headache', 'Inflammation, Pain', 'No'),
('Amoxicillin', 'Antibiotic', '2026-10-15', 'Amoxicillin 250mg', 'Antibacterial', 'Diarrhea, Nausea', 'Bacterial infections', 'Yes'),
('Lisinopril', 'ACE inhibitor', '2026-09-30', 'Lisinopril 10mg', 'Blood pressure management', 'Dizziness, Dry cough', 'Hypertension', 'No'),
('Atorvastatin', 'Statins', '2025-08-31', 'Atorvastatin 20mg', 'Lowering cholesterol levels', 'Muscle pain, Liver problems', 'Hyperlipidemia', 'Yes'),
('Metformin', 'Biguanide', '2027-07-30', 'Metformin 500mg', 'Lowering blood sugar levels', 'Nausea, Diarrhea', 'Type 2 Diabetes', 'Yes'),
('Levothyroxine', 'Thyroid hormone', '2028-06-30', 'Levothyroxine 50mcg', 'Thyroid hormone replacement', 'Weight loss, Insomnia', 'Hypothyroidism', 'No'),
('Omeprazole', 'Proton pump inhibitor', '2029-05-31', 'Omeprazole 20mg', 'Reducing stomach acid production', 'Headache, Abdominal pain', 'Gastroesophageal reflux disease', 'Yes'),
('Alprazolam', 'Benzodiazepine', '2025-04-30', 'Alprazolam 0.5mg', 'Anxiety management', 'Drowsiness, Dizziness', 'Anxiety disorders', 'Yes'),
('Citalopram', 'Selective serotonin reuptake inhibitor', '2026-03-31', 'Citalopram 20mg', 'Treating depression', 'Nausea, Insomnia', 'Major depressive disorder', 'No'),
('Warfarin', 'Anticoagulant', '2025-02-29', 'Warfarin 5mg', 'Preventing blood clots', 'Bleeding, Bruising', 'Thrombosis', 'Yes'),
('Furosemide', 'Loop diuretic', '2026-01-31', 'Furosemide 40mg', 'Treating edema and hypertension', 'Dehydration, Hypotension', 'Edema, Hypertension', 'Yes'),
('Digoxin', 'Cardiac glycoside', '2026-12-31', 'Digoxin 0.25mg', 'Improving heart function', 'Nausea, Visual disturbances', 'Heart failure', 'Yes');

INSERT INTO prescription (presc_type, startdate, expirationdate, comments, eligibility, dosage, doctorid, amka, visitid, is_renewable) VALUES
('Hand-written', '2024-06-01', '2024-06-10', 'Take after meals', 'No', 30, 3, 20010000113, 3, 'No'),
('Online', '2024-06-02', '2024-06-12', 'Complete the full course', 'Yes', 20, 2, 15128500112, 5, 'Yes'),
('Hand-written', '2024-06-23', '2024-07-23', 'Take with food', 'No', 2, 5, 25037800125, 8, 'No'),
('Online', '2024-06-24', '2024-07-24', 'Take as needed for pain relief', 'Yes', 3, 8, 05010100128, 11, 'No'),
('Online', '2024-06-25', '2024-07-25', 'Take after meals', 'Yes', 1, 9, 12059300129, 12, 'Yes');

INSERT INTO renewable (prescriptionid, renewabletimes) VALUES
(2, 2),
(5, 3);

INSERT INTO includes (medicineid, prescriptionid) VALUES
(1, 1),
(3, 1),
(5, 1),
(7, 2),
(2, 2),
(4, 3),
(9, 3),
(10, 4),
(6, 4),
(11, 5),
(8, 5);

INSERT INTO supervise (startdate, enddate, comments, amka, doctorid) VALUES
('2024-06-01', '2024-08-01', 'Under observation for recovery', 01069000111, 1),
('2024-06-14', '2024-07-28', 'Under observation for recovery', 15128500112, 2),
('2023-04-03', '2023-12-10', 'Under observation for recovery', 01069000111, 3),
('2022-12-30', '2022-07-24', 'Under observation for recovery', 01069000111, 4),
('2024-06-10', '2024-06-15', 'Monitor closely for any adverse reactions', 20010000113, 5),
('2024-06-11', '2024-06-16', 'Follow up on medication compliance', 10098200124, 6),
('2024-06-12', '2024-06-17', 'Check for improvement in symptoms', 15119500126, 7),
('2024-06-13', '2024-06-18', 'Provide support and guidance', 20078900127, 8),
('2024-06-14', '2024-06-19', 'Ensure patient understands treatment plan', 05010100128, 10),
('2024-06-15', '2024-06-20', 'Monitor vital signs regularly', 12059300129, 9),
('2024-06-16', '2024-06-21', 'Review test results and adjust treatment if necessary', 30088000130, 11),
('2024-06-17', '2024-06-22', 'Educate patient on lifestyle modifications', 18047500131, 12),
('2024-06-18', '2024-06-23', 'Coordinate care with other healthcare providers', 08129800132, 13),
('2024-06-19', '2024-06-24', 'Address any concerns or questions', 03108700133, 1);

INSERT INTO workson (doctorid, hospitalclinicid) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 7),
(9, 6),
(10, 5),
(11, 4),
(12, 3),
(13, 6);

INSERT INTO hospitalized (entrydate, exitdate, amka, hospitalclinicid) VALUES
('2024-06-10', '2024-06-15', 25037800125, 1),
('2024-06-11', '2024-06-16', 20078900127, 2),
('2024-06-12', '2024-06-17', 20010000113, 3),
('2024-06-13', '2024-06-18', 12059300129, 4),
('2024-07-14', '2024-07-19', 20078900127, 5);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
