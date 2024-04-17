-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 02:20 PM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u423960254_dbcsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_feeback`
--

CREATE TABLE `customer_feeback` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `ratings` varchar(20) DEFAULT NULL,
  `message` varchar(220) DEFAULT NULL,
  `date_entry` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `customer_feeback`
--

INSERT INTO `customer_feeback` (`id`, `customer_name`, `ratings`, `message`, `date_entry`) VALUES
(28, 'client1', '☆☆☆☆☆', 'Good', '2024-03-22 05:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `donated_by` varchar(100) DEFAULT NULL,
  `acc_num` int(15) DEFAULT NULL,
  `acc_name` varchar(20) DEFAULT NULL,
  `reference_num` varchar(25) DEFAULT NULL,
  `amount_value` varchar(20) DEFAULT NULL,
  `date_of_donation` date NOT NULL,
  `date_entry` timestamp NULL DEFAULT current_timestamp(),
  `receipt` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`id`, `user_id`, `donated_by`, `acc_num`, `acc_name`, `reference_num`, `amount_value`, `date_of_donation`, `date_entry`, `receipt`) VALUES
(5, '148', 'koline', 2147483647, 'koline', '123456789123456', '200', '2024-04-25', '2024-04-07 15:06:55', 'JRU_PPT_BCKGRND_2022.jpg'),
(6, '148', 'Norms', 231312, 'John Rey ', 'TF3241421', '300', '2024-04-13', '2024-04-13 07:01:55', 'receipt.png'),
(7, '157', 'Normanaaa', 231312, 'iwqeq', 'TF342525', '500', '2024-04-13', '2024-04-13 07:53:25', 'receipt.png');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message_id` varchar(15) DEFAULT NULL,
  `from_message` varchar(50) DEFAULT NULL,
  `to_message` varchar(50) DEFAULT NULL,
  `message` varchar(220) DEFAULT NULL,
  `date_update` datetime DEFAULT current_timestamp(),
  `date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `message_id`, `from_message`, `to_message`, `message`, `date_update`, `date`) VALUES
(1, NULL, 'client1', 'admin1', 'Hello admin1, paano po maka kuha ng documents dito?', '2024-04-06 04:59:57', '2024-04-06 04:59:57'),
(2, NULL, 'admin1', 'client1', 'Hello! Just request in the request tab, and request your docs. ', '2024-04-06 05:12:01', '2024-04-06 05:12:01'),
(3, NULL, 'rex1', '12345', 'Good day! Sa April 1 po ang date ng baptisml niyo, Thank You!', '2024-04-06 05:29:17', '2024-04-06 05:29:17'),
(4, NULL, 'rex1', 'client1', 'Good day! Sa April 1 po ang date ng baptisml niyo, Thank You!', '2024-04-06 05:30:17', '2024-04-06 05:30:17'),
(5, NULL, 'client1', 'rex1', 'Okay! This is noted, thanks!', '2024-04-06 05:30:40', '2024-04-06 05:30:40'),
(6, NULL, 'client1', 'admin1', 'fsfssfs', '2024-04-11 08:37:07', '2024-04-11 08:37:07'),
(7, NULL, 'admin1', 'client1', 'fsafa', '2024-04-11 08:37:32', '2024-04-11 08:37:32'),
(8, NULL, 'admin1', 'client1', 'gsga', '2024-04-11 08:39:57', '2024-04-11 08:39:57'),
(9, NULL, 'admin1', 'client1', 'hello\r\n', '2024-04-13 07:02:40', '2024-04-13 07:02:40'),
(10, NULL, 'client1', 'admin1', 'hello!!!', '2024-04-13 07:03:02', '2024-04-13 07:03:02'),
(11, NULL, 'chuck02', 'admin1', 'chuck sss', '2024-04-13 07:45:22', '2024-04-13 07:45:22'),
(12, NULL, 'admin1', 'chuck02', 'hellooooo there', '2024-04-13 07:46:13', '2024-04-13 07:46:13'),
(13, NULL, 'client1', 'rex1', 'father', '2024-04-16 09:48:16', '2024-04-16 09:48:16'),
(14, NULL, 'client1', 'admin1', 'helo!!!!!\r\n', '2024-04-16 13:48:24', '2024-04-16 13:48:24'),
(15, NULL, 'admin1', 'client1', 'reply!!', '2024-04-16 13:50:20', '2024-04-16 13:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `request_form_id` varchar(15) DEFAULT NULL,
  `event_type` varchar(20) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `mode_of_payment` varchar(50) DEFAULT NULL,
  `date_of_payment` date DEFAULT NULL,
  `payors_name` varchar(100) DEFAULT NULL,
  `date_entry` timestamp NULL DEFAULT current_timestamp(),
  `delete_date` datetime DEFAULT NULL,
  `original_doc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `request_form_id`, `event_type`, `price`, `mode_of_payment`, `date_of_payment`, `payors_name`, `date_entry`, `delete_date`, `original_doc`) VALUES
