-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2017 at 08:58 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `aluni_anggota_akademik`
--

CREATE TABLE `aluni_anggota_akademik` (
  `id_anggota` int(12) NOT NULL,
  `angkatan` varchar(50) DEFAULT NULL COMMENT 'Angkatan',
  `tahun_masuk` int(4) NOT NULL,
  `tahun_keluar` int(4) DEFAULT NULL,
  `kelas_terakhir` varchar(100) DEFAULT NULL,
  `catatan` text,
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revisi` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_anggota_akademik`
--

INSERT INTO `aluni_anggota_akademik` (`id_anggota`, `angkatan`, `tahun_masuk`, `tahun_keluar`, `kelas_terakhir`, `catatan`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revisi`) VALUES
(1, '', 0, 0, '', '', 'admin', '2017-02-17 10:43:52', 'admin', '2017-02-18 02:15:48', 2);

-- --------------------------------------------------------

--
-- Table structure for table `aluni_anggota_dasar`
--

CREATE TABLE `aluni_anggota_dasar` (
  `id_anggota` int(12) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_panggilan` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `foto` blob,
  `id_provinsi` int(4) NOT NULL,
  `id_kota` int(4) NOT NULL,
  `alamat` text,
  `aktif` enum('ya','tidak') NOT NULL DEFAULT 'ya',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revisi` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_anggota_dasar`
--

INSERT INTO `aluni_anggota_dasar` (`id_anggota`, `nama_lengkap`, `nama_panggilan`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `agama`, `foto`, `id_provinsi`, `id_kota`, `alamat`, `aktif`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revisi`) VALUES
(1, 'Bagus Dwiky Wicaksono', 'Bagus fever', 'laki-laki', 'Kabupaten Nganjuk', '2017-02-16', '1', 0x7365646f74636f64652e6a7067, 15, 0, '<p>Jalan t<strong>erus jadian kapan</strong></p>', 'ya', 'admin', '2017-02-17 10:43:52', 'admin', '2017-02-18 02:15:48', 2);

-- --------------------------------------------------------

--
-- Table structure for table `aluni_anggota_keluarga`
--

CREATE TABLE `aluni_anggota_keluarga` (
  `id_anggota` int(12) NOT NULL COMMENT 'FK member_basic_info',
  `nama_pasangan` varchar(100) DEFAULT NULL COMMENT 'Suami atau istri',
  `nama_anak` varchar(500) DEFAULT NULL COMMENT 'Array : anak',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revisi` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_anggota_keluarga`
--

INSERT INTO `aluni_anggota_keluarga` (`id_anggota`, `nama_pasangan`, `nama_anak`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revisi`) VALUES
(1, '', '', 'admin', '2017-02-17 10:43:52', 'admin', '2017-02-18 02:15:48', 2);

-- --------------------------------------------------------

--
-- Table structure for table `aluni_anggota_kontak`
--

CREATE TABLE `aluni_anggota_kontak` (
  `id_anggota` int(12) NOT NULL,
  `no_rumah` varchar(15) DEFAULT NULL,
  `no_handphone` varchar(15) DEFAULT NULL,
  `no_handphone2` varchar(15) DEFAULT NULL,
  `pin_blackberry` varchar(10) DEFAULT NULL,
  `alamat_email` varchar(50) DEFAULT NULL,
  `alamat_website` varchar(50) DEFAULT NULL,
  `facebook` varchar(150) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revisi` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_anggota_kontak`
--

INSERT INTO `aluni_anggota_kontak` (`id_anggota`, `no_rumah`, `no_handphone`, `no_handphone2`, `pin_blackberry`, `alamat_email`, `alamat_website`, `facebook`, `twitter`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revisi`) VALUES
(1, '', '', '', '', '', 'http://sedotcode.blogspot.co.id/', '', '', 'admin', '2017-02-17 10:43:52', 'admin', '2017-02-18 02:15:48', 2);

-- --------------------------------------------------------

--
-- Table structure for table `aluni_anggota_orang_tua`
--

CREATE TABLE `aluni_anggota_orang_tua` (
  `id_anggota` int(12) NOT NULL COMMENT 'FK member_basic_info',
  `nama_ayah` varchar(100) DEFAULT NULL COMMENT 'Ayah',
  `nama_ibu` varchar(100) DEFAULT NULL COMMENT 'Ibu',
  `nama_wali` varchar(100) DEFAULT NULL COMMENT 'Wali (jika ada)',
  `id_provinsi` int(4) DEFAULT NULL,
  `id_kota` int(4) DEFAULT NULL,
  `alamat_orang_tua` text,
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revisi` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_anggota_orang_tua`
--

INSERT INTO `aluni_anggota_orang_tua` (`id_anggota`, `nama_ayah`, `nama_ibu`, `nama_wali`, `id_provinsi`, `id_kota`, `alamat_orang_tua`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revisi`) VALUES
(1, '', '', '', 0, 0, '', 'admin', '2017-02-17 10:43:52', 'admin', '2017-02-18 02:15:48', 2);

-- --------------------------------------------------------

--
-- Table structure for table `aluni_m_agama`
--

CREATE TABLE `aluni_m_agama` (
  `id_agama` int(2) NOT NULL,
  `nama_agama` varchar(30) NOT NULL COMMENT 'English',
  `aktif` enum('ya','tidak') NOT NULL DEFAULT 'ya',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_m_agama`
--

INSERT INTO `aluni_m_agama` (`id_agama`, `nama_agama`, `aktif`, `created_date`) VALUES
(1, 'Islam', 'ya', '2016-03-21 14:29:00'),
(2, 'Kristen', 'ya', '2016-03-21 14:29:00'),
(3, 'Katholik', 'ya', '2016-03-21 14:29:00'),
(4, 'Budha', 'ya', '2016-03-21 14:29:00'),
(5, 'Hindu', 'ya', '2016-03-21 14:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `aluni_m_kota`
--

CREATE TABLE `aluni_m_kota` (
  `id_provinsi` int(4) NOT NULL,
  `id_kota` int(4) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `aktif` enum('ya','tidak') NOT NULL DEFAULT 'ya',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_m_kota`
--

INSERT INTO `aluni_m_kota` (`id_provinsi`, `id_kota`, `nama_kota`, `aktif`, `created_date`) VALUES
(1, 1, 'Kabupaten Aceh Barat', 'ya', '2016-01-20 14:00:38'),
(1, 2, 'Kabupaten Aceh Barat Daya', 'ya', '2016-01-20 14:00:38'),
(1, 3, 'Kabupaten Aceh Besar', 'ya', '2016-01-20 14:00:38'),
(1, 4, 'Kabupaten Aceh Jaya', 'ya', '2016-01-20 14:00:38'),
(1, 5, 'Kabupaten Aceh Selatan', 'ya', '2016-01-20 14:00:38'),
(1, 6, 'Kabupaten Aceh Singkil', 'ya', '2016-01-20 14:00:38'),
(1, 7, 'Kabupaten Aceh Tamiang', 'ya', '2016-01-20 14:00:38'),
(1, 8, 'Kabupaten Aceh Tengah', 'ya', '2016-01-20 14:00:38'),
(1, 9, 'Kabupaten Aceh Tenggara', 'ya', '2016-01-20 14:00:38'),
(1, 10, 'Kabupaten Aceh Timur', 'ya', '2016-01-20 14:00:38'),
(1, 11, 'Kabupaten Aceh Utara', 'ya', '2016-01-20 14:00:38'),
(1, 12, 'Kabupaten Bener Meriah', 'ya', '2016-01-20 14:00:38'),
(1, 13, 'Kabupaten Bireuen', 'ya', '2016-01-20 14:00:38'),
(1, 14, 'Kabupaten Gayo Lues', 'ya', '2016-01-20 14:00:38'),
(1, 15, 'Kabupaten Nagan Raya', 'ya', '2016-01-20 14:00:38'),
(1, 16, 'Kabupaten Pidie', 'ya', '2016-01-20 14:00:38'),
(1, 17, 'Kabupaten Pidie Jaya', 'ya', '2016-01-20 14:00:38'),
(1, 18, 'Kabupaten Simeulue', 'ya', '2016-01-20 14:00:38'),
(1, 19, 'Kota Banda Aceh', 'ya', '2016-01-20 14:00:38'),
(1, 20, 'Kota Langsa', 'ya', '2016-01-20 14:00:38'),
(1, 21, 'Kota Lhokseumawe', 'ya', '2016-01-20 14:00:38'),
(1, 22, 'Kota Sabang', 'ya', '2016-01-20 14:00:38'),
(1, 23, 'Kota Subulussalam', 'ya', '2016-01-20 14:00:38'),
(2, 24, 'Kabupaten Asahan', 'ya', '2016-01-20 14:06:24'),
(2, 25, 'Kabupaten Batubara', 'ya', '2016-01-20 14:06:24'),
(2, 26, 'Kabupaten Dairi', 'ya', '2016-01-20 14:06:24'),
(2, 27, 'Kabupaten Deli Serdang', 'ya', '2016-01-20 14:06:24'),
(2, 28, 'Kabupaten Humbang Hasundutan', 'ya', '2016-01-20 14:06:24'),
(2, 29, 'Kabupaten Karo', 'ya', '2016-01-20 14:06:24'),
(2, 30, 'Kabupaten Labuhanbatu', 'ya', '2016-01-20 14:06:24'),
(2, 31, 'Kabupaten Labuhanbatu Selatan', 'ya', '2016-01-20 14:06:24'),
(2, 32, 'Kabupaten Labuhanbatu Utara', 'ya', '2016-01-20 14:06:24'),
(2, 33, 'Kabupaten Langkat', 'ya', '2016-01-20 14:06:24'),
(2, 34, 'Kabupaten Mandailing Natal', 'ya', '2016-01-20 14:06:24'),
(2, 35, 'Kabupaten Nias', 'ya', '2016-01-20 14:06:24'),
(2, 36, 'Kabupaten Nias Barat', 'ya', '2016-01-20 14:06:24'),
(2, 37, 'Kabupaten Nias Selatan', 'ya', '2016-01-20 14:06:24'),
(2, 38, 'Kabupaten Nias Utara', 'ya', '2016-01-20 14:06:24'),
(2, 39, 'Kabupaten Padang Lawas', 'ya', '2016-01-20 14:06:24'),
(2, 40, 'Kabupaten Padang Lawas Utara', 'ya', '2016-01-20 14:06:24'),
(2, 41, 'Kabupaten Pakpak Bharat', 'ya', '2016-01-20 14:06:24'),
(2, 42, 'Kabupaten Samosir', 'ya', '2016-01-20 14:06:24'),
(2, 43, 'Kabupaten Serdang Bedagai', 'ya', '2016-01-20 14:06:24'),
(2, 44, 'Kabupaten Simalungun', 'ya', '2016-01-20 14:06:24'),
(2, 45, 'Kabupaten Tapanuli Selatan', 'ya', '2016-01-20 14:06:24'),
(2, 46, 'Kabupaten Tapanuli Tengah', 'ya', '2016-01-20 14:06:24'),
(2, 47, 'Kabupaten Tapanuli Utara', 'ya', '2016-01-20 14:06:24'),
(2, 48, 'Kabupaten Toba Samosir', 'ya', '2016-01-20 14:06:24'),
(2, 49, 'Kota Binjai', 'ya', '2016-01-20 14:06:24'),
(2, 50, 'Kota Gunungsitoli', 'ya', '2016-01-20 14:06:24'),
(2, 51, 'Kota Medan', 'ya', '2016-01-20 14:06:24'),
(2, 52, 'Kota Padangsidempuan', 'ya', '2016-01-20 14:06:24'),
(2, 53, 'Kota Pematangsiantar', 'ya', '2016-01-20 14:06:24'),
(2, 54, 'Kota Sibolga', 'ya', '2016-01-20 14:06:24'),
(2, 55, 'Kota Tanjungbalai', 'ya', '2016-01-20 14:06:24'),
(2, 56, 'Kota Tebing Tinggi', 'ya', '2016-01-20 14:06:24'),
(3, 57, 'Kabupaten Agam', 'ya', '2016-01-20 14:08:24'),
(3, 58, 'Kabupaten Dharmasraya', 'ya', '2016-01-20 14:08:24'),
(3, 59, 'Kabupaten Kepulauan Mentawai', 'ya', '2016-01-20 14:08:24'),
(3, 60, 'Kabupaten Lima Puluh Kota', 'ya', '2016-01-20 14:08:24'),
(3, 61, 'Kabupaten Padang Pariaman', 'ya', '2016-01-20 14:08:24'),
(3, 62, 'Kabupaten Pasaman', 'ya', '2016-01-20 14:08:24'),
(3, 63, 'Kabupaten Pasaman Barat', 'ya', '2016-01-20 14:08:24'),
(3, 64, 'Kabupaten Pesisir Selatan', 'ya', '2016-01-20 14:08:24'),
(3, 65, 'Kabupaten Sijunjung', 'ya', '2016-01-20 14:08:24'),
(3, 66, 'Kabupaten Solok', 'ya', '2016-01-20 14:08:24'),
(3, 67, 'Kabupaten Solok Selatan', 'ya', '2016-01-20 14:08:24'),
(3, 68, 'Kabupaten Tanah Datar', 'ya', '2016-01-20 14:08:24'),
(3, 69, 'Kota Bukittinggi', 'ya', '2016-01-20 14:08:24'),
(3, 70, 'Kota Padang', 'ya', '2016-01-20 14:08:24'),
(3, 71, 'Kota Padangpanjang', 'ya', '2016-01-20 14:08:24'),
(3, 72, 'Kota Pariaman', 'ya', '2016-01-20 14:08:24'),
(3, 73, 'Kota Payakumbuh', 'ya', '2016-01-20 14:08:24'),
(3, 74, 'Kota Sawahlunto', 'ya', '2016-01-20 14:08:24'),
(3, 75, 'Kota Solok', 'ya', '2016-01-20 14:08:24'),
(4, 76, 'Kabupaten Bengkalis', 'ya', '2016-01-20 14:10:36'),
(4, 77, 'Kabupaten Indragiri Hilir', 'ya', '2016-01-20 14:10:36'),
(4, 78, 'Kabupaten Indragiri Hulu', 'ya', '2016-01-20 14:10:36'),
(4, 79, 'Kabupaten Kampar', 'ya', '2016-01-20 14:10:36'),
(4, 80, 'Kabupaten Kuantan Singingi', 'ya', '2016-01-20 14:10:36'),
(4, 81, 'Kabupaten Pelalawan', 'ya', '2016-01-20 14:10:36'),
(4, 82, 'Kabupaten Rokan Hilir', 'ya', '2016-01-20 14:10:36'),
(4, 83, 'Kabupaten Rokan Hulu', 'ya', '2016-01-20 14:10:36'),
(4, 84, 'Kabupaten Siak', 'ya', '2016-01-20 14:10:36'),
(4, 85, 'Kabupaten Kepulauan Meranti', 'ya', '2016-01-20 14:10:36'),
(4, 86, 'Kota Dumai', 'ya', '2016-01-20 14:10:36'),
(4, 87, 'Kota Pekanbaru', 'ya', '2016-01-20 14:10:36'),
(5, 88, 'Kabupaten Bintan', 'ya', '2016-01-20 14:11:35'),
(5, 89, 'Kabupaten Karimun', 'ya', '2016-01-20 14:11:35'),
(5, 90, 'Kabupaten Kepulauan Anambas', 'ya', '2016-01-20 14:11:35'),
(5, 91, 'Kabupaten Lingga', 'ya', '2016-01-20 14:11:35'),
(5, 92, 'Kabupaten Natuna', 'ya', '2016-01-20 14:11:35'),
(5, 93, 'Kota Batam', 'ya', '2016-01-20 14:11:35'),
(5, 94, 'Kota Tanjung Pinang', 'ya', '2016-01-20 14:11:35'),
(6, 95, 'Kabupaten Batanghari', 'ya', '2016-01-20 14:12:32'),
(6, 96, 'Kabupaten Bungo', 'ya', '2016-01-20 14:12:32'),
(6, 97, 'Kabupaten Kerinci', 'ya', '2016-01-20 14:12:32'),
(6, 98, 'Kabupaten Merangin', 'ya', '2016-01-20 14:12:32'),
(6, 99, 'Kabupaten Muaro Jambi', 'ya', '2016-01-20 14:12:32'),
(6, 100, 'Kabupaten Sarolangun', 'ya', '2016-01-20 14:12:32'),
(6, 101, 'Kabupaten Tanjung Jabung Barat', 'ya', '2016-01-20 14:12:32'),
(6, 102, 'Kabupaten Tanjung Jabung Timur', 'ya', '2016-01-20 14:12:32'),
(6, 103, 'Kabupaten Tebo', 'ya', '2016-01-20 14:12:32'),
(6, 104, 'Kota Jambi', 'ya', '2016-01-20 14:12:32'),
(6, 105, 'Kota Sungai Penuh', 'ya', '2016-01-20 14:12:32'),
(7, 106, 'Kabupaten Bengkulu Selatan', 'ya', '2016-01-20 14:13:37'),
(7, 107, 'Kabupaten Bengkulu Tengah', 'ya', '2016-01-20 14:13:37'),
(7, 108, 'Kabupaten Bengkulu Utara', 'ya', '2016-01-20 14:13:37'),
(7, 109, 'Kabupaten Kaur', 'ya', '2016-01-20 14:13:37'),
(7, 110, 'Kabupaten Kepahiang', 'ya', '2016-01-20 14:13:37'),
(7, 111, 'Kabupaten Lebong', 'ya', '2016-01-20 14:13:37'),
(7, 112, 'Kabupaten Mukomuko', 'ya', '2016-01-20 14:13:37'),
(7, 113, 'Kabupaten Rejang Lebong', 'ya', '2016-01-20 14:13:37'),
(7, 114, 'Kabupaten Seluma', 'ya', '2016-01-20 14:13:37'),
(7, 115, 'Kota Bengkulu', 'ya', '2016-01-20 14:13:37'),
(8, 116, 'Kabupaten Banyuasin', 'ya', '2016-01-20 14:14:50'),
(8, 117, 'Kabupaten Empat Lawang', 'ya', '2016-01-20 14:14:50'),
(8, 118, 'Kabupaten Lahat', 'ya', '2016-01-20 14:14:50'),
(8, 119, 'Kabupaten Muara Enim', 'ya', '2016-01-20 14:14:50'),
(8, 120, 'Kabupaten Musi Banyuasin', 'ya', '2016-01-20 14:14:50'),
(8, 121, 'Kabupaten Musi Rawas', 'ya', '2016-01-20 14:14:50'),
(8, 122, 'Kabupaten Ogan Ilir', 'ya', '2016-01-20 14:14:50'),
(8, 123, 'Kabupaten Ogan Komering Ilir', 'ya', '2016-01-20 14:14:50'),
(8, 124, 'Kabupaten Ogan Komering Ulu', 'ya', '2016-01-20 14:14:50'),
(8, 125, 'Kabupaten Ogan Komering Ulu Selatan', 'ya', '2016-01-20 14:14:50'),
(8, 126, 'Kabupaten Ogan Komering Ulu Timur', 'ya', '2016-01-20 14:14:50'),
(8, 127, 'Kota Lubuklinggau', 'ya', '2016-01-20 14:14:50'),
(8, 128, 'Kota Pagar Alam', 'ya', '2016-01-20 14:14:50'),
(8, 129, 'Kota Palembang', 'ya', '2016-01-20 14:14:50'),
(8, 130, 'Kota Prabumulih', 'ya', '2016-01-20 14:14:50'),
(9, 131, 'Kabupaten Bangka', 'ya', '2016-01-20 14:15:52'),
(9, 132, 'Kabupaten Bangka Barat', 'ya', '2016-01-20 14:15:52'),
(9, 133, 'Kabupaten Bangka Selatan', 'ya', '2016-01-20 14:15:52'),
(9, 134, 'Kabupaten Bangka Tengah', 'ya', '2016-01-20 14:15:52'),
(9, 135, 'Kabupaten Belitung', 'ya', '2016-01-20 14:15:52'),
(9, 136, 'Kabupaten Belitung Timur', 'ya', '2016-01-20 14:15:52'),
(9, 137, 'Kota Pangkal Pinang', 'ya', '2016-01-20 14:15:52'),
(10, 138, 'Kabupaten Lampung Barat', 'ya', '2016-01-20 14:17:02'),
(10, 139, 'Kabupaten Lampung Selatan', 'ya', '2016-01-20 14:17:02'),
(10, 140, 'Kabupaten Lampung Tengah', 'ya', '2016-01-20 14:17:02'),
(10, 141, 'Kabupaten Lampung Timur', 'ya', '2016-01-20 14:17:02'),
(10, 142, 'Kabupaten Lampung Utara', 'ya', '2016-01-20 14:17:02'),
(10, 143, 'Kabupaten Mesuji', 'ya', '2016-01-20 14:17:02'),
(10, 144, 'Kabupaten Pesawaran', 'ya', '2016-01-20 14:17:02'),
(10, 145, 'Kabupaten Pringsewu', 'ya', '2016-01-20 14:17:02'),
(10, 146, 'Kabupaten Tanggamus', 'ya', '2016-01-20 14:17:02'),
(10, 147, 'Kabupaten Tulang Bawang', 'ya', '2016-01-20 14:17:02'),
(10, 148, 'Kabupaten Tulang Bawang Barat', 'ya', '2016-01-20 14:17:02'),
(10, 149, 'Kabupaten Way Kanan', 'ya', '2016-01-20 14:17:02'),
(10, 150, 'Kota Bandar Lampung', 'ya', '2016-01-20 14:17:02'),
(10, 151, 'Kota Metro', 'ya', '2016-01-20 14:17:02'),
(11, 152, 'Kabupaten Tangerang', 'ya', '2016-01-20 14:19:56'),
(11, 153, 'Kabupaten Serang', 'ya', '2016-01-20 14:19:56'),
(11, 154, 'Kabupaten Lebak', 'ya', '2016-01-20 14:19:56'),
(11, 155, 'Kabupaten Pandeglang', 'ya', '2016-01-20 14:19:56'),
(11, 156, 'Kota Tangerang', 'ya', '2016-01-20 14:19:56'),
(11, 157, 'Kota Serang', 'ya', '2016-01-20 14:19:56'),
(11, 158, 'Kota Cilegon', 'ya', '2016-01-20 14:19:56'),
(11, 159, 'Kota Tangerang Selatan', 'ya', '2016-01-20 14:19:56'),
(12, 160, 'Kabupaten Bandung', 'ya', '2016-01-20 14:21:04'),
(12, 161, 'Kabupaten Bandung Barat', 'ya', '2016-01-20 14:21:04'),
(12, 162, 'Kabupaten Bekasi', 'ya', '2016-01-20 14:21:04'),
(12, 163, 'Kabupaten Bogor', 'ya', '2016-01-20 14:21:04'),
(12, 164, 'Kabupaten Ciamis', 'ya', '2016-01-20 14:21:04'),
(12, 165, 'Kabupaten Cianjur', 'ya', '2016-01-20 14:21:04'),
(12, 166, 'Kabupaten Cirebon', 'ya', '2016-01-20 14:21:04'),
(12, 167, 'Kabupaten Garut', 'ya', '2016-01-20 14:21:04'),
(12, 168, 'Kabupaten Indramayu', 'ya', '2016-01-20 14:21:04'),
(12, 169, 'Kabupaten Karawang', 'ya', '2016-01-20 14:21:04'),
(12, 170, 'Kabupaten Kuningan', 'ya', '2016-01-20 14:21:04'),
(12, 171, 'Kabupaten Majalengka', 'ya', '2016-01-20 14:21:04'),
(12, 172, 'Kabupaten Purwakarta', 'ya', '2016-01-20 14:21:04'),
(12, 173, 'Kabupaten Subang', 'ya', '2016-01-20 14:21:04'),
(12, 174, 'Kabupaten Sukabumi', 'ya', '2016-01-20 14:21:04'),
(12, 175, 'Kabupaten Sumedang', 'ya', '2016-01-20 14:21:04'),
(12, 176, 'Kabupaten Tasikmalaya', 'ya', '2016-01-20 14:21:04'),
(12, 177, 'Kota Bandung', 'ya', '2016-01-20 14:21:04'),
(12, 178, 'Kota Banjar', 'ya', '2016-01-20 14:21:04'),
(12, 179, 'Kota Bekasi', 'ya', '2016-01-20 14:21:04'),
(12, 180, 'Kota Bogor', 'ya', '2016-01-20 14:21:04'),
(12, 181, 'Kota Cimahi', 'ya', '2016-01-20 14:21:04'),
(12, 182, 'Kota Cirebon', 'ya', '2016-01-20 14:21:04'),
(12, 183, 'Kota Depok', 'ya', '2016-01-20 14:21:04'),
(12, 184, 'Kota Sukabumi', 'ya', '2016-01-20 14:21:04'),
(12, 185, 'Kota Tasikmalaya', 'ya', '2016-01-20 14:21:04'),
(13, 186, 'Kabupaten Administrasi Kepulauan Seribu', 'ya', '2016-01-20 14:22:02'),
(13, 187, 'Kota Administrasi Jakarta Barat', 'ya', '2016-01-20 14:22:02'),
(13, 188, 'Kota Administrasi Jakarta Pusat', 'ya', '2016-01-20 14:22:02'),
(13, 189, 'Kota Administrasi Jakarta Selatan', 'ya', '2016-01-20 14:22:02'),
(13, 190, 'Kota Administrasi Jakarta Timur', 'ya', '2016-01-20 14:22:02'),
(13, 191, 'Kota Administrasi Jakarta Utara', 'ya', '2016-01-20 14:22:02'),
(14, 192, 'Kabupaten Banjarnegara', 'ya', '2016-01-20 14:23:27'),
(14, 193, 'Kabupaten Banyumas', 'ya', '2016-01-20 14:23:27'),
(14, 194, 'Kabupaten Batang', 'ya', '2016-01-20 14:23:27'),
(14, 195, 'Kabupaten Blora', 'ya', '2016-01-20 14:23:27'),
(14, 196, 'Kabupaten Boyolali', 'ya', '2016-01-20 14:23:27'),
(14, 197, 'Kabupaten Brebes', 'ya', '2016-01-20 14:23:27'),
(14, 198, 'Kabupaten Cilacap', 'ya', '2016-01-20 14:23:27'),
(14, 199, 'Kabupaten Demak', 'ya', '2016-01-20 14:23:27'),
(14, 200, 'Kabupaten Grobogan', 'ya', '2016-01-20 14:23:27'),
(14, 201, 'Kabupaten Jepara', 'ya', '2016-01-20 14:23:27'),
(14, 202, 'Kabupaten Karanganyar', 'ya', '2016-01-20 14:23:27'),
(14, 203, 'Kabupaten Kebumen', 'ya', '2016-01-20 14:23:27'),
(14, 204, 'Kabupaten Kendal', 'ya', '2016-01-20 14:23:27'),
(14, 205, 'Kabupaten Klaten', 'ya', '2016-01-20 14:23:27'),
(14, 206, 'Kabupaten Kudus', 'ya', '2016-01-20 14:23:27'),
(14, 207, 'Kabupaten Magelang', 'ya', '2016-01-20 14:23:27'),
(14, 208, 'Kabupaten Pati', 'ya', '2016-01-20 14:23:27'),
(14, 209, 'Kabupaten Pekalongan', 'ya', '2016-01-20 14:23:27'),
(14, 210, 'Kabupaten Pemalang', 'ya', '2016-01-20 14:23:27'),
(14, 211, 'Kabupaten Purbalingga', 'ya', '2016-01-20 14:23:27'),
(14, 212, 'Kabupaten Purworejo', 'ya', '2016-01-20 14:23:27'),
(14, 213, 'Kabupaten Rembang', 'ya', '2016-01-20 14:23:27'),
(14, 214, 'Kabupaten Semarang', 'ya', '2016-01-20 14:23:27'),
(14, 215, 'Kabupaten Sragen', 'ya', '2016-01-20 14:23:27'),
(14, 216, 'Kabupaten Sukoharjo', 'ya', '2016-01-20 14:23:27'),
(14, 217, 'Kabupaten Tegal', 'ya', '2016-01-20 14:23:27'),
(14, 218, 'Kabupaten Temanggung', 'ya', '2016-01-20 14:23:27'),
(14, 219, 'Kabupaten Wonogiri', 'ya', '2016-01-20 14:23:27'),
(14, 220, 'Kabupaten Wonosobo', 'ya', '2016-01-20 14:23:27'),
(14, 221, 'Kota Magelang', 'ya', '2016-01-20 14:23:27'),
(14, 222, 'Kota Pekalongan', 'ya', '2016-01-20 14:23:27'),
(14, 223, 'Kota Salatiga', 'ya', '2016-01-20 14:23:27'),
(14, 224, 'Kota Semarang', 'ya', '2016-01-20 14:23:27'),
(14, 225, 'Kota Surakarta', 'ya', '2016-01-20 14:23:27'),
(14, 226, 'Kota Tegal', 'ya', '2016-01-20 14:23:27'),
(15, 227, 'Kabupaten Bangkalan', 'ya', '2016-01-20 14:25:05'),
(15, 228, 'Kabupaten Banyuwangi', 'ya', '2016-01-20 14:25:05'),
(15, 229, 'Kabupaten Blitar', 'ya', '2016-01-20 14:25:05'),
(15, 230, 'Kabupaten Bojonegoro', 'ya', '2016-01-20 14:25:05'),
(15, 231, 'Kabupaten Bondowoso', 'ya', '2016-01-20 14:25:05'),
(15, 232, 'Kabupaten Gresik', 'ya', '2016-01-20 14:25:05'),
(15, 233, 'Kabupaten Jember', 'ya', '2016-01-20 14:25:05'),
(15, 234, 'Kabupaten Jombang', 'ya', '2016-01-20 14:25:05'),
(15, 235, 'Kabupaten Kediri', 'ya', '2016-01-20 14:25:05'),
(15, 236, 'Kabupaten Lamongan', 'ya', '2016-01-20 14:25:05'),
(15, 237, 'Kabupaten Lumajang', 'ya', '2016-01-20 14:25:05'),
(15, 238, 'Kabupaten Madiun', 'ya', '2016-01-20 14:25:05'),
(15, 239, 'Kabupaten Magetan', 'ya', '2016-01-20 14:25:05'),
(15, 240, 'Kabupaten Malang', 'ya', '2016-01-20 14:25:05'),
(15, 241, 'Kabupaten Mojokerto', 'ya', '2016-01-20 14:25:05'),
(15, 242, 'Kabupaten Nganjuk', 'ya', '2016-01-20 14:25:05'),
(15, 243, 'Kabupaten Ngawi', 'ya', '2016-01-20 14:25:05'),
(15, 244, 'Kabupaten Pacitan', 'ya', '2016-01-20 14:25:05'),
(15, 245, 'Kabupaten Pamekasan', 'ya', '2016-01-20 14:25:05'),
(15, 246, 'Kabupaten Pasuruan', 'ya', '2016-01-20 14:25:05'),
(15, 247, 'Kabupaten Ponorogo', 'ya', '2016-01-20 14:25:05'),
(15, 248, 'Kabupaten Probolinggo', 'ya', '2016-01-20 14:25:05'),
(15, 249, 'Kabupaten Sampang', 'ya', '2016-01-20 14:25:05'),
(15, 250, 'Kabupaten Sidoarjo', 'ya', '2016-01-20 14:25:05'),
(15, 251, 'Kabupaten Situbondo', 'ya', '2016-01-20 14:25:05'),
(15, 252, 'Kabupaten Sumenep', 'ya', '2016-01-20 14:25:05'),
(15, 253, 'Kabupaten Trenggalek', 'ya', '2016-01-20 14:25:05'),
(15, 254, 'Kabupaten Tuban', 'ya', '2016-01-20 14:25:05'),
(15, 255, 'Kabupaten Tulungagung', 'ya', '2016-01-20 14:25:05'),
(15, 256, 'Kota Batu', 'ya', '2016-01-20 14:25:05'),
(15, 257, 'Kota Blitar', 'ya', '2016-01-20 14:25:05'),
(15, 258, 'Kota Kediri', 'ya', '2016-01-20 14:25:05'),
(15, 259, 'Kota Madiun', 'ya', '2016-01-20 14:25:05'),
(15, 260, 'Kota Malang', 'ya', '2016-01-20 14:25:05'),
(15, 261, 'Kota Mojokerto', 'ya', '2016-01-20 14:25:05'),
(15, 262, 'Kota Pasuruan', 'ya', '2016-01-20 14:25:05'),
(15, 263, 'Kota Probolinggo', 'ya', '2016-01-20 14:25:05'),
(15, 264, 'Kota Surabaya', 'ya', '2016-01-20 14:25:05'),
(16, 265, 'Kabupaten Bantul', 'ya', '2016-01-20 14:26:07'),
(16, 266, 'Kabupaten Gunung Kidul', 'ya', '2016-01-20 14:26:07'),
(16, 267, 'Kabupaten Kulon Progo', 'ya', '2016-01-20 14:26:07'),
(16, 268, 'Kabupaten Sleman', 'ya', '2016-01-20 14:26:07'),
(16, 269, 'Kota Yogyakarta', 'ya', '2016-01-20 14:26:07'),
(17, 270, 'Kabupaten Badung', 'ya', '2016-01-20 14:27:00'),
(17, 271, 'Kabupaten Bangli', 'ya', '2016-01-20 14:27:00'),
(17, 272, 'Kabupaten Buleleng', 'ya', '2016-01-20 14:27:00'),
(17, 273, 'Kabupaten Gianyar', 'ya', '2016-01-20 14:27:00'),
(17, 274, 'Kabupaten Jembrana', 'ya', '2016-01-20 14:27:00'),
(17, 275, 'Kabupaten Karangasem', 'ya', '2016-01-20 14:27:00'),
(17, 276, 'Kabupaten Klungkung', 'ya', '2016-01-20 14:27:00'),
(17, 277, 'Kabupaten Tabanan', 'ya', '2016-01-20 14:27:00'),
(17, 278, 'Kota Denpasar', 'ya', '2016-01-20 14:27:00'),
(18, 279, 'Kabupaten Bima', 'ya', '2016-01-20 14:27:49'),
(18, 280, 'Kabupaten Dompu', 'ya', '2016-01-20 14:27:49'),
(18, 281, 'Kabupaten Lombok Barat', 'ya', '2016-01-20 14:27:49'),
(18, 282, 'Kabupaten Lombok Tengah', 'ya', '2016-01-20 14:27:49'),
(18, 283, 'Kabupaten Lombok Timur', 'ya', '2016-01-20 14:27:49'),
(18, 284, 'Kabupaten Lombok Utara', 'ya', '2016-01-20 14:27:49'),
(18, 285, 'Kabupaten Sumbawa', 'ya', '2016-01-20 14:27:49'),
(18, 286, 'Kabupaten Sumbawa Barat', 'ya', '2016-01-20 14:27:49'),
(18, 287, 'Kota Bima', 'ya', '2016-01-20 14:27:49'),
(18, 288, 'Kota Mataram', 'ya', '2016-01-20 14:27:49'),
(19, 289, 'Kabupaten Alor', 'ya', '2016-01-20 14:28:44'),
(19, 290, 'Kabupaten Belu', 'ya', '2016-01-20 14:28:44'),
(19, 291, 'Kabupaten Ende', 'ya', '2016-01-20 14:28:44'),
(19, 292, 'Kabupaten Flores Timur', 'ya', '2016-01-20 14:28:44'),
(19, 293, 'Kabupaten Kupang', 'ya', '2016-01-20 14:28:44'),
(19, 294, 'Kabupaten Lembata', 'ya', '2016-01-20 14:28:44'),
(19, 295, 'Kabupaten Manggarai', 'ya', '2016-01-20 14:28:44'),
(19, 296, 'Kabupaten Manggarai Barat', 'ya', '2016-01-20 14:28:44'),
(19, 297, 'Kabupaten Manggarai Timur', 'ya', '2016-01-20 14:28:44'),
(19, 298, 'Kabupaten Ngada', 'ya', '2016-01-20 14:28:44'),
(19, 299, 'Kabupaten Nagekeo', 'ya', '2016-01-20 14:28:44'),
(19, 300, 'Kabupaten Rote Ndao', 'ya', '2016-01-20 14:28:44'),
(19, 301, 'Kabupaten Sabu Raijua', 'ya', '2016-01-20 14:28:44'),
(19, 302, 'Kabupaten Sikka', 'ya', '2016-01-20 14:28:44'),
(19, 303, 'Kabupaten Sumba Barat', 'ya', '2016-01-20 14:28:44'),
(19, 304, 'Kabupaten Sumba Barat Daya', 'ya', '2016-01-20 14:28:44'),
(19, 305, 'Kabupaten Sumba Tengah', 'ya', '2016-01-20 14:28:44'),
(19, 306, 'Kabupaten Sumba Timur', 'ya', '2016-01-20 14:28:44'),
(19, 307, 'Kabupaten Timor Tengah Selatan', 'ya', '2016-01-20 14:28:44'),
(19, 308, 'Kabupaten Timor Tengah Utara', 'ya', '2016-01-20 14:28:44'),
(19, 309, 'Kota Kupang', 'ya', '2016-01-20 14:28:44'),
(20, 310, 'Kabupaten Bengkayang', 'ya', '2016-01-20 14:29:44'),
(20, 311, 'Kabupaten Kapuas Hulu', 'ya', '2016-01-20 14:29:44'),
(20, 312, 'Kabupaten Kayong Utara', 'ya', '2016-01-20 14:29:44'),
(20, 313, 'Kabupaten Ketapang', 'ya', '2016-01-20 14:29:44'),
(20, 314, 'Kabupaten Kubu Raya', 'ya', '2016-01-20 14:29:44'),
(20, 315, 'Kabupaten Landak', 'ya', '2016-01-20 14:29:44'),
(20, 316, 'Kabupaten Melawi', 'ya', '2016-01-20 14:29:44'),
(20, 317, 'Kabupaten Pontianak', 'ya', '2016-01-20 14:29:44'),
(20, 318, 'Kabupaten Sambas', 'ya', '2016-01-20 14:29:44'),
(20, 319, 'Kabupaten Sanggau', 'ya', '2016-01-20 14:29:44'),
(20, 320, 'Kabupaten Sekadau', 'ya', '2016-01-20 14:29:44'),
(20, 321, 'Kabupaten Sintang', 'ya', '2016-01-20 14:29:44'),
(20, 322, 'Kota Pontianak', 'ya', '2016-01-20 14:29:44'),
(20, 323, 'Kota Singkawang', 'ya', '2016-01-20 14:29:44'),
(21, 324, 'Kabupaten Balangan', 'ya', '2016-01-20 14:30:35'),
(21, 325, 'Kabupaten Banjar', 'ya', '2016-01-20 14:30:35'),
(21, 326, 'Kabupaten Barito Kuala', 'ya', '2016-01-20 14:30:35'),
(21, 327, 'Kabupaten Hulu Sungai Selatan', 'ya', '2016-01-20 14:30:35'),
(21, 328, 'Kabupaten Hulu Sungai Tengah', 'ya', '2016-01-20 14:30:35'),
(21, 329, 'Kabupaten Hulu Sungai Utara', 'ya', '2016-01-20 14:30:35'),
(21, 330, 'Kabupaten Kotabaru', 'ya', '2016-01-20 14:30:35'),
(21, 331, 'Kabupaten Tabalong', 'ya', '2016-01-20 14:30:35'),
(21, 332, 'Kabupaten Tanah Bumbu', 'ya', '2016-01-20 14:30:35'),
(21, 333, 'Kabupaten Tanah Laut', 'ya', '2016-01-20 14:30:35'),
(21, 334, 'Kabupaten Tapin', 'ya', '2016-01-20 14:30:35'),
(21, 335, 'Kota Banjarbaru', 'ya', '2016-01-20 14:30:35'),
(21, 336, 'Kota Banjarmasin', 'ya', '2016-01-20 14:30:35'),
(22, 337, 'Kabupaten Barito Selatan', 'ya', '2016-01-20 14:31:24'),
(22, 338, 'Kabupaten Barito Timur', 'ya', '2016-01-20 14:31:24'),
(22, 339, 'Kabupaten Barito Utara', 'ya', '2016-01-20 14:31:24'),
(22, 340, 'Kabupaten Gunung Mas', 'ya', '2016-01-20 14:31:24'),
(22, 341, 'Kabupaten Kapuas', 'ya', '2016-01-20 14:31:24'),
(22, 342, 'Kabupaten Katingan', 'ya', '2016-01-20 14:31:24'),
(22, 343, 'Kabupaten Kotawaringin Barat', 'ya', '2016-01-20 14:31:24'),
(22, 344, 'Kabupaten Kotawaringin Timur', 'ya', '2016-01-20 14:31:24'),
(22, 345, 'Kabupaten Lamandau', 'ya', '2016-01-20 14:31:24'),
(22, 346, 'Kabupaten Murung Raya', 'ya', '2016-01-20 14:31:24'),
(22, 347, 'Kabupaten Pulang Pisau', 'ya', '2016-01-20 14:31:24'),
(22, 348, 'Kabupaten Sukamara', 'ya', '2016-01-20 14:31:24'),
(22, 349, 'Kabupaten Seruyan', 'ya', '2016-01-20 14:31:24'),
(22, 350, 'Kota Palangka Raya', 'ya', '2016-01-20 14:31:24'),
(23, 351, 'Kabupaten Berau', 'ya', '2016-01-20 14:32:17'),
(24, 352, 'Kabupaten Bulungan', 'ya', '2016-01-20 14:32:17'),
(23, 353, 'Kabupaten Kutai Barat', 'ya', '2016-01-20 14:32:17'),
(23, 354, 'Kabupaten Kutai Kartanegara', 'ya', '2016-01-20 14:32:17'),
(23, 355, 'Kabupaten Kutai Timur', 'ya', '2016-01-20 14:32:17'),
(24, 356, 'Kabupaten Malinau', 'ya', '2016-01-20 14:32:17'),
(24, 357, 'Kabupaten Nunukan', 'ya', '2016-01-20 14:32:17'),
(23, 358, 'Kabupaten Paser', 'ya', '2016-01-20 14:32:17'),
(23, 359, 'Kabupaten Penajam Paser Utara', 'ya', '2016-01-20 14:32:17'),
(24, 360, 'Kabupaten Tana Tidung', 'ya', '2016-01-20 14:32:17'),
(23, 361, 'Kota Balikpapan', 'ya', '2016-01-20 14:32:17'),
(23, 362, 'Kota Bontang', 'ya', '2016-01-20 14:32:17'),
(23, 363, 'Kota Samarinda', 'ya', '2016-01-20 14:32:17'),
(24, 364, 'Kota Tarakan', 'ya', '2016-01-20 14:32:17'),
(23, 365, 'Kabupaten Mahakam Ulu', 'ya', '2016-01-20 14:32:17'),
(25, 366, 'Kabupaten Boalemo', 'ya', '2016-01-20 14:37:44'),
(25, 367, 'Kabupaten Bone Bolango', 'ya', '2016-01-20 14:37:44'),
(25, 368, 'Kabupaten Gorontalo', 'ya', '2016-01-20 14:37:44'),
(25, 369, 'Kabupaten Gorontalo Utara', 'ya', '2016-01-20 14:37:44'),
(25, 370, 'Kabupaten Pohuwato', 'ya', '2016-01-20 14:37:44'),
(25, 371, 'Kota Gorontalo', 'ya', '2016-01-20 14:37:44'),
(26, 372, 'Kabupaten Bantaeng', 'ya', '2016-01-20 14:38:34'),
(26, 373, 'Kabupaten Barru', 'ya', '2016-01-20 14:38:34'),
(26, 374, 'Kabupaten Bone', 'ya', '2016-01-20 14:38:34'),
(26, 375, 'Kabupaten Bulukumba', 'ya', '2016-01-20 14:38:34'),
(26, 376, 'Kabupaten Enrekang', 'ya', '2016-01-20 14:38:34'),
(26, 377, 'Kabupaten Gowa', 'ya', '2016-01-20 14:38:34'),
(26, 378, 'Kabupaten Jeneponto', 'ya', '2016-01-20 14:38:34'),
(26, 379, 'Kabupaten Kepulauan Selayar', 'ya', '2016-01-20 14:38:34'),
(26, 380, 'Kabupaten Luwu', 'ya', '2016-01-20 14:38:34'),
(26, 381, 'Kabupaten Luwu Timur', 'ya', '2016-01-20 14:38:34'),
(26, 382, 'Kabupaten Luwu Utara', 'ya', '2016-01-20 14:38:34'),
(26, 383, 'Kabupaten Maros', 'ya', '2016-01-20 14:38:34'),
(26, 384, 'Kabupaten Pangkajene dan Kepulauan', 'ya', '2016-01-20 14:38:34'),
(26, 385, 'Kabupaten Pinrang', 'ya', '2016-01-20 14:38:34'),
(26, 386, 'Kabupaten Sidenreng Rappang', 'ya', '2016-01-20 14:38:34'),
(26, 387, 'Kabupaten Sinjai', 'ya', '2016-01-20 14:38:34'),
(26, 388, 'Kabupaten Soppeng', 'ya', '2016-01-20 14:38:34'),
(26, 389, 'Kabupaten Takalar', 'ya', '2016-01-20 14:38:34'),
(26, 390, 'Kabupaten Tana Toraja', 'ya', '2016-01-20 14:38:34'),
(26, 391, 'Kabupaten Toraja Utara', 'ya', '2016-01-20 14:38:34'),
(26, 392, 'Kabupaten Wajo', 'ya', '2016-01-20 14:38:34'),
(26, 393, 'Kota Makassar', 'ya', '2016-01-20 14:38:34'),
(26, 394, 'Kota Palopo', 'ya', '2016-01-20 14:38:34'),
(26, 395, 'Kota Parepare', 'ya', '2016-01-20 14:38:34'),
(27, 396, 'Kabupaten Bombana', 'ya', '2016-01-20 14:39:30'),
(27, 397, 'Kabupaten Buton', 'ya', '2016-01-20 14:39:30'),
(27, 398, 'Kabupaten Buton Utara', 'ya', '2016-01-20 14:39:30'),
(27, 399, 'Kabupaten Kolaka', 'ya', '2016-01-20 14:39:30'),
(27, 400, 'Kabupaten Kolaka Utara', 'ya', '2016-01-20 14:39:30'),
(27, 401, 'Kabupaten Konawe', 'ya', '2016-01-20 14:39:30'),
(27, 402, 'Kabupaten Konawe Selatan', 'ya', '2016-01-20 14:39:30'),
(27, 403, 'Kabupaten Konawe Utara', 'ya', '2016-01-20 14:39:30'),
(27, 404, 'Kabupaten Muna', 'ya', '2016-01-20 14:39:30'),
(27, 405, 'Kabupaten Wakatobi', 'ya', '2016-01-20 14:39:30'),
(27, 406, 'Kota Bau-Bau', 'ya', '2016-01-20 14:39:30'),
(27, 407, 'Kota Kendari', 'ya', '2016-01-20 14:39:30'),
(28, 408, 'Kabupaten Banggai', 'ya', '2016-01-20 14:40:26'),
(28, 409, 'Kabupaten Banggai Kepulauan', 'ya', '2016-01-20 14:40:26'),
(28, 410, 'Kabupaten Buol', 'ya', '2016-01-20 14:40:26'),
(28, 411, 'Kabupaten Donggala', 'ya', '2016-01-20 14:40:26'),
(28, 412, 'Kabupaten Morowali', 'ya', '2016-01-20 14:40:26'),
(28, 413, 'Kabupaten Parigi Moutong', 'ya', '2016-01-20 14:40:26'),
(28, 414, 'Kabupaten Poso', 'ya', '2016-01-20 14:40:26'),
(28, 415, 'Kabupaten Tojo Una-Una', 'ya', '2016-01-20 14:40:26'),
(28, 416, 'Kabupaten Toli-Toli', 'ya', '2016-01-20 14:40:26'),
(28, 417, 'Kabupaten Sigi', 'ya', '2016-01-20 14:40:26'),
(28, 418, 'Kota Palu', 'ya', '2016-01-20 14:40:26'),
(29, 419, 'Kabupaten Bolaang Mongondow', 'ya', '2016-01-20 14:41:20'),
(29, 420, 'Kabupaten Bolaang Mongondow Selatan', 'ya', '2016-01-20 14:41:20'),
(29, 421, 'Kabupaten Bolaang Mongondow Timur', 'ya', '2016-01-20 14:41:20'),
(29, 422, 'Kabupaten Bolaang Mongondow Utara', 'ya', '2016-01-20 14:41:20'),
(29, 423, 'Kabupaten Kepulauan Sangihe', 'ya', '2016-01-20 14:41:20'),
(29, 424, 'Kabupaten Kepulauan Siau Tagulandang Biaro', 'ya', '2016-01-20 14:41:20'),
(29, 425, 'Kabupaten Kepulauan Talaud', 'ya', '2016-01-20 14:41:20'),
(29, 426, 'Kabupaten Minahasa', 'ya', '2016-01-20 14:41:20'),
(29, 427, 'Kabupaten Minahasa Selatan', 'ya', '2016-01-20 14:41:20'),
(29, 428, 'Kabupaten Minahasa Tenggara', 'ya', '2016-01-20 14:41:20'),
(29, 429, 'Kabupaten Minahasa Utara', 'ya', '2016-01-20 14:41:20'),
(29, 430, 'Kota Bitung', 'ya', '2016-01-20 14:41:20'),
(29, 431, 'Kota Kotamobagu', 'ya', '2016-01-20 14:41:20'),
(29, 432, 'Kota Manado', 'ya', '2016-01-20 14:41:20'),
(29, 433, 'Kota Tomohon', 'ya', '2016-01-20 14:41:20'),
(30, 434, 'Kabupaten Majene', 'ya', '2016-01-20 14:42:02'),
(30, 435, 'Kabupaten Mamasa', 'ya', '2016-01-20 14:42:02'),
(30, 436, 'Kabupaten Mamuju', 'ya', '2016-01-20 14:42:02'),
(30, 437, 'Kabupaten Mamuju Utara', 'ya', '2016-01-20 14:42:02'),
(30, 438, 'Kabupaten Polewali Mandar', 'ya', '2016-01-20 14:42:02'),
(31, 439, 'Kabupaten Buru', 'ya', '2016-01-20 14:42:50'),
(31, 440, 'Kabupaten Buru Selatan', 'ya', '2016-01-20 14:42:50'),
(31, 441, 'Kabupaten Kepulauan Aru', 'ya', '2016-01-20 14:42:50'),
(31, 442, 'Kabupaten Maluku Barat Daya', 'ya', '2016-01-20 14:42:50'),
(31, 443, 'Kabupaten Maluku Tengah', 'ya', '2016-01-20 14:42:50'),
(31, 444, 'Kabupaten Maluku Tenggara', 'ya', '2016-01-20 14:42:50'),
(31, 445, 'Kabupaten Maluku Tenggara Barat', 'ya', '2016-01-20 14:42:50'),
(31, 446, 'Kabupaten Seram Bagian Barat', 'ya', '2016-01-20 14:42:50'),
(31, 447, 'Kabupaten Seram Bagian Timur', 'ya', '2016-01-20 14:42:50'),
(31, 448, 'Kota Ambon', 'ya', '2016-01-20 14:42:50'),
(31, 449, 'Kota Tual', 'ya', '2016-01-20 14:42:50'),
(32, 450, 'Kabupaten Halmahera Barat', 'ya', '2016-01-20 14:43:38'),
(32, 451, 'Kabupaten Halmahera Tengah', 'ya', '2016-01-20 14:43:38'),
(32, 452, 'Kabupaten Halmahera Utara', 'ya', '2016-01-20 14:43:38'),
(32, 453, 'Kabupaten Halmahera Selatan', 'ya', '2016-01-20 14:43:38'),
(32, 454, 'Kabupaten Kepulauan Sula', 'ya', '2016-01-20 14:43:38'),
(32, 455, 'Kabupaten Halmahera Timur', 'ya', '2016-01-20 14:43:38'),
(32, 456, 'Kabupaten Pulau Morotai', 'ya', '2016-01-20 14:43:38'),
(32, 457, 'Kota Ternate', 'ya', '2016-01-20 14:43:38'),
(32, 458, 'Kota Tidore Kepulauan', 'ya', '2016-01-20 14:43:38'),
(33, 459, 'Kabupaten Asmat', 'ya', '2016-01-20 14:44:25'),
(33, 460, 'Kabupaten Biak Numfor', 'ya', '2016-01-20 14:44:25'),
(33, 461, 'Kabupaten Boven Digoel', 'ya', '2016-01-20 14:44:25'),
(33, 462, 'Kabupaten Deiyai', 'ya', '2016-01-20 14:44:25'),
(33, 463, 'Kabupaten Dogiyai', 'ya', '2016-01-20 14:44:25'),
(33, 464, 'Kabupaten Intan Jaya', 'ya', '2016-01-20 14:44:25'),
(33, 465, 'Kabupaten Jayapura', 'ya', '2016-01-20 14:44:25'),
(33, 466, 'Kabupaten Jayawijaya', 'ya', '2016-01-20 14:44:25'),
(33, 467, 'Kabupaten Keerom', 'ya', '2016-01-20 14:44:25'),
(33, 468, 'Kabupaten Kepulauan Yapen', 'ya', '2016-01-20 14:44:25'),
(33, 469, 'Kabupaten Lanny Jaya', 'ya', '2016-01-20 14:44:25'),
(33, 470, 'Kabupaten Mamberamo Raya', 'ya', '2016-01-20 14:44:25'),
(33, 471, 'Kabupaten Mamberamo Tengah', 'ya', '2016-01-20 14:44:25'),
(33, 472, 'Kabupaten Mappi', 'ya', '2016-01-20 14:44:25'),
(33, 473, 'Kabupaten Merauke', 'ya', '2016-01-20 14:44:25'),
(33, 474, 'Kabupaten Mimika', 'ya', '2016-01-20 14:44:25'),
(33, 475, 'Kabupaten Nabire', 'ya', '2016-01-20 14:44:25'),
(33, 476, 'Kabupaten Nduga', 'ya', '2016-01-20 14:44:25'),
(33, 477, 'Kabupaten Paniai', 'ya', '2016-01-20 14:44:25'),
(33, 478, 'Kabupaten Pegunungan Bintang', 'ya', '2016-01-20 14:44:25'),
(33, 479, 'Kabupaten Puncak', 'ya', '2016-01-20 14:44:25'),
(33, 480, 'Kabupaten Puncak Jaya', 'ya', '2016-01-20 14:44:25'),
(33, 481, 'Kabupaten Sarmi', 'ya', '2016-01-20 14:44:25'),
(33, 482, 'Kabupaten Supiori', 'ya', '2016-01-20 14:44:25'),
(33, 483, 'Kabupaten Tolikara', 'ya', '2016-01-20 14:44:25'),
(33, 484, 'Kabupaten Waropen', 'ya', '2016-01-20 14:44:25'),
(33, 485, 'Kabupaten Yahukimo', 'ya', '2016-01-20 14:44:25'),
(33, 486, 'Kabupaten Yalimo', 'ya', '2016-01-20 14:44:25'),
(33, 487, 'Kota Jayapura', 'ya', '2016-01-20 14:44:25'),
(34, 488, 'Kabupaten Fakfak', 'ya', '2016-01-20 14:45:26'),
(34, 489, 'Kabupaten Kaimana', 'ya', '2016-01-20 14:45:26'),
(34, 490, 'Kabupaten Manokwari', 'ya', '2016-01-20 14:45:26'),
(34, 491, 'Kabupaten Maybrat', 'ya', '2016-01-20 14:45:26'),
(34, 492, 'Kabupaten Raja Ampat', 'ya', '2016-01-20 14:45:26'),
(34, 493, 'Kabupaten Sorong', 'ya', '2016-01-20 14:45:26'),
(34, 494, 'Kabupaten Sorong Selatan', 'ya', '2016-01-20 14:45:26'),
(34, 495, 'Kabupaten Tambrauw', 'ya', '2016-01-20 14:45:26'),
(34, 496, 'Kabupaten Teluk Bintuni', 'ya', '2016-01-20 14:45:26'),
(34, 497, 'Kabupaten Teluk Wondama', 'ya', '2016-01-20 14:45:26'),
(34, 498, 'Kota Sorong', 'ya', '2016-01-20 14:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `aluni_m_modul`
--

CREATE TABLE `aluni_m_modul` (
  `id_modul` int(3) UNSIGNED ZEROFILL NOT NULL,
  `nama_modul` varchar(30) NOT NULL,
  `halaman_modul` varchar(30) NOT NULL,
  `keterangan_modul` text,
  `tipe_modul` enum('sistem','biasa') NOT NULL DEFAULT 'biasa',
  `aktif` enum('ya','tidak') NOT NULL DEFAULT 'ya',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_m_modul`
--

INSERT INTO `aluni_m_modul` (`id_modul`, `nama_modul`, `halaman_modul`, `keterangan_modul`, `tipe_modul`, `aktif`, `created_date`) VALUES
(001, 'Pengaturan Sistem', 'pengaturan_sistem.php', 'System setting management such as system name, description, location etc.', 'sistem', 'ya', '2016-01-28 09:30:31'),
(002, 'Pengguna', 'pengguna.php', 'User management Module', 'sistem', 'ya', '2016-01-28 09:31:23'),
(003, 'Tambah Anggota', 'tambah_anggota.php', 'Tambah & Edit data anggota', 'biasa', 'ya', '2016-01-28 09:39:25'),
(004, 'Laporan', 'laporan.php', 'Pembuatan laporan', 'biasa', 'ya', '2016-01-28 09:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `aluni_m_provinsi`
--

CREATE TABLE `aluni_m_provinsi` (
  `id_provinsi` int(4) NOT NULL,
  `nama_provinsi` varchar(50) NOT NULL,
  `aktif` enum('ya','tidak') NOT NULL DEFAULT 'ya',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_m_provinsi`
--

INSERT INTO `aluni_m_provinsi` (`id_provinsi`, `nama_provinsi`, `aktif`, `created_date`) VALUES
(1, 'Aceh', 'ya', '2016-01-20 13:33:10'),
(2, 'Sumatera Utara', 'ya', '2016-01-20 13:33:10'),
(3, 'Sumatera Barat', 'ya', '2016-01-20 13:33:10'),
(4, 'Riau', 'ya', '2016-01-20 13:33:10'),
(5, 'Kepulauan Riau', 'ya', '2016-01-20 13:33:10'),
(6, 'Jambi', 'ya', '2016-01-20 13:33:10'),
(7, 'Bengkulu', 'ya', '2016-01-20 13:33:10'),
(8, 'Sumatera Selatan', 'ya', '2016-01-20 13:33:10'),
(9, 'Kepulauan Bangka Belitung', 'ya', '2016-01-20 13:33:10'),
(10, 'Lampung', 'ya', '2016-01-20 13:33:10'),
(11, 'Banten', 'ya', '2016-01-20 13:33:10'),
(12, 'Jawa Barat', 'ya', '2016-01-20 13:33:10'),
(13, 'DKI Jakarta', 'ya', '2016-01-20 13:33:10'),
(14, 'Jawa Tengah', 'ya', '2016-01-20 13:33:10'),
(15, 'Jawa Timur', 'ya', '2016-01-20 13:33:10'),
(16, 'Daerah Istimewa Yogyakarta', 'ya', '2016-01-20 13:33:10'),
(17, 'Bali', 'ya', '2016-01-20 13:33:10'),
(18, 'Nusa Tenggara Barat', 'ya', '2016-01-20 13:33:10'),
(19, 'Nusa Tenggara Timur', 'ya', '2016-01-20 13:33:10'),
(20, 'Kalimantan Barat', 'ya', '2016-01-20 13:33:10'),
(21, 'Kalimantan Selatan', 'ya', '2016-01-20 13:33:10'),
(22, 'Kalimantan Tengah', 'ya', '2016-01-20 13:33:10'),
(23, 'Kalimantan Timur', 'ya', '2016-01-20 13:33:10'),
(24, 'Kalimantan Utara', 'ya', '2016-01-20 13:33:10'),
(25, 'Gorontalo', 'ya', '2016-01-20 13:33:10'),
(26, 'Sulawesi Selatan', 'ya', '2016-01-20 13:33:10'),
(27, 'Sulawesi Tenggara', 'ya', '2016-01-20 13:33:10'),
(28, 'Sulawesi Tengah', 'ya', '2016-01-20 13:33:10'),
(29, 'Sulawesi Utara', 'ya', '2016-01-20 13:33:10'),
(30, 'Sulawesi Barat', 'ya', '2016-01-20 13:33:10'),
(31, 'Maluku', 'ya', '2016-01-20 13:33:10'),
(32, 'Maluku Utara', 'ya', '2016-01-20 13:33:10'),
(33, 'Papua', 'ya', '2016-01-20 13:33:10'),
(34, 'Papua Barat', 'ya', '2016-01-20 13:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `aluni_pengaturan`
--

CREATE TABLE `aluni_pengaturan` (
  `id_pengaturan` int(4) NOT NULL,
  `nama_pengaturan` varchar(20) NOT NULL,
  `nilai_pengaturan` text NOT NULL,
  `aktif` enum('ya','tidak') NOT NULL DEFAULT 'ya',
  `keterangan` text,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_pengaturan`
--

INSERT INTO `aluni_pengaturan` (`id_pengaturan`, `nama_pengaturan`, `nilai_pengaturan`, `aktif`, `keterangan`, `created_date`) VALUES
(1, 'nama_sistem', 'Alumni DB System', 'ya', 'Nama instansi pengguna', '2016-01-20 14:57:58'),
(2, 'lokasi_sistem', '<p>Lokasi Sistem</p>', 'ya', 'Lokasi instansi pengguna sistem', '2016-01-20 15:03:35'),
(3, 'keterangan_sistem', '<p>Sebuah aplikasi yang digunakan untuk mengatur data anggota dari sebuah instansi atau organisasi. Anda dapat membuat laporan dari data anggota yang telah ada di dalam database.</p>', 'ya', 'Keterangan sistem', '2016-01-28 09:06:29');

-- --------------------------------------------------------

--
-- Table structure for table `aluni_pengguna`
--

CREATE TABLE `aluni_pengguna` (
  `username` varchar(30) NOT NULL COMMENT 'Unique Username',
  `password` varchar(128) NOT NULL COMMENT 'SHA512',
  `salt` varchar(64) NOT NULL COMMENT 'Random String SHA256',
  `level` enum('user','admin','super_user') NOT NULL DEFAULT 'user' COMMENT 'User Level',
  `aktif` enum('ya','tidak') NOT NULL DEFAULT 'ya' COMMENT 'User Active Status',
  `nama_depan` varchar(50) DEFAULT NULL,
  `nama_belakang` varchar(100) DEFAULT NULL,
  `foto` text COMMENT 'User Photo Profile - Set default if empty',
  `id_anggota` int(12) DEFAULT NULL COMMENT 'Member id - only member',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL,
  `revisi` tinyint(3) NOT NULL DEFAULT '0' COMMENT 'Total Profile Changes/Revision'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_pengguna`
--

INSERT INTO `aluni_pengguna` (`username`, `password`, `salt`, `level`, `aktif`, `nama_depan`, `nama_belakang`, `foto`, `id_anggota`, `created_by`, `created_date`, `updated_by`, `updated_date`, `revisi`) VALUES
('admin', '24ce1033bdfe226997340a7104d79eeb43a54a27c101da24a5eb465c90a10800d6f8671346158f0ecf2efb4f1440f45e9c16fbc3e45d3e53e2bb94839781e95f', '1f78147ac76487d519cdf84a31df14b84948c6a01f763b522df896c75a5d7e4f', 'super_user', 'ya', 'Super', 'User', '', NULL, 'admin', '2015-12-02 11:26:49', 'admin', '2016-01-28 18:21:11', 0),
('sedotcode', 'a99f3ea53ec8cb8b648a2e4ae4e5a3f66fb6745b8ef1de1661605a6f5ecb10aca65da4acc2b664fbc269eda43555b29d07b6b451efb56a796b96a7a4997138e5', '83545a4189515cfe34f2e3637e192b7aba3d4ce77a7659be21c2e82d6b23742c', 'user', 'ya', 'Bagus Dwiky Wicaksono', '', 'sedotcode.jpg', 1, 'admin', '2017-02-17 10:43:52', 'admin', '2017-02-18 02:15:49', 2);

-- --------------------------------------------------------

--
-- Table structure for table `aluni_pengguna_hak_akses`
--

CREATE TABLE `aluni_pengguna_hak_akses` (
  `username` varchar(30) NOT NULL,
  `hak_akses` text,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_pengguna_hak_akses`
--

INSERT INTO `aluni_pengguna_hak_akses` (`username`, `hak_akses`, `created_date`) VALUES
('admin', '*', '2016-01-28 10:04:05'),
('sedotcode', '', '2017-02-17 10:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `aluni_pengguna_status_password`
--

CREATE TABLE `aluni_pengguna_status_password` (
  `id_anggota` int(12) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` enum('belum diubah','sudah diubah') NOT NULL DEFAULT 'belum diubah',
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aluni_pengguna_status_password`
--

INSERT INTO `aluni_pengguna_status_password` (`id_anggota`, `username`, `password`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(0, 'admin', 'admin', 'sudah diubah', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(1, 'sedotcode', 'd4ed6737', 'belum diubah', 'admin', '2017-02-17 10:43:52', 'admin', '2017-02-17 10:43:52');

-- --------------------------------------------------------

--
-- Stand-in structure for view `aluni_v_anggota_lengkap`
--
CREATE TABLE `aluni_v_anggota_lengkap` (
`id_anggota` int(12)
,`nama_lengkap` varchar(100)
,`nama_panggilan` varchar(50)
,`jenis_kelamin` enum('laki-laki','perempuan')
,`tempat_lahir` varchar(50)
,`tanggal_lahir` date
,`agama` varchar(30)
,`foto` blob
,`provinsi` varchar(50)
,`kota` varchar(50)
,`alamat` text
,`aktif` enum('ya','tidak')
,`angkatan` varchar(50)
,`tahun_masuk` int(4)
,`tahun_keluar` int(4)
,`kelas_terakhir` varchar(100)
,`catatan` text
,`nama_pasangan` varchar(100)
,`nama_anak` varchar(500)
,`nama_ayah` varchar(100)
,`nama_ibu` varchar(100)
,`nama_wali` varchar(100)
,`provinsi_orang_tua` varchar(50)
,`kota_orang_tua` varchar(50)
,`alamat_orang_tua` text
,`no_rumah` varchar(15)
,`no_handphone` varchar(15)
,`no_handphone2` varchar(15)
,`pin_blackberry` varchar(10)
,`alamat_email` varchar(50)
,`alamat_website` varchar(50)
,`facebook` varchar(150)
,`twitter` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `aluni_v_anggota_mentah`
--
CREATE TABLE `aluni_v_anggota_mentah` (
`id_anggota` int(12)
,`nama_lengkap` varchar(100)
,`nama_panggilan` varchar(50)
,`jenis_kelamin` enum('laki-laki','perempuan')
,`tempat_lahir` varchar(50)
,`tanggal_lahir` date
,`agama` varchar(30)
,`foto` blob
,`id_provinsi` int(4)
,`id_kota` int(4)
,`alamat` text
,`aktif` enum('ya','tidak')
,`nama_pasangan` varchar(100)
,`nama_anak` varchar(500)
,`nama_ayah` varchar(100)
,`nama_ibu` varchar(100)
,`nama_wali` varchar(100)
,`id_provinsi_ot` int(4)
,`id_kota_ot` int(4)
,`alamat_orang_tua` text
,`no_rumah` varchar(15)
,`no_handphone` varchar(15)
,`no_handphone2` varchar(15)
,`pin_blackberry` varchar(10)
,`alamat_email` varchar(50)
,`alamat_website` varchar(50)
,`facebook` varchar(150)
,`twitter` varchar(50)
,`angkatan` varchar(50)
,`tahun_masuk` int(4)
,`tahun_keluar` int(4)
,`kelas_terakhir` varchar(100)
,`catatan` text
,`username` varchar(30)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `aluni_v_pengguna`
--
CREATE TABLE `aluni_v_pengguna` (
`username` varchar(30)
,`level` enum('user','admin','super_user')
,`nama_depan` varchar(50)
,`nama_belakang` varchar(100)
,`aktif` enum('ya','tidak')
,`foto` text
,`id_anggota` int(12)
,`hak_akses` text
,`password` varchar(128)
,`status` enum('belum diubah','sudah diubah')
);

-- --------------------------------------------------------

--
-- Structure for view `aluni_v_anggota_lengkap`
--
DROP TABLE IF EXISTS `aluni_v_anggota_lengkap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `aluni_v_anggota_lengkap`  AS  select `ad`.`id_anggota` AS `id_anggota`,`ad`.`nama_lengkap` AS `nama_lengkap`,`ad`.`nama_panggilan` AS `nama_panggilan`,`ad`.`jenis_kelamin` AS `jenis_kelamin`,`ad`.`tempat_lahir` AS `tempat_lahir`,`ad`.`tanggal_lahir` AS `tanggal_lahir`,(select `aluni_m_agama`.`nama_agama` from `aluni_m_agama` where (`aluni_m_agama`.`id_agama` = `ad`.`agama`)) AS `agama`,`ad`.`foto` AS `foto`,(select `aluni_m_provinsi`.`nama_provinsi` from `aluni_m_provinsi` where (`aluni_m_provinsi`.`id_provinsi` = `ad`.`id_provinsi`)) AS `provinsi`,(select `aluni_m_kota`.`nama_kota` from `aluni_m_kota` where (`aluni_m_kota`.`id_kota` = `ad`.`id_kota`)) AS `kota`,`ad`.`alamat` AS `alamat`,`ad`.`aktif` AS `aktif`,`aa`.`angkatan` AS `angkatan`,`aa`.`tahun_masuk` AS `tahun_masuk`,`aa`.`tahun_keluar` AS `tahun_keluar`,`aa`.`kelas_terakhir` AS `kelas_terakhir`,`aa`.`catatan` AS `catatan`,`ak`.`nama_pasangan` AS `nama_pasangan`,`ak`.`nama_anak` AS `nama_anak`,`ao`.`nama_ayah` AS `nama_ayah`,`ao`.`nama_ibu` AS `nama_ibu`,`ao`.`nama_wali` AS `nama_wali`,(select `aluni_m_provinsi`.`nama_provinsi` from `aluni_m_provinsi` where (`aluni_m_provinsi`.`id_provinsi` = `ao`.`id_provinsi`)) AS `provinsi_orang_tua`,(select `aluni_m_kota`.`nama_kota` from `aluni_m_kota` where (`aluni_m_kota`.`id_kota` = `ao`.`id_kota`)) AS `kota_orang_tua`,`ao`.`alamat_orang_tua` AS `alamat_orang_tua`,`ako`.`no_rumah` AS `no_rumah`,`ako`.`no_handphone` AS `no_handphone`,`ako`.`no_handphone2` AS `no_handphone2`,`ako`.`pin_blackberry` AS `pin_blackberry`,`ako`.`alamat_email` AS `alamat_email`,`ako`.`alamat_website` AS `alamat_website`,`ako`.`facebook` AS `facebook`,`ako`.`twitter` AS `twitter` from ((((`aluni_anggota_dasar` `ad` join `aluni_anggota_akademik` `aa` on((`ad`.`id_anggota` = `aa`.`id_anggota`))) join `aluni_anggota_keluarga` `ak` on((`ad`.`id_anggota` = `ak`.`id_anggota`))) join `aluni_anggota_orang_tua` `ao` on((`ad`.`id_anggota` = `ao`.`id_anggota`))) join `aluni_anggota_kontak` `ako` on((`ad`.`id_anggota` = `ako`.`id_anggota`))) ;

-- --------------------------------------------------------

--
-- Structure for view `aluni_v_anggota_mentah`
--
DROP TABLE IF EXISTS `aluni_v_anggota_mentah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `aluni_v_anggota_mentah`  AS  select `ad`.`id_anggota` AS `id_anggota`,`ad`.`nama_lengkap` AS `nama_lengkap`,`ad`.`nama_panggilan` AS `nama_panggilan`,`ad`.`jenis_kelamin` AS `jenis_kelamin`,`ad`.`tempat_lahir` AS `tempat_lahir`,`ad`.`tanggal_lahir` AS `tanggal_lahir`,`ad`.`agama` AS `agama`,`ad`.`foto` AS `foto`,`ad`.`id_provinsi` AS `id_provinsi`,`ad`.`id_kota` AS `id_kota`,`ad`.`alamat` AS `alamat`,`ad`.`aktif` AS `aktif`,`ak`.`nama_pasangan` AS `nama_pasangan`,`ak`.`nama_anak` AS `nama_anak`,`ao`.`nama_ayah` AS `nama_ayah`,`ao`.`nama_ibu` AS `nama_ibu`,`ao`.`nama_wali` AS `nama_wali`,`ao`.`id_provinsi` AS `id_provinsi_ot`,`ao`.`id_kota` AS `id_kota_ot`,`ao`.`alamat_orang_tua` AS `alamat_orang_tua`,`ako`.`no_rumah` AS `no_rumah`,`ako`.`no_handphone` AS `no_handphone`,`ako`.`no_handphone2` AS `no_handphone2`,`ako`.`pin_blackberry` AS `pin_blackberry`,`ako`.`alamat_email` AS `alamat_email`,`ako`.`alamat_website` AS `alamat_website`,`ako`.`facebook` AS `facebook`,`ako`.`twitter` AS `twitter`,`aa`.`angkatan` AS `angkatan`,`aa`.`tahun_masuk` AS `tahun_masuk`,`aa`.`tahun_keluar` AS `tahun_keluar`,`aa`.`kelas_terakhir` AS `kelas_terakhir`,`aa`.`catatan` AS `catatan`,`ap`.`username` AS `username` from (((((`aluni_anggota_dasar` `ad` join `aluni_anggota_keluarga` `ak` on((`ad`.`id_anggota` = `ak`.`id_anggota`))) join `aluni_anggota_orang_tua` `ao` on((`ad`.`id_anggota` = `ao`.`id_anggota`))) join `aluni_anggota_kontak` `ako` on((`ad`.`id_anggota` = `ako`.`id_anggota`))) join `aluni_anggota_akademik` `aa` on((`ad`.`id_anggota` = `aa`.`id_anggota`))) join `aluni_pengguna` `ap` on((`ad`.`id_anggota` = `ap`.`id_anggota`))) ;

-- --------------------------------------------------------

--
-- Structure for view `aluni_v_pengguna`
--
DROP TABLE IF EXISTS `aluni_v_pengguna`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `aluni_v_pengguna`  AS  select `a`.`username` AS `username`,`a`.`level` AS `level`,`a`.`nama_depan` AS `nama_depan`,`a`.`nama_belakang` AS `nama_belakang`,`a`.`aktif` AS `aktif`,`a`.`foto` AS `foto`,`a`.`id_anggota` AS `id_anggota`,`b`.`hak_akses` AS `hak_akses`,`c`.`password` AS `password`,`c`.`status` AS `status` from ((`aluni_pengguna` `a` join `aluni_pengguna_hak_akses` `b` on((`a`.`username` = `b`.`username`))) join `aluni_pengguna_status_password` `c` on((`a`.`username` = `c`.`username`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluni_anggota_akademik`
--
ALTER TABLE `aluni_anggota_akademik`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `aluni_anggota_dasar`
--
ALTER TABLE `aluni_anggota_dasar`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `aluni_anggota_keluarga`
--
ALTER TABLE `aluni_anggota_keluarga`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `aluni_anggota_kontak`
--
ALTER TABLE `aluni_anggota_kontak`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `aluni_anggota_orang_tua`
--
ALTER TABLE `aluni_anggota_orang_tua`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `aluni_m_agama`
--
ALTER TABLE `aluni_m_agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `aluni_m_kota`
--
ALTER TABLE `aluni_m_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `aluni_m_modul`
--
ALTER TABLE `aluni_m_modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `aluni_m_provinsi`
--
ALTER TABLE `aluni_m_provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Indexes for table `aluni_pengaturan`
--
ALTER TABLE `aluni_pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `aluni_pengguna`
--
ALTER TABLE `aluni_pengguna`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `aluni_pengguna_hak_akses`
--
ALTER TABLE `aluni_pengguna_hak_akses`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `aluni_pengguna_status_password`
--
ALTER TABLE `aluni_pengguna_status_password`
  ADD PRIMARY KEY (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluni_anggota_dasar`
--
ALTER TABLE `aluni_anggota_dasar`
  MODIFY `id_anggota` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `aluni_m_agama`
--
ALTER TABLE `aluni_m_agama`
  MODIFY `id_agama` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `aluni_m_kota`
--
ALTER TABLE `aluni_m_kota`
  MODIFY `id_kota` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;
--
-- AUTO_INCREMENT for table `aluni_m_modul`
--
ALTER TABLE `aluni_m_modul`
  MODIFY `id_modul` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `aluni_m_provinsi`
--
ALTER TABLE `aluni_m_provinsi`
  MODIFY `id_provinsi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `aluni_pengaturan`
--
ALTER TABLE `aluni_pengaturan`
  MODIFY `id_pengaturan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
