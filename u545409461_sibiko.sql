-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2020 at 10:19 AM
-- Server version: 10.2.31-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u545409461_sibiko`
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
  `user_id` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  `bukti` varchar(255) NOT NULL DEFAULT '/android-alpa/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catatan_poin_pelanggaran`
--

INSERT INTO `catatan_poin_pelanggaran` (`catatan_poin_pelanggaran_id`, `tanggal_pelanggaran`, `siswa_id`, `pelanggaran_id`, `user_id`, `status`, `bukti`) VALUES
(84, '2020-05-13 14:05:47', 2450, 377, 130, 1, '/android-alpa/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `catatan_prestasi`
--

CREATE TABLE `catatan_prestasi` (
  `catatan_prestasi_id` int(10) NOT NULL,
  `nama_prestasi` varchar(255) NOT NULL,
  `tanggal_prestasi` datetime NOT NULL,
  `siswa_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `catatan_prestasi`
--

INSERT INTO `catatan_prestasi` (`catatan_prestasi_id`, `nama_prestasi`, `tanggal_prestasi`, `siswa_id`, `user_id`, `status`) VALUES
(33, 'test', '2020-05-13 14:02:59', 2450, 130, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `jurusan_id` int(5) NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`jurusan_id`, `kode_jurusan`, `nama_jurusan`) VALUES
(318, 'PSPT', 'Produksi dan Siaran Program Televisi'),
(319, 'AKL', 'Akuntansi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int(10) NOT NULL,
  `nama_wali_kelas` varchar(50) NOT NULL,
  `tingkat_kelas` varchar(10) NOT NULL,
  `jurusan_id` int(10) NOT NULL,
  `tipe_kelas` varchar(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `nama_wali_kelas`, `tingkat_kelas`, `jurusan_id`, `tipe_kelas`, `user_id`) VALUES
(1161, 'Fitri Dian Setyorini, S.Pd.', '10', 318, '1', 140),
(1162, 'Sulis Indah Wati, S.Pd.', '10', 319, '1', 140);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `mapel_id` int(10) NOT NULL,
  `kode_mapel` varchar(10) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`mapel_id`, `kode_mapel`, `nama_mapel`) VALUES
(103, 'Admin', 'Admin'),
(117, 'BK', 'Bimbingan Konseling'),
(118, 'MTK', 'Matematika'),
(119, 'IND', 'Bahasa Indonesia'),
(120, 'ING', 'Bahasa Inggris'),
(121, 'AK', 'Akuntansi'),
(122, 'BJ', 'Bahasa Jawa');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `pelanggaran_id` int(10) NOT NULL,
  `nama_pelanggaran` varchar(255) NOT NULL,
  `poin_pelanggaran` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`pelanggaran_id`, `nama_pelanggaran`, `poin_pelanggaran`) VALUES
(376, 'Datang terlambat/tidak mengikuti KBM/tidak mengikuti upacara', 5),
(377, 'Tidak masuk sekolah tanpa alasan yang dapat dipertanggungjawabkan', 5),
(378, 'Tidak mengikuti upacara bendera hari Senin atau upacara lainnya tanpa keterangan yang jelas', 5),
(379, 'Tidak mengikuti upacara bendera pada hari-hari besar nasional tanpa keterangan yang jelas', 5),
(380, 'Menggunakan hp/alat komunikasi lainnya saat KBM tanpa izin', 5),
(381, 'Tidak hadir/tidak mengikuti kegiatan ekstrakurikuler', 5),
(382, 'Mengganggu KBM baik di dalam maupun di luar kelas', 5),
(383, 'Makan atau minum pada saat pembelajaran di ruang kelas/lab./ruang praktik', 5),
(384, 'Memakai mode tidak pada tempatnya, seperti laki-laki memakai anting, rambut kliwir, gundul, dll', 5),
(385, 'Rambut tidak rapi/memakai cat rambut atau panjang  melebihi ketentuan bagi peserta didik laki-laki', 5),
(386, 'Memakai pakaian tidak sesuai dengan ketentuan sekolah', 5),
(387, 'Tidak memakai kelengkapan seragam sekolah serta membawa kelengkapan sekolah lainnya', 5),
(388, 'Tidak mengenakan seragam olahraga pada saat pembelajaran olahraga', 5),
(389, 'Tidak mengenakan sepatu hitam dan kaos kaki putih panjang, kecuali Pramuka', 5),
(390, 'Tidak dapat menghadirkan orang tua/wali untuk menyelesaikan kasus dalam sekali panggilan', 10),
(391, 'Berbicara senonoh (memaki, jorok, dan sebagainya) ', 15),
(392, 'Meninggalkan pembelajaran atau kegiatan sekolah yang lain tanpa izin (membolos/melompat pagar)', 20),
(393, 'Tidak ikut pelajaran, nongkrong di warung/kantin/BC/koperasi atau di jalan', 20),
(394, 'Coret-coret baju seragam, merusak/merobek jahitan baju/celana/rok', 25),
(395, 'Berkata atau berperilaku tidak sopan kepada guru atau karyawan sekolah', 25),
(396, 'Membawa senjata tajam/sejenisnya yang tidak diperlukan ', 30),
(397, 'Sengaja melanggar aturan kebersihan, seperti coret-coret tembok, bangku, dan sebagainya', 30),
(398, 'Merusak alat-alat penunjang kegiatan belajar mengajar dengan sengaja', 50),
(399, 'Membawa rokok/terbukti merokok, membawa/terbukti minum minuman keras', 60),
(400, 'Membawa/melihat gambar/buku/video/film atau membuka situs porno', 70),
(401, 'Bermain judi, di sekolah maupun di sekitar lingkungan sekolah', 75),
(402, 'Meminta/memalak milik orang lain dengan ancaman atau memaksa', 75),
(403, 'Berkelahi dengan sesama teman', 75),
(404, 'Mengancam kepala sekolah, guru, atau karyawan sekolah', 80),
(405, 'Mencemarkan nama baik kepala sekolah, guru, dan karyawan di sekolah maupun di media sosial/internet', 80),
(406, 'Berkelahi dengan peserta didik sekolah lain sehingga melibatkan sekolah maupun polisi', 90),
(407, 'Membawa, memakai, atau mengedarkan narkotika dan sejenisnya', 100),
(408, 'Berkelahi/melakukan penganiayaan terhadap kepala sekolah, guru, dan karyawan sekolah', 100),
(409, 'Ketahuan hamil/menikah (resmi/siri) selama mengikuti pendidikan', 100),
(410, 'Terlibat perkara kriminal yang ditangani kepolisian', 100),
(411, 'Mencuri/mengambil barang milik guru/karyawan dan peserta didik lain', 100),
(412, 'Melakukan tindakan asusila baik di dalam maupun di luar lingkungan sekolah', 100);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(10) NOT NULL,
  `poin_pelanggaran_siswa` int(3) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `kelas_id` int(10) NOT NULL,
  `tindakan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `poin_pelanggaran_siswa`, `nama_siswa`, `nis`, `jenis_kelamin`, `kelas_id`, `tindakan`) VALUES
(2449, 0, 'ANA NAILA ROCHANIAH', '13594', '', 1162, 1),
(2450, 5, 'ANINDHA NUR MUTHIA', '13595', '', 1162, 0),
(2451, 0, 'ANMUFRYDA YUNIZAR AULIANI', '13596', '', 1162, 0),
(2452, 0, 'AUDREY TIARA SELAMET WALDY', '13597', '', 1162, 0),
(2453, 0, 'AYU FITRIYANI', '13598', '', 1162, 0),
(2454, 0, 'CINTYA VIRUL ANIDA', '13599', '', 1162, 0),
(2455, 0, 'DELA ABELLIA', '13600', '', 1162, 0),
(2456, 0, 'DIANI EKA YUSARYAHYA', '13601', '', 1162, 0),
(2457, 0, 'DINDA AYU FATIMAH', '13602', '', 1162, 0),
(2458, 0, 'FEBRIANA DWI AMANDA', '13603', '', 1162, 0),
(2459, 0, 'FENINDA MAHARANI SAPUTRI', '13604', '', 1162, 0),
(2460, 0, 'FILZAH NADIAH AMANINA', '13605', '', 1162, 0),
(2461, 0, 'GALUH SUKMANINGRUM', '13606', '', 1162, 0),
(2462, 0, 'HANIFA SALSABILA', '13607', '', 1162, 0),
(2463, 0, 'HILDA MASTANIA', '13608', '', 1162, 0),
(2464, 0, 'INDAH LAILATUL MAGFIROH', '13609', '', 1162, 0),
(2465, 0, 'INDIRA ASTRINA PRANGESTI', '13610', '', 1162, 0),
(2466, 0, 'INDRA KAMALIA', '13611', '', 1162, 0),
(2467, 0, 'LAILATUL JAMILAH', '13614', '', 1162, 0),
(2468, 0, 'LATHIFA BUDI RAHAYU', '13615', '', 1162, 0),
(2469, 0, 'LATIFATUL MAESAROH', '13616', '', 1162, 0),
(2470, 0, 'LATIFUL RAHMAWATI', '13617', '', 1162, 0),
(2471, 0, 'LINDA STIANINGRUM', '13618', '', 1162, 0),
(2472, 0, 'MAHARANI CHUSNUL KHOTIMAH', '13619', '', 1162, 0),
(2473, 0, 'NABILA KHOIRUNNISA', '13620', '', 1162, 0),
(2474, 0, 'NOVA NURHASLINDA', '13621', '', 1162, 0),
(2475, 0, 'NOVELITA AZZAHRA AYU TRIBUANA', '13622', '', 1162, 0),
(2476, 0, 'PUTRI OKTAVIANI', '13623', '', 1162, 0),
(2477, 0, 'RIKA NAZIL AINIYAH', '13624', '', 1162, 0),
(2478, 0, 'RISMA YULIANI', '13625', '', 1162, 0),
(2479, 0, 'RIZKA MUDAWAMAH', '13626', '', 1162, 0),
(2480, 0, 'SITI MUNHAFIROH', '13627', '', 1162, 0),
(2481, 0, 'TIKA DIAN NURAENI', '13628', '', 1162, 0),
(2482, 0, 'YUNITA PUSPITASARI', '13629', '', 1162, 0);

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
(27, 'A', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tahap_tindak`
--

CREATE TABLE `tahap_tindak` (
  `tahap_id` int(10) NOT NULL,
  `tahap` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `poin_awal` int(3) NOT NULL,
  `poin_akhir` int(3) NOT NULL,
  `warna` varchar(11) NOT NULL DEFAULT '#f6f6f6'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tahap_tindak`
--

INSERT INTO `tahap_tindak` (`tahap_id`, `tahap`, `keterangan`, `poin_awal`, `poin_akhir`, `warna`) VALUES
(69, 'TAHAP 0', 'Aman', 0, 10, '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `mapel_id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama_user`, `nip`, `mapel_id`, `username`, `password`, `level`) VALUES
(130, 'admin', '1', 103, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(140, 'Herawati', 'BK1', 117, 'herawati', '6b2be4086f4f321a4b91d031c076b4f8', 'Guru BK'),
(141, 'Indah', 'IDH', 119, 'indah', 'f3385c508ce54d577fd205a1b2ecdfb7', 'Guru Mata Pelajaran'),
(142, 'Agung', 'AGG', 120, 'agung', 'e59cd3ce33a68f536c19fedb82a7936f', 'Guru Mata Pelajaran'),
(143, 'Pertiwi', 'BK2', 117, 'pertiwi', '749553e2b22ebf919c578d6dd47ce1e8', 'Guru BK');

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
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `catatan_prestasi`
--
ALTER TABLE `catatan_prestasi`
  ADD PRIMARY KEY (`catatan_prestasi_id`),
  ADD KEY `nis` (`siswa_id`),
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
  ADD KEY `id_jurusan` (`jurusan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`mapel_id`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`pelanggaran_id`);

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
-- Indexes for table `tahap_tindak`
--
ALTER TABLE `tahap_tindak`
  ADD PRIMARY KEY (`tahap_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `mapel_id` (`mapel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catatan_poin_pelanggaran`
--
ALTER TABLE `catatan_poin_pelanggaran`
  MODIFY `catatan_poin_pelanggaran_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `catatan_prestasi`
--
ALTER TABLE `catatan_prestasi`
  MODIFY `catatan_prestasi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `jurusan_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1163;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `mapel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `pelanggaran_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=413;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2483;

--
-- AUTO_INCREMENT for table `skala_sikap`
--
ALTER TABLE `skala_sikap`
  MODIFY `skala_sikap_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tahap_tindak`
--
ALTER TABLE `tahap_tindak`
  MODIFY `tahap_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

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
-- Constraints for table `catatan_prestasi`
--
ALTER TABLE `catatan_prestasi`
  ADD CONSTRAINT `catatan_prestasi_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catatan_prestasi_ibfk_5` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`siswa_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`jurusan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`kelas_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`mapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
