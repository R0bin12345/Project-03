-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 apr 2024 om 10:06
-- Serverversie: 10.4.22-MariaDB
-- PHP-versie: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `bestel` int(200) NOT NULL,
  `klantcode` int(11) NOT NULL,
  `productcode` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `bestelcode` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`bestel`, `klantcode`, `productcode`, `aantal`, `bestelcode`) VALUES
(1, 1, 2, 50, 7),
(8, 39, 2, 99, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `klantcode` int(11) NOT NULL,
  `klantnaam` varchar(200) NOT NULL,
  `klantadres` varchar(200) NOT NULL,
  `klantplaats` varchar(200) NOT NULL,
  `klantcontact` varchar(255) NOT NULL,
  `klantpostcode` varchar(255) NOT NULL,
  `klantcountry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`klantcode`, `klantnaam`, `klantadres`, `klantplaats`, `klantcontact`, `klantpostcode`, `klantcountry`) VALUES
(1, 'Dave', 'spijkstraat 222', 'spijkenisse', '061233456778', '3201BU', 'NL'),
(6, 'De vrieas', 'yf.y', 'maasbruggen', '065355', '6974bg', 'DE'),
(8, 'Peter Duijn', 'Hoogstraat 9', 'baarle-nassau', '065355', '4698 Hk', 'ES');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `productcode` int(11) NOT NULL,
  `naam` varchar(200) NOT NULL,
  `merk` varchar(200) NOT NULL,
  `prijs` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`productcode`, `naam`, `merk`, `prijs`) VALUES
(1, 'laptop ', 'Asus', '2000.00'),
(2, 'lap9', 'Asus', '750.00');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`bestelcode`),
  ADD KEY `klantcode` (`bestel`,`productcode`),
  ADD KEY `productcode` (`productcode`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`klantcode`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productcode`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `bestelcode` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `klantcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `productcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `bestelling_ibfk_1` FOREIGN KEY (`bestel`) REFERENCES `klant` (`klantcode`),
  ADD CONSTRAINT `bestelling_ibfk_2` FOREIGN KEY (`productcode`) REFERENCES `product` (`productcode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
