-- --------------------------------------------------------
-- Host:                         192.168.10.10
-- Versi server:                 5.7.19-0ubuntu0.16.04.1 - (Ubuntu)
-- OS Server:                    Linux
-- HeidiSQL Versi:               9.4.0.5168
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk spa
CREATE DATABASE IF NOT EXISTS `spa` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `spa`;

-- membuang struktur untuk table spa.akses_navigasi
CREATE TABLE IF NOT EXISTS `akses_navigasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `navigasi_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `slug` text NOT NULL,
  `sort_number` tinyint(4) DEFAULT NULL,
  `code` int(50) NOT NULL,
  `status` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.categori_posts
CREATE TABLE IF NOT EXISTS `categori_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_categories` varchar(50) DEFAULT NULL,
  `code_posts` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_booking
CREATE TABLE IF NOT EXISTS `data_booking` (
  `id_booking` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `qty_person` int(11) DEFAULT NULL,
  `day_request` date DEFAULT NULL,
  `time_request` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `name_costumer` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `note` varchar(255) DEFAULT NULL,
  `id_servicepack` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `id_spa` int(11) DEFAULT NULL,
  `hotel` varchar(255) DEFAULT NULL,
  `checkin_hotel` date DEFAULT NULL,
  `contact_hotel` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `grandtotal` decimal(10,2) DEFAULT NULL,
  `currenci_id` int(11) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT '0.00',
  `note_voucher` text,
  `paypal_payer_id` varchar(255) DEFAULT NULL,
  `paypal_payment_id` varchar(255) DEFAULT NULL,
  `paypal_status` int(11) DEFAULT '0',
  `paypal_date` datetime DEFAULT NULL,
  `invoice_note` varchar(255) DEFAULT NULL,
  `total_other` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_booking`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_gallerys
CREATE TABLE IF NOT EXISTS `data_gallerys` (
  `id_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `id_spa` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_gallery`)
) ENGINE=InnoDB AUTO_INCREMENT=3143 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_image_header
CREATE TABLE IF NOT EXISTS `data_image_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `description` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_invoice_bandung
CREATE TABLE IF NOT EXISTS `data_invoice_bandung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `grandtotal` decimal(10,2) DEFAULT NULL,
  `currenci_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_invoice_item_bandung
CREATE TABLE IF NOT EXISTS `data_invoice_item_bandung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `currenci_id` int(11) DEFAULT NULL,
  `id_booking` int(11) DEFAULT NULL,
  `share_profit` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `old_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_message
CREATE TABLE IF NOT EXISTS `data_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `spa_id` int(11) DEFAULT '0',
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_paladin
CREATE TABLE IF NOT EXISTS `data_paladin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(255) DEFAULT NULL,
  `idcard_name` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `gplus` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `rekening_paypal` varchar(255) DEFAULT NULL,
  `rekening_bca` varchar(255) DEFAULT NULL,
  `rekening_mandiri` varchar(255) DEFAULT NULL,
  `rekening_bni` varchar(255) DEFAULT NULL,
  `rekening_bri` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text,
  `seo_keywords` text,
  `bcc_booking_email` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `share_profit` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_pickup
CREATE TABLE IF NOT EXISTS `data_pickup` (
  `id_pickup` int(11) NOT NULL AUTO_INCREMENT,
  `id_booking` int(11) DEFAULT NULL,
  `hotel` varchar(255) DEFAULT NULL,
  `checkin` date DEFAULT NULL,
  `contact_hotel` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pickup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_schedule
CREATE TABLE IF NOT EXISTS `data_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `nm_schedule` varchar(255) DEFAULT NULL,
  `time_start` date DEFAULT NULL,
  `time_end` date DEFAULT NULL,
  `id_spa` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text,
  `hashtag` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_servicepack
CREATE TABLE IF NOT EXISTS `data_servicepack` (
  `id_servicepack` int(11) NOT NULL AUTO_INCREMENT,
  `id_spa` int(11) DEFAULT NULL,
  `servicepack` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `type` int(2) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `price_contract` decimal(10,2) DEFAULT NULL,
  `price_publish` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT '0',
  `percen_contract` decimal(10,2) DEFAULT '0.00',
  `minimal_pax` int(11) DEFAULT NULL,
  `free_pickup` varchar(2) DEFAULT '0',
  `description` text,
  `img_thumbnail` varchar(255) DEFAULT NULL,
  `status` int(255) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `currenci_id` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_servicepack`)
) ENGINE=InnoDB AUTO_INCREMENT=2001 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_share_profit_bandung
CREATE TABLE IF NOT EXISTS `data_share_profit_bandung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(10,2) DEFAULT NULL,
  `currenci_id` int(11) DEFAULT NULL,
  `id_booking` int(11) DEFAULT NULL,
  `share_profit` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.data_spa
CREATE TABLE IF NOT EXISTS `data_spa` (
  `id_spa` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `spa` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `id_regional` int(11) DEFAULT NULL,
  `description` text,
  `benefit` text,
  `facilities` text,
  `features` text,
  `work_day` varchar(100) DEFAULT NULL,
  `work_hour` varchar(100) DEFAULT NULL,
  `day_off` varchar(100) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `img_thumbnail` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `facebook` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `seo_title` varchar(100) DEFAULT NULL,
  `seo_keywords` text,
  `seo_description` varchar(255) DEFAULT NULL,
  `policy` text,
  `template_id` int(11) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `premium` int(1) DEFAULT '0',
  `header1` varchar(255) DEFAULT NULL,
  `header2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_spa`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `code` char(50) NOT NULL,
  `sort_number` tinyint(4) DEFAULT NULL,
  `status` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.levels
CREATE TABLE IF NOT EXISTS `levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nm_level` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.member_spa
CREATE TABLE IF NOT EXISTS `member_spa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type_id` tinyint(5) NOT NULL,
  `area_id` tinyint(5) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email_booking` varchar(50) NOT NULL,
  `web_url` varchar(100) NOT NULL,
  `web_title` varchar(200) NOT NULL,
  `web_desc` text NOT NULL,
  `logo` varchar(50) NOT NULL,
  `profile_pic` varchar(50) NOT NULL,
  `add_pkg` text NOT NULL,
  `add_svc` text NOT NULL,
  `add_menu` text NOT NULL,
  `menu_pkg` varchar(50) NOT NULL,
  `menu_svc` varchar(50) NOT NULL,
  `menu_others` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `last_update` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `actkey` varchar(50) NOT NULL,
  `count` int(8) NOT NULL,
  `reskey` varchar(50) NOT NULL,
  `home` text NOT NULL,
  `others` text NOT NULL,
  `approved` tinyint(2) NOT NULL,
  `header_thumb` varchar(50) NOT NULL,
  `header_source` varchar(50) NOT NULL,
  `login_ip` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=253 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.navigasi
