-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 08 Sie 2020, 16:37
-- Wersja serwera: 5.7.26-29-log
-- Wersja PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `31766110_phpgryplanszowe`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(20) NOT NULL,
  `id_event` int(20) NOT NULL,
  `user_login` varchar(255) COLLATE utf8_bin NOT NULL,
  `text_message` text COLLATE utf8_bin NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `chat`
--

INSERT INTO `chat` (`id_chat`, `id_event`, `user_login`, `text_message`, `created_time`) VALUES
(1, 1, 'asterix', 'siemanko', '2020-04-30 16:15:54'),
(2, 3, 'asterix', 'hello', '2020-05-02 00:46:22'),
(3, 1, 'asterix', 'witam<br />\npaĹstwa', '2020-05-02 16:41:42'),
(4, 4, 'asterix', '.', '2020-05-03 12:31:00'),
(5, 5, 'asterix', 'hello guys', '2020-05-13 04:29:28'),
(6, 5, 'asterix', 'how are you?', '2020-05-13 04:30:09'),
(7, 5, 'obelix', 'hi asterix', '2020-05-13 04:32:30'),
(9, 5, 'obelix', 'I am fine, thanks. And you? Where are you from? Please tell something about you', '2020-05-13 04:36:11'),
(10, 5, 'monikap96', 'hello everyone!', '2020-05-13 04:36:47'),
(11, 5, 'monikap96', 'it is a good idea!', '2020-05-13 04:37:41'),
(12, 5, 'monikap96', 'lets talk about us! :D', '2020-05-13 04:38:02'),
(15, 19, 'asterix', 'sdfsdf', '2020-06-04 08:01:05'),
(16, 19, 'justyna', 'sdfsdkfl', '2020-06-04 08:02:16'),
(17, 19, 'asterix', 'ghfg', '2020-06-17 09:52:51'),
(18, 19, 'asterix', 'fgfgfg', '2020-06-17 09:52:57'),
(19, 19, 'asterix', 'dfgdfgf', '2020-06-17 10:15:30'),
(20, 19, 'asterix', 'gdfgd', '2020-06-17 10:15:32');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `eventt`
--

