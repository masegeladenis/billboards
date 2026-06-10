<?php
require_once __DIR__ . '/../config/Database.php';

class Schedule {
    private $conn;
    private $table = 'schedule_details';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        if (!$this->conn) {
            $this->conn = null;
        }
    }

    public function addSchedule($ad_id, $day_of_week, $start_date = null, $end_date = null) {
        if (!$this->conn) {
            return ['success' => false, 'message' => 'Database connection failed'];
        }

        $query = "INSERT INTO " . $this->table . " (ad_id, day_of_week, start_date, end_date, is_enabled) 
                  VALUES (?, ?, ?, ?, 1)
                  ON DUPLICATE KEY UPDATE start_date = VALUES(start_date), end_date = VALUES(end_date), is_enabled = 1";
        
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            return ['success' => false, 'message' => 'Query preparation failed'];
        }

        $stmt->bind_param('isss', $ad_id, $day_of_week, $start_date, $end_date);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Schedule added successfully'];
        } else {
            return ['success' => false, 'message' => $stmt->error];
        }
    }

    public function getScheduleByAd($ad_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE ad_id = ? ORDER BY day_of_week";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $ad_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $schedules = [];
        while ($row = $result->fetch_assoc()) {
            $schedules[] = $row;
        }
        return $schedules;
    }

    public function deleteSchedule($schedule_id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $schedule_id);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Schedule deleted successfully'];
        } else {
            return ['success' => false, 'message' => $stmt->error];
        }
    }

    public function toggleSchedule($schedule_id) {
        $query = "UPDATE " . $this->table . " SET is_enabled = NOT is_enabled WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $schedule_id);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Schedule toggled successfully'];
        } else {
            return ['success' => false, 'message' => $stmt->error];
        }
    }
}
?>
