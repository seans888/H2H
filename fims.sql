-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2017 at 04:43 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fims`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `id` int(11) NOT NULL,
  `checklist_equipment` varchar(45) DEFAULT NULL,
  `checklist_quantity_on_hand` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_lastname` varchar(45) DEFAULT NULL,
  `employee_firstname` varchar(45) DEFAULT NULL,
  `employee_number` int(11) DEFAULT NULL,
  `employee_email` varchar(45) DEFAULT NULL,
  `employee_occupation` varchar(45) DEFAULT NULL,
  `employee_user_type` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_has_facility`
--

CREATE TABLE `employee_has_facility` (
  `employee_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_has_schedule`
--

CREATE TABLE `employee_has_schedule` (
  `employee_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `id` int(11) NOT NULL,
  `facility_type` varchar(45) DEFAULT NULL,
  `facility_status` varchar(45) DEFAULT NULL,
  `facility_qrcode` varchar(45) DEFAULT NULL,
  `checklist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `schudule_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_has_facility`
--

CREATE TABLE `schedule_has_facility` (
  `schedule_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `facility_checklist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_has_facility`
--
ALTER TABLE `employee_has_facility`
  ADD PRIMARY KEY (`employee_id`,`facility_id`),
  ADD KEY `fk_employee_has_facility_facility1_idx` (`facility_id`),
  ADD KEY `fk_employee_has_facility_employee_idx` (`employee_id`);

--
-- Indexes for table `employee_has_schedule`
--
ALTER TABLE `employee_has_schedule`
  ADD PRIMARY KEY (`employee_id`,`schedule_id`),
  ADD KEY `fk_employee_has_schedule_schedule1_idx` (`schedule_id`),
  ADD KEY `fk_employee_has_schedule_employee1_idx` (`employee_id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`id`,`checklist_id`),
  ADD KEY `fk_facility_checklist1_idx` (`checklist_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_has_facility`
--
ALTER TABLE `schedule_has_facility`
  ADD PRIMARY KEY (`schedule_id`,`facility_id`,`facility_checklist_id`),
  ADD KEY `fk_schedule_has_facility_facility1_idx` (`facility_id`,`facility_checklist_id`),
  ADD KEY `fk_schedule_has_facility_schedule1_idx` (`schedule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_has_facility`
--
ALTER TABLE `employee_has_facility`
  ADD CONSTRAINT `fk_employee_has_facility_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee_has_facility_facility1` FOREIGN KEY (`facility_id`) REFERENCES `facility` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_has_schedule`
--
ALTER TABLE `employee_has_schedule`
  ADD CONSTRAINT `fk_employee_has_schedule_employee1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee_has_schedule_schedule1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `facility`
--
ALTER TABLE `facility`
  ADD CONSTRAINT `fk_facility_checklist1` FOREIGN KEY (`checklist_id`) REFERENCES `checklist` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `schedule_has_facility`
--
ALTER TABLE `schedule_has_facility`
  ADD CONSTRAINT `fk_schedule_has_facility_facility1` FOREIGN KEY (`facility_id`,`facility_checklist_id`) REFERENCES `facility` (`id`, `checklist_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_schedule_has_facility_schedule1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
