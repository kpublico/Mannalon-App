-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: mannalon_app
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `mannalon_app`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `mannalon_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `mannalon_app`;

--
-- Table structure for table `admin_supervisor_assignments`
--

DROP TABLE IF EXISTS `admin_supervisor_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_supervisor_assignments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `super_admin_user_id` bigint(20) unsigned NOT NULL,
  `admin_user_id` bigint(20) unsigned NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ended_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_superadmin_admin` (`super_admin_user_id`,`admin_user_id`),
  KEY `admin_supervisor_assignments_admin_user_id_is_active_index` (`admin_user_id`,`is_active`),
  CONSTRAINT `admin_supervisor_assignments_admin_user_id_foreign` FOREIGN KEY (`admin_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admin_supervisor_assignments_super_admin_user_id_foreign` FOREIGN KEY (`super_admin_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_supervisor_assignments`
--

LOCK TABLES `admin_supervisor_assignments` WRITE;
/*!40000 ALTER TABLE `admin_supervisor_assignments` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_supervisor_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` enum('Alert','General','Weather') NOT NULL DEFAULT 'General',
  `content` text NOT NULL,
  `audience_scope` enum('all','specific_group') NOT NULL DEFAULT 'all',
  `target_group_id` bigint(20) unsigned DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `posted_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcements_posted_by_foreign` (`posted_by`),
  KEY `announcements_category_index` (`category`),
  KEY `announcements_created_at_index` (`created_at`),
  KEY `announcements_target_group_id_foreign` (`target_group_id`),
  KEY `idx_ann_scope_publish` (`audience_scope`,`is_published`),
  CONSTRAINT `announcements_posted_by_foreign` FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `announcements_target_group_id_foreign` FOREIGN KEY (`target_group_id`) REFERENCES `farmer_groups` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (2,'≡ƒî╛ Welcome! Announcements are Working!','General','If you see this, announcements are now working correctly for farmers. Admin posts are visible here!','all',NULL,1,NULL,NULL,'2026-04-25',1,'2026-03-25 00:22:18','2026-03-25 00:22:18'),(3,'Demo','Alert','Demo','all',NULL,1,NULL,NULL,'2026-04-03',1,'2026-03-25 00:26:28','2026-03-25 00:26:28');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beneficiaries`
--

DROP TABLE IF EXISTS `beneficiaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiaries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_id` bigint(20) unsigned NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `program_name` varchar(255) DEFAULT NULL,
  `aid_amount` decimal(12,2) DEFAULT NULL,
  `ayuda_status` enum('pending','claimed') NOT NULL DEFAULT 'pending',
  `distributed_at` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `beneficiaries_farmer_id_foreign` (`farmer_id`),
  KEY `beneficiaries_service_type_ayuda_status_index` (`service_type`,`ayuda_status`),
  CONSTRAINT `beneficiaries_farmer_id_foreign` FOREIGN KEY (`farmer_id`) REFERENCES `farmers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beneficiaries`
--

LOCK TABLES `beneficiaries` WRITE;
/*!40000 ALTER TABLE `beneficiaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `beneficiaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodity_prices`
--

DROP TABLE IF EXISTS `commodity_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `commodity` varchar(120) NOT NULL,
  `price_per_kilo` decimal(10,2) NOT NULL,
  `date_updated` date NOT NULL,
  `source_market` varchar(120) DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commodity_prices_updated_by_foreign` (`updated_by`),
  KEY `commodity_prices_commodity_index` (`commodity`),
  KEY `commodity_prices_date_updated_index` (`date_updated`),
  CONSTRAINT `commodity_prices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodity_prices`
--

