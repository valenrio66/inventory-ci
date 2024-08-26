-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 08:21 PM
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
-- Database: `wmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `box`
--

CREATE TABLE `box` (
  `id_box` varchar(11) NOT NULL,
  `id_rak` int(11) NOT NULL,
  `tipe_box` enum('Fast Moving','Medium Moving','Slow Moving','') NOT NULL,
  `kapasitas_tersedia` int(11) NOT NULL,
  `kapasitas_terpakai` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `box`
--

INSERT INTO `box` (`id_box`, `id_rak`, `tipe_box`, `kapasitas_tersedia`, `kapasitas_terpakai`, `created_at`) VALUES
('21FM1', 21, 'Fast Moving', 38402, 18375, '2024-08-03 11:13:03'),
('21FM2', 21, 'Fast Moving', 56777, 0, '2024-08-03 11:19:44'),
('21MM1', 21, 'Medium Moving', 56777, 0, '2024-08-03 11:19:22'),
('21SM1', 21, 'Slow Moving', 56777, 0, '2024-08-03 11:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` int(10) NOT NULL,
  `nama_gudang` varchar(30) NOT NULL,
  `id_kepala` int(11) NOT NULL,
  `level` enum('Bagian','Pusat') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `kapasitas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama_gudang`, `id_kepala`, `level`, `alamat`, `no_hp`, `kapasitas`) VALUES
