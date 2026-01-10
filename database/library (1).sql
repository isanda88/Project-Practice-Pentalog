-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2026 at 10:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `books` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `age`, `books`) VALUES
(1, 'Judy', 'Blume', 87, 'Are You There God? It\'s Me, Margaret; Blubber'),
(2, 'Stephen', 'King', 78, 'The Shining; It'),
(3, 'Agatha', 'Christie', 86, 'Murder on the Orient Express; Death on the Nile'),
(4, 'Danielle', 'Steel', 78, 'The Promise'),
(5, 'Margaret', 'Atwood', 86, 'Alias Grace'),
(6, 'Mircea', 'Eliade', 79, 'Noaptea de sânziene'),
(7, 'Mircea', 'Cărtărescu', 69, 'Solenoid'),
(8, 'George', 'Orwell', 87, 'O mie noua sute optzeci si patru'),
(9, 'Harper', 'Lee', 54, 'To Kill a Mockinbird'),
(10, 'F.Scott', 'Fitzgerald', 65, 'The Great Gatsby'),
(11, 'Jane', 'Austen', 66, 'Pride and Prejudice'),
(12, 'Anne ', 'Frank', 61, 'Jurnalul Annei Frank'),
(13, 'Antoine', 'de Saint-Exupery', 53, 'Micul print'),
(14, 'Toni', 'Morison', 44, 'Beloved'),
(15, 'Jack ', 'Kerouac', 69, 'On The Road'),
(16, 'Andrei', 'Plesu', 64, 'Despre ingeri'),
(17, 'Gabriel', 'Liiceanu', 42, 'Usa interzisa'),
(18, 'Ioana', 'Parvulescu', 67, 'Viata incepe vineri'),
(19, 'Petru', 'Cimpoesu', 88, 'Simon liftnicul');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `publication_year` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `publication_year`, `author_id`, `publisher_id`) VALUES
(3, 'The Shining', 1977, 2, 1),
(5, 'Murder on the Orient Express', 1934, 3, 2),
(6, 'Death on the Nile', 1937, 3, 2),
(7, 'The Promise', 1977, 4, 3),
(8, 'Alias Grace', 1996, 5, 3),
(9, 'Noaptea de sânziene', 1955, 6, 4),
(10, 'Solenoid', 2015, 7, 5),
(11, 'Blubber', 1974, 1, 1),
(12, 'O mie noua sute optezi si patru', 1961, 8, 1),
(13, 'To Kill a Mockinbird', 1981, 9, 1),
(14, 'The Great Gatsby', 1999, 10, 1),
(15, 'Pride and Prejudice', 1993, 11, 1),
(16, 'Jurnalul Annei Frank', 1998, 12, 2),
(17, 'Micul print', 2001, 13, 2),
(18, 'Beloved', 2002, 14, 3),
(19, 'On the Road', 2000, 15, 3),
(20, 'Despre ingeri', 1999, 16, 4),
(21, 'Simion liftnicul', 2000, 19, 5),
(22, 'Viata incepe vineri', 2004, 18, 5);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `books` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `books`) VALUES
(1, 'Penguin Books', 'Are You There God? It\'s Me, Margaret; The Shining; Blubber'),
(2, 'Paralela 45', 'It; Murder on the Orient Express; Death on the Nile'),
(3, 'Vintage', 'The Promise; Alias Grace'),
(4, 'Humanitas', 'Noaptea de Sanziene'),
(5, 'Polirom', 'Solenoid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
