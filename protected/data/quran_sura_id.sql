-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2012 at 02:16 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tahfizh`
--

-- --------------------------------------------------------

--
-- Table structure for table `quran_sura_id`
--

CREATE TABLE IF NOT EXISTS `quran_sura_id` (
  `id` int(11) NOT NULL DEFAULT '0',
  `sura` varchar(100) NOT NULL,
  `meaning` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quran_sura_id`
--

INSERT INTO `quran_sura_id` (`id`, `sura`, `meaning`) VALUES
(1, 'Al-Fatihah', 'Pembukaan'),
(2, 'Al-Baqarah', 'Sapi Betina'),
(3, 'Ali ''Imran', 'Keluarga ''Imran'),
(4, 'An-Nisa''', 'Wanita'),
(5, 'Al-Ma''idah', 'Jamuan (hidangan makanan)'),
(6, 'Al-An''am', 'Binatang Ternak'),
(7, 'Al-A’raf', 'Tempat yang tertinggi'),
(8, 'Al-Anfal', 'Harta rampasan perang'),
(9, 'At-Taubah', 'Pengampunan'),
(10, 'Yunus', 'Nabi Yunus'),
(11, 'Hud', 'Nabi Hud'),
(12, 'Yusuf', 'Nabi Yusuf'),
(13, 'Ar-Ra’d', 'Guruh (petir)'),
(14, 'Ibrahim', 'Nabi Ibrahim'),
(15, 'Al-Hijr', 'Al Hijr (nama gunung)'),
(16, 'An-Nahl', 'Lebah'),
(17, 'Al-Isra''', 'Memperjalankan di waktu malam'),
(18, 'Al-Kahf', 'Penghuni-penghuni gua'),
(19, 'Maryam', 'Maryam (Maria)'),
(20, 'Ta Ha', 'Thaha'),
(21, 'Al-Anbiya', 'Nabi-Nabi'),
(22, 'Al-Hajj', 'Haji'),
(23, 'Al-Mu’minun', 'Orang-orang mukmin'),
(24, 'An-Nur', 'Cahaya'),
(25, 'Al-Furqan', 'Pembeda'),
(26, 'Asy-Syu''ara''', 'Penyair'),
(27, 'An-Naml', 'Semut'),
(28, 'Al-Qasas', 'Cerita'),
(29, 'Al-''Ankabut', 'Laba-laba'),
(30, 'Ar-Rum', 'Bangsa Romawi'),
(31, 'Luqman', 'Keluarga Luqman'),
(32, 'As-Sajdah', 'Sajdah'),
(33, 'Al-Ahzab', 'Golongan-Golongan yang bersekutu'),
(34, 'Saba’', 'Kaum Saba'''),
(35, 'Fatir', 'Pencipta'),
(36, 'Ya Sin', 'Yaasiin'),
(37, 'As-Saffat', 'Barisan-barisan'),
(38, 'Sad', 'Shaad'),
(39, 'Az-Zumar', 'Rombongan-rombongan'),
(40, 'Al-Mu’min', 'Orang yg Beriman'),
(41, 'Fussilat', 'Yang dijelaskan'),
(42, 'Asy-Syura', 'Musyawarah'),
(43, 'Az-Zukhruf', 'Perhiasan'),
(44, 'Ad-Dukhan', 'Kabut'),
(45, 'Al-Jasiyah', 'Yang bertekuk lutut'),
(46, 'Al-Ahqaf', 'Bukit-bukit pasir'),
(47, 'Muhammad', 'Muhammad'),
(48, 'Al-Fath', 'Kemenangan'),
(49, 'Al-Hujurat', 'Kamar-kamar'),
(50, 'Qaf', 'Qaaf'),
(51, 'Az-Zariyat', 'Angin yang menerbangkan'),
(52, 'At-Tur', 'Bukit'),
(53, 'An-Najm', 'Bintang'),
(54, 'Al-Qamar', 'Bulan'),
(55, 'Ar-Rahman', 'Yang Maha Pemurah'),
(56, 'Al-Waqi’ah', 'Hari Kiamat'),
(57, 'Al-Hadid', 'Besi'),
(58, 'Al-Mujadilah', 'Wanita yang mengajukan gugatan'),
(59, 'Al-Hasyr', 'Pengusiran'),
(60, 'Al-Mumtahanah', 'Wanita yang diuji'),
(61, 'As-Saff', 'Satu barisan'),
(62, 'Al-Jumu’ah', 'Hari Jum’at'),
(63, 'Al-Munafiqun', 'Orang-orang yang munafik'),
(64, 'At-Tagabun', 'Hari dinampakkan kesalahan-kesalahan'),
(65, 'At-Talaq', 'Talak'),
(66, 'At-Tahrim', 'Mengharamkan'),
(67, 'Al-Mulk', 'Kerajaan'),
(68, 'Al-Qalam', 'Pena'),
(69, 'Al-Haqqah', 'Hari kiamat'),
(70, 'Al-Ma’arij', 'Tempat naik'),
(71, 'Nuh', 'Nuh'),
(72, 'Al-Jinn', 'Jin'),
(73, 'Al-Muzzammil', 'Orang yang berselimut'),
(74, 'Al-Muddassir', 'Orang yang berkemul'),
(75, 'Al-Qiyamah', 'Hari Kiamat'),
(76, 'Al-Insan', 'Manusia'),
(77, 'Al-Mursalat', 'Malaikat-Malaikat Yang Diutus'),
(78, 'An-Naba’', 'Berita besar'),
(79, 'An-Nazi’at', 'Malaikat-Malaikat Yang Mencabut'),
(80, '''Abasa', 'Ia Bermuka masam'),
(81, 'At-Takwir', 'Menggulung'),
(82, 'Al-Infitar', 'Terbelah'),
(83, 'Al-Tatfif', 'Orang-orang yang curang'),
(84, 'Al-Insyiqaq', 'Terbelah'),
(85, 'Al-Buruj', 'Gugusan bintang'),
(86, 'At-Tariq', 'Yang datang di malam hari'),
(87, 'Al-A’la', 'Yang paling tinggi'),
(88, 'Al-Gasyiyah', 'Hari Pembalasan'),
(89, 'Al-Fajr', 'Fajar'),
(90, 'Al-Balad', 'Negeri'),
(91, 'Asy-Syams', 'Matahari'),
(92, 'Al-Lail', 'Malam'),
(93, 'Ad-Duha', 'Waktu matahari sepenggalahan naik (Dhuha)'),
(94, 'Al-Insyirah', 'Melapangkan'),
(95, 'At-Tin', 'Buah Tin'),
(96, 'Al-''Alaq', 'Segumpal Darah'),
(97, 'Al-Qadr', 'Kemuliaan'),
(98, 'Al-Bayyinah', 'Pembuktian'),
(99, 'Az-Zalzalah', 'Kegoncangan'),
(100, 'Al-''Adiyat', 'Berlari kencang'),
(101, 'Al-Qari''ah', 'Hari Kiamat'),
(102, 'At-Takasur', 'Bermegah-megahan'),
(103, 'Al-''Asr', 'Masa/Waktu'),
(104, 'Al-Humazah', 'Pengumpat'),
(105, 'Al-Fil', 'Gajah'),
(106, 'Quraisy', 'Suku Quraisy'),
(107, 'Al-Ma’un', 'Barang-barang yang berguna'),
(108, 'Al-Kausar', 'Nikmat yang berlimpah'),
(109, 'Al-Kafirun', 'Orang-orang kafir'),
(110, 'An-Nasr', 'Pertolongan'),
(111, 'Al-Lahab', 'Gejolak Api/ Sabut'),
(112, 'Al-Ikhlas', 'Ikhlas'),
(113, 'Al-Falaq', 'Waktu Subuh'),
(114, 'An-Nas', 'Manusia');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
