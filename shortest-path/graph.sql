-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Version du serveur :  10.0.26-MariaDB
-- Version de PHP :  7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `graph`
--

-- --------------------------------------------------------

--
-- Structure de la table `chemins`
--

CREATE TABLE `chemins` (
  `ville1` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ville2` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `dist` decimal(10,2) UNSIGNED NOT NULL COMMENT 'Km',
  `temps` int(10) UNSIGNED NOT NULL COMMENT 'Heures',
  `etapes` text COLLATE utf8_unicode_ci NOT NULL,
  `comp` enum('DIST','TEMPS') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `chemins`
--

INSERT INTO `chemins` (`ville1`, `ville2`, `dist`, `temps`, `etapes`, `comp`) VALUES
('ADL', 'PER', '2695.40', 1638, '[{"ville1":"ADL","ville2":"PER","dist":"2695.40","temps":"27.18","fin":true}]', 'DIST'),
('ADL', 'PER', '2695.40', 1638, '[{"ville1":"ADL","ville2":"PER","dist":"2695.40","temps":"27.18","fin":true}]', 'TEMPS'),
('MEL', 'CNS', '3486.70', 2283, '[{"ville1":"MEL","ville2":"SYD","dist":"877.80","temps":"8.42","fin":false},{"ville1":"SYD","ville2":"BNE","dist":"927.20","temps":"10.15","fin":false},{"ville1":"BNE","ville2":"CNS","dist":"1681.70","temps":"19.06","fin":true}]', 'DIST'),
('MEL', 'CNS', '3486.70', 2283, '[{"ville1":"MEL","ville2":"SYD","dist":"877.80","temps":"8.42","fin":false},{"ville1":"SYD","ville2":"BNE","dist":"927.20","temps":"10.15","fin":false},{"ville1":"BNE","ville2":"CNS","dist":"1681.70","temps":"19.06","fin":true}]', 'TEMPS'),
('MEL', 'DRW', '3759.10', 2509, '[{"ville1":"MEL","ville2":"ADL","dist":"726.90","temps":"8.38","fin":false},{"ville1":"ADL","ville2":"ASP","dist":"1535.40","temps":"16.10","fin":false},{"ville1":"ASP","ville2":"DRW","dist":"1496.84","temps":"17.01","fin":true}]', 'DIST'),
('PER', 'BNE', '5222.90', 3254, '[{"ville1":"PER","ville2":"ADL","dist":"2691.60","temps":"27.19","fin":false},{"ville1":"ADL","ville2":"MEL","dist":"726.30","temps":"7.58","fin":false},{"ville1":"MEL","ville2":"SYD","dist":"877.80","temps":"8.42","fin":false},{"ville1":"SYD","ville2":"BNE","dist":"927.20","temps":"10.15","fin":true}]', 'TEMPS'),
('SYD', 'DRW', '4340.80', 2816, '[{"ville1":"SYD","ville2":"CBR","dist":"286.55","temps":"3.00","fin":false},{"ville1":"CBR","ville2":"ASP","dist":"2557.45","temps":"26.55","fin":false},{"ville1":"ASP","ville2":"DRW","dist":"1496.84","temps":"17.01","fin":true}]', 'DIST'),
('SYD', 'PER', '4298.80', 2677, '[{"ville1":"SYD","ville2":"MEL","dist":"876.50","temps":"8.41","fin":false},{"ville1":"MEL","ville2":"ADL","dist":"726.90","temps":"8.38","fin":false},{"ville1":"ADL","ville2":"PER","dist":"2695.40","temps":"27.18","fin":true}]', 'TEMPS');

-- --------------------------------------------------------

--
-- Structure de la table `vvd`
--

CREATE TABLE `vvd` (
  `ville1` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ville2` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `dist` decimal(10,2) UNSIGNED NOT NULL,
  `temps` decimal(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `vvd`
--

INSERT INTO `vvd` (`ville1`, `ville2`, `dist`, `temps`) VALUES
('ADL', 'ASP', '1535.40', '16.10'),
('ADL', 'MEL', '726.30', '7.58'),
('ADL', 'PER', '2695.40', '27.18'),
('ASP', 'ADL', '1530.84', '16.06'),
('ASP', 'BNE', '2991.64', '33.03'),
('ASP', 'CBR', '2557.59', '26.44'),
('ASP', 'CNS', '2417.04', '27.11'),
('ASP', 'DRW', '1496.84', '17.01'),
('BNE', 'ASP', '2993.50', '33.80'),
('BNE', 'CNS', '1681.70', '19.06'),
('BNE', 'SYD', '921.50', '10.16'),
('CBR', 'ASP', '2557.45', '26.55'),
('CBR', 'MEL', '659.85', '6.41'),
('CBR', 'SYD', '286.35', '3.03'),
('CNS', 'ASP', '2417.80', '27.12'),
('CNS', 'BNE', '1688.40', '19.05'),
('CNS', 'DRW', '2849.60', '32.28'),
('DRW', 'ASP', '1496.10', '17.00'),
('DRW', 'CNS', '2849.10', '32.38'),
('DRW', 'PER', '4039.50', '43.22'),
('MEL', 'ADL', '726.90', '8.38'),
('MEL', 'CBR', '662.15', '6.40'),
('MEL', 'SYD', '877.80', '8.42'),
('PER', 'ADL', '2691.60', '27.19'),
('PER', 'DRW', '4026.90', '42.56'),
('SYD', 'BNE', '927.20', '10.15'),
('SYD', 'CBR', '286.55', '3.00'),
('SYD', 'MEL', '876.50', '8.41');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chemins`
--
ALTER TABLE `chemins`
  ADD PRIMARY KEY (`ville1`,`ville2`,`comp`) USING BTREE,
  ADD KEY `ville2` (`ville2`);

--
-- Index pour la table `vvd`
--
ALTER TABLE `vvd`
  ADD PRIMARY KEY (`ville1`,`ville2`),
  ADD KEY `ville2` (`ville2`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `chemins`
--
ALTER TABLE `chemins`
  ADD CONSTRAINT `chemins_ibfk_1` FOREIGN KEY (`ville1`) REFERENCES `vvd` (`ville1`),
  ADD CONSTRAINT `chemins_ibfk_2` FOREIGN KEY (`ville2`) REFERENCES `vvd` (`ville2`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
