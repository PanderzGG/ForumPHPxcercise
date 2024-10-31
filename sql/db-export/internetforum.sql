-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 31. Okt 2024 um 15:08
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `internetforum`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `autor`
--

CREATE TABLE `autor` (
  `id` int(11) NOT NULL,
  `vorname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `autor`
--

INSERT INTO `autor` (`id`, `vorname`) VALUES
(1, 'Peter'),
(2, 'Clark'),
(3, 'Tony');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `beitrag`
--

CREATE TABLE `beitrag` (
  `id` int(11) NOT NULL,
  `autorid` int(11) NOT NULL,
  `datum` datetime DEFAULT current_timestamp(),
  `inhalt` text NOT NULL,
  `parentid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `beitrag`
--

INSERT INTO `beitrag` (`id`, `autorid`, `datum`, `inhalt`, `parentid`) VALUES
(1, 1, '2024-10-28 10:15:00', 'Was haltet ihr von den neuesten Änderungen in Tarkov?', NULL),
(2, 2, '2024-10-28 11:00:00', 'Die neuen Waffenbalance-Änderungen sind interessant!', NULL),
(3, 3, '2024-10-29 09:30:00', 'Ich finde die neuen Maps super. Hat jemand Erfahrungen mit Reserve gemacht?', NULL),
(4, 1, '2024-10-29 12:45:00', 'Reserve ist wirklich spannend, vor allem die neuen Loot-Spots.', 3),
(5, 2, '2024-10-30 14:20:00', 'Welche Ausrüstung benutzt ihr für die Raids auf Customs?', NULL),
(6, 1, '2024-10-30 15:10:00', 'Ich bevorzuge eine leicht gepanzerte Ausrüstung, um schneller zu sein.', 5),
(7, 3, '2024-10-31 16:00:00', 'Habt ihr die neuen Quests für den Händler gesehen?', NULL),
(8, 2, '2024-10-31 16:30:00', 'Ja, ich habe die ersten Quests abgeschlossen. Die Belohnungen sind klasse!', 7),
(9, 1, '2024-10-31 17:00:00', 'Ich finde die Quests von Jaeger besonders herausfordernd.', 7),
(10, 2, '2024-11-01 09:15:00', 'Was haltet ihr von der neuen Anti-Cheat-Maßnahme?', NULL),
(11, 1, '2024-11-01 10:00:00', 'Ich hoffe, dass sie das Spiel fairer machen wird.', 10),
(12, 3, '2024-11-01 11:45:00', 'Die Anti-Cheat-Maßnahmen sind dringend notwendig, aber ich hoffe, dass sie das Gameplay nicht beeinträchtigen.', 10),
(13, 2, '2024-11-02 08:30:00', 'Ich bin gespannt, ob wir bald neue Karten bekommen.', NULL),
(14, 1, '2024-11-02 09:00:00', 'Neue Karten wären großartig! Ich liebe die Abwechslung im Gameplay.', 13),
(15, 3, '2024-11-02 10:15:00', 'Hoffentlich kommen sie bald mit neuen Inhalten.', NULL),
(16, 1, '2024-11-02 11:00:00', 'Ich würde mir eine größere Auswahl an Waffen wünschen.', 15),
(17, 2, '2024-11-03 09:20:00', 'Die Waffenvielfalt macht das Spiel wirklich spannend.', NULL),
(18, 1, '2024-11-03 10:05:00', 'Was haltet ihr von den neuen Grenzwerten für die Raids?', NULL),
(19, 3, '2024-11-03 11:50:00', 'Ich finde, sie sind gerechtfertigt und verbessern das Balancing.', 18),
(20, 2, '2024-11-04 14:30:00', 'Die neuen Skills sind auch interessant. Was denkt ihr darüber?', NULL),
(21, 1, '2024-11-04 15:15:00', 'Ich mag die neuen Skills, aber sie sind zu grindy.', 20),
(22, 3, '2024-11-05 09:40:00', 'Ich habe gehört, dass einige Skills broken sind.', NULL),
(23, 2, '2024-11-05 10:20:00', 'Ja, das stimmt. Hoffentlich wird das bald gepatcht.', 22),
(24, 1, '2024-11-06 08:00:00', 'Gibt es einen Trick, um schneller Erfahrung zu sammeln?', NULL),
(25, 3, '2024-11-06 09:45:00', 'Fokussiert euch auf Quests. Sie geben die meiste XP.', 24),
(26, 2, '2024-11-06 10:30:00', 'Ich mache immer die täglichen Quests.', 25),
(27, 1, '2024-11-07 12:00:00', 'Ich finde, dass einige Maps unfair sind. Was denkt ihr?', NULL),
(28, 3, '2024-11-07 13:15:00', 'Ja, besonders Interchange kann frustrierend sein.', 27),
(29, 2, '2024-11-08 11:00:00', 'Ich bevorzuge Woods. Es ist strategischer.', NULL),
(30, 1, '2024-11-08 12:30:00', 'Woods hat eine gute Mischung aus PvP und PvE.', 29),
(31, 3, '2024-11-09 14:00:00', 'Wer hat die besten Taktiken für den Raid?', NULL),
(32, 1, '2024-11-09 14:45:00', 'Ich finde, dass Teamplay der Schlüssel zum Erfolg ist.', 31),
(33, 2, '2024-11-09 15:30:00', 'Auf jeden Fall. Kommunikation ist das A und O.', 32),
(34, 1, '2024-11-10 09:00:00', 'Wie geht ihr mit Cheatern um?', NULL),
(35, 3, '2024-11-10 09:30:00', 'Ich reportiere sie immer sofort.', 34),
(36, 2, '2024-11-10 10:00:00', 'Ich ignoriere sie meistens, um nicht frustriert zu werden.', 35),
(37, 1, '2024-11-11 12:15:00', 'Was haltet ihr von der neuen Waffenschmiede?', NULL),
(38, 3, '2024-11-11 13:00:00', 'Die Waffenschmiede ist ein tolles Feature! Ich liebe es.', 37),
(39, 2, '2024-11-12 11:00:00', 'Hat jemand die neue M4A1 ausprobiert?', NULL),
(40, 1, '2024-11-12 12:30:00', 'Ja, sie ist sehr vielseitig und stark.', 39),
(41, 3, '2024-11-13 09:00:00', 'Ich hoffe, sie fügen bald mehr Mods hinzu.', NULL),
(42, 2, '2024-11-13 10:15:00', 'Ich vermisse die alten Mods. Sie waren besser.', 41),
(43, 1, '2024-11-14 09:30:00', 'Was denkt ihr über die neuen Änderungen an den Raids?', NULL),
(44, 3, '2024-11-14 10:45:00', 'Sie sind nötig, aber einige Veränderungen sind fraglich.', 43),
(45, 2, '2024-11-15 11:00:00', 'Ich habe Schwierigkeiten, meine Ausrüstung zu bekommen.', NULL),
(46, 1, '2024-11-15 12:15:00', 'Das ist frustrierend. Ich habe auch Probleme, gute Waffen zu finden.', 45),
(47, 3, '2024-11-16 09:30:00', 'Wie geht ihr mit den neuen Raids um?', NULL),
(48, 2, '2024-11-16 10:15:00', 'Ich versuche, vorsichtiger zu sein und nicht zu aggressiv zu spielen.', 47),
(49, 1, '2024-11-17 11:00:00', 'Das Spiel macht so viel Spaß, besonders wenn man mit Freunden spielt.', NULL),
(50, 3, '2024-11-17 12:30:00', 'Absolut! Teamwork ist der Schlüssel zum Überleben.', 49),
(51, 1, '2024-10-31 15:07:44', 'Ganz gut :)', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `beitrag`
--
ALTER TABLE `beitrag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentid` (`parentid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `beitrag`
--
ALTER TABLE `beitrag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `beitrag`
--
ALTER TABLE `beitrag`
  ADD CONSTRAINT `beitrag_ibfk_1` FOREIGN KEY (`parentid`) REFERENCES `beitrag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
