-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Bulan Mei 2019 pada 00.34
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_manufacturing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_detail_bom`
--

CREATE TABLE `id_detail_bom` (
  `id_detail_bom` int(11) NOT NULL,
  `id_bom` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty_detail` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `id_detail_bom`
--

INSERT INTO `id_detail_bom` (`id_detail_bom`, `id_bom`, `id_product`, `qty_detail`) VALUES
(1, 1, 1, 1),
(2, 1, 5, 2),
(3, 2, 1, 1),
(4, 2, 4, 1),
(6, 1, 3, 1),
(7, 2, 6, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bom`
--

CREATE TABLE `tb_bom` (
  `id_bom` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty_bom` int(10) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `bom_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_bom`
--

INSERT INTO `tb_bom` (`id_bom`, `id_product`, `qty_bom`, `reference`, `bom_type`) VALUES
(1, 8, 1, '-', 'Manufacture this product'),
(2, 8, 1, '-', 'Manufacture this product');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_manufacturing`
--

CREATE TABLE `tb_manufacturing` (
  `id_manufacturing` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_bom` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `deadline_start` date NOT NULL,
  `source` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_manufacturing`
--

INSERT INTO `tb_manufacturing` (`id_manufacturing`, `id_product`, `id_bom`, `id_user`, `qty`, `deadline_start`, `source`, `status`) VALUES
(5, 8, 1, 1, 1, '2019-05-24', '-', 'Done'),
(9, 8, 1, 1, 1, '0000-00-00', '-', 'In Progress'),
(14, 8, 2, 2, 1, '2019-05-02', '-', 'Confirmed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `id_product` int(11) NOT NULL,
  `id_product_category` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `internal_reference` varchar(50) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `sales_price` int(50) NOT NULL,
  `id_tax` int(11) NOT NULL,
  `cost` int(50) NOT NULL,
  `stok` int(10) NOT NULL,
  `internal_notes` varchar(100) NOT NULL,
  `foto_product` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`id_product`, `id_product_category`, `product_name`, `type`, `internal_reference`, `barcode`, `sales_price`, `id_tax`, `cost`, `stok`, `internal_notes`, `foto_product`) VALUES
(1, 1, 'Polygon helmet orange', 'Storable product', '', '', 400000, 1, 0, 94, '', 'helm.png'),
(2, 1, 'Sadel Selle Marco', 'Storable product', '', '', 300000, 1, 0, 100, '', 'sadel.png'),
(3, 1, 'Sarung tangan nike', 'Storable product', '', '', 200000, 1, 0, 99, '', 'sarungtangan.png'),
(4, 1, 'Stang polygon', 'Storable product', '', '', 600000, 1, 0, 100, '', 'stang.png'),
(5, 1, 'Velg polygon', 'Storable product', '', '', 500000, 1, 0, 84, '', 'velg.png'),
(6, 1, 'Wheel adidas', 'Storable product', '', '', 1200000, 1, 0, 100, '', 'wheel.jpg'),
(8, 2, 'Polygon bicycle', '-', '', '', 20000000, 1, 0, 6, '', 'polygon.png'),
(11, 1, 'Logo bicycle', 'Storable product', '', '', 100000, 1, 0, 100, 'Logo ceks', 'cek.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product_category`
--

CREATE TABLE `tb_product_category` (
  `id_product_category` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_product_category`
--

INSERT INTO `tb_product_category` (`id_product_category`, `category_name`) VALUES
(1, 'Part'),
(2, 'Package');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tax`
--

CREATE TABLE `tb_tax` (
  `id_tax` int(11) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `amount` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tax`
--

INSERT INTO `tb_tax` (`id_tax`, `tax_name`, `amount`) VALUES
(1, 'Ppn', 10),
(2, 'Tax', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `email`, `password`, `phone`, `address`, `level`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin123', 'no', 'no', 1),
(2, 'M Iqbal Firdaus', 'fnfirdaus45@gmail.com', 'firdaus123', '081556772233', 'Jl Puncak cengkeh no 3A', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `id_detail_bom`
--
ALTER TABLE `id_detail_bom`
  ADD PRIMARY KEY (`id_detail_bom`),
  ADD KEY `id_bom` (`id_bom`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `tb_bom`
--
ALTER TABLE `tb_bom`
  ADD PRIMARY KEY (`id_bom`),
  ADD KEY `id_product` (`id_product`);

--
-- Indeks untuk tabel `tb_manufacturing`
--
ALTER TABLE `tb_manufacturing`
  ADD PRIMARY KEY (`id_manufacturing`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_bom` (`id_bom`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_product_category` (`id_product_category`),
  ADD KEY `id_tax` (`id_tax`);

--
-- Indeks untuk tabel `tb_product_category`
--
ALTER TABLE `tb_product_category`
  ADD PRIMARY KEY (`id_product_category`);

--
-- Indeks untuk tabel `tb_tax`
--
ALTER TABLE `tb_tax`
  ADD PRIMARY KEY (`id_tax`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `id_detail_bom`
--
ALTER TABLE `id_detail_bom`
  MODIFY `id_detail_bom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_bom`
--
ALTER TABLE `tb_bom`
  MODIFY `id_bom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_manufacturing`
--
ALTER TABLE `tb_manufacturing`
  MODIFY `id_manufacturing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_product_category`
--
ALTER TABLE `tb_product_category`
  MODIFY `id_product_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_tax`
--
ALTER TABLE `tb_tax`
  MODIFY `id_tax` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `id_detail_bom`
--
ALTER TABLE `id_detail_bom`
  ADD CONSTRAINT `id_detail_bom_ibfk_1` FOREIGN KEY (`id_bom`) REFERENCES `tb_bom` (`id_bom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_detail_bom_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `tb_product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_bom`
--
ALTER TABLE `tb_bom`
  ADD CONSTRAINT `tb_bom_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `tb_product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_manufacturing`
--
ALTER TABLE `tb_manufacturing`
  ADD CONSTRAINT `tb_manufacturing_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `tb_product` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_manufacturing_ibfk_2` FOREIGN KEY (`id_bom`) REFERENCES `tb_bom` (`id_bom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_manufacturing_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD CONSTRAINT `tb_product_ibfk_1` FOREIGN KEY (`id_product_category`) REFERENCES `tb_product_category` (`id_product_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_product_ibfk_2` FOREIGN KEY (`id_tax`) REFERENCES `tb_tax` (`id_tax`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
