-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2020 at 07:43 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdosen`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbldosen`
--

CREATE TABLE `tbldosen` (
  `dosenID` int(11) NOT NULL,
  `dosenNama` varchar(255) DEFAULT NULL,
  `dosenJabatan` varchar(4) NOT NULL DEFAULT 'D' COMMENT 'D: Dosen; AA: Asisten Ahli; L: Lektor',
  `dosenAlamat` text DEFAULT NULL,
  `dosenTelp` varchar(100) DEFAULT NULL,
  `dosenEmail` varchar(100) DEFAULT NULL,
  `dosenSertifikat` varchar(255) DEFAULT NULL,
  `dosenPT` varchar(255) DEFAULT NULL COMMENT 'Perguruan Tinggi',
  `dosenAlamatPT` text DEFAULT NULL,
  `dosenStatus` varchar(10) DEFAULT NULL COMMENT 'DS/PR/DT/PT',
  `dosenFakultas` varchar(255) DEFAULT NULL,
  `dosenJurusan` varchar(255) DEFAULT NULL,
  `dosenGolongan` varchar(255) DEFAULT NULL,
  `dosenTempatLahir` varchar(255) DEFAULT NULL COMMENT 'Tempat Tanggal Lahir',
  `dosenTanggalLahir` date DEFAULT NULL,
  `dosenS1` varchar(255) DEFAULT NULL,
  `dosenS2` varchar(255) DEFAULT NULL,
  `dosenS3` varchar(255) DEFAULT NULL,
  `dosenIlmu` text DEFAULT NULL COMMENT 'Ilmu yang ditekuni',
  `dosenActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `tbldosen`
--

INSERT INTO `tbldosen` (`dosenID`, `dosenNama`, `dosenJabatan`, `dosenAlamat`, `dosenTelp`, `dosenEmail`, `dosenSertifikat`, `dosenPT`, `dosenAlamatPT`, `dosenStatus`, `dosenFakultas`, `dosenJurusan`, `dosenGolongan`, `dosenTempatLahir`, `dosenTanggalLahir`, `dosenS1`, `dosenS2`, `dosenS3`, `dosenIlmu`, `dosenActive`) VALUES
(1, 'Test', 'D', 'Batams', '93939393', 'bonitoo@live.com', 'Sert', 'PT INDONESIA', 'Jogjakarta', 'DT', 'Perdukunan', 'Keilmuan', 'Kaya', 'Batam', '2017-12-01', '', '', '', NULL, 0),
(2, 'Test 2', 'AA', 'Batam', '838777777', 'batam@batam.com', 'sertipikat', 'Pherguruan Thinggi', 'Alamat PTNYA', 'PT', 'Phakoeltaz', 'Djoeroesyan', 'Golonggan', 'thempat laheer', '2017-08-02', 'Sone', 'STwo', 'SThree', NULL, 0),
(3, 'Test4', 'AA', 'set444', '34234', '234234@asdfasdf.com', 'asdfasf', 'asdf', 'asdf', 'DS', 'asdf', 'asdf', 'asdf', 'asdfadf', '2017-12-17', '2', '3', '4', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbljadual`
--

CREATE TABLE `tbljadual` (
  `jadualID` int(11) NOT NULL,
  `jadualNama` varchar(255) NOT NULL,
  `isAktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `tbljadual`
--

INSERT INTO `tbljadual` (`jadualID`, `jadualNama`, `isAktif`) VALUES
(1, 'Senin II', 1),
(2, 'Senin III a', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblkehadiran`
--

CREATE TABLE `tblkehadiran` (
  `hadirID` int(11) NOT NULL,
  `dosenID` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `dosenJabatan` varchar(4) NOT NULL DEFAULT 'D',
  `hadirStatus` varchar(100) DEFAULT NULL,
  `mataID` int(11) NOT NULL DEFAULT 0,
  `sks` int(11) NOT NULL DEFAULT 3,
  `smtr` varchar(10) DEFAULT 'I',
  `kls` varchar(10) NOT NULL DEFAULT 'A',
  `jadualID` int(11) NOT NULL DEFAULT 0,
  `mingguKe` varchar(5) NOT NULL DEFAULT 'I' COMMENT 'I,II,III,IV,V,VI',
  `totalWajib` int(11) NOT NULL DEFAULT 2,
  `totalHadir` int(11) NOT NULL DEFAULT 0,
  `perc` double NOT NULL DEFAULT 0 COMMENT 'Prosentase',
  `keterangan` text DEFAULT NULL
) ENGINE=MyISAM AVG_ROW_LENGTH=50 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblkehadiran`
--

INSERT INTO `tblkehadiran` (`hadirID`, `dosenID`, `tanggal`, `dosenJabatan`, `hadirStatus`, `mataID`, `sks`, `smtr`, `kls`, `jadualID`, `mingguKe`, `totalWajib`, `totalHadir`, `perc`, `keterangan`) VALUES
(3, 2, '2017-12-19', 'AA', '', 1, 3, 'I', 'A', 1, 'I', 2, 0, 0, ''),
(4, 2, '2017-11-01', 'AA', '', 2, 3, 'II', 'B', 2, 'II', 2, 0, 0, 'test'),
(5, 2, '2017-12-21', 'AA', 'ff', 3, 3, 'I', 'B', 1, 'I', 2, 0, 0, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tblkelulusan`
--

CREATE TABLE `tblkelulusan` (
  `dosenID` int(11) NOT NULL,
  `periodeAjar` varchar(20) NOT NULL,
  `kelulusan` double NOT NULL DEFAULT 0,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `stat` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Table structure for table `tblkesusaianajar`
--

CREATE TABLE `tblkesusaianajar` (
  `dosenID` int(11) NOT NULL,
  `periodeAjar` varchar(20) NOT NULL,
  `kesesuaian` int(11) NOT NULL DEFAULT 0 COMMENT 'Kesesuaian Bahan Ajar (0-10)',
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `stat` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblketepatan`
--

CREATE TABLE `tblketepatan` (
  `dosenID` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `mataID` int(11) NOT NULL DEFAULT 0 COMMENT 'Mata Kuliah',
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `stat` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblmatakuliah`
--

CREATE TABLE `tblmatakuliah` (
  `mataID` int(11) NOT NULL,
  `mataKuliah` varchar(255) NOT NULL,
  `isAktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `tblmatakuliah`
--

INSERT INTO `tblmatakuliah` (`mataID`, `mataKuliah`, `isAktif`) VALUES
(1, 'Set55', 0),
(2, 'Test 456a', 0),
(3, 'Test', 0),
(4, 'Ilkom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblnilai`
--

CREATE TABLE `tblnilai` (
  `dosenID` int(11) NOT NULL,
  `periodeAjar` varchar(20) NOT NULL,
  `kehadiran` int(11) NOT NULL DEFAULT 0 COMMENT 'Tingkat kehadiran dengan Skala (0-10)',
  `ketepatan` int(11) NOT NULL DEFAULT 0,
  `kesesuaian` int(11) NOT NULL DEFAULT 0,
  `kelulusan` int(11) NOT NULL DEFAULT 0,
  `quisioner` int(11) NOT NULL DEFAULT 0,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `statusID` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `tblnilai`
--

INSERT INTO `tblnilai` (`dosenID`, `periodeAjar`, `kehadiran`, `ketepatan`, `kesesuaian`, `kelulusan`, `quisioner`, `createdOn`, `statusID`) VALUES
(1, '2017-11', 4, 0, 0, 0, 0, '2017-12-06 13:41:27', 1),
(1, '2017-12', 1, 3, 5, 4, 1, '2017-12-06 13:41:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpenelitian`
--

CREATE TABLE `tblpenelitian` (
  `penelitianID` int(11) NOT NULL,
  `dosenID` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `penelitianJudul` varchar(255) NOT NULL,
  `penelitianKeterangan` text DEFAULT NULL,
  `penelitianFile` varchar(255) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `stat` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `tblpenelitian`
--

INSERT INTO `tblpenelitian` (`penelitianID`, `dosenID`, `tanggal`, `penelitianJudul`, `penelitianKeterangan`, `penelitianFile`, `createdOn`, `stat`) VALUES
(1, 2, '2017-12-20', 'jjj', 'kkkk123', '1712210810-pnl-123.pdf', '2017-12-19 15:46:46', 1),
(3, 2, '2017-12-17', 'JUDUL', 'JUDUL KETERANGAN', '1712210814-pnl-456.pdf', '2017-12-21 13:14:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpengabdian`
--

CREATE TABLE `tblpengabdian` (
  `pengabdianID` int(11) NOT NULL,
  `dosenID` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `pengabdianFile` varchar(255) DEFAULT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `stat` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpengabdian`
--

INSERT INTO `tblpengabdian` (`pengabdianID`, `dosenID`, `tanggal`, `keterangan`, `pengabdianFile`, `createdOn`, `stat`) VALUES
(1, 2, '2017-12-13', 'Pengabdian pertama i', '1712210859-png-789.pdf', '2017-12-21 13:59:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblquisioner`
--

CREATE TABLE `tblquisioner` (
  `quizID` int(11) NOT NULL,
  `dosenID` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `quisionerNilai` double NOT NULL DEFAULT 0,
  `createdOn` timestamp NULL DEFAULT current_timestamp(),
  `stat` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `webpassword` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `lastLogin` datetime DEFAULT NULL,
  `userActive` tinyint(1) NOT NULL DEFAULT 1,
  `userType` int(4) NOT NULL DEFAULT 1 COMMENT '1:Dosen, 2:TU; 3:Penjamin Mutu; 4:Dekan; 5: Kaprodi',
  `dosenID` int(11) NOT NULL DEFAULT 0 COMMENT 'Associated DosenID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userid`, `username`, `fullname`, `webpassword`, `isAdmin`, `lastLogin`, `userActive`, `userType`, `dosenID`) VALUES
(1, 'admin', 'Administrator', '21232f297a57a5a743894a0e4a801fc3', 1, '2020-09-18 19:32:55', 1, 1, 2),
(4, 'test', 'test 1', '098f6bcd4621d373cade4e832627b4f6', 0, NULL, 0, 2, 2),
(5, 'set', 'set 2', 'e605a70d13cff3c8de4fe782e8dcf061', 0, NULL, 0, 3, 3),
(6, 'aaa', 'aaabdddcc', '68053af2923e00204c3ca7c6a3150cf7', 0, '2017-12-22 22:13:05', 1, 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbldosen`
--
ALTER TABLE `tbldosen`
  ADD PRIMARY KEY (`dosenID`);

--
-- Indexes for table `tbljadual`
--
ALTER TABLE `tbljadual`
  ADD PRIMARY KEY (`jadualID`),
  ADD UNIQUE KEY `jadualNama` (`jadualNama`);

--
-- Indexes for table `tblkehadiran`
--
ALTER TABLE `tblkehadiran`
  ADD PRIMARY KEY (`hadirID`),
  ADD UNIQUE KEY `UK_tblkehadiran` (`dosenID`,`jadualID`,`tanggal`,`mataID`);

--
-- Indexes for table `tblkelulusan`
--
ALTER TABLE `tblkelulusan`
  ADD PRIMARY KEY (`dosenID`,`periodeAjar`);

--
-- Indexes for table `tblkesusaianajar`
--
ALTER TABLE `tblkesusaianajar`
  ADD PRIMARY KEY (`dosenID`,`periodeAjar`);

--
-- Indexes for table `tblketepatan`
--
ALTER TABLE `tblketepatan`
  ADD PRIMARY KEY (`dosenID`,`tanggal`,`mataID`);

--
-- Indexes for table `tblmatakuliah`
--
ALTER TABLE `tblmatakuliah`
  ADD PRIMARY KEY (`mataID`),
  ADD UNIQUE KEY `mataKuliah` (`mataKuliah`);

--
-- Indexes for table `tblnilai`
--
ALTER TABLE `tblnilai`
  ADD PRIMARY KEY (`dosenID`,`periodeAjar`);

--
-- Indexes for table `tblpenelitian`
--
ALTER TABLE `tblpenelitian`
  ADD PRIMARY KEY (`penelitianID`),
  ADD UNIQUE KEY `UK_tblpenelitian` (`dosenID`,`penelitianJudul`,`tanggal`);

--
-- Indexes for table `tblpengabdian`
--
ALTER TABLE `tblpengabdian`
  ADD PRIMARY KEY (`pengabdianID`),
  ADD UNIQUE KEY `UK_tblpenelitian` (`dosenID`,`tanggal`);

--
-- Indexes for table `tblquisioner`
--
ALTER TABLE `tblquisioner`
  ADD PRIMARY KEY (`quizID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbldosen`
--
ALTER TABLE `tbldosen`
  MODIFY `dosenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbljadual`
--
ALTER TABLE `tbljadual`
  MODIFY `jadualID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblkehadiran`
--
ALTER TABLE `tblkehadiran`
  MODIFY `hadirID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblmatakuliah`
--
ALTER TABLE `tblmatakuliah`
  MODIFY `mataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblpenelitian`
--
ALTER TABLE `tblpenelitian`
  MODIFY `penelitianID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpengabdian`
--
ALTER TABLE `tblpengabdian`
  MODIFY `pengabdianID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblquisioner`
--
ALTER TABLE `tblquisioner`
  MODIFY `quizID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
