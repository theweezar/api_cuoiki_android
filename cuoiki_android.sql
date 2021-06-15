-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 04:56 PM
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
('VPPKBTC', 'VĂN PHÒNG PHẨM KIM BIÊN TOÀN CẦU', 'hpmduc1999@gmail.com'),
('VPPSH', 'VĂN PHÒNG PHẨM SANG HÀ', 'hpmduc1999@gmail.com'),
('VPPVNC', 'VĂN PHÒNG PHẨM VINACOM', 'hpmduc1999@gmail.com');

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
('NV01', 'NGUYỄN THÀNH NAM', '1982-08-01', 'PB01', NULL),
('NV02', 'VŨ THỊ THẮM', '1992-08-12', 'PB01', NULL),
('NV03', 'HỒ THANH TÂM', '1990-06-05', 'PB02', NULL),
('NV04', 'NGÔ ĐỨC TRUNG', '1990-08-04', 'PB02', NULL),
('NV05', 'VŨ VĂN NAM', '1992-12-02', 'PB03', NULL),
('NV06', 'TRẦN VĂN THẮNG', '1991-08-23', 'PB04', NULL),
('NV07', 'HÀ QUANG DỰ', '1985-08-07', 'PB04', NULL),
('NV08', 'NGÔ PHƯƠNG LAN', '1990-02-01', 'PB05', NULL),
('NV09', 'LUCKY LUKE', '1964-04-12', 'PB01', '');

-- --------------------------------------------------------

--
-- Table structure for table `phieucungcap`
--

CREATE TABLE `phieucungcap` (
  `SOPHIEU` varchar(100) NOT NULL,
  `TRANGTHAI` enum('OPENING','CONFIRMED','DELIVERIED','CANCELLED') NOT NULL,
  `MANCC` varchar(100) NOT NULL,
  `NGAYDAT` date DEFAULT NULL,
  `NGAYGIAO` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phieucungcap`
--

INSERT INTO `phieucungcap` (`SOPHIEU`, `TRANGTHAI`, `MANCC`, `NGAYDAT`, `NGAYGIAO`) VALUES
('P1', 'OPENING', 'VPPSH', '2021-06-13', NULL);

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
('PB01', 'PHONG GIAM DOC'),
('PB02', 'PHONG KINH TE'),
('PB03', 'PHONG KY THUAT'),
('PB04', 'PHONG KY THUAT 2'),
('PB05', 'PHONG SINH HOAT'),
('PB06', 'PHONG BAO VE'),
('PB07', 'NHA BEP'),
('PB08', 'PHONG SUA XE'),
('PB09', 'PHONG MAY DO'),
('PB10', 'NHA VE SINH'),
('PB11', 'CHUONG HEO'),
('PB12', 'NHA XE');

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
('VPP01', 'GIẤY A4', 'GRAM', 70000, NULL, 10, 'VPPKBTC'),
('VPP02', 'KÉO', 'CÁI', 12000, NULL, 5, 'VPPKBTC'),
('VPP03', 'BÚT BI XANH', 'HỘP', 50000, NULL, 5, 'VPPSH'),
('VPP04', 'BÚT BI ĐỎ', 'HỘP', 50000, NULL, 5, 'VPPSH'),
('VPP05', 'ĐẦU BẤM', 'CÁI', 18000, NULL, 5, 'VPPVNC'),
('VPP06', 'KEO DÁN HAI MẶT', 'CÁI', 11000, NULL, 7, 'VPPVNC'),
('VPP07', 'BAN PHIM', 'CAI', 10, 'yksamtboze.jpg', 1, 'VPPKBTC');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
