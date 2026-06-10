<?php
class Database {
    private $host = '161.35.43.5';
    private $db_name = 'mqfkpcnfdx';
    private $user = 'mqfkpcnfdx';
    private $password = 'B58vp4Ha6y';
    private $conn;
    public $error = null;

    public function connect() {
        // Connect without selecting DB so we can create it if missing
        $this->conn = new mysqli($this->host, $this->user, $this->password);

        if ($this->conn->connect_error) {
            $this->error = 'Connection Error: ' . $this->conn->connect_error;
            return null;
        }

        if (!$this->conn->query("CREATE DATABASE IF NOT EXISTS `{$this->db_name}`")) {
            $this->error = 'Database creation failed: ' . $this->conn->error;
            return null;
        }

        $this->conn->select_db($this->db_name);
        $this->setupTables();

        return $this->conn;
    }

    private function setupTables() {
        $this->conn->query("
            CREATE TABLE IF NOT EXISTS users (
                id INT PRIMARY KEY AUTO_INCREMENT,
                email VARCHAR(255) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                company_name VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");

        $this->conn->query("
            CREATE TABLE IF NOT EXISTS advertisements (
                id INT PRIMARY KEY AUTO_INCREMENT,
                user_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                ad_type ENUM('text','image','video') NOT NULL,
                content LONGTEXT,
                media_path VARCHAR(500),
                start_time TIME NOT NULL,
                end_time TIME NOT NULL,
                duration INT DEFAULT 10,
                is_active TINYINT(1) DEFAULT 1,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            )
        ");

        // Migrate existing tables — add duration if missing
        $this->conn->query("ALTER TABLE advertisements ADD COLUMN IF NOT EXISTS duration INT DEFAULT 10");

        $this->conn->query("
            CREATE TABLE IF NOT EXISTS schedule_details (
                id INT PRIMARY KEY AUTO_INCREMENT,
                ad_id INT NOT NULL,
                day_of_week ENUM('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
                start_date DATE,
                end_date DATE,
                is_enabled TINYINT(1) DEFAULT 1,
                FOREIGN KEY (ad_id) REFERENCES advertisements(id) ON DELETE CASCADE,
                UNIQUE KEY unique_ad_day (ad_id, day_of_week)
            )
        ");
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getError() {
        return $this->error;
    }
}
?>
