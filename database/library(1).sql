-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: ian. 08, 2026 la 09:30 PM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `library`
--

-- --------------------------------------------------------

--

--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `books` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `age`, `books`) VALUES
(1, 'Judy', 'Blume', 87, 'Are You There God? It\'s Me, Margaret, Blubber, Tiger Eyes'),
(2, 'Stephen', 'King', 78, 'The Shining, It, Carrie, Misery'),
(3, 'Agatha', 'Christie', 86, 'Murder on the Orient Express, Death on the Nile'),
(4, 'Danielle', 'Steel', 78, 'The Promise, Kaleidoscope, Malice, Jewels'),
(5, 'Cathy', 'Hopkins', 72, 'Mates, Dates, Truth or Dare, Zodiac Girl'),
(6, 'Margaret', 'Atwood', 86, 'Alias Grace, The Blind Assassin'),
(7, 'Rosemary', 'Hayes', 82, 'Shadow Seekers, Seal Cry, Jumble Power'),
(8, 'Toni', 'Morrison', 88, 'The Bluest Eye, Song of Solomon, Paradise'),
(9, 'Haruki', 'Murakami', 77, 'Norwegian Wood, Kafka on the Shore, 1Q84'),
(10, 'Elena', 'Ferrante', 45, 'My Brilliant Friend, The Story of a New Name, Those Who Leave');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `publication_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--


INSERT INTO `books` (`id`, `title`, `author`, `publisher`, `publication_year`) VALUES
(1, 'Are You There God? It\'s Me, Margaret', 'Judy Blume', 'Penguin Books', 1970),
(2, 'Blubber', 'Judy Blume', 'Penguin Books', 1974),
(3, 'Tiger Eyes', 'Judy Blume', 'Penguin Books', 1981),
(4, 'The Shining', 'Stephen King', 'Penguin Books', 1977),
(5, 'It', 'Stephen King', 'HarperCollins', 1986),
(6, 'Carrie', 'Stephen King', 'HarperCollins', 1974),
(7, 'Murder on the Orient Express', 'Agatha Christie', 'HarperCollins', 1934),
(8, 'Death on the Nile', 'Agatha Christie', 'HarperCollins', 1937),
(9, 'The Promise', 'Danielle Steel', 'Polirom', 1977),
(10, 'Kaleidoscope', 'Danielle Steel', 'Polirom', 1987);

-- --------------------------------------------------------

--

--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `books` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `publishers` (`id`, `name`, `books`) VALUES
(1, 'Penguin Books', 'Are You There God? It\'s Me, Margaret, The Shining, My Brilliant Friend'),
(2, 'HarperCollins', 'It, Carrie, Murder on the Orient Express'),
(3, 'Random House', 'The Blind Assassin, Alias Grace'),
(4, 'Vintage', 'Song of Solomon, The Bluest Eye, Paradise'),
(5, 'Oxford University Press', 'Mates, Dates, Truth or Dare'),
(6, 'Tor Books', '1Q84, Norwegian Wood'),
(7, 'Humanitas', 'Shadow Seekers, Seal Cry, Jumble Power'),
(8, 'Polirom', 'The Promise, Kaleidoscope, Malice, Jewels'),
(9, 'Litera', 'Franturi din el, Sclava Iubirii'),
(10, 'Epica', 'Twisted Love, Cum sa predai?');


--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pentru tabele `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pentru tabele `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
