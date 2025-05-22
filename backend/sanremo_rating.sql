-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 22, 2025 alle 15:53
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sanremo_rating`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `artisti`
--

CREATE TABLE `artisti` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `artisti`
--

INSERT INTO `artisti` (`id`, `nome`) VALUES
(1, 'Achille Lauro'),
(110, 'Achille Lauro con Harlem Gospel Choir'),
(87, 'Aiello'),
(109, 'AKA 7even'),
(150, 'Alessandra Amoroso'),
(151, 'Alfa'),
(119, 'Ana Mena'),
(145, 'Angelina Mango'),
(141, 'Anna Oxa'),
(93, 'Annalisa'),
(130, 'Ariete'),
(83, 'Arisa'),
(132, 'Articolo 31'),
(160, 'Big Mama'),
(166, 'Bnkr44'),
(168, 'Bresh'),
(169, 'Brunori Sas'),
(94, 'Bugo'),
(162, 'Clara'),
(92, 'Colapesce e Dimartino'),
(136, 'Colla Zio'),
(75, 'Coma_Cose'),
(137, 'Cugini di campagna'),
(105, 'dargen Damico'),
(154, 'Diodato'),
(111, 'Ditonellapiaga e Rettore'),
(100, 'Elisa'),
(127, 'Elodie'),
(103, 'Emma'),
(81, 'Ermal Meta'),
(96, 'Extraliscio feat. Davide Toffolo'),
(108, 'Fabrizio Moro'),
(82, 'Fasma'),
(180, 'Fedez'),
(155, 'Fiorella Mannoia'),
(170, 'Francesco Gabbani'),
(74, 'Francesco Renga'),
(167, 'Fred De Palma'),
(97, 'Fulminacci'),
(76, 'Gaia'),
(152, 'Gazzelle'),
(146, 'Geolier'),
(147, 'Ghali'),
(98, 'Ghemon'),
(129, 'Gianluca Grignani'),
(138, 'Gianmaria'),
(101, 'Gianni Morandi'),
(84, 'Gio Evan'),
(125, 'Giorgia'),
(114, 'Giovanni Truppi'),
(118, 'Giusy Ferreri'),
(115, 'Highsnob e Hu'),
(153, 'Il Tre'),
(149, 'Il Volo'),
(77, 'Irama'),
(113, 'Iva Zanicchi'),
(171, 'Joan Thiele'),
(89, 'La rappresentante di Lista'),
(165, 'La Sad'),
(122, 'Lazza'),
(131, 'LDA'),
(117, 'Le vibrazioni'),
(134, 'Leo Gassmann'),
(139, 'Levante'),
(95, 'Lo Stato Sociale'),
(148, 'Loredana Bertè'),
(172, 'Lucio Corsi'),
(78, 'Madame'),
(99, 'Mahmood e Blanco'),
(86, 'Malika Ayane'),
(85, 'Maneskin'),
(164, 'Mannini'),
(135, 'Mara Sattei'),
(173, 'Marcella Bella'),
(121, 'Marco Mengoni'),
(104, 'Massimo Ranieri'),
(107, 'Matteo Romano'),
(88, 'Max Gazzè'),
(106, 'Michele Bravi'),
(128, 'Modà'),
(123, 'Mr.Rain'),
(158, 'Negramaro'),
(90, 'Noemi'),
(140, 'Olly'),
(80, 'Orietta Berti'),
(133, 'Paola & Chiara'),
(91, 'Random'),
(163, 'Renga e Nek'),
(159, 'Ricchi e Poveri'),
(112, 'Rkomi'),
(174, 'Rocco Hunt'),
(126, 'Rosa Chemical'),
(161, 'Rose Villain'),
(102, 'Sangiovanni'),
(157, 'Santi Francesi'),
(175, 'Sarah Toscano'),
(176, 'Serena Brancale'),
(144, 'Sethu'),
(177, 'Shablo con Guè, Joshua e Tormento'),
(143, 'Shari'),
(178, 'Simone Cristicchi'),
(120, 'Tananai'),
(156, 'The Kolors'),
(179, 'Tony effe'),
(124, 'Ultimo'),
(142, 'Will'),
(79, 'Willie Peyote'),
(116, 'Yuman');

-- --------------------------------------------------------

--
-- Struttura della tabella `canzoni`
--

CREATE TABLE `canzoni` (
  `id` int(11) NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `anno` int(11) NOT NULL,
  `artista_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `canzoni`
--

