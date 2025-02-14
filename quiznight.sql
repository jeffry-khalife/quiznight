-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 14 fév. 2025 à 13:02
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiznight`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_utilisateur` (`nom_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `nom_utilisateur`, `mot_de_passe`, `email`, `date_creation`) VALUES
(1, 'jeffry', '$2y$10$jtqr0En6F8tdOky6IKQPDe5WywRiMpkmCszS3j5b09r3ugPklTLO.', 'jeffry@gmail.com', '2025-02-14 08:42:18'),
(2, 'magali', '$2y$10$K0nttvLOkoGcKbhPOe/d4uFKHRKKT5.n6lBmPnWHpCqHHcBaU2i3S', 'magali@gmail.com', '2025-02-14 14:01:48'),
(3, 'anna', '$2y$10$ExAQ2fw/5kj2TRjF40X9/OhwKtmIMG5uMmQkPWZL0be2w6OksbPly', 'anna@gmail.com', '2025-02-14 14:01:57'),
(4, 'emilie', '$2y$10$eSrdOHsDWTzZbe8HgSE2V.F7FrQ8gwEFR2A/XVFdBesUKh84j1Yk6', 'emilie@gmail.com', '2025-02-14 14:02:09');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE IF NOT EXISTS `joueur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_joueur` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_joueur` int DEFAULT NULL,
  `id_quiz` int DEFAULT NULL,
  `score` int DEFAULT '0',
  `date_participation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_joueur` (`id_joueur`),
  KEY `id_quiz` (`id_quiz`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int NOT NULL AUTO_INCREMENT,
  `texte_question` text,
  `id_quiz` int DEFAULT NULL,
  `type_question` enum('choix_multiple','vrai_faux') DEFAULT 'choix_multiple',
  PRIMARY KEY (`id`),
  KEY `id_quiz` (`id_quiz`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `texte_question`, `id_quiz`, `type_question`) VALUES
(1, '1. En quelle année a débuté la série Friends ?', 2, 'choix_multiple'),
(2, '2. Quel est le prénom de la sœur jumelle de Phoebe ?', 2, 'choix_multiple'),
(3, '3. Quel est le second prénom de Chandler ?', 2, 'choix_multiple'),
(4, '4. Dans quelle recette Rachel ajoute par erreur de la viande ?', 2, 'choix_multiple'),
(5, '5. A quel âge Monica a-t-elle réussi à lire l’heure ?', 2, 'choix_multiple'),
(6, '6. Quelle fête Chandler déteste-t-il tout particulièrement ?', 2, 'choix_multiple'),
(7, '7. Quelle est la longueur de la lettre de Rachel à Ross ?', 2, 'choix_multiple'),
(8, '8. Quel nom de scène Joey décide-t-il d’utiliser pour booster sa carrière d’acteur ?', 2, 'choix_multiple'),
(9, '9. Quelle guest star n’apparaît pas dans « Friends » ?', 2, 'choix_multiple'),
(10, '10. Pourquoi le père de Rachel lui a-t-elle offert un bateau à l’âge de 15 ans ?', 2, 'choix_multiple'),
(11, '1. Quelle est l\'origine de la callopsitte élégante ?', 5, 'choix_multiple'),
(12, '2. Quelle est la durée de vie moyenne d\'une callopsitte en captivité ?', 5, 'choix_multiple'),
(13, '3. Les callopsittes peuvent-elles parler ?', 5, 'choix_multiple'),
(14, '4. Comment différencier un mâle d\'une femelle adulte ?', 5, 'choix_multiple'),
(15, '5. Quel aliment est toxique pour une callopsite ?', 5, 'choix_multiple'),
(16, '6. Combien de temps une callopsitte doit-elle sortir de sa cage chaque jour ?', 5, 'choix_multiple'),
(17, '7. Quelle est l\'attitude d\'une callopsite heureuse ?', 5, 'choix_multiple'),
(18, '8. Quelle est la meilleure manière d\'apprivoiser une callopsite ?', 5, 'choix_multiple'),
(19, '9. Les callopsittes peuvent-elles vivre seules ? ', 5, 'choix_multiple'),
(20, '10. Quel est le principal moyen de communication des callopsites ?', 5, 'choix_multiple'),
(21, '1. Quel est le lien de parenté entre Vi et Powder ?', 1, 'choix_multiple'),
(22, '2. Quel est le vrai nom de Jinx ?', 1, 'choix_multiple'),
(23, '3. Quel est le principal antagoniste de la saison 1 ?', 1, 'choix_multiple'),
(24, '4. Dans quelle ville se déroule principalement Arcane ?', 1, 'choix_multiple'),
(25, '5. Quel objet magique est au cœur de l\'intrigue ?', 1, 'choix_multiple'),
(26, '6. Comment Vander est-il surnommé dans Zaun ?', 1, 'choix_multiple'),
(27, '7. Qui devient le partenaire scientifique de Jayce ?', 1, 'choix_multiple'),
(28, '8. Quel est le rôle de Caitlyn dans l\'histoire ?', 1, 'choix_multiple'),
(29, '9. Qui fabrique la Shimmer, la drogue qui donne une force surhumaine ?', 1, 'choix_multiple'),
(30, '10. Que fait Jinx à la fin de la saison 1 ?', 1, 'choix_multiple'),
(31, '1. En moyenne combien d\'heures par jour un chat dort-il ?', 8, 'choix_multiple'),
(32, '2. Dans quel pays, le chat noir est-il considéré comme un signe de chance ?', 8, 'choix_multiple'),
(33, '3. Que peut-on déduire si un chat possède un pelage à 3 couleurs ?', 8, 'choix_multiple'),
(34, '4. D\'après le Guiness Book, quel est l\'âge du chat ayant vécu le plus vieux ?', 8, 'choix_multiple'),
(35, '5. Quel est la durée de gestation chez les chats ?', 8, 'choix_multiple'),
(36, '6. Quel est le nom du chat de la famille Simpson ?', 8, 'choix_multiple'),
(37, '7. Dans quel pays se trouve \"l\'île aux chats\" ? ', 8, 'choix_multiple'),
(38, '8. Quel est l\'auteur du conte le chat Botté ?', 8, 'choix_multiple'),
(39, '9. Comment s\'appelle Grosminet dans \"Titi et Grosminet\" ?', 8, 'choix_multiple'),
(40, '10. Comment s’appelle le petit chat dont le maître est Geppetto, le papa de Pinocchio ?', 8, 'choix_multiple'),
(41, '1. Qui est l\'acteur principal de la série Prison Break ?', 4, 'choix_multiple'),
(42, '2. Quel est le prénom du personnage principal de Prison Break ?', 4, 'choix_multiple'),
(43, '3. Quelle est la raison pour laquelle Lincoln Burrows est condamné à mort ?', 4, 'choix_multiple'),
(44, '4. Quel est le surnom du tatouage de Michael Scofield ?', 4, 'choix_multiple'),
(45, '5. Qui est la femme de Michael Scofield dans la série ?', 4, 'choix_multiple'),
(46, '6. Quel est le nom du prisonnier qui forme un duo avec Michael Scofield pour l\'évasion ?', 4, 'choix_multiple'),
(47, '7. Quel est le nom du vice-président des Etats-Unis qui est impliqué dans le complot ?', 4, 'choix_multiple'),
(48, '8. Quel est le rôle de Theodore \"T-Bag\" Bagwell dans Prison Break ?', 4, 'choix_multiple'),
(49, '9. Dans quelle prison Michael Scofield commence-t-il sa quête pour sauver son frère ?', 4, 'choix_multiple'),
(50, '10. Quel est le nom de l\'ami d\'enfance de Michael qui devient un personnage clé dans la série ?', 4, 'choix_multiple'),
(51, '1. Quelle est la race de chien la plus petite du monde ?', 7, 'choix_multiple'),
(52, '2. Quel chien est connu pour sa capacité à sauver des vies en montagne ?', 7, 'choix_multiple'),
(53, '3. Quel est le nom du chien dans la série télévisée Rex, chien flic ?', 7, 'choix_multiple'),
(54, '4. Quel chien est célèbre pour sa capacité à détecter des maladies comme le cancer ?', 7, 'choix_multiple'),
(55, '5. Quelle est la race de chien utilisée pour la chasse au lapin ?', 7, 'choix_multiple'),
(56, '6. Quel chien est connu pour ses \"belles oreilles\" et ses \"yeux de velours\" ?', 7, 'choix_multiple'),
(57, '7. Quel chien est le plus rapide ?', 7, 'choix_multiple'),
(58, '8. Quel chien est souvent utilisé pour la garde de troupeau de moutons ?', 7, 'choix_multiple'),
(59, '9. Quelle est la race de chien la plus populaire aux Etats-Unis ?', 7, 'choix_multiple'),
(60, '10. Quel est le chien qui a inspiré le célèbre personnage de Scooby-Doo ?', 7, 'choix_multiple'),
(61, '1. Quel est le véritable nom du Professeur ?', 3, 'choix_multiple'),
(62, '2. Où se déroule le premier braquage de la bande ?', 3, 'choix_multiple'),
(63, '3. Quel est le lien entre Berlin et le Professeur ?', 3, 'choix_multiple'),
(64, '4. Quel personnage trahit la bande en révélant des informations à la police ?', 3, 'choix_multiple'),
(65, '5. Comment s\'appelle la chanson symbole de la série, souvent chantée par les braqueurs ?', 3, 'choix_multiple'),
(66, '6. Quel était le métier du Professeur avant de planifier les braquages ?', 3, 'choix_multiple'),
(67, '7. Quel personnage utilise le premier un masque de Dali dans la série ?', 3, 'choix_multiple'),
(68, '8. Où Tokyo et Rio se cachent-ils avant d\'être retrouvés par la police ?', 3, 'choix_multiple'),
(69, '9. Quelle est la dernière ville ajoutée à la bande ?', 3, 'choix_multiple'),
(70, '10. Quel est le surnom donné au plan final du Professeur pour s\'échapper de la Banque d\'Espagne ?', 3, 'choix_multiple'),
(71, '1. Quel requin est surnommé \"le grand mangeur d\'hommes ?', 6, 'choix_multiple'),
(72, '2. Comment les requins flottent-ils sans vessie natatoire ?', 6, 'choix_multiple'),
(73, '3. Quelle est l\'espérance de vie du requin du Groenland ?', 6, 'choix_multiple'),
(74, '4. Combien d\'espèces de requins existent dans le monde ?', 6, 'choix_multiple'),
(75, '5. Quel est le requin le plus rapide ? ', 6, 'choix_multiple'),
(76, '6. Quel requin est capable de vivre en eau douce et en eau salée ?', 6, 'choix_multiple'),
(77, '7. Quelle partie du corps des requins repousse après avoir été endommagée ?', 6, 'choix_multiple'),
(78, '8. Comment s\'appelle le phénomène où un requin attaque un humain par curiosité ?', 6, 'choix_multiple'),
(79, '9. Quelle espèce de requin est bioluminescent ?', 6, 'choix_multiple'),
(80, '10. Quel est le plus petit requin du monde ?', 6, 'choix_multiple'),
(81, 'quiz?', 9, 'choix_multiple');

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `description` text,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_administrateur` int DEFAULT NULL,
  `est_public` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_administrateur` (`id_administrateur`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id`, `titre`, `description`, `date_creation`, `id_administrateur`, `est_public`) VALUES
(1, 'Arcane', 'Arcane est une série télévisée d\'animation américano-française dont le scénario prend place dans l\'univers du jeu vidéo League of Legends.', '2025-02-11 13:47:54', NULL, 1),
(2, 'Friends', 'L\'histoire raconte les péripéties de trois jeunes femmes et trois jeunes hommes new-yorkais liés par une profonde amitié.', '2025-02-11 13:47:54', NULL, 1),
(3, 'La casa de papel', 'Huit voleurs font une prise d\'otages dans la Maison royale de la Monnaie d\'Espagne, tandis qu\'un génie du crime manipule la police pour mettre son plan à exécution.', '2025-02-11 13:50:45', NULL, 1),
(4, 'Prison Break', 'Son frère injustement accusé de meurtre, un ingénieur en génie civil décide de le faire évader de prison.\r\n', '2025-02-11 13:50:45', NULL, 1),
(5, 'Calopsitte', 'La Calopsitte élégante ou simplement Calopsitte, aussi appelée cockatiel ou encore Perruche nymphique, est une espèce d\'oiseaux australienne. C\'est la seule espèce du genre Nymphicus. De taille similaire à celle d\'un petit pigeon, la calopsitte est souvent utilisée comme oiseau de compagnie, bien qu\'assez bruyant. ', '2025-02-11 13:53:10', NULL, 1),
(6, 'Requin', 'Les requins, squales ou sélachimorphes forment un super-ordre des poissons cartilagineux, possédant cinq à sept fentes branchiales sur les côtés de la tête et les nageoires pectorales qui ne sont pas fusionnées à la tête. Ils sont présents dans tous les océans du globe et dans certains grands fleuves', '2025-02-11 13:53:10', NULL, 1),
(7, 'Chien', 'Le chien est un mammifère de la famille des canidés. C\'est la première espèce animale à avoir été domestiquée par l\'homme dans le but de la chasse. ', '2025-02-11 13:59:14', NULL, 1),
(8, 'Chat', 'Le chat domestique est l’un des principaux animaux de compagnie et compte aujourd’hui une cinquantaine de races différentes reconnues par les instances de certification. ', '2025-02-11 13:59:14', NULL, 1),
(9, 'quiz', 'quiz', '2025-02-14 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `texte_reponse` text,
  `est_correcte` tinyint(1) DEFAULT '0',
  `id_question` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_question` (`id_question`)
) ENGINE=MyISAM AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `texte_reponse`, `est_correcte`, `id_question`) VALUES
(1, 'A/ 1992', 0, 1),
(2, 'B/ 1994', 1, 1),
(3, 'C/ 1996', 0, 1),
(4, 'A/ Cruella', 0, 2),
(5, 'B/ Ursula', 1, 2),
(6, 'C/ Elvira', 0, 2),
(7, 'A/ Benedict', 0, 3),
(8, 'B/ Muriel', 1, 3),
(9, 'C/ Jeffry', 0, 3),
(10, 'A/ Le tiramisu', 0, 4),
(11, 'B/ Le pudding', 0, 4),
(12, 'C/ Une charlotte aux fraises', 1, 4),
(13, 'A/ 10 ans', 0, 5),
(14, 'B/ 13 ans', 1, 5),
(15, 'C/ 17 ans', 0, 5),
(16, 'A/ La saint-valentin', 0, 6),
(17, 'B/ Thanksgiving', 1, 6),
(18, 'C/ Halloween', 0, 6),
(19, 'A/ 12 pages recto-verso', 0, 7),
(20, 'B/ 18 pages recto-verso', 1, 7),
(21, 'C/ 23 pages recto-verso', 0, 7),
(22, 'A/ Joseph Staline', 1, 8),
(23, 'B/ Benito Mussolini', 0, 8),
(24, 'C/ Léon Trotski', 0, 8),
(25, 'A/ Julia Roberts', 0, 9),
(26, 'B/ Brad Pitt', 0, 9),
(27, 'C/ Jim Carrey', 1, 9),
(28, 'A/ Parce qu\'elle venait de rompre avec son petit-ami', 0, 10),
(29, 'B/ Parce que son poney était malade', 1, 10),
(30, 'C/ Parce qu\'elle ne voulait plus apprendre le php', 0, 10),
(31, 'A/ Amérique du Sud', 0, 11),
(32, 'B/ Australie', 1, 11),
(33, 'C/ Afrique', 0, 11),
(34, 'A/ 5 à 10 ans', 0, 12),
(35, 'B/ 10 à 15 ans', 0, 12),
(36, 'C/ 15 à 25 ans', 1, 12),
(37, 'A/ Oui, elles peuvent apprendre quelques mots', 1, 13),
(38, 'B/ Non, elles ne font que siffler', 0, 13),
(39, 'C/ Oui, elles parlent aussi bien qu\'un perroquet du Gabon', 0, 13),
(40, 'A/ Les mâles ont des couleurs plus vives et un masque facial jaune marqué', 1, 14),
(41, 'B/ Les mâles sont plus petits que les femelles', 0, 14),
(42, 'C/ Il n\'y a aucune différence visible entre un mâle et une femelle', 0, 14),
(43, 'A/ La carotte', 0, 15),
(44, 'B/ Le chocolat ', 1, 15),
(45, 'C/ La pomme', 0, 15),
(46, 'A/ 15 minutes', 0, 16),
(47, 'B/ 1 à 2 heures', 1, 16),
(48, 'C/ Elle ne doit jamais sortir de sa cage', 0, 16),
(49, 'A/ Elle crie sans arrêt', 0, 17),
(50, 'B/ Elle se lisse les plumes, chante et joue', 1, 17),
(51, 'C/ Elle reste dans un coin immobile', 0, 17),
(52, 'A/ Lui parler doucement et lui donner des friandises', 1, 18),
(53, 'B/ L\'ignorer pour qu\'elle s\'habitue seule', 0, 18),
(54, 'C/ Forcer la callopsite à monter sur le doigt', 0, 18),
(55, 'A/ Oui, et elles préfèrent toujours être seules', 0, 19),
(56, 'B/ Oui, mais elles doivent recevoir beaucoup d\'attention', 1, 19),
(57, 'C/ Seulement si elles sont en volière', 0, 19),
(58, 'A/ Elles ne font aucun bruit', 0, 20),
(59, 'B/ Elles miaulent', 0, 20),
(60, 'C/ Elles sifflent et vocalisent', 1, 20),
(61, 'A/ Amies d\'enfance', 0, 21),
(62, 'B/ Soeurs', 1, 21),
(63, 'C/ Cousines', 0, 21),
(64, 'A/ Caitlyn', 0, 22),
(65, 'B/ Powder', 1, 22),
(66, 'C/ Sevika', 0, 22),
(67, 'A/ Vander', 0, 23),
(68, 'B/ Jayce', 0, 23),
(69, 'C/ Silco', 1, 23),
(70, 'A/ Zaun et Piltover ', 1, 24),
(71, 'B/ Noxus', 0, 24),
(72, 'C/ Shurima', 0, 24),
(73, 'A/ Une pierre d\'âme', 0, 25),
(74, 'B/ Un médaillon ancien', 0, 25),
(75, 'C/ Hextech', 1, 25),
(76, 'A/ Le père des loups', 0, 26),
(77, 'B/ Le protecteur', 1, 26),
(78, 'C/ La bête de Zaun', 0, 26),
(79, 'A/ Viktor', 1, 27),
(80, 'B/ Singed', 0, 27),
(81, 'C/ Mel Medarda', 0, 27),
(82, 'A/ Mercenaire', 0, 28),
(83, 'B/ Soldat de Noxus', 0, 28),
(84, 'C/ Enquêtrice et tireuse d\'élite', 1, 28),
(85, 'A/ Silco', 0, 29),
(86, 'B/ Singed', 1, 29),
(87, 'C/ Viktor', 0, 29),
(88, 'A/ Elle quitte Pitlover pour Zaun', 0, 30),
(89, 'B/ Elle rejoint Vi pour affronter Silco', 0, 30),
(90, 'C/ Elle détruit le conseil de Pitlover avec un tir de roquette', 1, 30),
(91, 'A/ 8 heures', 0, 31),
(92, 'B/ 12 heures', 0, 31),
(93, 'C/ 16 heures', 1, 31),
(94, 'A/ Royaume Uni', 1, 32),
(95, 'B/ Russie', 0, 32),
(96, 'C/ Mexique', 0, 32),
(97, 'A/ C\'est une femelle', 1, 33),
(98, 'B/ C\'est un mâle', 0, 33),
(99, 'C/ Il n\'y a rien à déduire', 0, 33),
(100, 'A/ 32 ans', 0, 34),
(101, 'B/ 36 ans', 0, 34),
(102, 'C/ 38 ans', 1, 34),
(103, 'A/ 9 semaines', 1, 35),
(104, 'B/ 12 semaines', 0, 35),
(105, 'C/ 9 mois', 0, 35),
(106, 'A/ Etoile polaire', 0, 36),
(107, 'B/ Boule de neige ', 1, 36),
(108, 'C/ Santa', 0, 36),
(109, 'A/ Grêce', 0, 37),
(110, 'B/ Croatie', 0, 37),
(111, 'C/ Japon', 1, 37),
(112, 'A/ Les frères Grimm', 0, 38),
(113, 'B/ Lewis Carroll', 0, 38),
(114, 'C/ Charles Perrault', 1, 38),
(115, 'A/ Arnold', 0, 39),
(116, 'B/ Gaspard', 0, 39),
(117, 'C/ Sylvestre', 1, 39),
(118, 'A/ Figaro', 1, 40),
(119, 'B/ Isidore', 0, 40),
(120, 'C/ Jazz', 0, 40),
(121, 'A/ Wentworth Miller', 1, 41),
(122, 'B/ Dominic Purcell', 0, 41),
(123, 'C/ Paul Walker', 0, 41),
(124, 'A/ Lincoln', 0, 42),
(125, 'B/ Michael', 1, 42),
(126, 'C/ John', 0, 42),
(127, 'A/ Il a volé une banque', 0, 43),
(128, 'B/ Il a tué le vice-président', 0, 43),
(129, 'C/ Il a été accusé à tort du meurtre du frère du vice-président', 1, 43),
(130, 'A/ Code de sortie', 0, 44),
(131, 'B/ Plan de l\'évasion', 1, 44),
(132, 'C/ Carte des prisons', 0, 44),
(133, 'A/ Dr Sara Tancredi', 1, 45),
(134, 'B/ Veronica Donovan', 0, 45),
(135, 'C/ T-Bag', 0, 45),
(136, 'A/ Fernando Sucre', 1, 46),
(137, 'B/ Theodore \"T-Bag\" Bagwell', 0, 46),
(138, 'C/ John Abruzzi', 0, 46),
(139, 'A/ Charles Westmoreland', 0, 47),
(140, 'B/ William Kim', 0, 47),
(141, 'C/ Terrence Steadman', 1, 47),
(142, 'A/ Un prisonnier psychopatique et manipulateur', 1, 48),
(143, 'B/ Le directeur de la prison', 0, 48),
(144, 'C/ Un détective de la police', 0, 48),
(145, 'A/ Fox River State Penitentiary', 1, 49),
(146, 'B/ San Quentin', 0, 49),
(147, 'C/ Sona', 0, 49),
(148, 'A/ Sucre', 1, 50),
(149, 'B/ Linc', 0, 50),
(150, 'C/ Bellick', 0, 50),
(151, 'A/ Chihuahua', 1, 51),
(152, 'B/ Yorshire Terrier', 0, 51),
(153, 'C/ Poodle', 0, 51),
(154, 'A/ Golden retriever', 0, 52),
(155, 'B/ Saint-Bernard', 1, 52),
(156, 'C/ Bulldog', 0, 52),
(157, 'A/ Max', 0, 53),
(158, 'B/ Rex', 1, 53),
(159, 'C/ Lucky', 0, 53),
(160, 'A/ Bulldog', 0, 54),
(161, 'B/ Labrador Retriever', 1, 54),
(162, 'C/ Rottweiler', 0, 54),
(163, 'A/ Beagle', 1, 55),
(164, 'B/ Doberman', 0, 55),
(165, 'C/ Boxer', 0, 55),
(166, 'A/ Dalmatien', 0, 56),
(167, 'B/ Cocker Spaniel', 1, 56),
(168, 'C/ Pitbull', 0, 56),
(169, 'A/ Greyhound', 1, 57),
(170, 'B/ Border Collie', 0, 57),
(171, 'C/ Chihuahua', 0, 57),
(172, 'A/ Rottweiler', 0, 58),
(173, 'B/ Border Collie', 1, 58),
(174, 'C/ Saint-Bernard ', 0, 58),
(175, 'A/ Poodle', 0, 59),
(176, 'B/ Beagle', 0, 59),
(177, 'C/ Labrador Retriever', 1, 59),
(178, 'A/ Great Dane', 1, 60),
(179, 'B/ Pitbull', 0, 60),
(180, 'C/ Bulldog', 0, 60),
(181, 'A/ Andrès de Fonollosa', 0, 61),
(182, 'B/ Sergio Marquina', 1, 61),
(183, 'C/ Raquel ', 0, 61),
(184, 'A/ La Banque d\'Espagne', 1, 62),
(185, 'B/ La Monnaie royale d\'Espagne', 0, 62),
(186, 'C/ La Bourse de Madrid', 0, 62),
(187, 'A/ Il sont cousins', 0, 63),
(188, 'B/ Ils sont frères', 1, 63),
(189, 'C/ Ils sont amis d\'enfance', 0, 63),
(190, 'A/ Tokyo', 0, 64),
(191, 'B/ Rio', 1, 64),
(192, 'C/ Nairobi', 0, 64),
(193, 'A/ Bella Ciao', 1, 65),
(194, 'B/ O Bella Mia', 0, 65),
(195, 'C/ Ciao Amore', 0, 65),
(196, 'A/ Enseignant', 0, 66),
(197, 'B/ Ingénieur', 0, 66),
(198, 'C/ Aucun, il préparait le braquage depuis toujours', 1, 66),
(199, 'A/ Tokyo', 0, 67),
(200, 'B/ Denver', 0, 67),
(201, 'C/ Le Professeur', 1, 67),
(202, 'A/ Cuba', 0, 68),
(203, 'B/ Panama', 0, 68),
(204, 'C/ Philippines', 1, 68),
(205, 'A/ Stockholm', 0, 69),
(206, 'B/ Lisbonne', 0, 69),
(207, 'C/ Marseille', 1, 69),
(208, NULL, 0, NULL),
(209, 'A/ Plan Venise', 0, 70),
(210, 'B/ Plan Paris', 1, 70),
(211, 'C/ Plan Lisbonne', 0, 70),
(212, 'A/ Requin-marteau', 0, 71),
(213, 'B/ Requin-tigre', 0, 71),
(214, 'C/ Requin blanc', 1, 71),
(215, 'A/ Grâce a leur nageoires', 0, 72),
(216, 'B/ En stockant de l\'air dans leur poumons', 0, 72),
(217, 'C/ Grâce à leur foie rempli d\'huile', 1, 72),
(218, 'A/ 100 ans', 0, 73),
(219, 'B/ 200 ans', 0, 73),
(220, 'C/ Plus de 400 ans ', 1, 73),
(221, 'A/ Environ 100', 0, 74),
(222, 'B/ Environ 250', 0, 74),
(223, 'C/ Environ 500', 1, 74),
(224, 'A/ Requin mako', 1, 75),
(225, 'B/ Requin-baleine', 0, 75),
(226, 'C/ Requin zèbre', 0, 75),
(227, 'A/ Requin-tigre', 0, 76),
(228, 'B/ Requin-bouledogue', 1, 75),
(229, 'C/ Requin-marteau', 0, 76),
(230, 'A/ Les dents', 1, 77),
(231, 'B/ Les nageoires', 0, 77),
(232, 'C/ La peau ', 0, 77),
(233, 'A/ Attaque défensive', 0, 78),
(234, 'B/ Attaque instinctive', 0, 78),
(235, 'C/ Attaque exploratoire', 1, 78),
(236, 'A/ Requin pèlerin', 0, 79),
(237, 'B/ Requin-lanterne', 1, 79),
(238, 'C/ Requin citron', 0, 79),
(239, 'A/ Requin pygmée', 1, 80),
(240, 'B/ Requin-chabot', 0, 80),
(241, 'C/ Requin dormeur', 0, 80);

-- --------------------------------------------------------

--
-- Structure de la table `reponse_joueur`
--

DROP TABLE IF EXISTS `reponse_joueur`;
CREATE TABLE IF NOT EXISTS `reponse_joueur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_participation` int DEFAULT NULL,
  `id_question` int DEFAULT NULL,
  `id_reponse` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_participation` (`id_participation`),
  KEY `id_question` (`id_question`),
  KEY `id_reponse` (`id_reponse`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
