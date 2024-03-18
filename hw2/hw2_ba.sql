-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 02, 2022 alle 20:39
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw2_ba`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `cod_creatore` int(11) NOT NULL,
  `cod_post` int(11) NOT NULL,
  `testo` varchar(200) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `comments`
--
DELIMITER $$
CREATE TRIGGER `commentCounter` AFTER INSERT ON `comments` FOR EACH ROW BEGIN
UPDATE post 
SET no_comments = no_comments + 1
WHERE id = new.cod_post;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `likes_comments`
--

CREATE TABLE `likes_comments` (
  `cod_utente` int(11) NOT NULL,
  `cod_commento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `likes_posts`
--

CREATE TABLE `likes_posts` (
  `cod_utente` int(11) NOT NULL,
  `cod_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `likes_posts`
--
DELIMITER $$
CREATE TRIGGER `likeCounterDOWN` AFTER DELETE ON `likes_posts` FOR EACH ROW BEGIN
UPDATE post
SET no_likes = no_likes - 1
WHERE id = old.cod_post;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `likeCounterUP` AFTER INSERT ON `likes_posts` FOR EACH ROW BEGIN
UPDATE post 
SET no_likes = no_likes + 1
WHERE id = new.cod_post;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `cod_creatore` int(11) NOT NULL,
  `image_link` varchar(255) NOT NULL,
  `anime_id` int(10) UNSIGNED NOT NULL,
  `anime_title` varchar(127) NOT NULL,
  `descr` varchar(600) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `no_likes` mediumint(9) DEFAULT 0,
  `no_comments` mediumint(9) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nascita` date NOT NULL,
  `email` varchar(64) NOT NULL,
  `sesso` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cod_creatore` (`cod_creatore`),
  ADD KEY `i_comments` (`cod_post`);

--
-- Indici per le tabelle `likes_comments`
--
ALTER TABLE `likes_comments`
  ADD PRIMARY KEY (`cod_utente`,`cod_commento`),
  ADD KEY `i_likes_comm` (`cod_commento`,`cod_utente`);

--
-- Indici per le tabelle `likes_posts`
--
ALTER TABLE `likes_posts`
  ADD PRIMARY KEY (`cod_utente`,`cod_post`),
  ADD KEY `cod_post` (`cod_post`),
  ADD KEY `i_likes_post` (`cod_utente`,`cod_post`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cod_creatore` (`cod_creatore`),
  ADD KEY `i_post` (`id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_user` (`username`),
  ADD UNIQUE KEY `UC_email` (`email`),
  ADD KEY `i_user` (`username`),
  ADD KEY `i_email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`cod_creatore`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`cod_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `likes_comments`
--
ALTER TABLE `likes_comments`
  ADD CONSTRAINT `likes_comments_ibfk_1` FOREIGN KEY (`cod_utente`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_comments_ibfk_2` FOREIGN KEY (`cod_commento`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `likes_posts`
--
ALTER TABLE `likes_posts`
  ADD CONSTRAINT `likes_posts_ibfk_1` FOREIGN KEY (`cod_utente`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_posts_ibfk_2` FOREIGN KEY (`cod_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`cod_creatore`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
