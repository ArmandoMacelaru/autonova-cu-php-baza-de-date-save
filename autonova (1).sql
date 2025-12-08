-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 05:55 PM
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
(1, 1, 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&h=450&fit=crop', 'Imagine principală', 1, 0),
(2, 1, 'https://www.bmw.ro/content/dam/bmw/common/all-models/5-series/sedan/2023/highlights/bmw-5-series-sedan-sp-desktop.jpg', 'Imagine suplimentară', 0, 2),
(3, 1, 'https://www.bmw.ro/content/dam/bmw/common/all-models/5-series/sedan/2023/highlights/bmw-5-series-sedan-interior-desktop.jpg', 'Imagine suplimentară', 0, 3),
(4, 2, 'https://images.unsplash.com/photo-1563720223485-8f6a4bca015c?w=800&h=450&fit=crop', 'Imagine principală', 1, 0),
(5, 2, 'https://www.mercedes-benz.ro/passengercars/_jcr_content/root/paragraph/paragraph-right/paragraphimage.coreimg.90.2560.jpeg/1684835996467/mercedes-benz-clasa-c-2023-w206-2560x1440.jpeg', 'Imagine suplimentară', 0, 2),
(6, 2, 'https://www.mercedes-benz.ro/passengercars/_jcr_content/root/paragraph/paragraph-right/paragraphimage.coreimg.90.2560.jpeg/1684835996468/mercedes-benz-clasa-c-2023-w206-interior-2560x1440.jpeg', 'Imagine suplimentară', 0, 3),
(7, 3, 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&h=450&fit=crop', 'Imagine principală', 1, 0),
(8, 3, 'https://www.audi.ro/content/dam/nemo/models/a6/a6-sedan/my-2023/1920x1080-teaser/1920x1080_AA6_191023.jpg', 'Imagine suplimentară', 0, 2),
(9, 3, 'https://www.audi.ro/content/dam/nemo/models/a6/a6-sedan/my-2023/1920x1080-teaser/1920x1080_AA6_191023_2.jpg', 'Imagine suplimentară', 0, 3),
(10, 4, 'https://apruhonice.s3.eu-central-1.amazonaws.com/87/8787338a-6a56-49be-9f0e-3c9222028ba1.full.jpg', 'Imagine principală', 1, 0),
(11, 4, 'https://www.volvocars.com/images/v/-/media/project/contentplatform/data/media/my23/xc60/features/volvo-xc60-exterior-design-1-1-2.jpg', 'Imagine suplimentară', 0, 2),
(12, 4, 'https://www.volvocars.com/images/v/-/media/project/contentplatform/data/media/my23/xc60/features/volvo-xc60-interior-design-1-1-2.jpg', 'Imagine suplimentară', 0, 3),
(13, 5, 'https://media.discordapp.net/attachments/914645674677661736/1441093466984681573/20250702_205622.jpg', 'Imagine principală', 1, 0),
(14, 5, 'https://www.skoda-auto.com/_ipx/w_1920,q_75/%2Fcontent%2Fdam%2Fskoda%2Finternational%2Fmodels%2Fsuperb%2Fsuperb-iv%2Fexterior%2F1920x1080-superb_iv_exterior_01.jpg', 'Imagine suplimentară', 0, 2),
(15, 5, 'https://www.skoda-auto.com/_ipx/w_1920,q_75/%2Fcontent%2Fdam%2Fskoda%2Finternational%2Fmodels%2Fsuperb%2Fsuperb-iv%2Finterior%2F1920x1080-superb_iv_interior_01.jpg', 'Imagine suplimentară', 0, 3),
(16, 6, 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&h=450&fit=crop', 'Imagine principală', 1, 0),
(17, 6, 'https://www.tesla.com/sites/default/files/images/model-y/model-y-exterior-hero-desktop.jpg', 'Imagine suplimentară', 0, 2),
(18, 6, 'https://www.tesla.com/sites/default/files/images/model-y/model-y-interior-hero-desktop.jpg', 'Imagine suplimentară', 0, 3),
(19, 7, 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=800&h=450&fit=crop', 'Imagine principală', 1, 0),
(20, 7, 'https://www.porsche.com/international/models/macan/macan-models/macan/', 'Imagine suplimentară', 0, 2),
(21, 7, 'https://www.porsche.com/international/models/macan/macan-models/macan-s/', 'Imagine suplimentară', 0, 3),
(22, 8, 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=800&h=450&fit=crop', 'Imagine principală', 1, 0),
(23, 8, 'https://www.landrover.ro/explore-land-rover/range-rover-velar/design/exterior.html', 'Imagine suplimentară', 0, 2),
(24, 8, 'https://www.landrover.ro/explore-land-rover/range-rover-velar/design/interior.html', 'Imagine suplimentară', 0, 3);

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
(1, 'BMW', 'Seria 5 530d', 2022, 48900, 28500, 'motorina', 'automata', '265 CP', '2993 cm³', 'Alb', 'BMW Seria 5 în stare impecabilă, full options, istoric service la reprezentantă, fără accidente. Dotări: cutie automată Steptronic, faruri LED adaptative, head-up display, scaune ergonomice, sistem audio Harman Kardon, pachet M Sport.', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1555215695-3004980ad54e?w=800&h=450&fit=crop'),
(2, 'Mercedes', 'E-Class E220d', 2021, 41900, 34200, 'motorina', 'automata', '194 CP', '1950 cm³', 'Negru', 'Mercedes E-Class AMG Line, interior piele Artico, navigație MBUX, camera 360°, sistem audio Burmester, pachet AMG Night, scaune multicontur. Mașină întreținută exclusiv la reprezentanță.', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1563720223485-8f6a4bca015c?w=800&h=450&fit=crop'),
(3, 'Audi', 'A6 3.0 TDI', 2020, 38900, 45600, 'motorina', 'automata', '286 CP', '2967 cm³', 'Gri Metalizat', 'Audi A6 Quattro, cutie S-tronic, faruri Matrix LED, heads-up display, pachet sport, interior Valcona, suspensie adaptivă. Mașină verificată Audi Approved Plus.', 0, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&h=450&fit=crop'),
(4, 'Volvo', 'XC60 T8', 2023, 62900, 12500, 'hibrid', 'automata', '455 CP', '1969 cm³', 'Albastru', 'Volvo XC60 Recharge T8 Ultimate, plug-in hybrid, interior piele Nappa, pilot assist, sistem audio Bowers & Wilkins, panoramicroof, air suspension. Autonomie electrică 70km.', 1, '2025-12-08 16:47:54', 'https://apruhonice.s3.eu-central-1.amazonaws.com/87/8787338a-6a56-49be-9f0e-3c9222028ba1.full.jpg'),
(5, 'Skoda', 'Superb L&K', 2021, 27900, 37800, 'motorina', 'automata', '190 CP', '1968 cm³', 'Maro', 'Skoda Superb Laurin & Klement, dotări maxime, scaune ventilate cu masaj, sunroof panoramic, senzori 360°, matrix LED, audio Canton. Cea mai spațioasă mașină din clasa sa.', 0, '2025-12-08 16:47:54', 'https://media.discordapp.net/attachments/914645674677661736/1441093466984681573/20250702_205622.jpg'),
(6, 'Tesla', 'Model Y', 2023, 53900, 8900, 'electric', 'automata', '351 CP', '-', 'Alb', 'Tesla Model Y Long Range, autonomie 533km, Full Self-Driving Capability, glass roof, accelerare 0-100 în 4.4s, supraveghere Sentry Mode, updates over-the-air. Încărcare supercharger gratuită 1 an.', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&h=450&fit=crop'),
(7, 'Porsche', 'Macan S', 2022, 78900, 15600, 'benzina', 'automata', '380 CP', '2995 cm³', 'Alb', 'Porsche Macan S, PDK, pachet sport chrono, faruri LED Matrix, interior full leather, jante 21\", suspensie adaptivă, audio Bose. Mașină cu istoric Porsche perfect.', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=800&h=450&fit=crop'),
(8, 'Land Rover', 'Range Rover Velar', 2021, 65900, 28700, 'motorina', 'automata', '300 CP', '1997 cm³', 'Negru', 'Range Rover Velar D300, off-road capabilities, interior premium cu piele Windsor, touch pro duo, air suspension, sistem audio Meridian. Garantie Land Rover până în 2024.', 0, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=800&h=450&fit=crop');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
