<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

header('Content-Type: application/json');

require_once __DIR__ . '/../config/Database.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$db = new Database();
$conn = $db->connect();

if (!$conn) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $db->getError() ?: 'Database connection failed']);
    exit;
}

$out = ['success' => true];

// Total registered users
$r = $conn->query("SELECT COUNT(*) AS c FROM users");
$out['users'] = $r ? intval($r->fetch_assoc()['c']) : 0;

// Announcements: total + active
$r = $conn->query("SELECT COUNT(*) AS t, COALESCE(SUM(is_active = 1), 0) AS a FROM advertisements");
$row = $r ? $r->fetch_assoc() : ['t' => 0, 'a' => 0];
$out['ads_total']  = intval($row['t']);
$out['ads_active'] = intval($row['a']);

// Breakdown by type
$out['ads_by_type'] = ['text' => 0, 'image' => 0, 'video' => 0];
$r = $conn->query("SELECT ad_type, COUNT(*) AS c FROM advertisements GROUP BY ad_type");
if ($r) while ($x = $r->fetch_assoc()) $out['ads_by_type'][$x['ad_type']] = intval($x['c']);

// Total scheduled air time of active ads, in hours
$r = $conn->query("SELECT COALESCE(SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time))), 0) AS s
                   FROM advertisements WHERE is_active = 1");
$out['active_hours'] = $r ? round(intval($r->fetch_assoc()['s']) / 3600, 1) : 0;

// Connected billboards: display screens that pinged within the last 2 minutes
$out['displays'] = 0;
try {
    $r = $conn->query("SELECT COUNT(*) AS c FROM display_heartbeats
                       WHERE last_seen >= NOW() - INTERVAL 2 MINUTE");
    if ($r) $out['displays'] = intval($r->fetch_assoc()['c']);
} catch (Exception $e) {
    // table not created yet — first display page load will create it
}

// How many active ads are on air during each hour of the day (0–23)
$hours = array_fill(0, 24, 0);
$r = $conn->query("SELECT start_time, end_time FROM advertisements WHERE is_active = 1");
if ($r) {
    while ($x = $r->fetch_assoc()) {
        $sh = intval(substr($x['start_time'], 0, 2));
        $eh = intval(substr($x['end_time'], 0, 2));
        for ($h = $sh; $h <= $eh && $h < 24; $h++) $hours[$h]++;
    }
}
$out['ads_by_hour'] = $hours;

// Latest announcements (with owner info)
$out['recent_ads'] = [];
$r = $conn->query("SELECT a.id, a.title, a.ad_type, a.start_time, a.end_time, a.is_active, a.duration, a.created_at,
                          u.name AS user_name, u.email AS user_email
                   FROM advertisements a
                   JOIN users u ON u.id = a.user_id
                   ORDER BY a.id DESC LIMIT 8");
if ($r) while ($x = $r->fetch_assoc()) $out['recent_ads'][] = $x;

// Top users by number of announcements
$out['top_users'] = [];
$r = $conn->query("SELECT u.name, u.email, COUNT(a.id) AS ads_count
                   FROM users u
                   LEFT JOIN advertisements a ON a.user_id = u.id
                   GROUP BY u.id
                   ORDER BY ads_count DESC, u.id ASC
                   LIMIT 6");
if ($r) while ($x = $r->fetch_assoc()) $out['top_users'][] = $x;

echo json_encode($out);
?>
