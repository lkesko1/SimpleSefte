-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 07:32 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpleseftedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(10) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'sifra');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `adresa` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` varchar(2000) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `name`, `adresa`, `subject`, `tekst`) VALUES
(1, 'adna kark', 'adna.karkelja@hotmail.com', 'adna', 'adna adna'),
(5, 'abe ce', 'lella_choko@hotmail.com', 'poruka', 'ovo je poruka'),
(6, 'kesko le', 'lejla.kesko@hotmail.com', 'predmet', 'ovo je druga poruka'),
(7, 'neko nekic', 'lejla.kesko@hotmail.com', 'hotmail', 'tekst'),
(8, 'le jla', 'lkesko1@etf.unsa.ba', 'etf', 'wt'),
(9, 'admina admin', 'admin@hotmail.com', 'admin', 'admin'),
(10, 'admin administrator', 'lela.ch23@gmail.com', 'gmail', 'wt'),
(11, 'le ke', 'lela.ch23@gmail.com', 'lela', 'okoko'),
(12, 'lejla kesko', 'lella_choko@hotmail.com', 'mail', 'ja sam lejla lll okej &lt;HTML&gt;'),
(13, 'simba limba', 'lkesko1@etf.unsa.ba', 'simba', '&lt;BUTTON VALUE = &quot;OK&quot;&gt;&lt;/BUTTON&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `novost`
--

CREATE TABLE `novost` (
  `ID` int(11) NOT NULL,
  `tekst` varchar(500) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `novost`
--

INSERT INTO `novost` (`ID`, `tekst`) VALUES
(2, 'lejla kesko test'),
(3, 'Simple sefte ok'),
(4, 'lejla kesko');

-- --------------------------------------------------------

--
-- Table structure for table `ocjena`
--

CREATE TABLE `ocjena` (
  `id` int(11) NOT NULL,
  `broj` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `ocjena`
--

INSERT INTO `ocjena` (`id`, `broj`) VALUES
(1, 4),
(8, 5),
(6, 2),
(10, 3),
(9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

CREATE TABLE `rezervacija` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_slovenian_ci NOT NULL,
  `datum` datetime NOT NULL,
  `vrijeme` varchar(15) COLLATE utf8_slovenian_ci NOT NULL,
  `broj` int(11) NOT NULL,
  `tekst` varchar(200) COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`id`, `name`, `phone`, `datum`, `vrijeme`, `broj`, `tekst`) VALUES
(1, 'simba limba', '062-320-716', '2017-01-01 00:00:00', '18:35', 5, 'rucak5'),
(2, 'lejla kesko', '062-320-716', '2017-01-01 00:00:00', '11:51', 2, 'kkkesko99 ovo je duga jedna poruka samo za testiranje pdf-a, ja sam lejla'),
(4, 'abe ce', '033-834-849', '2017-01-07 00:00:00', '17:12', 2, 'ok'),
(5, 'SIMBA LIMBA', '061-252-273', '2016-12-30 00:00:00', '18:51', 3, 'AV AV'),
(6, 'kesko kesko', '033-834-849', '2016-12-30 00:00:00', '18:59', 3, 'posljednja'),
(7, 'Adna karkelja', '061-908-880', '2016-12-31 00:00:00', '15:11', 12, 'kkkesko99 ovo je duga jedna poruka samo za testiranje pdf-a, ja sam lejla');

-- --------------------------------------------------------

--
-- Table structure for table `sastojak`
--

CREATE TABLE `sastojak` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `sastojak`
--

INSERT INTO `sastojak` (`id`, `naziv`) VALUES
(1, 'svježe pecivo'),
(2, 'pomfrit'),
(3, 'luk'),
(4, 'začini'),
(5, 'krompir'),
(6, 'paradajz'),
(7, 'paprika'),
(8, 'paradajz sos'),
(9, 'mrkva'),
(10, 'gljive'),
(11, 'sir'),
(12, 'pileća prsa'),
(13, 'masline'),
(14, 'salata'),
(15, 'sos');

-- --------------------------------------------------------

--
-- Table structure for table `sastojci`
--

CREATE TABLE `sastojci` (
  `id` int(11) NOT NULL,
  `id_stavke` int(11) NOT NULL,
  `id_sastojka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `sastojci`
