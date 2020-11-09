-- Adminer 4.7.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `boards`;
CREATE TABLE `boards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `boards` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'CSM',	NULL,	NULL),
(2,	'CSMB',	NULL,	NULL);

DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `grades` (`id`, `grade`, `student_id`, `created_at`, `updated_at`) VALUES
(1,	'5',	1,	NULL,	NULL),
(2,	'3',	1,	NULL,	NULL),
(4,	'8',	1,	NULL,	NULL),
(5,	'10',	1,	NULL,	NULL),
(6,	'10',	2,	NULL,	NULL),
(7,	'8',	2,	NULL,	NULL),
(8,	'9',	2,	NULL,	NULL),
(10,	'9',	3,	NULL,	NULL),
(12,	'6',	4,	NULL,	NULL);

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `board_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `students` (`id`, `name`, `board_id`, `created_at`, `updated_at`) VALUES
(1,	'Bogdan',	1,	NULL,	NULL),
(2,	'Luka',	2,	NULL,	NULL),
(3,	'Branko',	2,	NULL,	NULL),
(4,	'Kristina',	1,	NULL,	NULL),
(5,	'Marina',	1,	NULL,	NULL);

-- 2020-11-09 13:40:56