(2, 'Gudang Pusat', 6, 'Pusat', 'Gudang Pusat', '085269696969', 76425),
(3, 'Gudang Bakauheni', 5, 'Bagian', 'Kabupaten Bakauheni', '08521345678', 119218),
(5, 'Gudang Merak', 6, 'Pusat', 'Pelabuhan Merak', '085213921334', 5000),
(8, 'Gudang Sarijadi', 6, 'Pusat', 'Sarijadi', '085213921334', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman_barang`
--

CREATE TABLE `pengiriman_barang` (
  `id_pengiriman` int(11) NOT NULL,
  `id_produk` varchar(20) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal_pengiriman` datetime NOT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengiriman_barang`
--

INSERT INTO `pengiriman_barang` (`id_pengiriman`, `id_produk`, `jumlah`, `tanggal_pengiriman`, `status`) VALUES
(1, 'D6DL1621FM11', 4, '2024-08-03 00:00:00', 'Approved'),
(2, 'D6DL1621FM11', 1, '2024-08-10 00:00:00', 'Approved'),
(17, 'D6DL1621FM11', 5, '2024-08-20 00:00:00', 'Approved'),
(18, 'D6DL1621FM11', 5, '2024-08-20 00:00:00', 'Pending'),
(19, 'D6DL1621FM11', 5, '2024-08-26 22:44:00', 'Pending'),
(20, 'KTEST121FM11', 5, '2024-08-26 23:30:00', 'Pending'),
(21, 'BBR12321FM11', 10, '2024-08-27 00:01:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `id_box` varchar(11) NOT NULL,
  `klasifikasi_material` enum('Fast Moving','Medium Moving','Slow Moving','') NOT NULL,
  `merk` varchar(50) NOT NULL,
  `jenis_tipe` varchar(20) NOT NULL,
  `serial_number` varchar(20) NOT NULL,
  `kode_material_sap` varchar(20) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `total_stok` int(10) NOT NULL,
  `satuan` enum('PC','SET','PAC','PAA','UN','PCS') NOT NULL,
  `harga_satuan` int(10) NOT NULL,
  `jumlah_harga` int(10) NOT NULL,
  `nomor_urut_gudang` int(10) NOT NULL,
  `dimensi_barang` int(10) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `id_box`, `klasifikasi_material`, `merk`, `jenis_tipe`, `serial_number`, `kode_material_sap`, `jumlah`, `total_stok`, `satuan`, `harga_satuan`, `jumlah_harga`, `nomor_urut_gudang`, `dimensi_barang`, `created_at`) VALUES
('BBR12321FM11', 'Brake', '21FM1', 'Fast Moving', 'Brembo', 'BR123', 'BR123', 'BR123', 190, 200, 'PCS', 80000, 16000000, 21, 125, '2024-08-27 00:00:38'),
('D6DL1621FM11', 'Sparepart Mobil', '21FM1', 'Fast Moving', 'Daihatsu', '6DL16', 'E2024', '22024', 35, 100, 'PC', 6000, 36000, 21, 750, '2024-08-03 19:23:03'),
('KTEST121FM11', 'Shockbreaker', '21FM1', 'Fast Moving', 'KTC', 'TEST123', 'TEST123', 'TEST123', 95, 100, 'SET', 1000000, 100000000, 21, 125, '2024-08-26 23:05:10'),
('MMPX1221FM11', 'Oli', '21FM1', 'Fast Moving', 'MPX', 'MPX123', 'MPX123', 'MPX123', 200, 200, 'PCS', 65000, 13000000, 21, 125, '2024-08-26 23:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id` int(11) NOT NULL,
  `id_gudang` int(10) NOT NULL,
  `kapasitas_fast` int(11) NOT NULL,
  `kapasitas_medium` int(11) NOT NULL,
  `kapasitas_slow` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id`, `id_gudang`, `kapasitas_fast`, `kapasitas_medium`, `kapasitas_slow`, `created_at`) VALUES
(21, 2, 719720, 738095, 738095, '2024-08-03 11:05:25'),
(22, 2, 681318, 681318, 681318, '2024-08-03 11:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` enum('Admin','Gudang Bagian','Gudang Pusat','Super Admin') NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `role`, `email`, `no_hp`) VALUES
(3, 'valenrionald', '$2y$10$D/phgqMcTSEIoeyiX6V2memFuoYWx5O6fip0Kk9qR3eCOss1JhTRO', 'Valen Rionald', 'Admin', 'valenrio@ulbi.ac.id', '0895748974521'),
(4, 'adminadmin1', '$2y$10$DdjjuoBb9WNrbou1D9HpfetMO.LWE96RqFu0NBGpjbmQ8hiKXAeoi', 'Admin', 'Admin', 'admin@gmail.com', '085213921331'),
(5, 'ejaeja1', '$2y$10$MAo529EzAVp0Ke9UTR2USuZK2UWXli7EiGS/FBxv2PwfMz0gTJdGa', 'Eja', 'Gudang Bagian', 'eja@gmail.com', '085213921333'),
(6, 'rezareza1', '$2y$10$6Hd4CEGE66PKXKtdZr/tjezvHRjp43nJn/Q4pBIInooCFEndA1Cii', 'Reza', 'Gudang Pusat', 'reza@gmail.com', '085213921334'),
(7, 'supersuper1', '$2y$10$hUc3lKYIACwf8BwABO52teFRqMqQ9OXNsobfCT36ciAFqVanowuPu', 'Super Admin', 'Super Admin', 'superadmin@gmail.com', '08987654212'),
(9, 'marsel', '$2y$10$iGdjTxpgyDye434ETTWeY.RxCTlaeG4DrIOTC5ZExCSmpFkbLX2iO', 'Marsellino', 'Gudang Pusat', 'marsel@gmail.com', '08965773847647');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `box`
--
ALTER TABLE `box`
  ADD PRIMARY KEY (`id_box`),
  ADD KEY `id_rak` (`id_rak`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`),
  ADD KEY `id_kepala` (`id_kepala`);

--
-- Indexes for table `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_box` (`id_box`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gudang` (`id_gudang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gudang`
--
ALTER TABLE `gudang`
  MODIFY `id_gudang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengiriman_barang`
--
ALTER TABLE `pengiriman_barang`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `box`
--
ALTER TABLE `box`
  ADD CONSTRAINT `box_ibfk_1` FOREIGN KEY (`id_rak`) REFERENCES `rak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gudang`
--
ALTER TABLE `gudang`
  ADD CONSTRAINT `gudang_ibfk_1` FOREIGN KEY (`id_kepala`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_box`) REFERENCES `box` (`id_box`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rak`
--
ALTER TABLE `rak`
  ADD CONSTRAINT `rak_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
