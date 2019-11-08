-- Adminer 4.7.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `routerapp`;
CREATE DATABASE `routerapp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `routerapp`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `metrics`;
CREATE TABLE `metrics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `risk_level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `metrics` (`id`, `patient_id`, `type`, `risk_level`, `created_at`, `updated_at`) VALUES
(1,	1,	'Heart Disease',	'High',	'2019-11-05 02:35:53',	'2019-11-05 02:35:53'),
(2,	2,	'Bronchitis',	'Low',	'2019-11-05 02:37:16',	'2019-11-05 02:37:16'),
(3,	3,	'Diabetes',	'Medium',	'2019-11-05 02:37:55',	'2019-11-05 02:37:55'),
(4,	4,	'Obesity',	'High',	'2019-11-05 02:42:16',	'2019-11-05 02:42:16')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `patient_id` = VALUES(`patient_id`), `type` = VALUES(`type`), `risk_level` = VALUES(`risk_level`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `patients` (`id`, `name`, `age`, `location`, `created_at`, `updated_at`) VALUES
(1,	'Linda Ryers',	'59',	'Hoboken, NJ',	'2019-11-05 02:29:46',	'2019-11-05 02:29:46'),
(2,	'Tilee Jacobs',	'71',	'Brooklyn, NY',	'2019-11-05 02:30:57',	'2019-11-05 02:30:57'),
(3,	'Kevon Oli',	'67',	'Monroe, NY',	'2019-11-05 02:32:05',	'2019-11-05 02:32:05'),
(4,	'Felix Jameson',	'86',	'Queens, NY',	'2019-11-05 02:32:56',	'2019-11-05 02:32:56')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `age` = VALUES(`age`), `location` = VALUES(`location`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

-- 2019-11-08 03:03:56
