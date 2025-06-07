-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2025 at 02:48 AM
-- Server version: 8.0.42
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelola_tani`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_workers`
--

CREATE TABLE `active_workers` (
  `id_aw` int NOT NULL,
  `date_aw` date NOT NULL,
  `delegate_aw` int NOT NULL,
  `name_aw` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `active_workers`
--

INSERT INTO `active_workers` (`id_aw`, `date_aw`, `delegate_aw`, `name_aw`) VALUES
(1, '2025-06-04', 1, 1),
(2, '2025-06-04', 2, 2),
(3, '2025-06-04', 3, 3),
(4, '2025-06-04', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `commodities`
--

CREATE TABLE `commodities` (
  `id_commodity` int NOT NULL,
  `name_commodity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commodities`
--

INSERT INTO `commodities` (`id_commodity`, `name_commodity`) VALUES
(1, 'Padi'),
(2, 'Kopi'),
(3, 'Jagung'),
(4, 'Singkong');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id_farmer` int NOT NULL,
  `birthday_farmer` date NOT NULL,
  `name_farmer` varchar(100) NOT NULL,
  `role_farmer` varchar(50) NOT NULL DEFAULT 'Not Assigned',
  `wage_farmer` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id_farmer`, `birthday_farmer`, `name_farmer`, `role_farmer`, `wage_farmer`) VALUES
(1, '1985-03-15', 'Wawan Komar', 'Farmer', 30000),
(2, '1990-07-22', 'Windi Garcia', 'Farmer', 38000),
(3, '1982-11-05', 'Bambang Rusidin', 'Crop Supervisor', 42000),
(4, '1995-02-18', 'Supardi Chen', 'Harvester', 35000),
(5, '1978-09-30', 'Joko Mahmudin', 'Equipment Operator', 40000),
(6, '1992-04-12', 'Sarah Budiman', 'Tractor Operator', 37000),
(7, '1987-12-25', 'Dedi Yohanes', 'Farmer', 36000),
(8, '1998-06-08', 'Martin Hermawan', 'Farmer', 32000),
(9, '1980-01-14', 'Siti Umayin', 'Harvester', 39000),
(11, '1995-02-17', 'Sofia Cut Dien', 'Intern Harvester', 25000),
(12, '2004-02-04', 'Rusli Jaelani', 'Intern Farmer', 25000),
(13, '1995-06-04', 'Baharudin Jaelani', 'Farmer', 30000),
(22, '1999-06-04', 'Similius Rodrigo', 'Tractor operator', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `id_farm` int NOT NULL,
  `name_farm` varchar(50) NOT NULL,
  `type_farm` varchar(50) DEFAULT 'Undefined',
  `area_farm` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`id_farm`, `name_farm`, `type_farm`, `area_farm`) VALUES
(1, 'Kebun Mekar Jaya', 'Sawah', 15000),
(2, 'Peternakan Maju Bersama', 'Padang Rumput', 25000),
(3, 'Lumbung Padi Indah', 'Sawah', 10000),
(4, 'Kopi Pegunungan', 'Perkebunan Kopi', 8000),
(5, 'Hutan Produksi Lestari', 'Hutan Tanaman Industri', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

CREATE TABLE `storages` (
  `id_storage` int NOT NULL,
  `item_storage` int NOT NULL,
  `volume_storage` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id_storage`, `item_storage`, `volume_storage`) VALUES
(1, 1, 100),
(2, 2, 50),
(3, 3, 200),
(4, 4, 150),
(5, 1, 75),
(6, 3, 120);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_workers`
--
ALTER TABLE `active_workers`
  ADD PRIMARY KEY (`id_aw`),
  ADD KEY `delegate_aw` (`delegate_aw`),
  ADD KEY `name_aw` (`name_aw`);

--
-- Indexes for table `commodities`
--
ALTER TABLE `commodities`
  ADD PRIMARY KEY (`id_commodity`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id_farmer`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`id_farm`);

--
-- Indexes for table `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id_storage`),
  ADD KEY `item_storage` (`item_storage`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_workers`
--
ALTER TABLE `active_workers`
  MODIFY `id_aw` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commodities`
--
ALTER TABLE `commodities`
  MODIFY `id_commodity` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id_farmer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id_farm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `storages`
--
ALTER TABLE `storages`
  MODIFY `id_storage` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `active_workers`
--
ALTER TABLE `active_workers`
  ADD CONSTRAINT `active_workers_ibfk_1` FOREIGN KEY (`delegate_aw`) REFERENCES `farms` (`id_farm`),
  ADD CONSTRAINT `active_workers_ibfk_2` FOREIGN KEY (`name_aw`) REFERENCES `farmers` (`id_farmer`);

--
-- Constraints for table `storages`
--
ALTER TABLE `storages`
  ADD CONSTRAINT `storages_ibfk_1` FOREIGN KEY (`item_storage`) REFERENCES `commodities` (`id_commodity`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
