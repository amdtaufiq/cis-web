-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2020 at 05:17 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sibiko`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan_poin_pelanggaran`
--

CREATE TABLE `catatan_poin_pelanggaran` (
  `catatan_poin_pelanggaran_id` int(10) NOT NULL,
  `tanggal_pelanggaran` datetime NOT NULL,
  `siswa_id` int(10) NOT NULL,
  `pelanggaran_id` int(10) NOT NULL,
  `poin_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `catatan_poin_prestasi`
--

CREATE TABLE `catatan_poin_prestasi` (
  `catatan_poin_prestasi_id` int(10) NOT NULL,
  `tanggal_prestasi` datetime NOT NULL,
  `siswa_id` int(10) NOT NULL,
  `prestasi_id` int(10) NOT NULL,
  `poin_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `jurusan_id` int(5) NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int(10) NOT NULL,
  `nama_wali_kelas` varchar(50) NOT NULL,
  `nomor_wali_kelas` varchar(20) NOT NULL,
  `tingkat_kelas` varchar(10) NOT NULL,
  `jurusan_id` int(10) NOT NULL,
  `tipe_kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `pelanggaran_id` int(10) NOT NULL,
  `nama_pelanggaran` varchar(50) NOT NULL,
  `poin_pelanggaran` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `prestasi_id` int(10) NOT NULL,
  `nama_prestasi` varchar(50) NOT NULL,
  `poin_prestasi` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`prestasi_id`, `nama_prestasi`, `poin_prestasi`) VALUES
(1, 'Ranking 1', 20);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(10) NOT NULL,
  `poin` int(3) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `kelas_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `skala_sikap`
--

CREATE TABLE `skala_sikap` (
  `skala_sikap_id` int(10) NOT NULL,
  `skala` varchar(2) NOT NULL,
  `poin_minimal` int(5) NOT NULL,
  `poin_maksimal` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skala_sikap`
--

INSERT INTO `skala_sikap` (`skala_sikap_id`, `skala`, `poin_minimal`, `poin_maksimal`) VALUES
(4, 'A', 91, 100);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nomor_telpon` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama_user`, `nip`, `nomor_telpon`, `username`, `password`, `level`) VALUES
(7, 'Ahmad Taufiq Hidayat', '1234567891234', '087830106027', 'amd', '5dc984e2aef527ea2daaeffe646a6a52', 'Guru BK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan_poin_pelanggaran`
--
ALTER TABLE `catatan_poin_pelanggaran`
  ADD PRIMARY KEY (`catatan_poin_pelanggaran_id`),
  ADD KEY `nis` (`siswa_id`),
  ADD KEY `id_poin_pelanggaran` (`pelanggaran_id`),
  ADD KEY `id_poin` (`poin_id`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `catatan_poin_prestasi`
--
ALTER TABLE `catatan_poin_prestasi`
  ADD PRIMARY KEY (`catatan_poin_prestasi_id`),
  ADD KEY `nis` (`siswa_id`),
  ADD KEY `id_poin_prestasi` (`prestasi_id`),
  ADD KEY `id_poin` (`poin_id`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`jurusan_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`),
  ADD KEY `id_jurusan` (`jurusan_id`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`pelanggaran_id`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`prestasi_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`),
  ADD KEY `id_kelas` (`kelas_id`);

--
-- Indexes for table `skala_sikap`
--
ALTER TABLE `skala_sikap`
  ADD PRIMARY KEY (`skala_sikap_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan_poin_pelanggaran`
--
ALTER TABLE `catatan_poin_pelanggaran`
  MODIFY `catatan_poin_pelanggaran_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `catatan_poin_prestasi`
--
ALTER TABLE `catatan_poin_prestasi`
  MODIFY `catatan_poin_prestasi_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `jurusan_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `pelanggaran_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `prestasi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `skala_sikap`
--
ALTER TABLE `skala_sikap`
  MODIFY `skala_sikap_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan_poin_pelanggaran`
--
ALTER TABLE `catatan_poin_pelanggaran`
  ADD CONSTRAINT `catatan_poin_pelanggaran_ibfk_1` FOREIGN KEY (`pelanggaran_id`) REFERENCES `pelanggaran` (`pelanggaran_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catatan_poin_pelanggaran_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catatan_poin_pelanggaran_ibfk_5` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `catatan_poin_prestasi`
--
ALTER TABLE `catatan_poin_prestasi`
  ADD CONSTRAINT `catatan_poin_prestasi_ibfk_1` FOREIGN KEY (`prestasi_id`) REFERENCES `prestasi` (`prestasi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catatan_poin_prestasi_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catatan_poin_prestasi_ibfk_5` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`jurusan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
