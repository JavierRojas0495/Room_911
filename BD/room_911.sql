-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-09-2024 a las 05:43:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `room_911`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `city`
--

CREATE TABLE `city` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `city`  
--

INSERT INTO `city` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Buenos Aires', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(2, 'Córdoba', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(3, 'Rosario', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(4, 'Mendoza', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(5, 'La Plata', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(6, 'Salta', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(7, 'Santa Fe', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(8, 'Mar del Plata', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(9, 'San Juan', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(10, 'Neuquén', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(11, 'Tucumán', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(12, 'San Miguel de Tucumán', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(13, 'Bahía Blanca', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(14, 'La Rioja', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(15, 'Corrientes', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(16, 'Posadas', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(17, 'Jujuy', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(18, 'Formosa', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(19, 'San Luis', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(20, 'Rawson', 1, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(21, 'Río de Janeiro', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(22, 'São Paulo', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(23, 'Brasilia', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(24, 'Salvador', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(25, 'Fortaleza', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(26, 'Belo Horizonte', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(27, 'Manaos', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(28, 'Curitiba', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(29, 'Recife', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(30, 'Porto Alegre', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(31, 'Belém', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(32, 'Goiânia', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(33, 'Campinas', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(34, 'São Luís', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(35, 'Guarulhos', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(36, 'São Gonçalo', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(37, 'Maceió', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(38, 'Campo Grande', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(39, 'Natal', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(40, 'Teresina', 2, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(41, 'Bogotá', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(42, 'Medellín', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(43, 'Cali', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(44, 'Barranquilla', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(45, 'Cartagena', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(46, 'Cúcuta', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(47, 'Soledad', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(48, 'Ibagué', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(49, 'Bucaramanga', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(50, 'Santa Marta', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(51, 'Villavicencio', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(52, 'Pasto', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(53, 'Manizales', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(54, 'Neiva', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(55, 'Pereira', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(56, 'Montería', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(57, 'Popayán', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(58, 'Valledupar', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(59, 'Quibdó', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(60, 'Armenia', 3, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(61, 'Ciudad de México', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(62, 'Guadalajara', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(63, 'Monterrey', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(64, 'Puebla', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(65, 'Tijuana', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(66, 'León', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(67, 'Juárez', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(68, 'Zapopan', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(69, 'Mérida', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(70, 'Mexicali', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(71, 'Acapulco', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(72, 'Toluca', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(73, 'Cancún', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(74, 'Querétaro', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(75, 'Morelia', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(76, 'Culiacán', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(77, 'Hermosillo', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(78, 'Chihuahua', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(79, 'Durango', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(80, 'Saltillo', 4, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(81, 'Madrid', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(82, 'Barcelona', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(83, 'Valencia', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(84, 'Sevilla', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(85, 'Zaragoza', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(86, 'Málaga', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(87, 'Murcia', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(88, 'Palma de Mallorca', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(89, 'Bilbao', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(90, 'Alicante', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(91, 'Córdoba', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(92, 'Valladolid', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(93, 'Almería', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(94, 'León', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(95, 'Soria', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(96, 'Oviedo', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(97, 'La Coruña', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(98, 'Gijón', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(99, 'Logroño', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(100, 'Pamplona', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(101, 'La Rioja', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(102, 'A Coruña', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(103, 'Toledo', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(104, 'Segovia', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(105, 'Badajoz', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(106, 'Jaén', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(107, 'Ávila', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(108, 'Ciudad Real', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(109, 'Cáceres', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(110, 'Huelva', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(111, 'Albacete', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(112, 'Ceuta', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(113, 'Melilla', 5, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(114, 'Paris', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(115, 'Marseille', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(116, 'Lyon', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(117, 'Toulouse', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(118, 'Nice', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(119, 'Nantes', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(120, 'Strasbourg', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(121, 'Montpellier', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(122, 'Bordeaux', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(123, 'Lille', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(124, 'Rennes', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(125, 'Le Havre', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(126, 'Reims', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(127, 'Le Mans', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(128, 'Amiens', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(129, 'Clermont-Ferrand', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(130, 'Saint-Étienne', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(131, 'Le Creusot', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(132, 'Chalon-sur-Saône', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(133, 'Auxerre', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(134, 'Pau', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(135, 'Dijon', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(136, 'Grenoble', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(137, 'Chambéry', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(138, 'Moulins', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(139, 'Nevers', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(140, 'Aix-en-Provence', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(141, 'Épinal', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(142, 'Béziers', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(143, 'La Roche-sur-Yon', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(144, 'Quimper', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(145, 'Vichy', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(146, 'Colmar', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(147, 'Saint-Malo', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(148, 'Perpignan', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(149, 'Cavaillon', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(150, 'Rodez', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(151, 'Saint-Quentin', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(152, 'Thionville', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(153, 'Sète', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(154, 'Dole', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(155, 'Dunkerque', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(156, 'Belfort', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(157, 'Tarbes', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(158, 'Niort', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(159, 'Châteauroux', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(160, 'Chalon-sur-Saône', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(161, 'Échirolles', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(162, 'Montargis', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(163, 'Échirolles', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(164, 'La Rochelle', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(165, 'Moulins', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(166, 'Saint-Nazaire', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(167, 'Thonon-les-Bains', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(168, 'Epernay', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(169, 'Aix-en-Provence', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(170, 'Aubagne', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(171, 'Arles', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(172, 'Bagnères-de-Bigorre', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(173, 'Chambéry', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(174, 'Dijon', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(175, 'Épinal', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(176, 'Saint-Denis', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(177, 'Périgueux', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(178, 'Bourg-en-Bresse', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(179, 'Auxerre', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(180, 'Dijon', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(181, 'Chalon-sur-Saône', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(182, 'Vichy', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(183, 'Châteauroux', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(184, 'Nevers', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(185, 'Moulins', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(186, 'Vienne', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(187, 'Cahors', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(188, 'Bourges', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(189, 'Saint-Omer', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(190, 'Nevers', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(191, 'Limoges', 6, '2024-09-10 03:44:55', '2024-09-10 03:44:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE `country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Argentina', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(2, 'Brasil', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(3, 'Colombia', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(4, 'México', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(5, 'España', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(6, 'Francia', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(7, 'Italia', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(8, 'Australia', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(9, 'Canadá', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(10, 'Japón', '2024-09-10 03:44:55', '2024-09-10 03:44:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departament`
--

