
--SCRIPT de création de la base (symfony 6 )

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2023 at 06:11 AM
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
-- Database: `circlegamebdd_dev2`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230322151755', '2023-03-24 05:52:45', 43),
('DoctrineMigrations\\Version20230323090655', '2023-03-24 05:52:45', 16),
('DoctrineMigrations\\Version20230323090909', '2023-03-24 05:52:45', 6),
('DoctrineMigrations\\Version20230324055512', '2023-03-24 05:55:17', 56),
('DoctrineMigrations\\Version20230324182211', '2023-03-24 18:22:30', 178),
('DoctrineMigrations\\Version20230325155048', '2023-03-25 15:51:12', 85),
('DoctrineMigrations\\Version20230326122516', '2023-03-26 12:25:37', 74),
('DoctrineMigrations\\Version20230326124737', '2023-03-26 12:47:42', 73);

-- --------------------------------------------------------

--
-- Table structure for table `gladiator`
--

CREATE TABLE `gladiator` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` double NOT NULL,
  `strength` double NOT NULL,
  `balance` double NOT NULL,
  `speed` double NOT NULL,
  `strategy` double NOT NULL,
  `ludis_id` int NOT NULL,
  `edit` datetime DEFAULT NULL,
  `perfomance` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gladiator`
--

INSERT INTO `gladiator` (`id`, `name`, `avatar`, `address`, `strength`, `balance`, `speed`, `strategy`, `ludis_id`, `edit`, `perfomance`) VALUES
(1, 'Hercule', 'Hercules-PNG-Picture-641eaeebb4ed7.png', 2, 1, 0, 2, -1, 12, '2023-03-26 09:30:44', 2.1787146967991),
(3, 'Helon', 'gladiator-641ed8e3dfc2a.png', 0, 0, 0, 1, 0, 12, '2023-03-26 09:30:08', 0.84301801195391),
(6, 'Hermes', 'gladiator-641ff697eddac.png', 2, 1, 0, 3, -1, 8, '2023-03-26 09:39:13', 3.0114970275392),
(7, 'Helon2', 'gladiator-641ff6fde516d.png', 1, 0, 0, 1, 0, 8, '2023-03-26 09:40:59', 0.96047588160378),
(8, 'Hercule3', 'gladiator-641ff78b9dee7.png', 2, 1, 0, 2, -1, 8, '2023-03-26 09:44:48', 2.9044761522123),
(9, 'Helon4', 'gladiator-641ff82f7bba3.png', 1, 0, 0, 1, 0, 8, '2023-03-26 09:46:15', 1.5625158967302),
(10, 'Hercule 5', 'gladiator-642000db54dcc.png', 2, 1, 0, 2, -1, 8, '2023-03-26 12:17:27', 2.6730534561325),
(11, 'hercule6', 'gladiator-642000f2a9d63.png', 3, 0, 2, 0, 1, 8, NULL, 4.9312586734833),
(12, 'Hercule 7', 'gladiator-642001135c84e.png', 1, 1, 0, 2, 0, 8, '2023-03-26 12:10:28', 2.113176093196),
(13, 'Hercule 8', 'gladiator-642001241d5f2.png', 3, 1, 1, 0, 0, 8, NULL, 4.0579587856957),
(14, 'Hercule 9', 'gladiator-6420013fb7752.png', 2, 0, 3, 0, 1, 8, NULL, 5.092127457163),
(15, 'Hercule 10', 'gladiator-64200156902da.png', 1, 1, 3, 2, 2, 8, NULL, 4.6588238287307),
(18, 'aristote', 'gladiator-64206ecab1597.png', 1, 0, 0, 1, 0, 10, '2023-03-27 07:25:37', NULL),
(19, 'merlin', 'gladiator-64206ef87bde7.png', 1, 0, 0, 1, 0, 10, '2023-03-27 07:25:59', NULL),
(20, 'shizzle', 'gladiator-64206f209557b.png', 2, 1, 0, 2, -1, 10, '2023-03-27 07:28:11', NULL),
(21, 'Hercule', 'gladiator-64212901a91e1.png', 3, 2, 0, 4, -1, 15, '2023-03-27 07:26:31', NULL),
(22, 'Hercule', 'gladiator-6421293edbccd.png', 3, 2, 0, 4, -1, 15, '2023-03-27 07:27:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laniste`
--

CREATE TABLE `laniste` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prename` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laniste`
--

INSERT INTO `laniste` (`id`, `email`, `roles`, `password`, `name`, `prename`, `coin`) VALUES
(1, 'a.yacine2020@laposte.net', '[]', '$2y$13$yK.yyKu4FAyJ7z5WSheYuuWPO18OuEP.PJLIJWUz1VPGobu0vJ4D2', 'Yannick', 'Courbic', 928),
(2, 'a.yacine@laposte.net', '[]', '$2y$13$nmAPbpvPaA9/8vvZGiazPONT7oD3wxhNx0JuvZur2xsZtwZUgZcru', 'Yannick', 'Courbic', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ludi`
--

CREATE TABLE `ludi` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `speciality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lanistes_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ludi`
--

INSERT INTO `ludi` (`id`, `name`, `speciality`, `lanistes_id`) VALUES
(8, 'laniste#1', 'course de char', 1),
(10, 'laniste#2', 'athlétisme', 1),
(11, 'laniste#1', 'course de char', 1),
(12, 'laniste#3', 'course de char', 2),
(15, 'luditest', 'athlétisme', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ludis_lanistes`
--

CREATE TABLE `ludis_lanistes` (
  `id` int NOT NULL,
  `ludi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `gladiator`
--
ALTER TABLE `gladiator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FFC56584BBFBDE31` (`ludis_id`);

--
-- Indexes for table `laniste`
--
ALTER TABLE `laniste`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_52C2AB99E7927C74` (`email`);

--
-- Indexes for table `ludi`
--
ALTER TABLE `ludi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_37714A43A80255F7` (`lanistes_id`);

--
-- Indexes for table `ludis_lanistes`
--
ALTER TABLE `ludis_lanistes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_97BD1E8B390910BB` (`ludi_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gladiator`
--
ALTER TABLE `gladiator`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `laniste`
--
ALTER TABLE `laniste`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ludi`
--
ALTER TABLE `ludi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ludis_lanistes`
--
ALTER TABLE `ludis_lanistes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gladiator`
--
ALTER TABLE `gladiator`
  ADD CONSTRAINT `FK_FFC56584BBFBDE31` FOREIGN KEY (`ludis_id`) REFERENCES `ludi` (`id`);

--
-- Constraints for table `ludi`
--
ALTER TABLE `ludi`
  ADD CONSTRAINT `FK_37714A43A80255F7` FOREIGN KEY (`lanistes_id`) REFERENCES `laniste` (`id`);

--
-- Constraints for table `ludis_lanistes`
--
ALTER TABLE `ludis_lanistes`
  ADD CONSTRAINT `FK_97BD1E8B390910BB` FOREIGN KEY (`ludi_id`) REFERENCES `ludi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
