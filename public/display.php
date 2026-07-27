<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

try {
    require_once __DIR__ . '/../config/Database.php';
    require_once __DIR__ . '/../models/Advertisement.php';

    // Heartbeat: register this screen so the dashboard can count connected billboards.
    // The page reloads every 60s, so a fresh heartbeat means the screen is live.
    try {
        $hb_db = new Database();
        $hb = $hb_db->connect();
        if ($hb) {
            $hb->query("CREATE TABLE IF NOT EXISTS display_heartbeats (
                id VARCHAR(64) PRIMARY KEY,
                last_seen DATETIME NOT NULL
            )");
            $screen_id = md5(($_SERVER['REMOTE_ADDR'] ?? '') . '|' . ($_SERVER['HTTP_USER_AGENT'] ?? ''));
            $stmt = $hb->prepare("REPLACE INTO display_heartbeats (id, last_seen) VALUES (?, NOW())");
            if ($stmt) { $stmt->bind_param('s', $screen_id); $stmt->execute(); }
        }
    } catch (Exception $e) { /* heartbeat is best-effort */ }

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

// ?test=1 renders sample text announcements (one word, headline, long paragraph)
// so the auto-fit sizing can be checked without touching the database.
if (isset($_GET['test'])) {
    $active_ads = [
        ['id' => 9001, 'ad_type' => 'text', 'duration' => 6,
         'title' => 'SALE', 'content' => ''],
        ['id' => 9002, 'ad_type' => 'text', 'duration' => 6,
         'title' => 'Grand Opening Tomorrow',
         'content' => 'Doors open at 9:00 AM — free entry all day.'],
        ['id' => 9003, 'ad_type' => 'text', 'duration' => 6,
         'title' => 'Scheduled Maintenance Notice',
         'content' => 'The water supply along Mikocheni B and the surrounding streets will be interrupted on Saturday from 8:00 AM until 4:00 PM while the main pipeline is replaced. Residents are advised to store enough water in advance. We apologise for the inconvenience and thank you for your patience.'],
        ['id' => 9004, 'ad_type' => 'text', 'duration' => 6,
         'title' => 'Antidisestablishmentarianism',
         'content' => 'Tests wrapping of an unbreakably long single word.'],
    ];
}

$display_id = isset($_GET['id']) ? intval($_GET['id']) : (count($active_ads) > 0 ? $active_ads[0]['id'] : null);
$current_ad = null;
$start_index = 0;

foreach (array_values($active_ads) as $i => $a) {
    if ($a['id'] == $display_id) { $current_ad = $a; $start_index = $i; break; }
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
            padding: 0;
        }

        .slide.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Text ad — fills the entire billboard, no floating card */
        .text-ad {
            width: 100%;
            height: 100%;
            text-align: center;
        }

        .text-ad-inner {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* generous but proportional safe area so nothing touches the edge */
            padding: 4vmin 5vmin;
            background: linear-gradient(135deg, rgba(99,102,241,0.18) 0%, rgba(139,92,246,0.12) 100%);
        }

        /* JS sets font-size on .text-fit; children scale from it in em */
        .text-fit {
            width: 100%;
            font-size: 100px;
            line-height: 1;
        }

        .text-ad h2 {
            font-size: 1em;
            font-weight: 800;
            letter-spacing: -0.02em;
            line-height: 1.05;
            /* break-word only splits words that can't fit a line on their own,
               so normal words still wrap whole */
            overflow-wrap: break-word;
            text-wrap: balance;
            background: linear-gradient(135deg, #fff 0%, #c7d2fe 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-ad p {
            font-size: 0.42em;
            font-weight: 400;
            color: rgba(255,255,255,0.85);
            line-height: 1.35;
            margin-top: 0.6em;
            overflow-wrap: break-word;
            text-wrap: pretty;
        }

        /* Title-only announcements get the whole canvas */
        .text-ad p:empty { display: none; }

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
    // ?id=N starts the rotation on that ad instead of the first one
    let current = <?php echo (int)$start_index; ?>;
    let rotateTimer = null;

    function escHtml(s) {
        return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    function buildSlide(ad) {
        const div = document.createElement('div');
        div.id = 'slide-' + ad.id;

        if (ad.ad_type === 'text') {
            div.className = 'slide text-slide';
            const content = (ad.content || '').trim();
            div.innerHTML = `
                <div class="text-ad">
                    <div class="text-ad-inner">
                        <div class="text-fit">
                            <h2>${escHtml(ad.title)}</h2>
                            ${content ? `<p>${escHtml(content)}</p>` : ''}
                        </div>
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

    // Largest base font-size at which every word still fits on one line, so the
    // text never gets chopped mid-word. Text width scales linearly with
    // font-size, so one measurement at a 100px base gives the ratio.
    function maxSizeWithWholeWords(fit, availW) {
        const prev = fit.style.fontSize;
        fit.style.fontSize = '100px';

        let cap = Infinity;
        for (const el of fit.children) {
            const prevW = el.style.width;
            // min-content = width of the longest word at this size
            el.style.width = 'min-content';
            const w = el.getBoundingClientRect().width;
            el.style.width = prevW;
            if (w > 0) cap = Math.min(cap, availW * 100 / w);
        }

        fit.style.fontSize = prev;
        return cap;
    }

    // Grow the text until it fills the billboard, then stop just before it
    // overflows. Binary search keeps this to ~18 reflows per pass.
    function fitText(slide) {
        const box = slide.querySelector('.text-ad-inner');
        const fit = slide.querySelector('.text-fit');
        if (!box || !fit) return;

        const cs     = getComputedStyle(box);
        const availW = box.clientWidth  - parseFloat(cs.paddingLeft) - parseFloat(cs.paddingRight);
        const availH = box.clientHeight - parseFloat(cs.paddingTop)  - parseFloat(cs.paddingBottom);
        if (availW <= 0 || availH <= 0) return;

        const ceilW = Math.ceil(availW);
        const search = (upper) => {
            let lo = 8, hi = Math.max(lo, upper), best = lo;
            for (let i = 0; i < 18 && hi - lo > 0.5; i++) {
                const mid = (lo + hi) / 2;
                fit.style.fontSize = mid + 'px';
                if (fit.scrollHeight <= availH && fit.scrollWidth <= ceilW) {
                    best = mid;
                    lo = mid;
                } else {
                    hi = mid;
                }
            }
            return best;
        };

        const roomiest = Math.max(40, availH);
        let best = search(roomiest);

        // If that size would split a word, retry with whole words enforced —
        // but keep the bigger broken-word size when the compromise is drastic
        // (a 40-character word can't be shown whole and still be readable).
        const cap = maxSizeWithWholeWords(fit, availW);
        if (best > cap) {
            const whole = search(Math.min(roomiest, cap));
            if (whole >= best * 0.6) best = whole;
        }

        fit.style.fontSize = best + 'px';
    }

    function fitAllText() {
        document.querySelectorAll('.slide.text-slide').forEach(fitText);
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
        fitAllText();
        // Inter loads async — remeasure once the real font metrics are in
        if (document.fonts && document.fonts.ready) document.fonts.ready.then(fitAllText);
        showAd(current);
    }

    // Rotation, screen resize and orientation changes all need a remeasure
    window.addEventListener('resize', fitAllText);

    function showAd(index) {
        clearTimeout(rotateTimer);

        document.querySelectorAll('.slide').forEach(s => s.classList.remove('active'));

        const ad = ads[index];
        const slide = document.getElementById('slide-' + ad.id);
        if (slide) {
            slide.classList.add('active');
            if (slide.classList.contains('text-slide')) fitText(slide);
        }


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
