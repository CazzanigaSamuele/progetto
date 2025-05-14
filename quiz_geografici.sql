-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 14, 2025 alle 07:46
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_geografici`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `punteggi`
--

CREATE TABLE `punteggi` (
  `id` int(11) NOT NULL,
  `utente_id` int(11) NOT NULL,
  `punteggio` int(11) NOT NULL,
  `data` datetime DEFAULT current_timestamp(),
  `tipologia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `punteggi`
--

INSERT INTO `punteggi` (`id`, `utente_id`, `punteggio`, `data`, `tipologia`) VALUES
(5, 3, 0, '2025-05-04 13:32:19', 'bandiere'),
(22, 3, 1, '2025-05-13 17:42:11', 'popolazioni'),
(23, 3, 1, '2025-05-13 17:43:35', 'popolazioni'),
(24, 3, 4, '2025-05-13 17:43:51', 'popolazioni'),
(25, 3, 2, '2025-05-13 17:44:13', 'popolazioni'),
(26, 3, 0, '2025-05-13 18:05:10', 'bandiere'),
(27, 3, 3, '2025-05-13 18:05:46', 'bandiere'),
(28, 3, 0, '2025-05-13 18:37:24', 'bandiere'),
(29, 3, 2, '2025-05-13 18:38:36', 'bandiere'),
(30, 3, 2, '2025-05-13 18:38:51', 'popolazioni'),
(31, 3, 0, '2025-05-13 18:38:56', 'popolazioni'),
(32, 3, 0, '2025-05-13 18:46:10', 'popolazioni'),
(33, 3, 2, '2025-05-13 18:46:56', 'popolazioni'),
(34, 3, 0, '2025-05-13 18:53:26', 'bandiere'),
(35, 8, 0, '2025-05-13 19:40:19', 'popolazioni'),
(36, 8, 7, '2025-05-13 19:40:51', 'popolazioni');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`) VALUES
(3, 'cazzaniga_samuele', '01b9622ff3ce2d88484089505fa99a63'),
(6, 'ciao', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, 'balotelli', 'c134d16f2239ef3684caaa255202d094'),
(8, 'ciaoo', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `punteggi`
--
ALTER TABLE `punteggi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_id` (`utente_id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `punteggi`
--
ALTER TABLE `punteggi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `punteggi`
--
ALTER TABLE `punteggi`
  ADD CONSTRAINT `punteggi_ibfk_1` FOREIGN KEY (`utente_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
