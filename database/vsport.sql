-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2023 at 12:39 PM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sport`
--

-- --------------------------------------------------------

--
-- Table structure for table `announces`
--

CREATE TABLE `announces` (
  `id` int UNSIGNED NOT NULL,
  `content` varchar(300) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announces`
--

INSERT INTO `announces` (`id`, `content`, `status`, `created_at`) VALUES
(1, 'Aujourd\'hui, nous ne sommes pas disponibles, nous fermerons', 1, '2023-05-26 00:38:02'),
(3, 'Id consectetur consequatur non magna voluptatem Irure qui cillum aliqua Quasi.', 0, '2023-05-26 01:22:02'),
(4, 'Ut nisi et vel culpa corporis sint consequuntur esse et blanditiis vitae fugiat id aut voluptas', 0, '2023-05-26 01:37:22'),
(5, 'Cum corrupti modi consectetur quis eligendi asperiores exercitationem nisi proident voluptatum', 0, '2023-05-29 22:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(700) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Kylan Waller', 'qopoxim@mailinator.com', 'Minima accusantium omnis qui dignissimos laboris quae explicabo Perferendis duis dolorum quo proident voluptas est exercitationem iure cum nostrud', '2023-04-27 13:16:10'),
(2, 'Aladdin Glass', 'secib@mailinator.com', 'Et tempore aliquam qui quis veritatis est ut eos voluptate ut commodi dicta consequuntur consequat', '2023-04-27 13:40:01'),
(3, 'Hillary Mullins', 'vehinilev@mailinator.com', 'Enim voluptatem Ut nostrum reprehenderit repudiandae aliqua Ut non reprehenderit voluptatem', '2023-05-21 12:48:26'),
(4, 'Daryl Sims', 'nanicyziji@mailinator.com', 'Dolor id rem minim e', '2023-05-21 21:31:38'),
(5, 'Gil Baxter', 'bydina@mailinator.com', 'Amet irure consequa', '2023-05-22 15:15:39'),
(6, 'Kyle Mcneil', 'hidam@mailinator.com', 'Quos iusto veniam o', '2023-05-23 16:36:40'),
(8, 'Vera Nash', 'tedax@mailinator.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum vulputate diam, aliquam egestas nibh ante vel dui. Sed in tellus interdum eros vulputate placerat sed non enim. Pellentesque eget justo porttitor urna dictum fermentum sit amet sed mauris. Praesent molestie vestibulum erat ac rhoncus. Aenean nunc risus, accumsan nec ipsum et, convallis sollicitudin dui. Proin dictum quam a semper malesuada. Etiam porta sit amet risus quis porta. Nulla facilisi. Cras at interdum ante. Ut gravida pharetra ligula vitae malesuada.', '2023-05-29 22:37:10');

-- --------------------------------------------------------

--
-- Table structure for table `demandes`
--

