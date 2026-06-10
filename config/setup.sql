-- ============================================================
--  Billboard Manager — Database Setup
--  Run this in phpMyAdmin or MySQL CLI to set up from scratch
-- ============================================================

CREATE DATABASE IF NOT EXISTS billboard_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE billboard_db;

-- ------------------------------------------------------------
--  Users
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id           INT          PRIMARY KEY AUTO_INCREMENT,
    email        VARCHAR(255) UNIQUE NOT NULL,
    password     VARCHAR(255) NOT NULL,
    name         VARCHAR(255) NOT NULL,
    company_name VARCHAR(255),
    created_at   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
--  Advertisements
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS advertisements (
    id         INT          PRIMARY KEY AUTO_INCREMENT,
    user_id    INT          NOT NULL,
    title      VARCHAR(255) NOT NULL,
    ad_type    ENUM('text','image','video') NOT NULL,
    content    LONGTEXT,
    media_path VARCHAR(500),
    start_time TIME         NOT NULL,
    end_time   TIME         NOT NULL,
    duration   INT          DEFAULT 10,   -- seconds to display per slide
    is_active  TINYINT(1)   DEFAULT 1,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ------------------------------------------------------------
--  Schedule Details  (optional day-of-week filtering)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS schedule_details (
    id          INT  PRIMARY KEY AUTO_INCREMENT,
    ad_id       INT  NOT NULL,
    day_of_week ENUM('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
    start_date  DATE,
    end_date    DATE,
    is_enabled  TINYINT(1) DEFAULT 1,
    FOREIGN KEY (ad_id) REFERENCES advertisements(id) ON DELETE CASCADE,
    UNIQUE KEY unique_ad_day (ad_id, day_of_week)
);

-- ------------------------------------------------------------
--  Migration — add duration to existing installations
-- ------------------------------------------------------------
ALTER TABLE advertisements ADD COLUMN IF NOT EXISTS duration INT DEFAULT 10;
