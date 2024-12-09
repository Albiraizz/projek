-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2024 pada 07.55
-- Versi server: 11.5.2-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_penjadwalan_operasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` varchar(5) NOT NULL,
  `nm_dokter` varchar(100) NOT NULL,
  `spesialis` varchar(100) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nm_dokter`, `spesialis`, `no_telp`) VALUES
('D001', 'Dr. Fauzi', 'Bedah', '81276273722'),
('D002', 'Dr. Dimas', 'Anak', '81276123222');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_operasi`
--

CREATE TABLE `jadwal_operasi` (
  `id_jadwal` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `tgl_operasi` date NOT NULL,
  `jam_operasi` time NOT NULL,
  `id_ruangan` varchar(5) DEFAULT NULL,
  `id_kamar` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` varchar(5) NOT NULL,
  `id_ruangan` varchar(10) NOT NULL,
  `status` enum('Tersedia','Sedang digunakan') DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_ruangan`, `status`) VALUES
('KM01', 'RU01', 'Tersedia'),
('KM02', 'RU01', 'Tersedia'),
('KM03', 'RU01', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `no_rm` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `no_rm`, `nama`, `tgl_lahir`, `alamat`) VALUES
(1, 'RM01', 'Abdi', '2005-09-14', 'Palembang'),
(2, 'RM02', 'Alwi', '2021-05-26', 'Palembang'),
(3, 'RM03', 'John', '2001-01-20', 'Palembang'),
(4, 'RM04', 'Dimas', '2005-01-10', 'Palembang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_operasi`
--

CREATE TABLE `pengajuan_operasi` (
  `id_pengajuan` int(11) NOT NULL,
  `no_rm` varchar(20) NOT NULL,
  `diagnosa` text NOT NULL,
  `nm_dokter` varchar(100) NOT NULL,
  `status` enum('Diajukan','Diterima','Ditolak') DEFAULT 'Diajukan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengajuan_operasi`
--

INSERT INTO `pengajuan_operasi` (`id_pengajuan`, `no_rm`, `diagnosa`, `nm_dokter`, `status`) VALUES
(16, 'RM01', 'Magh', 'Dr. Dimas', 'Diterima'),
(22, 'RM02', 'Hepatitis', 'Dr. Fauzi', 'Diajukan'),
(23, 'RM03', 'Hepatitis', 'Dr. Fauzi', 'Diajukan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` varchar(5) NOT NULL,
  `status` enum('Tersedia','Penuh') DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `status`) VALUES
('RU01', 'Tersedia'),
('RU02', 'Tersedia'),
('RU03', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','nurse','patient') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '123', 'admin'),
(2, 'nurse', '123', 'nurse'),
(3, 'abdi', '123', 'patient');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `jadwal_operasi`
--
ALTER TABLE `jadwal_operasi`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `FK_JadwalPengajuanOperasi` (`id_pengajuan`),
  ADD KEY `FK_PengajuanRuangan` (`id_ruangan`),
  ADD KEY `FK_PengajuanKamar` (`id_kamar`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `FK_RuanganKamar` (`id_ruangan`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `no_rm` (`no_rm`);

--
-- Indeks untuk tabel `pengajuan_operasi`
--
ALTER TABLE `pengajuan_operasi`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `FK_PasienPengajuanOperasi` (`no_rm`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal_operasi`
--
ALTER TABLE `jadwal_operasi`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_operasi`
--
ALTER TABLE `pengajuan_operasi`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal_operasi`
--
ALTER TABLE `jadwal_operasi`
  ADD CONSTRAINT `FK_JadwalPengajuanOperasi` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan_operasi` (`id_pengajuan`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_PengajuanKamar` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_PengajuanRuangan` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `FK_RuanganKamar` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengajuan_operasi`
--
ALTER TABLE `pengajuan_operasi`
  ADD CONSTRAINT `FK_PasienPengajuanOperasi` FOREIGN KEY (`no_rm`) REFERENCES `pasien` (`no_rm`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
