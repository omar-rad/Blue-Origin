-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 Mar 2022, 16:52:29
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `test2`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `jobpost`
--

CREATE TABLE `jobpost` (
  `companyName` varchar(50) DEFAULT NULL,
  `jobRole` varchar(50) DEFAULT NULL,
  `jobDescription` varchar(300) DEFAULT NULL,
  `jobType` varchar(50) NOT NULL,
  `userEmail` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `resetpasswords`
--

CREATE TABLE `resetpasswords` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `resetpasswords`
--

INSERT INTO `resetpasswords` (`id`, `code`, `email`) VALUES
(9, '1623c8d60e3ed1', 'testblueorigin@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `password` varchar(70) NOT NULL,
  `phoneNo` int(70) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `companyName` varchar(80) DEFAULT NULL,
  `userType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`fName`, `lName`, `email`, `userName`, `password`, `phoneNo`, `address`, `companyName`, `userType`) VALUES
('NULL', 'NULL', 'canno1943@gmail.com', 'apple2', '$2y$10$hKTAAMAqCMAqX4caE5EkLetNtXx4qa5tepOeUssWyBxe8nS4qt9qO', 1234336421, 'adress881', 'apple2', 'Company'),
('NULL', 'NULL', 'canno1963@gmail.com', 'apple3', '$2y$10$Zc5bLhaRQDyp2gR4/e4wP.QwDhXRDr4lINPv0Minst1XBC.x6tV26', 1234556429, 'adress883', 'apple3', 'Company'),
('test', 'test2', 'canno198333@gmail.com', 'cannosaaaa', '$2y$10$OgyOUX/.mlF3aj/A1BnSc.XSlRFjozwx3D14TmmtxT1gQyvqpp1c.', 1244567890, 'testaddresscekmekoy', 'NULL', 'EndUser'),
('TestCan', 'TestDonmez', 'testblueorigin@gmail.com', 'lasttest123', '$2y$10$2Zuu/n9271M9BOPutooE5.F06ScUH.NiPwQKYot5RJ2n1/BxEQW4y', 533, 'LastTest', 'NULL', 'EndUser');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `jobpost`
--
ALTER TABLE `jobpost`
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- Tablo için indeksler `resetpasswords`
--
ALTER TABLE `resetpasswords`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `resetpasswords`
--
ALTER TABLE `resetpasswords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `jobpost`
--
ALTER TABLE `jobpost`
  ADD CONSTRAINT `jobpost_ibfk_1` FOREIGN KEY (`userEmail`) REFERENCES `user` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
