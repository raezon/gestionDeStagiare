-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 10 sep. 2021 à 22:07
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionstagiare`
--

-- --------------------------------------------------------

--
-- Structure de la table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrateur', '1', 2147483647),
('Employé', '16', 1629295069);

-- --------------------------------------------------------

--
-- Structure de la table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Administrateur', 1, NULL, NULL, NULL, NULL, NULL),
('Employé', 1, NULL, NULL, NULL, NULL, NULL),
('Responsable', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `centre_detude`
--

CREATE TABLE `centre_detude` (
  `id` int(11) NOT NULL,
  `short_name` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `centre_detude`
--

INSERT INTO `centre_detude` (`id`, `short_name`, `name`, `type`) VALUES
(3, 'inlec', 'bibe central', '1');

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(1) NOT NULL,
  `name_D` varchar(255) NOT NULL,
  `short_name` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `name_D`, `short_name`) VALUES
(54, 'ammar djebabla', 'info');

-- --------------------------------------------------------

--
-- Structure de la table `encadreur`
--

CREATE TABLE `encadreur` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `id_encadreur` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `statu` varchar(30) NOT NULL,
  `numr_telephone` varchar(30) NOT NULL,
  `id_departement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `encadreur`
--

INSERT INTO `encadreur` (`id`, `nom`, `prenom`, `id_encadreur`, `email`, `statu`, `numr_telephone`, `id_departement`) VALUES
(54, 'amar', 'dje', '1', 'amardjebabla10@gmail.com', '1', '0798457017', 54),
(338090, 'djebabla', 'ammar', 's', 'amardjebabla103@gmail.com', 's', '079845701733', 54);

-- --------------------------------------------------------

--
-- Structure de la table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('Da\\User\\Migration\\m000000_000001_create_user_table', 1628498777),
('Da\\User\\Migration\\m000000_000002_create_profile_table', 1628498779),
('Da\\User\\Migration\\m000000_000003_create_social_account_table', 1628498780),
('Da\\User\\Migration\\m000000_000004_create_token_table', 1628498783),
('Da\\User\\Migration\\m000000_000005_add_last_login_at', 1628498784),
('Da\\User\\Migration\\m000000_000006_add_two_factor_fields', 1628498785),
('Da\\User\\Migration\\m000000_000007_enable_password_expiration', 1628498785),
('Da\\User\\Migration\\m000000_000008_add_last_login_ip', 1628498785),
('Da\\User\\Migration\\m000000_000009_add_gdpr_consent_fields', 1628498785),
('m000000_000000_base', 1628498567),
('m140506_102106_rbac_init', 1628498917),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1628498917),
('m180523_151638_rbac_updates_indexes_without_prefix', 1628498917),
('m200409_110543_rbac_update_mssql_trigger', 1628498917),
('m210809_205616_auth_item_insert_role', 1628543116);

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `timezone`, `bio`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

CREATE TABLE `stage` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_debut_du_stage` date NOT NULL,
  `date_fin_du_stage` date NOT NULL,
  `theme_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`id`, `nom`, `date_debut_du_stage`, `date_fin_du_stage`, `theme_id`) VALUES
(55556, 'stage', '2021-08-13', '2021-08-15', '0');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `age` binary(3) NOT NULL,
  `niveaux` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `numr_telephone` binary(30) NOT NULL,
  `adress` varchar(40) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `id_encadreur` int(40) NOT NULL,
  `id_stage` int(11) NOT NULL,
  `id_centre_etude` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `age`, `niveaux`, `email`, `numr_telephone`, `adress`, `specialite`, `id_encadreur`, `id_stage`, `id_centre_etude`) VALUES
(1, 'djebabla', 'ammar', 0x323232, '2', 'amardjebabla10@gmail.com', 0x30373938343537303137efbfbdefbfbdefbfbdefbfbdefbfbdefbfbdefbf, 'ain benaine', 'mi', 54, 55556, 3);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `date_depot` date NOT NULL,
  `type` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `date_depot`, `type`, `version`) VALUES
