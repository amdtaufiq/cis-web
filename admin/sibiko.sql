-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2020 at 07:01 PM
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
  `user_id` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catatan_poin_pelanggaran`
--

INSERT INTO `catatan_poin_pelanggaran` (`catatan_poin_pelanggaran_id`, `tanggal_pelanggaran`, `siswa_id`, `pelanggaran_id`, `user_id`, `status`) VALUES
(1, '2020-02-21 08:58:56', 117, 1, 7, 1),
(2, '2020-02-21 09:34:40', 147, 31, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `catatan_poin_prestasi`
--

CREATE TABLE `catatan_poin_prestasi` (
  `catatan_poin_prestasi_id` int(10) NOT NULL,
  `tanggal_prestasi` datetime NOT NULL,
  `siswa_id` int(10) NOT NULL,
  `prestasi_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` int(1) NOT NULL
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

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`jurusan_id`, `kode_jurusan`, `nama_jurusan`) VALUES
(245, 'PSPT', 'Produksi dan Siaran Program Televisi'),
(246, 'MM', 'Multimedia'),
(247, 'TB', 'Tata Busana'),
(248, 'PS', 'Perbankan Syariah'),
(249, 'OTKP', 'Otomatisasi dan Tata Kelola Perkantoran'),
(250, 'AKL', 'Akuntansi dan Keuangan Lembaga'),
(251, 'BDP', 'Bisnis Daring dan Pemasaran'),
(252, 'DF', 'Desain Fesyen');

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

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `nama_wali_kelas`, `nomor_wali_kelas`, `tingkat_kelas`, `jurusan_id`, `tipe_kelas`) VALUES
(595, 'Fitri Dian Setyorini, S.Pd.', '', '10', 245, '1'),
(596, 'Ian Septian Raharjo, S.Pd.', '', '10', 246, '1'),
(597, 'Sutarmi, S.Pd.', '', '10', 246, '2'),
(598, 'Dra. Naning Junaryati', '', '10', 247, '1'),
(599, 'Sri Indayati, S.Pd.', '', '10', 247, '2'),
(600, 'Fatia Dianingtyas, S.S.T', '', '10', 248, '1'),
(601, 'Elmawati, S.Pd.', '', '10', 249, '1'),
(602, 'Dewi Aditya Astarini, S.Pd., M.Pd.', '', '10', 249, '2'),
(603, 'Dra. Widi Mulyani', '', '10', 250, '1'),
(604, 'Drs. Ngudiana Putra, M.Pd.', '', '10', 250, '2'),
(605, 'Muhammad Ahdiyat, S.Pd Gr', '', '10', 250, '3'),
(606, 'Bagus Firdaus Santoso, S.Pd.', '', '10', 251, '1'),
(607, 'Ahmad Halimy Nugroho, S.Pd.', '', '10', 251, '2'),
(608, 'Sinta Nofia Sari, S.Pd.', '', '10', 252, '1'),
(609, 'Agus Tri Kurniawan, A.Md.', '', '11', 245, '1'),
(610, 'Yusan Dwi Kurniawan, S.Pd.', '', '11', 246, '1'),
(611, 'Teguh Setya Abadi, S.Kom', '', '11', 246, '2'),
(612, 'Ima Mulyanti, S.Pd.', '', '11', 247, '1'),
(613, 'Dra. Mulimi', '', '11', 247, '2'),
(614, 'Lilia Sapta Ningsih, S.Pd.', '', '11', 248, '1'),
(615, 'Rizkia Yulikasari, S.Pd.', '', '11', 249, '1'),
(616, 'Sutopo, S.Pd.', '', '11', 249, '2'),
(617, 'Kasanah, S.Pd.', '', '11', 250, '1'),
(618, 'Yunan Helmi Nasution, S.Ag.', '', '11', 250, '2'),
(619, 'Siti Wakhidah, S.Pd.', '', '11', 250, '3'),
(620, 'Ristiana Ekowati, S.Pd.', '', '11', 251, '1'),
(621, 'Sri Ani Murdaningsih', '', '11', 251, '2'),
(622, 'Agus Tri Kurniawan, A.Md.', '', '12', 245, '1'),
(623, 'Yusan Dwi Kurniawan, S.Pd.', '', '12', 246, '1'),
(624, 'Teguh Setya Abadi, S.Kom', '', '12', 246, '2'),
(625, 'Ima Mulyanti, S.Pd.', '', '12', 247, '1'),
(626, 'Dra. Mulimi', '', '12', 247, '2'),
(627, 'Lilia Sapta Ningsih, S.Pd.', '', '12', 248, '1'),
(628, 'Rizkia Yulikasari, S.Pd.', '', '12', 249, '1'),
(629, 'Sutopo, S.Pd.', '', '12', 249, '2'),
(630, 'Kasanah, S.Pd.', '', '12', 250, '1'),
(631, 'Yunan Helmi Nasution, S.Ag.', '', '12', 250, '2'),
(632, 'Siti Wakhidah, S.Pd.', '', '12', 250, '3'),
(633, 'Ristiana Ekowati, S.Pd.', '', '12', 251, '1'),
(634, 'Sri Ani Murdaningsih', '', '12', 251, '2');

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
(1, 'Datang terlambat/tidak mengikuti KBM/tidak mengikuti upacara', 5),
(2, 'Tidak masuk sekolah tanpa alasan yang dapat dipertanggungjawabkan', 5),
(3, 'Tidak mengikuti upacara bendera hari Senin atau upacara lainnya tanpa keterangan yang jelas', 5),
(4, 'Tidak mengikuti upacara bendera pada hari-hari besar nasional tanpa keterangan yang jelas', 5),
(5, 'Menggunakan hp/alat komunikasi lainnya saat KBM tanpa izin', 5),
(6, 'Tidak hadir/tidak mengikuti kegiatan ekstrakurikuler', 5),
(7, 'Mengganggu KBM baik di dalam maupun di luar kelas', 5),
(8, 'Makan atau minum pada saat pembelajaran di ruang kelas/lab./ruang praktik', 5),
(9, 'Memakai mode tidak pada tempatnya, seperti laki-laki memakai anting, rambut kliwir, gundul, dll', 5),
(10, 'Rambut tidak rapi/memakai cat rambut atau panjang  melebihi ketentuan bagi peserta didik laki-laki', 5),
(11, 'Memakai pakaian tidak sesuai dengan ketentuan sekolah', 5),
(12, 'Tidak memakai kelengkapan seragam sekolah serta membawa kelengkapan sekolah lainnya', 5),
(13, 'Tidak mengenakan seragam olahraga pada saat pembelajaran olahraga', 5),
(14, 'Tidak mengenakan sepatu hitam dan kaos kaki putih panjang, kecuali Pramuka', 5),
(15, 'Tidak dapat menghadirkan orang tua/wali untuk menyelesaikan kasus dalam sekali panggilan', 10),
(16, 'Berbicara senonoh (memaki, jorok, dan sebagainya) ', 15),
(17, 'Meninggalkan pembelajaran atau kegiatan sekolah yang lain tanpa izin (membolos/melompat pagar)', 20),
(18, 'Tidak ikut pelajaran, nongkrong di warung/kantin/BC/koperasi atau di jalan', 20),
(19, 'Coret-coret baju seragam, merusak/merobek jahitan baju/celana/rok', 25),
(20, 'Berkata atau berperilaku tidak sopan kepada guru atau karyawan sekolah', 25),
(21, 'Membawa senjata tajam/sejenisnya yang tidak diperlukan ', 30),
(22, 'Sengaja melanggar aturan kebersihan, seperti coret-coret tembok, bangku, dan sebagainya', 30),
(23, 'Merusak alat-alat penunjang kegiatan belajar mengajar dengan sengaja', 50),
(24, 'Membawa rokok/terbukti merokok, membawa/terbukti minum minuman keras', 60),
(25, 'Membawa/melihat gambar/buku/video/film atau membuka situs porno', 70),
(26, 'Bermain judi, di sekolah maupun di sekitar lingkungan sekolah', 75),
(27, 'Meminta/memalak milik orang lain dengan ancaman atau memaksa', 75),
(28, 'Berkelahi dengan sesama teman', 75),
(29, 'Mengancam kepala sekolah, guru, atau karyawan sekolah', 80),
(30, 'Mencemarkan nama baik kepala sekolah, guru, dan karyawan di sekolah maupun di media sosial/internet', 80),
(31, 'Berkelahi dengan peserta didik sekolah lain sehingga melibatkan sekolah maupun polisi', 90),
(32, 'Membawa, memakai, atau mengedarkan narkotika dan sejenisnya', 100),
(33, 'Berkelahi/melakukan penganiayaan terhadap kepala sekolah, guru, dan karyawan sekolah', 100),
(34, 'Ketahuan hamil/menikah (resmi/siri) selama mengikuti pendidikan', 100),
(35, 'Terlibat perkara kriminal yang ditangani kepolisian', 100),
(36, 'Mencuri/mengambil barang milik guru/karyawan dan peserta didik lain', 100),
(37, 'Melakukan tindakan asusila baik di dalam maupun di luar lingkungan sekolah', 100);

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `prestasi_id` int(10) NOT NULL,
  `nama_prestasi` varchar(255) NOT NULL,
  `poin_prestasi` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(10) NOT NULL,
  `poin_pelanggaran_siswa` int(3) NOT NULL,
  `poin_prestasi_siswa` int(3) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `kelas_id` int(10) NOT NULL,
  `tindakan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `poin_pelanggaran_siswa`, `poin_prestasi_siswa`, `nama_siswa`, `nis`, `jenis_kelamin`, `kelas_id`, `tindakan`) VALUES
