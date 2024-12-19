-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Nov 2024 pada 06.21
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tamu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_register`
--

CREATE TABLE `t_register` (
  `id_register` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_register`
--

INSERT INTO `t_register` (`id_register`, `id_user`, `email`, `nomor_telepon`, `alamat`) VALUES
(0, 14, 'admin@gmail.com', '087754543181', 'pancor'),
(0, 15, 'farinda@gmail.com', '087754543181', 'tetebatu'),
(0, 16, 'baligoh14@gmail.com', '087754543181', 'pancor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_tamu`
--

CREATE TABLE `t_tamu` (
  `id` int(3) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `nope` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_tamu`
--

INSERT INTO `t_tamu` (`id`, `tanggal`, `nama`, `alamat`, `tujuan`, `nope`) VALUES
(1, '2024-10-27', 'Husnatun Jamila', 'Labuhan Lombok', 'Membuat surat', 98765432),
(2, '2024-10-28', 'Zulholqi Matin', 'Pancor', 'Rapat', 123456789),
(3, '2024-10-29', 'Taufik Hidayat', 'Keruak', 'Konsultasi', 12345678),
(4, '2024-10-27', 'Lidiya', 'Kalijaga', 'Pertemuan', 645789123),
(5, '2024-10-28', 'Nurul Adila', 'Sakra', 'Pembuatan surat keterangan', 123456789),
(6, '2024-10-28', 'uswatun hasanah', 'dasan lekong', 'berjunjung', 1234567),
(7, '2024-10-28', 'Farinda Asyuro', 'Tetebatu', 'berkunjung', 123456),
(8, '2024-10-31', 'anggi', 'dompu', 'berkunjung', 654789);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `nama_pengguna`, `status`) VALUES
(3, 'admin', '0192023a7bbd73250516f069df18b500', 'husna', 'Aktif'),
(14, 'oki', '$2y$10$4L/E13tHBVs5CJ43DtRyRunOLXyErmVy6UuKrOo8YIBUXOXBBYH/K', 'zulholqi', 'aktif'),
(15, 'inda', '$2y$10$XzD8KjMjTRSVp.e4mSeWS.SPdnzXewoAXcCfpWZpidyLO90UigRhq', 'farindaashuro', 'aktif'),
(16, 'farinda', '$2y$10$YR/bee1k2AV7.qx0iO7hE.HmV0VgC8Tbz/0ne7.kSXDwb7.tddI/G', 'asyhuro', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_register`
--
ALTER TABLE `t_register`
  ADD PRIMARY KEY (`id_register`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `t_tamu`
--
ALTER TABLE `t_tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_tamu`
--
ALTER TABLE `t_tamu`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_register`
--
ALTER TABLE `t_register`
  ADD CONSTRAINT `t_register_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
