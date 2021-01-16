-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2021 pada 09.41
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybisnis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `b_purchase`
--

CREATE TABLE `b_purchase` (
  `purchase_id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(200) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `jumlah` int(10) NOT NULL,
  `qty` int(10) NOT NULL DEFAULT 0,
  `harga` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `b_purchase`
--

INSERT INTO `b_purchase` (`purchase_id`, `bahan_id`, `type`, `detail`, `supplier_id`, `jumlah`, `qty`, `harga`, `tanggal`, `created`, `user_id`) VALUES
(50, 15, 'in', 'Beli', 1, 454, 1, 80000, '2021-01-15', '2021-01-15 20:45:43', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `b_stock`
--

CREATE TABLE `b_stock` (
  `bahan_id` int(11) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `j_bahan_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `total_harga` int(11) NOT NULL DEFAULT 0,
  `stock` int(10) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `b_stock`
--

INSERT INTO `b_stock` (`bahan_id`, `nama`, `j_bahan_id`, `satuan_id`, `harga`, `total_harga`, `stock`, `created`, `modified`) VALUES
(13, 'Tepung kunci', 9, 1, 0, 0, 0, '2021-01-07 11:30:26', NULL),
(15, 'Butter anchor', 3, 1, 177, 23328, 132, '2021-01-07 11:31:16', NULL),
(16, 'Susu bubuk', 2, 1, 0, 0, 0, '2021-01-07 11:31:32', NULL),
(17, 'Santan kara cair', 13, 10, 0, 0, 0, '2021-01-07 11:32:16', '2021-01-07 05:32:51'),
(18, 'Tepung sagu', 9, 1, 0, 0, 0, '2021-01-07 11:33:08', NULL),
(19, 'Telur ayam biasa', 8, 9, 0, 0, 0, '2021-01-07 11:33:38', '2021-01-15 10:33:40'),
(20, 'Telur ayam omega', 8, 9, 0, 0, 0, '2021-01-07 11:33:52', NULL),
(21, 'Telur ayam kampung', 8, 9, 0, 0, 0, '2021-01-07 11:34:06', NULL),
(22, 'Susu kental manis', 2, 1, 0, 0, 0, '2021-01-07 11:34:21', NULL),
(23, 'Minyak goreng', 16, 3, 0, 0, 0, '2021-01-07 11:34:58', NULL),
(28, 'Keju Prochiz', 1, 1, 0, 0, 0, '2021-01-07 13:32:23', NULL),
(29, 'Toples Nastar', 6, 8, 0, 0, 0, '2021-01-14 19:06:48', NULL),
(30, 'Toples Sagu Keju', 6, 8, 0, 0, 0, '2021-01-14 19:06:58', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`customer_id`, `nama`, `gender`, `telepon`, `alamat`, `created`, `modified`) VALUES
(5, 'Kak rani', 'P', '09876543212', 'Gkn manado', '2021-01-07 11:20:16', '2021-01-15 14:01:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `producer`
--

CREATE TABLE `producer` (
  `producer_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `producer`
--

INSERT INTO `producer` (`producer_id`, `nama`, `lokasi`, `telepon`, `deskripsi`) VALUES
(8, 'Anisa', 'Tangerang', '085240929800', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_production`
--

CREATE TABLE `p_production` (
  `produksi_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` text NOT NULL,
  `producer_id` int(11) DEFAULT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `transin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `p_production`
--

INSERT INTO `p_production` (`produksi_id`, `produk_id`, `type`, `detail`, `producer_id`, `jumlah`, `tanggal`, `created`, `user_id`, `transin_id`) VALUES
(45, 13, 'in', 'nas', 8, 5, '2021-01-15', '2021-01-15 20:49:45', 1, 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `p_stock`
--

CREATE TABLE `p_stock` (
  `produk_id` int(11) NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `j_produk_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT 0,
  `stock` int(10) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `p_stock`
--

INSERT INTO `p_stock` (`produk_id`, `barcode`, `nama`, `j_produk_id`, `satuan_id`, `harga`, `stock`, `created`, `modified`) VALUES
(14, 'AN0001', 'Pizza', 4, 4, 50000, 0, '2021-01-09 11:17:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_jenis_bahan`
--

CREATE TABLE `r_jenis_bahan` (
  `j_bahan_id` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `r_jenis_bahan`
--

INSERT INTO `r_jenis_bahan` (`j_bahan_id`, `nama`, `created`, `modified`) VALUES
(1, 'Keju', '2020-12-27 13:10:07', NULL),
(2, 'Susu', '2020-12-27 13:41:30', NULL),
(3, 'Butter', '2020-12-27 13:41:35', NULL),
(4, 'Mentega', '2020-12-27 13:41:41', NULL),
(6, 'Toples', '2020-12-27 14:03:40', NULL),
(8, 'Telur', '2021-01-07 11:22:50', NULL),
(9, 'Tepung', '2021-01-07 11:23:00', NULL),
(10, 'Gula', '2021-01-07 11:23:13', NULL),
(13, 'Santan', '2021-01-07 11:23:45', NULL),
(14, 'Buah', '2021-01-07 11:23:49', NULL),
(15, 'Kayu manis', '2021-01-07 11:23:56', NULL),
(16, 'Minyak', '2021-01-07 11:34:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_jenis_produk`
--

CREATE TABLE `r_jenis_produk` (
  `j_produk_id` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `r_jenis_produk`
--

INSERT INTO `r_jenis_produk` (`j_produk_id`, `nama`, `created`, `modified`) VALUES
(1, 'Kue Kering', '2020-12-27 13:24:23', '2020-12-27 07:41:04'),
(2, 'Kue Basah', '2020-12-27 13:41:11', NULL),
(3, 'Kopi', '2020-12-27 13:41:18', '2020-12-27 07:59:29'),
(4, 'Makanan', '2021-01-07 11:26:48', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `r_satuan`
--

CREATE TABLE `r_satuan` (
  `satuan_id` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `r_satuan`
--

INSERT INTO `r_satuan` (`satuan_id`, `nama`, `created`, `modified`) VALUES
(1, 'Gram', '2020-12-27 14:12:56', '2020-12-29 07:02:12'),
(2, 'Kilogram', '2020-12-27 14:13:06', '2020-12-29 07:02:21'),
(3, 'Liter', '2020-12-27 14:13:11', '2020-12-29 07:02:25'),
(4, 'Pack', '2020-12-27 14:13:15', '2020-12-29 07:02:30'),
(5, 'Buah', '2020-12-27 14:13:23', '2020-12-29 07:02:35'),
(8, 'Toples', '2020-12-29 13:02:08', NULL),
(9, 'Butir', '2020-12-29 13:02:40', NULL),
(10, 'Mililiter', '2021-01-07 11:32:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `lokasi_toko` varchar(200) NOT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `nama_toko`, `lokasi_toko`, `telepon`, `deskripsi`) VALUES
(1, 'Gula-Gula', 'Ruko Banjar Wijaya Azores', '081112231', NULL),
(8, 'Prima', 'Banjar wijaya', NULL, NULL),
(9, 'Cinnamon', 'Ruko azores banjar wijaya', NULL, NULL),
(10, 'Alfamart', 'Banjar', NULL, NULL),
(11, 'Shopee', 'Online', NULL, NULL),
(12, 'Indomaret', 'Banjar', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_in`
--

CREATE TABLE `trans_in` (
  `transin_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `producer_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trans_in`
--

INSERT INTO `trans_in` (`transin_id`, `invoice`, `producer_id`, `total_price`, `catatan`, `tanggal`, `user_id`, `created`) VALUES
(34, 'PROD1501210001', 8, 176, 'aaa', '2021-01-15', 1, '2021-01-15 21:18:01'),
(35, 'PROD1501210002', 8, 176, 'asdasdsa', '2021-01-15', 1, '2021-01-15 21:41:13'),
(36, 'PROD1501210003', 8, 176, '2312312', '2021-01-15', 1, '2021-01-15 21:41:23'),
(37, 'PROD1501210004', 8, 7744, '4', '2021-01-15', 1, '2021-01-15 21:41:34'),
(38, 'PROD1501210005', 8, 880, 'h', '2021-01-15', 1, '2021-01-15 21:42:06'),
(39, 'PROD1501210006', 8, 176, '', '2021-01-15', 1, '2021-01-15 21:42:22'),
(40, 'PROD1501210007', 8, 176, '', '2021-01-15', 1, '2021-01-15 21:42:36'),
(41, 'PROD1501210008', 8, 1056, '', '2021-01-15', 1, '2021-01-15 21:42:51'),
(42, 'PROD1501210009', 8, 13552, 'hhh', '2021-01-15', 1, '2021-01-15 21:43:06'),
(43, 'PROD1501210010', 8, 1408, '', '2021-01-15', 1, '2021-01-15 21:43:18'),
(44, 'PROD1501210011', 8, 31152, '', '2021-01-15', 1, '2021-01-15 21:43:38');

--
-- Trigger `trans_in`
--
DELIMITER $$
CREATE TRIGGER `del_detail` AFTER DELETE ON `trans_in` FOR EACH ROW BEGIN
	DELETE FROM trans_in_detail
    WHERE transin_id = OLD.transin_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_in_cart`
--

CREATE TABLE `trans_in_cart` (
  `incart_id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_in_detail`
--

CREATE TABLE `trans_in_detail` (
  `indetail_id` int(11) NOT NULL,
  `transin_id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trans_in_detail`
--

INSERT INTO `trans_in_detail` (`indetail_id`, `transin_id`, `bahan_id`, `harga`, `jumlah`, `total`) VALUES
(41, 34, 15, 176, 1, 176),
(42, 35, 15, 176, 1, 176),
(43, 36, 15, 176, 1, 176),
(44, 37, 15, 176, 44, 7744),
(45, 38, 15, 176, 5, 880),
(46, 39, 15, 176, 1, 176),
(47, 40, 15, 176, 1, 176),
(48, 41, 15, 176, 6, 1056),
(49, 42, 15, 176, 77, 13552),
(50, 43, 15, 176, 8, 1408),
(51, 44, 15, 176, 177, 31152);

--
-- Trigger `trans_in_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `trans_in_detail` FOR EACH ROW BEGIN
	UPDATE b_stock SET stock = stock - NEW.jumlah
    WHERE bahan_id = NEW.bahan_id;
    UPDATE b_stock SET total_harga = total_harga - NEW.total
    WHERE bahan_id = NEW.bahan_id;
    UPDATE b_stock SET harga = total_harga / stock
    WHERE bahan_id = NEW.bahan_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_return` AFTER DELETE ON `trans_in_detail` FOR EACH ROW BEGIN
	UPDATE b_stock SET stock = stock + OLD.jumlah
    WHERE bahan_id = OLD.bahan_id;
    UPDATE b_stock SET total_harga = total_harga + OLD.total
    WHERE bahan_id = OLD.bahan_id;
    UPDATE b_stock SET harga = total_harga / stock
    WHERE bahan_id = OLD.bahan_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_out`
--

CREATE TABLE `trans_out` (
  `transout_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `final_price` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `remain` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `trans_out`
--
DELIMITER $$
CREATE TRIGGER `del_detail2` AFTER DELETE ON `trans_out` FOR EACH ROW BEGIN
	DELETE FROM t_out_detail
    WHERE transout_id = OLD.transout_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_out_cart`
--

CREATE TABLE `trans_out_cart` (
  `outcart_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `diskon_item` int(11) DEFAULT 0,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_out_detail`
--

CREATE TABLE `t_out_detail` (
  `outdetail_id` int(11) NOT NULL,
  `transout_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `diskon_item` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_out_detail`
--

INSERT INTO `t_out_detail` (`outdetail_id`, `transout_id`, `produk_id`, `harga`, `jumlah`, `diskon_item`, `total`) VALUES
(51, 16, 13, 70000, 1, 0, 70000);

--
-- Trigger `t_out_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_min2` AFTER INSERT ON `t_out_detail` FOR EACH ROW BEGIN
	UPDATE p_stock SET stock = stock - NEW.jumlah
    WHERE produk_id = NEW.produk_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_return2` AFTER DELETE ON `t_out_detail` FOR EACH ROW BEGIN
	UPDATE p_stock SET stock = stock + OLD.jumlah
    WHERE produk_id = OLD.produk_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kewenangan` int(1) NOT NULL COMMENT '1:admin, 2:kasir, 3:tukang_kue',
  `nomor_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `nama`, `kewenangan`, `nomor_hp`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Ricaldi Farshall', 0, '08121232904'),
(2, 'kasir1', '874c0ac75f323057fe3b7fb3f5a8a41df2b94b1d', 'Ical', 2, '08111571692'),
(3, 'tukangkue1', '117212a1e4e632955446c16084bce1a427dc7536', 'Caldi', 3, '12312312'),
(8, 'anisa', '812c40f10bdd1b301c34552f5cf7109e0d814d45', 'Anisa Yulianti', 1, '085240929800');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `b_purchase`
--
ALTER TABLE `b_purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `b_purchase_ibfk_1` (`bahan_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `b_stock`
--
ALTER TABLE `b_stock`
  ADD PRIMARY KEY (`bahan_id`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD KEY `j_bahan_id` (`j_bahan_id`),
  ADD KEY `satuan_id` (`satuan_id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `producer`
--
ALTER TABLE `producer`
  ADD PRIMARY KEY (`producer_id`);

--
-- Indeks untuk tabel `p_production`
--
ALTER TABLE `p_production`
  ADD PRIMARY KEY (`produksi_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `producer_id` (`producer_id`),
  ADD KEY `transin_id` (`transin_id`);

--
-- Indeks untuk tabel `p_stock`
--
ALTER TABLE `p_stock`
  ADD PRIMARY KEY (`produk_id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `j_produk_id` (`j_produk_id`),
  ADD KEY `satuan_id` (`satuan_id`);

--
-- Indeks untuk tabel `r_jenis_bahan`
--
ALTER TABLE `r_jenis_bahan`
  ADD PRIMARY KEY (`j_bahan_id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indeks untuk tabel `r_jenis_produk`
--
ALTER TABLE `r_jenis_produk`
  ADD PRIMARY KEY (`j_produk_id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indeks untuk tabel `r_satuan`
--
ALTER TABLE `r_satuan`
  ADD PRIMARY KEY (`satuan_id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indeks untuk tabel `trans_in`
--
ALTER TABLE `trans_in`
  ADD PRIMARY KEY (`transin_id`),
  ADD KEY `producer_id` (`producer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `trans_in_cart`
--
ALTER TABLE `trans_in_cart`
  ADD PRIMARY KEY (`incart_id`),
  ADD KEY `bahan_id` (`bahan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `trans_in_detail`
--
ALTER TABLE `trans_in_detail`
  ADD PRIMARY KEY (`indetail_id`),
  ADD KEY `trans_in_detail_ibfk_1` (`bahan_id`);

--
-- Indeks untuk tabel `trans_out`
--
ALTER TABLE `trans_out`
  ADD PRIMARY KEY (`transout_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `trans_out_cart`
--
ALTER TABLE `trans_out_cart`
  ADD PRIMARY KEY (`outcart_id`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `t_out_detail`
--
ALTER TABLE `t_out_detail`
  ADD PRIMARY KEY (`outdetail_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `b_purchase`
--
ALTER TABLE `b_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `b_stock`
--
ALTER TABLE `b_stock`
  MODIFY `bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `producer`
--
ALTER TABLE `producer`
  MODIFY `producer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `p_production`
--
ALTER TABLE `p_production`
  MODIFY `produksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `p_stock`
--
ALTER TABLE `p_stock`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `r_jenis_bahan`
--
ALTER TABLE `r_jenis_bahan`
  MODIFY `j_bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `r_jenis_produk`
--
ALTER TABLE `r_jenis_produk`
  MODIFY `j_produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `r_satuan`
--
ALTER TABLE `r_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `trans_in`
--
ALTER TABLE `trans_in`
  MODIFY `transin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `trans_in_detail`
--
ALTER TABLE `trans_in_detail`
  MODIFY `indetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `trans_out`
--
ALTER TABLE `trans_out`
  MODIFY `transout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `t_out_detail`
--
ALTER TABLE `t_out_detail`
  MODIFY `outdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `b_purchase`
--
ALTER TABLE `b_purchase`
  ADD CONSTRAINT `b_purchase_ibfk_1` FOREIGN KEY (`bahan_id`) REFERENCES `b_stock` (`bahan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `b_purchase_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `b_purchase_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `b_stock`
--
ALTER TABLE `b_stock`
  ADD CONSTRAINT `b_stock_ibfk_1` FOREIGN KEY (`j_bahan_id`) REFERENCES `r_jenis_bahan` (`j_bahan_id`),
  ADD CONSTRAINT `b_stock_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `r_satuan` (`satuan_id`);

--
-- Ketidakleluasaan untuk tabel `p_stock`
--
ALTER TABLE `p_stock`
  ADD CONSTRAINT `p_stock_ibfk_1` FOREIGN KEY (`j_produk_id`) REFERENCES `r_jenis_produk` (`j_produk_id`),
  ADD CONSTRAINT `p_stock_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `r_satuan` (`satuan_id`);

--
-- Ketidakleluasaan untuk tabel `trans_in`
--
ALTER TABLE `trans_in`
  ADD CONSTRAINT `trans_in_ibfk_1` FOREIGN KEY (`producer_id`) REFERENCES `producer` (`producer_id`),
  ADD CONSTRAINT `trans_in_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ketidakleluasaan untuk tabel `trans_in_cart`
--
ALTER TABLE `trans_in_cart`
  ADD CONSTRAINT `trans_in_cart_ibfk_1` FOREIGN KEY (`bahan_id`) REFERENCES `b_stock` (`bahan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_in_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `trans_in_detail`
--
ALTER TABLE `trans_in_detail`
  ADD CONSTRAINT `trans_in_detail_ibfk_1` FOREIGN KEY (`bahan_id`) REFERENCES `b_stock` (`bahan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `trans_out`
--
ALTER TABLE `trans_out`
  ADD CONSTRAINT `trans_out_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_out_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `trans_out_cart`
--
ALTER TABLE `trans_out_cart`
  ADD CONSTRAINT `trans_out_cart_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `p_stock` (`produk_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_out_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
