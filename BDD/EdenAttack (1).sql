-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : jeu. 29 juin 2023 à 07:38
-- Version du serveur : 8.0.29
-- Version de PHP : 8.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `EdenAttack`
--

-- --------------------------------------------------------

--
-- Structure de la table `Class`
--

CREATE TABLE `Class` (
  `ID_Class` int NOT NULL,
  `Name_Class` varchar(255) NOT NULL,
  `Attack` int NOT NULL,
  `HP` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Class`
--

INSERT INTO `Class` (`ID_Class`, `Name_Class`, `Attack`, `HP`) VALUES
(1, 'Buccaneer', 55, 75),
(2, 'Mage', 60, 80),
(3, 'Gunner', 100, 50),
(4, 'Cowboy', 60, 70),
(5, 'Hazel', 45, 100),
(6, 'Cyber', 30, 150);

-- --------------------------------------------------------

--
-- Structure de la table `Faction`
--

CREATE TABLE `Faction` (
  `ID_Faction` int NOT NULL,
  `AttackChange` int NOT NULL,
  `HPChange` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Faction`
--

INSERT INTO `Faction` (`ID_Faction`, `AttackChange`, `HPChange`) VALUES
(1, 5, 5),
(2, 8, 2),
(3, 2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `Personalized`
--

CREATE TABLE `Personalized` (
  `ID_Personalized` int NOT NULL,
  `Name_Personalized` varchar(255) NOT NULL,
  `ID_Faction` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Personalized`
--

INSERT INTO `Personalized` (`ID_Personalized`, `Name_Personalized`, `ID_Faction`) VALUES
(1, 'Les chevaliers de l\'aube', 1),
(2, 'Les chevaliers des ténèbres', 2),
(3, 'Sentinelles de la lumière', 3),
(7, 'no game no pain', 1),
(8, 'no game no pain', 1);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `ID_User` int NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Level` int NOT NULL,
  `Team` int DEFAULT NULL,
  `ID_Class` int NOT NULL,
  `ID_Personalized` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`ID_User`, `Name`, `Level`, `Team`, `ID_Class`, `ID_Personalized`) VALUES
(1, 'Eric', 2, NULL, 2, 2),
(2, 'Karl', 3, NULL, 3, 2),
(4, 'Morgan', 2, NULL, 3, 2),
(25, 'islem', 1, NULL, 5, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Class`
--
ALTER TABLE `Class`
  ADD PRIMARY KEY (`ID_Class`);

--
-- Index pour la table `Faction`
--
ALTER TABLE `Faction`
  ADD PRIMARY KEY (`ID_Faction`);

--
-- Index pour la table `Personalized`
--
ALTER TABLE `Personalized`
  ADD PRIMARY KEY (`ID_Personalized`),
  ADD KEY `ID_Faction` (`ID_Faction`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`ID_User`),
  ADD KEY `ID_Class` (`ID_Class`),
  ADD KEY `ID_Personalized` (`ID_Personalized`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Class`
--
ALTER TABLE `Class`
  MODIFY `ID_Class` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Faction`
--
ALTER TABLE `Faction`
  MODIFY `ID_Faction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Personalized`
--
ALTER TABLE `Personalized`
  MODIFY `ID_Personalized` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `ID_User` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Personalized`
--
ALTER TABLE `Personalized`
  ADD CONSTRAINT `Personalized_ibfk_1` FOREIGN KEY (`ID_Faction`) REFERENCES `Faction` (`ID_Faction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`ID_Class`) REFERENCES `Class` (`ID_Class`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User_ibfk_2` FOREIGN KEY (`ID_Personalized`) REFERENCES `Personalized` (`ID_Personalized`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
