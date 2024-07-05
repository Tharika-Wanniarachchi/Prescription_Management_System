-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 10:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prescription_upload_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `drug_id` int(11) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `Amount` float NOT NULL,
  `pre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`drug_id`, `drug`, `quantity`, `Amount`, `pre_id`) VALUES
(7, 'Paracetamol', '5.00*14', 70, 1),
(8, 'Amoxicillin', '7.00*10', 70, 1),
(9, 'Omeprazole', '5.00*30', 150, 3),
(10, 'Omeprazole', '2.00*30', 60, 4),
(11, 'Aspirin', '10.00*20', 200, 4),
(12, 'Paracetamol', '5.00*60', 300, 4);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_details`
--

CREATE TABLE `prescription_details` (
  `pre_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `descriptionNote` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `dateTime` datetime NOT NULL,
  `images` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription_details`
--

INSERT INTO `prescription_details` (`pre_id`, `email`, `descriptionNote`, `address`, `dateTime`, `images`) VALUES
(1, 'shanulakshani7@gmail.com', 'Patient requires all medicines for 7 days\r\n', '123/d, horana road, panadura', '2024-06-23 21:53:00', '[\"66784c052b0ae.jpg\",\"66784c052b28d.jpg\",\"66784c052b3ba.jpg\",\"66784c052b4f0.jpg\",\"66784c052b747.jpg\"]'),
(2, 'Universitydoc254@gmail.com', 'Patient requires all medicines for 1 month', '12/B,  raigama road, Bandargama', '2024-06-23 21:59:00', '[\"66784d75244b1.jpg\",\"66784d75246bf.jpg\",\"66784d75247d5.jpg\",\"66784d7524900.jpg\",\"66784d7524a33.jpeg\"]'),
(3, 'nimali@gmail.com', 'Patient requires all medicines for 3 days', '230/A, horana road, rathnapura', '2024-06-23 22:05:00', '[\"66784ff895146.jpg\",\"66784ff895230.jpg\",\"66784ff8952f6.jpg\",\"66784ff895380.jpg\"]'),
(4, 'Universitydoc254@gmail.com', 'Patient requires all medicined for 3 month', '20/A , Welikala road, Horana', '2024-06-24 00:34:00', '[\"667871bd87b58.jpg\",\"667871bd87cff.jpg\",\"667871bd87d8d.jpg\",\"667871bd87e17.jpg\",\"667871bd87eb6.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `contactNumber` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullName`, `dob`, `contactNumber`, `email`, `address`, `user_type`, `password`) VALUES
(1, 'Tharika Wanniarachchi', '2000-03-29', '0767580351', 'tharikawanniarachchi0@gmail.com', 'Millaniya,Horana', 'Pharmacy', '$2y$10$tIotwh36Ko5gp8Bm2KlS/ein3rAo1C8h6dDoAXtlIHOI7ggiES//i'),
(2, 'Shanu Lakshani', '2000-10-24', '0763457678', 'shanulakshani7@gmail.com', 'piliyandala road,Colombo', 'Customer', '$2y$10$Mhvenc81sp.hc.6OFae7I.brDEvzA9WTgmw7EVZUiqstjt7SRfzh2'),
(3, 'Nimali Maheshika', '1995-06-26', '0786578676', 'universitydoc254@gmail.com', '20/A , Welikala road, Horana', 'Customer', '$2y$10$FTfSQWyi6kjeb2aLMMZfs.By3gLcnJ7k1gx4qGg6QzOMJ71UZRPO6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`drug_id`),
  ADD KEY `pre_id` (`pre_id`);

--
-- Indexes for table `prescription_details`
--
ALTER TABLE `prescription_details`
  ADD PRIMARY KEY (`pre_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `drug_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prescription_details`
--
ALTER TABLE `prescription_details`
  MODIFY `pre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `drugs_ibfk_1` FOREIGN KEY (`pre_id`) REFERENCES `prescription_details` (`pre_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
