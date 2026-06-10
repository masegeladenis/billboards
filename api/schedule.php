<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../models/Schedule.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$request_method = $_SERVER['REQUEST_METHOD'];
$schedule_id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

if ($request_method === 'POST') {
    // Add schedule
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['ad_id']) || !isset($data['day_of_week'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    $schedule = new Schedule();
    $result = $schedule->addSchedule(
        $data['ad_id'],
        $data['day_of_week'],
        $data['start_date'] ?? null,
        $data['end_date'] ?? null
    );

    http_response_code($result['success'] ? 201 : 400);
    echo json_encode($result);

} elseif ($request_method === 'DELETE' && $schedule_id) {
    // Delete schedule
    $schedule = new Schedule();
    $result = $schedule->deleteSchedule($schedule_id);

    http_response_code($result['success'] ? 200 : 400);
    echo json_encode($result);

} elseif ($request_method === 'PUT' && $schedule_id && $action === 'toggle') {
    // Toggle schedule
    $schedule = new Schedule();
    $result = $schedule->toggleSchedule($schedule_id);

    http_response_code($result['success'] ? 200 : 400);
    echo json_encode($result);

} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
