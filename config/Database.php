<?php
class Database {
    private $host = '161.35.43.5';
    private $db_name = 'mqfkpcnfdx';
    private $user = 'mqfkpcnfdx';
    private $password = 'B58vp4Ha6y';
    private $conn;
    public $error = null;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            $this->error = 'Connection Error: ' . $this->conn->connect_error;
            return null;
        }

        return $this->conn;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getError() {
        return $this->error;
    }
}
?>
