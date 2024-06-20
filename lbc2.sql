-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 juin 2024 à 12:20
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lbc2`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `ida` int(2) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `vendeur` int(2) NOT NULL,
  `date` varchar(30) NOT NULL,
  `detail` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `categorie` int(2) NOT NULL,
  `prix` int(10) NOT NULL,
  `etat` varchar(40) NOT NULL,
  `favoris` int(4) NOT NULL,
  `livraison` int(2) NOT NULL,
  `vue` int(6) NOT NULL,
  `time` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`ida`, `titre`, `vendeur`, `date`, `detail`, `photo`, `categorie`, `prix`, `etat`, `favoris`, `livraison`, `vue`, `time`) VALUES
(8, 'Samsung A50', 3, '2024-06-19 16:56:02', 'je vend mon phone  en  bonne Etat', 'image/annonce/Samsung A50.png', 1, 40, 'Neuf', 3, 0, 0, 1718830562),
(9, 'IPad Air 2128gb', 3, '2024-06-19 17:22:02', 'iPad Air 2 128gb Batterie changer en juin 2024 (facture)  Avec câble de chargement En livraison ou sur Strasbourg', 'image/annonce/IPad Air 2128gb batterie neuf (facture).png', 1, 200, 'Neuf', 0, 0, 0, 1718832122),
(10, 'Samsung S23 ultra', 3, '2024-06-19 17:32:25', 'je vend mon telephone bon prix', 'image/annonce/Samsung S23 ultra.png', 1, 500, 'Neuf', 0, 0, 0, 1718832745),
(11, 'PlayStation 4 PRO', 5, '2024-06-19 18:16:40', 'Vente PlayStation 4pro Comprend une manette, un câble d\'alimentation, un câble hdmi et un câble microusb. Tout fonctionne, la console est en très bon état.', 'image/annonce/11.png', 5, 500, 'Bon état', 0, 0, 0, 1718835398),
(12, 'Pc Portable  Asus', 4, '2024-06-19 18:23:53', 'je vend mon pc Asus Moins chers ', 'image/annonce/Pc Portable  Asus.png', 2, 180, 'Neuf', 0, 0, 0, 1718835832),
(13, 'PS5 PRO ', 4, '2024-06-19 18:28:11', 'je vend mA PS5', 'image/annonce/PS5 PRO .png', 5, 400, 'Très bon état', 0, 0, 0, 1718836089);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idc` int(2) NOT NULL,
  `nomCat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idc`, `nomCat`) VALUES
(1, 'Téléphones mobiles'),
(2, 'Ordinateurs portables'),
(3, 'Ordinateurs de bureau '),
(4, 'Tablettes '),
(5, 'Accessoires électroniques');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `idc` int(11) NOT NULL,
  `idan` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `idv` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`idc`, `idan`, `idu`, `idv`, `time`) VALUES
(5, 8, 5, 3, 1718837012),
(4, 8, 4, 3, 1718836923);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `idf` int(4) NOT NULL,
  `ida` int(2) NOT NULL,
  `idu` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`idf`, `ida`, `idu`) VALUES
(7, 8, 4),
(8, 8, 5);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idm` int(2) NOT NULL,
  `idu_q` int(2) NOT NULL,
  `idu_r` int(2) NOT NULL,
  `idc` int(2) NOT NULL,
  `contenu` text NOT NULL,
  `time` int(11) NOT NULL,
  `lu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idm`, `idu_q`, `idu_r`, `idc`, `contenu`, `time`, `lu`) VALUES
(8, 4, 3, 4, 'Salut j\'aimerai l\'acheter svp', 1718836923, 1),
(9, 3, 4, 4, 'Oui on peux se fixe rendez-vous', 1718836964, 1),
(10, 5, 3, 5, 'j\'aime bien\r\n', 1718837012, 1),
(11, 3, 5, 5, 'oui tu veux l\'acheter?', 1718837051, 0),
(12, 3, 4, 4, 'tu veux l\'acheter ou pas', 1718838720, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idu` int(2) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `numRue` varchar(10) NOT NULL,
  `nomRue` varchar(50) NOT NULL,
  `nomVille` varchar(30) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `statue` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idu`, `nom`, `prenom`, `mail`, `tel`, `mdp`, `numRue`, `nomRue`, `nomVille`, `cp`, `avatar`, `statue`) VALUES
(3, 'ONDIYO', 'CHRISTIAN', 'ondiyochristian10@gmail.com', '0758982621', '3072d80b350895e1bae05ccfe8b8a931', '12', '102 RUE DE STRASBOURG', 'LE MEE SUR SEINE', '77350', 'image/avatar/3.png', 0),
(4, 'Ondiyo', 'Christian', 'ondiyochristian12@gmail.com', '0758982621', '90969477f146f6152151fa2737151b07', '102', '102 rue de Strasbourg', 'Le mée sur seine', '77350', 'image/avatar/4.png', 0),
(5, 'NZINGA', 'Liza', 'lizanzinga920@gmail.com', '0815684828', '90969477f146f6152151fa2737151b07', '14', 'Commune/ Nsele Kinkole efobanc tunnel avenue/Bonge', 'Kinshasa', '2112', NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`ida`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idc`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`idc`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`idf`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idm`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idu`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `ida` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idc` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `idf` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idm` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