CREATE TABLE `departament` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departament`
--

INSERT INTO `departament` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Informatica', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(2, 'Desarrollo', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(3, 'Administracion', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(4, 'Logistica', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(5, 'Contabilidad', '2024-09-10 03:44:55', '2024-09-10 03:44:55'),
(6, 'Recursos Humanos', '2024-09-10 03:44:55', '2024-09-10 03:44:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE `employee` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `departament_id` bigint(20) UNSIGNED NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `document_number`, `phone_number`, `country_id`, `city_id`, `departament_id`, `birthdate`, `address`, `email`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Javier Andrés', 'Rojas Erazo', '1144192322', '3173280247', 3, 58, 2, '2024-09-09', 'Cl. 46 #10-51', 'jare_123@hotmail.es', 1, '2024-09-10 05:25:42', '2024-09-11 08:32:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `attempt_on_date` date NOT NULL,
  `attempt_in_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(22, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(23, '2024_09_04_175500_country', 1),
(24, '2024_09_04_175724_migratedcity', 1),
(25, '2024_09_04_210000_createdepartmentstable', 1),
(26, '2024_09_04_220000_createemployeetable', 1),
(27, '2024_09_05_051251_createusertable', 1),
(28, '2024_09_07_014255_create_login_logs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `document_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `document_number`, `password`, `email`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Life File Admin', 'Admin', '12345678', '$2y$10$dqrLzJSYWYIV5I8oNsLfn.FOBVsUbpsbzuD/YoqTZ6CsDm63/9xlO', 'prueba@lifefile.com', 1, '2024-09-11 08:07:06', '2024-09-11 08:07:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_country_id_foreign` (`country_id`);

--
-- Indices de la tabla `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departament`
--
ALTER TABLE `departament`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_document_number_unique` (`document_number`),
  ADD UNIQUE KEY `employee_email_unique` (`email`),
  ADD KEY `employee_country_id_foreign` (`country_id`),
  ADD KEY `employee_city_id_foreign` (`city_id`),
  ADD KEY `employee_departament_id_foreign` (`departament_id`);

--
-- Indices de la tabla `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_document_number_unique` (`document_number`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `city`
--
ALTER TABLE `city`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT de la tabla `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `departament`
--
ALTER TABLE `departament`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Filtros para la tabla `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `employee_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `employee_departament_id_foreign` FOREIGN KEY (`departament_id`) REFERENCES `departament` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
