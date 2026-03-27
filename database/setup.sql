-- Create Mannalon App Database and Tables
-- Run this in phpMyAdmin or MySQL directly

-- Create Database
CREATE DATABASE IF NOT EXISTS mannalon_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mannalon_app;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
  id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL UNIQUE,
  password varchar(255) NOT NULL,
  role enum('farmer', 'admin') NOT NULL DEFAULT 'farmer',
  status enum('active', 'inactive') NOT NULL DEFAULT 'active',
  phone varchar(20),
  address text,
  city varchar(100),
  state varchar(100),
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crops Table
CREATE TABLE IF NOT EXISTS crops (
  id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id bigint unsigned NOT NULL,
  crop_name varchar(255) NOT NULL,
  crop_type varchar(100),
  area_planted decimal(10, 2),
  planting_date date,
  expected_harvest_date date,
  status enum('planning', 'growing', 'ready', 'harvested') NOT NULL DEFAULT 'planning',
  notes text,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Livestock Table
CREATE TABLE IF NOT EXISTS livestock (
  id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id bigint unsigned NOT NULL,
  animal_type varchar(100) NOT NULL,
  breed varchar(100),
  quantity int unsigned DEFAULT 1,
  age_months int,
  health_status enum('healthy', 'sick', 'recovering') NOT NULL DEFAULT 'healthy',
  purchase_date date,
  notes text,
  created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Test Users
INSERT INTO users (name, email, password, role, status) VALUES
('Admin User', 'admin@mannalon.com', '$2y$10$E8BfPQV4FxLzUIHQZBRHe.xT.w8bqLKPjNcLGvr4VNR5W7O4x1Rou', 'admin', 'active'),
('John Farmer', 'farmer@mannalon.com', '$2y$10$E8BfPQV4FxLzUIHQZBRHe.xT.w8bqLKPjNcLGvr4VNR5W7O4x1Rou', 'farmer', 'active');

-- Insert Sample Crops
INSERT INTO crops (user_id, crop_name, crop_type, area_planted, planting_date, expected_harvest_date, status) VALUES
(2, 'Maize', 'Cereal', 5.5, '2026-01-15', '2026-06-15', 'growing'),
(2, 'Beans', 'Legume', 2.3, '2026-01-20', '2026-04-20', 'growing');

-- Insert Sample Livestock
INSERT INTO livestock (user_id, animal_type, breed, quantity, age_months, health_status, purchase_date) VALUES
(2, 'Cattle', 'Brahman', 3, 24, 'healthy', '2025-06-01'),
(2, 'Chicken', 'Leghorn', 15, 6, 'healthy', '2025-09-15');

-- Create Indices for Better Performance
CREATE INDEX idx_crops_user_id ON crops(user_id);
CREATE INDEX idx_livestock_user_id ON livestock(user_id);
CREATE INDEX idx_users_email ON users(email);
