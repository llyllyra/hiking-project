-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql:3306
-- Généré le : ven. 22 juil. 2022 à 14:08
-- Version du serveur : 8.0.29
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `hiking`
--
CREATE DATABASE IF NOT EXISTS `hiking` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `hiking`;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` bigint UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `CreatedDate` date NOT NULL,
  `updatedDate` date DEFAULT NULL,
  `hike_id` bigint UNSIGNED NOT NULL,
  `user__id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `difficulty`
--

DROP TABLE IF EXISTS `difficulty`;
CREATE TABLE `difficulty` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `difficulty`
--

INSERT INTO `difficulty` (`id`, `name`) VALUES
(1, 'très facile'),
(2, 'facile');

-- --------------------------------------------------------

--
-- Structure de la table `hikes`
--

DROP TABLE IF EXISTS `hikes`;
CREATE TABLE `hikes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdDate` date NOT NULL,
  `distance` float NOT NULL,
  `duration` decimal(10,0) NOT NULL,
  `elevationGain` float NOT NULL,
  `description` text NOT NULL,
  `imgUrl` varchar(255) DEFAULT NULL,
  `updateDate` int DEFAULT NULL,
  `user_Id` bigint UNSIGNED NOT NULL,
  `departure` varchar(255) NOT NULL,
  `arrive` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `hikes`
--

INSERT INTO `hikes` (`id`, `name`, `createdDate`, `distance`, `duration`, `elevationGain`, `description`, `imgUrl`, `updateDate`, `user_Id`, `departure`, `arrive`) VALUES
(1, 'D\'une rive à l\'autre d\'un méandre de la Semois ', '2022-07-22', 7.01, '145', 156, 'Départ : Pont Cassé de Bohan. Stationnement : Place de l\'Église de Bohan\r\n\r\n(D/A) Depuis le Pont Cassé, partir vers l\'ancien tunnel du vicinal, traverser puis franchir la Semois sur l\'ancien Pont Cassé de Membre.\r\nCes deux ouvrages viennent d\'être remis en état afin d\'en permettre une utilisation de loisir.\r\n\r\n(1) Le camping à gauche, rejoindre une petite route goudronnée (Promenade du Sautou).\r\nPartir à gauche sur cette petite route pour longer le camping et approcher la Semois aussitôt la station d\'épuration.\r\n\r\n(2) Longer la rivière puis, après une courbe en épingle, arriver à une fourche (ce croisement est le nœud de la Promenade du Sautou : l\'aller à droite, le retour à gauche).\r\n\r\n(3) Se diriger sur le chemin à gauche jusqu\'au lit d\'un petit ruisseau.\r\n\r\n(4) À cet endroit, le chemin devient un sentier rocailleux qui domine la Semois.\r\nQuelques passages en dévers agrémentent le sentier.\r\nLe sentier atteint le Ruisseau de Ransnimont, le traverse, et dévale tranquillement vers la Semois à sa confluence avec le Ruisseau du Sautou.\r\n\r\n(5) Franchir la Semois sur la passerelle éphémère puis, par le Chemin de Kelhan, traverser la plaine alluviale.\r\nÀ l\'orée du bois, emprunter un raidillon à gauche qui rejoint deux chemins en surplomb.\r\nPartir à gauche sur le deuxième, marcher 200 m jusqu\'à un petit sentier étroit à droite le long d\'une clôture\r\n(panneau de lieu-dit sur la gauche).\r\n\r\n(6) Monter à la Table des Fées, petit promontoire et point de vue sur la vallée, et poursuivre jusqu\'au Châtelet.\r\nLe sentier monte, entre ces deux points, dans la cheminée, passage étroit entre les blocs rocheux\r\n\r\n(7) Poursuivre sur la crête, délaisser deux larges chemins descendant à gauche et descendre à la N914.\r\n\r\n(8) Poursuivre en face, retrouver la N914.\r\nPartir à droite puis à gauche 50 m plus loin. Retrouver le bord de Semois et, à droite, le Pont Cassé (D/A).', NULL, NULL, 1, 'Pont Cassé de Bohan', 'Pont Cassé de Bohan'),
(2, 'Vresse-sur-Semois - Membre en suivant la Semois ', '2022-07-21', 9.17, '185', 174, '\r\nDescription de la randonnée\r\n\r\nParquer à la sortie du village de Vresse-sur-Semois en direction de Membre (parking sous la chapelle, le long de la route principale).\r\n\r\n(D) Du parking, partir en direction du centre de Vresse (Rue Albert Raty) et prendre le pont Saint-Lambert sur la Semois à droite, alors que la rue principale fait un coude à gauche. Monter en direction du village de La Forêt.\r\n\r\n(1) Juste après la deuxième habitation (à droite) et le cimetière (à gauche), prendre le chemin à droite s\'étirant le long d\'une haie. Celui-ci tourne à angle droit après une cinquantaine de mètres. Prendre ensuite directement à droite après être passé sous le grand sapin. Le chemin se rétrécit progressivement pour devenir un sentier qui finit par rentrer sous les bois. A la rencontre du chemin forestier qui se présente de face et remonte vers la droite, aller tout droit et longer la Semois sur 4km. Le chemin forestier devient goudronné à son extrémité et arrive sur la N935 au village de Membre.\r\n\r\n(2) Attention : circulation automobile. Prendre à droite et traverser le pont. Monter tout droit, passer sur le sentier à droite de l\'église, qui rejoint alors une rue qui continue à monter. Prendre ensuite la première route à droite (\"Centre de Vacances des Hochets\"). Marcher jusqu\'au bout de cette route, qui passe sous les rangées de maisons de vacances.\r\n\r\n(3) Au bout de la route, prendre la volée d\'escaliers à gauche qui passe derrière la dernière rangée d\'appartements. Emprunter le sentier (GR®) qui part à droite avant la deuxième volée d\'escaliers. Le suivre sur 2,3 km (négliger le sentier qui redescend vers la droite après 500m ainsi que celui qui arrive de derrière à gauche après 1,5 km).\r\n\r\n(4) A l\'intersection avec la route goudronnée (Rue de la Chapelle), prendre à droite et descendre celle-ci sur 1,5km, jusqu\'en bas. Le parking se trouve en contre-bas de la chapelle (D/A).\r\n', NULL, NULL, 1, 'Parking sous la chapelle', 'Parking sous la chapelle');

