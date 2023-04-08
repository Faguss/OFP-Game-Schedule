-- These are Userspice settings required for the OFP Game Schedule

ALTER TABLE `users` ADD `timezone` VARCHAR(255) NOT NULL DEFAULT 'Europe/Warsaw';
UPDATE `settings` SET `us_css3` = '../usersc/css/custom.css' WHERE `settings`.`id` = 1;

INSERT INTO `pages` (`id`, `page`, `title`, `private`, `re_auth`) VALUES
(1, 'index.php', 'Home', 0, 0),
(91, 'common.php', '', 1, 0),
(92, 'edit_mod.php', 'Edit Mod', 0, 0),
(93, 'edit_server.php', 'Edit Server', 0, 0),
(94, 'header.php', '', 1, 0),
(95, 'privacy_policy.php', 'Privacy Policy', 0, 0),
(96, 'sqf.php', '', 0, 0),
(98, 'footer.php', '', 1, 0),
(101, 'installationscripts.php', 'Scripting Docs', 0, 0),
(104, 'quickstart.php', 'Quickstart', 0, 0),
(115, 'test.php', '', 0, 0),
(117, 'installdedicated.php', 'Dedicated Server', 0, 0),
(121, 'api.php', '', 1, 0),
(122, 'show.php', 'Info', 0, 0),
(126, 'api_documentation.php', 'API Docs', 0, 0),
(127, 'recent_activity.php', 'Event Log', 0, 0),
(128, 'rss.php', '', 1, 0),
(129, 'admin_log.php', 'Event Log', 0, 0),
(130, 'minimal_init.php', '', 1, 0),
(133, 'allmods.php', 'Mod List', 0, 0),
(141, 'js_request.php', '', 1, 0),
(142, 'modupdates.php', 'Mod Updates', 0, 0),
(159, 'translation.php', 'Translation Editor', 0, 0),
(161, 'translation_request.php', '', 1, 0),
(162, 'translation_strings.php', '', 1, 0);

INSERT INTO `permissions` (`id`, `name`) VALUES
(3, 'Unlimited User'),
(4, 'Experienced User'),
(5, 'russian_translator'),
(6, 'polish_translator'),
(7, 'english_translator');

INSERT INTO `permission_page_matches` (`id`, `permission_id`, `page_id`) VALUES
(58, 1, 92),
(59, 2, 92),
(60, 1, 93),
(61, 2, 93),
(64, 1, 95),
(65, 2, 95),
(66, 1, 96),
(67, 2, 96),
(74, 1, 101),
(75, 2, 101),
(76, 1, 104),
(77, 2, 104),
(86, 2, 129),
(90, 5, 159),
(91, 6, 159),
(92, 7, 159);

