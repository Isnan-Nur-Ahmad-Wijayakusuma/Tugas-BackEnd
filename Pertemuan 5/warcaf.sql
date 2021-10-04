-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Okt 2021 pada 09.07
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warcaf`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `ID_MASTER` int(11) NOT NULL,
  `Name` varchar(10) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ID_MASTER`, `Name`, `Username`, `Pass`) VALUES
(2, 'admin', 'Admin', '$2y$10$MzFH4sJ1kkcQuNGuStncjem7isFkVW2t4TMOwU3idt3n.Wshl/uz6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `Kode_Pay` int(10) NOT NULL,
  `Kode_Order` int(11) NOT NULL,
  `id_Pembeli` int(11) NOT NULL,
  `id_Penjual` int(11) NOT NULL,
  `Id_produk` varchar(10) NOT NULL,
  `Jenis` varchar(120) NOT NULL,
  `Tgl_Bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id_Pembeli` int(11) NOT NULL,
  `Nama` varchar(40) DEFAULT NULL,
  `Gender` varchar(2) DEFAULT NULL,
  `Email` varchar(30) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `Tlp` char(13) DEFAULT NULL,
  `K_Pos` int(5) DEFAULT NULL,
  `Jln` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id_Pembeli`, `Nama`, `Gender`, `Email`, `Username`, `Pass`, `Tlp`, `K_Pos`, `Jln`) VALUES
(12, 'sasasa', 'P', 'qwdq@dai', 'susugii77', '$2y$10$GNTMwC5fdsm/1aTWLPqWd.J9DEAQ3Ph/Pdo3uA1idDJxI8RX.PzaG', '087652837461', 54653, 'anggrek');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `Kode_Order` int(11) NOT NULL,
  `id_Pembeli` int(11) NOT NULL,
  `id_Penjual` int(11) NOT NULL,
  `id_Produk` varchar(10) NOT NULL,
  `Jumlah_Total` int(5) DEFAULT NULL,
  `Harga_Total` bigint(20) DEFAULT NULL,
  `K_Pos` int(5) DEFAULT NULL,
  `Jln` varchar(20) DEFAULT NULL,
  `Tgl_pesan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjual`
--

CREATE TABLE `penjual` (
  `id_Penjual` int(16) NOT NULL,
  `Nama_Pemilik` varchar(40) DEFAULT NULL,
  `Nama_Toko` varchar(50) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Username` varchar(15) DEFAULT NULL,
  `Pass` varchar(255) DEFAULT NULL,
  `Tlp` char(13) DEFAULT NULL,
  `K_Pos` int(5) DEFAULT NULL,
  `Jln` varchar(20) DEFAULT NULL,
  `Gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjual`
--

INSERT INTO `penjual` (`id_Penjual`, `Nama_Pemilik`, `Nama_Toko`, `Email`, `Username`, `Pass`, `Tlp`, `K_Pos`, `Jln`, `Gambar`) VALUES
(15, 'asd', 'manisan keju', 'sugiono99@gmail.com', 'AhmadUN', '$2y$10$sH08W2GunhEGIM08tWP5NuWY4Wviih8KorGk0DE7.e2Fl89QpPiC.', '123456789012', 54653, 'asd', ''),
(16, 'susu', 'sasa', 'sasa2@ff.com', 'kigkong', '$2y$10$LNKIvlD3PfmyPx8xyn0cVOS2eNTLIB4ZkzNntSjn/X0jsKTIX.MNK', '123482560987', 12345, 'anggrekk', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_Produk` varchar(10) NOT NULL,
  `id_Penjual` int(11) NOT NULL,
  `Nama` varchar(30) DEFAULT NULL,
  `Jenis` varchar(120) DEFAULT NULL,
  `Jumlah` int(4) DEFAULT NULL,
  `Harga` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_MASTER`);

--
-- Indeks untuk tabel `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`Kode_Pay`),
  ADD KEY `Id_produk` (`Id_produk`),
  ADD KEY `Kode_Order` (`Kode_Order`),
  ADD KEY `id_Pembeli` (`id_Pembeli`),
  ADD KEY `id_Penjual` (`id_Penjual`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_Pembeli`),
  ADD KEY `Nama` (`Nama`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`Kode_Order`),
  ADD KEY `ID_Produk` (`id_Produk`),
  ADD KEY `id_Pembeli` (`id_Pembeli`),
  ADD KEY `id_Penjual` (`id_Penjual`);

--
-- Indeks untuk tabel `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id_Penjual`) USING BTREE;

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_Produk`),
  ADD KEY `id_Penjual` (`id_Penjual`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_MASTER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `Kode_Pay` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_Pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `Kode_Order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penjual`
--
ALTER TABLE `penjual`
  MODIFY `id_Penjual` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD CONSTRAINT `jenis_transaksi_ibfk_1` FOREIGN KEY (`id_Pembeli`) REFERENCES `pemesanan` (`id_Pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jenis_transaksi_ibfk_2` FOREIGN KEY (`Kode_Order`) REFERENCES `pemesanan` (`Kode_Order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jenis_transaksi_ibfk_3` FOREIGN KEY (`Id_produk`) REFERENCES `pemesanan` (`id_Produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jenis_transaksi_ibfk_4` FOREIGN KEY (`id_Penjual`) REFERENCES `pemesanan` (`id_Penjual`);

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_Pembeli`) REFERENCES `pembeli` (`id_Pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_3` FOREIGN KEY (`id_Penjual`) REFERENCES `produk` (`id_Penjual`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_4` FOREIGN KEY (`id_Produk`) REFERENCES `produk` (`id_Produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_Penjual`) REFERENCES `penjual` (`id_Penjual`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
