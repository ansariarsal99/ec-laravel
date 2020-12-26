-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2020 at 12:44 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `build_mart`
--

-- --------------------------------------------------------

--
-- Table structure for table `request_for_proposal_respond_attachments`
--

CREATE TABLE `request_for_proposal_respond_attachments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_for_proposal_id` int(11) NOT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT 'active' COMMENT '''active'',''inactive''',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `request_for_proposal_respond_attachments`
--

INSERT INTO `request_for_proposal_respond_attachments` (`id`, `user_id`, `request_for_proposal_id`, `document_name`, `attachment`, `status`, `created_at`, `updated_at`) VALUES
(1, 93, 391, 'sfgsdg', '1600682665_1748877453.png', 'active', '2020-09-21 10:04:25', '2020-09-21 04:34:25'),
(2, 93, 190, 'docx', '1600683592_2120307880.pdf', 'active', '2020-09-21 10:19:52', '2020-09-21 04:49:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request_for_proposal_respond_attachments`
--
ALTER TABLE `request_for_proposal_respond_attachments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request_for_proposal_respond_attachments`
--
ALTER TABLE `request_for_proposal_respond_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
