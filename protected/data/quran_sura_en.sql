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
-- Table structure for table `quran_sura_en`
--

CREATE TABLE IF NOT EXISTS `quran_sura_en` (
  `id` int(11) NOT NULL DEFAULT '0',
  `sura` varchar(100) NOT NULL,
  `meaning` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`sura`),
  UNIQUE KEY `meaning` (`meaning`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quran_sura_en`
--

INSERT INTO `quran_sura_en` (`id`, `sura`, `meaning`) VALUES
(1, 'Al-Fatiha', 'The Opening'),
(2, 'Al-Baqara', 'The Cow'),
(3, 'Aal-e-Imran', 'The family of Imran'),
(4, 'An-Nisa', 'The Women'),
(5, 'Al-Maeda', 'The Table Spread'),
(6, 'Al-Anaam', 'The cattle'),
(7, 'Al-Araf', 'The heights'),
(8, 'Al-Anfal', 'Spoils of war, booty'),
(9, 'At-Taubah', 'Repentance'),
(10, 'Yunus', 'Jonah'),
(11, 'Hud', 'Hud'),
(12, 'Yusuf', 'Joseph'),
(13, 'Ar-Rad', 'The Thunder'),
(14, 'Ibrahim', 'Abraham'),
(15, 'Al-Hijr', 'Stoneland, Rock city, Al-Hijr valley'),
(16, 'An-Nahl', 'The Bee'),
(17, 'Al-Isra', 'The night journey'),
(18, 'Al-Kahf', 'The cave'),
(19, 'Maryam', 'Mary'),
(20, 'Taha', 'Taha'),
(21, 'Al-Anbiya', 'The Prophets'),
(22, 'Al-Hajj', 'The Pilgrimage'),
(23, 'Al-Mumenoon', 'The Believers'),
(24, 'An-Noor', 'The Light'),
(25, 'Al-Furqan', 'The Standard'),
(26, 'Ash-Shuara', 'The Poets'),
(27, 'An-Naml', 'THE ANT'),
(28, 'Al-Qasas', 'The Story'),
(29, 'Al-Ankaboot', 'The Spider'),
(30, 'Ar-Room', 'The Romans'),
(31, 'Luqman', 'Luqman'),
(32, 'As-Sajda', 'The Prostration'),
(33, 'Al-Ahzab', 'The Coalition'),
(34, 'Saba', 'Saba'),
(35, 'Fatir', 'Originator'),
(36, 'Ya Seen', 'Ya Seen'),
(37, 'As-Saaffat', 'Those who set the ranks'),
(38, 'Sad', 'Sad'),
(39, 'Az-Zumar', 'The Troops'),
(40, 'Ghafir', 'The Forgiver'),
(41, 'Fussilat', 'Explained in detail'),
(42, 'Ash-Shura', 'Council, Consultation'),
(43, 'Az-Zukhruf', 'Ornaments of Gold'),
(44, 'Ad-Dukhan', 'The Smoke'),
(45, 'Al-Jathiya', 'Crouching'),
(46, 'Al-Ahqaf', 'The wind-curved sandhills'),
(47, 'Muhammad', 'Muhammad'),
(48, 'Al-Fath', 'The victory'),
(49, 'Al-Hujraat', 'The private apartments'),
(50, 'Qaf', 'Qaf'),
(51, 'Adh-Dhariyat', 'The winnowing winds'),
(52, 'At-tur', 'Mount Sinai'),
(53, 'An-Najm', 'The Star'),
(54, 'Al-Qamar', 'The moon'),
(55, 'Al-Rahman', 'The Beneficient'),
(56, 'Al-Waqia', 'The Event, The Inevitable'),
(57, 'Al-Hadid', 'The Iron'),
(58, 'Al-Mujadila', 'She that disputes'),
(59, 'Al-Hashr', 'Exile'),
(60, 'Al-Mumtahina', 'She that is to be examined'),
(61, 'As-Saff', 'The Ranks'),
(62, 'Al-Jumua', 'The congregation, Friday'),
(63, 'Al-Munafiqoon', 'The Hypocrites'),
(64, 'At-Taghabun', 'Mutual Disillusion'),
(65, 'At-Talaq', 'Divorce'),
(66, 'At-Tahrim', 'Banning'),
(67, 'Al-Mulk', 'The Sovereignty'),
(68, 'Al-Qalam', 'The Pen'),
(69, 'Al-Haaqqa', 'The reality'),
(70, 'Al-Maarij', 'The Ascending stairways'),
(71, 'Nooh', 'Nooh'),
(72, 'Al-Jinn', 'The Jinn'),
(73, 'Al-Muzzammil', 'The enshrouded one'),
(74, 'Al-Muddathir', 'The cloaked one'),
(75, 'Al-Qiyama', 'The rising of the dead'),
(76, 'Al-Insan', 'The man'),
(77, 'Al-Mursalat', 'The emissaries'),
(78, 'An-Naba', 'The tidings'),
(79, 'An-Naziat', 'Those who drag forth'),
(80, 'Abasa', 'He Frowned'),
(81, 'At-Takwir', 'The Overthrowing'),
(82, 'AL-Infitar', 'The Cleaving'),
(83, 'Al-Mutaffifin', 'Defrauding'),
(84, 'Al-Inshiqaq', 'The Sundering, Splitting Open'),
(85, 'Al-Burooj', 'The Mansions of the stars'),
(86, 'At-Tariq', 'The morning star'),
(87, 'Al-Ala', 'The Most High'),
(88, 'Al-Ghashiya', 'The Overwhelming'),
(89, 'Al-Fajr', 'The Dawn'),
(90, 'Al-Balad', 'The City'),
(91, 'Ash-Shams', 'The Sun'),
(92, 'Al-Lail', 'The night'),
(93, 'Ad-Dhuha', 'The morning hours'),
(94, 'Al-Inshirah', 'Solace'),
(95, 'At-Tin', 'The Fig'),
(96, 'Al-Alaq', 'The Clot'),
(97, 'Al-Qadr', 'The Power'),
(98, 'Al-Bayyina', 'The Clear proof'),
(99, 'Al-Zalzala', 'The earthquake'),
(100, 'Al-Adiyat', 'The Chargers'),
(101, 'Al-Qaria', 'The Calamity'),
(102, 'At-Takathur', 'Competition'),
(103, 'Al-Asr', 'the declining day'),
(104, 'Al-Humaza', 'The Traducer'),
(105, 'Al-fil', 'The Elephant'),
(106, 'Quraish', 'Quraish'),
(107, 'Al-Maun', 'Alms Giving'),
(108, 'Al-Kauther', 'Abundance'),
(109, 'Al-Kafiroon', 'The Disbelievers'),
(110, 'An-Nasr', 'The Succour'),
(111, 'Al-Masadd', 'The Flame'),
(112, 'Al-Ikhlas', 'Absoluteness'),
(113, 'Al-Falaq', 'The day break'),
(114, 'An-Nas', 'The mankind');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