LOCK TABLES `commodity_prices` WRITE;
/*!40000 ALTER TABLE `commodity_prices` DISABLE KEYS */;
INSERT INTO `commodity_prices` VALUES (1,'Palay',1000.00,'2026-03-13','efef',1,'2026-03-25 01:53:13','2026-03-25 01:53:13');
/*!40000 ALTER TABLE `commodity_prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `communication_permissions`
--

DROP TABLE IF EXISTS `communication_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `communication_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sender_role` varchar(255) NOT NULL,
  `recipient_role` varchar(255) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `communication_method` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `conditions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`conditions`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communication_permissions`
--

LOCK TABLES `communication_permissions` WRITE;
/*!40000 ALTER TABLE `communication_permissions` DISABLE KEYS */;
INSERT INTO `communication_permissions` VALUES (1,'farmer','admin',1,'direct','Farmer can send direct messages to admin',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(2,'farmer','coordinator',1,'direct','Farmer can send direct messages to coordinator',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(3,'farmer','farmer',1,'direct','Farmers can communicate with each other',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(4,'admin','farmer',1,'direct','Admin can send direct messages to farmer',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(5,'admin','farmer',1,'broadcast','Admin can broadcast announcements to farmers',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(6,'admin','admin',1,'direct','Admins can communicate with each other',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(7,'admin','super_admin',1,'direct','Admin can report to super admin',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(8,'admin','coordinator',1,'direct','Admin can coordinate with coordinator',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(9,'super_admin','admin',1,'direct','Super admin can send directives to admin',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(10,'super_admin','admin',1,'broadcast','Super admin can broadcast to all admins',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(11,'super_admin','super_admin',1,'direct','Super admins can communicate with each other',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(12,'super_admin','farmer',1,'announcement','Super admin can send system announcements to farmers',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(13,'coordinator','farmer',1,'direct','Coordinator can assist farmers',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(14,'coordinator','admin',1,'direct','Coordinator can report to admin',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17'),(15,'coordinator','coordinator',1,'direct','Coordinators can share information',NULL,'2026-09-12 20:00:17','2026-09-12 20:00:17');
/*!40000 ALTER TABLE `communication_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversation_threads`
--

DROP TABLE IF EXISTS `conversation_threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conversation_threads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `initiator_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `last_message_id` bigint(20) unsigned DEFAULT NULL,
  `last_activity_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `closed_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conversation_threads_initiator_id_foreign` (`initiator_id`),
  KEY `conversation_threads_last_message_id_foreign` (`last_message_id`),
  CONSTRAINT `conversation_threads_initiator_id_foreign` FOREIGN KEY (`initiator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `conversation_threads_last_message_id_foreign` FOREIGN KEY (`last_message_id`) REFERENCES `messages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversation_threads`
--

LOCK TABLES `conversation_threads` WRITE;
/*!40000 ALTER TABLE `conversation_threads` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversation_threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crop_reports`
--

DROP TABLE IF EXISTS `crop_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crop_reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `reported_by_user_id` bigint(20) unsigned NOT NULL,
  `reviewed_by_admin_user_id` bigint(20) unsigned DEFAULT NULL,
  `crop_name` varchar(120) NOT NULL,
  `season` varchar(60) DEFAULT NULL,
  `area_hectares` decimal(10,2) DEFAULT NULL,
  `planting_date` date DEFAULT NULL,
  `expected_harvest_date` date DEFAULT NULL,
  `actual_harvest_date` date DEFAULT NULL,
  `estimated_yield_kg` decimal(12,2) DEFAULT NULL,
  `actual_yield_kg` decimal(12,2) DEFAULT NULL,
  `status` enum('draft','submitted','approved','rejected') NOT NULL DEFAULT 'draft',
  `remarks` text DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `crop_reports_reviewed_by_admin_user_id_foreign` (`reviewed_by_admin_user_id`),
  KEY `crop_reports_farmer_profile_id_status_index` (`farmer_profile_id`,`status`),
  KEY `crop_reports_reported_by_user_id_planting_date_index` (`reported_by_user_id`,`planting_date`),
  CONSTRAINT `crop_reports_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `crop_reports_reported_by_user_id_foreign` FOREIGN KEY (`reported_by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `crop_reports_reviewed_by_admin_user_id_foreign` FOREIGN KEY (`reviewed_by_admin_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crop_reports`
--

LOCK TABLES `crop_reports` WRITE;
/*!40000 ALTER TABLE `crop_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `crop_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crops`
--

DROP TABLE IF EXISTS `crops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crops` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `crop_type` varchar(255) DEFAULT NULL,
  `area_planted` decimal(10,2) DEFAULT NULL,
  `planting_date` date DEFAULT NULL,
  `expected_harvest_date` date DEFAULT NULL,
  `status` enum('planning','growing','ready','harvested') NOT NULL DEFAULT 'planning',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `crops_user_id_foreign` (`user_id`),
  CONSTRAINT `crops_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crops`
--

LOCK TABLES `crops` WRITE;
/*!40000 ALTER TABLE `crops` DISABLE KEYS */;
/*!40000 ALTER TABLE `crops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farm_details`
--

DROP TABLE IF EXISTS `farm_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farm_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_id` bigint(20) unsigned NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `farm_size` decimal(10,2) NOT NULL DEFAULT 0.00,
  `land_type` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farm_details_farmer_id_foreign` (`farmer_id`),
  KEY `farm_details_latitude_longitude_index` (`latitude`,`longitude`),
  CONSTRAINT `farm_details_farmer_id_foreign` FOREIGN KEY (`farmer_id`) REFERENCES `farmers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_details`
--

LOCK TABLES `farm_details` WRITE;
/*!40000 ALTER TABLE `farm_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `farm_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farm_equipment`
--

DROP TABLE IF EXISTS `farm_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farm_equipment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farm_record_id` bigint(20) unsigned NOT NULL,
  `equipment_name` varchar(150) NOT NULL,
  `equipment_type` enum('tractor','plow','harvester','thresher','irrigation_pump','sprayer','other') NOT NULL DEFAULT 'other',
  `equipment_description` varchar(255) DEFAULT NULL,
  `ownership_status` enum('owned','borrowed','rented','shared') NOT NULL DEFAULT 'owned',
  `purchase_date` date DEFAULT NULL,
  `equipment_cost` decimal(12,2) DEFAULT NULL,
  `condition` enum('excellent','good','fair','poor') NOT NULL DEFAULT 'good',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farm_equipment_farm_record_id_index` (`farm_record_id`),
  CONSTRAINT `farm_equipment_farm_record_id_foreign` FOREIGN KEY (`farm_record_id`) REFERENCES `farm_records` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_equipment`
--

LOCK TABLES `farm_equipment` WRITE;
/*!40000 ALTER TABLE `farm_equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `farm_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farm_inputs`
--

DROP TABLE IF EXISTS `farm_inputs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farm_inputs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farm_record_id` bigint(20) unsigned NOT NULL,
  `input_type` enum('fertilizer','pesticide','herbicide','fungicide','seeds','other') NOT NULL DEFAULT 'fertilizer',
  `input_name` varchar(150) NOT NULL,
  `input_category` enum('organic','inorganic','bio_based') NOT NULL DEFAULT 'inorganic',
  `annual_quantity_used` decimal(10,2) DEFAULT NULL,
  `unit_of_measurement` varchar(50) DEFAULT NULL,
  `annual_cost` decimal(12,2) DEFAULT NULL,
  `supplier_name` varchar(150) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farm_inputs_farm_record_id_index` (`farm_record_id`),
  CONSTRAINT `farm_inputs_farm_record_id_foreign` FOREIGN KEY (`farm_record_id`) REFERENCES `farm_records` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_inputs`
--

LOCK TABLES `farm_inputs` WRITE;
/*!40000 ALTER TABLE `farm_inputs` DISABLE KEYS */;
/*!40000 ALTER TABLE `farm_inputs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farm_parcels`
--

DROP TABLE IF EXISTS `farm_parcels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farm_parcels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farm_record_id` bigint(20) unsigned NOT NULL,
  `parcel_name` varchar(100) DEFAULT NULL,
  `parcel_size_hectares` decimal(10,2) DEFAULT NULL,
  `soil_type` varchar(100) DEFAULT NULL,
  `terrain_type` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `status` enum('active','inactive','fallow') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farm_parcels_farm_record_id_index` (`farm_record_id`),
  CONSTRAINT `farm_parcels_farm_record_id_foreign` FOREIGN KEY (`farm_record_id`) REFERENCES `farm_records` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_parcels`
--

LOCK TABLES `farm_parcels` WRITE;
/*!40000 ALTER TABLE `farm_parcels` DISABLE KEYS */;
/*!40000 ALTER TABLE `farm_parcels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farm_records`
--

DROP TABLE IF EXISTS `farm_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farm_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `farm_name` varchar(150) DEFAULT NULL,
  `farm_size_hectares` decimal(10,2) DEFAULT NULL,
  `land_ownership_type` enum('owned','leased','shared','mortgaged') NOT NULL DEFAULT 'owned',
  `number_of_parcels` int(11) NOT NULL DEFAULT 1,
  `farm_description` text DEFAULT NULL,
  `ownership_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farm_records_farmer_profile_id_index` (`farmer_profile_id`),
  CONSTRAINT `farm_records_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_records`
--

LOCK TABLES `farm_records` WRITE;
/*!40000 ALTER TABLE `farm_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `farm_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farm_water_resources`
--

DROP TABLE IF EXISTS `farm_water_resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farm_water_resources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farm_record_id` bigint(20) unsigned NOT NULL,
  `irrigation_type` enum('rainfed','irrigated','mixed') NOT NULL DEFAULT 'rainfed',
  `water_source` enum('well','river','pump','canal','spring','municipal','rainwater_harvestinf') DEFAULT NULL,
  `water_quality_rating` varchar(50) DEFAULT NULL,
  `annual_water_cost` decimal(10,2) DEFAULT NULL,
  `water_availability` enum('adequate','moderate','scarce','seasonal') NOT NULL DEFAULT 'adequate',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farm_water_resources_farm_record_id_index` (`farm_record_id`),
  CONSTRAINT `farm_water_resources_farm_record_id_foreign` FOREIGN KEY (`farm_record_id`) REFERENCES `farm_records` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farm_water_resources`
--

LOCK TABLES `farm_water_resources` WRITE;
/*!40000 ALTER TABLE `farm_water_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `farm_water_resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer_addresses`
--

DROP TABLE IF EXISTS `farmer_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer_addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `address_type` enum('home','farm','other') NOT NULL DEFAULT 'home',
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `municipality_city` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `sitio_purok` varchar(100) DEFAULT NULL,
  `detailed_address` varchar(255) DEFAULT NULL,
  `gps_latitude` decimal(10,8) DEFAULT NULL,
  `gps_longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farmer_addresses_farmer_profile_id_index` (`farmer_profile_id`),
  CONSTRAINT `farmer_addresses_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer_addresses`
--

LOCK TABLES `farmer_addresses` WRITE;
/*!40000 ALTER TABLE `farmer_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `farmer_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer_audit_log`
--

DROP TABLE IF EXISTS `farmer_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer_audit_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `admin_user_id` bigint(20) unsigned DEFAULT NULL,
  `action` enum('created','updated','verified','deactivated','document_uploaded','program_enrolled') NOT NULL DEFAULT 'created',
  `entity_type` varchar(100) DEFAULT NULL,
  `changes_made` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farmer_audit_log_farmer_profile_id_index` (`farmer_profile_id`),
  KEY `farmer_audit_log_admin_user_id_index` (`admin_user_id`),
  KEY `farmer_audit_log_created_at_index` (`created_at`),
  CONSTRAINT `farmer_audit_log_admin_user_id_foreign` FOREIGN KEY (`admin_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `farmer_audit_log_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer_audit_log`
--

LOCK TABLES `farmer_audit_log` WRITE;
/*!40000 ALTER TABLE `farmer_audit_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `farmer_audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer_credit_records`
--

DROP TABLE IF EXISTS `farmer_credit_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer_credit_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `credit_access` enum('yes','no','limited') NOT NULL DEFAULT 'no',
  `credit_source` varchar(150) DEFAULT NULL,
  `total_loan_amount` decimal(12,2) DEFAULT NULL,
  `outstanding_loan_balance` decimal(12,2) DEFAULT NULL,
  `loan_interest_rate` decimal(5,2) DEFAULT NULL,
  `loan_start_date` date DEFAULT NULL,
  `loan_maturity_date` date DEFAULT NULL,
  `loan_repayment_status` enum('active','on_schedule','delayed','overdue','paid_off') NOT NULL DEFAULT 'active',
  `collateral_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farmer_credit_records_farmer_profile_id_index` (`farmer_profile_id`),
  CONSTRAINT `farmer_credit_records_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer_credit_records`
--

LOCK TABLES `farmer_credit_records` WRITE;
/*!40000 ALTER TABLE `farmer_credit_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `farmer_credit_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer_documents`
--

DROP TABLE IF EXISTS `farmer_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `document_type` enum('government_id','land_title','lease_agreement','certification','farm_photo','proof_of_income','bank_statement','other') NOT NULL DEFAULT 'other',
  `document_name` varchar(255) NOT NULL,
  `file_path` varchar(500) NOT NULL,
  `file_mime_type` varchar(50) DEFAULT NULL,
  `file_size` bigint(20) unsigned DEFAULT NULL,
  `document_issue_date` date DEFAULT NULL,
  `document_expiry_date` date DEFAULT NULL,
  `verification_status` enum('unverified','verified','rejected','pending_review') NOT NULL DEFAULT 'unverified',
  `verified_by` varchar(150) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farmer_documents_farmer_profile_id_index` (`farmer_profile_id`),
  KEY `farmer_documents_document_type_index` (`document_type`),
  CONSTRAINT `farmer_documents_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer_documents`
--

LOCK TABLES `farmer_documents` WRITE;
/*!40000 ALTER TABLE `farmer_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `farmer_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer_financial_records`
--

DROP TABLE IF EXISTS `farmer_financial_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer_financial_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `record_date` date NOT NULL,
  `farm_income_monthly` decimal(12,2) DEFAULT NULL,
  `farm_income_annual` decimal(12,2) DEFAULT NULL,
  `non_farm_income_monthly` decimal(12,2) DEFAULT NULL,
  `non_farm_income_annual` decimal(12,2) DEFAULT NULL,
  `total_expenses_annual` decimal(12,2) DEFAULT NULL,
  `net_income_annual` decimal(12,2) DEFAULT NULL,
  `income_stability` enum('stable','fluctuating','declining','growing') DEFAULT NULL,
  `income_sources` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farmer_financial_records_farmer_profile_id_index` (`farmer_profile_id`),
  CONSTRAINT `farmer_financial_records_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer_financial_records`
--

LOCK TABLES `farmer_financial_records` WRITE;
/*!40000 ALTER TABLE `farmer_financial_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `farmer_financial_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer_groups`
--

DROP TABLE IF EXISTS `farmer_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user_id` bigint(20) unsigned NOT NULL,
  `group_name` varchar(120) NOT NULL,
  `region` varchar(120) DEFAULT NULL,
  `province` varchar(120) DEFAULT NULL,
  `municipality` varchar(120) DEFAULT NULL,
  `barangay` varchar(120) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `farmer_groups_admin_user_id_group_name_unique` (`admin_user_id`,`group_name`),
  KEY `farmer_groups_municipality_index` (`municipality`),
  CONSTRAINT `farmer_groups_admin_user_id_foreign` FOREIGN KEY (`admin_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer_groups`
--

LOCK TABLES `farmer_groups` WRITE;
/*!40000 ALTER TABLE `farmer_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `farmer_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer_insurance_records`
--

DROP TABLE IF EXISTS `farmer_insurance_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer_insurance_records` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `insurance_type` enum('crop_insurance','livestock_insurance','health_insurance','accident_insurance') NOT NULL DEFAULT 'crop_insurance',
  `insurance_provider` varchar(150) DEFAULT NULL,
  `policy_number` varchar(100) DEFAULT NULL,
  `policy_start_date` date DEFAULT NULL,
  `policy_end_date` date DEFAULT NULL,
  `premium_amount` decimal(10,2) DEFAULT NULL,
  `coverage_amount` decimal(12,2) DEFAULT NULL,
  `status` enum('active','expired','suspended','claimed') NOT NULL DEFAULT 'active',
  `coverage_details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farmer_insurance_records_farmer_profile_id_index` (`farmer_profile_id`),
  CONSTRAINT `farmer_insurance_records_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer_insurance_records`
--

LOCK TABLES `farmer_insurance_records` WRITE;
/*!40000 ALTER TABLE `farmer_insurance_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `farmer_insurance_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer_profiles`
--

DROP TABLE IF EXISTS `farmer_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `farmer_group_id` bigint(20) unsigned NOT NULL,
  `legacy_farmer_id` bigint(20) unsigned DEFAULT NULL,
  `farmer_code` varchar(60) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `farm_name` varchar(150) DEFAULT NULL,
  `farm_location` varchar(255) DEFAULT NULL,
  `farm_size_hectares` decimal(10,2) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(150) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civil_status` enum('single','married','divorced','widowed') DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `government_id_type` varchar(50) DEFAULT NULL,
  `government_id_number` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `farmer_profiles_user_id_unique` (`user_id`),
  UNIQUE KEY `farmer_profiles_farmer_code_unique` (`farmer_code`),
  KEY `farmer_profiles_legacy_farmer_id_foreign` (`legacy_farmer_id`),
  KEY `farmer_profiles_farmer_group_id_index` (`farmer_group_id`),
  CONSTRAINT `farmer_profiles_farmer_group_id_foreign` FOREIGN KEY (`farmer_group_id`) REFERENCES `farmer_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `farmer_profiles_legacy_farmer_id_foreign` FOREIGN KEY (`legacy_farmer_id`) REFERENCES `farmers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `farmer_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer_profiles`
--

LOCK TABLES `farmer_profiles` WRITE;
/*!40000 ALTER TABLE `farmer_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `farmer_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmers`
--

DROP TABLE IF EXISTS `farmers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `civil_status` enum('single','married','divorced','widowed','separated') DEFAULT NULL,
  `farm_location` varchar(255) DEFAULT NULL,
  `farm_size_hectares` decimal(10,2) DEFAULT NULL,
  `land_ownership_type` enum('owned','leased','shared') DEFAULT NULL,
  `number_of_parcels` int(11) DEFAULT NULL,
  `crop_types` text DEFAULT NULL,
  `crop_area_per_type` text DEFAULT NULL,
  `cropping_season` enum('wet','dry','wet_dry') DEFAULT NULL,
  `yield_per_harvest` varchar(120) DEFAULT NULL,
  `livestock_types` text DEFAULT NULL,
  `livestock_count` int(11) DEFAULT NULL,
  `farm_equipment` text DEFAULT NULL,
  `irrigation_type` enum('rainfed','irrigated','mixed') DEFAULT NULL,
  `water_source` varchar(120) DEFAULT NULL,
  `fertilizer_usage` enum('organic','inorganic','mixed') DEFAULT NULL,
  `pesticide_usage` text DEFAULT NULL,
  `average_monthly_income` decimal(12,2) DEFAULT NULL,
  `average_annual_income` decimal(12,2) DEFAULT NULL,
  `income_source` enum('farm','non_farm','both') DEFAULT NULL,
  `has_credit_access` tinyint(1) NOT NULL DEFAULT 0,
  `insurance_coverage` varchar(150) DEFAULT NULL,
  `is_rsbsa_registered` tinyint(1) NOT NULL DEFAULT 0,
  `programs_availed` text DEFAULT NULL,
  `program_registration_date` date DEFAULT NULL,
  `valid_id_path` varchar(255) DEFAULT NULL,
  `land_document_path` varchar(255) DEFAULT NULL,
  `farm_photos_path` varchar(255) DEFAULT NULL,
  `barangay_certification_path` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `government_id_type` varchar(60) DEFAULT NULL,
  `government_id_number` varchar(120) DEFAULT NULL,
  `region` varchar(120) DEFAULT NULL,
  `province` varchar(120) DEFAULT NULL,
  `municipality_city` varchar(120) DEFAULT NULL,
  `barangay` varchar(120) DEFAULT NULL,
  `sitio_purok` varchar(120) DEFAULT NULL,
  `gps_latitude` decimal(10,8) DEFAULT NULL,
  `gps_longitude` decimal(11,8) DEFAULT NULL,
  `farmer_type` enum('owner','tenant','farm_worker') DEFAULT NULL,
  `years_in_farming` int(11) DEFAULT NULL,
  `primary_occupation` varchar(150) DEFAULT NULL,
  `secondary_occupation` varchar(150) DEFAULT NULL,
  `is_association_member` tinyint(1) NOT NULL DEFAULT 0,
  `association_name` varchar(180) DEFAULT NULL,
  `land_boundary_points` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `registered_by` bigint(20) unsigned DEFAULT NULL,
  `profile_status` enum('active','inactive','verified') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `farmers_user_id_foreign` (`user_id`),
  KEY `farmers_name_index` (`name`),
  KEY `farmers_farm_location_index` (`farm_location`),
  KEY `farmers_registered_by_foreign` (`registered_by`),
  KEY `farmers_first_name_index` (`first_name`),
  KEY `farmers_last_name_index` (`last_name`),
  KEY `farmers_profile_status_index` (`profile_status`),
  CONSTRAINT `farmers_registered_by_foreign` FOREIGN KEY (`registered_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `farmers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmers`
--

LOCK TABLES `farmers` WRITE;
/*!40000 ALTER TABLE `farmers` DISABLE KEYS */;
INSERT INTO `farmers` VALUES (1,2,'Test Farmer','Test',NULL,'Farmer',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ef','mixed','eveve',NULL,'efef',23.00,33.00,NULL,1,'vrv',1,'rfrgrvfb','2026-03-23',NULL,NULL,NULL,NULL,'09123456789','farmer@mannalon.test',NULL,NULL,'Region 2','Cagayan','Camal','Cat Sur',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2026-03-29 23:07:30','2026-03-29 23:07:30',1,'active');
/*!40000 ALTER TABLE `farmers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farming_guides`
--

DROP TABLE IF EXISTS `farming_guides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farming_guides` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `crop_type` varchar(100) DEFAULT NULL,
  `steps` longtext NOT NULL,
  `resource_url` varchar(500) DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `season` varchar(100) DEFAULT NULL,
  `posted_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `farming_guides_posted_by_foreign` (`posted_by`),
  KEY `farming_guides_crop_type_index` (`crop_type`),
  KEY `farming_guides_created_at_index` (`created_at`),
  CONSTRAINT `farming_guides_posted_by_foreign` FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farming_guides`
--

LOCK TABLES `farming_guides` WRITE;
/*!40000 ALTER TABLE `farming_guides` DISABLE KEYS */;
INSERT INTO `farming_guides` VALUES (1,'≡ƒî╛ How to Plant Palay (Rice) - Complete Guide','Palay (Rice)','Step 1: Prepare seedbed by flooding and puddling\r\nStep 2: Soak seeds for 24 hours\r\nStep 3: Transplant seedlings after 21-30 days\r\nStep 4: Maintain water level of 5cm\r\nStep 5: Apply fertilizer at tillering stage\r\nStep 6: Monitor for pests and diseases\r\nStep 7: Harvest when grain is mature','https://www.youtube.com/watch?v=8iYLj0yfpQo','farm_guides/test_guide.pdf','Wet Season',1,'2026-03-25 00:36:14','2026-03-25 01:05:44'),(2,'≡ƒî╜ How to Plant Corn - Beginner\'s Guide','Corn (Maize)','Step 1: Select quality corn seeds\r\nStep 2: Prepare field by plowing and harrowing\r\nStep 3: Plant seeds 5cm deep, 60cm row spacing\r\nStep 4: Water when soil is dry\r\nStep 5: Apply fertilizer at V4 stage\r\nStep 6: Remove weeds regularly\r\nStep 7: Monitor for armyworms\r\nStep 8: Harvest when corn cob turns brown','https://www.youtube.com/watch?v=3U13wBEp8vw',NULL,'Dry Season',1,'2026-03-25 00:36:28','2026-03-25 01:05:44'),(3,'≡ƒÑ¼ Organic Vegetable Growing Techniques','Vegetables','Step 1: Prepare compost-rich soil\r\nStep 2: Plant seeds in raised beds\r\nStep 3: Water consistently \r\nStep 4: Apply organic pest control\r\nStep 5: Mulch around plants\r\nStep 6: Harvest when ready\r\nStep 7: Rotate crops yearly',NULL,NULL,'Year-Round',1,'2026-03-25 00:36:28','2026-03-25 00:36:28'),(4,'≡ƒÉ¥ Integrated Pest Management for Farms','General','Step 1: Scout fields regularly for pests\r\nStep 2: Identify pest type and severity\r\nStep 3: Use cultural practices first\r\nStep 4: Apply biological controls\r\nStep 5: Use pesticides only when necessary\r\nStep 6: Keep records of treatments\r\nStep 7: Train farm workers on safety','https://www.youtube.com/watch?v=WzQ5T9p3R1I',NULL,'Year-Round',1,'2026-03-25 00:36:28','2026-03-25 01:05:44'),(5,'≡ƒî╜ How to Plant Corn - Beginner\'s Guide','Corn (Maize)','Step 1: Select quality corn seeds\r\nStep 2: Prepare field by plowing and harrowing\r\nStep 3: Plant seeds 5cm deep, 60cm row spacing\r\nStep 4: Water when soil is dry\r\nStep 5: Apply fertilizer at V4 stage\r\nStep 6: Remove weeds regularly\r\nStep 7: Monitor for armyworms\r\nStep 8: Harvest when corn cob turns brown','https://www.youtube.com/watch?v=maisplanting2024',NULL,'Dry Season',1,'2026-03-25 00:36:31','2026-03-25 00:36:31'),(6,'≡ƒÑ¼ Organic Vegetable Growing Techniques','Vegetables','Step 1: Prepare compost-rich soil\r\nStep 2: Plant seeds in raised beds\r\nStep 3: Water consistently \r\nStep 4: Apply organic pest control\r\nStep 5: Mulch around plants\r\nStep 6: Harvest when ready\r\nStep 7: Rotate crops yearly',NULL,NULL,'Year-Round',1,'2026-03-25 00:36:31','2026-03-25 00:36:31'),(7,'≡ƒÉ¥ Integrated Pest Management for Farms','General','Step 1: Scout fields regularly for pests\r\nStep 2: Identify pest type and severity\r\nStep 3: Use cultural practices first\r\nStep 4: Apply biological controls\r\nStep 5: Use pesticides only when necessary\r\nStep 6: Keep records of treatments\r\nStep 7: Train farm workers on safety','https://www.youtube.com/watch?v=pestmanagement2024',NULL,'Year-Round',1,'2026-03-25 00:36:31','2026-03-25 00:36:31');
/*!40000 ALTER TABLE `farming_guides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farming_profiles`
--

DROP TABLE IF EXISTS `farming_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farming_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `farmer_type` enum('owner','tenant','farm_worker','cooperative_member') NOT NULL DEFAULT 'owner',
  `years_in_farming` int(11) DEFAULT NULL,
  `primary_occupation` varchar(150) DEFAULT NULL,
  `secondary_occupation` varchar(150) DEFAULT NULL,
  `farmers_association` varchar(150) DEFAULT NULL,
  `association_membership_status` enum('member','non_member','pending') NOT NULL DEFAULT 'non_member',
  `association_joined_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `farming_profiles_farmer_profile_id_unique` (`farmer_profile_id`),
  KEY `farming_profiles_farmer_profile_id_index` (`farmer_profile_id`),
  CONSTRAINT `farming_profiles_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farming_profiles`
--

LOCK TABLES `farming_profiles` WRITE;
/*!40000 ALTER TABLE `farming_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `farming_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `government_program_participation`
--

DROP TABLE IF EXISTS `government_program_participation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `government_program_participation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_profile_id` bigint(20) unsigned NOT NULL,
  `rsbsa_number` varchar(100) DEFAULT NULL,
  `rsbsa_registration_date` date DEFAULT NULL,
  `rsbsa_status` enum('registered','unregistered','pending_verification') NOT NULL DEFAULT 'unregistered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `government_program_participation_farmer_profile_id_index` (`farmer_profile_id`),
  KEY `government_program_participation_rsbsa_number_index` (`rsbsa_number`),
  CONSTRAINT `government_program_participation_farmer_profile_id_foreign` FOREIGN KEY (`farmer_profile_id`) REFERENCES `farmer_profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `government_program_participation`
--

LOCK TABLES `government_program_participation` WRITE;
/*!40000 ALTER TABLE `government_program_participation` DISABLE KEYS */;
/*!40000 ALTER TABLE `government_program_participation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livestock`
--

DROP TABLE IF EXISTS `livestock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livestock` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `animal_type` varchar(255) NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT 1,
  `age_months` int(10) unsigned DEFAULT NULL,
  `health_status` enum('healthy','sick','recovering') NOT NULL DEFAULT 'healthy',
  `purchase_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `livestock_user_id_foreign` (`user_id`),
  CONSTRAINT `livestock_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livestock`
--

LOCK TABLES `livestock` WRITE;
/*!40000 ALTER TABLE `livestock` DISABLE KEYS */;
/*!40000 ALTER TABLE `livestock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_recipients`
--

DROP TABLE IF EXISTS `message_recipients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_recipients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` bigint(20) unsigned NOT NULL,
  `recipient_id` bigint(20) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `recipient_role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `message_recipients_message_id_recipient_id_unique` (`message_id`,`recipient_id`),
  KEY `message_recipients_recipient_id_foreign` (`recipient_id`),
  CONSTRAINT `message_recipients_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `message_recipients_recipient_id_foreign` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_recipients`
--

LOCK TABLES `message_recipients` WRITE;
/*!40000 ALTER TABLE `message_recipients` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_recipients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) unsigned NOT NULL,
  `recipient_id` bigint(20) unsigned DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `message_type` enum('direct','broadcast','announcement','alert') NOT NULL DEFAULT 'direct',
  `priority` enum('low','normal','high','urgent') NOT NULL DEFAULT 'normal',
  `recipient_type` varchar(255) DEFAULT NULL,
  `target_group_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `attachment_path` varchar(255) DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_id_foreign` (`sender_id`),
  KEY `messages_recipient_id_foreign` (`recipient_id`),
  KEY `messages_target_group_id_foreign` (`target_group_id`),
  CONSTRAINT `messages_recipient_id_foreign` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `messages_target_group_id_foreign` FOREIGN KEY (`target_group_id`) REFERENCES `farmer_groups` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2024_01_01_000001_create_users_table',1),(2,'2024_01_01_000002_create_crops_table',1),(3,'2024_01_01_000003_create_livestock_table',1),(4,'2026_01_27_000001_add_address_fields_to_users_table',1),(5,'2026_03_24_000001_create_farmers_table',1),(6,'2026_03_24_000002_create_farm_details_table',1),(7,'2026_03_24_000003_create_beneficiaries_table',1),(8,'2026_03_24_000004_create_service_access_logs_table',1),(9,'2026_03_24_000005_create_announcements_table',1),(10,'2026_03_24_000006_create_farming_guides_table',1),(11,'2026_03_24_000007_create_commodity_prices_table',1),(12,'2026_03_24_000008_add_coordinator_role_to_users_table',1),(13,'2026_03_25_000101_create_roles_table',1),(14,'2026_03_25_000102_update_users_for_role_hierarchy',1),(15,'2026_03_25_000103_create_admin_supervisor_assignments_table',1),(16,'2026_03_25_000104_create_farmer_groups_table',1),(17,'2026_03_25_000105_create_farmer_profiles_table',1),(18,'2026_03_25_000106_create_crop_reports_table',1),(19,'2026_03_25_000107_update_announcements_for_targeting',1),(20,'2026_03_25_140000_add_resource_url_to_farming_guides',2),(21,'2026_03_25_150000_add_pdf_file_to_farming_guides',3),(22,'2026_03_25_120000_add_comprehensive_fields_to_farmers_table',4),(23,'2026_03_30_000001_add_land_boundary_points_to_farmers_table',5),(24,'2026_03_25_000201_create_comprehensive_farmer_profile_tables',6),(25,'2026_03_25_130000_create_messages_system_tables',7),(26,'2026_03_25_130100_seed_communication_permissions',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `message_id` bigint(20) unsigned NOT NULL,
  `notification_channel` enum('in_app','email','sms') NOT NULL DEFAULT 'in_app',
  `notified_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_dismissed` tinyint(1) NOT NULL DEFAULT 0,
  `dismissed_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  KEY `notifications_message_id_foreign` (`message_id`),
  CONSTRAINT `notifications_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program_benefits_availed`
--

DROP TABLE IF EXISTS `program_benefits_availed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program_benefits_availed` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `government_program_id` bigint(20) unsigned NOT NULL,
  `benefit_type` enum('seeds_distribution','fertilizer_subsidy','training_seminar','equipment_support','loan_assistance','other') NOT NULL DEFAULT 'other',
  `program_name` varchar(150) NOT NULL,
  `program_description` text DEFAULT NULL,
  `benefit_date` date NOT NULL,
  `benefit_value` decimal(12,2) DEFAULT NULL,
  `benefit_unit` varchar(100) DEFAULT NULL,
  `status` enum('received','pending','approved','rejected','cancelled') NOT NULL DEFAULT 'pending',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `program_benefits_availed_government_program_id_index` (`government_program_id`),
  CONSTRAINT `program_benefits_availed_government_program_id_foreign` FOREIGN KEY (`government_program_id`) REFERENCES `government_program_participation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program_benefits_availed`
--

LOCK TABLES `program_benefits_availed` WRITE;
/*!40000 ALTER TABLE `program_benefits_availed` DISABLE KEYS */;
/*!40000 ALTER TABLE `program_benefits_availed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `name` varchar(60) NOT NULL,
  `hierarchy_level` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SUPER_ADMIN','Super Admin',100,'2026-03-25 00:22:00','2026-03-25 00:22:00'),(2,'ADMIN','Admin/LGU Staff',80,'2026-03-25 00:22:00','2026-03-25 00:22:00'),(3,'FARMER','Farmer',10,'2026-03-25 00:22:00','2026-03-25 00:22:00'),(4,'COORDINATOR','Coordinator',60,'2026-03-25 00:22:00','2026-03-25 00:22:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_access_logs`
--

DROP TABLE IF EXISTS `service_access_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_access_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `farmer_id` bigint(20) unsigned NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `access_count` int(10) unsigned NOT NULL DEFAULT 1,
  `last_accessed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_access_logs_farmer_id_foreign` (`farmer_id`),
  KEY `service_access_logs_service_name_index` (`service_name`),
  CONSTRAINT `service_access_logs_farmer_id_foreign` FOREIGN KEY (`farmer_id`) REFERENCES `farmers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_access_logs`
--

LOCK TABLES `service_access_logs` WRITE;
/*!40000 ALTER TABLE `service_access_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_access_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread_participants`
--

DROP TABLE IF EXISTS `thread_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thread_participants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `is_muted` tinyint(1) NOT NULL DEFAULT 0,
  `muted_until` timestamp NULL DEFAULT NULL,
  `participant_role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `thread_participants_thread_id_user_id_unique` (`thread_id`,`user_id`),
  KEY `thread_participants_user_id_foreign` (`user_id`),
  CONSTRAINT `thread_participants_thread_id_foreign` FOREIGN KEY (`thread_id`) REFERENCES `conversation_threads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `thread_participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread_participants`
--

LOCK TABLES `thread_participants` WRITE;
/*!40000 ALTER TABLE `thread_participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('farmer','admin','super_admin','coordinator') DEFAULT 'farmer',
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `house_number` varchar(255) DEFAULT NULL,
  `zone_purok` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin User','admin@mannalon.test','$2y$10$N57BB1QBUSEjDCoDUSHF1u/R4s9wH43N4u2UN2LN7Gaa3uQ73THcm','admin',2,NULL,'active',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-25 00:22:18','2026-03-25 00:22:18'),(2,'Test Farmer','farmer@mannalon.test','$2y$10$L625onEXfJ68H5LYNv/WROgsTYDrKWjEY8VDxVdQpN4/M8XkCfkNq','farmer',3,NULL,'active','09123456789','Test Farm, Laguna',NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-25 00:22:28','2026-03-25 00:22:28'),(3,'Super Administrator','superadmin@mannalon.test','$2y$10$i7PCI.ig4f8qFFXzSY1ghOd1mJuTqRnpibmUwqb1r9u./TUTc6/nu','super_admin',1,NULL,'active',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-25 00:23:58','2026-03-25 00:23:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'mannalon_app'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-13 12:00:23
