-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 04:07 AM
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
  `id_farm` int NOT NULL,
  `id_farmer` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `aw_view`
-- (See below for the actual view)
--
CREATE TABLE `aw_view` (
`date_aw` date
,`id_aw` int
,`id_user` int
,`name_farm` varchar(50)
,`name_farmer` varchar(100)
,`role_farmer` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id_crop` int NOT NULL,
  `name_crop` varchar(50) NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id_crop`, `name_crop`, `id_user`) VALUES
(1, 'Seledri', 1),
(2, 'Bawang', 1),
(18, 'Bayam', 1),
(19, 'Wortel', 1),
(21, 'Jagung', 1),
(27, 'Teh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id_farmer` int NOT NULL,
  `birthday_farmer` date NOT NULL,
  `name_farmer` varchar(100) NOT NULL,
  `role_farmer` varchar(50) NOT NULL DEFAULT 'Not Assigned',
  `wage_farmer` int DEFAULT '0',
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id_farmer`, `birthday_farmer`, `name_farmer`, `role_farmer`, `wage_farmer`, `id_user`) VALUES
(17, '1991-09-19', 'Rudi Wirawan', 'Farmer Supervisor', 150000, 1),
(24, '1996-06-20', 'Similius Fernandez', 'Farmer', 100000, 1),
(25, '1995-12-13', 'Kiki Nurahman', 'Farmer', 100000, 1),
(26, '2000-02-01', 'Gian Setyo', 'Harvester', 100000, 1),
(27, '1999-06-10', 'Fito Ikibudin', 'Farmer', 100000, 1),
(28, '1999-12-23', 'Rudiansyah Akbar', 'Quality Control', 100000, 1),
(29, '1999-12-23', 'Rudiansyah Akbar', 'Quality Control', 100000, 1),
(30, '2000-11-12', 'Fito Ikibudin', 'Farmer', 100000, 1),
(31, '1999-10-11', 'SIsi Dark', 'Farmer', 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `id_farm` int NOT NULL,
  `name_farm` varchar(50) NOT NULL,
  `type_farm` varchar(50) DEFAULT 'Undefined',
  `area_farm` int DEFAULT '0',
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`id_farm`, `name_farm`, `type_farm`, `area_farm`, `id_user`) VALUES
(2, 'Pertanian 1', 'sawah', 200, 1),
(4, 'Pertanian 2', 'Kebun', 50, 1),
(5, 'Pertanian 3', 'Kebun', 100, 1),
(6, 'Pertanian 4', 'Sawah', 100, 1),
(7, 'Pertanian 5', 'Padang', 100, 1),
(8, 'Pertanian 6', 'Lereng', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `farm_planting`
--

CREATE TABLE `farm_planting` (
  `id_planting` int NOT NULL,
  `date_planting` date NOT NULL,
  `id_farm` int NOT NULL,
  `id_crop` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int NOT NULL,
  `id_user` int NOT NULL,
  `kategori_feedback` varchar(50) DEFAULT NULL,
  `title_feedback` varchar(20) DEFAULT NULL,
  `detail_feedback` varchar(255) DEFAULT 'Tidak menambahkan detail'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `id_user`, `kategori_feedback`, `title_feedback`, `detail_feedback`) VALUES
(1, 1, 'bug', 'A fitur', 'aaaa'),
(2, 1, 'bug', 'Bug di bagian a', 'aaaaa\r\n');

-- --------------------------------------------------------

--
-- Stand-in structure for view `fp_view`
-- (See below for the actual view)
--
CREATE TABLE `fp_view` (
`date_planting` date
,`id_planting` int
,`id_user` int
,`name_crop` varchar(50)
,`name_farm` varchar(50)
,`total_workers` bigint
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `planting_view`
-- (See below for the actual view)
--
CREATE TABLE `planting_view` (
`date_planting` date
,`id_planting` int
,`id_user` int
,`name_crop` varchar(50)
,`name_farm` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

CREATE TABLE `storages` (
  `id_storage` int NOT NULL,
  `id_crop` int NOT NULL,
  `volume_storage` int DEFAULT '0',
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id_storage`, `id_crop`, `volume_storage`, `id_user`) VALUES
(11, 19, 0, 1),
(12, 1, 49, 1),
(13, 2, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `storage_flows`
--

CREATE TABLE `storage_flows` (
  `id_flow` int NOT NULL,
  `date_flow` date NOT NULL,
  `id_crop` int NOT NULL,
  `in_flow` int DEFAULT '0',
  `out_flow` int DEFAULT '0',
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `storage_flows`
--

INSERT INTO `storage_flows` (`id_flow`, `date_flow`, `id_crop`, `in_flow`, `out_flow`, `id_user`) VALUES
(8, '2025-06-17', 1, 99, 0, 1),
(9, '2025-06-17', 1, 0, 50, 1),
(10, '2025-06-17', 2, 100, 0, 1);

--
-- Triggers `storage_flows`
--
DELIMITER $$
CREATE TRIGGER `delete_storages_trigger` AFTER DELETE ON `storage_flows` FOR EACH ROW begin
	DECLARE current_volume_storage int;

    SELECT volume_storage INTO current_volume_storage
    FROM storages
    WHERE id_crop = OLD.id_crop AND id_user = OLD.id_user;
   
   set current_volume_storage = current_volume_storage - old.in_flow + old.out_flow;
   
	if current_volume_storage > 0 then
	    UPDATE storages
	    SET volume_storage = volume_storage - old.in_flow + old.out_flow
	    WHERE id_crop = OLD.id_crop AND id_user = OLD.id_user;
	else
		UPDATE storages
	    SET volume_storage = 0
	    WHERE id_crop = OLD.id_crop AND id_user = OLD.id_user;
	end if;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_storages_trigger` AFTER INSERT ON `storage_flows` FOR EACH ROW BEGIN
    UPDATE storages
    SET volume_storage = volume_storage + NEW.in_flow - NEW.out_flow
    WHERE id_crop = NEW.id_crop AND id_user = NEW.id_user;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_storages_trigger` AFTER UPDATE ON `storage_flows` FOR EACH ROW BEGIN
    UPDATE storages
    SET volume_storage = volume_storage + NEW.in_flow - old.in_flow + old.out_flow - NEW.out_flow
    WHERE id_crop = NEW.id_crop AND id_user = NEW.id_user;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `full_name`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$LanIaYaPm2eZK7deJ6FeAu.uUBlbM3AkkDhs9K37RJ3LIiP5nmkWa', 'admin', '2025-06-07 08:47:12'),
(6, 'admin2', 'admin2@gmail.com', '$2y$10$0N2InXe6ONV5tlu/oRYBHOPN1KpLbnLmPTaCWwvGftLgNnPP1oCre', 'admin2', '2025-06-07 12:24:05'),
(7, 'yafi', 'yafi@gmail.com', '$2y$10$9BsxdRylFlnc7xZUEDMaj.cUKB7dq6I3t8f6SFIten5t7fbYbEXEK', 'yafi', '2025-06-16 11:47:34');

-- --------------------------------------------------------

--
-- Structure for view `aw_view`
--
DROP TABLE IF EXISTS `aw_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `aw_view`  AS SELECT `aw`.`id_aw` AS `id_aw`, `aw`.`date_aw` AS `date_aw`, `f`.`name_farm` AS `name_farm`, `w`.`name_farmer` AS `name_farmer`, `w`.`role_farmer` AS `role_farmer`, `u`.`id_user` AS `id_user` FROM (((`active_workers` `aw` join `farms` `f`) join `farmers` `w`) join `users` `u`) WHERE ((`aw`.`id_farm` = `f`.`id_farm`) AND (`w`.`id_farmer` = `aw`.`id_farmer`) AND (`aw`.`id_user` = `u`.`id_user`)) ;

-- --------------------------------------------------------

--
-- Structure for view `fp_view`
--
DROP TABLE IF EXISTS `fp_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fp_view`  AS SELECT `fp`.`id_planting` AS `id_planting`, `fp`.`date_planting` AS `date_planting`, `f`.`name_farm` AS `name_farm`, `c`.`name_crop` AS `name_crop`, `u`.`id_user` AS `id_user`, (select count(`aw`.`id_farmer`) from `active_workers` `aw` where ((`aw`.`id_farm` = `fp`.`id_farm`) and (`aw`.`date_aw` = `fp`.`date_planting`) and (`fp`.`id_user` = `aw`.`id_user`))) AS `total_workers` FROM (((`farm_planting` `fp` left join `users` `u` on((`fp`.`id_user` = `u`.`id_user`))) left join `farms` `f` on((`fp`.`id_farm` = `f`.`id_farm`))) left join `crops` `c` on((`fp`.`id_crop` = `c`.`id_crop`))) ;

-- --------------------------------------------------------

--
-- Structure for view `planting_view`
--
DROP TABLE IF EXISTS `planting_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `planting_view`  AS SELECT `fp`.`id_planting` AS `id_planting`, `fp`.`date_planting` AS `date_planting`, `f`.`name_farm` AS `name_farm`, `c`.`name_crop` AS `name_crop`, `u`.`id_user` AS `id_user` FROM (((`farm_planting` `fp` join `farms` `f`) join `crops` `c`) join `users` `u`) WHERE ((`fp`.`id_user` = `u`.`id_user`) AND (`fp`.`id_farm` = `f`.`id_farm`) AND (`fp`.`id_crop` = `c`.`id_crop`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_workers`
--
ALTER TABLE `active_workers`
  ADD PRIMARY KEY (`id_aw`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_farm` (`id_farm`),
  ADD KEY `id_farmer` (`id_farmer`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id_crop`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id_farmer`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`id_farm`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `farm_planting`
--
ALTER TABLE `farm_planting`
  ADD PRIMARY KEY (`id_planting`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_crop` (`id_crop`),
  ADD KEY `id_farm` (`id_farm`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id_storage`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_crop` (`id_crop`);

--
-- Indexes for table `storage_flows`
--
ALTER TABLE `storage_flows`
  ADD PRIMARY KEY (`id_flow`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_crop` (`id_crop`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_workers`
--
ALTER TABLE `active_workers`
  MODIFY `id_aw` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id_crop` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id_farmer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id_farm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `farm_planting`
--
ALTER TABLE `farm_planting`
  MODIFY `id_planting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `storages`
--
ALTER TABLE `storages`
  MODIFY `id_storage` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `storage_flows`
--
ALTER TABLE `storage_flows`
  MODIFY `id_flow` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `active_workers`
--
ALTER TABLE `active_workers`
  ADD CONSTRAINT `active_workers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `active_workers_ibfk_2` FOREIGN KEY (`id_farm`) REFERENCES `farms` (`id_farm`),
  ADD CONSTRAINT `active_workers_ibfk_3` FOREIGN KEY (`id_farmer`) REFERENCES `farmers` (`id_farmer`);

--
-- Constraints for table `crops`
--
ALTER TABLE `crops`
  ADD CONSTRAINT `crops_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `farmers`
--
ALTER TABLE `farmers`
  ADD CONSTRAINT `farmers_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `farms`
--
ALTER TABLE `farms`
  ADD CONSTRAINT `farms_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `farm_planting`
--
ALTER TABLE `farm_planting`
  ADD CONSTRAINT `farm_planting_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `farm_planting_ibfk_2` FOREIGN KEY (`id_crop`) REFERENCES `crops` (`id_crop`),
  ADD CONSTRAINT `farm_planting_ibfk_3` FOREIGN KEY (`id_farm`) REFERENCES `farms` (`id_farm`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `storages`
--
ALTER TABLE `storages`
  ADD CONSTRAINT `storages_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `storages_ibfk_2` FOREIGN KEY (`id_crop`) REFERENCES `crops` (`id_crop`);

--
-- Constraints for table `storage_flows`
--
ALTER TABLE `storage_flows`
  ADD CONSTRAINT `storage_flows_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `storage_flows_ibfk_2` FOREIGN KEY (`id_crop`) REFERENCES `crops` (`id_crop`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
