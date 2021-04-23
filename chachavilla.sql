-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2021 pada 00.34
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chachavilla`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admindata`
--

CREATE TABLE `admindata` (
  `primkey_data_admin` int(11) NOT NULL,
  `namapengguna` text CHARACTER SET utf8mb4 NOT NULL,
  `namapanggilan` text CHARACTER SET utf8mb4 NOT NULL,
  `nikktp` text CHARACTER SET utf8mb4 NOT NULL,
  `email` text CHARACTER SET utf8mb4 NOT NULL,
  `idrandom` text CHARACTER SET utf8mb4 NOT NULL,
  `statusakun` text CHARACTER SET utf8mb4 NOT NULL,
  `durasiterkunci` text CHARACTER SET utf8mb4 NOT NULL,
  `typeakun` text CHARACTER SET utf8mb4 NOT NULL,
  `password` text CHARACTER SET utf8mb4 NOT NULL,
  `phonenumber` text CHARACTER SET utf8mb4 NOT NULL,
  `tanggalbergabung` text CHARACTER SET utf8mb4 NOT NULL,
  `typepengguna` text CHARACTER SET utf8mb4 NOT NULL,
  `kodeverifikasi` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data untuk tabel `admindata`
--

INSERT INTO `admindata` (`primkey_data_admin`, `namapengguna`, `namapanggilan`, `nikktp`, `email`, `idrandom`, `statusakun`, `durasiterkunci`, `typeakun`, `password`, `phonenumber`, `tanggalbergabung`, `typepengguna`, `kodeverifikasi`) VALUES
(1, 'U2VwdGlhbiBUcml3aWRpYW50byBQdXRyYQ==', 'Septian', 'MTIzNDU2Nzg5MDEyMzQ1Ng==', 'c2VwdGlhbnRyaXdpZGlhbkBnbWFpbC5jb20=', '856974D69F', 'Terbuka', '0', 'Master_Admin', '905f943efb68abe45e3405a74adb18a2', 'MDgzODc0NDU0ODg0', '10-04-2021 21:09:38', 'Non_Customer', 'Terverifikasi.b8ec7eb002c65207dc6a0885fb763ed7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logresetpassword`
--

CREATE TABLE `logresetpassword` (
  `prim_key_logresetpassword` int(11) NOT NULL,
  `email` text CHARACTER SET utf8mb4 NOT NULL,
  `idrandom` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `nikktp` text CHARACTER SET utf8mb4 NOT NULL,
  `tanggalresetpassword` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `kodeverifikasi` varchar(32) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temptokenmasuk`
--

CREATE TABLE `temptokenmasuk` (
  `idToken` int(11) NOT NULL,
  `tanggalLogin` int(11) NOT NULL,
  `token` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idrandom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `typeDataMasuk` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Dumping data untuk tabel `temptokenmasuk`
--

INSERT INTO `temptokenmasuk` (`idToken`, `tanggalLogin`, `token`, `idrandom`, `typeDataMasuk`, `email`) VALUES
(1, 1618869994, '6400ab9a5fc46470965760a91d8c0d06', '856974D69F', 'Non_Customer', 'c2VwdGlhbnRyaXdpZGlhbkBnbWFpbC5jb20=');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userdata`
--

CREATE TABLE `userdata` (
  `primkey_data_user` int(11) NOT NULL,
  `namapengguna` text CHARACTER SET utf8mb4 NOT NULL,
  `namapanggilan` text CHARACTER SET utf8mb4 NOT NULL,
  `nikktp` text CHARACTER SET utf8mb4 NOT NULL,
  `email` text CHARACTER SET utf8mb4 NOT NULL,
  `idrandom` text CHARACTER SET utf8mb4 NOT NULL,
  `statusakun` text CHARACTER SET utf8mb4 NOT NULL,
  `durasiterkunci` text CHARACTER SET utf8mb4 NOT NULL,
  `typeakun` text CHARACTER SET utf8mb4 NOT NULL,
  `password` text CHARACTER SET utf8mb4 NOT NULL,
  `phonenumber` text CHARACTER SET utf8mb4 NOT NULL,
  `tanggalbergabung` text CHARACTER SET utf8mb4 NOT NULL,
  `typepengguna` text CHARACTER SET utf8mb4 NOT NULL,
  `kodeverifikasi` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Struktur dari tabel `villa`
--

CREATE TABLE `villa` (
  `primkey_data_villa` int(11) NOT NULL,
  `namavilla` text COLLATE latin1_general_cs NOT NULL,
  `lokasivilla` text COLLATE latin1_general_cs NOT NULL,
  `statusvilla` text COLLATE latin1_general_cs NOT NULL,
  `idunikvilla` text COLLATE latin1_general_cs NOT NULL,
  `fasilitasvilla` text COLLATE latin1_general_cs NOT NULL,
  `hargavilla` varchar(100) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admindata`
--
ALTER TABLE `admindata`
  ADD PRIMARY KEY (`primkey_data_admin`);

--
-- Indeks untuk tabel `logresetpassword`
--
ALTER TABLE `logresetpassword`
  ADD PRIMARY KEY (`prim_key_logresetpassword`);

--
-- Indeks untuk tabel `temptokenmasuk`
--
ALTER TABLE `temptokenmasuk`
  ADD PRIMARY KEY (`idToken`);

--
-- Indeks untuk tabel `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`primkey_data_user`);

--
-- Indeks untuk tabel `villa`
--
ALTER TABLE `villa`
  ADD PRIMARY KEY (`primkey_data_villa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admindata`
--
ALTER TABLE `admindata`
  MODIFY `primkey_data_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `logresetpassword`
--
ALTER TABLE `logresetpassword`
  MODIFY `prim_key_logresetpassword` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `temptokenmasuk`
--
ALTER TABLE `temptokenmasuk`
  MODIFY `idToken` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `userdata`
--
ALTER TABLE `userdata`
  MODIFY `primkey_data_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `villa`
--
ALTER TABLE `villa`
  MODIFY `primkey_data_villa` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
