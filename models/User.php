<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $email;
    public $password;
    public $name;
    public $company_name;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        if (!$this->conn) {
            $this->conn = null;
        }
    }

    public function register($email, $password, $name, $company_name) {
        if (!$this->conn) {
            return ['success' => false, 'message' => 'Database connection failed'];
        }

        $query = "INSERT INTO " . $this->table . " (email, password, name, company_name) 
                  VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            return ['success' => false, 'message' => 'Query preparation failed: ' . $this->conn->error];
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param('ssss', $email, $hashed_password, $name, $company_name);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'User registered successfully', 'user_id' => $this->conn->insert_id];
        } else {
            return ['success' => false, 'message' => $stmt->error];
        }
    }

    public function login($email, $password) {
        $query = "SELECT id, email, password, name, company_name FROM " . $this->table . " WHERE email = ?";
        
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            return ['success' => false, 'message' => 'Query preparation failed'];
        }

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                return [
                    'success' => true, 
                    'message' => 'Login successful',
                    'user' => [
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'name' => $user['name'],
                        'company_name' => $user['company_name']
                    ]
                ];
            } else {
                return ['success' => false, 'message' => 'Invalid password'];
            }
        } else {
            return ['success' => false, 'message' => 'User not found'];
        }
    }

    public function getUserById($id) {
        $query = "SELECT id, email, name, company_name FROM " . $this->table . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
}
?>