-- --------------------------------------------------------

--
-- Structure de la table `hikesTag`
--

DROP TABLE IF EXISTS `hikesTag`;
CREATE TABLE `hikesTag` (
  `id` bigint UNSIGNED NOT NULL,
  `hike_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `hikesTag`
--

INSERT INTO `hikesTag` (`id`, `hike_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `level`
--

DROP TABLE IF EXISTS `level`;
CREATE TABLE `level` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'montagne'),
(2, 'plaine');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `nickname`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.fr', 'admin', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `difficulty`
--
ALTER TABLE `difficulty`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `hikes`
--
ALTER TABLE `hikes`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `userHike` (`user_Id`);

--
-- Index pour la table `hikesTag`
--
ALTER TABLE `hikesTag`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `tagName` (`tag_id`),
  ADD KEY `TagHikes` (`hike_id`);

--
-- Index pour la table `level`
--
ALTER TABLE `level`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `difficulty`
--
ALTER TABLE `difficulty`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `hikes`
--
ALTER TABLE `hikes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `hikesTag`
--
ALTER TABLE `hikesTag`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `level`
--
ALTER TABLE `level`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `hikes`
--
ALTER TABLE `hikes`
  ADD CONSTRAINT `userHike` FOREIGN KEY (`user_Id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `hikesTag`
--
ALTER TABLE `hikesTag`
  ADD CONSTRAINT `TagHikes` FOREIGN KEY (`hike_id`) REFERENCES `hikes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tagName` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
