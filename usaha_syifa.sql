-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 05:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usaha`
--

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama_layanan` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `nama_layanan`, `deskripsi`, `harga`, `durasi`, `created_at`, `updated_at`) VALUES
(1, 'Cuci Express', 'Cuci eksterior cepat', 20000.00, 15, '2025-04-25 15:28:57', '2025-04-25 15:28:57'),
(2, 'Cuci Standar', 'Cuci eksterior dan vacuum interior', 50000.00, 30, '2025-04-25 15:28:57', '2025-04-25 15:28:57'),
(3, 'Cuci Lengkap', 'Cuci eksterior, vacuum interior, dan lap dashboard', 75000.00, 45, '2025-04-25 15:28:57', '2025-04-25 15:28:57'),
(4, 'Cuci + Wax', 'Cuci standar plus wax eksterior', 100000.00, 60, '2025-04-25 15:28:57', '2025-04-25 15:28:57'),
(5, 'Full Treatment', 'Cuci premium, wax, dan perawatan ban', 150000.00, 90, '2025-04-25 15:28:57', '2025-04-25 15:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `jumlah_cuci` int(11) DEFAULT NULL,
  `masa_berlaku` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `nama_paket`, `harga`, `jumlah_cuci`, `masa_berlaku`, `created_at`, `updated_at`) VALUES
(1, 'Silver', 20000.00, 1, 30, '2025-04-25 15:25:28', '2025-04-25 15:25:28'),
(2, 'Biasa', 10000.00, 1, 30, '2025-04-25 15:25:28', '2025-04-25 15:25:28'),
(3, 'Platinum', 40000.00, 1, 30, '2025-04-25 15:25:28', '2025-04-25 15:25:28');

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` int(11) NOT NULL,
  `nama_metode` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `nama_metode`, `created_at`, `updated_at`) VALUES
(1, 'Cash', '2025-04-25 15:37:19', '2025-04-25 15:37:19'),
(2, 'QRIS', '2025-04-25 15:37:19', '2025-04-25 15:37:19'),
(3, 'Transfer', '2025-04-25 15:37:19', '2025-04-25 15:37:19'),
(4, 'E-Wallet', '2025-04-25 15:37:19', '2025-04-25 15:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `outlets`
--

CREATE TABLE `outlets` (
  `id` int(11) NOT NULL,
  `nama_outlet` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outlets`
--

INSERT INTO `outlets` (`id`, `nama_outlet`, `alamat`, `kota`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Jalan Batam 12', 'Batam', '3566665223', '2025-04-25 15:23:40', '2025-04-25 15:23:40'),
(2, 'B', 'Jalan Batam 13', 'Batam', '3566665223', '2025-04-25 15:23:40', '2025-04-25 15:23:40'),
(3, 'C', 'Jalan Batam 14', 'Batam', '3566665223', '2025-04-25 15:23:40', '2025-04-25 15:23:40'),
(4, 'D', 'Jalan Batam 15', 'Batam', '3566665223', '2025-04-25 15:23:40', '2025-04-25 15:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nama_pegawai` varchar(100) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama_pegawai`, `jabatan`) VALUES
(1, 'Andi Pratama', 'Kasir'),
(2, 'Budi Setiawan', 'Operator Cuci'),
(3, 'Citra Lestari', 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `plat_nomor` varchar(20) DEFAULT NULL,
  `id_membership` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `no_hp`, `plat_nomor`, `id_membership`, `created_at`, `updated_at`) VALUES
(1, 'Budi Santoso', '0812345678909', 'B 1234 ACC', 2, '2025-04-25 15:28:21', '2025-04-25 15:28:21'),
(2, 'Ami Wijaya', '0823456789011', 'D 5678 EFG', 3, '2025-04-25 15:28:21', '2025-04-25 15:28:21'),
(3, 'Dodi Pratama', '0845678901231', 'F 3456 KIJ', 1, '2025-04-25 15:28:21', '2025-04-25 15:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `status_transaksi`
--

CREATE TABLE `status_transaksi` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_transaksi`
--

INSERT INTO `status_transaksi` (`id`, `nama_status`, `created_at`, `updated_at`) VALUES
(1, 'Selesai', '2025-04-25 15:20:46', '2025-04-25 15:20:46'),
(2, 'Menunggu', '2025-04-25 15:20:46', '2025-04-25 15:20:46'),
(3, 'Proses', '2025-04-25 15:20:46', '2025-04-25 15:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_layanan` int(11) DEFAULT NULL,
  `id_outlet` int(11) DEFAULT NULL,
  `id_metode_pembayaran` int(11) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `waktu_transaksi` datetime DEFAULT current_timestamp(),
  `id_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pelanggan`, `id_layanan`, `id_outlet`, `id_metode_pembayaran`, `total_harga`, `waktu_transaksi`, `id_status`, `created_at`, `updated_at`, `id_pegawai`) VALUES
(4, 1, 5, 4, 4, 150000.00, '2025-04-25 22:38:33', 1, '2025-04-25 15:38:33', '2025-04-26 13:12:29', 3),
(5, 1, NULL, 1, 2, 150000.00, '2025-04-28 10:47:59', 1, '2025-04-28 03:47:59', '2025-04-28 03:47:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_layanan`
--

CREATE TABLE `transaksi_layanan` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_layanan` int(11) DEFAULT NULL,
  `harga_layanan` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_layanan`
--

INSERT INTO `transaksi_layanan` (`id`, `id_transaksi`, `id_layanan`, `harga_layanan`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 50000.00, '2025-04-28 03:49:21', '2025-04-28 03:49:21'),
(2, 5, 2, 100000.00, '2025-04-28 03:49:21', '2025-04-28 03:49:21');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_total_transaksi`
-- (See below for the actual view)
--
CREATE TABLE `view_total_transaksi` (
`id_transaksi` int(11)
,`id_pelanggan` int(11)
,`id_outlet` int(11)
,`waktu_transaksi` datetime
,`id_status` int(11)
,`total_harga` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Structure for view `view_total_transaksi`
--
DROP TABLE IF EXISTS `view_total_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `view_total_transaksi`  AS SELECT `t`.`id` AS `id_transaksi`, `t`.`id_pelanggan` AS `id_pelanggan`, `t`.`id_outlet` AS `id_outlet`, `t`.`waktu_transaksi` AS `waktu_transaksi`, `t`.`id_status` AS `id_status`, sum(`tl`.`harga_layanan`) AS `total_harga` FROM (`transaksi` `t` join `transaksi_layanan` `tl` on(`t`.`id` = `tl`.`id_transaksi`)) GROUP BY `t`.`id`, `t`.`id_pelanggan`, `t`.`id_outlet`, `t`.`waktu_transaksi`, `t`.`id_status` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_metode` (`nama_metode`);

--
-- Indexes for table `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_membership` (`id_membership`);

--
-- Indexes for table `status_transaksi`
--
ALTER TABLE `status_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_status` (`nama_status`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_layanan` (`id_layanan`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_metode_pembayaran` (`id_metode_pembayaran`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_transaksi`
--
ALTER TABLE `status_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_membership`) REFERENCES `membership` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_outlet`) REFERENCES `outlets` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_metode_pembayaran`) REFERENCES `metode_pembayaran` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`id_status`) REFERENCES `status_transaksi` (`id`);

--
-- Constraints for table `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  ADD CONSTRAINT `transaksi_layanan_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_layanan_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