(6, '2021-08-19', 'app', '1');

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE `token` (
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flags` int(11) NOT NULL DEFAULT 0,
  `confirmed_at` int(11) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  `last_login_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_tf_key` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_tf_enabled` tinyint(1) DEFAULT 0,
  `password_changed_at` int(11) DEFAULT NULL,
  `gdpr_consent` tinyint(1) DEFAULT 0,
  `gdpr_consent_date` int(11) DEFAULT NULL,
  `gdpr_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `unconfirmed_email`, `registration_ip`, `flags`, `confirmed_at`, `blocked_at`, `updated_at`, `created_at`, `last_login_at`, `last_login_ip`, `auth_tf_key`, `auth_tf_enabled`, `password_changed_at`, `gdpr_consent`, `gdpr_consent_date`, `gdpr_deleted`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$KzoIqB0PW5okvVtrfexHpuieQWaamZPTXmhInMVVvgLieKZzUawvK', 'aoQnhizBBgCaRd7u7ZqNCib6eYIBcQUp', NULL, NULL, 0, 1628499281, NULL, 1628499281, 1628499281, 1629282622, NULL, '', 0, 1628499281, 0, NULL, 0),
(4, 'admin32', 'admin32@gmail.com', '$2y$10$jC.rkKjvt2bssxy8A9.SI.mirjQKdew.boD9vlu4ah0By0Q4oj9Za', 'zZL1wuY2eBon7w9CGssa9LZQvRBkC46P', NULL, '::1', 0, 1628880511, NULL, 1628880511, 1628880511, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(5, 'admins', 'Warwick2030@outlook.com', '$2y$10$I/u/CAAqdy/Kyeux9gT55OsZfSdB9qZ4BRg13SyGtj8/GyozUpViG', '9jRD7c2_RGVUftTuuLPg6R-VSIsp8oTP', NULL, '::1', 0, 1628880570, NULL, 1628880570, 1628880570, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(6, 'Warwick2030s', 'Warwick2030s@outlook.com', '$2y$10$3iWViwp7BtzhsEciC.1jBeuvBBSQTP6S.t1tPexF03G.U6qBAnrAe', 'ZafjRr_5Scencr-I9zEeQUWiOm3OIbSG', NULL, '::1', 0, 1628880598, NULL, 1628880598, 1628880598, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(7, 'brahim1233', 'brahim1233@gmail.com', '$2y$10$hJxNcrSkwmwW09.QSlNOmO5vk4aG1BIBV2sNvRvoqhJhx4ZwjYu/C', 'bB3WfjDbn5m6Qepbr6ZvO7e1u-CRQnaj', NULL, '::1', 0, 1628885834, NULL, 1628885834, 1628885834, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(8, 'btrahf', 'btrahf@gmail.com', '$2y$10$EPdQv7Wi2/KHPCRAH1aBgeJ5cRT5JrnHCKAtUoNFw9sT19CgnxMjC', 'NfJe8wZejF7Fa_RADwIK_E-RH0to_PU0', NULL, '::1', 0, 1629287863, NULL, 1629287864, 1629287864, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(9, 'amardjebabla10222', 'amardjebabla10222@gmail.com', '$2y$10$JhBy4qo0QDEb7FvG8j8ceusxZ9pFyu0Wl1gq0YegHX4/f36nUcuhG', 'VeDAwe1fdw9GS5njNL8r1ijNQCZF3vg3', NULL, '::1', 0, 1629288005, NULL, 1629288005, 1629288005, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(10, 'dfdfdddfffffff', 'dfdfdddfffffff@gmail.com', '$2y$10$KvdhL7srqazp7IN4uHR6ROJOxl.W.zhAjob1xNaU0XKp3rYbFYrHO', 'SgeyWMbtTod1uXhv7cpHqWHiUMhWKvZ2', NULL, '::1', 0, 1629294777, NULL, 1629294777, 1629294777, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(11, 'dfdfdddfffffffs', 'dfdfdddfffffffs@gmail.com', '$2y$10$b5LgNvohcCHgQyFSyYxmAuhfZUYYrvcN6tNbPsNZAUR4eJVmhQ7SG', 'Z3-9USEFsucd6amPNZAnnGStCpSroTNs', NULL, '::1', 0, 1629294906, NULL, 1629294906, 1629294906, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(12, 'dfdfdddfffffffss', 'dfdfdddfffffffss@gmail.com', '$2y$10$sSG7/2AmFRlD0gXVfH9e7O4JtZiwYOOH12B5KN0cW5PQBSWV38n9O', '99Y4OxOhc5CJw3iTqkj6DpL0BwxhT92t', NULL, '::1', 0, 1629294939, NULL, 1629294939, 1629294939, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(13, 'dfdfdddfffffffsss', 'dfdfdddfffffffsss@gmail.com', '$2y$10$P5IG7zG8lNslFMt3853P9OuwL.qcyloXImyJ57PyFJsIYTaLCoq5y', 'H6ddmc8P6yl3pR2acuUFLEkGdFLfkXkF', NULL, '::1', 0, 1629294960, NULL, 1629294960, 1629294960, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(14, 'dfdfdddfffffffssss', 'dfdfdddfffffffssss@gmail.com', '$2y$10$zS1A1n/xMSeLXVSDVVL9w.Kkso7WTGDtnFfwHS7CFwdMa6Y9xrgcS', '8iR3ZMgiLRZgIXbDJ_Qr3LFNMzOBr0oD', NULL, '::1', 0, 1629294996, NULL, 1629294996, 1629294996, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(15, 'dfdfdddfffffffsssss', 'dfdfdddfffffffsssss@gmail.com', '$2y$10$R47CZ7/c2ZJ5NKeWUZy9/uNK7YNlkEOJVDxyA4DDc22wu7If8kXsi', 'NhrMx10fMbPOtLSLIC3bWYsZkSRibnxn', NULL, '::1', 0, 1629295032, NULL, 1629295032, 1629295032, NULL, NULL, '', 0, NULL, 0, NULL, 0),
(16, 'ffffffffffffffffff', 'ffffffffffffffffff@gmail.com', '$2y$10$KmjFt/plrXG3vJPysC.jSe4txHarj6sLzI6FLknxAPTcM0rULD.uK', 'dBRpwY9BRHHXiqn31kHH3raZ_Y6RhIOQ', NULL, '::1', 0, 1629295069, NULL, 1629303605, 1629295069, NULL, NULL, '', 0, NULL, 0, NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Index pour la table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Index pour la table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Index pour la table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Index pour la table `centre_detude`
--
ALTER TABLE `centre_detude`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short name` (`short_name`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_D` (`name_D`),
  ADD UNIQUE KEY `short_name` (`short_name`);

--
-- Index pour la table `encadreur`
--
ALTER TABLE `encadreur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `numr_telephone` (`numr_telephone`),
  ADD KEY `encadreur_fk0` (`id_departement`);

--
-- Index pour la table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_social_account_provider_client_id` (`provider`,`client_id`),
  ADD UNIQUE KEY `idx_social_account_code` (`code`),
  ADD KEY `fk_social_account_user` (`user_id`);

--
-- Index pour la table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `niveaux` (`niveaux`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `numr_telephone` (`numr_telephone`),
  ADD UNIQUE KEY `adress` (`adress`),
  ADD KEY `stagiaire_fk0` (`id_encadreur`),
  ADD KEY `stagiaire_fk1` (`id_stage`),
  ADD KEY `stagiaire_fk2` (`id_centre_etude`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `idx_token_user_id_code_type` (`user_id`,`code`,`type`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_username` (`username`),
  ADD UNIQUE KEY `idx_user_email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `centre_detude`
--
ALTER TABLE `centre_detude`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `encadreur`
--
ALTER TABLE `encadreur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338091;

--
-- AUTO_INCREMENT pour la table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stage`
--
ALTER TABLE `stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55557;

--
-- AUTO_INCREMENT pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33833;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8901;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `encadreur`
--
ALTER TABLE `encadreur`
  ADD CONSTRAINT `encadreur_fk0` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id`);

--
-- Contraintes pour la table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_social_account_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `stagiaire_fk0` FOREIGN KEY (`id_encadreur`) REFERENCES `encadreur` (`id`),
  ADD CONSTRAINT `stagiaire_fk1` FOREIGN KEY (`id_stage`) REFERENCES `stage` (`id`),
  ADD CONSTRAINT `stagiaire_fk2` FOREIGN KEY (`id_centre_etude`) REFERENCES `centre_detude` (`id`);

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_token_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
