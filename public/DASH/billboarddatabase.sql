-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `advertisements`;
CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ad_type` enum('text','image','video') NOT NULL,
  `content` longtext DEFAULT NULL,
  `media_path` varchar(500) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `duration` int(11) DEFAULT 10,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `advertisements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `advertisements` (`id`, `user_id`, `title`, `ad_type`, `content`, `media_path`, `start_time`, `end_time`, `is_active`, `created_at`, `duration`) VALUES
(9,	1,	'PINA',	'image',	'',	'/uploads/ad_6a2a836e330a2_1781171054.jpeg',	'12:43:00',	'12:47:00',	0,	'2026-06-11 09:44:14',	10),
(10,	1,	'CHECHE',	'image',	'',	'/uploads/ad_6a2a8658125f9_1781171800.jpeg',	'12:55:00',	'19:00:00',	0,	'2026-06-11 09:56:40',	31),
(11,	1,	'DIT SEMISTER EXAM',	'text',	'EVERY STUDENT WHO WILL PARSUE FOR SEMISTER EXAM MUST HAVE THE ID',	NULL,	'13:39:00',	'19:00:00',	0,	'2026-06-11 10:39:46',	5),
(12,	1,	'yasir ',	'text',	'TANGAZO TANGAZO TANGAZO !!!!!!!!\nNdugu wana ete kuna kijana anaitwa yasir aly hamadi \nanatafutwa na mpnzi wake ozalima',	NULL,	'16:23:00',	'17:23:00',	1,	'2026-06-11 13:24:07',	10);

DROP TABLE IF EXISTS `display_heartbeats`;
CREATE TABLE `display_heartbeats` (
  `id` varchar(64) NOT NULL,
  `last_seen` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `display_heartbeats` (`id`, `last_seen`) VALUES
('1909cff52a6b93bd103ee41dfab3fd04',	'2026-06-10 21:31:37'),
('344386d5e5bba2a3d89600ffbb85fbf9',	'2026-06-11 13:46:11'),
('4f71594b4a5d18d59d3b275827784a6e',	'2026-06-11 16:50:08'),
('6fac75c8ed92edcbfee2a878d45bd321',	'2026-06-11 13:00:38'),
('707b13da47e1413837318959d88ba18e',	'2026-06-11 16:34:08'),
('8e7639584c34e6611df40abfc98728fa',	'2026-06-11 13:00:53'),
('b1374913372bcd39b4f80b5a9f61f862',	'2026-06-11 16:27:53'),
('c15ee4b4954de621d4ce2f432fc0d37e',	'2026-06-11 08:12:18'),
('c323aa148902ff5626760de01ccd56a0',	'2026-06-11 11:56:25'),
('cc8bb56cacceaf42dd18a9448a4122da',	'2026-06-11 16:50:48'),
('ef2840ac8293eabc17f4ff0e30906123',	'2026-06-11 14:05:14'),
('f6bbb1e0fd79a76446f50bef7c0c3699',	'2026-06-11 14:35:51');

DROP TABLE IF EXISTS `schedule_details`;
CREATE TABLE `schedule_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `day_of_week` varchar(10) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_enabled` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `ad_id` (`ad_id`),
  CONSTRAINT `schedule_details_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `advertisements` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `schedule_details` (`id`, `ad_id`, `day_of_week`, `start_date`, `end_date`, `is_enabled`) VALUES
(21,	9,	'Thursday',	'2026-06-11',	'2026-06-11',	1),
(22,	10,	'Thursday',	'2026-06-11',	'2026-06-11',	1),
(23,	11,	'Thursday',	'2026-06-11',	'2026-06-11',	1),
(24,	12,	'Monday',	NULL,	NULL,	1),
(25,	12,	'Tuesday',	NULL,	NULL,	1),
(26,	12,	'Wednesday',	NULL,	NULL,	1),
(27,	12,	'Thursday',	NULL,	NULL,	1),
(28,	12,	'Friday',	NULL,	NULL,	1),
(29,	12,	'Saturday',	NULL,	NULL,	1),
(30,	12,	'Sunday',	NULL,	NULL,	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `email`, `password`, `name`, `company_name`, `created_at`) VALUES
(1,	'admin@billboard.com',	'$2y$10$n3a.y.HaZjyTCMWMazeMsubu/NcrpgQiVFfIItgQznbKkuIb3eOnK',	'Denis',	'DIT',	'2026-06-10 05:01:10');

-- 2026-06-11 13:50:56