INSERT INTO `canzoni` (`id`, `titolo`, `anno`, `artista_id`) VALUES
(2, 'Balorda Nostalgia', 2025, 140),
(3, 'Volevo essere un duro', 2025, 172),
(4, 'L\'albero delle noci', 2025, 169),
(5, 'Quando sarai piccola', 2025, 178),
(6, 'La cura per me', 2025, 125),
(7, 'Incoscienti giovani', 2025, 1),
(8, 'Viva la vita', 2025, 170),
(9, 'Lentamente', 2025, 77),
(10, 'Cuoricini', 2025, 75),
(11, 'La tana del granchio', 2025, 168),
(12, 'Dimenticarsi alle 7', 2025, 127),
(13, 'Se t\'innamori', 2025, 90),
(14, 'Tu con chi fai l\'amore', 2025, 156),
(15, 'Mille vote ancora', 2025, 174),
(16, 'Grazie ma no grazie', 2025, 79),
(17, 'Amarcord', 2025, 175),
(18, 'La mia parola', 2025, 177),
(19, 'Fuorilegge', 2025, 161),
(20, 'Eco', 2025, 171),
(21, 'Non ti dimentico', 2025, 128),
(22, 'Tra le mani un cuore', 2025, 104),
(23, 'Anema e core', 2025, 176),
(24, 'Damme \'na mano', 2025, 179),
(25, 'Chiamo io chiami tu', 2025, 76),
(26, 'Febbre', 2025, 162),
(27, 'Il ritmo delle cose', 2025, 112),
(28, 'Pelle diamante', 2025, 173),
(37, 'La noia', 2024, 145),
(38, 'I p\'me, tu p\'te', 2024, 146),
(39, 'Piazza', 2024, 148),
(40, 'Sinceramente', 2024, 93),
(41, 'Casa mia', 2024, 147),
(42, 'Tu no', 2024, 77),
(43, 'Capolavoro', 2024, 149),
(44, 'Fino a qui', 2024, 150),
(45, 'Vai!', 2024, 151),
(46, 'Tutto qui', 2024, 152),
(47, 'Fragili', 2024, 153),
(48, 'Ti muovi', 2024, 154),
(49, 'Apnea', 2024, 103),
(50, 'Mariposa', 2024, 155),
(51, 'Un ragazzo una ragazza', 2024, 156),
(59, 'L\'amore in bocca', 2024, 157),
(60, 'Ricominciamo tutto', 2024, 158),
(61, 'Onda alta', 2024, 105),
(62, 'Ma non tutta la vita', 2024, 159),
(63, 'La rabbia non ti basta', 2024, 160),
(64, 'Click boom!', 2024, 161),
(65, 'Due altalene', 2024, 123),
(66, 'Diamanti grezzi', 2024, 162),
(67, 'Pazzo di te', 2024, 163),
(68, 'Spettacolare', 2024, 164),
(69, 'Autodistruttivo', 2024, 165),
(70, 'Governo punk', 2024, 166),
(71, 'Finiscimi', 2024, 102),
(72, 'Il cielo non ci vuole', 2024, 167),
(73, 'Due vite ', 2023, 121),
(186, 'Cenere', 2023, 122),
(187, 'Supereroi', 2023, 123),
(188, 'Alba', 2023, 124),
(189, 'Tango', 2023, 120),
(190, 'Parole dette male', 2023, 125),
(191, 'Il bene nel male', 2023, 78),
(192, 'Made in Italy', 2023, 126),
(193, 'Due', 2023, 127),
(194, 'Splash', 2023, 92),
(195, 'Lasciami', 2023, 128),
(196, 'Quando ti manca il fiato', 2023, 129),
(197, 'L\'addio', 2023, 75),
(198, 'Mare di guai', 2023, 130),
(199, 'Se poi domani', 2023, 131),
(200, 'Un bel viaggio', 2023, 132),
(201, 'Furore', 2023, 133),
(202, 'Terzo cuore', 2023, 134),
(203, 'Duemilaminuti', 2023, 135),
(204, 'Non mi va', 2023, 136),
(205, 'Lettera 22', 2023, 137),
(206, 'Mostro', 2023, 138),
(207, 'Vivo', 2023, 139),
(208, 'Polvere', 2023, 140),
(209, 'Sali (canto dell\'anima)', 2023, 141),
(210, 'Stupido', 2023, 142),
(211, 'Egoista', 2023, 143),
(212, 'Cause perse', 2023, 144),
(213, 'Brividi', 2022, 99),
(214, 'O forse sei tu', 2022, 100),
(215, 'Apri tutte le porte', 2022, 101),
(216, 'Ovunque sarai', 2022, 77),
(217, 'Farfalle', 2022, 102),
(218, 'Ogni volta è così', 2022, 103),
(219, 'Ciao Ciao', 2022, 89),
(220, 'Lettera di là dal mare', 2022, 104),
(221, 'Dove si balla', 2022, 105),
(222, 'Inverno dei fiori', 2022, 106),
(223, 'Virale', 2022, 107),
(224, 'Sei tu', 2022, 108),
(225, 'Perfetta così', 2022, 109),
(226, 'Domenica', 2022, 110),
(227, 'Ti amo non lo so dire', 2022, 90),
(228, 'Chimica', 2022, 111),
(229, 'Insuperabile', 2022, 112),
(230, 'Voglio amarti', 2022, 113),
(231, 'Tuo padre, mia madre, Lucia', 2022, 114),
(232, 'Abbi cura di te', 2022, 115),
(233, 'Ora e qui', 2022, 116),
(234, 'Tantissimo', 2022, 117),
(235, 'Miele', 2022, 118),
(236, 'Duecentomilaore', 2022, 119),
(237, 'Sesso occasionale', 2022, 120),
(250, 'Zitti e buoni', 2021, 85),
(251, 'Un milione di cose da dirti', 2021, 81),
(252, 'Musica leggerissima', 2021, 92),
(253, 'La genesi del tuo colore', 2021, 77),
(254, 'Mai dire mai', 2021, 79),
(255, 'Dieci', 2021, 93),
(256, 'Voce', 2021, 78),
(257, 'Quando ti sei innamorato', 2021, 80),
(258, 'Potevi fare di più', 2021, 83),
(259, 'Amare', 2021, 89),
(260, 'Bianca luce nera', 2021, 96),
(261, 'Combat pop', 2021, 95),
(262, 'Glicine', 2021, 90),
(263, 'Ti piaci così', 2021, 86),
(264, 'Santa Marinella', 2021, 97),
(265, 'Il farmacista', 2021, 88),
(266, 'Parlami', 2021, 82),
(267, 'Cuore amaro', 2021, 76),
(268, 'Fiamme negli occhi', 2021, 75),
(269, 'Momento perfetto', 2021, 98),
(270, 'Quando trovo te', 2021, 74),
(271, 'Arnica', 2021, 84),
(272, 'E invece sì', 2021, 94),
(273, 'Ora', 2021, 87),
(274, 'Torno a te', 2021, 91),
(275, 'Battito', 2025, 180);

