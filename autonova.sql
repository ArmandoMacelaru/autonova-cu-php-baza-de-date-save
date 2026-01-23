-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2026 at 10:32 AM
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
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `masina_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 1, 'images/masini/masina_1_1.jpg', 'BMW Seria 5 G30 - Vedere frontală 2022', 1, 0),
(2, 1, 'images/masini/masina_1_2.jpg', 'BMW Seria 5 - Vedere laterală', 0, 1),
(3, 1, 'images/masini/masina_1_3.jpg', 'BMW Seria 5 - Vedere spate', 0, 2),
(4, 2, 'images/masini/masina_2_1.jpg', 'Mercedes E-Class W213 - Model 2022', 1, 0),
(5, 2, 'images/masini/masina_2_2.jpg', 'Mercedes E-Class - Profil elegant', 0, 1),
(6, 2, 'images/masini/masina_2_3.jpg', 'Mercedes E-Class - Spate premium', 0, 2),
(7, 3, 'images/masini/masina_3_1.jpg', 'Audi A6 C8 - Sedan business 2021', 1, 0),
(8, 3, 'images/masini/masina_3_2.jpg', 'Audi A6 - Linii sportive', 0, 1),
(9, 3, 'images/masini/masina_3_3.jpg', 'Audi A6 - Faruri OLED', 0, 2),
(10, 4, 'images/masini/masina_4_1.jpg', 'Volvo XC60 - SUV premium 2021', 1, 0),
(11, 4, 'images/masini/masina_4_2.jpg', 'Volvo XC60 - Design scandinav', 0, 1),
(12, 4, 'images/masini/masina_4_3.jpg', 'Volvo XC60 - Siguranță activă', 0, 2),
(13, 5, 'images/masini/masina_5_1.jpg', 'Skoda Superb B8 - Model 2022', 1, 0),
(14, 5, 'images/masini/masina_5_2.jpg', 'Skoda Superb - Sedan spațios', 0, 1),
(15, 5, 'images/masini/masina_5_3.jpg', 'Skoda Superb - Portbagaj enorm', 0, 2),
(16, 6, 'images/masini/masina_6_1.jpg', 'Tesla Model Y - Crossover electric', 1, 0),
(17, 6, 'images/masini/masina_6_2.jpg', 'Tesla Model Y - Design futurist', 0, 1),
(18, 6, 'images/masini/masina_6_3.jpg', 'Tesla Model Y - Glass roof', 0, 2),
(19, 7, 'images/masini/masina_7_1.jpg', 'Porsche Macan - SUV sport 2022', 1, 0),
(20, 7, 'images/masini/masina_7_2.jpg', 'Porsche Macan - Linii atletice', 0, 1),
(21, 7, 'images/masini/masina_7_3.jpg', 'Porsche Macan - Jante RS Spyder', 0, 2),
(22, 8, 'images/masini/masina_8_1.jpg', 'Range Rover Velar - SUV luxury 2022', 1, 0),
(23, 8, 'images/masini/masina_8_2.jpg', 'Range Rover Velar - Design minimalist', 0, 1),
(24, 8, 'images/masini/masina_8_3.jpg', 'Range Rover Velar - Off-road capabilities', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `masini`
--

CREATE TABLE `masini` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
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

INSERT INTO `masini` (`id`, `user_id`, `marca`, `model`, `an`, `pret`, `kilometraj`, `combustibil`, `cutie_viteze`, `putere`, `capacitate_cilindrica`, `culoare`, `descriere`, `featured`, `data_adaugare`, `imagine`) VALUES
(1, NULL, 'BMW', 'Seria 5 530d AT', 2017, 17990, 295000, ' Diesel', 'automata', '265 CP', '2993 cm³', 'Alb', 'BMW Seria 5 – Sedanul business din 2017, cu motorizare diesel de 2993 cm³ și 265 CP, oferă echilibrul perfect între rafinament, performanță și confort. Ideal pentru cei care caută o mașină spațioasă, elegantă și fiabilă, potrivită atât pentru drumuri lungi, cât și pentru utilizare urbană. Modelul dispune de 5 locuri și un design modern, specific mărcii BMW.\r\n\r\n', 1, '2025-12-08 16:47:54', 'https://frankfurt.apollo.olxcdn.com/v1/files/6thyb6vh58ee-RO/image;s=1000x750'),
(2, NULL, 'Mercedes', 'E 220d AVANTGARDE', 2019, 14500, 143000, 'Diesel', 'automata', '194 CP', '2200 cm³', 'Gri', 'Mercedes-Benz E 220d AVANTGARDE\r\n\r\nAdblue Euro 6\r\n\r\n194 cp Diesel\r\n\r\nCutie viteze automata 9G Tronix\r\n\r\nPadele volan\r\n\r\nPachet interior/exterior AVANTGARDE\r\n\r\nNavigație mare\r\n\r\nSenzori parcare fata/spate\r\n\r\nSuspensie și mod condus :\r\n\r\n-individual\r\n\r\n-eco mode\r\n\r\n-confort\r\n\r\n-sport\r\n\r\n-sport +\r\n\r\nPark-Assist\r\n\r\nSide Assist\r\n\r\nScaune sport electrice , încălzite\r\n\r\nTapiterie piele-stofa\r\n\r\nOglinzi electrice -heliomate\r\n\r\nFaruri LED High Performance\r\n\r\nLumini de zi cu tehnologie LED\r\n\r\nSemnalizare LED\r\n\r\nStopuri cristal\r\n\r\nDublu climatronic cu afișaj digital\r\n\r\nPachet crom exterior\r\n\r\nFollow me Home\r\n\r\nComing Home\r\n\r\nAgility Select\r\n\r\nDynamic Select\r\n\r\nAttention Assist\r\n\r\nColizion Assist\r\n\r\nBluetooth audio/ telefon\r\n\r\nHaion portbagaj cu închidere și deschidere electrică\r\n\r\nLumini ambientale interior\r\n\r\nVolan -touch-multifuncional\r\n\r\nAsistentă activă frânare\r\n\r\nJante aliaj originale Mercedes\r\n\r\nPilot automat cu funcție de frânare în caz de accident , impact auto , pietoni\r\n\r\nJoystick cu TouchPad\r\n\r\nCameră video marșarier\r\n\r\nSenzori lumini/ploaie\r\n\r\nStart&Stop la semafor\r\n\r\nKeyleas GO (pornire buton )\r\n\r\n2 chei\r\n\r\nKm reali , istoric', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1563720223485-8f6a4bca015c?w=800&h=600&fit=crop&crop=center'),
(3, NULL, 'Audi', 'A6 3.0 TDI quattro S tronic', 2015, 16500, 253000, 'Diesel', 'automata', '218 CP', '2967 cm³', 'Gri Metalizat', 'Audi A6 C7 facelift / 3.0 TDI Quattro \r\n\r\nMotorizare de 272 cp (cu power reduction la 218CP - fabricatie Belgia)\r\n\r\n\r\n\r\nKm 253.000 reali cu istoric complet !!\r\n\r\nMașina circula zilnic, stare impecabila!\r\n\r\nPt raport CarVertical cu inregistrari anuale ale kilometrajului pana in prezent + istoric facturi de service, rog contact pe whatssapp\r\n\r\n\r\n\r\nKm reali 100%\r\n\r\n\r\n\r\n# Cutie Automata S-tronic 7+1 - cutia schimba ca si una noua, fiind reconditionata complet în urma cu 30.000km ( 19.870 ron valoare reparatie - mechatronic, set ambreaje, volanta, totul NOU)\r\n\r\n# Carlig remorcare original, pliabil\r\n\r\n# Interior full piele Valcona ( NU piele ecologica) cu ornamente decorative carbon\r\n\r\n# Scaune electrice cu memorie, încălzite\r\n\r\n# Portbagaj electric cu softclose\r\n\r\n# Functie travel & Go pt scaunele spate (pregatire pt tablete)\r\n\r\n# SideAssist ( avertizare in oglinzi )\r\n\r\n# Faruri matrix / stopuri full led cu folie de protectie PPF \r\n\r\n# Senzori parcare + Camere 360* (fata, spate, oglinzi stanga/dreapta) \r\n\r\n# Lumini ambientale interior/exterior uși/praguri\r\n\r\n# Keyless Go (cu buton pornire start/stop)\r\n\r\n# Keyless Entry (Închidere/Deschidere pe Amprenta)\r\n\r\n# Oglinzi Pliabile Electric\r\n\r\n# Suspensie pneumatică cu 3 nivele de inaltime (teren accidentat/normal/sport)\r\n\r\n# 5x Moduri de condus :\r\n\r\n-Eficient\r\n\r\n-Comfort\r\n\r\n-Auto\r\n\r\n-Dynamic\r\n\r\n-Individual\r\n\r\n# Camera fază lungă/scurtă automata\r\n\r\n# Semnalizari Dinamice Spate\r\n\r\n# Tehnologie Full LED fata si spate\r\n\r\n# Cruise control (pilot automat) cu functie de franare de urgenta\r\n\r\n# Volan piele cu padele\r\n\r\n# Climatronic pe 4 zone (fata/spate)\r\n\r\n# Navigatie mare cu touch pad, Apple CarPlay și Android Auto\r\n\r\n# Sistem sonorizare Audi premium cu DVD AUX MP3 card ssd\r\n\r\n# Computer de bord maxidot cu display color\r\n\r\n# 4 x geamuri electrice DUBLE\r\n\r\n# Perdeluța electrică lunetă și perdeluțe geamuri spate manuale\r\n\r\n# Geamuri privacy glass cu folie UV\r\n\r\n# Cotiera fata reglabilă\r\n\r\n# Cotiera Spate cu suport pahare\r\n\r\n# Senzori lumina + ploaie\r\n\r\n# Senzori presiune roți\r\n\r\n# Etrieri galbeni Audi Sport\r\n\r\n# Proiectoare ceață\r\n\r\n# Cornering lights (luminarea virajului)\r\n\r\n# Day Light\r\n\r\n# Follow me home\r\n\r\n# Leaving home\r\n\r\n# Functie bluetooth telefon + Media\r\n\r\n# Comenzi vocale\r\n\r\n# Trapa electrica bipozitionala\r\n\r\n# Încălzire auxiliară electrică suplimentara + sirrocou programabil din meniu sau din telecomanda)\r\n\r\n# Difuzor bara spate original Audi S6\r\n\r\n# Interior A8\r\n\r\n# Eleron portbagaj\r\n\r\n# Culoare speciala Moonlight Blue Metallic\r\n\r\n\r\n\r\n# Norma poluare: Euro6 cu ad blue \r\n\r\n# Filtru Particule DPF activ si fara probleme !!\r\n\r\n# Jante originale Audi R18 și anvelope de iarnă\r\n\r\n\r\n\r\nImport Belgia, unic proprietar in tara din 2021 (aprox 60.000 km efectuati) - istoric service complet si corect!\r\n\r\n\r\n\r\nPt orice alte detalii rog sunati.', 0, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?w=800&h=600&fit=crop&crop=center'),
(4, NULL, 'Volvo', 'XC 60 D4 Geartronic Momentum', 2014, 10999, 224291, 'Diesel', 'automata', '181 CP', '1969 cm³', 'Gri', 'Detalii SUV:\r\n\r\n\r\n\r\nFirma ALD Autoland ofera spre vanzare SUV-ul marca:\r\n\r\nVolvo XC60 2.0 D4, 2X4\r\n\r\n\r\n\r\n* Pret: 10.999€ TVA Inclus\r\n\r\n* Rate incepand de la 252€\r\n\r\n* Km bord: 224 291\r\n\r\n* Prima inmatriculare in 20.06.2014\r\n\r\n* Inmatriculat in tara in 15.01.2018\r\n\r\n\r\n\r\nDotari:\r\n\r\n\r\n\r\n* Start- stop\r\n\r\n* Navigatie inclusiv Romania\r\n\r\n* Pilot automat\r\n\r\n* Clima automata pe doua zone\r\n\r\n* ABS, ESP\r\n\r\n* Volan multifunctional imbracat in piele\r\n\r\n* Geamuri electrice fata- spate\r\n\r\n* Oglinzi electrice si incalzite\r\n\r\n* Radio CD, USB, AUX\r\n\r\n* Handsfree bluetooth\r\n\r\n* City safety\r\n\r\n* Computer bord\r\n\r\n* Senzori ploaie\r\n\r\n* Frana de mana electrica\r\n\r\n* Senzori lumini\r\n\r\n* Scaun sofer incalzit\r\n\r\n* Interior piele\r\n\r\n* Geamuri fumurii\r\n\r\n* Sistem ISOFIX\r\n\r\n* Inchidere centralizata\r\n\r\n* Scaun pasager reglabil pe inaltime\r\n\r\n* Scaune fata incalzite\r\n\r\n* Daylight LED\r\n\r\n* Stopuri LED\r\n\r\n* Bare longitudinale\r\n\r\n* Jante aliaj usor pe 17\' cu anvelope de iarna\r\n\r\n* Senzori parcare spate cu afisaj\r\n\r\n* Carlig remorcare', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?w=800&h=600&fit=crop&crop=center'),
(5, NULL, 'Skoda', 'Superb 2.0 TDI DSG Style', 2019, 14990, 209800, 'Diesel', 'automata', '150 CP', '1968 cm³', 'Argint', '**Skoda Superb 2.0 TDI DSG Style 150CP**\r\n\r\n\r\n\r\n--⭐️Consum mixt 4.8 l/100km⭐️\r\n\r\n\r\n\r\n--✅Posibilitate finantare persoane fizice si juridice prin credit auto--\r\n\r\n--✅Rulajul autoturismului este certificat, punem la dispozitia clientului istoricul complet--\r\n\r\n\r\n\r\n⭐️Scaune față cu reglaj lombar și încălzire⭐️\r\n\r\n\r\n\r\n--Cutie automată DSG--\r\n--Climatizare automată pe 3 zone--\r\n--Pilot automat și limitator de viteză--\r\n--Senzori parcare față/spate--\r\n--Oglinzi electrice rabatabile și încălzite--\r\n--Faruri LED cu funcție cornering și spălătoare--\r\n--Lumini ambientale LED interior--\r\n--Sistem multimedia cu touchscreen, Bluetooth, USB--\r\n--Volan multifuncțional îmbrăcat în piele cu padele--\r\n--Start/Stop, frână de parcare electrică--\r\n--Keyless entry & GO--\r\n--ISOFIX, airbaguri multiple (față, lateral, cortină)--\r\n--Jante aliaj 18\"--\r\n--Geamuri electrice față/spate--\r\n--Sistem de monitorizare presiune pneuri--\r\n--Senzor ploaie și lumină--\r\n--Cotieră față/spate--\r\n--Parasolare laterale spate manuale--\r\n--Încărcare wireless telefon--\r\n\r\n', 0, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1589820296156-c5955336e9b7?w=800&h=600&fit=crop&crop=center'),
(6, NULL, 'Tesla', 'Model Y', 2022, 32955, 78903, 'electric', 'automata', '534 CP', '-', 'Alb', 'Tesla Model Y Performance Dual AWD\r\n\r\n\r\n\r\nPutere: 393 kW / 534 HP\r\n\r\nKilometraj: 78,903\r\n\r\nPrima înmatriculare: 14.12.2022\r\nExterior\r\n\r\n• Culoare Pearl White multi-coat\r\n\r\n• Faruri LED adaptive cu fază lungă automată\r\n\r\n• Jante R21 Überturbine cu anvelope de vară\r\n\r\n• Plafon panoramic din sticlă cu protecție UV și infraroșu\r\n\r\n• Oglinzi laterale reglabile electric, încălzite și pliabile automat\r\n\r\n• Portbagaj frontal și portbagaj spate cu deschidere electrică\r\n\r\n\r\n\r\nInterior\r\n\r\n• Tapițerie din piele neagră Tesla \'Vegan Leather\'\r\n\r\n• Scaune față încălzite și reglabile electric pe 12 direcții\r\n\r\n• Scaune spate încălzite\r\n\r\n• Sistem de climatizare automată\r\n\r\n• Volan multifuncțional cu funcție de încălzire\r\n\r\n• Consolă centrală cu spațiu de depozitare și suporturi pentru pahare\r\n\r\n\r\n\r\nTehnologie\r\n\r\n• Sistem de infotainment  de 15\" cu procesor AMD \r\n\r\n• Sistem audio premium (14 difuzoare + subwoofer)\r\n\r\n• Încărcare wireless pentru smartphone\r\n\r\n• Navigație Google Maps cu informații despre trafic în timp real\r\n\r\n• Integrare Spotify, YouTube, Netflix (cu pachetul Premium Connectivity)\r\n\r\n• Conectivitate Bluetooth și 4 porturi USB-C\r\n\r\n• Acces digital - (prin aplicația mobilă Tesla)\r\n\r\n• Control de la distanță al mașinii (climatizare, localizare, blocare/deblocare)\r\n\r\n• Actualizări software prin internet (OTA)\r\n\r\n• Dog Mode: menține temperatura interioară pentru animalele de companie în mașină\r\n\r\n\r\n\r\nAsistență și siguranță\r\n\r\n• Sentry Mode și vizualizare cameră în timp real\r\n\r\n• Senzori de parcare față și spate\r\n\r\n• Cameră video 360°\r\n\r\n• Pilot automat adaptiv\r\n\r\n• Sistem de menținere a benzii de rulare\r\n\r\n• Frânare automată de urgență\r\n\r\n• Avertizare la părăsirea benzii\r\n\r\n• Monitorizarea unghiului mort\r\n\r\n• Sistem de monitorizare a presiunii în pneuri\r\n\r\n• Airbaguri frontale, laterale și cortină\r\n\r\n', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?w=800&h=600&fit=crop&crop=center'),
(7, NULL, 'Porsche', 'Macan GTS PDK', 2016, 29887, 144200, 'Benzina', 'automata', '360 CP', '2997 cm³', 'Albastru', 'PORSCHE MACAN GTS\r\n\r\n\r\n\r\n# Motorizare 3.0 Benzina 360 cp\r\n\r\n# Cutie de viteze automata PDK 8+1 cu AutoHold\r\n\r\n# 4x4 Permanent\r\n\r\n# Suspensie Pneumatica ( Perne de aer )\r\n\r\n\r\n\r\n# Faruri LED adaptive si stopuri LED\r\n\r\n\r\n\r\n# Trapa panoramica\r\n\r\n\r\n\r\n# BOSE Premium Hi-Fi sound system\r\n\r\n\r\n\r\n# Side Assist ( avertizare unghi mort )\r\n\r\n\r\n\r\n# Lane Assist\r\n\r\n\r\n\r\n# Buton pentru sunet evacuare\r\n\r\n# Interior de piele perforata de culoare maro\r\n\r\n# Scaune Sport cu reglaj lombar\r\n\r\n# Scaune cu memorii\r\n\r\n# Incalzire in scaune\r\n\r\n# Bord in piele\r\n\r\n# SoftClose la portbagaj\r\n\r\n# Climatronic pe 3 zone\r\n\r\n# Oglinzi rabatabile electric, heliomate si incalzite\r\n\r\n# Volan de piele multifunctional\r\n\r\n# Senzori de lumina/ploaie/roti\r\n\r\n# Senzori de parcare fata/spate cu afisaj\r\n\r\n# Camera pentru semnele de circulatie\r\n\r\n# Park Assistant\r\n\r\n# Multimedia:\r\n\r\n# Navigatie Profesionala 3D cu Touchscreen si harta RO\r\n\r\n# Bluetooth\r\n\r\n# USB/AUX/DVD/CD/MP3\r\n\r\n# Pilot automat\r\n\r\n# Sistem Start/Stop\r\n\r\n# ISOFIX\r\n\r\n# Jante 21\" cauciucuri de vara\r\n\r\nToate reviziile sunt efectuate la zi', 1, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1580273916550-e328a74c7b8c?w=800&h=600&fit=crop&crop=center'),
(8, NULL, 'Land Rover', 'Range Rover Velar 2.0 R-Dynamic S', 2018, 25490, 100540, 'Diesel', 'automata', '240 CP', '1999 cm³', 'Maro', 'LAND ROVER RANGE ROVER VELAR R-DYNAMIC\r\n\r\n\r\n\r\nModel : RANGE ROVER VELAR R-DYNAMIC\r\n\r\n\r\n\r\nMOTORIZARE : 1999 / AUTOMAT\r\n\r\n\r\n\r\nPUTERE : 240 CP\r\n\r\n\r\n\r\nTransmisie : Automat\r\nDotari Suplimentare: \r\n\r\n\r\n\r\n*Trapa Panoramica\r\n\r\n\r\n\r\n*Suspensie pneumatica\r\n\r\n\r\n*Avertizare distanta\r\n\r\n\r\n*Incalzire Scaune Fata\r\n\r\n\r\n\r\n*Incalzire bancheta spate\r\n\r\n\r\n*Av. schimb banda\r\n\r\n\r\n*Asistent urgenta\r\n\r\n\r\n*Avertizare coborare\r\n\r\n\r\n* Bord digital\r\n\r\n\r\n* Keyless entry\r\n\r\n\r\n* Keyless go\r\n\r\n\r\n* FARURI FULL LED ADAPTIVE\r\n\r\n\r\n• Stopuri cu Tehnologie Led\r\n\r\n\r\n• Sistem de spalare a farurilor\r\n\r\n\r\n* Camera faza lunga\r\n\r\n\r\n*Scaune fata electrice\r\n\r\n\r\n* Collision Warning (franeaza pentru evitarea unei coliziuni frontale)\r\n\r\n\r\n* Pedestrian Alert\r\n\r\n\r\n* Citeste indicatoarele rutiere\r\n\r\n\r\n* PARK ASSIST\r\n\r\n\r\n* Camera spate\r\n\r\n\r\n* SCAUNE FULL ELECTRICE\r\n\r\n\r\n* Navigatie mare 4D ( harta României )\r\n\r\n\r\n* TouchpadD\r\n\r\n\r\n* COLILISION WARNING\r\n\r\n\r\n* PEDESTRIAN ALERT ACTIVE\r\n\r\n\r\n* SISTEM AUDIO MERIDIAN\r\n\r\n\r\n• Apple CarPlay\r\n\r\n\r\n• Android Auto\r\n\r\n\r\n• Airbag genunchi\r\n\r\n\r\n• Sistem de apel de urgenta\r\n\r\n\r\n• Sistem de monitorizare a presiunii in roti\r\n\r\n\r\n• Asistent pentru limitarea vitezei\r\n\r\n\r\n• Asistent adaptiv pentru faza lunga Plus\r\n\r\n\r\n• Lumina ambientala\r\n\r\n\r\n• Oglinda cu efect antiorbire cu activare automata\r\n\r\n\r\n• Oglinzi exterioare rabatabile electric\r\n\r\n\r\n• Geamuri laminate cu izolare acustica si reflectarea razelor IR\r\n\r\n\r\n• Touchpad', 0, '2025-12-08 16:47:54', 'https://images.unsplash.com/photo-1553440569-bcc63803a83d?w=800&h=600&fit=crop&crop=center');

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
(2, 'cosminbrj', 'cosminbrj@gmail.com', '$2y$10$3ov47/CQwC2ZCMQJYHx1UeRnMOJK6fLkz1wq6Q3CDiVpBRaoFFUxe', '2026-01-19 09:21:39'),
(3, 'test', 'test@gmail.com', '$2y$10$HLuBbBApA9iJvGKS85n.2Ohy7iNVIMiRjiClHgfyJRxU.qw7W4TvK', '2026-01-23 08:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `vizualizari`
--

CREATE TABLE `vizualizari` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `masina_id` int(11) NOT NULL,
  `viewed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vizualizari`
--

INSERT INTO `vizualizari` (`id`, `user_id`, `masina_id`, `viewed_at`) VALUES
(1, 3, 1, '2026-01-23 10:54:09'),
(2, 3, 6, '2026-01-23 11:31:02'),
(19, 3, 2, '2026-01-23 10:54:18'),
(24, 3, 3, '2026-01-23 10:42:31'),
(26, 3, 4, '2026-01-23 10:52:15'),
(29, 3, 10, '2026-01-23 11:03:10'),
(32, 3, 5, '2026-01-23 11:03:01'),
(37, 3, 7, '2026-01-23 11:25:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_fav` (`user_id`,`masina_id`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_masina` (`masina_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_masini_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vizualizari`
--
ALTER TABLE `vizualizari`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_view` (`user_id`,`masina_id`),
  ADD KEY `idx_user_time` (`user_id`,`viewed_at`),
  ADD KEY `idx_masina` (`masina_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imagini_masini`
--
ALTER TABLE `imagini_masini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `masini`
--
ALTER TABLE `masini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vizualizari`
--
ALTER TABLE `vizualizari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
