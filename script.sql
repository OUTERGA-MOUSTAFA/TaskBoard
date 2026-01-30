-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for taskboard
CREATE DATABASE IF NOT EXISTS `taskboard` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `taskboard`;

-- Dumping structure for table taskboard.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table taskboard.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table taskboard.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table taskboard.migrations: ~5 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2026_01_27_112000_create_tasks_table', 2),
	(6, '2026_01_27_133231_create_task_table', 2),
	(8, '2026_01_29_150726_add_deleted_at_to_tasks_table', 3);

-- Dumping structure for table taskboard.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table taskboard.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table taskboard.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table taskboard.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table taskboard.task
CREATE TABLE IF NOT EXISTS `task` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table taskboard.task: ~0 rows (approximately)
DELETE FROM `task`;

-- Dumping structure for table taskboard.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` datetime NOT NULL,
  `priorite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'à faire',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_user_id_foreign` (`user_id`),
  CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table taskboard.tasks: ~14 rows (approximately)
DELETE FROM `tasks`;
INSERT INTO `tasks` (`id`, `titre`, `description`, `deadline`, `priorite`, `statut`, `created_at`, `updated_at`, `user_id`, `deleted_at`) VALUES
	(1, 'Sql requetes', 'SELECT * FROM tasks WHERE id = $id AND user_id = current_user_id"""', '2026-01-28 15:59:00', 'high', 'to do', '2026-01-27 15:00:49', '2026-01-30 07:50:40', 1, NULL),
	(2, 'Sql stutement', 'les requetes sql des Do you have any suggestions on how we could improve this project overall? Let us know! Wed love to hear your', '2026-01-29 15:59:00', 'medium', 'in progress', '2026-01-27 15:00:49', '2026-01-30 08:11:40', 1, NULL),
	(4, 'Conection', 'Inscription/Connexion/Déconnexion"', '2026-01-28 15:59:00', 'medium', 'to do', '2026-01-27 15:00:49', '2026-01-30 08:11:37', 1, NULL),
	(6, 'Megration', 'I had this same issue recently and found fpdf to be too complicated when your HTML contains formatted text and images. I had my server admin install Webkit HTML to PDF. It works great.', '2026-01-26 16:26:02', 'low', 'in porgress', '2026-01-27 15:27:03', '2026-01-27 15:27:04', 2, NULL),
	(8, 'Handel use case', 'Au lieu de taper une adresse IP comme 157.240.229.35, l’utilisateur tape simplement www.facebook.com\n, et le DNS se charge de la traduction.', '2026-02-02 16:26:02', 'medium', 'done', '2026-01-27 15:27:03', '2026-01-30 07:50:49', 1, NULL),
	(9, 'Handel use case', 'Au lieu de taper une adresse IP comme 157.240.229.35, l’utilisateur tape simplement www.facebook.com\n, et le DNS se charge de la traduction.', '2026-02-02 16:26:02', 'medium', 'done', '2026-01-27 15:27:03', '2026-01-30 07:54:52', 1, NULL),
	(10, 'mostafa', 'Au lieu de taper une adresse IP comme 157.240.229.35, l’utilisateur tape simplement www.facebook.com\r\n, et le DNS se charge de la traduction."', '2026-02-02 16:26:00', 'medium', 'to do', '2026-01-27 15:27:03', '2026-01-30 07:55:12', 1, NULL),
	(11, 'Handel use case', 'Au lieu de taper une adresse IP comme 157.240.229.35, l’utilisateur tape simplement www.facebook.com\n, et le DNS se charge de la traduction.', '2026-02-02 16:26:02', 'medium', 'done', '2026-01-27 15:27:03', '2026-01-29 20:53:26', 1, NULL),
	(12, 'Handel use case', 'Au lieu de taper une adresse IP comme 157.240.229.35, l’utilisateur tape simplement www.facebook.com\n, et le DNS se charge de la traduction.', '2026-02-02 16:26:02', 'medium', 'done', '2026-01-27 15:27:03', '2026-01-29 21:22:10', 1, NULL),
	(19, 'Java', 'case	Au lieu de taper une adresse IP comme 157.240.229.35, l’utilisateur tape simplement www.facebook.com , et le DNS se charge de la traduction.', '2026-02-01 20:30:00', 'high', 'to do', '2026-01-29 20:14:59', '2026-01-30 07:55:00', 1, NULL),
	(21, 'test', 'Aliquip nesciunt ac', '2007-01-05 15:30:00', 'medium', 'in progress', '2026-01-29 21:17:00', '2026-01-30 07:54:32', 1, NULL),
	(22, 'Edward', 'Est aut voluptatem', '2001-11-02 03:34:00', 'medium', 'done', '2026-01-29 21:17:28', '2026-01-30 07:54:34', 1, NULL),
	(23, 'test2 test', 'Ullam nobis deleniti', '2023-10-25 03:33:00', 'medium', 'to do', '2026-01-29 21:20:26', '2026-01-30 08:10:45', 1, '2026-01-30 08:10:45'),
	(24, 'metamask wallet', 'الأتمتة (Automation) هي استخدام التكنولوجيا والبرمجيات والروبوتات لأداء المهام والعمليات التشغيلية (الصناعية، الإدارية، المنزلية) تلقائياً بأقل تدخل بشري ممكن. تهدف إلى زيادة الإنتاجية، تقليل الأخطاء البشرية، تعزيز الكفاءة، وتوفير الوقت والتكاليف. تشمل أنواعها أتمتة العمليات (RPA)، الأتمتة الصناعية، والأتمتة الذكية المعتمدة على الذكاء الاصطناعي', '2026-01-22 22:11:00', 'medium', 'à faire', '2026-01-30 08:02:51', '2026-01-30 08:10:26', 1, '2026-01-30 08:10:26'),
	(25, 'hologram', 'jbd dir="auto"  qn Collection/Paginator: هو مجموعة ديال العناصر (بحال سطيل ديال الحوت).', '2026-02-02 22:10:00', 'high', 'in progress', '2026-01-30 08:08:56', '2026-01-30 08:09:03', 1, NULL);

-- Dumping structure for table taskboard.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table taskboard.users: ~2 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Kim', 'Martina', 'pedroshanine@gmail.com', NULL, '$2y$12$KdNBrAAhJgbww/mO.TgVEeDfTzGrt4aChomoEDDn2dSNBRISxTnL6', NULL, '2026-01-26 22:02:02', '2026-01-26 22:02:02'),
	(2, 'Ahmed', 'Said', 'a@a.a', NULL, '$2y$12$qUZsIjR7cKgArbZZD/QDFupLU.7bJDHWg88GZZZOOwmEbK6CIbE2i', NULL, '2026-01-27 07:15:22', '2026-01-27 07:15:22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