(117, 5, 0, 'AHMAD DAIMAL MUBAROK', '13300', 'L', 596, 0),
(118, 0, 0, 'AHMAD HUSNI RIJAL', '13301', 'L', 596, 0),
(119, 0, 0, 'ARRISA IFTAKHA RIZQI AWALIYAH', '13302', 'P', 596, 0),
(120, 0, 0, 'ASTRI VANISSA RIZKY WARDANI', '13303', 'P', 596, 0),
(121, 0, 0, 'AZZA LUTFIANA', '13304', 'L', 596, 0),
(122, 0, 0, 'BAGUS WIJAYANTO', '13305', 'L', 596, 0),
(123, 0, 0, 'BELINDA TRIPRITA LAURA', '13306', 'P', 596, 0),
(124, 0, 0, 'DEWI NAFISA NABILA', '13307', 'P', 596, 0),
(125, 0, 0, 'DIAH AYU LESTARI', '13308', 'P', 596, 0),
(126, 0, 0, 'EMERITA INDAH SARI', '13309', 'P', 596, 0),
(127, 0, 0, 'FAJAR IKA FERDIAN', '13310', 'L', 596, 0),
(128, 0, 0, 'FIDEL LUSIANA PUTRI', '13311', 'P', 596, 0),
(129, 0, 0, 'GLADYSSIA AMELANI ZAEN', '13312', 'L', 596, 0),
(130, 0, 0, 'HANA RIZQI NURFATINAH', '13313', 'P', 596, 0),
(131, 0, 0, 'LATIFAH NOR AENI', '13314', 'P', 596, 0),
(132, 0, 0, 'MIFTAH MAJIDATUL CHOERINA', '13315', 'P', 596, 0),
(133, 0, 0, 'MUHAMMAD AKHMAL KHUMAR', '13316', 'L', 596, 0),
(134, 0, 0, 'MUHAMMAD RIYAN SETIYAWAN', '13317', 'L', 596, 0),
(135, 0, 0, 'MURTAJI KAROMI ROBBI', '13318', 'L', 596, 0),
(136, 0, 0, 'NAILUL MUNA', '13319', 'L', 596, 0),
(137, 0, 0, 'NIA RAHMA MAGHFIROH', '13320', 'P', 596, 0),
(138, 0, 0, 'NOVI AULIA SAFITRI', '13321', 'P', 596, 0),
(139, 0, 0, 'NUR SAFIKA', '13322', 'P', 596, 0),
(140, 0, 0, 'RAHMAWATI', '13323', 'P', 596, 0),
(141, 0, 0, 'RIFA AYU FAZIDAH', '13324', 'P', 596, 0),
(142, 0, 0, 'RIFA ZAHIROTUL ANJALI', '13325', 'P', 596, 0),
(143, 0, 0, 'SISKIA WULANDARI', '13326', 'P', 596, 0),
(144, 0, 0, 'ULUNG ADHI PRATAMA', '13327', 'L', 596, 0),
(145, 0, 0, 'VANESSA MAISHINTA NAJWA', '13328', 'P', 596, 0),
(147, 190, 0, 'Taufik', '12345678', 'P', 595, 0);

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
(4, 'A', 0, 15),
(5, 'AB', 16, 20),
(6, 'B', 21, 30),
(7, 'BC', 31, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tahap_tindak`
--

CREATE TABLE `tahap_tindak` (
  `tahap_id` int(10) NOT NULL,
  `tahap` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `poin_awal` int(3) NOT NULL,
  `poin_akhir` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tahap_tindak`
--

INSERT INTO `tahap_tindak` (`tahap_id`, `tahap`, `keterangan`, `poin_awal`, `poin_akhir`) VALUES
(23, 'TAHAP 0', 'aman', 0, 4),
(24, 'TAHAP I', 'Peringatan langsung secara lisan oleh Guru/Wali Kelas/BK kepada peserta didik', 5, 15),
(25, 'TAHAP II', 'Peringatan  secara  tertulis  kepada  peserta didik dan disampaikan kepada orang tua/wali', 16, 30),
(26, 'TAHAP III', 'Panggilan    orang   tua /wali   dengan  surat   pernyataan', 31, 50),
(27, 'TAHAP IV-A', 'Panggilan orang tua / wali untuk menyetujui keputusan tidak mengikuti pelajaran selama 2 hari dengan diberikan tugas atas bimbingan guru BK', 51, 80),
(28, 'TAHAP IV-B', 'Panggilan orang tua / wali untuk menyetujui keputusan diskors untuk jangka waktu yang ditentukan', 81, 99),
(29, 'TAHAP IV-C', 'Panggilan orang tua / wali untuk menyetujui keputusan konferensi kasus ', 100, 100);

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
(7, 'Ahmad Taufiq Hidayat', '1234567891234', '087830106027', 'amd', '5dc984e2aef527ea2daaeffe646a6a52', 'Guru BK'),
(8, 'Ahmad Taufiq Hidayat', '12346', '12356', 'taufiq', 'f4eff635e6dfe584a1a536dbc7718f3d', 'Guru BK'),
(9, 'HIDAYAT', '6706174058', '87830106027', 'hidayat', '37f3c4ac0ecd4a50c7f7ea1bd2b017c7', 'Guru Piket');

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
-- Indexes for table `catatan_poin_prestasi`
--
ALTER TABLE `catatan_poin_prestasi`
  ADD PRIMARY KEY (`catatan_poin_prestasi_id`),
  ADD KEY `nis` (`siswa_id`),
  ADD KEY `id_poin_prestasi` (`prestasi_id`),
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
-- Indexes for table `tahap_tindak`
--
ALTER TABLE `tahap_tindak`
  ADD PRIMARY KEY (`tahap_id`);

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
  MODIFY `catatan_poin_pelanggaran_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `catatan_poin_prestasi`
--
ALTER TABLE `catatan_poin_prestasi`
  MODIFY `catatan_poin_prestasi_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `jurusan_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=635;
--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `pelanggaran_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `prestasi_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `skala_sikap`
--
ALTER TABLE `skala_sikap`
  MODIFY `skala_sikap_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tahap_tindak`
--
ALTER TABLE `tahap_tindak`
  MODIFY `tahap_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
