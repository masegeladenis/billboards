<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../models/User.php';

session_start();

$request_method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

if (!$request_method) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if ($request_method === 'POST' && $action === 'logout') {
    session_destroy();
    echo json_encode(['success' => true, 'message' => 'Logged out successfully']);

} elseif ($request_method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Determine if it's register or login based on presence of 'name' field
    if (isset($data['name'])) {
        // This is a registration request
        if (!isset($data['email']) || !isset($data['password']) || !isset($data['name'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields: email, password, name']);
            exit;
        }

        $user = new User();
        $result = $user->register($data['email'], $data['password'], $data['name'], $data['company_name'] ?? '');
        
        http_response_code($result['success'] ? 201 : 400);
        echo json_encode($result);
    } else {
        // This is a login request
        if (!isset($data['email']) || !isset($data['password'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Email and password required']);
            exit;
        }

        $user = new User();
        $result = $user->login($data['email'], $data['password']);
        
        if ($result['success']) {
            $_SESSION['user_id'] = $result['user']['id'];
            $_SESSION['user_email'] = $result['user']['email'];
        }

        http_response_code($result['success'] ? 200 : 401);
        echo json_encode($result);
    }

} elseif ($request_method === 'GET' && $action === 'check') {
    if (isset($_SESSION['user_id'])) {
        $user = new User();
        $user_data = $user->getUserById($_SESSION['user_id']);
        echo json_encode(['success' => true, 'user' => $user_data]);
    } else {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    }

} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
