-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Jul 2017 um 17:05
-- Server-Version: 10.1.21-MariaDB
-- PHP-Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `shoppinglist`
--

CREATE DATABASE shoppinglist;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `parentId` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `name`, `parentId`) VALUES
(1, 'Frisch- & Kühlwaren', NULL),
(2, 'Nahrungsmittel', NULL),
(3, 'Getränke', NULL),
(4, 'Drogerie & Haushalt', NULL),
(5, 'Softdrinks', 3),
(6, 'Wasser', 3),
(7, 'Alkoholisches', 3),
(8, 'Kaffee & Tee', 3),
(9, 'Drogerie & Kosmetik', 4),
(10, 'Küche & Haushalt', 4),
(11, 'Baby & Kind', 4),
(12, 'Tier', 4),
(13, 'Obst & Gemüse', 1),
(14, 'Kühlregal', 1),
(15, 'Frischetheke', 1),
(16, 'Tiefkühl', 1),
(17, 'Getreideprodukte', 2),
(18, 'Fertiggerichte', 2),
(19, 'Süßes & Salziges', 2),
(20, 'Gewürze & Brotaufstriche', 2),
(21, 'Säfte', 5),
(22, 'Limonaden', 5),
(23, 'Eistee', 5),
(24, 'Energy-Drinks', 5),
(25, 'Mineralwasser', 6),
(26, 'Wasser mit Geschmack', 6),
(27, 'Wein & Sekt', 7),
(28, 'Bier', 7),
(29, 'Spirituosen', 7),
(30, 'Liköre', 7),
(31, 'Kaffee', 8),
(32, 'Tee', 8),
(33, 'Kakao', 8),
(34, 'Körperpflege', 9),
(35, 'Gesundheit', 9),
(36, 'Make-Up', 9),
(37, 'Papier- & Hygieneartikel', 9),
(38, 'Haushaltsartikel', 10),
(39, 'Putzen & Waschen', 10),
(40, 'Haus & Freizeit', 10),
(41, 'Babynahrung', 11),
(42, 'Babypflege', 11),
(43, 'Windeln', 11),
(44, 'Schnuller & Spielzeug', 11),
(45, 'Tierfutter', 12),
(46, 'Tierbedarf', 12),
(47, 'Smoothies', 13),
(48, 'Salate & Co', 13),
(49, 'Bio', 13),
(50, 'Trockenfrüchte & Nüsse', 13),
(51, 'Milch & Eier', 14),
(52, 'Wurst, Fleisch & Fisch', 14),
(53, 'Convenience', 14),
(54, 'Vegan', 14),
(55, 'Wurst- & Fleischtheke', 15),
(56, 'Käsetheke', 15),
(57, 'Fischtheke', 15),
(58, 'Antipastitheke', 15),
(59, 'TK-Fertiggerichte', 16),
(60, 'TK-Gemüse', 16),
(61, 'TK-Fisch & Fleisch', 16),
(62, 'Eiscreme', 16),
(63, 'Brot & Backwaren', 17),
(64, 'Nudeln', 17),
(65, 'Reis & Getreide', 17),
(66, 'Cerealien & Müsli ', 17),
(67, 'Gemüse- & Obstkonserven', 18),
(68, 'Fleisch- und Fischkonserven', 18),
(69, 'Fix-Produkte', 18),
(70, 'Internationales', 18),
(71, 'Salzgebäck', 19),
(72, 'Süßgebäck', 19),
(73, 'Schokolade', 19),
(74, 'Süßwaren', 19),
(75, 'Gewürze', 20),
(76, 'Essig & Öl', 20),
(77, 'Ketchup, Senf & Saucen', 20),
(78, 'Brotaufstriche', 20),
(999, 'dummy', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `listentries`
--

CREATE TABLE `listentries` (
  `userId` int(10) UNSIGNED NOT NULL,
  `productId` int(10) UNSIGNED NOT NULL,
  `categoryId` int(10) UNSIGNED NOT NULL,
  `number` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `listentries`
--

INSERT INTO `listentries` (`userId`, `productId`, `categoryId`, `number`) VALUES
(1, 6, 63, 1),
(1, 52, 63, 5),
(1, 53, 52, 3),
(1, 54, 64, 2),
(1, 57, 0, 5),
(1, 38, 13, 2),
(1, 3, 51, 3),
(1, 39, 51, 6),
(1, 59, 49, 3),
(1, 60, 37, 1),
(1, 61, 45, 8),
(1, 62, 0, 1),
(1, 58, 28, 6),
(1, 55, 5, 10),
(1, 64, 6, 12);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `positions`
--

CREATE TABLE `positions` (
  `userId` int(10) UNSIGNED NOT NULL,
  `categoryId` int(10) UNSIGNED NOT NULL,
  `shopId` int(10) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `positions`
--

INSERT INTO `positions` (`userId`, `categoryId`, `shopId`, `position`) VALUES
(1, 5, 1, 15),
(1, 5, 9, 11),
(1, 6, 1, 14),
(1, 6, 9, 10),
(1, 7, 9, 12),
(1, 9, 9, 15),
(1, 10, 9, 14),
(1, 13, 1, 1),
(1, 13, 9, 1),
(1, 14, 9, 3),
(1, 19, 9, 9),
(1, 28, 1, 16),
(1, 28, 9, 13),
(1, 34, 1, 12),
(1, 37, 1, 11),
(1, 39, 1, 10),
(1, 45, 1, 13),
(1, 48, 1, 2),
(1, 49, 1, 3),
(1, 49, 9, 2),
(1, 51, 1, 4),
(1, 51, 9, 4),
(1, 52, 1, 5),
(1, 52, 9, 5),
(1, 56, 1, 6),
(1, 63, 1, 8),
(1, 63, 9, 6),
(1, 64, 1, 9),
(1, 64, 9, 7),
(1, 66, 1, 7),
(1, 66, 9, 8),
(1, 999, 1, 1),
(1, 999, 9, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`id`, `name`) VALUES
(1, 'Banane'),
(2, 'Eimer'),
(3, 'Milch'),
(4, 'Mehl'),
(5, 'Zucker'),
(6, 'Brot'),
(7, 'Birne'),
(9, 'Schaufel'),
(11, 'Chips'),
(14, 'Apfel'),
(15, 'Erdbeere'),
(17, ''),
(18, 'Haselnüsse'),
(19, 'Taschentücher'),
(20, 'Orange'),
(21, 'Mandarine'),
(22, 'Küchentücher'),
(24, 'Ananas'),
(25, 'Mandeln'),
(26, 'Backpulver'),
(27, 'Duschgel'),
(28, 'Trauben'),
(29, 'Vanillezucker'),
(30, 'Sellerie'),
(31, 'Bananenbrot'),
(34, 'Wirsingkohlrouladen'),
(35, 'bllaaa'),
(36, 'Kartofeln'),
(37, 'Hack'),
(38, 'Salat'),
(39, 'Eier'),
(42, 'Eiscreme'),
(43, 'Krombacher'),
(44, 'Becks'),
(45, 'hundefutter'),
(46, 'öttinger'),
(47, 'pizza'),
(48, 'bbq soße'),
(50, 'Test'),
(52, 'Brötchen'),
(53, 'Schnitzel'),
(54, 'Nudeln'),
(55, 'Cola'),
(56, 'Fanta'),
(57, 'Briefmarken'),
(58, 'Bier'),
(59, 'Paprika'),
(60, 'Küchenpapier'),
(61, 'Katzenfutter'),
(62, 'Nasenspray'),
(63, 'Wasser'),
(64, 'Mineralwasser');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shops`
--

CREATE TABLE `shops` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `shops`
--

INSERT INTO `shops` (`id`, `name`) VALUES
(1, 'Rewe'),
(9, 'Edeka');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `selectedShop` int(10) UNSIGNED DEFAULT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `selectedShop`, `mail`) VALUES
(1, 'test', 'test', 1, 'test@te.st');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `positions`
--
ALTER TABLE `positions`
  ADD UNIQUE KEY `userId` (`userId`,`categoryId`,`shopId`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT für Tabelle `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
