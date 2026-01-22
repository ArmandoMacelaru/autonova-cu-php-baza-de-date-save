-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 10:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autonova`
--

-- --------------------------------------------------------

--
-- Table structure for table `imagini_masini`
--

CREATE TABLE `imagini_masini` (
  `id` int(11) NOT NULL,
  `masina_id` int(11) NOT NULL,
  `url_imagine` varchar(500) NOT NULL,
  `descriere` varchar(200) DEFAULT NULL,
  `este_principala` tinyint(1) DEFAULT 0,
  `ordine` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imagini_masini`
--

INSERT INTO `imagini_masini` (`id`, `masina_id`, `url_imagine`, `descriere`, `este_principala`, `ordine`) VALUES
(1, 1, 'https://carsized.com/resources/060811e1a7024d589b3e8bcefce48a1c/small/BMW-5-Series-2020-2023-front-view.png', 'BMW Seria 5 G30 - Vedere frontală 2022', 1, 0),
(2, 1, 'https://carsized.com/resources/44fae11d74074105aa54be2c73c4e213/small/BMW-5-Series-2020-2023-side-view.png', 'BMW Seria 5 - Vedere laterală', 0, 1),
(3, 1, 'https://carsized.com/resources/ec5bead7cd3a400b83b56e2a7dc658da/small/BMW-5-Series-2020-2023-rear-view.png', 'BMW Seria 5 - Vedere spate', 0, 2),
(4, 2, 'https://carsized.com/resources/2d9283d12d5a4c9a9ff2ec3c37a461e4/small/Mercedes-Benz-E-class-2022-front-view.png', 'Mercedes E-Class W213 - Model 2022', 1, 0),
(5, 2, 'https://carsized.com/resources/63e2329d3af64cbda4c8885802dc4ed4/small/Mercedes-Benz-E-class-2022-side-view.png', 'Mercedes E-Class - Profil elegant', 0, 1),
(6, 2, 'https://carsized.com/resources/521eec5a411c42c1bbd9c27eb4375801/small/Mercedes-Benz-E-class-2022-rear-view.png', 'Mercedes E-Class - Spate premium', 0, 2),
(7, 3, 'https://carsized.com/resources/5b3b30531c21475ebf1f3a97432844d5/small/Audi-A6-2021-front-view.png', 'Audi A6 C8 - Sedan business 2021', 1, 0),
(8, 3, 'https://carsized.com/resources/79ecf25d33b84eea9c18f3790b6e0d6d/small/Audi-A6-2021-side-view.png', 'Audi A6 - Linii sportive', 0, 1),
(9, 3, 'https://carsized.com/resources/846f22b2e6754d5e9336d5b8d6f87708/small/Audi-A6-2021-rear-view.png', 'Audi A6 - Faruri OLED', 0, 2),
(10, 4, 'https://carsized.com/resources/50c7d1fb66074b9f9be4212d98f1c338/small/Volvo-XC60-2021-front-view.png', 'Volvo XC60 - SUV premium 2021', 1, 0),
(11, 4, 'https://carsized.com/resources/3f7181cc716f42a09f6a02a2445629c6/small/Volvo-XC60-2021-side-view.png', 'Volvo XC60 - Design scandinav', 0, 1),
(12, 4, 'https://carsized.com/resources/6914588fc7a34e00b80a1167e7d0a653/small/Volvo-XC60-2021-rear-view.png', 'Volvo XC60 - Siguranță activă', 0, 2),
(13, 5, 'https://carsized.com/resources/120fd2cf06624c09a9c61b0d199b56c5/small/Skoda-Superb-2022-front-view.png', 'Skoda Superb B8 - Model 2022', 1, 0),
(14, 5, 'https://carsized.com/resources/5121572278c3468781577600f9a86d3d/small/Skoda-Superb-2022-side-view.png', 'Skoda Superb - Sedan spațios', 0, 1),
(15, 5, 'https://carsized.com/resources/607a0e3c3043413494fe1c9fda8c68c1/small/Skoda-Superb-2022-rear-view.png', 'Skoda Superb - Portbagaj enorm', 0, 2),
(16, 6, 'https://carsized.com/resources/6874c5756e764847974c9ae79d4f320a/small/Tesla-Model-Y-2022-front-view.png', 'Tesla Model Y - Crossover electric', 1, 0),
(17, 6, 'https://carsized.com/resources/459dcd906aa84b7296144b6ae56a8ab5/small/Tesla-Model-Y-2022-side-view.png', 'Tesla Model Y - Design futurist', 0, 1),
(18, 6, 'https://carsized.com/resources/48ed81c26bd7479a8f3f40d32fa2ac77/small/Tesla-Model-Y-2022-rear-view.png', 'Tesla Model Y - Glass roof', 0, 2),
(19, 7, 'https://carsized.com/resources/daf32dcd615143309f89a74b28a5eb5d/small/Porsche-Macan-2022-front-view.png', 'Porsche Macan - SUV sport 2022', 1, 0),
(20, 7, 'https://carsized.com/resources/69b1e1493da6437ab44dd88e71b5b3c5/small/Porsche-Macan-2022-side-view.png', 'Porsche Macan - Linii atletice', 0, 1),
(21, 7, 'https://carsized.com/resources/0d58774f77c647c48500134cc2bd9ee1/small/Porsche-Macan-2022-rear-view.png', 'Porsche Macan - Jante RS Spyder', 0, 2),
(22, 8, 'https://carsized.com/resources/e9ee7bb729314415a6ac87024da4c118/small/Land-Rover-Range-Rover-Velar-2022-front-view.png', 'Range Rover Velar - SUV luxury 2022', 1, 0),
(23, 8, 'https://carsized.com/resources/0387e2f672614f919fd90089c1034153/small/Land-Rover-Range-Rover-Velar-2022-side-view.png', 'Range Rover Velar - Design minimalist', 0, 1),
(24, 8, 'https://carsized.com/resources/25956e1cfe2845c7b6007453b304e27f/small/Land-Rover-Range-Rover-Velar-2022-rear-view.png', 'Range Rover Velar - Off-road capabilities', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `masini`
--

CREATE TABLE `masini` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `model` varchar(100) NOT NULL,
  `an` int(11) NOT NULL,
  `pret` int(11) NOT NULL,
  `kilometraj` int(11) NOT NULL,
  `combustibil` varchar(20) NOT NULL,
  `cutie_viteze` varchar(20) NOT NULL,
  `putere` varchar(20) DEFAULT NULL,
  `capacitate_cilindrica` varchar(20) DEFAULT NULL,
  `culoare` varchar(30) DEFAULT NULL,
  `descriere` text DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `data_adaugare` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagine` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masini`
--

INSERT INTO `masini` (`id`, `marca`, `model`, `an`, `pret`, `kilometraj`, `combustibil`, `cutie_viteze`, `putere`, `capacitate_cilindrica`, `culoare`, `descriere`, `featured`, `data_adaugare`, `imagine`) VALUES
(1, 'BMW', 'Seria 5 530d', 2022, 48900, 28500, 'motorina', 'automata', '265 CP', '2993 cm³', 'Alb', 'BMW Seria 5 în stare impecabilă, full options, istoric service la reprezentantă, fără accidente. Dotări: cutie automată Steptronic, faruri LED adaptative, head-up display, scaune ergonomice, sistem audio Harman Kardon, pachet M Sport.', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&h=600&fit=crop&crop=center'),
(2, 'Mercedes', 'E-Class E220d', 2021, 41900, 34200, 'motorina', 'automata', '194 CP', '1950 cm³', 'Negru', 'Mercedes E-Class E220d AMG Line 2021, cutie automata 9G-Tronic, interior piele Artico/Nappa, faruri MULTIBEAM LED, sistem MBUX cu ecran widescreen, scaune multicontur cu memorie, pachet Driving Assistance, audio Burmester 3D. Garantie Mercedes până în 2024.', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1563720223485-8f6a4bca015c?w=800&h=600&fit=crop&crop=center'),
(3, 'Audi', 'A6 3.0 TDI', 2020, 38900, 45600, 'motorina', 'automata', '286 CP', '2967 cm³', 'Gri Metalizat', 'Audi A6 Quattro, cutie S-tronic, faruri Matrix LED, heads-up display, pachet sport, interior Valcona, suspensie adaptivă. Mașină verificată Audi Approved Plus.', 0, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&h=600&fit=crop&crop=center'),
(4, 'Volvo', 'XC60 T8', 2023, 62900, 12500, 'hibrid', 'automata', '455 CP', '1969 cm³', 'Albastru', 'Volvo XC60 Recharge T8 Ultimate, plug-in hybrid, interior piele Nappa, pilot assist, sistem audio Bowers & Wilkins, panoramicroof, air suspension. Autonomie electrică 70km.', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800&h=600&fit=crop&crop=center'),
(5, 'Skoda', 'Superb L&K', 2021, 27900, 37800, 'motorina', 'automata', '190 CP', '1968 cm³', 'Maro', 'Skoda Superb Laurin & Klement 2021, cutie DSG automata, interior piele, faruri LED Matrix, senzori 360°, scaune ventilate cu masaj, sistem audio Canton, panou digital Virtual Cockpit. Mașină premium în stare excelentă.', 0, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1589820296156-c5955336e9b7?w=800&h=600&fit=crop&crop=center'),
(6, 'Tesla', 'Model Y', 2023, 53900, 8900, 'electric', 'automata', '351 CP', '-', 'Alb', 'Tesla Model Y Long Range, autonomie 533km, Full Self-Driving Capability, glass roof, accelerare 0-100 în 4.4s, supraveghere Sentry Mode, updates over-the-air. Încărcare supercharger gratuită 1 an.', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&h=600&fit=crop&crop=center'),
(7, 'Porsche', 'Macan S', 2022, 78900, 15600, 'benzina', 'automata', '380 CP', '2995 cm³', 'Alb', 'Porsche Macan S, PDK, pachet sport chrono, faruri LED Matrix, interior full leather, jante 21\", suspensie adaptivă, audio Bose. Mașină cu istoric Porsche perfect.', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1580273916550-e328a74c7b8c?w=800&h=600&fit=crop&crop=center'),
(8, 'Land Rover', 'Range Rover Velar', 2021, 65900, 28700, 'motorina', 'automata', '300 CP', '1997 cm³', 'Negru', 'Range Rover Velar D300, off-road capabilities, interior premium cu piele Windsor, touch pro duo, air suspension, sistem audio Meridian. Garantie Land Rover până în 2024.', 0, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=800&h=600&fit=crop&crop=center');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `created_at`) VALUES
(1, 'admin', 'admin@autonova.ro', '$2y$10$Q1vH0GzY0qz3oK8tO0dIJe9mQk7Vf8y6m8o0j9m8c0yR2x5xg7d3y', '2026-01-19 09:11:15'),
(2, 'cosminbrj', 'cosminbrj@gmail.com', '$2y$10$3ov47/CQwC2ZCMQJYHx1UeRnMOJK6fLkz1wq6Q3CDiVpBRaoFFUxe', '2026-01-19 09:21:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagini_masini`
--
ALTER TABLE `imagini_masini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masina_id` (`masina_id`);

--
-- Indexes for table `masini`
--
ALTER TABLE `masini`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagini_masini`
--
ALTER TABLE `imagini_masini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `masini`
--
ALTER TABLE `masini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `imagini_masini`
--
ALTER TABLE `imagini_masini`
  ADD CONSTRAINT `imagini_masini_ibfk_1` FOREIGN KEY (`masina_id`) REFERENCES `masini` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- ===== AutoNova Upgrade: Profil + Vizualizari =====

ALTER TABLE `masini`
  ADD COLUMN `user_id` int(11) NULL AFTER `id`,
  ADD INDEX `idx_masini_user` (`user_id`);

CREATE TABLE IF NOT EXISTS `vizualizari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `masina_id` int(11) NOT NULL,
  `viewed_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_view` (`user_id`,`masina_id`),
  KEY `idx_user_time` (`user_id`,`viewed_at`),
  KEY `idx_masina` (`masina_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

