-- Script was generated by Devart dbForge Studio for MySQL, Version 5.0.33.0
-- Product Home Page: http://www.devart.com/dbforge/mysql/studio
-- Script date 1/16/2018 9:38:25 PM
-- Source server version: 5.6.27
-- Source connection string: User Id=root;Host=localhost;Database=mysql;Character Set=utf8;
-- Target server version: 5.6.27
-- Target connection string: User Id=root;Host=localhost;Database=mysql;Character Set=utf8;
-- Run this script against dbdosen1 to synchronize it with dbdosen
-- Please backup your target database before running this script

--
-- Disable foreign keys
--
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

SET NAMES 'utf8';
USE dbdosen;

--
-- Alter table tbldosen
--
ALTER TABLE tbldosen
  ADD COLUMN NIDN VARCHAR(255) DEFAULT NULL COMMENT 'Nomor Induk Dosen Nasional' AFTER dosenNama;

ALTER TABLE tbldosen
  ADD UNIQUE INDEX UK_tbldosen_NIDN (NIDN);

--
-- Alter table tblnilai
--
ALTER TABLE tblnilai
  DROP COLUMN periodeAjar,
  DROP COLUMN kehadiran,
  DROP COLUMN ketepatan,
  DROP COLUMN kesesuaian,
  DROP COLUMN kelulusan,
  DROP COLUMN quisioner,
  DROP COLUMN statusID,
  ADD COLUMN nilaiID INT(11) NOT NULL AUTO_INCREMENT FIRST,
  ADD COLUMN tanggal DATE DEFAULT NULL AFTER dosenID,
  ADD COLUMN mataID INT(11) NOT NULL DEFAULT 1 AFTER tanggal,
  ADD COLUMN jenisNilai VARCHAR(10) DEFAULT 'UAS' COMMENT 'UAS; UTS' AFTER mataID,
  CHANGE COLUMN createdOn createdon TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER jenisNilai,
  ADD COLUMN isActive TINYINT(1) NOT NULL DEFAULT 1 AFTER createdon,
  DROP PRIMARY KEY,
  ADD PRIMARY KEY (nilaiID);

--
-- Enable foreign keys
--
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
