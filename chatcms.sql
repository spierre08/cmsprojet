-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 28 Mars 2024 à 03:53
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chatcms`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idm` int(10) UNSIGNED NOT NULL,
  `id_email` varchar(255) DEFAULT NULL,
  `contenu` text,
  `date_envoi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`idm`, `id_email`, `contenu`, `date_envoi`) VALUES
(33, 'ck@gmail.com', 'Salut', '2024-03-18 23:26:56'),
(34, 'spierre@gmail.com', 'Comment vas-tu ?', '2024-03-18 23:27:07'),
(35, 'ck@gmail.com', 'Je vais bien et toi ?', '2024-03-18 23:27:24'),
(36, 'spierre@gmail.com', 'Ouais idem sinon quoi de neuf ?', '2024-03-18 23:27:44'),
(37, 'ck@gmail.com', 'Rien de spécial et de ton côté ?', '2024-03-18 23:28:01'),
(38, 'spierre@gmail.com', 'Rds aussi bro sinon bails go ?', '2024-03-18 23:29:57'),
(39, 'ck@gmail.com', 'Bails mouna bro sauf le dév ', '2024-03-18 23:30:22'),
(40, 'spierre@gmail.com', 'ton maudia\r\n', '2024-03-26 09:09:02'),
(41, 'ck@gmail.com', 'ton maudia pro max', '2024-03-26 09:09:50');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `email`, `mot_de_passe`, `token`) VALUES
(9, 'Simon Pierre Sagno', 'spierre@gmail.com', '$2y$10$Xb3H5doOBxcAraE06Hk2C.3EWcoQZ0j6Sp4Hl5EqACyrPAbUkjD6C', NULL),
(10, 'Célestin Kpoghomou', 'ck@gmail.com', '$2y$10$5OLynOGtepf9hS0lMRwt8e1khMxMtiFR.LkeP/l.QE7y.76YMrxZG', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idm`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idm` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
