-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Sun 14.Máj 2023, 12:59
-- Verzia serveru: 10.4.27-MariaDB
-- Verzia PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `sj-2023`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `cast`
--

CREATE TABLE `cast` (
  `id` int(11) NOT NULL,
  `tag` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `actor` varchar(45) NOT NULL,
  `img_path` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `cast`
--

INSERT INTO `cast` (`id`, `tag`, `name`, `actor`, `img_path`) VALUES
(1, 'hawk', 'Hawkeye Pierce', 'Alan Alda', 'images/profile/hawkeye.jpg'),
(9, 'trap', 'Trapper John', 'Wayne Rogers', 'images/profile/trapper.jpg'),
(10, 'bj', 'BJ Hunnicut', 'Mike Farell', 'images/profile/bj.jpg'),
(12, 'radar', 'Radar OReily', 'Gary Burghoff', 'images/profile/radar.jpg'),
(14, 'frank', 'Frank Burns', 'Larry Linville', 'images/profile/burns.jpg'),
(15, 'henry', 'Henry Blake', 'Mclean Stevenson', 'images/profile/henry.jpg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `sys_name` varchar(15) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `path` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `menu`
--

INSERT INTO `menu` (`id`, `sys_name`, `user_name`, `path`) VALUES
(1, 'home', 'Home', 'index.php'),
(2, 'about', 'About', 'about.php'),
(3, 'watch', 'Watch', 'watch.php'),
(4, 'bonus', 'Bonus', 'bonus.php'),
(18, 'admin', 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nickname` varchar(25) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `reviews`
--

INSERT INTO `reviews` (`id`, `username`, `nickname`, `text`) VALUES
(1, 'user1', 'HawkeyePierce', 'Best episode for sure.'),
(3, 'user2', 'TrapperJohn', 'Very good, too bad I wasnt there');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `meno` varchar(15) NOT NULL,
  `heslo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `user`
--

INSERT INTO `user` (`id`, `meno`, `heslo`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `cast`
--
ALTER TABLE `cast`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `cast`
--
ALTER TABLE `cast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pre tabuľku `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pre tabuľku `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pre tabuľku `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
