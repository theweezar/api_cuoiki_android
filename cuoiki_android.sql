-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 06:59 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuoiki_android`
--

-- --------------------------------------------------------

--
-- Table structure for table `capphat`
--

CREATE TABLE `capphat` (
  `SOPHIEU` varchar(100) NOT NULL,
  `NGAYCAP` date NOT NULL,
  `MAVPP` varchar(100) NOT NULL,
  `MANV` varchar(100) NOT NULL,
  `SOLUONG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `capphat`
--

INSERT INTO `capphat` (`SOPHIEU`, `NGAYCAP`, `MAVPP`, `MANV`, `SOLUONG`) VALUES
('PHIEU1', '2018-08-25', 'VPP01', 'NV01', 10),
('PHIEU2', '2018-08-25', 'VPP02', 'NV02', 15),
('PHIEU3', '2018-08-25', 'VPP01', 'NV01', 24),
('PHIEU4', '2019-02-24', 'VPP03', 'NV03', 4),
('PHIEU5', '2018-10-30', 'VPP05', 'NV05', 7),
('PHIEU6', '2020-05-07', 'VPP01', 'NV03', 16),
('PHIEU7', '2020-05-07', 'VPP02', 'NV01', 15),
('PHIEU8', '2020-02-07', 'VPP06', 'NV04', 16),
('PHIEU9', '2018-02-09', 'VPP01', 'NV05', 14);

-- --------------------------------------------------------

--
-- Table structure for table `chitietphieucc`
--

CREATE TABLE `chitietphieucc` (
  `ID` int(11) NOT NULL,
  `SOPHIEU` varchar(100) NOT NULL,
  `MAVPP` varchar(100) NOT NULL,
  `SOLUONG` int(11) NOT NULL,
  `THANHTIEN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chitietphieucc`
--

INSERT INTO `chitietphieucc` (`ID`, `SOPHIEU`, `MAVPP`, `SOLUONG`, `THANHTIEN`) VALUES
(1, 'P1', 'VPP01', 7, 70000),
(2, 'P1', 'VPP02', 5, 24000),
(3, 'P2', 'VPP01', 1, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MANCC` varchar(100) NOT NULL,
  `TENNCC` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhacungcap`
--

INSERT INTO `nhacungcap` (`MANCC`, `TENNCC`, `EMAIL`) VALUES
('VPPKBTC', 'VAN PHONG PHAM KIM BIEN TOAN CAU', 'minhducducminh1999@gmail.com\r\n'),
('VPPSH', 'VAN PHONG PHAM SAN HA', 'minhducducminh1999@gmail.com\r\n'),
('VPPVNC', 'VAN PHONG PHAM VINACOM', 'minhducducminh1999@gmail.com\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MANV` varchar(100) NOT NULL,
  `HOTEN` varchar(1024) NOT NULL,
  `NGAYSINH` date NOT NULL,
  `MAPB` varchar(100) NOT NULL,
  `EMAIL` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MANV`, `HOTEN`, `NGAYSINH`, `MAPB`, `EMAIL`) VALUES
('NV1', 'NGUYEN THANH NAM', '1982-08-01', 'PB01', NULL),
('NV2', 'VU THI THAM', '1992-08-12', 'PB01', NULL),
('NV3', 'HO THANH TAM', '1990-06-05', 'PB02', NULL),
('NV4', 'NGO DUC TRUNG', '1990-08-04', 'PB02', NULL),
('NV5', 'VU VAN NAM', '1992-12-02', 'PB03', NULL),
('NV6', 'TRAN VAN THANG', '1991-08-23', 'PB04', NULL),
('NV7', 'HA QUANG DU', '1985-08-07', 'PB04', NULL),
('NV8', 'NGO PHUONG LAN', '1990-02-01', 'PB05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phieucungcap`
--

CREATE TABLE `phieucungcap` (
  `SOPHIEU` varchar(100) NOT NULL,
  `TRANGTHAI` enum('OPENING','CONFIRMED','DELIVERIED','CANCELED') NOT NULL,
  `MANCC` varchar(100) NOT NULL,
  `NGAYDAT` date DEFAULT NULL,
  `NGAYGIAO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieucungcap`
--

INSERT INTO `phieucungcap` (`SOPHIEU`, `TRANGTHAI`, `MANCC`, `NGAYDAT`, `NGAYGIAO`) VALUES
('P1', 'DELIVERIED', 'VPPVNC', '2021-06-16', '2021-06-18'),
('P2', 'CANCELED', 'VPPVNC', '2021-06-16', '2021-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

CREATE TABLE `phongban` (
  `MAPB` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TENPB` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`MAPB`, `TENPB`) VALUES
('PB1', 'PHONG GIAM DOC'),
('PB2', 'PHONG KINH TE'),
('PB3', 'PHONG KY THUAT'),
('PB4', 'PHONG KY THUAT 2'),
('PB5', 'PHONG SINH HOAT'),
('PB6', 'PHONG BAO VE'),
('PB7', 'NHA BEP'),
('PB8', 'HAM GUI XE');

-- --------------------------------------------------------

--
-- Table structure for table `vanphongpham`
--

CREATE TABLE `vanphongpham` (
  `MAVPP` varchar(100) NOT NULL,
  `TENVPP` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DVT` varchar(1024) NOT NULL,
  `GIANHAP` int(11) NOT NULL,
  `HINH` varchar(1024) DEFAULT NULL,
  `SOLUONG` int(11) NOT NULL,
  `MANCC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vanphongpham`
--

INSERT INTO `vanphongpham` (`MAVPP`, `TENVPP`, `DVT`, `GIANHAP`, `HINH`, `SOLUONG`, `MANCC`) VALUES
('VPP1', 'GIAY A444', 'GRAM', 70000, NULL, 25, 'VPPKBTC'),
('VPP2', 'KEO', 'CAI', 12000, NULL, 20, 'VPPKBTC'),
('VPP3', 'BUT BI XANH', 'HOP', 50000, NULL, 5, 'VPPSH'),
('VPP4', 'BUT BI DO', 'HOP', 50000, NULL, 5, 'VPPSH'),
('VPP5', 'DAU BAM', 'CAI', 18000, NULL, 5, 'VPPVNC'),
('VPP6', 'KEO DAN HAI MAT', 'CAI', 11000, NULL, 7, 'VPPVNC'),
('VPP7', 'BAN PHIM', 'CAI', 10, NULL, 1, 'VPPKBTC'),
('VPP8', 'TAY TRANG', 'CUC', 15000, NULL, 16, 'VPPKBTC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `capphat`
--
ALTER TABLE `capphat`
  ADD PRIMARY KEY (`SOPHIEU`);

--
-- Indexes for table `chitietphieucc`
--
ALTER TABLE `chitietphieucc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MANCC`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MANV`);

--
-- Indexes for table `phieucungcap`
--
ALTER TABLE `phieucungcap`
  ADD PRIMARY KEY (`SOPHIEU`);

--
-- Indexes for table `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`MAPB`);

--
-- Indexes for table `vanphongpham`
--
ALTER TABLE `vanphongpham`
  ADD PRIMARY KEY (`MAVPP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietphieucc`
--
ALTER TABLE `chitietphieucc`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