CREATE TABLE IF NOT EXISTS `navigasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `class_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seri` int(11) NOT NULL DEFAULT '0',
  `ket` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(50) NOT NULL,
  `name` text NOT NULL,
  `slug` text NOT NULL,
  `sort_number` tinyint(4) DEFAULT NULL,
  `status` tinytext NOT NULL,
  `code` text NOT NULL,
  `page_categori` tinyint(4) NOT NULL,
  `stsdms` tinyint(4) NOT NULL,
  `function` char(50) NOT NULL,
  `seo_title` text NOT NULL,
  `seo_keywords` text NOT NULL,
  `seo_descriptions` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `title` text,
  `slug` text,
  `post` text,
  `status` tinytext,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `date_schedule_start` timestamp NULL DEFAULT NULL,
  `date_schedule_end` timestamp NULL DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `last_update_by` tinyint(4) DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `code_posts` char(50) DEFAULT NULL,
  `code_pages` char(50) DEFAULT NULL,
  `thumb` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.post_tags
CREATE TABLE IF NOT EXISTS `post_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_posts` varchar(50) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.ref_country
CREATE TABLE IF NOT EXISTS `ref_country` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `nm_country` varchar(80) NOT NULL,
  `iso` char(2) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id_country`)
) ENGINE=MyISAM AUTO_INCREMENT=238 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.ref_currencies
CREATE TABLE IF NOT EXISTS `ref_currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso_code` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `unicode` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comments` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.ref_regional
CREATE TABLE IF NOT EXISTS `ref_regional` (
  `id_regional` int(11) DEFAULT NULL,
  `nm_regional` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.ref_tax
CREATE TABLE IF NOT EXISTS `ref_tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.ref_templates
CREATE TABLE IF NOT EXISTS `ref_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(255) DEFAULT NULL,
  `template_path` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `for_premium` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.tags
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk table spa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `online` datetime DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Pengeluaran data tidak dipilih.
-- membuang struktur untuk view spa.view_booking_detail
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `view_booking_detail` (
	`id_booking` INT(11) NOT NULL,
	`code` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`qty_person` INT(11) NULL,
	`day_request` DATE NULL,
	`time_request` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`title` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`name_costumer` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`email` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`phone` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`address` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`city` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`country_id` INT(11) NULL,
	`status` INT(1) NULL,
	`note` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`id_servicepack` INT(11) NULL,
	`type` INT(11) NULL,
	`id_spa` INT(11) NULL,
	`hotel` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`checkin_hotel` DATE NULL,
	`contact_hotel` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`updated_at` TIMESTAMP NULL,
	`created_at` TIMESTAMP NULL,
	`deleted_at` DATETIME NULL,
	`subtotal` DECIMAL(10,2) NULL,
	`discount` DECIMAL(10,2) NULL,
	`grandtotal` DECIMAL(10,2) NULL,
	`currenci_id` INT(11) NULL,
	`tax` DECIMAL(10,2) NULL,
	`note_voucher` TEXT NULL COLLATE 'latin1_swedish_ci',
	`paypal_payer_id` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`paypal_payment_id` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`paypal_status` INT(11) NULL,
	`paypal_date` DATETIME NULL,
	`spa` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`address_spa` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`spa_slug` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`spa_img` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`spa_logo` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`premium` INT(1) NULL,
	`spa_phone` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`spa_fax` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`spa_desc` TEXT NULL COLLATE 'latin1_swedish_ci',
	`spa_email` VARCHAR(100) NULL COLLATE 'latin1_swedish_ci',
	`servicepack` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`servicepack_slug` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`servicepack_img` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`duration` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`iso_code` VARCHAR(3) NOT NULL COLLATE 'utf8_unicode_ci',
	`nm_country` VARCHAR(80) NOT NULL COLLATE 'latin1_swedish_ci',
	`iso` CHAR(2) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view spa.view_count_share_profit_bandung
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `view_count_share_profit_bandung` (
	`unpaid` BIGINT(21) NULL,
	`moderator` BIGINT(21) NULL,
	`paid` BIGINT(21) NULL,
	`total_all` BIGINT(21) NULL,
	`new_invoice` BIGINT(21) NULL
) ENGINE=MyISAM;

-- membuang struktur untuk view spa.view_currencies_used
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `view_currencies_used` (
	`id` INT(11) NULL,
	`iso` VARCHAR(3) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view spa.view_currencies_used_share_profit
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `view_currencies_used_share_profit` (
	`id` INT(11) NULL,
	`iso` VARCHAR(3) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

-- membuang struktur untuk view spa.view_dashboard_count_booking
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `view_dashboard_count_booking` (
	`new` BIGINT(21) NULL,
	`unpaid` BIGINT(21) NULL,
	`paid` BIGINT(21) NULL,
	`cancel` BIGINT(21) NULL,
	`total_book` BIGINT(21) NULL
) ENGINE=MyISAM;

-- membuang struktur untuk view spa.view_top_spa_on_month
-- Membuat tabel sementara untuk menangani kesalahan ketergantungan VIEW
CREATE TABLE `view_top_spa_on_month` (
	`id_spa` INT(11) NOT NULL,
	`spa` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`slug` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`img_thumbnail` VARCHAR(255) NULL COLLATE 'latin1_swedish_ci',
	`total_booking` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- membuang struktur untuk view spa.view_booking_detail
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `view_booking_detail`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_booking_detail` AS select `a`.`id_booking` AS `id_booking`,`a`.`code` AS `code`,`a`.`qty_person` AS `qty_person`,`a`.`day_request` AS `day_request`,`a`.`time_request` AS `time_request`,`a`.`title` AS `title`,`a`.`name_costumer` AS `name_costumer`,`a`.`email` AS `email`,`a`.`phone` AS `phone`,`a`.`address` AS `address`,`a`.`city` AS `city`,`a`.`country_id` AS `country_id`,`a`.`status` AS `status`,`a`.`note` AS `note`,`a`.`id_servicepack` AS `id_servicepack`,`a`.`type` AS `type`,`a`.`id_spa` AS `id_spa`,`a`.`hotel` AS `hotel`,`a`.`checkin_hotel` AS `checkin_hotel`,`a`.`contact_hotel` AS `contact_hotel`,`a`.`updated_at` AS `updated_at`,`a`.`created_at` AS `created_at`,`a`.`deleted_at` AS `deleted_at`,`a`.`subtotal` AS `subtotal`,`a`.`discount` AS `discount`,`a`.`grandtotal` AS `grandtotal`,`a`.`currenci_id` AS `currenci_id`,`a`.`tax` AS `tax`,`a`.`note_voucher` AS `note_voucher`,`a`.`paypal_payer_id` AS `paypal_payer_id`,`a`.`paypal_payment_id` AS `paypal_payment_id`,`a`.`paypal_status` AS `paypal_status`,`a`.`paypal_date` AS `paypal_date`,`b`.`spa` AS `spa`,`b`.`address` AS `address_spa`,`b`.`slug` AS `spa_slug`,`b`.`img_thumbnail` AS `spa_img`,`b`.`logo` AS `spa_logo`,`b`.`premium` AS `premium`,`b`.`phone` AS `spa_phone`,`b`.`fax` AS `spa_fax`,`b`.`description` AS `spa_desc`,`b`.`email` AS `spa_email`,`c`.`servicepack` AS `servicepack`,`c`.`slug` AS `servicepack_slug`,`c`.`img_thumbnail` AS `servicepack_img`,`c`.`duration` AS `duration`,`d`.`iso_code` AS `iso_code`,`e`.`nm_country` AS `nm_country`,`e`.`iso` AS `iso` from ((((`data_booking` `a` join `data_spa` `b` on((`b`.`id_spa` = `a`.`id_spa`))) join `data_servicepack` `c` on((`c`.`id_servicepack` = `a`.`id_servicepack`))) join `ref_currencies` `d` on((`d`.`id` = `a`.`currenci_id`))) join `ref_country` `e` on((`e`.`id_country` = `a`.`country_id`))) where isnull(`a`.`deleted_at`);

