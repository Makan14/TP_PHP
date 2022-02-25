-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 04 fév. 2022 à 11:09
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `makan`
--

-- --------------------------------------------------------

--
-- Structure de la table `advert`
--

CREATE TABLE `advert` (
  `id_advert` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `postal_code` int(5) NOT NULL,
  `city` varchar(70) NOT NULL,
  `type` enum('vente / location') NOT NULL,
  `price` int(11) NOT NULL,
  `reservation_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id_advert`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `advert`
--
ALTER TABLE `advert`
  MODIFY `id_advert` int(3) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