--

INSERT INTO `sastojci` (`id`, `id_stavke`, `id_sastojka`) VALUES
(1, 1, 11),
(2, 1, 8),
(3, 2, 11),
(4, 2, 8),
(5, 2, 10),
(6, 3, 11),
(7, 3, 8),
(8, 3, 12),
(9, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `stavka`
--

CREATE TABLE `stavka` (
  `id` int(11) NOT NULL,
  `naziv` varchar(80) COLLATE utf8_slovenian_ci NOT NULL,
  `cijena` double NOT NULL,
  `id_vrste` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `stavka`
--

INSERT INTO `stavka` (`id`, `naziv`, `cijena`, `id_vrste`) VALUES
(1, 'Margarita', 4, 1),
(2, 'Fungi', 5, 1),
(3, 'Capricciosa', 5, 1),
(4, 'Vegeteriana', 6, 1),
(5, 'Espresso kafa', 1, 3),
(6, 'Topla čokolada', 3, 3),
(7, 'Macchiato', 2, 3),
(8, 'Nes classic', 3, 3),
(9, 'Teleći doner/kebab u somunu', 4, 4),
(10, 'Teleći doner/kebab u rolni', 4.5, 4),
(11, 'Pileći doner/kebab u somunu', 4, 4),
(12, 'Pileći doner/kebab u rolni', 4, 4),
(13, 'Kebab salata', 5, 5),
(14, 'Pileća salata', 5, 5),
(15, 'Vegeterijanska salata ', 5, 5),
(16, 'Altono salata', 5, 5),
(17, 'Gazirani sokovi', 2, 6),
(18, 'Prirodni sokovi', 2.5, 6),
(19, 'Pasta sa piletinom', 4, 7),
(20, 'Pasta sa sirom', 4, 7),
(21, 'Pasta sa kebab mesom', 4, 7),
(22, 'Pasta sa sirom', 4, 7),
(23, 'Pileći sendvič', 3.5, 2),
(24, 'Suho meso sendvič', 3.5, 2),
(25, 'Tunjevina sendvič', 3.5, 2),
(26, 'Sefte sendvič s puretinom', 5, 2),
(27, 'Pomfrit', 1.5, 8),
(28, 'Palačinci nutella', 4, 8),
(29, 'Hamburger', 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `vrsta`
--

CREATE TABLE `vrsta` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `vrsta`
--

INSERT INTO `vrsta` (`id`, `naziv`) VALUES
(1, 'Pizza'),
(2, 'Sendvic'),
(3, 'Topli napitak'),
(4, 'Kebabb'),
(5, 'Salata'),
(6, 'Piće'),
(7, 'Pasta'),
(8, 'Ostalo'),
(9, 'Grill');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `novost`
--
ALTER TABLE `novost`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ocjena`
--
ALTER TABLE `ocjena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sastojak`
--
ALTER TABLE `sastojak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sastojci`
--
ALTER TABLE `sastojci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_stavke` (`id_stavke`),
  ADD KEY `id_sastojka` (`id_sastojka`);

--
-- Indexes for table `stavka`
--
ALTER TABLE `stavka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vrste` (`id_vrste`);

--
-- Indexes for table `vrsta`
--
ALTER TABLE `vrsta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `novost`
--
ALTER TABLE `novost`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ocjena`
--
ALTER TABLE `ocjena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sastojak`
--
ALTER TABLE `sastojak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sastojci`
--
ALTER TABLE `sastojci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `stavka`
--
ALTER TABLE `stavka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `vrsta`
--
ALTER TABLE `vrsta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `sastojci`
--
ALTER TABLE `sastojci`
  ADD CONSTRAINT `sastojci_ibfk_1` FOREIGN KEY (`id_stavke`) REFERENCES `stavka` (`id`),
  ADD CONSTRAINT `sastojci_ibfk_2` FOREIGN KEY (`id_sastojka`) REFERENCES `sastojak` (`id`);

--
-- Constraints for table `stavka`
--
ALTER TABLE `stavka`
  ADD CONSTRAINT `stavka_ibfk_1` FOREIGN KEY (`id_vrste`) REFERENCES `vrsta` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