INSERT INTO `menus` (`id`, `menu_title`, `parent`, `dropdown`, `logged_in`, `display_order`, `label`, `link`, `icon_class`) VALUES
(2, 'main', -1, 1, 1, 30, '', '', 'fa fa-fw fa-cogs'),
(3, 'main', -1, 0, 1, 1, '{{username}}', 'users/account.php', 'fa fa-fw fa-user'),
(25, 'main', 33, 0, 0, 5, '{{GS_STR_MENU_INSTALLSCRIPTS}}', 'install_scripts', 'fa fa-fw fa-book'),
(26, 'main', 33, 0, 0, 3, '{{GS_STR_MENU_QUICKSTART}}', 'quickstart', 'fa fa-fw fa-life-ring'),
(36, 'main', 33, 0, 0, 11, '{{GS_STR_MENU_BIFORUM}}', 'https://forums.bohemia.net/forums/topic/202547-game-schedule-with-fwatch/', 'fa fa-fw fa-comments'),
(34, 'main', 33, 0, 0, 10, '{{GS_STR_MENU_STEAMFORUM}}', 'https://steamcommunity.com/app/65790/discussions/0/135510393205713439/', 'fa fa-fw fa-steam-square'),
(9, 'main', 2, 0, 1, 40, '{{MENU_DASH}}', 'users/admin.php', 'fa fa-fw fa-cogs'),
(10, 'main', 2, 0, 1, 50, '{{MENU_USER_MGR}}', 'users/admin.php?view=users', 'fa fa-fw fa-user'),
(11, 'main', 2, 0, 1, 60, '{{MENU_PERM_MGR}}', 'users/admin.php?view=permissions', 'fa fa-fw fa-lock'),
(12, 'main', 2, 0, 1, 70, '{{MENU_PAGE_MGR}}', 'users/admin.php?view=pages', 'fa fa-fw fa-wrench'),
(13, 'main', 2, 0, 1, 80, '{{MENU_MSGS_MGR}}', 'users/admin.php?view=messages', 'fa fa-fw fa-envelope'),
(14, 'main', 2, 0, 1, 90, '{{MENU_LOGS_MGR}}', 'users/admin.php?view=logs', 'fa fa-fw fa-search'),
(15, 'main', 33, 0, 1, 100, '{{hr}}', '', ''),
(16, 'main', 33, 0, 1, 110, '{{MENU_LOGOUT}}', 'users/logout.php', 'fa fa-fw fa-sign-out'),
(27, 'main', 33, 0, 0, 9, '{{GS_STR_MENU_VIDEOS}}', 'https://www.youtube.com/playlist?list=PLdz-dynlxN35fbZaUti68fBqqvN0KLm7Y', 'fa fa-fw fa-youtube-play'),
(20, 'main', -1, 0, 1, 12, '{{notifications}}', '', ''),
(21, 'main', -1, 0, 1, 13, '{{messages}}', '', ''),
(33, 'main', -1, 1, 0, 20, '{{SCHEDULE_MENU}}', '#', 'fa fa-fw fa-bars'),
(44, 'main', 33, 0, 0, 8, '{{hr}}', '#', ''),
(39, 'main', -1, 0, 0, 99999, '{{SIGNIN_BUTTONTEXT}}', 'users\\login.php', 'fa fa-fw fa-sign-in'),
(40, 'main', 33, 0, 0, 13, '{{GS_STR_MENU_FACEBOOKFORUM}}', 'https://www.facebook.com/groups/OFPARMA/permalink/2730898786961121/', 'fa fa-fw fa-facebook-official'),
(42, 'main', 33, 0, 0, 14, '{{GS_STR_MENU_VKFORUM}}', 'https://vk.com/wall-98104039_7364', 'fa fa-fw fa-vk'),
(46, 'main', 33, 0, 0, 6, '{{GS_STR_MENU_DEDICATED}}', 'dedicated_server', 'fa fa-fw fa-book'),
(48, 'main', 33, 0, 0, 7, 'API', 'api_documentation', 'fa fa-fw fa-book'),
(49, 'main', 33, 0, 0, 15, '{{SCHEDULE_SOURCE_CODE}}', 'https://github.com/Faguss/OFP-Game-Schedule', 'fa fa-fw fa-github'),
(50, 'main', 33, 0, 0, 12, '{{GS_STR_MENU_GOGFORUM}}', 'https://www.gog.com/forum/arma_series/arma_cwa_with_fwatch_116', 'fa fa-fw fa-comments'),
(51, 'main', 33, 0, 0, 4, '{{GS_STR_MENU_MODUPDATES}}', 'mod_updates', 'fa fa-fw fa-book'),
(52, 'main', 33, 0, 1, 105, '{{GS_STR_MENU_TRANSLATION}}', 'translation.php', 'fa fa-fw fa-language');

INSERT INTO `groups_menus` (`id`, `group_id`, `menu_id`) VALUES
(200, 0, 50),
(180, 0, 49),
(26, 0, 20),
(25, 0, 18),
(168, 0, 26),
(169, 0, 25),
(81, 0, 24),
(74, 0, 23),
(170, 0, 27),
(71, 0, 29),
(77, 0, 30),
(75, 0, 31),
(163, 0, 32),
(172, 0, 34),
(183, 0, 33),
(173, 0, 36),
(145, 0, 39),
(177, 0, 48),
(20, 0, 47),
(171, 0, 46),
(165, 0, 37),
(174, 0, 40),
(201, 0, 51),
(164, 0, 35),
(6, 0, 1),
(107, 0, 3),
(144, 0, 21),
(28, 0, 7),
(29, 0, 8),
(106, 0, 38),
(166, 0, 41),
(128, 0, 45),
(175, 0, 42),
(122, 0, 44),
(167, 0, 43),
(196, 1, 16),
(184, 1, 15),
(197, 2, 16),
(185, 2, 15),
(139, 2, 10),
(138, 2, 11),
(80, 2, 2),
(146, 2, 39),
(135, 2, 9),
(141, 2, 14),
(142, 2, 13),
(137, 2, 12),
(198, 3, 16),
(186, 3, 15),
(199, 4, 16),
(187, 4, 15),
(208, 0, 52);

-- --------------------------------------------------------

-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2023 at 05:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ofpfagus_schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `gs_announce`
--

