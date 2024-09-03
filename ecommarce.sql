-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Agu 2024 pada 04.22
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommarce`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `caraousel`
--

CREATE TABLE `caraousel` (
  `id_caraousel` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `caraousel`
--

INSERT INTO `caraousel` (`id_caraousel`, `judul`, `foto`) VALUES
(18, 'tes', '20240529023547.jpg'),
(20, 'tes2', '20240529023944.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_invoice`
--

CREATE TABLE `detail_invoice` (
  `id_bayar` int(11) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `metode_pembayaran` enum('BRI','BNI','Mandiri','GOPAY','Dana') NOT NULL,
  `metode_pengiriman` enum('JNT','JNE','POS Indonesia','GOJEK') NOT NULL,
  `bukti_pembayaran` varchar(50) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_invoice`
--

INSERT INTO `detail_invoice` (`id_bayar`, `no_telp`, `metode_pembayaran`, `metode_pengiriman`, `bukti_pembayaran`, `id_invoice`, `id_produk`, `nama_produk`, `jumlah`, `harga`) VALUES
(5, '081225551061', 'BRI', 'JNE', '20240603104244.jpg', 6, 6, 'Sepatu', 3, 2000000),
(6, '081225551061', 'BRI', 'JNE', '20240604044235.jpg', 7, 4, 'Celana', 1, 200000),
(7, '081225551061', 'BRI', 'JNE', '20240604044812.jpg', 8, 4, 'Celana', 1, 200000),
(8, '081225551061', 'BRI', 'JNE', '20240604065816.jpg', 9, 5, 'Baju', 1, 14000),
(9, '081225551061', 'BRI', 'JNE', '20240604065816.jpg', 9, 4, 'Celana', 1, 200000),
(10, '081225551061', 'BNI', 'JNT', '20240604072147.jpg', 10, 4, 'Celana', 1, 200000),
(11, '5687967', 'BRI', 'JNE', '20240604210229.jpg', 11, 5, 'Baju', 1, 14000),
(12, '5687967', 'BRI', 'JNE', '20240604210229.jpg', 11, 6, 'Sepatu', 1, 2000000);

--
-- Trigger `detail_invoice`
--
DELIMITER $$
CREATE TRIGGER `pesanan` AFTER INSERT ON `detail_invoice` FOR EACH ROW BEGIN
  UPDATE produk SET stok = stok-NEW.jumlah
  WHERE id_produk = NEW.id_produk;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgl_pesanan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `nama`, `alamat`, `tgl_pesanan`) VALUES
(1, 'abidd', 'Kaling', '2024-06-03'),
(2, 'abidd', 'Kaling', '2024-06-03'),
(3, 'abidd', 'Kaling', '2024-06-03'),
(4, 'abid', 'Getasan, Kaling', '2024-06-03'),
(5, 'abid', 'Getasan, Kaling', '2024-06-03'),
(6, 'abidd', 'Kaling', '2024-06-03'),
(7, 'rino', 'Getasan, Kaling', '2024-06-04'),
(8, 'abid', 'Getasan, Kaling', '2024-06-04'),
(9, 'abidd', 'Getasan, Kaling, c', '2024-06-04'),
(10, 'nok', 'Getasan, Kaling', '2024-06-04'),
(11, 'dada', 'adadda', '2024-06-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(30) NOT NULL,
  `kategori` enum('Baju','Celana','Sepatu') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `keterangan`, `harga`, `stok`, `tanggal`, `gambar`, `kategori`) VALUES
(4, 'Celana', 'Panjang', 2000000, 9, '2024-05-28', '20240528151218.jpg', 'Celana'),
(5, 'Baju', 'pandek', 14000, 11, '2024-05-29', '20240529024736.jpg', 'Baju'),
(6, 'Sepatu', 'sdcac', 2000000, 0, '2024-05-29', '20240529025742.jpg', 'Sepatu'),
(7, 'Celana', 'pendek', 1000000, 31, '2024-05-29', '20240529025820.jpg', 'Celana'),
(8, 'BAJU BATIK ', 'PANJANG', 200000, 21, '2024-06-03', '20240603232637.jpg', 'Baju');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tipe_user` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `tipe_user`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'Abid', 'admin'),
(2, 'user', '202cb962ac59075b964b07152d234b70', 'rino', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `caraousel`
--
ALTER TABLE `caraousel`
  ADD PRIMARY KEY (`id_caraousel`);

--
-- Indeks untuk tabel `detail_invoice`
--
ALTER TABLE `detail_invoice`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `caraousel`
--
ALTER TABLE `caraousel`
  MODIFY `id_caraousel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `detail_invoice`
--
ALTER TABLE `detail_invoice`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
