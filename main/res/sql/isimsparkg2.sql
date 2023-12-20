-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2023 at 07:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isimsparkg2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bike`
--

CREATE TABLE `bike` (
  `bike_id` int NOT NULL,
  `bike_type` int NOT NULL,
  `bike_purchase_date` date NOT NULL,
  `bike_color` varchar(255) NOT NULL,
  `bike_size` int NOT NULL COMMENT '1 -> enfant\r\n2 -> ado\r\n3 -> adulte'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair`
--

CREATE TABLE `repair` (
  `repair_id` int NOT NULL,
  `bike_id` int NOT NULL,
  `repair_start` timestamp NOT NULL COMMENT 'timestamp of repair start',
  `repair_end` timestamp NOT NULL COMMENT 'timestamp of repair end',
  `repair_replacement` int DEFAULT NULL COMMENT 'potential id of replacement bike',
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_timeslot`
--

CREATE TABLE `repair_timeslot` (
  `rts_id` int NOT NULL,
  `rts_start` timestamp NOT NULL,
  `rts_end` timestamp NOT NULL,
  `rts_admin` int NOT NULL,
  `reparation_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int NOT NULL,
  `bike_id` int NOT NULL,
  `user_id` int NOT NULL,
  `reservation_start` date NOT NULL COMMENT 'date of reservation start',
  `reservation_end` date NOT NULL COMMENT 'date of reservation end',
  `reservation_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_reservation` tinyint(1) NOT NULL,
  `user_admin` tinyint(1) NOT NULL,
  `user_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_lastname`, `user_firstname`, `user_email`, `user_reservation`, `user_admin`, `user_password`) VALUES
(1, 'fabio', 'mirasola', '', 1, 1, '$2y$10$nAyZbsKgzcjya.Rlcoo9teCjvXRnr7diGw0ETNYyv6jpS1zFif8Jy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bike`
--
ALTER TABLE `bike`
  ADD PRIMARY KEY (`bike_id`),
  ADD KEY `fk_bike_type` (`bike_type`);

--
-- Indexes for table `repair`
--
ALTER TABLE `repair`
  ADD PRIMARY KEY (`repair_id`),
  ADD KEY `fk_repair_bike` (`bike_id`),
  ADD KEY `fk_repair_replacement` (`repair_replacement`),
  ADD KEY `fk_repair_user` (`user_id`);

--
-- Indexes for table `repair_timeslot`
--
ALTER TABLE `repair_timeslot`
  ADD PRIMARY KEY (`rts_id`),
  ADD KEY `fk_repairtimeslot_admin` (`rts_admin`),
  ADD KEY `fk_repairtimeslot_repair_id` (`reparation_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `fk_reservation_bike` (`bike_id`),
  ADD KEY `fk_reservation_user` (`user_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bike`
--
ALTER TABLE `bike`
  MODIFY `bike_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repair`
--
ALTER TABLE `repair`
  MODIFY `repair_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repair_timeslot`
--
ALTER TABLE `repair_timeslot`
  MODIFY `rts_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bike`
--
ALTER TABLE `bike`
  ADD CONSTRAINT `fk_bike_type` FOREIGN KEY (`bike_type`) REFERENCES `type` (`type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `repair`
--
ALTER TABLE `repair`
  ADD CONSTRAINT `fk_repair_bike` FOREIGN KEY (`bike_id`) REFERENCES `bike` (`bike_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_repair_replacement` FOREIGN KEY (`repair_replacement`) REFERENCES `bike` (`bike_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_repair_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `repair_timeslot`
--
ALTER TABLE `repair_timeslot`
  ADD CONSTRAINT `fk_repairtimeslot_admin` FOREIGN KEY (`rts_admin`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_repairtimeslot_repair_id` FOREIGN KEY (`reparation_id`) REFERENCES `repair` (`repair_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_bike` FOREIGN KEY (`bike_id`) REFERENCES `bike` (`bike_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_reservation_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
