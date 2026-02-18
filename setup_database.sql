-- Create database
CREATE DATABASE IF NOT EXISTS blood_information;
USE blood_information;

-- Donors table
CREATE TABLE IF NOT EXISTS donors_list (
  id INT AUTO_INCREMENT PRIMARY KEY,
  Name VARCHAR(100) NOT NULL,
  Gender VARCHAR(20) NOT NULL,
  Blood_Group VARCHAR(10) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Phone_no VARCHAR(30) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- User accounts (simple demo auth)
CREATE TABLE IF NOT EXISTS account (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin accounts (for admin login page)
CREATE TABLE IF NOT EXISTS admin_list (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional: create a default admin user (CHANGE THIS PASSWORD!)
-- INSERT IGNORE INTO admin_list (username, password) VALUES ('admin', 'admin123');