CREATE TABLE `demandes` (
  `id` int UNSIGNED NOT NULL,
  `demande_id` bigint NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `equipe_id` int UNSIGNED NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipes`
--

CREATE TABLE `equipes` (
  `id` int UNSIGNED NOT NULL,
  `sport_id` int UNSIGNED NOT NULL,
  `coach_id` int UNSIGNED NOT NULL,
  `salle` varchar(255) NOT NULL,
  `salle_id` int NOT NULL DEFAULT '1',
  `emploi` varchar(255) NOT NULL,
  `gender` varchar(5) NOT NULL DEFAULT 'homme',
  `title` varchar(255) NOT NULL,
  `description` varchar(700) NOT NULL,
  `price` float NOT NULL,
  `nbr` int NOT NULL,
  `approved` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipes`
--

INSERT INTO `equipes` (`id`, `sport_id`, `coach_id`, `salle`, `salle_id`, `emploi`, `gender`, `title`, `description`, `price`, `nbr`, `approved`, `status`, `created_at`) VALUES
(3, 2, 46, 'LinkedList', 31, 'Lundi Jusqa Moi', 'homme', 'Lorem Not Ipsum', 'Dummy text', 331, 1, 'Non', 1, '2023-06-18 18:53:41'),
(4, 1, 45, 'BinaryTree', 12, 'Lundi Jusqa Moi', 'homme', 'equipe', 'teest', 23, 10, 'Oui', 1, '2023-06-18 19:07:42'),
(5, 2, 45, 'LinkedListV2', 23, 'Lundi Jusqa Moi', 'homme', 'Just Another Equipe', 'Let me know if this is real ?', 322, 10, 'Oui', 1, '2023-06-18 20:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(700) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'https://dummyimage.com/350x200/ced4da/6c757d.jpg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `title`, `description`, `image`, `created_at`) VALUES
(1, 'football', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum.', 'http://localhost/VSPORT/public/images/3.jpeg', '2023-05-21 15:27:33'),
(2, 'basketball', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et fermentum dui. Ut orci quam, ornare sed lorem sed, hendrerit auctor dolor. Nulla viverra, nibh quis ultrices malesuada, ligula ipsum.', 'http://localhost/VSPORT/public/images/1.jpeg', '2023-05-21 15:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `gender` varchar(5) NOT NULL DEFAULT 'homme',
  `password` varchar(300) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `date_naissance`, `gender`, `password`, `bio`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Secutem', 'Quasi', 'secretaire@vsport.com', '1974-09-08', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'secretaire', '2023-05-21 10:28:40', '2023-05-21 10:28:40'),
(4, 'Non est velit totam ', 'Omnis est veniam l', 'loryly@mailinator.com', '1975-02-27', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 11:15:54', '2023-05-21 11:15:54'),
(5, 'Ullamco non providen', 'Officia et iste modi', 'cexe@mailinator.com', '1976-07-23', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 11:17:47', '2023-05-21 11:17:47'),
(6, 'Nihil commodo magna ', 'Amet voluptatem ver', 'cofaxe@mailinator.com', '1998-04-14', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 11:18:42', '2023-05-21 11:18:42'),
(7, 'Laboriosam temporib', 'Placeat nobis numqu', 'vacebeki@mailinator.com', '1989-10-15', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 11:18:58', '2023-05-21 11:18:58'),
(9, 'Dolorem totam ut tem', 'Enim voluptas nulla ', 'xuvo@mailinator.com', '1996-12-05', 'homme', 'ec7b102707e6ba5cce29cae09580e47aa4c739ca', NULL, 'user', '2023-05-21 11:21:09', '2023-05-21 11:21:09'),
(10, 'Aemil', 'Baldwin', 'admin@vsport.com', '2020-10-10', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'admin', '2023-05-21 11:39:27', '2023-05-21 11:39:27'),
(11, 'Zelda', 'Russell', 'xygonypol@mailinator.com', '2021-06-10', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 12:20:32', '2023-05-21 12:20:32'),
(12, 'Charlotte', 'Sexton', 'sarafozoz@mailinator.com', '1986-05-03', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 13:12:18', '2023-05-21 13:12:18'),
(13, 'Kenneth', 'Gregory', 'dadij@mailinator.com', '2010-02-27', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 13:26:09', '2023-05-21 13:26:09'),
(14, 'Felicia', 'Mcbride', 'gysifisu@mailinator.com', '1987-06-06', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 14:20:02', '2023-05-21 14:20:02'),
(15, 'Elijah', 'Burris', 'foredabe@mailinator.com', '2019-06-14', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 14:28:23', '2023-05-21 14:28:23'),
(16, 'Julie', 'Stout', 'wuhuv@mailinator.com', '2017-06-16', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 14:40:40', '2023-05-21 14:40:40'),
(17, 'Unity', 'Buck', 'nepini@mailinator.com', '1972-08-08', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 15:39:46', '2023-05-21 15:39:46'),
(18, 'Rooney', 'Guerrero', 'waqomok@mailinator.com', '1981-03-28', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 16:42:07', '2023-05-21 16:42:07'),
(19, 'Macon', 'Bates', 'gumopytax@mailinator.com', '2010-10-11', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 21:33:14', '2023-05-21 21:33:14'),
(20, 'Carlos', 'Hernandez', 'fucutyzin@mailinator.com', '1993-12-21', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 22:38:40', '2023-05-21 22:38:40'),
(21, 'Bryar', 'George', 'dusosy@mailinator.com', '2021-04-18', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 23:09:34', '2023-05-21 23:09:34'),
(22, 'Stella', 'Fernandez', 'mywojyxu@mailinator.com', '1976-02-19', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-21 23:09:41', '2023-05-21 23:09:41'),
(23, 'Arsenio', 'Boone', 'nytibomen@mailinator.com', '1981-10-05', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-22 12:48:07', '2023-05-22 12:48:07'),
(24, 'Barbara', 'Gibson', 'qaxaq@mailinator.com', '1984-12-25', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-22 13:09:53', '2023-05-22 13:09:53'),
(25, 'Uma', 'Bishop', 'dofij@mailinator.com', '2006-02-12', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-22 13:35:56', '2023-05-22 13:35:56'),
(26, 'Xander', 'Heath', 'Xander@mailinator.com', '1993-05-31', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-22 14:36:13', '2023-05-22 14:36:13'),
(27, 'Nissim', 'Dodson', 'lutum@mailinator.com', '2008-10-26', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-22 14:44:48', '2023-05-22 14:44:48'),
(28, 'Wilma', 'Walls', 'zonybarixi@mailinator.com', '1985-07-09', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-22 15:01:40', '2023-05-22 15:01:40'),
(29, 'Aubrey', 'Bishop', 'huwes@mailinator.com', '1981-12-05', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-22 16:59:52', '2023-05-22 16:59:52'),
(30, 'Dalton', 'Church', 'bedici@mailinator.com', '2004-02-28', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-23 15:04:29', '2023-05-23 15:04:29'),
(31, 'Rudyard', 'Townsend', 'figysit@mailinator.com', '1981-04-10', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-23 15:04:36', '2023-05-23 15:04:36'),
(32, 'Kieran', 'Hill', 'qahyqag@mailinator.com', '1988-09-29', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-23 16:22:20', '2023-05-23 16:22:20'),
(33, 'Vivian', 'Kemp', 'butyky@mailinator.com', '2000-04-25', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-23 16:30:55', '2023-05-23 16:30:55'),
(34, 'Lysandra', 'Solis', 'zezy@mailinator.com', '1977-12-05', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-23 16:38:09', '2023-05-23 16:38:09'),
(35, 'Dennis', 'Duran', 'fevuh@mailinator.com', '2004-02-12', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-23 16:39:37', '2023-05-23 16:39:37'),
(36, 'Rhiannon', 'Bradshaw', 'pixajaco@mailinator.com', '1993-04-05', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-23 22:07:41', '2023-05-23 22:07:41'),
(37, 'India', 'Calhoun', 'nilozo@mailinator.com', '1983-01-15', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-23 22:07:52', '2023-05-23 22:07:52'),
(38, 'Caleb', 'Petty', 'ricy@mailinator.com', '1994-06-04', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-24 13:14:36', '2023-05-24 13:14:36'),
(39, 'Erich', 'Bartlett', 'rufygadeb@mailinator.com', '1995-04-16', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-26 01:09:13', '2023-05-26 01:09:13'),
(40, 'Caldwell', 'Warren', 'mepywamusu@mailinator.com', '2000-08-27', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'secretaire', '2023-05-26 01:09:25', '2023-05-26 01:09:25'),
(41, 'john', 'doe', 'john@doe.com', '2000-01-01', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'user', '2023-05-26 01:40:48', '2023-05-26 01:40:48'),
(42, 'Zenia', 'Dunlap', 'xivotizud@mailinator.com', '1982-01-15', 'femme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', NULL, 'secretaire', '2023-05-29 22:37:42', '2023-05-29 22:37:42'),
(43, 'Azalia', 'Cervantes', 'xozyqyf@mailinator.com', '1988-05-12', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', 'Just Another 4 Best Coach! for test', 'coach', '2023-05-29 22:38:14', '2023-05-29 22:38:14'),
(45, 'Coach', 'ForTest', 'coach@test.com', '1998-01-14', 'homme', 'b429f585241c039d5c44446f8e573e66796c8289', 'Just Another 3 Best Coach!', 'coach', '2023-06-18 18:27:00', '2023-06-18 18:27:00'),
(46, 'Hamid', 'Math', 'hamid@math.com', '2000-08-09', 'homme', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', 'Just Another 2 \n Best Coach!', 'coach', '2023-06-18 18:53:02', '2023-06-18 18:53:02'),
(47, 'Soun', 'Dus', 'sec@gmail.com', '2000-01-01', 'homme', '60a76e6e896073d9cd072923dc51678721b0a16d', NULL, 'secretaire', '2023-06-20 09:58:22', '2023-06-20 09:58:22'),
(48, 'EnoughX', 'daec', 'daec@gmail.com', '1999-01-01', 'homme', '5089aee3f9f290009509300e7b932b5c6311be58', 'Just Another Best Coach!', 'coach', '2023-06-20 10:05:02', '2023-06-20 10:05:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announces`
--
ALTER TABLE `announces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`equipe_id`),
  ADD UNIQUE KEY `demande_id` (`demande_id`),
  ADD KEY `equipe_id_dk` (`equipe_id`);

--
-- Indexes for table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sport_id` (`sport_id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announces`
--
ALTER TABLE `announces`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `equipe_id_dk` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `coach_id_fk` FOREIGN KEY (`coach_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `sport_id_fk` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
