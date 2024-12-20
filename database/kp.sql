-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 03:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `divisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `divisi`) VALUES
(0, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0),
(1, 'admin1', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', 1),
(2, 'admin2', '1c142b2d01aa34e9a36bde480645a57fd69e14155dacfab5a3f9257b77fdc8d8', 2),
(3, 'admin3', '4fc2b5673a201ad9b1fc03dcb346e1baad44351daa0503d5534b4dfdcc4332e0', 3),
(4, 'admin4', '110198831a426807bccd9dbdf54b6dcb5298bc5d31ac49069e0ba3d210d970ae', 4);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(0, 'Super Admin'),
(1, 'Pelayanan Pendaftaran Penduduk'),
(2, 'Pelayanan Pencatatan Sipil'),
(3, 'Pengelolaan Informasi Administrasi Kependudukan'),
(4, 'Pemanfaatan Data Dan Inovasi Pelayanan');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `telpon` varchar(12) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `isi` varchar(2048) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `nama`, `email`, `telpon`, `alamat`, `tujuan`, `foto`, `isi`, `tanggal`, `status`) VALUES
(100, 'Mamat', 'mamat123@gmail.com', '08542577852', 'Rt.09 Rw.05 Masjid Al-Barokah', 1, 'IMG-20241027-WA0021.jpg', 'Telah terjadinya perusakaan/pencoretan dinding masjid Al-Barokah oleh anak-anak kecil setempat', '2024-10-27 17:40:32', 'Menunggu'),
(101, 'Agus Permana', 'permanaagus@gmail.com', '08385541244', 'Rt.10 Rw.05', 1, 'IMG-20241027-WA0022.jpg', 'Belum adanya perbaikan di saluran pembuangan warga Rt.10 Rw.05 yang mengakibatkan air menguap kejalan dan bau yang tidak sehat untuk lingkungan. diharap ditindak lanjuti oleh pihak desa untuk membangun kesahatan untuk masyarakat setempat ', '2024-10-28 13:37:52', 'Ditanggapi'),
(102, 'Hanifah', 'hani@gmail.com', '083820604742', 'Rt 09 Rw 04 ', 1, 'IMG-20241027-WA0023.jpg', 'Banyaknya sampah yang ada di kali membuat banjir ketika air hujan deras datang, mohon kepada pihak desa untuk menindak lanjuti permasalahan ini agar tidak terjadinya banji lagi', '2024-10-27 19:27:31', 'Menunggu'),
(103, 'agustin', 'tina@gmail.com', '083858854872', 'Rt09 Rw01', 1, 'IMG-20241027-WA0024.jpg', 'sekolah taman kanak-kanan minimnya tempat bermain dan itu membuat kurangnya aktifitas anak-anak sekolah, dan sering terjadinya rebutan permain. untuk pihak desa dimohon bantuannya untuk memfalitasi taman bermain anak anak', '2024-10-27 19:31:20', 'Menunggu'),
(104, 'PERCOBAAN', 'fajar.vds@outlook.com', '057888888888', 'jakarta', 1, 'cv.jpg', 'kkkkkkkkkkkkkkkkkkkkkkkkkk', '2024-12-19 01:35:38', 'Menunggu'),
(105, 'PERCOBAAN', 'fajar.wdg@gmail.com', '083820604742', 'jakarta', 1, 'cv.jpg', 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '2024-12-19 04:00:09', 'Menunggu'),
(106, 'PERCOBAANttttttttttttt', 'fajar.vds@gmail.com', '083820604742', 'Sukabumi', 1, 'cv.jpg', '221154', '2024-12-19 04:05:15', 'Menunggu'),
(107, 'coba', 'fajar.vds@gmail.com', '083820604742', 'Bandung', 1, 'cv.jpg', 'percobaan', '2024-12-19 04:08:56', 'Menunggu'),
(108, 'PERCOBAAN', 'fajar.vds@outlook.com', '083820604742', 'jakarta', 0, 'cv.jpg', 'ffffffffffffffffffffffff', '2024-12-19 07:13:17', 'Menunggu'),
(109, 'PERCOBAAN', 'fajar.vds@outlook.com', '083820604742', 'jakarta', 0, 'Pulau Jawa.jpg', 'dgsssssssssssssss', '2024-12-19 08:12:33', 'Menunggu'),
(110, 'PERCOBAAN', 'fajar.vds@outlook.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'ddddddddd', '2024-12-19 10:27:33', 'Menunggu'),
(111, 'PERCOBAAN', 'fajar.wdg@gmail.com', '083820604742', 'Medan', 0, 'cv.jpg', 'percobaan 111', '2024-12-19 10:30:06', 'Menunggu'),
(112, 'Malika', 'fajar.wdg@gmail.com', '083820604742', 'Bandung', 0, 'cv.jpg', 'telah terjadinya kerusakan jalan pada jalan masuk ', '2024-12-20 02:28:42', 'Menunggu'),
(113, 'PERCOBAAN', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'dddddddddd', '2024-12-20 03:09:30', 'Menunggu'),
(114, 'ROHMAT HIDAYAT', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'ffffffffffff', '2024-12-20 03:12:14', 'Menunggu'),
(115, 'PERCOBAAN', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'ffffff', '2024-12-20 03:20:20', 'Menunggu'),
(116, 'coba lagi gais', 'fajar.wdg@gmail.com', '083820604742', 'Bandung', 0, 'cv.jpg', 'lalalalalala', '2024-12-20 03:27:28', 'Menunggu'),
(117, 'coba dei', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'hmmmmm', '2024-12-20 03:28:44', 'Menunggu'),
(118, 'fajar Firmansyah', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'lalalala', '2024-12-20 04:16:18', 'Menunggu'),
(119, 'Fajar Firmansyah', 'fajar.wdg@gmail.com', '083820604742', 'Bandung', 0, 'cv.jpg', 'lalalalalal', '2024-12-20 04:18:23', 'Menunggu'),
(120, 'Fajar Firmansyah', 'fajar.wdg@gmail.com', '083820604742', 'Bandung', 0, 'cv.jpg', 'lalalalala', '2024-12-20 04:20:08', 'Menunggu'),
(121, 'Fajar Firmansyah', 'fajar.wdg@gmail.com', '083820604742', 'Bandung', 0, 'cv.jpg', 'lalalalal', '2024-12-20 04:21:50', 'Menunggu'),
(122, 'Fajar Firmansyah', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'Belakang_UND.png', 'ggggggggggggfffffffffff', '2024-12-20 04:22:58', 'Menunggu'),
(123, 'Fajar Firmansyah', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'ssssssssss', '2024-12-20 04:24:33', 'Menunggu'),
(124, 'Fajar Firmansyah', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'sssaaacccxxxxxzzz', '2024-12-20 05:01:45', 'Menunggu'),
(125, 'Kinje', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'hmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', '2024-12-20 13:12:42', 'Menunggu'),
(126, 'Fije', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'adddddddddddddddddddddddddddddddddddddddddddddeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2024-12-20 13:18:14', 'Menunggu'),
(127, 'Fajar Firmansyah', 'fajar.wdg@gmail.com', '083820604742', 'Sukabumi', 0, 'cv.jpg', 'aduh aduh', '2024-12-20 13:29:01', 'Menunggu'),
(128, 'qinje', 'fajar.wdg@gmail.com', '083820604742', 'Bandung', 0, 'cv.jpg', 'hhhh', '2024-12-20 13:32:06', 'Menunggu'),
(129, 'Fajar Firmansyah', 'fajar.wdg@gmail.com', '083820604742', 'Bandung', 0, 'cv.jpg', 'percobaan lagi', '2024-12-20 13:36:41', 'Menunggu'),
(130, 'Ramon Mister Hadi', 'ramon.isterhadi@gmail.com', '085384525425', 'Bekasi', 0, 'Belakang_UND.png', 'Percobaan Kirim Email melalui Web Pengaduan', '2024-12-20 13:55:07', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `isi_tanggapan` varchar(2048) NOT NULL,
  `tanggal_tanggapan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_laporan`, `admin`, `isi_tanggapan`, `tanggal_tanggapan`) VALUES
(5, 101, 'Admin', 'kami akan menindak lanjuti dan mengirim petugas pihak desa untuk mengecek kelokasi agar bisa kami tanggapi', '2024-10-28 13:37:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `divisi` (`divisi`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tujuan` (`tujuan`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`divisi`) REFERENCES `divisi` (`id_divisi`);

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`tujuan`) REFERENCES `divisi` (`id_divisi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
