<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

set_exception_handler(function($e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage(), 'file' => basename($e->getFile()), 'line' => $e->getLine()]);
    exit;
});

set_error_handler(function($_errno, $errstr, $errfile, $errline) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $errstr, 'file' => basename($errfile), 'line' => $errline]);
    exit;
});

require_once __DIR__ . '/../models/Advertisement.php';
require_once __DIR__ . '/../models/Schedule.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$user_id = $_SESSION['user_id'];
$request_method = $_SERVER['REQUEST_METHOD'];
$ad_id = $_GET['id'] ?? null;
$action = $_GET['action'] ?? null;

if ($request_method === 'POST' && $action === 'delete' && $ad_id) {
    $ad = new Advertisement();
    $existing = $ad->getAdById($ad_id);

    if (!$existing) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Advertisement not found']);
        exit;
    }

    $result = $ad->deleteAd($ad_id, $existing['user_id']);
    http_response_code($result['success'] ? 200 : 400);
    echo json_encode($result);

} elseif ($request_method === 'POST') {
    // Create new advertisement
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['title']) || !isset($data['ad_type']) || !isset($data['start_time']) || !isset($data['end_time'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required fields: title, ad_type, start_time, end_time']);
        exit;
    }

    // Validate media attachment based on ad_type
    if ($data['ad_type'] === 'image' || $data['ad_type'] === 'video') {
        if (!isset($data['media_path']) || empty($data['media_path'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Media file is required for ' . $data['ad_type'] . ' advertisements']);
            exit;
        }
    } elseif ($data['ad_type'] === 'text') {
        if (!isset($data['content']) || empty($data['content'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Content is required for text advertisements']);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid ad_type. Must be: text, image, or video']);
        exit;
    }

    $ad = new Advertisement();
    $result = $ad->createAd(
        $user_id,
        $data['title'],
        '',
        $data['ad_type'],
        $data['content'] ?? '',
        $data['media_path'] ?? null,
        $data['start_time'],
        $data['end_time'],
        1,
        intval($data['duration'] ?? 10)
    );

    // Add schedule
    if ($result['success'] && isset($data['days'])) {
        $schedule = new Schedule();
        foreach ($data['days'] as $day) {
            $schedule->addSchedule(
                $result['ad_id'],
                $day,
                $data['start_date'] ?? null,
                $data['end_date'] ?? null
            );
        }
    }

    http_response_code($result['success'] ? 201 : 400);
    echo json_encode($result);

} elseif ($request_method === 'GET' && isset($_GET['all'])) {
    // List ads of ALL users with owner info (admin view)
    $ad = new Advertisement();
    echo json_encode(['success' => true, 'ads' => $ad->getAllAdsWithUsers()]);

} elseif ($request_method === 'GET' && !$ad_id) {
    // List all ads for user
    $ad = new Advertisement();
    $ads = $ad->getAdsByUser($user_id);
    echo json_encode(['success' => true, 'ads' => $ads]);

} elseif ($request_method === 'GET' && $ad_id) {
    // Get single ad with schedules
    $ad = new Advertisement();
    $ad_data = $ad->getAdById($ad_id);

    if ($ad_data && $ad_data['user_id'] == $user_id) {
        $schedule = new Schedule();
        $schedules = $schedule->getScheduleByAd($ad_id);
        $media_status = $ad->getMediaStatus($ad_id);
        echo json_encode(['success' => true, 'ad' => $ad_data, 'schedules' => $schedules, 'media_status' => $media_status]);
    } else {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    }

} elseif ($request_method === 'GET' && isset($_GET['check_media']) && $ad_id) {
    // Check if media is attached to an ad
    $ad = new Advertisement();
    $ad_data = $ad->getAdById($ad_id);

    if ($ad_data && $ad_data['user_id'] == $user_id) {
        $media_status = $ad->getMediaStatus($ad_id);
        echo json_encode(['success' => true, 'media_status' => $media_status]);
    } else {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    }

} elseif ($request_method === 'PUT' && $ad_id && $action === 'toggle') {
    // Toggle advertisement active status
    $ad = new Advertisement();
    $existing = $ad->getAdById($ad_id);

    if (!$existing) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Advertisement not found']);
        exit;
    }

    $result = $ad->toggleActive($ad_id, $existing['user_id']);
    http_response_code($result['success'] ? 200 : 400);
    echo json_encode($result);

} elseif ($request_method === 'PUT' && $ad_id) {
    // Update advertisement
    $data = json_decode(file_get_contents("php://input"), true);

    $ad = new Advertisement();
    $existing = $ad->getAdById($ad_id);

    if (!$existing) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Advertisement not found']);
        exit;
    }

    $result = $ad->updateAd(
        $ad_id,
        $existing['user_id'],
        $data['title'] ?? $existing['title'],
        $data['ad_type'] ?? $existing['ad_type'],
        $data['content'] ?? $existing['content'],
        $data['media_path'] ?? $existing['media_path'],
        $data['start_time'] ?? $existing['start_time'],
        $data['end_time'] ?? $existing['end_time'],
        intval($data['duration'] ?? $existing['duration'] ?? 10)
    );

    http_response_code($result['success'] ? 200 : 400);
    echo json_encode($result);

} elseif ($request_method === 'DELETE' && $ad_id) {
    // Delete advertisement
    $ad = new Advertisement();
    $existing = $ad->getAdById($ad_id);

    if (!$existing || $existing['user_id'] != $user_id) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit;
    }

    $result = $ad->deleteAd($ad_id, $user_id);
    http_response_code($result['success'] ? 200 : 400);
    echo json_encode($result);

} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>