-- --------------------------------------------------------

--
-- Struttura della tabella `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 0 and `rating` <= 5),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `song_id`, `rating`, `created_at`) VALUES
(1, 3, 37, 3, '2025-05-12 11:00:15'),
(2, 3, 73, 2, '2025-05-12 11:00:18'),
(3, 6, 37, 1, '2025-05-12 11:01:14'),
(5, 6, 73, 5, '2025-05-12 11:01:20'),
(6, 6, 2, 2, '2025-05-12 11:01:21'),
(23, 7, 2, 5, '2025-05-19 20:31:26'),
(26, 7, 37, 5, '2025-05-19 20:33:17'),
(27, 7, 4, 5, '2025-05-19 20:33:18'),
(29, 7, 8, 4, '2025-05-19 20:33:22'),
(30, 7, 73, 3, '2025-05-19 20:33:23'),
(31, 7, 6, 4, '2025-05-19 20:33:24'),
(32, 7, 5, 3, '2025-05-19 20:33:25'),
(33, 7, 9, 5, '2025-05-19 20:33:28'),
(34, 7, 11, 2, '2025-05-19 20:33:29'),
(35, 7, 12, 3, '2025-05-19 20:33:30'),
(36, 7, 10, 5, '2025-05-19 20:33:32'),
(52, 8, 8, 4, '2025-05-22 12:26:33'),
(53, 8, 6, 1, '2025-05-22 12:26:34'),
(54, 8, 5, 1, '2025-05-22 12:26:35'),
(55, 8, 9, 2, '2025-05-22 12:26:37'),
(56, 8, 10, 1, '2025-05-22 12:26:38'),
(57, 8, 11, 2, '2025-05-22 12:26:38'),
(58, 8, 12, 1, '2025-05-22 12:26:39'),
(60, 8, 4, 4, '2025-05-22 12:30:03'),
(61, 8, 37, 4, '2025-05-22 12:30:04'),
(62, 8, 2, 4, '2025-05-22 12:30:05');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(3, 'edomaggia', '$2y$10$x1pYSXFXc6k2QZIYapN.D.wWT9O/R9p/dj7OzqEgrnfwRQ2NrreNq', 'edoardomaggiani00@gmail.com', '2025-05-11 17:45:55'),
(4, 'ciao', '$2y$10$PZABPrGx089oAhq6w.q0UOAwK9Q459ASn0KQAHEYU0voGFHbrO7oO', 'ciao@ciao', '2025-05-11 20:02:10'),
(6, 'gardanz', '$2y$10$Ac9D5cW14CQkD5Ulr464qeGw2hQo.jOElgYt/21wWFtOqua7KiUpq', 'gardanz@gas', '2025-05-12 09:01:11'),
(7, 'maggias', '$2y$10$3mKHca.IfGWkmd6et5UqgukINKlc2ekel.l02a2lDMrXcVtrPwAoi', 'isfuari66@gmail.com', '2025-05-19 18:01:28'),
(8, 'gardanz5', '$2y$10$NcrSzqZw.BDe7Y3quIV/DehayEMwi8ng1CuRhl5PUAZIsyRIA.fHC', 'giuseppe.falliti5@gmail.com', '2025-05-22 10:19:28');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `artisti`
--
ALTER TABLE `artisti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indici per le tabelle `canzoni`
--
ALTER TABLE `canzoni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artista_id` (`artista_id`);

--
-- Indici per le tabelle `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_rating` (`user_id`,`song_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `artisti`
--
ALTER TABLE `artisti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT per la tabella `canzoni`
--
ALTER TABLE `canzoni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT per la tabella `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `canzoni`
--
ALTER TABLE `canzoni`
  ADD CONSTRAINT `canzoni_ibfk_1` FOREIGN KEY (`artista_id`) REFERENCES `artisti` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `canzoni` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
