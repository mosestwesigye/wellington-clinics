-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2019 at 09:15 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wellingtonclinics_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `care_adviser`
--

CREATE TABLE `care_adviser` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `reference` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `care_adviser`
--

INSERT INTO `care_adviser` (`id`, `name`, `phone_number`, `reference`) VALUES
(1, 'Geoffrey', '0787168669', '');

-- --------------------------------------------------------

--
-- Table structure for table `care_structure`
--

CREATE TABLE `care_structure` (
  `id` int(11) NOT NULL,
  `covered_services` varchar(60) NOT NULL,
  `time` varchar(11) NOT NULL,
  `diabetes` tinyint(1) NOT NULL,
  `hypertension` tinyint(1) NOT NULL,
  `thyroid` tinyint(1) NOT NULL,
  `create_Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `care_structure`
--

INSERT INTO `care_structure` (`id`, `covered_services`, `time`, `diabetes`, `hypertension`, `thyroid`, `create_Date`) VALUES
(1, 'All listed Drugs', ' Monthly', 1, 1, 1, '0000-00-00 00:00:00'),
(2, 'Doctor consultation', ' Monthly', 1, 1, 1, '0000-00-00 00:00:00'),
(3, 'Nutritionist', ' Monthly', 1, 1, 1, '0000-00-00 00:00:00'),
(4, 'Physiotherapist', ' Monthly', 1, 1, 0, '0000-00-00 00:00:00'),
(5, 'Nursing Care', ' Monthly', 1, 1, 0, '0000-00-00 00:00:00'),
(6, 'Lab Services', ' Monthly', 1, 1, 0, '0000-00-00 00:00:00'),
(7, 'Weight/ BMI', ' Monthly', 1, 1, 0, '0000-00-00 00:00:00'),
(8, 'Potassium', ' Twice', 1, 1, 0, '0000-00-00 00:00:00'),
(9, 'Sodium', ' Twice', 1, 1, 0, '0000-00-00 00:00:00'),
(10, 'Chloride', ' Twice', 1, 1, 0, '0000-00-00 00:00:00'),
(11, 'Calcium', ' Twice', 1, 1, 0, '0000-00-00 00:00:00'),
(12, 'Cholesterol', ' Twice', 1, 1, 0, '0000-00-00 00:00:00'),
(13, 'Eye Exam', ' Once', 1, 1, 0, '0000-00-00 00:00:00'),
(14, 'Myoglobulin', ' Once', 1, 1, 0, '0000-00-00 00:00:00'),
(15, 'HBA1C', ' Quarterly', 1, 0, 0, '0000-00-00 00:00:00'),
(16, 'Glucometer', ' Once', 1, 0, 0, '0000-00-00 00:00:00'),
(17, 'Urinalysis', ' Thrice', 1, 0, 0, '0000-00-00 00:00:00'),
(18, 'Blood PH', ' Twice', 1, 0, 0, '0000-00-00 00:00:00'),
(19, 'Phosphorous', ' Twice', 1, 0, 0, '0000-00-00 00:00:00'),
(20, 'Uric acid', ' Twice', 1, 0, 0, '0000-00-00 00:00:00'),
(21, 'Urea', ' Twice', 1, 0, 0, '0000-00-00 00:00:00'),
(22, 'Creatinine', ' Twice', 1, 0, 0, '0000-00-00 00:00:00'),
(23, 'Nerve Exam', ' Once', 1, 0, 0, '0000-00-00 00:00:00'),
(24, 'Foot exam', ' Once', 1, 0, 0, '0000-00-00 00:00:00'),
(25, 'Microalbinuria', ' Twice', 1, 0, 0, '0000-00-00 00:00:00'),
(26, '100 Glucose Test strips', ' Once', 1, 0, 0, '0000-00-00 00:00:00'),
(27, 'ECG', ' Once', 0, 1, 0, '0000-00-00 00:00:00'),
(28, 'Cardiac Echo', ' Once', 0, 1, 0, '0000-00-00 00:00:00'),
(29, 'Troponin', ' Once', 0, 1, 0, '0000-00-00 00:00:00'),
(30, 'CKMB', ' Once', 0, 1, 0, '0000-00-00 00:00:00'),
(31, 'D-Dimers', ' Once', 0, 1, 0, '0000-00-00 00:00:00'),
(32, 'TSH', ' Quarterly', 0, 0, 1, '0000-00-00 00:00:00'),
(33, 'T3', ' Quarterly', 0, 0, 1, '0000-00-00 00:00:00'),
(34, 'T4', ' Quarterly', 0, 0, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL,
  `plan_option` varchar(30) NOT NULL,
  `medication` varchar(60) NOT NULL,
  `units` varchar(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `plan_option`, `medication`, `units`, `date`) VALUES
(1, 'diabetes', 'Mixtard insulin', '10ml', '2019-05-21 09:57:17'),
(2, 'diabetes', 'Metformin', '850mg', '2019-05-21 09:57:17'),
(3, 'diabetes', 'Glibenclamide', '5mg', '2019-05-21 09:57:17'),
(4, 'diabetes', 'Diolin', '5/500gm', '2019-05-21 09:57:17'),
(5, 'diabetes', 'Glucophage', '500gm/5', '2019-05-21 09:57:17'),
(6, 'diabetes', 'Glimepiride', '', '2019-05-21 09:57:17'),
(7, 'diabetes', 'Saxtagliptin', '', '2019-05-21 09:57:17'),
(8, 'diabetes', 'Pioglitazone', '30mg', '2019-05-21 09:57:17'),
(9, 'hypertension', 'Nifedipine', '2gm', '2019-05-21 09:57:17'),
(10, 'hypertension', 'Amlodipine', '5mg', '2019-05-21 09:57:17'),
(11, 'hypertension', 'Atenolol', '50gm', '2019-05-21 09:57:17'),
(12, 'hypertension', 'Losartan', '50gm', '2019-05-21 09:57:17'),
(13, 'hypertension', 'Carvedilol', '25mg', '2019-05-21 09:57:17'),
(14, 'hypertension', 'Lasix', '40mg', '2019-05-21 09:57:17'),
(15, 'hypertension', 'Aprinox', '10mg', '2019-05-21 09:57:17'),
(16, 'hypertension', 'Losartan combinations', '50/12mg', '2019-05-21 09:57:17'),
(17, 'hypertension', 'Cardiac aspirin', '75mg', '2019-05-21 09:57:17'),
(18, 'hypertension', 'Artovastatin', '20mg', '2019-05-21 09:57:17'),
(19, 'hypertension', 'Simvastatin', '10mg', '2019-05-21 09:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `home_care_visit`
--

CREATE TABLE `home_care_visit` (
  `id` int(11) NOT NULL,
  `visit_number` varchar(36) NOT NULL,
  `reference` varchar(11) NOT NULL,
  `time` varchar(60) NOT NULL,
  `subscription` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_care_visit`
--

INSERT INTO `home_care_visit` (`id`, `visit_number`, `reference`, `time`, `subscription`, `description`) VALUES
(1, '12 Visits', '110', 'Monthly', 800000, 'Desc'),
(2, '6 Visits', '111', 'Every 2 Months', 400000, ''),
(3, '4 Visits', '112', 'Quarterly', 300000, '');

--
-- Triggers `home_care_visit`
--
DELIMITER $$
CREATE TRIGGER `reference_auto_add` BEFORE INSERT ON `home_care_visit` FOR EACH ROW SET new.reference=FLOOR(RAND(9)*(30-20+1))+112
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `home_visit`
--

CREATE TABLE `home_visit` (
  `id` int(11) NOT NULL,
  `visits` varchar(36) NOT NULL,
  `time` varchar(60) NOT NULL,
  `subscription` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_visit`
--

INSERT INTO `home_visit` (`id`, `visits`, `time`, `subscription`) VALUES
(1, 'Bla', 'Bla bla', '300000');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `plan` enum('A+B+C+D','A+B+D','A+B+C','C+D','A','B','C','D') NOT NULL,
  `plan_name` varchar(11) NOT NULL,
  `plan_description` enum('Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C), Thyroid disease (D)','Diabetes Type1 (A) or Type 2 (B), Thyroid disease (D)','Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C)','Hypertension (Cardiac) (C), Thyroid disease (D)','Diabetes Type1 (A)','Diabetes Type1 Type 2 (B)','Hypertension (Cardiac) (C)','Thyroid disease (D)') NOT NULL,
  `time_period` enum('YEARLY','BI','QUARTERLY','MONTHLY') NOT NULL,
  `amount` int(11) NOT NULL,
  `saves_you` varchar(10) DEFAULT NULL,
  `lock-amount` tinyint(1) NOT NULL,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `reference`, `plan`, `plan_name`, `plan_description`, `time_period`, `amount`, `saves_you`, `lock-amount`, `create_date`) VALUES
(1, '1ef03a9e-7bac-11e9-8f9e-2a86e4085a59', 'A+B+C+D', 'Premium', 'Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C), Thyroid disease (D)', 'YEARLY', 2698500, NULL, 0, '2019-05-21 09:28:53'),
(2, '1ef02w3e-7bac-11e9-8f9e-2a86e4085a59', 'A+B+D', 'Executive', 'Diabetes Type1 (A) or Type 2 (B), Thyroid disease (D)', 'YEARLY', 2501500, NULL, 0, '2019-05-21 09:28:53'),
(3, '1ef0408e-7bac-11e9-8f9e-2a86e4085a59', 'A+B+C', 'Classic', 'Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C)', 'YEARLY', 2410500, NULL, 0, '2019-05-21 09:30:31'),
(4, '1ef041ce-7bac-11e9-8f9e-2a86e4085a59', 'C+D', 'Standard', 'Hypertension (Cardiac) (C), Thyroid disease (D)', 'YEARLY', 2278700, NULL, 0, '2019-05-21 09:30:31'),
(5, 'c65e38ce-2c99-4ff5-b6c4-7ee878e84eed', 'A', 'Enhanced', 'Diabetes Type1 (A)', 'YEARLY', 2213500, NULL, 0, '2019-05-21 09:33:15'),
(6, 'cd2b46d0-6b2d-421a-9f24-4910a3ca82d7', 'B', '*', 'Diabetes Type1 Type 2 (B)', 'YEARLY', 2213500, NULL, 0, '2019-05-21 09:33:15'),
(7, 'ed094itu84-6b2d-421a-9f24-4910a3ca82d7', 'C', '*', 'Hypertension (Cardiac) (C)', 'YEARLY', 1990700, NULL, 0, '2019-05-21 09:36:31'),
(8, '318ccca3-bb97-43a7-ba8a-2a14c9af0400', 'D', '*', 'Thyroid disease (D)', 'YEARLY', 1594400, NULL, 0, '2019-05-21 09:36:31'),
(10, 'eed6cb8f-7f16-11e9-82e9-d4bed92bf394', 'A+B+C+D', '*', 'Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C), Thyroid disease (D)', 'BI', 1484175, NULL, 0, '2019-05-25 20:59:24'),
(11, '4bfbb418-7f17-11e9-82e9-d4bed92bf394', 'A+B+D', '*', 'Diabetes Type1 (A) or Type 2 (B), Thyroid disease (D)', 'BI', 1375825, NULL, 0, '2019-05-25 21:02:01'),
(12, '8abfd4b1-7f17-11e9-82e9-d4bed92bf394', 'A+B+C', '*', 'Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C)', 'BI', 1325775, NULL, 0, '2019-05-25 21:03:46'),
(13, 'ffd79484-7f18-11e9-82e9-d4bed92bf394', 'C+D', '*', 'Hypertension (Cardiac) (C), Thyroid disease (D)', 'BI', 1253285, NULL, 0, '2019-05-25 21:14:12'),
(14, '1df3eb9e-7f19-11e9-82e9-d4bed92bf394', 'A', '*', 'Diabetes Type1 (A)', 'BI', 1217425, NULL, 0, '2019-05-25 21:15:02'),
(15, '42236ea8-7f19-11e9-82e9-d4bed92bf394', 'B', '*', 'Diabetes Type1 Type 2 (B)', 'BI', 1217425, NULL, 0, '2019-05-25 21:16:03'),
(16, '4f45be2e-7f1a-11e9-82e9-d4bed92bf394', 'C', '*', 'Hypertension (Cardiac) (C)', 'BI', 1094885, NULL, 0, '2019-05-25 21:23:35'),
(17, '4f46f8d3-7f1a-11e9-82e9-d4bed92bf394', 'D', '*', 'Thyroid disease (D)', 'BI', 876920, NULL, 0, '2019-05-25 21:23:35'),
(18, 'ff446b1a-7f1b-11e9-82e9-d4bed92bf394', 'A+B+C+D', '*', 'Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C), Thyroid disease (D)', 'QUARTERLY', 775819, NULL, 0, '2019-05-25 21:35:39'),
(19, 'ff46b529-7f1b-11e9-82e9-d4bed92bf394', 'A+B+D', '*', 'Diabetes Type1 (A) or Type 2 (B), Thyroid disease (D)', 'QUARTERLY', 719181, NULL, 0, '2019-05-25 21:35:39'),
(20, 'ff46b6f4-7f1b-11e9-82e9-d4bed92bf394', 'A+B+C', '*', 'Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C)', 'QUARTERLY', 693019, NULL, 0, '2019-05-25 21:35:39'),
(21, 'ff46b82b-7f1b-11e9-82e9-d4bed92bf394', 'C+D', '*', 'Hypertension (Cardiac) (C), Thyroid disease (D)', 'QUARTERLY', 655126, NULL, 0, '2019-05-25 21:35:39'),
(22, 'ff46b98f-7f1b-11e9-82e9-d4bed92bf394', 'A', '*', 'Diabetes Type1 (A)', 'QUARTERLY', 636381, NULL, 0, '2019-05-25 21:35:39'),
(23, '3840e99c-7f1c-11e9-82e9-d4bed92bf394', 'B', '*', 'Diabetes Type1 Type 2 (B)', 'QUARTERLY', 636381, NULL, 0, '2019-05-25 21:37:15'),
(24, '38435580-7f1c-11e9-82e9-d4bed92bf394', 'C', '*', 'Hypertension (Cardiac) (C)', 'QUARTERLY', 572326, NULL, 0, '2019-05-25 21:37:15'),
(25, '4a1b68b1-7f1c-11e9-82e9-d4bed92bf394', 'D', '*', 'Thyroid disease (D)', 'QUARTERLY', 458390, NULL, 0, '2019-05-25 21:37:45'),
(26, '39b82af1-7f1e-11e9-82e9-d4bed92bf394', 'A+B+C+D', '*', 'Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C), Thyroid disease (D)', 'MONTHLY', 269850, NULL, 0, '2019-05-25 21:51:37'),
(27, '39b96f76-7f1e-11e9-82e9-d4bed92bf394', 'A+B+D', '*', 'Diabetes Type1 (A) or Type 2 (B), Thyroid disease (D)', 'MONTHLY', 250150, NULL, 0, '2019-05-25 21:51:37'),
(28, '39b9705a-7f1e-11e9-82e9-d4bed92bf394', 'A+B+C', '*', 'Diabetes Type1 (A) or Type 2 (B),Hypertension (Cardiac) (C)', 'MONTHLY', 241050, NULL, 0, '2019-05-25 21:51:37'),
(29, '39b970ff-7f1e-11e9-82e9-d4bed92bf394', 'C+D', '*', 'Hypertension (Cardiac) (C), Thyroid disease (D)', 'MONTHLY', 227870, NULL, 0, '2019-05-25 21:51:37'),
(30, '39b971c5-7f1e-11e9-82e9-d4bed92bf394', 'A', '*', 'Diabetes Type1 (A)', 'MONTHLY', 221350, NULL, 0, '2019-05-25 21:51:37'),
(31, '39b97266-7f1e-11e9-82e9-d4bed92bf394', 'B', '*', 'Diabetes Type1 Type 2 (B)', 'MONTHLY', 221350, NULL, 0, '2019-05-25 21:51:37'),
(32, '39b9733e-7f1e-11e9-82e9-d4bed92bf394', 'C', '*', 'Hypertension (Cardiac) (C)', 'MONTHLY', 199070, NULL, 0, '2019-05-25 21:51:37'),
(33, '39b973f9-7f1e-11e9-82e9-d4bed92bf394', 'D', '*', 'Thyroid disease (D)', 'MONTHLY', 159440, NULL, 0, '2019-05-25 21:51:37'),
(34, 'af801d52-7f1e-11e9-82e9-d4bed92bf394', 'D', 'TEST', 'Thyroid disease (D)', 'MONTHLY', 500, NULL, 0, '2019-05-25 21:54:54');

--
-- Triggers `plan`
--
DELIMITER $$
CREATE TRIGGER `default_reference` BEFORE INSERT ON `plan` FOR EACH ROW SET new.reference = uuid()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `care_adviser`
--
ALTER TABLE `care_adviser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `care_structure`
--
ALTER TABLE `care_structure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_care_visit`
--
ALTER TABLE `home_care_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_visit`
--
ALTER TABLE `home_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `care_adviser`
--
ALTER TABLE `care_adviser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `care_structure`
--
ALTER TABLE `care_structure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `home_care_visit`
--
ALTER TABLE `home_care_visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `home_visit`
--
ALTER TABLE `home_visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
