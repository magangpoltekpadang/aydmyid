-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 28 Apr 2025 pada 05.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usaha1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_layanan` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `tanggal_feedback` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id`, `id_pelanggan`, `id_layanan`, `rating`, `komentar`, `tanggal_feedback`) VALUES
(1, 1, 1, 5, 'layanan nya bagus', '2025-04-27 17:00:00'),
(3, 2, 2, 5, 'memuaskan', '2025-04-27 17:00:00'),
(4, 1, 1, 5, 'baguus', '2025-04-28 01:46:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
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
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id`, `nama_layanan`, `deskripsi`, `harga`, `durasi`, `created_at`, `updated_at`) VALUES
(1, 'Cuci Mobil Reguler', 'Pencucian mobil biasa', 50000.00, 60, '2025-04-27 17:26:15', '2025-04-27 17:26:15'),
(2, 'Cuci Mobil Premium', 'Pencucian + Wax + Interior', 100000.00, 90, '2025-04-27 17:26:15', '2025-04-27 17:26:15'),
(3, 'Salon Mobil Lengkap', 'Paket salon mobil full', 300000.00, 180, '2025-04-27 17:26:15', '2025-04-27 17:26:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `membership`
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
-- Dumping data untuk tabel `membership`
--

INSERT INTO `membership` (`id`, `nama_paket`, `harga`, `jumlah_cuci`, `masa_berlaku`, `created_at`, `updated_at`) VALUES
(1, 'Silver', 200000.00, 5, 90, '2025-04-27 17:26:06', '2025-04-27 17:26:06'),
(2, 'Gold', 350000.00, 10, 180, '2025-04-27 17:26:06', '2025-04-27 17:26:06'),
(3, 'Platinum', 500000.00, 20, 365, '2025-04-27 17:26:06', '2025-04-27 17:26:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id` int(11) NOT NULL,
  `nama_metode` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`id`, `nama_metode`, `created_at`, `updated_at`) VALUES
