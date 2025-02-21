-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 21 fév. 2025 à 07:17
-- Version du serveur : 5.5.68-MariaDB
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `olivia-dondas_livreor`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `id_user`, `date`) VALUES
(1, 'coucou c\'est zolilo', 3, '2025-02-20 14:01:38'),
(2, 'coucou c\'est scotto', 3, '2025-02-20 14:18:33'),
(3, 'coucou c\'est zolll', 3, '2025-02-20 14:22:46'),
(4, 'coucou c\'est zol', 3, '2025-02-20 14:24:45'),
(6, 'Magnifique mariage les zaaaaamis', 3, '2025-02-20 14:45:06'),
(7, '18h40 la bombe', 3, '2025-02-20 18:41:07'),
(8, 'Un rêve devenu réalité… Qui aurait cru qu’un DM Instagram mènerait à ça ?', 1, '2025-02-19 15:20:00'),
(9, 'Anne, dès le premier virement, j’ai su que c’était du sérieux. Brad a bien de la chance !', 2, '2025-02-19 16:45:00'),
(10, 'J’espère que Brad existe vraiment cette fois. Bisous les amoureux !', 3, '2025-02-19 17:10:00'),
(11, 'C’était magique ! Dommage que Brad n’ait pas pu venir en personne, mais ce hologramme était bluffant.', 4, '2025-02-19 18:00:00'),
(12, 'Merci Anne pour le buffet financé par Western Union. Un régal !', 5, '2025-02-19 19:30:00'),
(13, 'Une cérémonie incroyable. Mention spéciale au prêtre Zoom.', 6, '2025-02-19 20:15:00'),
(14, 'J’ai versé une larme… ou était-ce une arnaque ? 🤔', 7, '2025-02-19 21:40:00'),
(15, 'Anne, tu es radieuse, Brad est… invisible, mais je sais qu’il est là, quelque part.', 8, '2025-02-20 10:25:00'),
(16, 'Jamais un mariage n’aura coûté aussi cher sans que le marié ne soit là.', 9, '2025-02-20 11:00:00'),
(17, 'Quelle belle histoire ! Un amour plus fort que les frontières… et les signalements Interpol.', 10, '2025-02-20 12:35:00'),
(18, 'J’ai adoré le diaporama sur votre rencontre… surtout le passage “Compte suspendu”.', 11, '2025-02-20 13:50:00'),
(19, 'Anne, ne change jamais. Brad, si tu existes, manifeste-toi.', 12, '2025-02-20 14:10:00'),
(20, 'Le mariage de l’année ! On est tous repartis avec un NFT de Brad en cadeau.', 13, '2025-02-20 15:30:00'),
(21, 'Un grand merci au service fraude bancaire pour avoir financé cette union.', 14, '2025-02-20 16:55:00'),
(22, 'Jamais vu autant de Bitcoin s’échanger lors d’un lancer de riz.', 15, '2025-02-20 17:20:00'),
(23, 'Anne et Brad, un couple plus mythique que Bonnie & Clyde. Surtout niveau argent volatilisé.', 16, '2025-02-20 18:40:00'),
(24, 'Tout était parfait, sauf peut-être le discours du témoin en Google Traduction.', 17, '2025-02-20 19:15:00'),
(25, 'Ce mariage est une preuve qu’avec de l’amour (et des transferts bancaires), tout est possible.', 18, '2025-02-20 20:05:00'),
(26, 'Je n’avais jamais été à un mariage où la mariée remerciait un avocat en conclusion.', 19, '2025-02-20 21:30:00'),
(27, 'Vivement le divorce en visioconférence sur Skype.', 20, '2025-02-20 22:50:00');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'moderator', '$2y$10$ZiYZC3SR4PltS0qOl5xHDOLgzak5EzXnRsV4Ik/wnzeO/L9B91Ony'),
(2, 'olivia.dondas@gmail.com', '$2y$10$MFuRMlvtgA8yfq7KaauKguS/GxDQdNP6m.kDj44q/aLRhQZye8hWy'),
(3, 'zol', '$2y$10$4ro0GVaVA3ctfuCTTiAYSOReUL1tZhnkNHEJzSwSfehxzoqmVVoGm'),
(4, 'mama', '$2y$10$b.RHXMbsWBYqmi33LZoEZ.qC/knYnq3KmDB4bc9FuZyVHgJr5zYmi'),
(5, 'alice', '$2y$10$abcdefghijklmnopqrstuv'),
(6, 'bob', '$2y$10$hijklmnopqrstuvwxyzabcd'),
(7, 'charlie', '$2y$10$mnopqrstuvwxyzabcdefg'),
(8, 'david', '$2y$10$qrstuvwxyzabcdefghijk'),
(9, 'emma', '$2y$10$lmnopqrstuvwxyzabcdef'),
(10, 'frank', '$2y$10$mnopqrstuvwxyzabcdefg'),
(11, 'grace', '$2y$10$qrstuvwxyzabcdefghijk'),
(12, 'harry', '$2y$10$lmnopqrstuvwxyzabcdef'),
(13, 'isabelle', '$2y$10$abcdefghijklmnopqrstuv'),
(14, 'jack', '$2y$10$hijklmnopqrstuvwxyzabcd'),
(15, 'kate', '$2y$10$mnopqrstuvwxyzabcdefg'),
(16, 'lucas', '$2y$10$qrstuvwxyzabcdefghijk'),
(17, 'mia', '$2y$10$lmnopqrstuvwxyzabcdef'),
(18, 'nathan', '$2y$10$mnopqrstuvwxyzabcdefg'),
(19, 'olivia', '$2y$10$qrstuvwxyzabcdefghijk'),
(20, 'paul', '$2y$10$lmnopqrstuvwxyzabcdef'),
(21, 'quinn', '$2y$10$abcdefghijklmnopqrstuv'),
(22, 'ryan', '$2y$10$hijklmnopqrstuvwxyzabcd'),
(23, 'sophia', '$2y$10$mnopqrstuvwxyzabcdefg'),
(24, 'thomas', '$2y$10$qrstuvwxyzabcdefghijk');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