-- membuang struktur untuk view spa.view_count_share_profit_bandung
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `view_count_share_profit_bandung`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_count_share_profit_bandung` AS select (select count(0) from `data_share_profit_bandung` where ((`data_share_profit_bandung`.`status` = 1) and isnull(`data_share_profit_bandung`.`deleted_at`))) AS `unpaid`,(select count(0) from `data_share_profit_bandung` where ((`data_share_profit_bandung`.`status` = 2) and isnull(`data_share_profit_bandung`.`deleted_at`))) AS `moderator`,(select count(0) from `data_share_profit_bandung` where ((`data_share_profit_bandung`.`status` = 3) and isnull(`data_share_profit_bandung`.`deleted_at`))) AS `paid`,(select count(0) from `data_share_profit_bandung` where isnull(`data_share_profit_bandung`.`deleted_at`)) AS `total_all`,(select count(0) from `data_invoice_bandung` where ((`data_invoice_bandung`.`status` = 1) and isnull(`data_invoice_bandung`.`deleted_at`))) AS `new_invoice`;

-- membuang struktur untuk view spa.view_currencies_used
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `view_currencies_used`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_currencies_used` AS select `a`.`currenci_id` AS `id`,`b`.`iso_code` AS `iso` from (`data_booking` `a` join `ref_currencies` `b` on((`b`.`id` = `a`.`currenci_id`))) group by `a`.`currenci_id`;

