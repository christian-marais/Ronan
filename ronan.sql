-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 09 avr. 2023 à 16:17
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ronan`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `lister_intervention` ()   SELECT * FROM intervention 
    INNER JOIN user
    ON user.id_user = intervention.id_user
    INNER JOIN client
    ON client.id_cli = intervention.id_cli$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `idProd` int NOT NULL,
  `libProd` varchar(40) NOT NULL,
  `alaune` tinyint(1) DEFAULT '0',
  `descProd` varchar(200) NOT NULL,
  `nomImage` varchar(255) DEFAULT NULL,
  `ordre` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idProd`, `libProd`, `alaune`, `descProd`, `nomImage`, `ordre`) VALUES
(2, '1', 1, 'xcvxcv', 'jpg', 1),
(16, '4', 1, 'jpg', 'jpg', 4),
(17, '5', 1, 'xcv', 'jpg', 5),
(18, '6', 1, '', 'jpg', 6),
(19, '7', 1, 'k', 'gif', 7),
(20, '8', 1, '', 'jpg', 8),
(21, '9', 1, '', 'jpg', 9),
(23, '11', 1, '', 'jpg', 11),
(26, '14', 1, '', 'jpg', 14),
(27, '15', 1, '', 'jpg', 15),
(28, '16', 1, '', 'jpg', 16),
(29, '17', 1, '', 'jpg', 17),
(30, '18', 1, '', 'jpg', 18),
(31, '19', 1, '', 'jpg', 19),
(32, '20', 1, '', 'jpg', 20),
(33, '21', 1, '', 'jpg', 21),
(34, '22', 1, '', 'jpg', 22);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_user` varbinary(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `password_user`) VALUES
('christian', 0xf9e3e5fe248df9d0820828bd647ec55d);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`idProd`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `idProd` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
