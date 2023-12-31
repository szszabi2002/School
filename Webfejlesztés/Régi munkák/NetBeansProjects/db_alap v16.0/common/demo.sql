﻿--
-- Script was generated by Devart dbForge Studio 2020 for MySQL, Version 9.0.689.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 2021. 12. 09. 21:17:58
-- Server version: 10.4.20
-- Client version: 4.1
--

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set SQL mode
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

DROP DATABASE IF EXISTS demo;

CREATE DATABASE IF NOT EXISTS demo
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;

--
-- Set default database
--
USE demo;

--
-- Create table `firms`
--
CREATE TABLE IF NOT EXISTS firms (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  address VARCHAR(255) NOT NULL,
  postcode INT(11) NOT NULL,
  remark TEXT DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 14,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8,
COLLATE utf8_hungarian_ci;

--
-- Create table `employees`
--
CREATE TABLE IF NOT EXISTS employees (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  address VARCHAR(255) NOT NULL,
  salary INT(10) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 14,
AVG_ROW_LENGTH = 5461,
CHARACTER SET latin1,
COLLATE latin1_swedish_ci;

--
-- Create table `workers`
--
CREATE TABLE IF NOT EXISTS workers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  empID INT(11) DEFAULT NULL,
  firmID INT(11) DEFAULT NULL,
  begin DATE DEFAULT NULL,
  end DATE DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 12,
AVG_ROW_LENGTH = 5461,
CHARACTER SET utf8,
COLLATE utf8_hungarian_ci;

--
-- Create foreign key
--
ALTER TABLE workers 
  ADD CONSTRAINT FK_workers_employees_id FOREIGN KEY (empID)
    REFERENCES employees(id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Create foreign key
--
ALTER TABLE workers 
  ADD CONSTRAINT FK_workers_firms_id FOREIGN KEY (firmID)
    REFERENCES firms(id);

-- 
-- Dumping data for table firms
--
INSERT INTO firms VALUES
(1, 'Béla Beke', 'Szent István utca 37.', 4211, 'test'),
(2, 'Réparudi Bt.', 'Salátaföld2', 5005, 'Szántás alatt'),
(13, 'Béla', 'Hortobágy', 0, '');

-- 
-- Dumping data for table employees
--
INSERT INTO employees VALUES
(9, 'Tóth Miklós', 'Debrecen', 15000),
(10, 'Nagy Adelka', 'Szarvas', 35000000),
(13, 'Pató Pál', 'Hortobágy', 10000);

-- 
-- Dumping data for table workers
--
INSERT INTO workers VALUES
(2, 10, 1, '2019-04-17', NULL),
(3, 13, 2, '2019-04-01', '2019-05-02'),
(4, 9, 2, '2019-05-08', NULL),
(7, 9, 1, '2021-11-24', '2021-12-04');

-- 
-- Restore previous SQL mode
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;