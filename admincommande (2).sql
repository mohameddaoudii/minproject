-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 02:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admincommande`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `villle` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `name`, `email`, `telephone`, `villle`, `address`) VALUES
(1, 'eddaoudi', 'privet', '0654536548', 'ouled teima ', 'samoumate largame'),
(2, 'hakim', 'saaidze@gmail.com', '0675150910', 'ouled teima', 'welcoom;sfjl'),
(3, 'mohamed', 'soufiyafi@gmail.com', '0675150910', 'agadir', 'sss');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id_command` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `date_command` date DEFAULT NULL,
  `prix_command` float DEFAULT NULL,
  `etat` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_command`, `id_client`, `date_command`, `prix_command`, `etat`) VALUES
(6154059, 1, '2023-06-08', 200, 'true'),
(7916489, 1, '2023-06-08', 200, 'encommande'),
(9264902, 1, '2023-06-08', 200, 'encommande'),
(12775489, 3, '2023-06-10', 2400, 'encommande'),
(17564711, 1, '2023-06-08', 200, 'encommande'),
(17567443, 2, '2023-06-11', 20000, 'encommande'),
(18946205, 1, '2023-06-08', 200, 'encommande'),
(19161503, 1, '2023-06-08', 200, 'encommande'),
(30658405, 1, '2023-06-08', 200, 'encommande'),
(33062991, 1, '2023-06-08', 200, 'encommande'),
(33724245, 1, '2023-06-08', 200, 'encommande'),
(46840409, 1, '2023-06-08', 66000, 'encommande'),
(56207069, 1, '2023-06-08', 200, 'encommande'),
(56207071, 1, '2023-06-08', 200, 'encommande'),
(56207072, 1, '2023-06-08', 200, 'encommande'),
(76652071, 1, '2023-06-09', 2401, 'encommande'),
(84310615, 1, '2023-06-08', 200, 'encommande'),
(88748160, 1, '2023-06-08', 20000, 'encommande'),
(153292027, 1, '2023-06-08', 200, 'encommande'),
(153292028, 1, '2023-06-15', 1000, 'encommande');

-- --------------------------------------------------------

--
-- Table structure for table `lignecommande`
--

CREATE TABLE `lignecommande` (
  `id_lignecommande` int(11) NOT NULL,
  `id_command` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `qte_commande` int(11) DEFAULT NULL,
  `prix` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lignecommande`
--

INSERT INTO `lignecommande` (`id_lignecommande`, `id_command`, `id_produit`, `qte_commande`, `prix`) VALUES
(45089, 12775489, 16856472, 12, 2400),
(51724, 17567443, 16856472, 100, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id_produit` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `id_photo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id_produit`, `photo`, `id_photo`) VALUES
(16856472, '81y87wRsCLL._AC_SL1500_.jpg', 1),
(16856472, '71y87QFHegL._AC_UY218_.jpg', 2),
(16856472, '71jPVsA3jeL._AC_SL1500_.jpg', 3),
(16856472, '71et9QH+zaL._AC_SL1500_.jpg', 4),
(16856472, '1686191203168600462381y87wRsCLL._AC_SL1500_.jpg\n', 10);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `ref_produit` varchar(255) NOT NULL,
  `design` varchar(255) NOT NULL,
  `cat` varchar(200) NOT NULL,
  `prix_u` float NOT NULL,
  `quantite` int(11) NOT NULL,
  `etat` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `photo` text NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `ref_produit`, `design`, `cat`, `prix_u`, `quantite`, `etat`, `detail`, `photo`, `name`) VALUES
(16856472, '1002001', 'Keyboard Gaming, Mechanial USB-C to A Wired Mechanical                        ', 'pc & accessories', 200, 100, 'true', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                60 Percent Mechanical Gaming Keyboard, Gray&Black Mixed Color Keycaps Gaming Keyboard with Red Switches, Detachable Type-C Cable Mini Keyboard with Powder Blue Light for Windows/Mac/PC/Laptop                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ', '71et9QH+zaL._AC_SL1500_.jpg', 'keyboard');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_command`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD PRIMARY KEY (`id_lignecommande`),
  ADD KEY `id_command` (`id_command`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_command` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153292029;

--
-- AUTO_INCREMENT for table `lignecommande`
--
ALTER TABLE `lignecommande`
  MODIFY `id_lignecommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56408;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Constraints for table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD CONSTRAINT `lignecommande_ibfk_1` FOREIGN KEY (`id_command`) REFERENCES `commande` (`id_command`),
  ADD CONSTRAINT `lignecommande_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
