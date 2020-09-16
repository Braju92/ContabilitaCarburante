-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 16, 2020 alle 16:59
-- Versione del server: 10.4.13-MariaDB
-- Versione PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contabilita`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `additivirifornimento`
--

CREATE TABLE `additivirifornimento` (
  `IDRifornimento` int(10) UNSIGNED NOT NULL,
  `TipoAdditivi` char(16) COLLATE utf8_bin NOT NULL,
  `LitriAdditivi` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `cedole`
--

CREATE TABLE `cedole` (
  `IDCedola` int(10) UNSIGNED NOT NULL,
  `TipoCedola` int(11) NOT NULL,
  `ImportoRimanente` decimal(5,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `cedole`
--

INSERT INTO `cedole` (`IDCedola`, `TipoCedola`, `ImportoRimanente`) VALUES
(1001, 1, '50.00'),
(1002, 1, '50.00'),
(1003, 1, '50.00'),
(1004, 1, '50.00'),
(1005, 1, '50.00'),
(1006, 1, '50.00'),
(1007, 1, '50.00'),
(1008, 1, '50.00'),
(1009, 1, '50.00'),
(1010, 1, '50.00'),
(1011, 1, '50.00'),
(1012, 1, '50.00'),
(1013, 1, '50.00'),
(1014, 1, '50.00'),
(1015, 1, '5.00'),
(1016, 1, '45.00'),
(1017, 1, '50.00'),
(1018, 1, '50.00'),
(1019, 1, '50.00'),
(1020, 1, '50.00'),
(1021, 1, '50.00'),
(1022, 1, '50.00'),
(1023, 1, '50.00'),
(1024, 1, '50.00'),
(1025, 1, '50.00'),
(1026, 1, '50.00'),
(1027, 1, '50.00'),
(1028, 1, '50.00'),
(1029, 1, '50.00'),
(1030, 1, '50.00'),
(1031, 1, '50.00'),
(1032, 1, '50.00'),
(1033, 1, '50.00'),
(1034, 1, '50.00'),
(1035, 1, '50.00'),
(1036, 1, '50.00'),
(1037, 1, '50.00'),
(1038, 1, '50.00'),
(1039, 1, '50.00'),
(1040, 1, '50.00'),
(1041, 1, '50.00'),
(1042, 1, '50.00'),
(1043, 1, '50.00'),
(1044, 1, '50.00'),
(1045, 1, '50.00'),
(1046, 1, '50.00'),
(1047, 1, '50.00'),
(1048, 1, '50.00'),
(1049, 1, '50.00'),
(1050, 1, '50.00');

-- --------------------------------------------------------

--
-- Struttura della tabella `consumirifornimento`
--

CREATE TABLE `consumirifornimento` (
  `Data` date NOT NULL,
  `Targa` char(5) COLLATE utf8_bin NOT NULL,
  `KmAttuali` mediumint(9) NOT NULL,
  `Step` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `consumirifornimento`
--

INSERT INTO `consumirifornimento` (`Data`, `Targa`, `KmAttuali`, `Step`) VALUES
('2019-12-31', 'AA111', 0, 0),
('2020-01-02', 'AA111', 450, 1),
('2020-01-07', 'AA111', 1000, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `depositocisterna`
--

CREATE TABLE `depositocisterna` (
  `Data` date NOT NULL,
  `LitriBenzinaRimanenti` mediumint(9) UNSIGNED NOT NULL,
  `LitriBenzinaConsumati` mediumint(9) UNSIGNED DEFAULT NULL,
  `LitriBenzinaImmessi` mediumint(9) UNSIGNED DEFAULT NULL,
  `LitriGasolioRimanenti` mediumint(9) UNSIGNED NOT NULL,
  `LitriGasolioConsumati` mediumint(9) UNSIGNED DEFAULT NULL,
  `LitriGasolioImmessi` mediumint(9) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `depositocisterna`
--

INSERT INTO `depositocisterna` (`Data`, `LitriBenzinaRimanenti`, `LitriBenzinaConsumati`, `LitriBenzinaImmessi`, `LitriGasolioRimanenti`, `LitriGasolioConsumati`, `LitriGasolioImmessi`) VALUES
('2020-01-01', 1000, NULL, 1000, 2000, NULL, 2000),
('2020-01-02', 1000, NULL, NULL, 1959, 41, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendenti`
--