CREATE TABLE `eventt` (
  `id_event` int(20) NOT NULL,
  `event_place` varchar(255) COLLATE utf8_bin NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_min_players` int(7) DEFAULT NULL,
  `event_max_players` int(7) DEFAULT NULL,
  `event_min_age` int(7) DEFAULT NULL,
  `event_max_age` int(7) DEFAULT NULL,
  `event_game` int(20) NOT NULL,
  `event_initiator` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `eventt`
--

INSERT INTO `eventt` (`id_event`, `event_place`, `event_date`, `event_time`, `event_min_players`, `event_max_players`, `event_min_age`, `event_max_age`, `event_game`, `event_initiator`) VALUES
(1, 'Sosnowiec', '2020-04-30', '18:30:00', 2, 4, 8, 99, 1, 1),
(2, 'Gliwice', '2020-05-01', '15:52:00', 2, 4, 8, 99, 1, 9),
(3, 'Katowice ', '2020-05-09', '17:24:00', 3, 4, 10, 99, 1, 1),
(4, 'Sosnowiec', '2020-05-04', '15:15:00', 2, 4, 8, 99, 1, 1),
(5, 'Katowice ', '2020-05-26', '15:43:00', 2, 5, 10, 99, 22, 1),
(6, 'Sosnowiec ul. Zamkowa 14/140', '2020-05-10', '15:15:00', 1, 5, 14, 99, 17, 3),
(7, 'ChorzĂłw', '2020-05-13', '04:12:00', 3, 4, 10, 99, 5, 2),
(8, 'Siemiany', '2020-05-14', '04:17:00', 2, 8, 8, 99, 4, 2),
(9, 'MysĹowice ul. Ceglana 32/12', '2020-05-17', '14:00:00', 2, 5, 12, 99, 20, 1),
(10, 'Warszawa ul. Radosna 13/33', '2020-05-18', '16:00:00', 1, 5, 14, 99, 17, 31),
(11, 'Sosnowiec', '2020-05-05', '14:54:00', 2, 8, 12, 99, 2, 3),
(12, 'Sosnowiec', '2020-05-13', '14:57:00', 2, 8, 12, 99, 2, 3),
(13, 'Sosnowiec', '2020-05-13', '23:30:00', 2, 2, 6, 99, 3, 3),
(14, 'Siemiany', '2020-05-14', '15:06:00', 2, 3, 8, 99, 4, 3),
(15, 'Siemiany', '2020-05-22', '15:00:00', 2, 8, 12, 99, 2, 3),
(18, 'Katowice Cybermachina', '2020-06-04', '06:45:00', 3, 6, 10, 99, 6, 1),
(19, 'Katowice Cybermachina', '2020-06-10', '15:58:00', 3, 6, 10, 99, 6, 1),
(20, 'Sosnowiec', '2020-06-18', '15:56:00', 2, 4, 8, 99, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `event_user`
--

CREATE TABLE `event_user` (
  `id_user` int(20) NOT NULL,
  `id_event` int(20) NOT NULL,
  `date_added` timestamp NOT NULL,
  `priorityy` tinyint(4) NOT NULL,
  `date_accept` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `event_user`
--

INSERT INTO `event_user` (`id_user`, `id_event`, `date_added`, `priorityy`, `date_accept`) VALUES
(1, 1, '2020-04-30 16:15:41', 1, '2020-04-30 16:15:41'),
(1, 2, '2020-04-30 20:45:16', 1, '2020-05-01 01:17:51'),
(1, 3, '2020-05-01 13:22:52', 1, '2020-05-01 13:22:52'),
(1, 4, '2020-05-02 00:46:44', 1, '2020-05-02 00:46:44'),
(1, 5, '2020-05-09 12:43:54', 1, '2020-05-09 12:43:54'),
(1, 7, '2020-05-13 02:13:25', 2, NULL),
(1, 9, '2020-05-13 05:04:32', 1, '2020-05-13 05:04:32'),
(1, 10, '2020-05-13 05:06:52', 2, NULL),
(1, 18, '2020-06-04 07:42:31', 1, '2020-06-04 07:42:31'),
(1, 19, '2020-06-04 08:00:12', 1, '2020-06-04 08:00:12'),
(1, 20, '2020-06-17 10:17:15', 1, '2020-06-17 10:17:15'),
(2, 1, '2020-04-30 16:15:41', 2, NULL),
(2, 3, '2020-05-01 13:26:51', 1, '2020-05-01 13:30:28'),
(2, 6, '2020-05-09 18:00:54', 1, '2020-05-09 18:00:54'),
(2, 7, '2020-05-13 02:13:25', 1, '2020-05-13 02:13:25'),
(2, 8, '2020-05-13 02:17:51', 1, '2020-05-13 02:17:51'),
(2, 9, '2020-05-13 05:04:32', 1, '2020-05-13 05:24:00'),
(2, 10, '2020-05-13 05:06:52', 2, NULL),
(2, 18, '2020-06-04 07:42:31', 1, '2020-06-04 07:43:08'),
(2, 19, '2020-06-04 08:00:12', 2, NULL),
(2, 20, '2020-06-17 10:17:15', 2, NULL),
(3, 1, '2020-04-30 16:15:41', 2, NULL),
(3, 3, '2020-05-01 13:23:47', 1, '2020-05-03 12:36:51'),
(3, 4, '2020-05-03 12:37:01', 1, '2020-05-03 12:37:01'),
(3, 5, '2020-05-09 12:43:54', 2, NULL),
(3, 6, '2020-05-09 17:46:04', 1, '2020-05-09 17:46:04'),
(3, 8, '2020-05-13 02:17:51', 2, NULL),
(3, 11, '2020-05-13 12:54:26', 1, '2020-05-13 12:54:26'),
(3, 12, '2020-05-13 12:58:12', 1, '2020-05-13 12:58:12'),
(3, 13, '2020-05-13 12:59:37', 1, '2020-05-13 12:59:37'),
(3, 14, '2020-05-13 13:39:20', 1, '2020-05-13 13:39:20'),
(3, 15, '2020-05-13 13:55:54', 1, '2020-05-13 13:55:54'),
(3, 18, '2020-06-04 07:42:31', 1, '2020-06-04 07:42:52'),
(3, 19, '2020-06-04 08:00:12', 1, '2020-06-04 08:01:51'),
(4, 6, '2020-05-09 18:00:34', 2, NULL),
(4, 18, '2020-06-04 07:42:31', 2, NULL),
(4, 19, '2020-06-04 08:00:47', 2, NULL),
(4, 20, '2020-06-17 10:17:15', 2, NULL),
(5, 20, '2020-06-17 10:17:15', 2, NULL),
(9, 2, '2020-04-30 20:38:09', 1, '2020-04-30 20:38:09'),
(10, 1, '2020-04-30 16:28:27', 1, '2020-04-30 16:28:27'),
(11, 20, '2020-06-17 10:17:15', 2, NULL),
(31, 5, '2020-05-13 04:27:40', 1, '2020-05-13 04:27:40'),
(31, 9, '2020-05-13 05:04:44', 2, NULL),
(31, 10, '2020-05-13 05:06:52', 1, '2020-05-13 05:06:52');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `game`
--

CREATE TABLE `game` (
  `id_game` int(20) NOT NULL,
  `game_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `game_min_players` int(7) NOT NULL,
  `game_max_players` int(7) NOT NULL,
  `game_min_age` int(7) NOT NULL,
  `game_max_age` int(7) NOT NULL,
  `game_description` longtext COLLATE utf8_bin NOT NULL,
  `game_image` int(11) DEFAULT NULL,
  `game_created_by` int(20) NOT NULL,
  `game_accepted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `game`
--

INSERT INTO `game` (`id_game`, `game_name`, `game_min_players`, `game_max_players`, `game_min_age`, `game_max_age`, `game_description`, `game_image`, `game_created_by`, `game_accepted`) VALUES
(1, 'Ludo', 2, 4, 8, 99, 'Pachisi, the national game of India, dates back to 4 AD and remains popular today. <br />\r\nEach player has a set of pawns that start in his or her corner of the board.The goal is to move the pawns around the board to the \"home\" section. Movement is controlled by dice. All players move around the same board, so they may capture each others pawns. Captured pawns are returned to their player\'s corner and must start their journey over. The winner is the first player to move all pawns \"home\".', 1, 1, 1),
(2, 'Carcassonne', 2, 8, 12, 99, 'Carcassonne is a tile-placement game in which the players draw and place a tile with a piece of southern French landscape on it. The tile might feature a city, a road, a cloister, grassland or some combination thereof, and it must be placed adjacent to tiles that have already been played, in such a way that cities are connected to cities, roads to roads, etcetera. Having placed a tile, the player can then decide to place one of their meeples on one of the areas on it: on the city as a knight, on the road as a robber, on a cloister as a monk, or on the grass as a farmer. When that area is complete, that meeple scores points for its owner.<br />\r\n<br />\r\nDuring a game of Carcassonne, players are faced with decisions like: \"Is it really worth putting my last meeple there?\" or \"Should I use this tile to expand my city, or should I place it near my opponent instead, giving him a hard time to complete their project and score points?\" Since players place only one tile and have the option to place one meeple on it, turns proceed quickly even if it is a game full of options and possibilities.', 1, 1, 1),
(3, 'Chess', 2, 2, 6, 99, 'Chess is a two-player, abstract strategy board game that represents medieval warfare on an 8x8 board with alternating light and dark squares. Opposing pieces, traditionally designated White and Black, are initially lined up on either side. Each type of piece has a unique form of movement and capturing occurs when a piece, via its movement, occupies the square of an opposing piece. Players take turns moving one of their pieces in an attempt to capture, attack, defend, or develop their positions. Chess games can end in checkmate, resignation, or one of several types of draws. Chess is one of the most popular games in the world, played by millions of people worldwide at home, in clubs, online, by correspondence, and in tournaments. Between two highly skilled players, chess can be a beautiful thing to watch, and a game can provide great entertainment even for novices. There is also a large literature of books and periodicals about chess, typically featuring games and commentary by chess masters.', 1, 3, 1),
(4, 'Monopoly', 2, 8, 8, 99, 'Theme\r\nPlayers take the part of land owners, attempting to buy and then develop their land. Income is gained by other players visiting their properties and money is spent when they visit properties belonging to other players. When times get tough, players may have to mortgage their properties to raise cash for fines, taxes and other misfortunes.\r\n\r\nGameplay\r\nOn his turn, a player rolls two dice and moves that number of spaces around the board. If the player lands on an as-yet-unowned property, he has the opportunity to buy it and add it to his portfolio or allow the bank to auction it to the highest bidder. If a player owns all the spaces within a color group, he may then build houses and hotels on these spaces, generating even more income from opponents who land there. If he lands on a property owned by another player, he must pay that player rent according to the value of the land and any buildings on it. There are other places on the board which can not be bought, but instead require the player to draw a card and perform the action on the card, pay taxes, collect income, or even go to jail.\r\n\r\nGoal\r\nThe goal of the game is to be the last player remaining with any money.', 1, 9, 1),
(5, 'Catan', 3, 4, 10, 99, 'In Catan (formerly The Settlers of Catan), players try to be the dominant force on the island of Catan by building settlements, cities, and roads. On each turn dice are rolled to determine what resources the island produces. Players collect these resources (cards)âwood, grain, brick, sheep, or stoneâto build up their civilizations to get to 10 victory points and win the game.<br />\r\n<br />\r\nSetup includes randomly placing large hexagonal tiles (each showing a resource or the desert) in a honeycomb shape and surrounding them with water tiles, some of which contain ports of exchange. Number disks, which will correspond to die rolls (two 6-sided dice are used), are placed on each resource tile. Each player is given two settlements (think: houses) and roads (sticks) which are, in turn, placed on intersections and borders of the resource tiles. Players collect a hand of resource cards based on which hex tiles their last-placed house is adjacent to. A robber pawn is placed on the desert tile.', 1, 12, 1),
(6, '5 Second Rule', 3, 6, 10, 99, 'It should be easy to name 3 breeds of dogs - but can you do it under the pressure of 5 seconds twisting down, and with the other players staring at you, waiting for you to get flustered? Time\'s not on your side, so just say what comes to mind and risk ridiculous answers slipping out as time twirls down on the unique twisted timer! It\'s all in good fun with this fast-paced game where you have to \"Just Spit It Out!\"', 1, 10, 1),
(7, 'Gloomhaven', 1, 4, 13, 99, 'Gloomhaven is a game of Euro-inspired tactical combat in a persistent world of shifting motives. Players will take on the role of a wandering adventurer with their own special set of skills and their own reasons for traveling to this dark corner of the world. Players must work together out of necessity to clear out menacing dungeons and forgotten ruins. In the process, they will enhance their abilities with experience and loot, discover new locations to explore and plunder, and expand an ever-branching story fueled by the decisions they make.<br />\r\n<br />\r\nThis is a game with a persistent and changing world that is ideally played over many game sessions. After a scenario, players will make decisions on what to do, which will determine how the story continues, kind of like a âChoose Your Own Adventureâ book. Playing through a scenario is a cooperative affair where players will fight against automated monsters using an innovative card system to determine the order of play and what a player does on their turn.', 1, 9, 1),
(8, 'Pandemic Legacy', 2, 4, 13, 99, 'Pandemic Legacy is a co-operative campaign game, with an overarching story-arc played through 12-24 sessions, depending on how well your group does at the game. At the beginning, the game starts very similar to basic Pandemic, in which your team of disease-fighting specialists races against the clock to travel around the world, treating disease hotspots while researching cures for each of four plagues before they get out of hand.<br />\r\n<br />\r\nDuring a player\'s turn, they have four actions available, with which they may travel around in the world in various ways (sometimes needing to discard a card), build structures like research stations, treat diseases (removing one cube from the board; if all cubes of a color have been removed, the disease has been eradicated), trade cards with other players, or find a cure for a disease (requiring five cards of the same color to be discarded while at a research station). Each player has a unique role with special abilities to help them at these actions.<br />\r\n<br />\r\nAfter a player has taken their actions, they draw two cards. These cards can include epidemic cards, which will place new disease cubes on the board, and can lead to an outbreak, spreading disease cubes even further. Outbreaks additionally increase the panic level of a city, making that city more expensive to travel to.', 1, 9, 1),
(9, 'Terraforming Mars', 1, 5, 12, 99, 'In the 2400s, mankind begins to terraform the planet Mars. Giant corporations, sponsored by the World Government on Earth, initiate huge projects to raise the temperature, the oxygen level, and the ocean coverage until the environment is habitable. In Terraforming Mars, you play one of those corporations and work together in the terraforming process, but compete for getting victory points that are awarded not only for your contribution to the terraforming, but also for advancing human infrastructure throughout the solar system, and doing other commendable things.<br />\r\n<br />\r\nThe players acquire unique project cards (from over two hundred different ones) by buying them to their hand. The projects (cards) can represent anything from introducing plant life or animals, hurling asteroids at the surface, building cities, to mining the moons of Jupiter and establishing greenhouse gas industries to heat up the atmosphere. The cards can give you immediate bonuses, as well as increasing your production of different resources. Many cards also have requirements and they become playable when the temperature, oxygen, or ocean coverage increases enough. Buying cards is costly, so there is a balance between buying cards (3 megacredits per card) and actually playing them (which can cost anything between 0 to 41 megacredits, depending on the project). Standard Projects are always available to complement your cards.', 1, 3, 1),
(10, 'Through the Ages', 2, 4, 14, 99, 'Through the Ages: A New Story of Civilization is the new edition of Through the Ages: A Story of Civilization, with many changes small and large to the game\'s cards over its three ages and extensive changes to how military works.<br />\r\n<br />\r\nThrough the Ages is a civilization building game. Each player attempts to build the best civilization through careful resource management, discovering new technologies, electing the right leaders, building wonders and maintaining a strong military. Weakness in any area can be exploited by your opponents. The game takes place throughout the ages beginning in the age of antiquity and ending in the modern age.<br />\r\n<br />\r\nOne of the primary mechanisms in TTA is card drafting. Technologies, wonders, and leaders come into play and become easier to draft the longer they are in play. In order to use a technology you will need enough science to discover it, enough food to create a population to man it and enough resources (ore) to build the building to use it. While balancing the resources needed to advance your technology you also need to build a military. Military is built in the same way as civilian buildings. Players that have a weak military will be preyed upon by other players. There is no map in the game so you cannot lose territory, but players with higher military will steal resources, science, kill leaders, take population or culture. It is very difficult to win with a large military, but it is very easy to lose because of a weak one.<br />\r\n<br />\r\nVictory is achieved by the player whose nation has the most culture at the end of the modern age.', 1, 2, 1),
(11, 'Twilight Imperium', 3, 6, 14, 99, 'Twilight Imperium (Fourth Edition) is a game of galactic conquest in which three to six players take on the role of one of seventeen factions vying for galactic domination through military might, political maneuvering, and economic bargaining. Every faction offers a completely different play experience, from the wormhole-hopping Ghosts of Creuss to the Emirates of Hacan, masters of trade and economics. These seventeen races are offered many paths to victory, but only one may sit upon the throne of Mecatol Rex as the new masters of the galaxy.<br />\r\n<br />\r\nNo two games of Twilight Imperium are ever identical. At the start of each galactic age, the game board is uniquely and strategically constructed using 51 galaxy tiles that feature everything from lush new planets and supernovas to asteroid fields and gravity rifts. Players are dealt a hand of these tiles and take turns creating the galaxy around Mecatol Rex, the capital planet seated in the center of the board. An ion storm may block your race from progressing through the galaxy while a fortuitously placed gravity rift may protect you from your closest foes. The galaxy is yours to both craft and dominate.<br />\r\n<br />\r\nA round of Twilight Imperium begins with players selecting one of eight strategy cards that both determine player order and give their owner a unique strategic action for that round. These may do anything from providing additional command tokens to allowing a player to control trade throughout the galaxy. After these roles are selected, players take turns moving their fleets from system to system, claiming new planets for their empire, and engaging in warfare and trade with other factions. At the end of a turn, players gather in a grand council to pass new laws and agendas, shaking up the game in unpredictable ways.', 1, 10, 1),
(14, 'Twilight Struggle', 2, 2, 13, 99, 'n 1945, unlikely allies toppled Hitler\'s war machine, while humanity\'s most devastating weapons forced the Japanese Empire to its knees in a storm of fire. Where once there stood many great powers, there then stood only two. The world had scant months to sigh its collective relief before a new conflict threatened. Unlike the titanic struggles of the preceding decades, this conflict would be waged not primarily by soldiers and tanks, but by spies and politicians, scientists and intellectuals, artists and traitors. Twilight Struggle is a two-player game simulating the forty-five year dance of intrigue, prestige, and occasional flares of warfare between the Soviet Union and the United States. The entire world is the stage on which these two titans fight to make the world safe for their own ideologies and ways of life. The game begins amidst the ruins of Europe as the two new \"superpowers\" scramble over the wreckage of the Second World War, and ends in 1989, when only the United States remained standing.', 1, 1, 1),
(15, 'Gaia Project', 1, 4, 13, 99, 'Gaia Project is a new game in the line of Terra Mystica. As in the original Terra Mystica, fourteen different factions live on seven different kinds of planets, and each faction is bound to their own home planets, so to develop and grow, they must terraform neighboring planets into their home environments in competition with the other groups. In addition, Gaia planets can be used by all factions for colonization, and Transdimensional planets can be changed into Gaia planets. All factions can improve their skills in six different areas of development â Terraforming, Navigation, Artificial Intelligence, Gaiaforming, Economy, Research â leading to advanced technology and special bonuses. To do all of that, each group has special skills and abilities. The playing area is made of ten sectors, allowing a variable set-up and thus an even bigger replay value than its predecessor Terra Mystica. A two-player game is hosted on seven sectors.', 1, 1, 1),
(16, 'Great Western Trail', 2, 4, 12, 99, 'America in the 19th century: You are a rancher and repeatedly herd your cattle from Texas to Kansas City, where you send them off by train. This earns you money and victory points. Needless to say, each time you arrive in Kansas City, you want to have your most valuable cattle in tow. However, the \"Great Western Trail\" not only requires that you keep your herd in good shape, but also that you wisely use the various buildings along the trail. Also, it might be a good idea to hire capable staff: cowboys to improve your herd, craftsmen to build your very own buildings, or engineers for the important railroad line. If you cleverly manage your herd and navigate the opportunities and pitfalls of Great Western Trail, you surely will gain the most victory points and win the game.', 1, 1, 1),
(17, 'Scythe', 1, 5, 14, 99, 'It is a time of unrest in 1920s Europa. The ashes from the first great war still darken the snow. The capitalistic city-state known simply as âThe Factoryâ, which fueled the war with heavily armored mechs, has closed its doors, drawing the attention of several nearby countries.<br />\r\n<br />\r\nScythe is an engine-building game set in an alternate-history 1920s period. It is a time of farming and war, broken hearts and rusted gears, innovation and valor. In Scythe, each player represents a character from one of five factions of Eastern Europe who are attempting to earn their fortune and claim their faction\'s stake in the land around the mysterious Factory. Players conquer territory, enlist new recruits, reap resources, gain villagers, build structures, and activate monstrous mechs.<br />\r\n<br />\r\nEach player begins the game with different resources (power, coins, combat acumen, and popularity), a different starting location, and a hidden goal. Starting positions are specially calibrated to contribute to each factionâs uniqueness and the asymmetrical nature of the game (each faction always starts in the same place).', 1, 1, 1),
(18, 'War of the Ring', 2, 4, 13, 99, 'In War of the Ring, one player takes control of the Free Peoples (FP), the other player controls Shadow Armies (SA). Initially, the Free People Nations are reluctant to take arms against Sauron, so they must be attacked by Sauron or persuaded by Gandalf or other Companions, before they start to fight properly: this is represented by the Political Track, which shows if a Nation is ready to fight in the War of the Ring or not. The game can be won by a military victory, if Sauron conquers a certain number of Free People cities and strongholds or vice versa. But the true hope of the Free Peoples lies with the quest of the Ringbearer: while the armies clash across Middle Earth, the Fellowship of the Ring is trying to get secretly to Mount Doom to destroy the One Ring. Sauron is not aware of the real intention of his enemies but is looking across Middle Earth for the precious Ring, so that the Fellowship is going to face numerous dangers, represented by the rules of The Hunt for the Ring. But the Companions can spur the Free Peoples to the fight against Sauron, so the Free People player must balance the need to protect the Ringbearer from harm, against the attempt to raise a proper defense against the armies of the Shadow, so that they do not overrun Middle Earth before the Ringbearer completes his quest.', 1, 1, 1),
(20, 'Terra Mystica', 2, 5, 12, 99, 'In the land of Terra Mystica dwell 14 different peoples in seven landscapes, and each group is bound to its own home environment, so to develop and grow, they must terraform neighboring landscapes into their home environments in competition with the other groups. Terra Mystica is a full information game without any luck that rewards strategic planning. Each player governs one of the 14 groups. With subtlety and craft, the player must attempt to rule as great an area as possible and to develop that group\'s skills. There are also four religious cults in which you can progress. To do all that, each group has special skills and abilities.', 1, 2, 1),
(21, 'Concordia', 2, 5, 13, 99, 'Two thousand years ago, the Roman Empire ruled the lands around the Mediterranean Sea. With peace at the borders, harmony inside the provinces, uniform law, and a common currency, the economy thrived and gave rise to mighty Roman dynasties as they expanded throughout the numerous cities. Guide one of these dynasties and send colonists to the remote realms of the Empire; develop your trade network; and appease the ancient gods for their favor â all to gain the chance to emerge victorious! Concordia is a peaceful strategy game of economic development in Roman times for 2-5 players aged 13 and up. Instead of looking to the luck of dice or cards, players must rely on their strategic abilities. Be sure to watch your rivals to determine which goals they are pursuing and where you can outpace them! In the game, colonists are sent out from Rome to settle down in cities that produce bricks, food, tools, wine, and cloth.', 1, 2, 1),
(22, 'Wingspan', 1, 5, 10, 99, 'Wingspan is a competitive, medium-weight, card-driven, engine-building board game from Stonemaier Games.<br />\r\n<br />\r\nYou are bird enthusiastsâresearchers, bird watchers, ornithologists, and collectorsâseeking to discover and attract the best birds to your network of wildlife preserves. Each bird extends a chain of powerful combinations in one of your habitats (actions).', 1, 2, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notificationn`
--

CREATE TABLE `notificationn` (
  `id_notif` int(11) NOT NULL,
  `id_user` int(20) NOT NULL,
  `id_event` int(20) NOT NULL,
  `notif_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notif_read` tinyint(4) NOT NULL,
  `notif_contents` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `notificationn`
--

INSERT INTO `notificationn` (`id_notif`, `id_user`, `id_event`, `notif_date`, `notif_read`, `notif_contents`) VALUES
(1, 2, 1, '2020-04-30 16:15:41', 1, 'You have been invited to the event 1<br>by asterix<br>Date and time: 2020-04-30  18:30<br>Place: Sosnowiec<br>Game: ChiĹczyk'),
(2, 3, 1, '2020-04-30 16:15:41', 0, 'You have been invited to the event 1<br>by asterix<br>Date and time: 2020-04-30  18:30<br>Place: Sosnowiec<br>Game: ChiĹczyk'),
(3, 2, 1, '2020-04-30 16:28:23', 1, 'Someone has just left event 1.'),
(4, 3, 1, '2020-04-30 16:28:23', 0, 'Someone has just left event 1.'),
(5, 2, 1, '2020-04-30 16:28:26', 1, 'Someone has just left event 1.'),
(6, 3, 1, '2020-04-30 16:28:26', 0, 'Someone has just left event 1.'),
(7, 2, 2, '2020-04-30 20:38:09', 1, 'You have been invited to the event 2<br>by karol1212<br>Date and time: 2020-05-01  15:52<br>Place: Gliwice<br>Game: ChiĹczyk'),
(8, 3, 2, '2020-04-30 20:38:09', 0, 'You have been invited to the event 2<br>by karol1212<br>Date and time: 2020-05-01  15:52<br>Place: Gliwice<br>Game: ChiĹczyk'),
(9, 3, 2, '2020-04-30 20:44:55', 1, 'Someone has just left event 2.'),
(10, 10, 2, '2020-04-30 20:44:55', 0, 'Someone has just left event 2.'),
(11, 1, 2, '2020-05-01 00:15:33', 1, 'Someone has just left event 2.'),
(12, 1, 2, '2020-05-01 00:16:11', 1, 'Someone has just left event 2.'),
(13, 1, 2, '2020-05-01 00:18:51', 1, 'Someone has just left event 2.'),
(14, 1, 2, '2020-05-01 00:19:52', 1, 'Someone has just left event 2.'),
(15, 1, 2, '2020-05-01 00:22:32', 1, 'Someone has just left event 2.'),
(16, 1, 2, '2020-05-01 00:23:20', 1, 'Someone has just left event 2.'),
(17, 1, 2, '2020-05-01 00:24:23', 1, 'Someone has just left event 2.'),
(18, 1, 2, '2020-05-01 00:25:26', 1, 'Someone has just left event 2.'),
(19, 1, 2, '2020-05-01 00:28:39', 1, 'Someone has just left event 2.'),
(20, 3, 2, '2020-05-01 00:28:39', 1, 'Someone has just left event 2.'),
(21, 1, 2, '2020-05-01 01:10:14', 1, 'Someone has just left event 2.'),
(22, 3, 2, '2020-05-01 01:10:14', 1, 'Someone has just left event 2.'),
(23, 1, 2, '2020-05-01 01:11:26', 1, 'Someone has just left event 2.'),
(24, 1, 2, '2020-05-01 01:12:50', 1, 'Someone has just left event 2.'),
(25, 1, 2, '2020-05-01 01:13:50', 1, 'Someone has just left event 2.'),
(26, 5, 3, '2020-05-01 13:22:52', 0, 'You have been invited to the event 3<br>by asterix<br>Date and time: 2020-05-09  17:24<br>Place: Katowice <br>Game: ChiĹczyk'),
(27, 7, 3, '2020-05-01 13:22:52', 0, 'You have been invited to the event 3<br>by asterix<br>Date and time: 2020-05-09  17:24<br>Place: Katowice <br>Game: ChiĹczyk'),
(28, 8, 3, '2020-05-01 13:22:52', 0, 'You have been invited to the event 3<br>by asterix<br>Date and time: 2020-05-09  17:24<br>Place: Katowice <br>Game: ChiĹczyk'),
(29, 9, 3, '2020-05-01 13:22:52', 0, 'You have been invited to the event 3<br>by asterix<br>Date and time: 2020-05-09  17:24<br>Place: Katowice <br>Game: ChiĹczyk'),
(30, 10, 3, '2020-05-01 13:22:52', 0, 'You have been invited to the event 3<br>by asterix<br>Date and time: 2020-05-09  17:24<br>Place: Katowice <br>Game: ChiĹczyk'),
(31, 2, 3, '2020-05-01 13:29:28', 1, 'Someone has just left event 3.'),
(32, 2, 3, '2020-05-01 13:29:48', 1, 'Someone has just left event 3.'),
(33, 2, 3, '2020-05-01 13:29:53', 1, 'Someone has just left event 3.'),
(34, 2, 3, '2020-05-01 13:29:57', 1, 'Someone has just left event 3.'),
(35, 1, 3, '2020-05-03 12:31:27', 1, 'Event number 3 has changed: <br>Game: Ludo<br>Min and max age: 10  99'),
(36, 2, 3, '2020-05-03 12:31:27', 1, 'Event number 3 has changed: <br>Game: Ludo<br>Min and max age: 10  99'),
(37, 3, 3, '2020-05-03 12:31:27', 1, 'Event number 3 has changed: <br>Game: Ludo<br>Min and max age: 10  99'),
(38, 2, 5, '2020-05-09 12:43:54', 1, 'You have been invited to the event 5<br>by asterix<br>Date and time: 2020-05-26  15:43<br>Place: Katowice <br>Game: Wingspan'),
(39, 3, 5, '2020-05-09 12:43:54', 0, 'You have been invited to the event 5<br>by asterix<br>Date and time: 2020-05-26  15:43<br>Place: Katowice <br>Game: Wingspan'),
(40, 4, 6, '2020-05-09 17:46:04', 0, 'You have been invited to the event 6<br>by justyna<br>Date and time: 2020-05-10  15:15<br>Place: Sosnowiec ul. Zamkowa 14/140<br>Game: Scythe'),
(41, 1, 7, '2020-05-13 02:13:25', 1, 'You have been invited to the event 7<br>by obelix<br>Date and time: 2020-05-13  04:12<br>Place: ChorzĂłw<br>Game: Catan'),
(42, 3, 8, '2020-05-13 02:17:51', 0, 'You have been invited to the event 8<br>by obelix<br>Date and time: 2020-05-14  04:17<br>Place: Siemiany<br>Game: Monopoly'),
(43, 2, 9, '2020-05-13 05:04:32', 0, 'You have been invited to the event 9<br>by asterix<br>Date and time: 2020-05-17  14:00<br>Place: MysĹowice ul. Ceglana 32/12<br>Game: Terra Mystica'),
(44, 3, 9, '2020-05-13 05:04:32', 1, 'You have been invited to the event 9<br>by asterix<br>Date and time: 2020-05-17  14:00<br>Place: MysĹowice ul. Ceglana 32/12<br>Game: Terra Mystica'),
(45, 1, 10, '2020-05-13 05:06:52', 0, 'You have been invited to the event 10<br>by monikap96<br>Date and time: 2020-05-18  16:00<br>Place: Warszawa ul. Radosna 13/33<br>Game: Scythe'),
(46, 2, 10, '2020-05-13 05:06:52', 0, 'You have been invited to the event 10<br>by monikap96<br>Date and time: 2020-05-18  16:00<br>Place: Warszawa ul. Radosna 13/33<br>Game: Scythe'),
(58, 2, 18, '2020-06-04 07:42:31', 1, 'You have been invited to the event 18<br>by asterix<br>Date and time: 2020-06-04  09:45<br>Place: Katowice Cybermachina<br>Game: 5 Second Rule'),
(59, 3, 18, '2020-06-04 07:42:31', 0, 'You have been invited to the event 18<br>by asterix<br>Date and time: 2020-06-04  09:45<br>Place: Katowice Cybermachina<br>Game: 5 Second Rule'),
(60, 4, 18, '2020-06-04 07:42:31', 0, 'You have been invited to the event 18<br>by asterix<br>Date and time: 2020-06-04  09:45<br>Place: Katowice Cybermachina<br>Game: 5 Second Rule'),
(61, 2, 19, '2020-06-04 08:00:12', 0, 'You have been invited to the event 19<br>by asterix<br>Date and time: 2020-06-10  15:58<br>Place: Katowice Cybermachina<br>Game: 5 Second Rule'),
(62, 3, 19, '2020-06-04 08:00:12', 0, 'You have been invited to the event 19<br>by asterix<br>Date and time: 2020-06-10  15:58<br>Place: Katowice Cybermachina<br>Game: 5 Second Rule'),
(63, 2, 20, '2020-06-17 10:17:15', 0, 'You have been invited to the event 20<br>by asterix<br>Date and time: 2020-06-18  15:56<br>Place: Sosnowiec<br>Game: Ludo'),
(64, 4, 20, '2020-06-17 10:17:15', 0, 'You have been invited to the event 20<br>by asterix<br>Date and time: 2020-06-18  15:56<br>Place: Sosnowiec<br>Game: Ludo'),
(65, 5, 20, '2020-06-17 10:17:15', 0, 'You have been invited to the event 20<br>by asterix<br>Date and time: 2020-06-18  15:56<br>Place: Sosnowiec<br>Game: Ludo'),
(66, 11, 20, '2020-06-17 10:17:15', 0, 'You have been invited to the event 20<br>by asterix<br>Date and time: 2020-06-18  15:56<br>Place: Sosnowiec<br>Game: Ludo');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `user_login` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_password` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_email` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_role` enum('administrator','admin','user') COLLATE utf8_bin NOT NULL,
  `verif_key` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `user_activated` tinyint(1) DEFAULT '0',
  `user_description` longtext COLLATE utf8_bin,
  `user_avatar` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id_user`, `user_login`, `user_password`, `user_email`, `user_role`, `verif_key`, `user_activated`, `user_description`, `user_avatar`) VALUES
(1, 'asterix', 'b22571f11e91ff588f423210c305d92d', 'asterix@zz.pl', 'administrator', 'c647a6181b0439c3d3a372c1a482acfc', 1, 'asasffasfasafshjlikfgdfgdfgvvvvvvv', 1),
(2, 'obelix', '11d6449b8d7f6f69ef0acc891340e0e9', 'obelixx@galowie.pl', 'admin', '903f450af36bfa3b2c44c20b78bec0a0', 1, 'Hi everyone, my name is Bob. I am 25 years old and I am living in the best city ever. Guess :D \r\nMy hobby is playing board games of course, but sometimes I like spend time close to nature. Tent in the forest is the best way to chill in my opinion.', 1),
(3, 'justyna', '5feaf23a917ea19c9b4622d2369fe46d', 'justyna.nowaq@interia.pl', 'user', '0e67046e5368e9ad563ddc30663e19e1', 1, NULL, 0),
(4, 'testsd', '6a204bd89f3c8348afd5c77c717a097a', 'test@test.etss', 'user', '6ad4883cf8c964b12933e11e6154005d', 1, NULL, 0),
(5, 'zxczxc', '1a7fcdd5a9fd433523268883cfded9d0', 'p.mateo@interia.pl', 'user', '12a2bc58626113a669b505c305aaf93a', 1, NULL, 0),
(7, 'PLurka', '7116f429229e814e946538a7698e4620', 'pawellurka@gmail.com', 'user', 'f4edeed3aeb6acb4101574a7fd012ed2', 1, 'Bardzo zaciekawiony przybyĹem by zwiedzaÄ', 1),
(8, 'Demogrogron', '53fd9a5a592d9c38330d026fc49cfeda', 'szybcior96@o2.pl', 'admin', '884a6b383f06e013c3dca93b3ec65119', 1, 'FSAFSAFASFASFASFASASFFAS', 1),
(9, 'karol1212', '31a5481250f44521ff9cf1242577970b', 'karol.kowalsqi@onet.pl', 'user', 'c7f84ababf012bd038eb4a053e1018b5', 1, NULL, 0),
(10, 'beepbeep', 'f9480c8873775a676e74d33378b92ae6', 'beepbeep@zz.zz', 'user', 'c25ddb9cbdf05eaabb15f6578c0a18ac', 1, NULL, 1),
(11, 'testtest', '05a671c66aefea124cc08b76ea6d30bb', 'test@tset.ss', 'user', '350dd15b2c04ac6ab0fb73fa6b5340c9', 0, NULL, 0),
(12, 'useruser', '5cc32e366c87c4cb49e4309b75f57d64', 'monikap96@interia.pl', 'user', '5b41f7d943c5522c7705e9ca9f27258c', 1, NULL, 0),
(18, 'adminadmin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'adminadmin@zz.zz', 'user', '2f4ab9750a73cbd9ec5b15b78f29e8ae', 0, NULL, 0),
(31, 'monikap96', '6f7a9004f6872c7c0dad5284d3b8f68c', 'akirotnom@gmail.com', 'user', 'e412abcf4da90c966c2e4f8078adce25', 1, NULL, 0),
(32, 'pppppp', '9f5845cf6630c8c8ef54190503ec3274', 'p.pa@wp.pl', 'user', 'a7942d196ee42ec5ab78c6bca1f58856', 1, NULL, 0),
(33, 'Jakcze', '6f713fb5da2e4684d139e27def572a0e', 'cjakczerwonka@gmail.com', 'user', '42675b4ebeff9544ef284368013e8003', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_score`
--

CREATE TABLE `user_score` (
  `id_event` int(20) NOT NULL,
  `id_rated_by_user` int(20) NOT NULL,
  `id_rated_user` int(20) NOT NULL,
  `score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Zrzut danych tabeli `user_score`
--

INSERT INTO `user_score` (`id_event`, `id_rated_by_user`, `id_rated_user`, `score`) VALUES
(1, 10, 1, 5),
(3, 1, 2, 5),
(3, 1, 3, 5),
(3, 2, 1, 5),
(18, 1, 2, 3),
(18, 1, 3, 5);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `chat_event` (`id_event`),
  ADD KEY `chat_user` (`user_login`);

--
-- Indeksy dla tabeli `eventt`
--
ALTER TABLE `eventt`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `event_game` (`event_game`),
  ADD KEY `event_initiator` (`event_initiator`);

--
-- Indeksy dla tabeli `event_user`
--
ALTER TABLE `event_user`
  ADD PRIMARY KEY (`id_user`,`id_event`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `event_user_event_id` (`id_event`);

--
-- Indeksy dla tabeli `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id_game`),
  ADD UNIQUE KEY `game_name` (`game_name`);

--
-- Indeksy dla tabeli `notificationn`
--
ALTER TABLE `notificationn`
  ADD PRIMARY KEY (`id_notif`),
  ADD KEY `notif_user` (`id_user`),
  ADD KEY `notif_event` (`id_event`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_login` (`user_login`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indeksy dla tabeli `user_score`
--
ALTER TABLE `user_score`
  ADD PRIMARY KEY (`id_event`,`id_rated_by_user`,`id_rated_user`),
  ADD KEY `id_rated_by_user` (`id_rated_by_user`),
  ADD KEY `id_rated_user` (`id_rated_user`),
  ADD KEY `user_score_event_id` (`id_event`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `eventt`
--
ALTER TABLE `eventt`
  MODIFY `id_event` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `game`
--
ALTER TABLE `game`
  MODIFY `id_game` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT dla tabeli `notificationn`
--
ALTER TABLE `notificationn`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_event` FOREIGN KEY (`id_event`) REFERENCES `eventt` (`id_event`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `chat_user` FOREIGN KEY (`user_login`) REFERENCES `user` (`user_login`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `eventt`
--
ALTER TABLE `eventt`
  ADD CONSTRAINT `eventt_ibfk_1` FOREIGN KEY (`event_game`) REFERENCES `game` (`id_game`),
  ADD CONSTRAINT `eventt_ibfk_2` FOREIGN KEY (`event_initiator`) REFERENCES `user` (`id_user`);

--
-- Ograniczenia dla tabeli `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `event_user_event_id` FOREIGN KEY (`id_event`) REFERENCES `eventt` (`id_event`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `event_user_user_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `notificationn`
--
ALTER TABLE `notificationn`
  ADD CONSTRAINT `notif_event` FOREIGN KEY (`id_event`) REFERENCES `eventt` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notif_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `user_score`
--
ALTER TABLE `user_score`
  ADD CONSTRAINT `user_score_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `eventt` (`id_event`),
  ADD CONSTRAINT `user_score_ibfk_2` FOREIGN KEY (`id_rated_by_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `user_score_ibfk_3` FOREIGN KEY (`id_rated_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
