<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Only POST requests allowed']);
    exit;
}

$upload_dir = __DIR__ . '/../uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

if (!isset($_FILES['file'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
    exit;
}

$file = $_FILES['file'];
$max_size = 100 * 1024 * 1024; // 100MB

$allowed_types = [
    // Images
    'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif',
    'image/webp', 'image/avif', 'image/bmp', 'image/tiff', 'image/svg+xml',
    // Videos
    'video/mp4', 'video/quicktime', 'video/avi', 'video/x-msvideo',
    'video/mpeg', 'video/x-mpeg', 'video/webm', 'video/ogg',
    'video/3gpp', 'video/x-ms-wmv', 'video/x-flv', 'video/x-matroska',
];

// Use finfo to read the actual MIME type from file content, not browser-reported type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$real_type = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($real_type, $allowed_types)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid file type: ' . $real_type . '. Only images and videos allowed.'
    ]);
    exit;
}

if ($file['size'] > $max_size) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'File too large. Maximum size is 100MB']);
    exit;
}

if ($file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Upload failed']);
    exit;
}

$filename = uniqid('ad_') . '_' . time() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
$filepath = $upload_dir . $filename;

if (move_uploaded_file($file['tmp_name'], $filepath)) {
    // Build URL path relative to the app root (works on any deployment path)
    $api_dir   = dirname($_SERVER['SCRIPT_NAME']);          // e.g. /announcement/api or /api
    $app_root  = rtrim(dirname($api_dir), '/');             // e.g. /announcement or ''
    $relative_path = $app_root . '/uploads/' . $filename;
    echo json_encode([
        'success' => true,
        'message' => 'File uploaded successfully',
        'file_path' => $relative_path
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to save file']);
}
?>