(1, 'Cash', '2025-04-27 17:26:27', '2025-04-27 17:26:27'),
(2, 'Transfer Bank', '2025-04-27 17:26:27', '2025-04-27 17:26:27'),
(3, 'QRIS', '2025-04-27 17:26:27', '2025-04-27 17:26:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlets`
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
-- Dumping data untuk tabel `outlets`
--

INSERT INTO `outlets` (`id`, `nama_outlet`, `alamat`, `kota`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'Outlet Utama', 'Jl. Kebangsaan No.1', 'Padang', '081234567890', '2025-04-27 17:26:01', '2025-04-27 17:26:01'),
(2, 'Outlet Cabang', 'Jl. Melati No.2', 'Bukittinggi', '081298765432', '2025-04-27 17:26:01', '2025-04-27 17:26:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
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
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `no_hp`, `plat_nomor`, `id_membership`, `created_at`, `updated_at`) VALUES
(1, 'Ayunda Aulia Rahmi', '082112345678', 'BA1234XY', 1, '2025-04-27 17:26:10', '2025-04-27 17:36:22'),
(2, 'Lili Nur Aulia\r\n', '082298765432', 'BA5678YZ', 2, '2025-04-27 17:26:10', '2025-04-27 17:36:30'),
(3, 'Syifa Rufaida Hadi', '081276543210', 'BA4321XZ', NULL, '2025-04-27 17:26:10', '2025-04-27 17:36:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_transaksi`
--

CREATE TABLE `status_transaksi` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_transaksi`
--

INSERT INTO `status_transaksi` (`id`, `nama_status`, `created_at`, `updated_at`) VALUES
(1, 'Menunggu Pembayaran', '2025-04-27 17:26:31', '2025-04-27 17:26:31'),
(2, 'Diproses', '2025-04-27 17:26:31', '2025-04-27 17:26:31'),
(3, 'Selesai', '2025-04-27 17:26:31', '2025-04-27 17:26:31'),
(4, 'Dibatalkan', '2025-04-27 17:26:31', '2025-04-27 17:26:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_outlet` int(11) DEFAULT NULL,
  `id_metode_pembayaran` int(11) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `waktu_transaksi` datetime DEFAULT current_timestamp(),
  `id_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pelanggan`, `id_outlet`, `id_metode_pembayaran`, `total_harga`, `waktu_transaksi`, `id_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0.00, '2025-04-28 00:26:55', 1, '2025-04-27 17:26:55', '2025-04-27 17:26:55'),
(2, 2, 1, 2, 0.00, '2025-04-28 00:26:55', 1, '2025-04-27 17:26:55', '2025-04-27 17:26:55'),
(3, 3, 2, 3, 0.00, '2025-04-28 00:26:55', 1, '2025-04-27 17:26:55', '2025-04-27 17:26:55');

--
-- Trigger `transaksi`
--
DELIMITER $$
CREATE TRIGGER `after_transaksi_insert` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
    -- Menyisipkan data ke historis_layanan setelah transaksi baru
    DECLARE v_total DECIMAL(10,2);

    -- Menghitung total untuk layanan yang dimasukkan dalam transaksi
    SET v_total = NEW.total_harga;

    -- Menyisipkan data ke tabel historis_layanan
    INSERT INTO historis_layanan (id_pelanggan, id_layanan, tanggal_layanan, jumlah_layanan, harga, total)
    SELECT NEW.id_pelanggan, id_layanan, CURRENT_DATE, qty, harga, v_total
    FROM transaksi_layanan
    WHERE id_transaksi = NEW.id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_layanan`
--

CREATE TABLE `transaksi_layanan` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_layanan` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT 1,
  `harga` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_layanan`
--

INSERT INTO `transaksi_layanan` (`id`, `id_transaksi`, `id_layanan`, `qty`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 50000.00, '2025-04-27 17:27:18', '2025-04-27 17:27:18'),
(2, 1, 2, 1, 100000.00, '2025-04-27 17:27:18', '2025-04-27 17:27:18'),
(3, 2, 3, 1, 300000.00, '2025-04-27 17:27:18', '2025-04-27 17:27:18'),
(4, 3, 1, 1, 50000.00, '2025-04-27 17:27:18', '2025-04-27 17:27:18'),
(6, 1, 2, 3, 300000.00, '2025-04-27 17:53:17', '2025-04-27 17:53:17');

--
-- Trigger `transaksi_layanan`
--
DELIMITER $$
CREATE TRIGGER `before_insert_transaksi_layanan` BEFORE INSERT ON `transaksi_layanan` FOR EACH ROW BEGIN
    -- Mengambil harga dari tabel layanan berdasarkan id_layanan
    DECLARE harga_layanan DECIMAL(10,2);
    
    -- Mengambil harga layanan dari tabel layanan
    SELECT harga INTO harga_layanan
    FROM layanan
    WHERE id = NEW.id_layanan;
    
    -- Menghitung harga berdasarkan jumlah layanan dan harga layanan
    SET NEW.harga = harga_layanan * NEW.qty;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_metode` (`nama_metode`);

--
-- Indeks untuk tabel `outlets`
--
ALTER TABLE `outlets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_membership` (`id_membership`);

--
-- Indeks untuk tabel `status_transaksi`
--
ALTER TABLE `status_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_status` (`nama_status`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_outlet` (`id_outlet`),
  ADD KEY `id_metode_pembayaran` (`id_metode_pembayaran`),
  ADD KEY `id_status` (`id_status`);

--
-- Indeks untuk tabel `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `outlets`
--
ALTER TABLE `outlets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `status_transaksi`
--
ALTER TABLE `status_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id`);

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_membership`) REFERENCES `membership` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_outlet`) REFERENCES `outlets` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_metode_pembayaran`) REFERENCES `metode_pembayaran` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`id_status`) REFERENCES `status_transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  ADD CONSTRAINT `transaksi_layanan_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_layanan_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