-- membuang struktur untuk view spa.view_currencies_used_share_profit
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `view_currencies_used_share_profit`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_currencies_used_share_profit` AS select `a`.`currenci_id` AS `id`,`b`.`iso_code` AS `iso` from (`data_share_profit_bandung` `a` join `ref_currencies` `b` on((`b`.`id` = `a`.`currenci_id`))) group by `a`.`currenci_id`;

-- membuang struktur untuk view spa.view_dashboard_count_booking
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `view_dashboard_count_booking`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_dashboard_count_booking` AS select (select count(0) from `data_booking` where ((`data_booking`.`status` = 1) and isnull(`data_booking`.`deleted_at`))) AS `new`,(select count(0) from `data_booking` where ((`data_booking`.`status` = 2) and isnull(`data_booking`.`deleted_at`))) AS `unpaid`,(select count(0) from `data_booking` where ((`data_booking`.`status` = 3) and isnull(`data_booking`.`deleted_at`))) AS `paid`,(select count(0) from `data_booking` where ((`data_booking`.`status` = 4) and isnull(`data_booking`.`deleted_at`))) AS `cancel`,(select count(0) from `data_booking` where isnull(`data_booking`.`deleted_at`)) AS `total_book`;

-- membuang struktur untuk view spa.view_top_spa_on_month
-- Menghapus tabel sementara dan menciptakan struktur VIEW terakhir
DROP TABLE IF EXISTS `view_top_spa_on_month`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_top_spa_on_month` AS select `data_spa`.`id_spa` AS `id_spa`,`data_spa`.`spa` AS `spa`,`data_spa`.`slug` AS `slug`,`data_spa`.`img_thumbnail` AS `img_thumbnail`,count(`data_booking`.`id_spa`) AS `total_booking` from (`data_spa` left join `data_booking` on((`data_booking`.`id_spa` = `data_spa`.`id_spa`))) where ((month(`data_booking`.`created_at`) = month(now())) and (`data_booking`.`status` = 3)) group by `data_spa`.`id_spa` having (count(`data_booking`.`id_spa`) > 0) order by count(`data_booking`.`id_spa`) desc limit 5;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
