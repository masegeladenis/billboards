<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

try {
    require_once __DIR__ . '/../config/Database.php';
    require_once __DIR__ . '/../models/Advertisement.php';
    $ad = new Advertisement();

    // ?preview=1 shows ALL active ads regardless of time/day — useful for testing
    if (isset($_GET['preview'])) {
        $active_ads = $ad->getAdsByUser(null) ?: [];
        // fall back: get all ads that are active
        $db = new Database();
        $conn = $db->connect();
        $active_ads = [];
        if ($conn) {
            $res = $conn->query("SELECT * FROM advertisements WHERE is_active = 1 ORDER BY id ASC");
            if ($res) while ($row = $res->fetch_assoc()) $active_ads[] = $row;
        }
    } else {
        $active_ads = $ad->getActiveAds();
    }

    if (!is_array($active_ads)) $active_ads = [];
} catch (Exception $e) {
    $active_ads = [];
}

$display_id = isset($_GET['id']) ? intval($_GET['id']) : (count($active_ads) > 0 ? $active_ads[0]['id'] : null);
$current_ad = null;

foreach ($active_ads as $a) {
    if ($a['id'] == $display_id) { $current_ad = $a; break; }
}
if (!$current_ad && count($active_ads) > 0) $current_ad = $active_ads[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billboard Display</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #050a14;
            color: #fff;
            overflow: hidden;
            height: 100vh;
            width: 100vw;
        }

        .stage {
            position: relative;
            width: 100vw;
            height: 100vh;
        }

        /* Billboard frame */
        .billboard {
            position: relative;
            width: 100vw;
            height: 100vh;
            background: #0d0d1a;
            overflow: hidden;
        }

        /* Slide area */
        .slide-wrap {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .slide {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            opacity: 0;
            transition: opacity 0.6s ease;
            pointer-events: none;
        }

        .slide.text-slide {
            padding: 40px;
        }

        .slide.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Text ad */
        .text-ad {
            max-width: 82%;
            text-align: center;
        }

        .text-ad-inner {
            background: linear-gradient(135deg, rgba(99,102,241,0.18) 0%, rgba(139,92,246,0.12) 100%);
            border: 1px solid rgba(99,102,241,0.3);
            border-radius: 24px;
            padding: 64px 56px;
            backdrop-filter: blur(10px);
        }

        .text-ad h2 {
            font-size: clamp(2rem, 5vw, 4.5rem);
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.1;
            margin-bottom: 24px;
            background: linear-gradient(135deg, #fff 0%, #c7d2fe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-ad p {
            font-size: clamp(1.1rem, 2.5vw, 2rem);
            font-weight: 400;
            color: rgba(255,255,255,0.8);
            line-height: 1.5;
        }

        /* Image ad */
        .image-ad {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Video ad */
        .video-ad {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* No ads */
        .no-ads {
            text-align: center;
        }

        .no-ads-icon {
            font-size: 72px;
            margin-bottom: 24px;
            opacity: 0.4;
        }

        .no-ads-title {
            font-size: 28px;
            font-weight: 700;
            color: rgba(255,255,255,0.4);
            margin-bottom: 8px;
        }

        .no-ads-sub {
            font-size: 16px;
            color: rgba(255,255,255,0.2);
        }

        /* Top-left info */
        .info-badge {
            position: absolute;
            top: 20px;
            left: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            padding: 10px 16px;
            z-index: 10;
        }

        .info-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 8px #10b981;
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.4; }
        }

        .info-label {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,0.7);
            letter-spacing: 0.3px;
        }

        .info-time {
            font-size: 13px;
            font-weight: 600;
            color: #fbbf24;
        }

    </style>
</head>
<body>
<div class="stage">
    <div class="billboard">

        <!-- Info badge (top-left) -->
        <div class="info-badge">
            <div class="info-dot"></div>
            <span class="info-label">LIVE</span>
            <span class="info-time" id="clockDisplay"></span>
        </div>

        <!-- Slide area -->
        <div class="slide-wrap" id="slideWrap"></div>


    </div>
</div>

<script>
    const ads = <?php echo json_encode(array_values($active_ads)); ?>;
    let current = 0;
    let rotateTimer = null;

    function escHtml(s) {
        return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    function buildSlide(ad) {
        const div = document.createElement('div');
        div.id = 'slide-' + ad.id;

        if (ad.ad_type === 'text') {
            div.className = 'slide text-slide';
            div.innerHTML = `
                <div class="text-ad">
                    <div class="text-ad-inner">
                        <h2>${escHtml(ad.title)}</h2>
                        <p>${escHtml(ad.content || '')}</p>
                    </div>
                </div>`;
        } else if (ad.ad_type === 'image') {
            div.className = 'slide';
            div.innerHTML = `<img class="image-ad" src="${escHtml(ad.media_path)}" alt="">`;
        } else if (ad.ad_type === 'video') {
            div.className = 'slide';
            div.innerHTML = `
                <video class="video-ad" autoplay muted loop playsinline>
                    <source src="${escHtml(ad.media_path)}" type="video/mp4">
                </video>`;
        }
        return div;
    }

    function init() {
        const wrap = document.getElementById('slideWrap');
        wrap.innerHTML = '';

        if (ads.length === 0) {
            wrap.innerHTML = `
                <div class="slide active">
                    <div class="no-ads">
                        <div class="no-ads-icon">📢</div>
                        <div class="no-ads-title">No Active Advertisements</div>
                        <div class="no-ads-sub">Ads scheduled for the current time will appear here</div>
                    </div>
                </div>`;
            return;
        }

        ads.forEach(ad => wrap.appendChild(buildSlide(ad)));
        showAd(0);
    }

    function showAd(index) {
        clearTimeout(rotateTimer);

        document.querySelectorAll('.slide').forEach(s => s.classList.remove('active'));

        const ad = ads[index];
        const slide = document.getElementById('slide-' + ad.id);
        if (slide) slide.classList.add('active');


        if (ads.length > 1) {
            const ms = ((parseInt(ad.duration) || 10) * 1000);
            rotateTimer = setTimeout(() => {
                current = (current + 1) % ads.length;
                showAd(current);
            }, ms);
        }
    }

// Clock
    function updateClock() {
        const now = new Date();
        const h = now.getHours(), m = now.getMinutes();
        const hh = h % 12 || 12;
        const mm = String(m).padStart(2, '0');
        const ampm = h >= 12 ? 'PM' : 'AM';
        document.getElementById('clockDisplay').textContent = `${hh}:${mm} ${ampm}`;
    }

    updateClock();
    setInterval(updateClock, 10000);

    // Refresh data every 60 seconds to pick up new ads
    setInterval(() => location.reload(), 60000);

    init();
</script>
</body>
</html>