CREATE TABLE `dipendenti` (
  `CIP` char(8) COLLATE utf8_bin NOT NULL,
  `Nome` varchar(25) COLLATE utf8_bin NOT NULL,
  `Cognome` varchar(25) COLLATE utf8_bin NOT NULL,
  `Grado` char(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `dipendenti`
--

INSERT INTO `dipendenti` (`CIP`, `Nome`, `Cognome`, `Grado`) VALUES
('NRCGST95', 'Enrico', 'Agostinetto', 'Car');

-- --------------------------------------------------------

--
-- Struttura della tabella `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_bin NOT NULL,
  `queue` text COLLATE utf8_bin NOT NULL,
  `payload` longtext COLLATE utf8_bin NOT NULL,
  `exception` longtext COLLATE utf8_bin NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `listaadditivi`
--

CREATE TABLE `listaadditivi` (
  `CodiceAdditivo` char(16) COLLATE utf8_bin NOT NULL,
  `TipoAdditivo` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `listaadditivi`
--

INSERT INTO `listaadditivi` (`CodiceAdditivo`, `TipoAdditivo`) VALUES
('1234.12.123.1234', 'Olio 2T');

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_bin NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `parco`
--

CREATE TABLE `parco` (
  `Targa` char(5) COLLATE utf8_bin NOT NULL,
  `Reparto` varchar(50) COLLATE utf8_bin NOT NULL,
  `Tipo` varchar(25) COLLATE utf8_bin NOT NULL,
  `Alimentazione` char(1) COLLATE utf8_bin NOT NULL,
  `Consumo100Km` decimal(4,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `parco`
--

INSERT INTO `parco` (`Targa`, `Reparto`, `Tipo`, `Alimentazione`, `Consumo100Km`) VALUES
('AA111', 'Compagnia di Portomaggiore', 'Fiat Multipla', 'G', '4.150');

-- --------------------------------------------------------

--
-- Struttura della tabella `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `token` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `rifornimenti`
--

CREATE TABLE `rifornimenti` (
  `IDRifornimento` int(10) UNSIGNED NOT NULL,
  `Targa` char(5) COLLATE utf8_bin NOT NULL,
  `RifornimentoLitri` decimal(5,2) UNSIGNED NOT NULL,
  `Conduttore` char(8) COLLATE utf8_bin NOT NULL,
  `Data` date NOT NULL,
  `EuroLitro` decimal(4,3) UNSIGNED DEFAULT NULL,
  `Cisterna` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `rifornimenti`
--

INSERT INTO `rifornimenti` (`IDRifornimento`, `Targa`, `RifornimentoLitri`, `Conduttore`, `Data`, `EuroLitro`, `Cisterna`) VALUES
(1, 'AA111', '41.00', 'NRCGST95', '2020-01-02', '1.029', 1),
(2, 'AA111', '32.58', 'NRCGST95', '2020-01-07', '1.535', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `tipocedole`
--

CREATE TABLE `tipocedole` (
  `IDGruppo` int(11) NOT NULL,
  `Carburante` char(1) COLLATE utf8_bin NOT NULL,
  `Ente` varchar(25) COLLATE utf8_bin NOT NULL,
  `Prezzo` decimal(4,3) NOT NULL,
  `Numero` smallint(5) UNSIGNED NOT NULL,
  `Taglio` decimal(5,2) NOT NULL,
  `DataAcquisizione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `tipocedole`
--

INSERT INTO `tipocedole` (`IDGruppo`, `Carburante`, `Ente`, `Prezzo`, `Numero`, `Taglio`, `DataAcquisizione`) VALUES
(1, 'G', 'Eni', '1.427', 50, '50.00', '2020-01-01');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Enrico', 'izzet.rakdos@gmail.com', NULL, '$2y$10$aex9uwo4IPpn0kugxkiuzOYcUD1jrvhC3OPDCaYQUel.l2gKpLaNu', NULL, '2020-08-19 17:00:26', '2020-08-19 17:00:26'),
(2, 'mail', 'mailacaso@mail.com', NULL, '$2y$10$Wx.obejVUp3GsVymu2jMROeI4kUFQynr5N3WCWAS9AE/.WCwzgiJi', NULL, '2020-08-19 17:15:56', '2020-08-19 17:15:56');

-- --------------------------------------------------------

--
-- Struttura della tabella `utilizzocedola`
--

CREATE TABLE `utilizzocedola` (
  `IDRifornimento` int(10) UNSIGNED NOT NULL,
  `IDCedola` int(10) UNSIGNED NOT NULL,
  `Consumo` decimal(5,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `utilizzocedola`
--

INSERT INTO `utilizzocedola` (`IDRifornimento`, `IDCedola`, `Consumo`) VALUES
(2, 1015, '45.00'),
(2, 1016, '5.00');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `additivirifornimento`
--
ALTER TABLE `additivirifornimento`
  ADD PRIMARY KEY (`IDRifornimento`,`TipoAdditivi`),
  ADD KEY `ARAdditivo` (`TipoAdditivi`);

--
-- Indici per le tabelle `cedole`
--
ALTER TABLE `cedole`
  ADD PRIMARY KEY (`IDCedola`),
  ADD KEY `CCedola` (`TipoCedola`);

--
-- Indici per le tabelle `consumirifornimento`
--
ALTER TABLE `consumirifornimento`
  ADD PRIMARY KEY (`Data`,`Targa`),
  ADD KEY `CRTarga` (`Targa`);

--
-- Indici per le tabelle `depositocisterna`
--
ALTER TABLE `depositocisterna`
  ADD PRIMARY KEY (`Data`);

--
-- Indici per le tabelle `dipendenti`
--
ALTER TABLE `dipendenti`
  ADD PRIMARY KEY (`CIP`);

--
-- Indici per le tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `listaadditivi`
--
ALTER TABLE `listaadditivi`
  ADD PRIMARY KEY (`CodiceAdditivo`),
  ADD UNIQUE KEY `TipoAdditivo` (`TipoAdditivo`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `parco`
--
ALTER TABLE `parco`
  ADD PRIMARY KEY (`Targa`);

--
-- Indici per le tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indici per le tabelle `rifornimenti`
--
ALTER TABLE `rifornimenti`
  ADD PRIMARY KEY (`IDRifornimento`),
  ADD KEY `RTarga` (`Targa`),
  ADD KEY `RConduttore` (`Conduttore`);

--
-- Indici per le tabelle `tipocedole`
--
ALTER TABLE `tipocedole`
  ADD PRIMARY KEY (`IDGruppo`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indici per le tabelle `utilizzocedola`
--
ALTER TABLE `utilizzocedola`
  ADD PRIMARY KEY (`IDRifornimento`,`IDCedola`),
  ADD KEY `UCCedole` (`IDCedola`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `additivirifornimento`
--
ALTER TABLE `additivirifornimento`
  ADD CONSTRAINT `ARAdditivo` FOREIGN KEY (`TipoAdditivi`) REFERENCES `listaadditivi` (`CodiceAdditivo`),
  ADD CONSTRAINT `ARRifornimento` FOREIGN KEY (`IDRifornimento`) REFERENCES `rifornimenti` (`IDRifornimento`);

--
-- Limiti per la tabella `cedole`
--
ALTER TABLE `cedole`
  ADD CONSTRAINT `CCedola` FOREIGN KEY (`TipoCedola`) REFERENCES `tipocedole` (`IDGruppo`);

--
-- Limiti per la tabella `consumirifornimento`
--
ALTER TABLE `consumirifornimento`
  ADD CONSTRAINT `CRTarga` FOREIGN KEY (`Targa`) REFERENCES `parco` (`Targa`);

--
-- Limiti per la tabella `rifornimenti`
--
ALTER TABLE `rifornimenti`
  ADD CONSTRAINT `RConduttore` FOREIGN KEY (`Conduttore`) REFERENCES `dipendenti` (`CIP`),
  ADD CONSTRAINT `RTarga` FOREIGN KEY (`Targa`) REFERENCES `parco` (`Targa`);

--
-- Limiti per la tabella `utilizzocedola`
--
ALTER TABLE `utilizzocedola`
  ADD CONSTRAINT `UCCedole` FOREIGN KEY (`IDCedola`) REFERENCES `cedole` (`IDCedola`),
  ADD CONSTRAINT `UCRifornimento` FOREIGN KEY (`IDRifornimento`) REFERENCES `rifornimenti` (`IDRifornimento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