CREATE TABLE `gs_announce` (
  `id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_log`
--

CREATE TABLE `gs_log` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0,
  `added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods`
--

CREATE TABLE `gs_mods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subtitle` varchar(10) DEFAULT NULL,
  `description` text NOT NULL,
  `uniqueid` varchar(10) NOT NULL,
  `removed` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `access` varchar(10) NOT NULL,
  `forcename` tinyint(4) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `is_mp` tinyint(1) NOT NULL DEFAULT 1,
  `dls_new` int(11) NOT NULL DEFAULT 0,
  `dls_upd` int(11) NOT NULL DEFAULT 0,
  `website` text NOT NULL,
  `logo` text NOT NULL,
  `logohash` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods_admins`
--

CREATE TABLE `gs_mods_admins` (
  `id` int(11) NOT NULL,
  `modid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isowner` tinyint(1) NOT NULL DEFAULT 0,
  `right_edit` tinyint(1) NOT NULL DEFAULT 0,
  `right_update` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods_links`
--

CREATE TABLE `gs_mods_links` (
  `id` int(11) NOT NULL,
  `uniqueid` varchar(10) NOT NULL,
  `updateid` int(11) NOT NULL,
  `scriptid` int(11) NOT NULL,
  `fromver` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `removed` tinyint(4) NOT NULL DEFAULT 0,
  `alwaysnewest` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods_scripts`
--

CREATE TABLE `gs_mods_scripts` (
  `id` int(11) NOT NULL,
  `size` varchar(100) NOT NULL,
  `script` text NOT NULL,
  `uniqueid` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_mods_updates`
--

CREATE TABLE `gs_mods_updates` (
  `id` int(11) NOT NULL,
  `modid` int(11) NOT NULL,
  `scriptid` int(11) NOT NULL,
  `version` float NOT NULL DEFAULT 1,
  `changelog` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_serv`
--

CREATE TABLE `gs_serv` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `version` float NOT NULL DEFAULT 1.99,
  `equalmodreq` tinyint(1) NOT NULL DEFAULT 0,
  `languages` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `website` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `logohash` text NOT NULL,
  `uniqueid` varchar(10) NOT NULL,
  `removed` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `access` varchar(10) NOT NULL,
  `maxcustomfilesize` varchar(10) NOT NULL,
  `voice` text NOT NULL,
  `persistent` tinyint(1) NOT NULL DEFAULT 0,
  `status` text NOT NULL,
  `status_expires` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_serv_admins`
--

CREATE TABLE `gs_serv_admins` (
  `id` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isowner` tinyint(1) NOT NULL DEFAULT 0,
  `right_edit` tinyint(1) NOT NULL DEFAULT 0,
  `right_schedule` tinyint(1) NOT NULL DEFAULT 0,
  `right_mods` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_serv_mods`
--

CREATE TABLE `gs_serv_mods` (
  `id` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `modid` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `removed` tinyint(4) NOT NULL DEFAULT 0,
  `loadorder` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gs_serv_times`
--

CREATE TABLE `gs_serv_times` (
  `id` int(11) NOT NULL,
  `serverid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `starttime` timestamp NOT NULL DEFAULT current_timestamp(),
  `timezone` varchar(100) NOT NULL DEFAULT 'Europe/Warsaw',
  `duration` int(11) NOT NULL DEFAULT 60,
  `uniqueid` varchar(10) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `createdby` int(11) NOT NULL DEFAULT 0,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedby` int(11) NOT NULL DEFAULT 0,
  `removed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_announce`
--
ALTER TABLE `gs_announce`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_log`
--
ALTER TABLE `gs_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_mods`
--
ALTER TABLE `gs_mods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueID` (`uniqueid`);

--
-- Indexes for table `gs_mods_admins`
--
ALTER TABLE `gs_mods_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modid` (`modid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `gs_mods_links`
--
ALTER TABLE `gs_mods_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniqueID` (`uniqueid`),
  ADD KEY `updateid` (`updateid`),
  ADD KEY `scriptid` (`scriptid`);

--
-- Indexes for table `gs_mods_scripts`
--
ALTER TABLE `gs_mods_scripts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniqueID` (`uniqueid`);

--
-- Indexes for table `gs_mods_updates`
--
ALTER TABLE `gs_mods_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modid` (`modid`),
  ADD KEY `scriptid` (`scriptid`);

--
-- Indexes for table `gs_serv`
--
ALTER TABLE `gs_serv`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`uniqueid`),
  ADD KEY `id2` (`uniqueid`),
  ADD KEY `uniqueID` (`uniqueid`);

--
-- Indexes for table `gs_serv_admins`
--
ALTER TABLE `gs_serv_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ServerID` (`serverid`),
  ADD KEY `UserID` (`userid`);

--
-- Indexes for table `gs_serv_mods`
--
ALTER TABLE `gs_serv_mods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ModID` (`modid`),
  ADD KEY `ServerID` (`serverid`);

--
-- Indexes for table `gs_serv_times`
--
ALTER TABLE `gs_serv_times`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueID` (`uniqueid`),
  ADD KEY `ServerID` (`serverid`),
  ADD KEY `UserID` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_announce`
--
ALTER TABLE `gs_announce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_log`
--
ALTER TABLE `gs_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods`
--
ALTER TABLE `gs_mods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods_admins`
--
ALTER TABLE `gs_mods_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods_links`
--
ALTER TABLE `gs_mods_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods_scripts`
--
ALTER TABLE `gs_mods_scripts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_mods_updates`
--
ALTER TABLE `gs_mods_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_serv`
--
ALTER TABLE `gs_serv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_serv_admins`
--
ALTER TABLE `gs_serv_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_serv_mods`
--
ALTER TABLE `gs_serv_mods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gs_serv_times`
--
ALTER TABLE `gs_serv_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
