<?php
require_once __DIR__ . '/../config/Database.php';

class Advertisement {
    private $conn;
    private $table = 'advertisements';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
        if (!$this->conn) $this->conn = null;
    }

    public function createAd($user_id, $title, $description, $ad_type, $content, $media_path, $start_time, $end_time, $rotation_order = 1, $duration = 10) {
        if (!$this->conn) return ['success' => false, 'message' => 'Database connection failed'];

        $query = "INSERT INTO {$this->table}
                  (user_id, title, ad_type, content, media_path, start_time, end_time, duration)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) return ['success' => false, 'message' => 'Query failed: ' . $this->conn->error];

        $stmt->bind_param('issssssi', $user_id, $title, $ad_type, $content, $media_path, $start_time, $end_time, $duration);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Advertisement created successfully', 'ad_id' => $this->conn->insert_id];
        }
        return ['success' => false, 'message' => $stmt->error];
    }

    public function getAdsByUser($user_id) {
        if (!$this->conn) return [];

        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY id ASC");
        if (!$stmt) return [];
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $ads = [];
        while ($row = $result->fetch_assoc()) $ads[] = $row;
        return $ads;
    }

    public function getActiveAds() {
        if (!$this->conn) return [];

        $current_time = date('H:i:s');

        $query = "SELECT * FROM {$this->table}
                  WHERE is_active = 1
                    AND start_time <= ?
                    AND end_time   >= ?
                  ORDER BY id ASC";

        try {
            $stmt = $this->conn->prepare($query);
            if (!$stmt) return [];
            $stmt->bind_param('ss', $current_time, $current_time);
            if (!$stmt->execute()) return [];
            $result = $stmt->get_result();

            $ads = [];
            while ($row = $result->fetch_assoc()) $ads[] = $row;
            return $ads;
        } catch (Exception $e) {
            return [];
        }
    }

    public function getAdById($id) {
        if (!$this->conn) return null;

        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        if (!$stmt) return null;
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    public function updateAd($id, $user_id, $title, $description, $ad_type, $content, $media_path, $start_time, $end_time, $rotation_order = 1) {
        if (!$this->conn) return ['success' => false, 'message' => 'Database connection failed'];

        $query = "UPDATE {$this->table}
                  SET title = ?, ad_type = ?, content = ?, media_path = ?, start_time = ?, end_time = ?
                  WHERE id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) return ['success' => false, 'message' => $this->conn->error];
        $stmt->bind_param('ssssssii', $title, $ad_type, $content, $media_path, $start_time, $end_time, $id, $user_id);

        if ($stmt->execute()) return ['success' => true, 'message' => 'Advertisement updated successfully'];
        return ['success' => false, 'message' => $stmt->error];
    }

    public function deleteAd($id, $user_id) {
        if (!$this->conn) return ['success' => false, 'message' => 'Database connection failed'];

        // Remove child rows first (foreign key may lack ON DELETE CASCADE on existing installs)
        $del = $this->conn->prepare("DELETE FROM schedule_details WHERE ad_id = ?");
        if ($del) { $del->bind_param('i', $id); $del->execute(); }

        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ? AND user_id = ?");
        if (!$stmt) return ['success' => false, 'message' => $this->conn->error];
        $stmt->bind_param('ii', $id, $user_id);

        if ($stmt->execute()) return ['success' => true, 'message' => 'Advertisement deleted successfully'];
        return ['success' => false, 'message' => $stmt->error];
    }

    public function toggleActive($id, $user_id) {
        if (!$this->conn) return ['success' => false, 'message' => 'Database connection failed'];

        $stmt = $this->conn->prepare("UPDATE {$this->table} SET is_active = NOT is_active WHERE id = ? AND user_id = ?");
        if (!$stmt) return ['success' => false, 'message' => $this->conn->error];
        $stmt->bind_param('ii', $id, $user_id);

        if ($stmt->execute()) return ['success' => true, 'message' => 'Advertisement status updated'];
        return ['success' => false, 'message' => $stmt->error];
    }

    public function getMediaStatus($id) {
        $ad = $this->getAdById($id);
        if (!$ad) return null;

        $hasMedia  = !empty($ad['media_path']);
        $mediaType = $ad['ad_type'];

        return [
            'ad_id'      => $ad['id'],
            'ad_type'    => $mediaType,
            'has_media'  => $hasMedia,
            'media_path' => $ad['media_path'],
            'status'     => $mediaType === 'text' ? 'text_only' : ($hasMedia ? 'media_attached' : 'no_media'),
        ];
    }
}
