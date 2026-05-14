-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2026 at 06:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pustaka_digital`
--

-- --------------------------------------------------------

--
-- Table structure for table `koleksi_buku`
--

CREATE TABLE `koleksi_buku` (
  `id_buku` int(3) NOT NULL,
  `kode_buku` varchar(5) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `stok` int(3) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koleksi_buku`
--

INSERT INTO `koleksi_buku` (`id_buku`, `kode_buku`, `judul`, `pengarang`, `kategori`, `stok`, `status`) VALUES
(1, 'BK001', 'Laskar Pelangi', 'Andrea Hirata', 'Fiksi', 9, 'Tersedia'),
(2, 'BK002', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Sejarah', 6, 'Tersedia'),
(3, 'BK003', 'Fisika Dasar', 'Halliday & Resnick', 'Sains', 1, 'Menipis'),
(4, 'BK004', 'Sejarah Dunia', 'E.H. Gombrich', 'Sejarah', 4, 'Menipis'),
(5, 'BK005', 'Pemrograman PHP', 'Raharjo', 'Teknologi', 11, 'Tersedia'),
(6, 'BK006', 'Algoritma dan Struktur Data', 'Sukamto', 'Teknologi', 25, 'Tersedia'),
(7, 'BK007', 'Negeri 5 Menara', 'Ahmad Fuadi', 'Fiksi', 10, 'Tersedia'),
(10, 'BK008', 'Koala Kumal', 'Raditya Dika', 'Teknologi', 0, 'Habis'),
(11, 'BK009', 'Laut Bercerita', 'Leila S. Chudori', 'Sejarah', 11, 'Tersedia');

--
-- Triggers `koleksi_buku`
--
DELIMITER $$
CREATE TRIGGER `status_buku_insert` BEFORE INSERT ON `koleksi_buku` FOR EACH ROW IF NEW.stok = 0 THEN
    SET NEW.status = 'Habis';
ELSEIF NEW.stok <= 5 THEN
    SET NEW.status = 'Menipis';
ELSE
    SET NEW.status = 'Tersedia';
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `status_buku_update` BEFORE UPDATE ON `koleksi_buku` FOR EACH ROW IF NEW.stok = 0 THEN
    SET NEW.status = 'Habis';
ELSEIF NEW.stok <= 5 THEN
    SET NEW.status = 'Menipis';
ELSE
    SET NEW.status = 'Tersedia';
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(3) NOT NULL,
  `id_buku` int(3) NOT NULL,
  `kode_peminjaman` varchar(5) NOT NULL,
  `peminjam` varchar(50) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_buku`, `kode_peminjaman`, `peminjam`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(7, 1, 'PJ001', 'Wawan Dermawan', '2026-05-01', '2026-05-07', 'Dikembalikan'),
(8, 2, 'PJ002', 'Siti Aminah', '2026-05-02', '2026-05-08', 'Dikembalikan'),
(9, 3, 'PJ003', 'Andi Wijaya', '2026-05-03', '2026-05-09', 'Dikembalikan'),
(10, 4, 'PJ004', 'Dewi Lestari', '2026-05-07', '2026-05-13', 'Dikembalikan'),
(11, 5, 'PJ005', 'Rudi Hartono', '2026-05-09', '2026-05-15', 'Dikembalikan'),
(12, 10, 'PJ006', 'Akma', '2026-05-14', '2026-05-13', 'Dikembalikan'),
(13, 11, 'PJ007', 'Janu', '2026-05-14', '2026-05-20', 'Dipinjam'),
(14, 11, 'PJ008', 'Fitri', '2026-05-14', '2026-05-14', 'Dikembalikan');

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `kembalikan_stok_buku` BEFORE UPDATE ON `peminjaman` FOR EACH ROW BEGIN
IF NEW.status = 'Dikembalikan' THEN
	UPDATE koleksi_buku
    SET stok = stok + 1
    WHERE id_buku = NEW.id_buku;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangi_stok_buku` AFTER INSERT ON `peminjaman` FOR EACH ROW UPDATE koleksi_buku
SET stok = stok - 1
WHERE id_buku = NEW.id_buku
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `koleksi_buku`
--
ALTER TABLE `koleksi_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `fk_peminjaman_buku` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `koleksi_buku`
--
ALTER TABLE `koleksi_buku`
  MODIFY `id_buku` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_peminjaman_buku` FOREIGN KEY (`id_buku`) REFERENCES `koleksi_buku` (`id_buku`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
