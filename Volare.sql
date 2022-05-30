-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 25, 2022 alle 11:01
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Volare`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `airports`
--

CREATE TABLE `airports` (
  `cities` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `airports`
--

INSERT INTO `airports` (`cities`) VALUES
('Bari'),
('Bologna'),
('Firenze'),
('Milano'),
('Napoli'),
('Palermo'),
('Roma'),
('Torino '),
('Venezia');

-- --------------------------------------------------------

--
-- Struttura della tabella `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `clientId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `departure` varchar(20) NOT NULL,
  `depTime` time NOT NULL,
  `destTime` time NOT NULL,
  `destination` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 49.90
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `flights`
--

INSERT INTO `flights` (`id`, `departure`, `depTime`, `destTime`, `destination`, `price`) VALUES
(101, 'Milano', '08:00:00', '09:30:00', 'Napoli', '49.90'),
(102, 'Napoli', '11:00:00', '12:30:00', 'Milano', '49.90'),
(103, 'Milano', '14:00:00', '15:35:00', 'Napoli', '49.90'),
(104, 'Napoli', '18:00:00', '19:30:00', 'Milano', '49.90'),
(201, 'Torino ', '08:30:00', '10:10:00', 'Palermo', '49.90'),
(202, 'Palermo', '13:30:00', '14:55:00', 'Torino ', '49.90'),
(203, 'Torino ', '16:15:00', '17:48:00', 'Palermo', '49.90'),
(204, 'Palermo', '19:00:00', '20:30:00', 'Torino ', '49.90'),
(301, 'Venezia', '09:00:00', '10:45:00', 'Palermo', '49.90'),
(302, 'Palermo', '12:00:00', '13:30:00', 'Venezia', '49.90'),
(303, 'Venezia', '15:00:00', '16:40:00', 'Palermo', '49.90'),
(304, 'Palermo', '18:00:00', '19:30:00', 'Venezia', '49.90'),
(401, 'Bologna', '07:12:00', '08:30:00', 'Bari', '49.90'),
(402, 'Bari', '10:00:00', '11:20:00', 'Bologna', '49.90'),
(403, 'Bologna', '14:00:00', '15:15:00', 'Bari', '49.90'),
(404, 'Bari', '17:15:00', '18:30:00', 'Bologna', '49.90'),
(501, 'Firenze', '10:03:00', '11:21:00', 'Palermo', '49.90'),
(502, 'Palermo', '13:00:00', '14:15:00', 'Firenze', '49.90'),
(503, 'Firenze', '16:00:00', '17:20:00', 'Palermo', '49.90'),
(504, 'Palermo', '19:00:00', '20:20:00', 'Firenze', '49.90'),
(601, 'Firenze', '09:40:00', '10:30:00', 'Bari', '49.90'),
(602, 'Bari', '12:00:00', '12:50:00', 'Firenze', '49.90'),
(603, 'Firenze', '15:00:00', '15:55:00', 'Bari', '49.90'),
(604, 'Bari', '18:00:00', '19:00:00', 'Firenze', '49.90'),
(701, 'Venezia', '12:20:00', '13:55:00', 'Napoli', '49.90'),
(702, 'Napoli', '16:00:00', '17:35:00', 'Venezia', '49.90'),
(703, 'Venezia', '19:00:00', '20:30:00', 'Napoli', '49.90'),
(704, 'Napoli', '22:00:00', '23:30:00', 'Venezia', '49.90'),
(801, 'Torino ', '11:13:00', '12:46:00', 'Napoli', '49.90'),
(802, 'Napoli', '14:00:00', '15:30:00', 'Torino ', '49.90'),
(803, 'Torino ', '18:15:00', '19:45:00', 'Napoli', '49.90'),
(804, 'Napoli', '22:00:00', '23:30:00', 'Torino ', '49.90'),
(901, 'Bologna', '13:47:00', '14:50:00', 'Napoli', '49.90'),
(902, 'Napoli', '17:00:00', '18:00:00', 'Bologna', '49.90'),
(903, 'Bologna', '20:00:00', '21:00:00', 'Napoli', '49.90'),
(904, 'Napoli', '22:30:00', '23:30:00', 'Bologna', '49.90'),
(1001, 'Roma', '07:54:00', '09:00:00', 'Milano', '49.90'),
(1002, 'Milano', '10:00:00', '11:00:00', 'Roma', '49.90'),
(1003, 'Roma', '13:00:00', '14:00:00', 'Milano', '49.90'),
(1004, 'Milano', '15:00:00', '16:00:00', 'Roma', '49.90'),
(2001, 'Roma', '09:21:00', '10:20:00', 'Torino ', '49.90'),
(2002, 'Torino ', '12:10:00', '13:15:00', 'Roma', '49.90'),
(2003, 'Roma', '15:20:00', '16:20:00', 'Torino ', '49.90'),
(2004, 'Torino ', '18:00:00', '19:05:00', 'Roma', '49.90'),
(3001, 'Roma', '07:30:00', '08:35:00', 'Venezia', '49.90'),
(3002, 'Venezia', '10:00:00', '11:10:00', 'Roma', '49.90'),
(3003, 'Roma', '15:00:00', '16:05:00', 'Venezia', '49.90'),
(3004, 'Venezia', '19:00:00', '20:05:00', 'Roma', '49.90'),
(4001, 'Roma', '10:20:00', '11:15:00', 'Palermo', '49.90'),
(4002, 'Palermo', '13:20:00', '14:15:00', 'Roma', '49.90'),
(4003, 'Roma', '17:10:00', '18:05:00', 'Palermo', '49.90'),
(4004, 'Palermo', '20:00:00', '21:05:00', 'Roma', '49.90'),
(5001, 'Roma', '11:00:00', '11:50:00', 'Bari', '49.90'),
(5002, 'Bari', '13:30:00', '14:20:00', 'Roma', '49.90'),
(5003, 'Roma', '15:45:00', '16:40:00', 'Bari', '49.90'),
(5004, 'Bari', '18:10:00', '19:05:00', 'Roma', '49.90'),
(6001, 'Milano', '07:00:00', '08:25:00', 'Bari', '49.90'),
(6002, 'Bari', '11:00:00', '12:30:00', 'Milano', '49.90'),
(6003, 'Milano', '16:00:00', '17:35:00', 'Bari', '49.90'),
(6004, 'Bari', '19:40:00', '21:10:00', 'Milano', '49.90'),
(7001, 'Milano', '09:00:00', '10:45:00', 'Palermo', '49.90'),
(7002, 'Palermo', '12:10:00', '13:55:00', 'Milano', '49.90'),
(7003, 'Milano', '17:30:00', '19:15:00', 'Palermo', '49.90'),
(7004, 'Palermo', '22:00:00', '23:45:00', 'Milano', '49.90');

-- --------------------------------------------------------

--
-- Struttura della tabella `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `flightId` int(11) NOT NULL,
  `passengers` int(11) NOT NULL,
  `flightDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `userTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `userTypeId`) VALUES
(1, 'admin@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1),
(2, 'regular@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Regular');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`cities`);

--
-- Indici per le tabelle `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partenza` (`departure`),
  ADD KEY `arrivo` (`destination`);

--
-- Indici per le tabelle `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cartId`),
  ADD KEY `flight_id` (`flightId`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_type_id` (`userTypeId`);

--
-- Indici per le tabelle `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT per la tabella `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`departure`) REFERENCES `airports` (`cities`),
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`destination`) REFERENCES `airports` (`cities`);

--
-- Limiti per la tabella `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`flightId`) REFERENCES `flights` (`id`);

--
-- Limiti per la tabella `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userTypeId`) REFERENCES `user_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