(1, NULL, NULL, 'Baptismal', '1000', 'For Payment', '2024-04-06', 'Norms Alain', '2024-04-06 05:25:01', NULL, 'receipt.png'),
(2, NULL, '1', 'Baptismal', '1000', '', '2024-04-06', 'Norms Alain', '2024-04-06 05:26:12', NULL, NULL),
(3, NULL, '1', 'Baptismal', '1000', '', '2024-04-06', 'Norms Alain', '2024-04-06 05:26:14', NULL, NULL),
(4, NULL, '1', 'Baptismal', '1000', '', '2024-04-06', 'Norms Alain', '2024-04-06 05:26:15', NULL, NULL),
(5, NULL, NULL, 'wedding', '1500', 'For Payment', '2024-04-06', 'Norms Alain', '2024-04-06 06:09:19', NULL, 'receipt.png'),
(6, NULL, '2', 'wedding', '1500', '', '2024-04-06', 'Norms Alain', '2024-04-06 06:09:34', NULL, NULL),
(7, NULL, NULL, 'Funeral', '150', 'For Payment', '2024-04-06', 'sample', '2024-04-06 06:14:34', NULL, 'receipt.png'),
(8, NULL, NULL, 'Donation', '200', 'G-Cash', '2024-04-25', 'koline', '2024-04-07 15:06:55', NULL, 'JRU_PPT_BCKGRND_2022.jpg'),
(9, NULL, NULL, 'Funeral', '150', 'For Payment', '2024-04-07', 'dsadasd', '2024-04-07 15:10:53', NULL, 'd.png'),
(10, NULL, '7', 'Funeral', '150', '', '2024-04-07', 'dsadasd', '2024-04-07 15:11:28', NULL, NULL),
(11, NULL, '7', 'Funeral', '150', '', '2024-04-07', 'dsadasd', '2024-04-07 15:11:32', NULL, NULL),
(12, NULL, NULL, 'Funeral', '150', 'For Payment', '2024-04-07', 'dsadasd', '2024-04-07 15:16:27', NULL, 'd.png'),
(13, NULL, '13', 'Funeral', '150', '', '2024-04-07', 'dsadasd', '2024-04-07 15:17:34', NULL, NULL),
(14, NULL, NULL, 'Funeral', '150', 'For Payment', '2024-04-07', 'dsadasd', '2024-04-07 15:19:01', NULL, 'd.png'),
(15, NULL, '12', 'Funeral', '150', '', '2024-04-07', 'dsadasd', '2024-04-07 15:20:32', NULL, NULL),
(16, NULL, '12', 'Funeral', '150', '', '2024-04-07', 'dsadasd', '2024-04-07 15:20:33', NULL, NULL),
(17, NULL, NULL, 'mass', '1000', 'For Payment', '2024-04-11', 'Rommel', '2024-04-11 09:18:16', NULL, 'receipt.png'),
(18, NULL, '16', 'mass', '1000', '', '2024-04-11', 'Rommel', '2024-04-11 09:30:01', NULL, NULL),
(19, NULL, NULL, 'Baptismal', '1000', 'For Payment', '2024-04-11', 'sample', '2024-04-11 12:42:45', NULL, 'Screenshot (1).png'),
(20, NULL, '19', 'Baptismal', '1000', '', '2024-04-11', 'sample', '2024-04-11 12:43:07', NULL, NULL),
(21, NULL, NULL, 'Blessing', '1000', 'For Payment', '2024-04-12', 'Darwin Puzo', '2024-04-12 06:09:50', NULL, 'gcash.png'),
(22, NULL, '20', 'Blessing', '1000', '', '2024-04-12', 'Darwin Puzo', '2024-04-12 06:11:22', NULL, NULL),
(23, NULL, '20', 'Blessing', '1000', '', '2024-04-12', 'Darwin Puzo', '2024-04-12 06:11:25', NULL, NULL),
(24, NULL, NULL, 'Baptismal', '', 'For Payment', '2024-04-13', 'John Rey Jarapan', '2024-04-13 06:40:43', NULL, 'receipt.png'),
(25, NULL, '24', 'Baptismal', '', '', '2024-04-13', 'John Rey Jarapan', '2024-04-13 06:47:42', NULL, NULL),
(26, NULL, '24', 'Baptismal', '', '', '2024-04-13', 'John Rey Jarapan', '2024-04-13 06:47:44', NULL, NULL),
(27, NULL, NULL, 'Donation', '300', 'G-Cash', '2024-04-13', 'Norms', '2024-04-13 07:01:55', NULL, 'receipt.png'),
(28, NULL, NULL, 'Baptismal', '', 'For Payment', '2024-04-13', 'Rolando Cruz', '2024-04-13 07:36:36', NULL, 'receipt.png'),
(29, NULL, '25', 'Baptismal', '', '', '2024-04-13', 'Rolando Cruz', '2024-04-13 07:37:50', NULL, NULL),
(30, NULL, '25', 'Baptismal', '', '', '2024-04-13', 'Rolando Cruz', '2024-04-13 07:37:52', NULL, NULL),
(31, NULL, NULL, 'Donation', '500', 'G-Cash', '2024-04-13', 'Normanaaa', '2024-04-13 07:53:25', NULL, 'receipt.png'),
(32, NULL, NULL, 'mass', '', 'For Payment', '2024-04-16', 'norms', '2024-04-16 13:23:08', NULL, 'receipt.png'),
(33, NULL, NULL, NULL, NULL, NULL, '2024-04-16', NULL, '2024-04-16 13:23:47', NULL, NULL),
(34, NULL, '30', 'mass', '', '', '2024-04-16', 'norms', '2024-04-16 13:24:16', NULL, NULL),
(35, NULL, '30', 'mass', '', '', '2024-04-16', 'norms', '2024-04-16 13:24:18', NULL, NULL),
(36, NULL, NULL, 'Baptismal', '', 'For Payment', '2024-04-16', 'norman jake', '2024-04-16 13:38:46', NULL, 'my esign no bg.png'),
(37, NULL, '31', 'Baptismal', '', '', '2024-04-16', 'norman jake', '2024-04-16 13:39:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `requested_document`
--

CREATE TABLE `requested_document` (
  `id` int(11) NOT NULL,
  `document_owner` varchar(50) DEFAULT NULL,
  `document_type` varchar(50) DEFAULT NULL,
  `requested_by` varchar(50) DEFAULT NULL,
  `relation_to_owner` varchar(50) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL,
  `request_status` varchar(50) DEFAULT NULL,
  `date_request` timestamp NULL DEFAULT current_timestamp(),
  `mode_of_payment` varchar(20) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `event_id` varchar(10) DEFAULT NULL,
  `supporting_docs` varchar(50) DEFAULT NULL,
  `Message` varchar(225) DEFAULT NULL,
  `email_add` varchar(100) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `payment_attachment` varchar(100) DEFAULT NULL,
  `original_document` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `requested_document`
--

INSERT INTO `requested_document` (`id`, `document_owner`, `document_type`, `requested_by`, `relation_to_owner`, `purpose`, `request_status`, `date_request`, `mode_of_payment`, `amount`, `event_id`, `supporting_docs`, `Message`, `email_add`, `contact_no`, `payment_attachment`, `original_document`) VALUES
(1, 'Joan Yusores', 'Confirmation', 'Joan Yusores', 'Sister', '', 'For Received', '2024-04-09 12:54:50', NULL, NULL, NULL, '272857154_422017743051674_4627303561248562579_n.jp', NULL, 'sample@gmail.com', '9201325664', NULL, NULL),
(2, 'sample', 'Baptismal', 'sample', 'sample', 'sample', 'For Received', '2024-04-11 12:48:54', NULL, NULL, NULL, 'Screenshot (1).png', NULL, 'sample@gmail.com', '9201325664', NULL, NULL),
(3, 'John Rey Jarapan', 'Baptismal', 'John Jarapan', 'Father', 'sda', 'For Received', '2024-04-13 06:58:39', NULL, NULL, NULL, 'my esign no bg.png', NULL, 'jrj.files@gmail.com', '9602962768', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request_form`
--

CREATE TABLE `request_form` (
  `id` int(11) NOT NULL,
  `Event_type` varchar(50) DEFAULT NULL,
  `wedding_province` varchar(100) DEFAULT NULL,
  `wedding_municipality` varchar(100) DEFAULT NULL,
  `wedding_husband_name` varchar(50) DEFAULT NULL,
  `wedding_wife_name` varchar(20) DEFAULT NULL,
  `wedding_husband_dob` varchar(20) DEFAULT NULL,
  `wedding_wife_dob` varchar(100) DEFAULT NULL,
  `wedding_husband_pob` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `wedding_wife_pob` varchar(100) DEFAULT NULL,
  `wedding_husband_sex` varchar(20) DEFAULT NULL,
  `wedding_wife_sex` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `wedding_husband_citizenship` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `wedding_wife_citizenship` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `wedding_husband_residence` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci DEFAULT NULL,
  `wedding_wife_residence` varchar(100) DEFAULT NULL,
  `wedding_husband_religion` varchar(50) DEFAULT NULL,
  `wedding_wife_religion` varchar(50) DEFAULT NULL,
  `wedding_husband_civistatus` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `wedding_wife_civistatus` varchar(50) DEFAULT NULL,
  `wedding_husband_name_father` varchar(100) DEFAULT NULL,
  `wedding_wife_name_father` varchar(100) DEFAULT NULL,
  `wedding_husband_citizenship_parent` varchar(100) DEFAULT NULL,
  `wedding_wife_citizenship_parent` varchar(50) DEFAULT NULL,
  `wedding_husband_name_mother` varchar(50) DEFAULT NULL,
  `wedding_wife_name_mother` varchar(50) DEFAULT NULL,
  `wedding_wife_citizenship_parents` varchar(50) DEFAULT NULL,
  `wedding_husband_citizenship_parents` varchar(50) DEFAULT NULL,
  `peroson_gave_consent` varchar(50) DEFAULT NULL,
  `peroson_gave_consent_wife` varchar(50) DEFAULT NULL,
  `peroson_gave_consent_husband` varchar(50) DEFAULT NULL,
  `concent_relation_hus` varchar(50) DEFAULT NULL,
  `concent_relation_wife` varchar(50) DEFAULT NULL,
  `residence_wife_side` varchar(50) DEFAULT NULL,
  `residence_husband_side` varchar(50) DEFAULT NULL,
  `place_of_merriage` varchar(50) DEFAULT NULL,
  `datetime_merriage` varchar(20) DEFAULT NULL,
  `event_location` varchar(100) DEFAULT NULL,
  `funeral_deceased_name` varchar(220) DEFAULT NULL,
  `funeral_date_of_death` date DEFAULT NULL,
  `funeral_age` int(10) DEFAULT NULL,
  `start_datetime_event` datetime DEFAULT NULL,
  `end_datetime_event` datetime DEFAULT NULL,
  `bap_fullname` varchar(150) DEFAULT NULL,
  `bap_municipality` varchar(100) DEFAULT NULL,
  `bap_province` varchar(50) DEFAULT NULL,
  `bap_baptismDateTime` varchar(120) DEFAULT NULL,
  `bap_location` varchar(100) DEFAULT NULL,
  `bap_date_of_birth` varchar(50) DEFAULT NULL,
  `bap_placeOB` varchar(100) DEFAULT NULL,
  `bap_filiation` varchar(50) DEFAULT NULL,
  `bap_nationality` varchar(50) DEFAULT NULL,
  `bap_fatherName` varchar(50) DEFAULT NULL,
  `bap_father_place_birth` varchar(50) DEFAULT NULL,
  `bap_motherName` varchar(50) DEFAULT NULL,
  `bap_mother_place_birth` varchar(50) DEFAULT NULL,
  `bap_recidence` varchar(100) DEFAULT NULL,
  `bap_parent_signature` varchar(255) DEFAULT NULL,
  `bap_paternal_gp` varchar(220) DEFAULT NULL,
  `bap_maternal_gp` varchar(220) DEFAULT NULL,
  `bap_sponsors` varchar(220) DEFAULT NULL,
  `bap_civil_status` varchar(50) DEFAULT NULL,
  `bap_recidence2` varchar(100) DEFAULT NULL,
  `others_contact_no` varchar(20) DEFAULT NULL,
  `others_email` varchar(50) DEFAULT NULL,
  `others_reserve_by` varchar(100) DEFAULT NULL,
  `others_sched_type` varchar(30) DEFAULT NULL,
  `mass_type_of_mass` varchar(20) DEFAULT NULL,
  `mass_name_person` varchar(50) CHARACTER SET swe7 COLLATE swe7_swedish_ci DEFAULT NULL,
  `bap_oficiating_priest` varchar(50) DEFAULT NULL,
  `others_status` varchar(50) DEFAULT NULL,
  `number_of_guest` varchar(20) DEFAULT NULL,
  `sponsors2` varchar(90) DEFAULT NULL,
  `sponsors3` varchar(90) DEFAULT NULL,
  `sponsors4` varchar(90) DEFAULT NULL,
  `sponsors5` varchar(90) DEFAULT NULL,
  `sponsors6` varchar(90) DEFAULT NULL,
  `sponsors7` varchar(90) DEFAULT NULL,
  `sponsors8` varchar(90) DEFAULT NULL,
  `midlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `fatherFirstName` varchar(50) DEFAULT NULL,
  `fatherMiddleName` varchar(50) DEFAULT NULL,
  `fatherLastName` varchar(50) DEFAULT NULL,
  `motherFirstName` varchar(50) DEFAULT NULL,
  `motherMiddleName` varchar(50) DEFAULT NULL,
  `motherLastName` varchar(50) DEFAULT NULL,
  `residence_father` varchar(70) DEFAULT NULL,
  `civil_status_father` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request_form`
--

INSERT INTO `request_form` (`id`, `Event_type`, `wedding_province`, `wedding_municipality`, `wedding_husband_name`, `wedding_wife_name`, `wedding_husband_dob`, `wedding_wife_dob`, `wedding_husband_pob`, `wedding_wife_pob`, `wedding_husband_sex`, `wedding_wife_sex`, `wedding_husband_citizenship`, `wedding_wife_citizenship`, `wedding_husband_residence`, `wedding_wife_residence`, `wedding_husband_religion`, `wedding_wife_religion`, `wedding_husband_civistatus`, `wedding_wife_civistatus`, `wedding_husband_name_father`, `wedding_wife_name_father`, `wedding_husband_citizenship_parent`, `wedding_wife_citizenship_parent`, `wedding_husband_name_mother`, `wedding_wife_name_mother`, `wedding_wife_citizenship_parents`, `wedding_husband_citizenship_parents`, `peroson_gave_consent`, `peroson_gave_consent_wife`, `peroson_gave_consent_husband`, `concent_relation_hus`, `concent_relation_wife`, `residence_wife_side`, `residence_husband_side`, `place_of_merriage`, `datetime_merriage`, `event_location`, `funeral_deceased_name`, `funeral_date_of_death`, `funeral_age`, `start_datetime_event`, `end_datetime_event`, `bap_fullname`, `bap_municipality`, `bap_province`, `bap_baptismDateTime`, `bap_location`, `bap_date_of_birth`, `bap_placeOB`, `bap_filiation`, `bap_nationality`, `bap_fatherName`, `bap_father_place_birth`, `bap_motherName`, `bap_mother_place_birth`, `bap_recidence`, `bap_parent_signature`, `bap_paternal_gp`, `bap_maternal_gp`, `bap_sponsors`, `bap_civil_status`, `bap_recidence2`, `others_contact_no`, `others_email`, `others_reserve_by`, `others_sched_type`, `mass_type_of_mass`, `mass_name_person`, `bap_oficiating_priest`, `others_status`, `number_of_guest`, `sponsors2`, `sponsors3`, `sponsors4`, `sponsors5`, `sponsors6`, `sponsors7`, `sponsors8`, `midlename`, `lastname`, `fatherFirstName`, `fatherMiddleName`, `fatherLastName`, `motherFirstName`, `motherMiddleName`, `motherLastName`, `residence_father`, `civil_status_father`) VALUES
(1, 'Baptismal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Zeke', 'Guagua', 'Pampanga', '2024-04-09 9:00 AM', '238 Natividad Brgy. Guagua, I.F.I.P. ', '2024-03-08', 'Guagua, Pampanga', NULL, 'Filipino', NULL, NULL, NULL, NULL, 'Pampanga', NULL, 'Jose Mendez', 'Marites Mendez', 'Brixter Luquing', 'married', 'Pampanga', '9602962768', 'normanjake.alain@gmail.com', 'Norms Alain', 'Regular', NULL, NULL, NULL, 'For Document Verification', NULL, 'Koline Caguimbal', 'Matt Andrade', 'Zai Recto', '', '', '', '', 'Cruz', 'Mendez', 'Max', 'Collins', 'Mendez', 'Jahya', 'Cruz', 'Mendez', 'Pampanga', 'married'),
(2, 'wedding', 'Guagua', 'Pampanga', 'sample', 'sample', '1999-03-06', '1999-06-16', 'sample', 'sample', 'Male', 'Female', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'Single', 'Single', 'sample', NULL, 'sample', 'sample', NULL, 'sample', 'sample', 'sample', 'sample', 'sample', NULL, 'sample', 'sample', 'sample', 'sample', 'Guagua Pampanga', '2024-07-06 7:00AM', NULL, NULL, NULL, NULL, '2024-07-06 07:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'normanjake.alain@gmail.com', 'Norms Alain', 'Regular', NULL, NULL, NULL, NULL, '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'wewwqeq', NULL, '2024-04-01', 60, '2024-08-10 07:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sampleee', NULL, '2024-04-01', 67, '2024-05-11 07:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dsadaf', NULL, '2024-04-02', 22, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dsadaf', NULL, '2024-04-02', 22, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pampanga', NULL, '2024-04-03', 23, '2024-05-11 01:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pampanga', NULL, '2024-03-19', 23, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pampanga', NULL, '2024-03-19', 23, '2024-05-11 10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pampanga', NULL, '2024-03-19', 23, '2024-05-11 10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pampanga', NULL, '2024-03-19', 23, '2024-05-11 10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pampanga', NULL, '2024-03-19', 23, '2024-05-11 10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Funeral', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pampanga', NULL, '2024-04-02', 23, '2024-05-11 11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Baptismal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'norms', 'Guagua', 'Pampanga', '2024-04-10 9:00 AM', '238 Natividad Brgy. Guagua, I.F.I.P. ', '2024-03-22', 'pampanga', NULL, 'filipino', NULL, NULL, NULL, NULL, 'sample', NULL, 'sample', 'sample', 'Juan Dela Cruz', 'married', '456 Oak Avenue, Another Town, USA', '9602962768', 'normanjake.alain16@gmail.com', 'Norman Alain', NULL, NULL, NULL, NULL, 'For Document Verification', NULL, 'Maria Santos', 'jake', 'simp', '', '', '', '', 'sab', 'alain', 'brix', 'ter', 'luqs', 'Jovita', 'Sabulao', 'Alain', 'Pampanga', 'married'),
(15, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mandaluyong', NULL, NULL, NULL, '2024-04-16 11:24:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Birthday', 'impact', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mandaluyong blk 40', NULL, NULL, NULL, '2024-04-15 04:53:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Birthday', 'Joarth Sabulao', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Blessing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Block 40 ', NULL, NULL, NULL, '2024-04-13 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12sdas', NULL, NULL, NULL, '2024-04-15 11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Anniversary', 'Norman Jake Sabulao Alain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Baptismal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sample', 'Guagua', 'Pampanga', '2024-05-14 6:00 AM', '238 Natividad Brgy. Guagua, I.F.I.P. ', '2024-02-20', 'sample', NULL, 'sample', NULL, NULL, NULL, NULL, 'sample', NULL, 'sample', 'sample', 'sample / sample', 'married', 'sample', '9201325664', 'marykoline.caguimbal@my.jru.edu', 'sample', 'Regular', NULL, NULL, NULL, 'For Document Verification', NULL, 'sample', 'sample', 'sample', 'sample', '', '', '', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'single'),
(20, 'Blessing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'block 40 addition hills mandaluyong city', NULL, NULL, NULL, '2024-06-07 11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Block 40 ', NULL, NULL, NULL, '2024-04-20 08:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Anniversary', 'kim babas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'block 40 brgy addition hills ', NULL, NULL, NULL, '2024-04-16 12:36:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Birthday', 'norwyne alain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Baptismal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Raymond', 'Guagua', 'Pampanga', '2024-05-20 7:00 AM', '238 Natividad Brgy. Guagua, I.F.I.P. ', '2024-04-01', 'Angono', NULL, 'Filipino', NULL, NULL, NULL, NULL, 'Angono', NULL, 'Juanita Hernndez', 'Mario Hernandez', 'Juan Dela Cruz', 'married', 'Angono', '9296319194', 'jrj.files@gmail.com', 'John Rey Jarapan', 'Regular', NULL, NULL, NULL, 'For Document Verification', NULL, 'Maria Santos', 'Jake Santos', 'Mayeh Dano', '', '', '', '', 'Joseph', 'Jarapan', 'John Rey', 'Hernandez', 'Jarapan', 'Ilay', 'Herbal', 'Jakosalem', 'Angono', 'married'),
(25, 'Baptismal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'chuck joshua', 'Guagua', 'Pampanga', '2024-04-14 2:00 PM', '238 Natividad Brgy. Guagua, I.F.I.P. ', '2024-04-05', ' Pasig City', NULL, 'Filipino', NULL, NULL, NULL, NULL, 'Kalawaan Pasig City', NULL, 'Gabriel Pahati', 'Nathalia Espana', 'rthshhszszaswz', 'married', 'Kalawaan Pasig City', '9150314884', 'chuckjoshuacruz2000@gmail.com', 'Rolando Cruz', 'Regular', NULL, NULL, NULL, 'For Document Verification', NULL, 'edxexdexexd', '', '', '', '', '', '', 'Pahati', 'Cruz', 'Rolando ', 'Cruz', 'Cruz', 'Lolita ', 'Pahati', 'Cruz', 'Kalawaan Pasig City', 'married'),
(26, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'blk 41 mandaluyong', NULL, NULL, NULL, '2024-04-18 08:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Living Person', 'jelay palans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'wewqeqw', NULL, NULL, NULL, '2024-04-20 07:27:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Birthday', 'weqwe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Calbayog Mandaluyong City', NULL, NULL, NULL, '2024-04-20 10:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Birthday', 'Rommel Revilloza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Hulo Mandaluyong City', NULL, NULL, NULL, '2024-04-25 11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Birthday', 'Kyandra Tamayo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Mass', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'samplee', NULL, NULL, NULL, '2024-04-18 09:12:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'For Living Person', 'samplee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Baptismal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'jake', 'Guagua', 'Pampanga', '2024-04-17 7:00 AM', '238 Natividad Brgy. Guagua, I.F.I.P. ', '2024-04-16', 'sample', NULL, 'sample', NULL, NULL, NULL, NULL, 'sample', NULL, 'sample', 'sample', 'samplesample', 'married', 'sample', '9602962768', 'sample@gmail.com', 'norman jake', 'Regular', NULL, NULL, NULL, 'For Document Verification', NULL, 'sample', 'sample', '', '', '', '', '', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'samplesample', 'sample', 'married');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(10) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `request_form_id` int(20) DEFAULT NULL,
  `title` varchar(225) NOT NULL,
  `event_type` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `confirm_by` varchar(50) DEFAULT NULL,
  `confirm_priest` varchar(50) DEFAULT NULL,
  `comment` varchar(220) DEFAULT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `reserve_by` varchar(100) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `reference_num` varchar(25) DEFAULT NULL,
  `account_num` int(20) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `amount` int(50) DEFAULT NULL,
  `amount_paid` varchar(20) DEFAULT NULL,
  `date_paid` varchar(20) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mass_type_of_mass` varchar(20) DEFAULT NULL,
  `cancel_delete` varchar(50) DEFAULT NULL,
  `payment_attachment` varchar(200) DEFAULT NULL,
  `requirements` varchar(80) DEFAULT NULL,
  `Confession` varchar(80) DEFAULT NULL,
  `sponsors` varchar(80) DEFAULT NULL,
  `Mlicense` varchar(80) DEFAULT NULL,
  `CCertificate` varchar(80) DEFAULT NULL,
  `Mbanns` varchar(80) DEFAULT NULL,
  `Bcertificate` varchar(80) DEFAULT NULL,
  `cenomar` varchar(80) DEFAULT NULL,
  `permit` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `user_id`, `request_form_id`, `title`, `event_type`, `Status`, `confirm_by`, `confirm_priest`, `comment`, `start_datetime`, `end_datetime`, `reserve_by`, `payment_type`, `reference_num`, `account_num`, `account_name`, `amount`, `amount_paid`, `date_paid`, `contact_no`, `email`, `mass_type_of_mass`, `cancel_delete`, `payment_attachment`, `requirements`, `Confession`, `sponsors`, `Mlicense`, `CCertificate`, `Mbanns`, `Bcertificate`, `cenomar`, `permit`) VALUES
(1, '148', 1, 'Baptismal', 'Baptismal', 'Confirm', NULL, 'rex1', NULL, '2024-04-09 09:00:00', '0000-00-00 00:00:00', 'Norms Alain', NULL, 'TF3241421', 2147483647, 'NORMAN ALAIN', 1000, '1000', '2024-04-06 05:25:01 ', '9602962768', 'normanjake.alain@gmail.com', NULL, NULL, 'receipt.png', 'Screenshot 2023-03-30 002744.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '148', 2, 'wedding', 'wedding', 'Confirm', NULL, 'rex1', NULL, '2024-07-06 07:00:00', '0000-00-00 00:00:00', 'Norms Alain', NULL, 'TF342525', 2147483647, 'Juan Dela Cruz', 1500, '1500', '2024-04-06 06:09:19 ', '9602962768', 'normanjake.alain@gmail.com', NULL, NULL, 'receipt.png', 'Screenshot 2023-03-30 002744.png', NULL, NULL, NULL, 'my esign.jpg', NULL, 'my esign no bg.png', 'esign ni papa.png', NULL),
(4, '148', 4, 'Funeral', 'Funeral', 'Cancel', NULL, 'rex1', '', '2024-05-11 07:00:00', '0000-00-00 00:00:00', 'sampleee', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9602962768', 'sampleee', NULL, '2024-04-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '148', 5, 'Funeral', 'Funeral', 'For Schedule', NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fasfa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9602962768', 'normanjake.alain@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '148', 6, 'Funeral', 'Funeral', 'For Schedule', NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'fasfa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9602962768', 'normanjake.alain@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '148', 7, 'Funeral', 'Funeral', 'Confirm', NULL, 'rex1', NULL, '2024-05-11 01:00:00', '0000-00-00 00:00:00', 'dsadasd', NULL, '21156456211658451238512', 2147483647, 'Janna Mae Parayno', 150, '150', '2024-04-07 03:10:53 ', '9201325664', 'jasminodonio54@yahoo.com', NULL, NULL, 'd.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '148', 8, 'Funeral', 'Funeral', 'For Schedule', NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Janna Mae Parayno', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9201325664', 'merilynalejandro9@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '148', 9, 'Funeral', 'Funeral', 'Cancel', NULL, 'rex1', NULL, '2024-05-11 10:00:00', '0000-00-00 00:00:00', 'dsadasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9201325664', 'vicentenieto365@gmail.com', NULL, '2024-04-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '148', 10, 'Funeral', 'Funeral', 'Cancel', NULL, 'rex1', NULL, '2024-05-11 10:00:00', '0000-00-00 00:00:00', 'dsadasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9201325664', 'saquilayanmargarett@gmail.com', NULL, '2024-04-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '148', 11, 'Funeral', 'Funeral', 'Cancel', NULL, 'rex1', NULL, '2024-05-11 10:00:00', '0000-00-00 00:00:00', 'dsadasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9201325664', 'saquilayanmargarett@gmail.com', NULL, '2024-04-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '148', 12, 'Funeral', 'Funeral', 'Confirm', NULL, 'rex1', NULL, '2024-05-11 10:00:00', '0000-00-00 00:00:00', 'dsadasd', 'For Payment', '123456789123456', 2147483647, 'Janna Mae Parayno', 150, '150', '2024-04-07 03:19:01 ', '9201325664', 'saquilayanmargarett@gmail.com', NULL, NULL, 'd.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '148', 13, 'Funeral', 'Funeral', 'Confirm', NULL, 'rex1', NULL, '2024-05-11 11:00:00', '0000-00-00 00:00:00', 'dsadasd', NULL, '123456789123456', 2147483647, 'Janna Mae Parayno', 150, '150', '2024-04-07 03:16:27 ', '9201325664', 'saquilayanmargarett@gmail.com', NULL, NULL, 'd.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '148', 14, 'Baptismal', 'Baptismal', 'Confirm', NULL, 'rex1', NULL, '2024-04-10 09:00:00', '0000-00-00 00:00:00', 'Norman Alain', 'For Payment', NULL, NULL, NULL, NULL, '1000', NULL, '9602962768', 'normanjake.alain16@gmail.com', NULL, NULL, NULL, '4.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '148', 15, 'mass', 'mass', 'Cancel', NULL, 'rex1', NULL, '2024-04-16 11:24:00', '0000-00-00 00:00:00', 'Jovita Alain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9602962768', '@gmail.com', NULL, '2024-04-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '148', 16, 'mass', 'mass', 'Confirm', NULL, 'rex1', NULL, '2024-04-15 04:53:00', '0000-00-00 00:00:00', 'Rommel', NULL, 'RSF84932123', 2147483647, 'Norman Jake Alain', 1, '1000', '2024-04-11 09:18:16 ', '9602962768', 'normanjake.alain@gmail.com', NULL, NULL, 'receipt.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '148', 17, 'Blessing', 'Blessing', 'Confirm', NULL, 'rex1', NULL, '2024-04-13 09:00:00', '0000-00-00 00:00:00', 'Jovita Alain', 'For Payment', NULL, NULL, NULL, NULL, '1000', NULL, '9602962768', 'normanjake.alain@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '148', 18, 'mass', 'mass', 'Confirm', NULL, 'rex1', NULL, '2024-04-15 11:00:00', '0000-00-00 00:00:00', 'Norman Jake Sabulao Alain', 'For Payment', NULL, NULL, NULL, NULL, '1000', NULL, '9602962768', 'normanjake.alain@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, '148', 19, 'Baptismal', 'Baptismal', 'Confirm', NULL, 'rex1', NULL, '2024-05-14 06:00:00', '0000-00-00 00:00:00', 'sample', NULL, '123456789098', 2147483647, 'Koline', 1, '1000', '2024-04-11 12:42:45 ', '9201325664', 'marykoline.caguimbal@my.jru.edu', NULL, NULL, 'Screenshot (1).png', 'Screenshot 2024-04-08 193124.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '148', 20, 'Blessing', 'Blessing', 'Confirm', NULL, 'rex1', NULL, '2024-06-07 11:00:00', '0000-00-00 00:00:00', 'Darwin Puzo', NULL, '2012120513868', 2147483647, 'Darwin Puzo', 1, '1000', '2024-04-12 06:09:50 ', '9602962768', 'darwin@gmail.com', NULL, NULL, 'gcash.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '148', 21, 'mass', 'mass', 'Cancel', NULL, 'rex1', NULL, '2024-04-20 08:00:00', '0000-00-00 00:00:00', 'kim babas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9602962768', 'kim@gmail.com', NULL, '2024-04-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '155', 24, 'Baptismal', 'Baptismal', 'Confirm', NULL, 'rex1', NULL, '2024-04-20 07:00:00', '2024-04-18 14:55:23', 'John Rey Jarapan', NULL, 'RSF84932123', 2147483647, 'Juan Dela Cruz', 0, '', '2024-04-15 06:40:43 ', '9296319194', 'jrj.files@gmail.com', NULL, NULL, 'receipt.png', 'esign ni papa.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '157', 25, 'Baptismal', 'Baptismal', 'Confirm', NULL, 'rex1', NULL, '2024-04-14 02:00:00', '0000-00-00 00:00:00', 'Rolando Cruz', NULL, 'TF342525', 2147483647, 'NORMAN ALAIN', 0, '', '2024-04-13 07:36:36 ', '9150314884', 'chuckjoshuacruz2000@gmail.com', NULL, NULL, 'receipt.png', 'Screenshot 2023-03-30 002744.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '148', 26, 'mass', 'mass', 'For Schedule', NULL, 'rex1', NULL, '2024-04-18 08:00:00', '0000-00-00 00:00:00', 'jelay palanas', 'For Payment', NULL, NULL, NULL, NULL, '', NULL, '9602962768', 'jelay@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, '148', 27, 'mass', 'mass', 'For Schedule', NULL, NULL, '', '2024-04-20 07:27:00', '0000-00-00 00:00:00', 'jaek', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9602962768', '@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '148', 28, 'mass', 'mass', 'For Schedule', NULL, 'rex1', NULL, '2024-04-20 10:30:00', '0000-00-00 00:00:00', 'Rommel ', 'For DonationFor Paym', NULL, NULL, NULL, NULL, '', NULL, '9602962768', 'coxike8334@iliken.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '148', 29, 'mass', 'mass', 'For Schedule', NULL, NULL, NULL, '2024-04-25 11:00:00', '0000-00-00 00:00:00', 'Kyandra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0960296728', 'kyang@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '148', 30, 'mass', 'mass', 'Confirm', NULL, 'rex1', NULL, '2024-04-18 09:12:00', '0000-00-00 00:00:00', 'norms', NULL, 'TF342525', 2147483647, 'Juan Dela Cruz', 0, '', '2024-04-16 01:23:08 ', '9602962768', 'sample@gmail.com', NULL, NULL, 'receipt.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '148', 31, 'Baptismal', 'Baptismal', 'Confirm', NULL, 'rex1', NULL, '2024-04-17 07:00:00', '0000-00-00 00:00:00', 'norman jake', NULL, 'RSF84932123', 2147483647, 'NORMAN ALAIN', 0, NULL, '2024-04-16 01:38:46 ', '9602962768', 'sample@gmail.com', NULL, NULL, 'my esign no bg.png', 'my esign no bg.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_setting`
--

CREATE TABLE `schedule_setting` (
  `id` int(11) NOT NULL,
  `time` varchar(15) DEFAULT NULL,
  `event` varchar(20) DEFAULT NULL,
  `days` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `schedule_setting`
--

INSERT INTO `schedule_setting` (`id`, `time`, `event`, `days`) VALUES
(1, '6:00 AM', 'Baptismal', '4'),
(2, '7:00 AM', 'Baptismal', '5'),
(3, '8:00 AM', 'Baptismal', '8'),
(4, '9:00 AM', 'Baptismal', '9'),
(5, '10:00 AM', 'Baptismal', '10'),
(6, '11:00 AM', 'Baptismal', '5'),
(7, '12:00 NN', 'Baptismal', '10'),
(8, '1:00 PM', 'Baptismal', '10'),
(9, '2:00 PM', 'Baptismal', '10'),
(10, '3:00 PM', 'Baptismal', '10'),
(11, '4:00 PM', 'Baptismal', '10'),
(12, '5:00 PM', 'Baptismal', '10'),
(13, '6:00 AM', 'Funeral', '2'),
(14, '7:00 AM', 'Funeral', '2'),
(15, '8:00 AM', 'Funeral', '2'),
(16, '9:00 AM', 'Funeral', '2'),
(17, '10:00 AM', 'Funeral', '2'),
(18, '11:00 AM', 'Funeral', '2'),
(19, '12:00 NN', 'Funeral', '2'),
(20, '1:00 PM', 'Funeral', '2'),
(21, '2:00 PM', 'Funeral', '2'),
(22, '3:00 PM', 'Funeral', '2'),
(23, '4:00 PM', 'Funeral', '2'),
(24, '5:00 PM', 'Funeral', '2');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_setting_old`
--

CREATE TABLE `schedule_setting_old` (
  `id` int(11) NOT NULL,
  `event` varchar(20) DEFAULT NULL,
  `days` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `schedule_setting_old`
--

INSERT INTO `schedule_setting_old` (`id`, `event`, `days`) VALUES
(1, 'Baptismal', '5'),
(2, 'Funeral', '2');

-- --------------------------------------------------------

--
-- Table structure for table `setting_of_prices`
--

CREATE TABLE `setting_of_prices` (
  `id` int(11) NOT NULL,
  `event` varchar(20) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `setting_of_prices`
--

INSERT INTO `setting_of_prices` (`id`, `event`, `price`) VALUES
(1, 'Baptismal', '1000'),
(2, 'Funeral', '7000'),
(3, 'Wedding', '7000'),
(5, 'Mass', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `accountType` varchar(20) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `birthdate` varchar(50) DEFAULT NULL,
  `Age` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `delete_date` varchar(20) DEFAULT NULL,
  `picture_data` varchar(50) DEFAULT NULL,
  `email_verification` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `accountType`, `firstName`, `lastName`, `userName`, `password`, `email`, `phoneNumber`, `birthdate`, `Age`, `address`, `delete_date`, `picture_data`, `email_verification`) VALUES
(27, 'Admin', 'Norman', 'Alain', 'admin1', '$2y$10$AfERy2T4QTyisKPuuTFAkO0OKVpFhP6QYB16LSE044P80HgPpgJgW', 'normanjake.alain@gmail.com', '09602962768', '2002-02-05', '21', 'Blk.40 Addition Hills', NULL, 'My JRU pic.jpg', '2023-11-19'),
(143, 'Client', '12345', '12345', '12345', '$2y$10$/aSDVthz/hw0ou.2L4nkjOIUb8m.OCbQxVZUiQGq3zqmqGXq0QqK2', 'marlon_curitana@yahoo.com', '111', '2024-01-23', '0', 'ee', NULL, NULL, '2024-01-21'),
(148, 'Client', 'Norms', 'Alain', 'client1', '$2y$10$Ij.T34HpBkt1Vv9Ji.B9ruaAqWAgHEDBNptRhFwphkJjuuR2bEF6W', 'normanjake.alain@gmail.com', '09602962768', '2002-05-02', '22', 'Bl4.40 Addition Hills', NULL, 'profile.png', '2024-02-28'),
(149, 'Client', 'Paula Lorraine ', 'Capuchino', 'iampaulitalala', '$2y$10$gP6VyO6m.NAmDzVD8dVAQOopE4nh4Z194tMYIw.yMWEYgjIWdyaDO', 'paulacapuchino@gmail.com', '09185814739', '1999-04-01', '25', 'Phase 2 Block 4 Lot 25 Celina Plains Subdivision ', NULL, NULL, '2024-03-05'),
(150, 'Priest', 'rex', 'pob', 'rex1', '$2y$10$jldc79wujIi0IY0n.qNVpukmtWdBm03AlpRx4snc5vw3OLl0KEyo.', 'normanjake.alain@my.jru.edu', '09602962768', '2002-05-02', '22', 'Blk.40 Addition hills\r\n', NULL, NULL, '2024-03-14'),
(152, 'Client', 'client', 'client', 'client', '$2y$10$1s1lvhHHsgylcwoOOg0Dz.u/BXkr4VAdJaIAEU/SE.GCbZAXf7OT2', 'client', '09269247893', '2024-03-27', '0', 'client', NULL, NULL, '2'),
(153, 'Client', 'Maridel', 'Bantillo', 'Madel', '$2y$10$ALpvpiDr9enOgN3VFLMfpu4O..Fpwpy/Wt8UChC/8lZXFiTN9uCJi', 'bantillomaridel2@gmail.com', '09945953360', '1993-12-04', '31', '#47 Congressional Avenue, Corner Villa Socorro', NULL, NULL, NULL),
(154, 'Client', 'Maridel', 'Bantillo', 'Madel', '$2y$10$SnGkEPIme.vUs2CiLa9ofOzJAcoKY3UvAI4gksT/QH.5DO3vMJnpa', 'bantillomaridel2@gmail.com', '09945953360', '1993-12-04', '31', '#47 Congressional Avenue, Corner Villa Socorro', NULL, NULL, NULL),
(155, 'Client', 'John Rey', 'Jarapan', 'itsmejrj', '$2y$10$EQdboFyrNTv0x5yvlGlxPuIXrb.yf6LpELOKymKuhTVkKNex9x/Ci', 'jrj.files@gmail.com', '09296319194', '2001-05-21', '23', 'blk 89 Lot 17, Angono Rizal', NULL, NULL, '2024-04-13'),
(156, 'Client', 'chuck joshua', 'cruz', 'chuck02', '$2y$10$MfadikbVzyvx5HE9KLQHjeT2q7eeEkoVQUnjcv6UAoi3HE1MB0bOS', 'chuckjoshuacruz2000@gmail.com', '09150314884', '1999-10-24', '25', '774 R. Castillo st. kalawaan Pasig City', NULL, NULL, NULL),
(157, 'Client', 'chuck joshua', 'cruz', 'chuck02', '$2y$10$760dGtVxVJmayufdBXzqQeDSo58WJWxLNlGZW9phADYz4hZEsJ8P6', 'chuckjoshuacruz2000@gmail.com', '09150314884', '1999-10-24', '25', '774 R. Castillo st. kalawaan Pasig City', NULL, NULL, '2024-04-13'),
(158, 'Client', 'Bernie', 'Baganao Jr.', '@bernie08', '$2y$10$nnoPkiazSrI.kFI0UWQ./.Udxa/uGxNCa4f10E6z5x561tIBaLX/C', 'baganao.bernie08@gmail.com', '09121429419', '2001-08-08', '23', 'Patpat, Malitbog, Bukidnon', NULL, NULL, '2024-04-13'),
(160, 'Client', 'nj ', 'alain', 'njalain', '$2y$10$TDBpRzKQQWem23Y7AxQ0KOKaWBp1MPlq2RyFvicPh0Hos3JYGs8wu', 'coxike8334@iliken.com', '09608962768', '2002-05-02', '22', 'Block 40 Addition Hills', NULL, 'images.jpeg', '2024-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `worship`
--

CREATE TABLE `worship` (
  `id` int(11) NOT NULL,
  `Picture` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `delete_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `worship`
--

INSERT INTO `worship` (`id`, `Picture`, `firstName`, `lastName`, `email`, `phoneNumber`, `birthdate`, `Age`, `address`, `delete_date`) VALUES
(7, 'My JRU pic.jpg', 'Jake', 'Alain', 'normanjake.alain@gmail.com', '09602962768', '0000-00-00', 21, 'Mandaluyong City', NULL),
(8, 'norberto.jpg', 'Norberto ', 'Lira', 'norberto.alain0673@gmail.com', '09381387974', '1973-06-06', 50, 'Block 19, Guagua City', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_feeback`
--
ALTER TABLE `customer_feeback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requested_document`
--
ALTER TABLE `requested_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_form`
--
ALTER TABLE `request_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_id` (`request_form_id`);

--
-- Indexes for table `schedule_setting`
--
ALTER TABLE `schedule_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_setting_old`
--
ALTER TABLE `schedule_setting_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_of_prices`
--
ALTER TABLE `setting_of_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worship`
--
ALTER TABLE `worship`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_feeback`
--
ALTER TABLE `customer_feeback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `requested_document`
--
ALTER TABLE `requested_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_form`
--
ALTER TABLE `request_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `schedule_setting`
--
ALTER TABLE `schedule_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `schedule_setting_old`
--
ALTER TABLE `schedule_setting_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting_of_prices`
--
ALTER TABLE `setting_of_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `worship`
--
ALTER TABLE `worship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
