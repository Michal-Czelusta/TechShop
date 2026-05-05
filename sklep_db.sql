-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2026 at 12:10 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sklep_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`, `slug`) VALUES
(1, 'Karty graficzne', 'karty-graficzne'),
(2, 'Procesory', 'procesory'),
(3, 'Pamięć RAM', 'pamieci-ram'),
(4, 'Dyski SSD', 'dyski-ssd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(200) NOT NULL,
  `opis` text DEFAULT NULL,
  `cena` decimal(10,2) NOT NULL,
  `cena_przed` decimal(10,2) DEFAULT NULL,
  `zdjecie` varchar(255) DEFAULT 'brak.jpg',
  `kategoria_id` int(11) NOT NULL,
  `dostepnosc` tinyint(1) NOT NULL DEFAULT 1,
  `data_dodania` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `opis`, `cena`, `cena_przed`, `zdjecie`, `kategoria_id`, `dostepnosc`, `data_dodania`) VALUES
(1, 'NVIDIA GeForce RTX 4060 8GB', 'Karta graficzna z obsługą ray tracingu i DLSS 3. Idealna do gier w rozdzielczości 1080p i 1440p.', 1649.00, 1899.00, 'rtx4060.png', 1, 1, '2026-04-03 18:45:20'),
(2, 'AMD Radeon RX 7600 8GB', 'Energooszczędna karta graficzna nowej generacji. Świetna wydajność w 1080p.', 1299.00, NULL, 'rx7600.png', 1, 1, '2026-04-03 18:45:20'),
(3, 'Intel Core i5-14600K', 'Procesor z 14 rdzeniami (6P+8E), odblokowany mnożnik, świetny do gier i pracy twórczej.', 1099.00, 1249.00, 'i5-14600k.png', 2, 1, '2026-04-03 18:45:20'),
(4, 'AMD Ryzen 5 7600X', 'Procesor AM5 o wysokiej wydajności jednordzeniowej, niskie TDP, doskonały stosunek ceny do jakości.', 999.00, NULL, 'ryzen5-7600x.png', 2, 1, '2026-04-03 18:45:20'),
(5, 'Kingston Fury Beast 32GB DDR5 5200MHz', 'Zestaw 2x16GB DDR5, niskie opóźnienia, profil XMP 3.0, czarny radiator.', 449.00, 549.00, 'fury-beast-ddr5.webp', 3, 1, '2026-04-03 18:45:20'),
(6, 'Samsung 990 Pro 1TB NVMe SSD', 'Dysk NVMe PCIe 4.0, odczyt do 7450 MB/s, zapis do 6900 MB/s. Topowy wybór do systemu.', 399.00, 469.00, 'samsung-990pro.png', 4, 1, '2026-04-03 18:45:20'),
(7, 'Crucial T500 500GB NVMe SSD', 'Szybki dysk SSD PCIe 4.0 w przystępnej cenie. Odczyt do 7400 MB/s.', 219.00, NULL, 'crucial-t500.webp', 4, 1, '2026-04-03 18:45:20');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `rola` enum('user','admin') NOT NULL DEFAULT 'user',
  `data_rejestracji` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nazwa`, `email`, `haslo`, `rola`, `data_rejestracji`) VALUES
(1, 'admin', 'admin@sklep.pl', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uXutHhd/i', 'admin', '2026-04-03 18:45:20'),
(4, 'michal123', 'michal.czelusta171@gmail.com', '$2y$10$wI9/Qznng5hHYWlMOOWWCehTyTruubFRAIp0tMomdxXx3sGG3cLxK', 'admin', '2026-04-03 23:22:01');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazwa` (`nazwa`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`kategoria_id`) REFERENCES `kategorie` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
