-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 07 mars 2024 à 22:58
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
-- Base de données : `lbc`
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
(4, 'Iphone Pro Max', 2, '2024-03-07 21:32:13', 'je  vend mon iphone pro max ', 'image/annonce/4.png', 1, 300, 'Satisfaisant', 1, 0, 0, 1709843533),
(5, '', 2, '2024-03-07 22:44:04', 'je vend mon bafle bluettoh', 'image/annonce/.png', 5, 40, 'Neuf', 0, 0, 0, 1709847844),
(6, 'vent mon pc de bureau ', 3, '2024-03-07 22:51:19', 'je vend mon pc de bureau en  bonne Etat', 'image/annonce/vent mon pc de bureau .png', 3, 400, 'Très bon état', 0, 0, 0, 1709848279),
(7, 'Iphone Pro Max', 2, '2024-03-07 22:52:32', 'je  vend mon iphone pro max ', 'image/annonce/Iphone Pro Max.png', 5, 300, 'Neuf', 0, 0, 0, 1709848352);

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
(5, 7, 3, 2, 1709848397),
(4, 4, 3, 2, 1709844520);

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
(9, 4, 3);

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
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idm`, `idu_q`, `idu_r`, `idc`, `contenu`, `time`) VALUES
(7, 3, 2, 3, 'salut j\'ai besoin de cette annonce\r\n', 1709840639),
(8, 2, 3, 3, 'OUI SALUT JE VEND MON PC A 400', 1709840666),
(9, 3, 2, 4, 'salut c\'est telephone est à combien?\r\n', 1709844520),
(10, 2, 3, 4, 'j\'ai le vend pas vraiment chers ', 1709844569),
(11, 3, 2, 5, 'salut comment tu va', 1709848397);

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
(1, 'ONDIYO', 'CHRISTIAN', 'ondiyochristian12@gmail.com', '0758982621', '90969477f146f6152151fa2737151b07', '102 ', '102 rue de strasbourg', 'Le mée-sur-seine', '77350', 'image/avatar/1.png', 0),
(2, 'NZINGA', 'Liza', 'lizanzinga920@gmail.com', '0815684828', '7b38a17a4fbc6b19bf118dcdf2e18845', '12', 'Commune/ Nsele Kinkole efobanc tunnel avenue/Bonge', 'Kinshasa', '2112', 'image/avatar/2.png', 0),
(3, 'ONDIYO', 'CHRISTIAN', 'christianondiyo78@gmail.com', '0815684828', '90969477f146f6152151fa2737151b07', '12', 'Av/ likolo numéro 36 Q/kimbuta C/ N\'sele', 'Kinshasa', '245', 'image/avatar/3.png', 0);

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
  MODIFY `ida` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `idf` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idm` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
