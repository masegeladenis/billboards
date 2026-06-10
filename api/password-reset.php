<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json');

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../config/Mailer.php';

set_exception_handler(function ($e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
});

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Only POST requests allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true) ?: [];
$action = $_GET['action'] ?? '';

$db = new Database();
$conn = $db->connect();
if (!$conn) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

$conn->query("CREATE TABLE IF NOT EXISTS password_resets (
    email      VARCHAR(255) PRIMARY KEY,
    token_hash VARCHAR(64)  NOT NULL,
    expires_at DATETIME     NOT NULL
)");

if ($action === 'forgot') {
    $email = trim($data['email'] ?? '');
    if (!$email) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Email is required']);
        exit;
    }

    // Identical response whether or not the account exists (prevents email probing)
    $generic = ['success' => true, 'message' => 'If an account exists for that email, a reset link has been sent. Check your inbox (and spam folder).'];

    $stmt = $conn->prepare("SELECT id, name FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) {
        echo json_encode($generic);
        exit;
    }
    $user = $res->fetch_assoc();

    $token = bin2hex(random_bytes(32));
    $token_hash = hash('sha256', $token);
    $stmt = $conn->prepare("REPLACE INTO password_resets (email, token_hash, expires_at)
                            VALUES (?, ?, NOW() + INTERVAL 1 HOUR)");
    $stmt->bind_param('ss', $email, $token_hash);
    $stmt->execute();

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $app_root = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
    $link = $scheme . '://' . $_SERVER['HTTP_HOST'] . $app_root
          . '/public/DASH/auth-resetpw.php?email=' . urlencode($email) . '&token=' . $token;

    $name = htmlspecialchars($user['name'] ?: 'there');
    $html = "
        <div style=\"font-family:Arial,Helvetica,sans-serif;max-width:520px;margin:0 auto;\">
            <h2 style=\"color:#7269ef;\">📢 Billboard Manager</h2>
            <p>Hi {$name},</p>
            <p>We received a request to reset your password. Click the button below to choose a new one.
               This link expires in <strong>1 hour</strong>.</p>
            <p style=\"text-align:center;margin:32px 0;\">
                <a href=\"{$link}\" style=\"background:#7269ef;color:#ffffff;text-decoration:none;
                   padding:12px 28px;border-radius:8px;display:inline-block;font-weight:bold;\">Reset Password</a>
            </p>
            <p style=\"color:#888;font-size:13px;\">If the button doesn't work, copy this link into your browser:<br>
               <a href=\"{$link}\">{$link}</a></p>
            <p style=\"color:#888;font-size:13px;\">If you didn't request this, you can safely ignore this email —
               your password will not change.</p>
        </div>";

    $mailer = new Mailer();
    if (!$mailer->send($email, 'Reset your Billboard Manager password', $html)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Could not send the email: ' . $mailer->error]);
        exit;
    }

    echo json_encode($generic);

} elseif ($action === 'reset') {
    $email    = trim($data['email'] ?? '');
    $token    = trim($data['token'] ?? '');
    $password = $data['password'] ?? '';

    if (!$email || !$token || !$password) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Email, token and new password are required']);
        exit;
    }
    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
        exit;
    }

    $stmt = $conn->prepare("SELECT token_hash, expires_at FROM password_resets WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->num_rows > 0 ? $res->fetch_assoc() : null;

    if (!$row || strtotime($row['expires_at']) < time() || !hash_equals($row['token_hash'], hash('sha256', $token))) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'This reset link is invalid or has expired. Please request a new one.']);
        exit;
    }

    $hashed = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param('ss', $hashed, $email);
    $stmt->execute();

    // Token is single-use
    $stmt = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Password updated successfully. You can now sign in.']);

} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}
?>
