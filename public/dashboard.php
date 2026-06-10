<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billboard Manager — Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --primary-light: #eef2ff;
            --success: #10b981;
            --success-bg: #d1fae5;
            --error: #ef4444;
            --error-bg: #fee2e2;
            --warning: #f59e0b;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
            --card: #ffffff;
            --nav-h: 64px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── Navbar ── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            height: var(--nav-h);
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
            text-decoration: none;
            flex-shrink: 0;
        }

        .nav-brand-icon {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            box-shadow: 0 2px 8px rgba(99,102,241,0.35);
        }

        .nav-spacer { flex: 1; }

        .nav-actions { display: flex; align-items: center; gap: 10px; }

        .btn-outline {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 14px;
            background: none;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            font-family: inherit;
            transition: all 0.18s;
            text-decoration: none;
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .btn-danger {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 14px;
            background: none;
            border: 1.5px solid #fecaca;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            color: var(--error);
            cursor: pointer;
            font-family: inherit;
            transition: all 0.18s;
        }

        .btn-danger:hover { background: var(--error-bg); border-color: #fca5a5; }

        .user-badge {
            display: flex; align-items: center; gap: 8px;
            padding: 6px 12px 6px 6px;
            border-radius: 40px;
            border: 1.5px solid var(--border);
            background: var(--card);
        }

        .user-avatar {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .user-email { font-size: 13px; font-weight: 500; color: var(--text); }

        /* ── Layout ── */
        .page { max-width: 1280px; margin: 0 auto; padding: 28px 28px 60px; }

        /* ── Stats ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--card);
            border-radius: 16px;
            padding: 20px 22px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .stat-icon.total   { background: #ede9fe; }
        .stat-icon.active  { background: var(--success-bg); }
        .stat-icon.inactive{ background: #f1f5f9; }

        .stat-val {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .stat-label {
            font-size: 13px;
            color: var(--muted);
            margin-top: 3px;
        }

        /* ── Two-col content ── */
        .content-grid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 20px;
            align-items: start;
        }

        @media (max-width: 920px) {
            .content-grid { grid-template-columns: 1fr; }
            .stats-row { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 560px) {
            .stats-row { grid-template-columns: 1fr; }
            .page { padding: 16px; }
            .navbar { padding: 0 16px; }
        }

        /* ── Panel ── */
        .panel {
            background: var(--card);
            border-radius: 18px;
            border: 1px solid var(--border);
            padding: 24px;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .panel-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
        }

        .panel-subtitle {
            font-size: 13px;
            color: var(--muted);
            margin-top: 2px;
        }

        /* ── Form ── */
        .form-section {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: var(--muted);
            margin: 20px 0 12px;
        }

        .form-section:first-child { margin-top: 0; }

        .form-group { margin-bottom: 14px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 6px;
        }

        .form-group label .opt { color: var(--muted); font-weight: 400; }

        .form-input {
            width: 100%;
            padding: 10px 13px;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text);
            background: #fff;
            transition: border-color 0.18s, box-shadow 0.18s;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }

        .form-input::placeholder { color: #94a3b8; }

        textarea.form-input { resize: vertical; min-height: 90px; }

        .time-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

        /* Ad type selector */
        .type-selector {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .type-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            padding: 12px 8px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            background: #fff;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            transition: all 0.18s;
        }

        .type-btn .type-icon { font-size: 22px; }
        .type-btn:hover { border-color: var(--primary); color: var(--primary); background: var(--primary-light); }
        .type-btn.active { border-color: var(--primary); color: var(--primary); background: var(--primary-light); box-shadow: 0 0 0 3px rgba(99,102,241,0.12); }

        /* Day pills */
        .day-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 2px;
        }

        .day-pill { cursor: pointer; }
        .day-pill input[type="checkbox"] { display: none; }
        .day-pill span {
            display: block;
            padding: 7px 12px;
            border-radius: 8px;
            border: 1.5px solid var(--border);
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            transition: all 0.18s;
            user-select: none;
        }

        .day-pill:hover span { border-color: var(--primary); color: var(--primary); }
        .day-pill input:checked + span {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        /* File upload */
        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: 10px;
            padding: 24px 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.18s;
            background: var(--bg);
            position: relative;
        }

        .upload-zone:hover, .upload-zone.drag { border-color: var(--primary); background: var(--primary-light); }
        .upload-zone input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
        .upload-icon { font-size: 28px; margin-bottom: 8px; }
        .upload-text { font-size: 13px; font-weight: 500; color: var(--muted); }
        .upload-hint { font-size: 12px; color: #94a3b8; margin-top: 3px; }
        .upload-filename { font-size: 13px; font-weight: 600; color: var(--primary); margin-top: 6px; display: none; }

        .progress-wrap { margin-top: 10px; display: none; }
        .progress-track { height: 4px; background: var(--border); border-radius: 99px; overflow: hidden; }
        .progress-bar { height: 100%; background: var(--primary); width: 0%; transition: width 0.3s; border-radius: 99px; }
        .progress-label { font-size: 12px; color: var(--muted); margin-top: 5px; text-align: right; }

        /* Submit */
        .btn-create {
            width: 100%;
            margin-top: 6px;
            padding: 12px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.18s, box-shadow 0.18s, transform 0.12s;
        }

        .btn-create:hover { background: var(--primary-hover); box-shadow: 0 4px 18px rgba(99,102,241,0.35); transform: translateY(-1px); }
        .btn-create:active { transform: none; box-shadow: none; }
        .btn-create:disabled { opacity: 0.6; cursor: default; transform: none; box-shadow: none; }

        .spinner {
            width: 16px; height: 16px;
            border: 2px solid rgba(255,255,255,0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.65s linear infinite;
            display: none;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* ── Ads list ── */
        .ads-list { display: flex; flex-direction: column; gap: 12px; }

        /* Skeleton */
        .skeleton-card {
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 16px;
            background: var(--card);
        }

        .skel {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 400% 100%;
            animation: shimmer 1.4s infinite;
            border-radius: 6px;
        }

        @keyframes shimmer { to { background-position: -400% 0; } }

        .skel-line { height: 14px; margin-bottom: 8px; }
        .skel-line.w-2-3 { width: 65%; }
        .skel-line.w-1-3 { width: 38%; }
        .skel-line.w-1-2 { width: 50%; }
        .skel-btns { display: flex; gap: 8px; margin-top: 12px; }
        .skel-btn { height: 32px; width: 80px; border-radius: 8px; }

        /* Ad card */
        .ad-card {
            border-radius: 14px;
            border: 1px solid var(--border);
            background: var(--card);
            padding: 16px;
            transition: box-shadow 0.18s, transform 0.18s;
        }

        .ad-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.07); transform: translateY(-1px); }

        .ad-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .ad-title-row { flex: 1; min-width: 0; }

        .ad-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .ad-time {
            font-size: 12px;
            color: var(--muted);
            margin-top: 3px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .status-pill::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
        }

        .status-active { background: var(--success-bg); color: #065f46; }
        .status-active::before { background: var(--success); }
        .status-inactive { background: #f1f5f9; color: #475569; }
        .status-inactive::before { background: #94a3b8; }

        .ad-badges { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 12px; }

        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 4px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid;
        }

        .badge-type { background: #ede9fe; color: #5b21b6; border-color: #ddd6fe; }
        .badge-media-ok { background: var(--success-bg); color: #065f46; border-color: #a7f3d0; }
        .badge-media-no { background: var(--error-bg); color: #991b1b; border-color: #fca5a5; }
        .badge-text { background: #f1f5f9; color: var(--muted); border-color: var(--border); }

        .ad-actions { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }

        .btn-sm {
            padding: 7px 14px;
            border-radius: 8px;
            border: 1.5px solid;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.18s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-activate { border-color: #a7f3d0; color: #065f46; background: var(--success-bg); }
        .btn-activate:hover { background: #a7f3d0; }
        .btn-deactivate { border-color: #ddd6fe; color: #5b21b6; background: #ede9fe; }
        .btn-deactivate:hover { background: #ddd6fe; }
        .btn-del { border-color: #fca5a5; color: #991b1b; background: var(--error-bg); }
        .btn-del:hover { background: #fca5a5; }
        .btn-cancel-del { border-color: var(--border); color: var(--muted); background: #fff; }
        .btn-cancel-del:hover { background: var(--bg); }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 52px 20px;
        }

        .empty-icon { font-size: 48px; margin-bottom: 14px; }
        .empty-title { font-size: 16px; font-weight: 600; color: var(--text); margin-bottom: 6px; }
        .empty-sub { font-size: 14px; color: var(--muted); }

        /* Display link */
        .display-link {
            margin-top: 20px;
            padding: 14px 16px;
            background: var(--primary-light);
            border-radius: 12px;
            border: 1px solid #c7d2fe;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .display-link-text { font-size: 14px; font-weight: 500; color: #3730a3; }
        .display-link-sub { font-size: 12px; color: #6366f1; margin-top: 2px; }

        .btn-display {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px;
            background: var(--primary);
            color: #fff;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.18s;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .btn-display:hover { background: var(--primary-hover); }

        /* Toast */
        .toast-wrap {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 8px;
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            background: #0f172a;
            box-shadow: 0 8px 24px rgba(0,0,0,0.18);
            opacity: 0;
            transform: translateX(16px);
            transition: opacity 0.25s, transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
            pointer-events: auto;
            max-width: 320px;
        }

        .toast.visible { opacity: 1; transform: translateX(0); }

        .toast-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .toast.success .toast-dot { background: var(--success); }
        .toast.error .toast-dot   { background: var(--error); }
        .toast.info .toast-dot    { background: #60a5fa; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <a class="nav-brand" href="#">
        <div class="nav-brand-icon">📺</div>
        Billboard Manager
    </a>
    <div class="nav-spacer"></div>
    <div class="nav-actions">
        <a class="btn-outline" href="display" target="_blank">
            <span>🖥</span> View Display
        </a>
        <div class="user-badge">
            <div class="user-avatar" id="userAvatar">?</div>
            <span class="user-email" id="userEmail">Loading…</span>
        </div>
        <button class="btn-danger" onclick="logout()">Sign out</button>
    </div>
</nav>

<!-- Toast -->
<div class="toast-wrap">
    <div class="toast" id="toast">
        <div class="toast-dot"></div>
        <span id="toastMsg"></span>
    </div>
</div>

<!-- Page body -->
<div class="page">

    <!-- Stats -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon total">📊</div>
            <div>
                <div class="stat-val" id="statTotal">—</div>
                <div class="stat-label">Total Ads</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon active">✅</div>
            <div>
                <div class="stat-val" id="statActive">—</div>
                <div class="stat-label">Active</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon inactive">⏸</div>
            <div>
                <div class="stat-val" id="statInactive">—</div>
                <div class="stat-label">Inactive</div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="content-grid">

        <!-- Create form -->
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title">Create Advertisement</div>
                    <div class="panel-subtitle">Add a new ad to your billboard</div>
                </div>
            </div>

            <form id="adForm">
                <div class="form-section">Basic Info</div>

                <div class="form-group">
                    <label>Title <span class="opt">*</span></label>
                    <input type="text" class="form-input" id="title" placeholder="e.g. Summer Sale 2025" required>
                </div>

                <div class="form-group">
                    <label>Ad Type <span class="opt">*</span></label>
                    <div class="type-selector">
                        <button type="button" class="type-btn" onclick="selectType('text', this)">
                            <span class="type-icon">📝</span>Text
                        </button>
                        <button type="button" class="type-btn" onclick="selectType('image', this)">
                            <span class="type-icon">🖼️</span>Image
                        </button>
                        <button type="button" class="type-btn" onclick="selectType('video', this)">
                            <span class="type-icon">🎬</span>Video
                        </button>
                    </div>
                    <input type="hidden" id="type" value="">
                </div>

                <div class="form-group" id="contentField" style="display:none">
                    <label>Text Content <span class="opt">*</span></label>
                    <textarea class="form-input" id="content" placeholder="Enter the message to display on the billboard…"></textarea>
                </div>

                <div class="form-group" id="mediaField" style="display:none">
                    <label>Upload Media</label>
                    <div class="upload-zone" id="uploadZone">
                        <input type="file" id="media" accept="image/*,video/mp4,video/quicktime"
                               onchange="onFileSelect(this)" ondragover="uploadZone.classList.add('drag')" ondragleave="uploadZone.classList.remove('drag')">
                        <div class="upload-icon">📁</div>
                        <div class="upload-text">Click or drag & drop to upload</div>
                        <div class="upload-hint">JPG, PNG, GIF, MP4 · Max 100 MB</div>
                        <div class="upload-filename" id="uploadFilename"></div>
                    </div>
                    <div class="progress-wrap" id="progressWrap">
                        <div class="progress-track">
                            <div class="progress-bar" id="progressBar"></div>
                        </div>
                        <div class="progress-label" id="progressLabel">0%</div>
                    </div>
                </div>

                <div class="form-section">Schedule</div>

                <div class="time-row">
                    <div class="form-group">
                        <label>Start Time <span class="opt">*</span></label>
                        <input type="time" class="form-input" id="startTime" required>
                    </div>
                    <div class="form-group">
                        <label>End Time <span class="opt">*</span></label>
                        <input type="time" class="form-input" id="endTime" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Display Duration <span class="opt">(seconds per slide)</span></label>
                    <input type="number" class="form-input" id="duration" value="10" min="3" max="300" placeholder="10">
                </div>

                <div class="form-group">
                    <label>Days of Week <span class="opt">*</span></label>
                    <div class="day-pills">
                        <label class="day-pill"><input type="checkbox" name="days" value="Monday"><span>Mon</span></label>
                        <label class="day-pill"><input type="checkbox" name="days" value="Tuesday"><span>Tue</span></label>
                        <label class="day-pill"><input type="checkbox" name="days" value="Wednesday"><span>Wed</span></label>
                        <label class="day-pill"><input type="checkbox" name="days" value="Thursday"><span>Thu</span></label>
                        <label class="day-pill"><input type="checkbox" name="days" value="Friday"><span>Fri</span></label>
                        <label class="day-pill"><input type="checkbox" name="days" value="Saturday"><span>Sat</span></label>
                        <label class="day-pill"><input type="checkbox" name="days" value="Sunday"><span>Sun</span></label>
                    </div>
                </div>

                <div class="time-row">
                    <div class="form-group">
                        <label>Start Date <span class="opt">(optional)</span></label>
                        <input type="date" class="form-input" id="startDate">
                    </div>
                    <div class="form-group">
                        <label>End Date <span class="opt">(optional)</span></label>
                        <input type="date" class="form-input" id="endDate">
                    </div>
                </div>

                <button type="submit" class="btn-create" id="createBtn">
                    <div class="spinner" id="createSpinner"></div>
                    <span id="createBtnText">Create Advertisement</span>
                </button>
            </form>
        </div>

        <!-- Ads list -->
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title">Your Advertisements</div>
                    <div class="panel-subtitle">Manage all your billboard ads</div>
                </div>
            </div>

            <div class="ads-list" id="adsList">
                <!-- Skeleton loader -->
                <div class="skeleton-card">
                    <div class="skel skel-line w-2-3"></div>
                    <div class="skel skel-line w-1-3"></div>
                    <div class="skel-btns"><div class="skel skel-btn"></div><div class="skel skel-btn"></div></div>
                </div>
                <div class="skeleton-card">
                    <div class="skel skel-line w-1-2"></div>
                    <div class="skel skel-line w-2-3"></div>
                    <div class="skel-btns"><div class="skel skel-btn"></div><div class="skel skel-btn"></div></div>
                </div>
            </div>

            <div class="display-link">
                <div>
                    <div class="display-link-text">Billboard Display</div>
                    <div class="display-link-sub">Live = current time &amp; day · Preview = all active ads</div>
                </div>
                <div style="display:flex;gap:8px;flex-shrink:0">
                    <a class="btn-display" href="display?preview=1" target="_blank" style="background:#475569">👁 Preview</a>
                    <a class="btn-display" href="display" target="_blank">📺 Live</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    let currentUser = null;
    const API_BASE = '<?= rtrim(dirname(dirname($_SERVER["SCRIPT_NAME"])), "/") ?>/api';

    document.addEventListener('DOMContentLoaded', () => {
        checkAuth();
        loadAds();
        document.getElementById('adForm').addEventListener('submit', createAd);
    });

    function checkAuth() {
        fetch(`${API_BASE}/auth.php?action=check`, { credentials: 'include' })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    currentUser = data.user;
                    document.getElementById('userEmail').textContent = data.user.email;
                    const initial = (data.user.name || data.user.email || '?')[0].toUpperCase();
                    document.getElementById('userAvatar').textContent = initial;
                } else {
                    location.href = 'index.php';
                }
            });
    }

    // Type selection
    function selectType(type, btn) {
        document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('type').value = type;

        document.getElementById('contentField').style.display = type === 'text' ? 'block' : 'none';
        document.getElementById('mediaField').style.display = (type === 'image' || type === 'video') ? 'block' : 'none';
        document.getElementById('content').required = (type === 'text');
    }

    function onFileSelect(input) {
        const fn = document.getElementById('uploadFilename');
        if (input.files[0]) {
            fn.style.display = 'block';
            fn.textContent = '📎 ' + input.files[0].name;
        } else {
            fn.style.display = 'none';
        }
    }

    function createAd(e) {
        e.preventDefault();
        const type = document.getElementById('type').value;
        const days = Array.from(document.querySelectorAll('input[name="days"]:checked')).map(el => el.value);

        if (!type)          return showToast('Please select an ad type', 'error');
        if (!days.length)   return showToast('Please select at least one day', 'error');

        if (type === 'text') {
            const content = document.getElementById('content').value.trim();
            if (!content) return showToast('Please enter text content', 'error');
            setCreating(true);
            submitAd({ title: title.value, description: '', ad_type: type, content, media_path: null,
                start_time: startTime.value, end_time: endTime.value, days,
                start_date: startDate.value || null, end_date: endDate.value || null,
                duration: parseInt(duration.value) || 10 });
        } else {
            if (!document.getElementById('media').files[0])
                return showToast(`Please upload a ${type} file`, 'error');
            setCreating(true);
            uploadFile();
        }
    }

    function setCreating(loading) {
        document.getElementById('createBtn').disabled = loading;
        document.getElementById('createSpinner').style.display = loading ? 'block' : 'none';
        document.getElementById('createBtnText').textContent = loading ? 'Creating…' : 'Create Advertisement';
    }

    function uploadFile() {
        const fileInput = document.getElementById('media');
        const formData = new FormData();
        formData.append('file', fileInput.files[0]);

        const xhr = new XMLHttpRequest();
        xhr.upload.addEventListener('progress', e => {
            if (e.lengthComputable) {
                const pct = Math.round((e.loaded / e.total) * 100);
                document.getElementById('progressBar').style.width = pct + '%';
                document.getElementById('progressLabel').textContent = pct + '%';
            }
        });

        xhr.addEventListener('load', () => {
            document.getElementById('progressWrap').style.display = 'none';
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                if (data.success) {
                    const days = Array.from(document.querySelectorAll('input[name="days"]:checked')).map(el => el.value);
                    submitAd({ title: title.value, description: '', ad_type: type.value, content: '',
                        media_path: data.file_path, start_time: startTime.value, end_time: endTime.value, days,
                        start_date: startDate.value || null, end_date: endDate.value || null,
                        duration: parseInt(duration.value) || 10 });
                } else {
                    showToast(data.message || 'Upload failed', 'error');
                    setCreating(false);
                }
            }
        });

        xhr.addEventListener('error', () => { showToast('Upload failed', 'error'); setCreating(false); });

        document.getElementById('progressWrap').style.display = 'block';
        document.getElementById('progressBar').style.width = '0%';
        document.getElementById('progressLabel').textContent = '0%';
        xhr.open('POST', `${API_BASE}/upload.php`);
        xhr.withCredentials = true;
        xhr.send(formData);
    }

    function submitAd(data) {
        fetch(`${API_BASE}/ads.php`, {
            method: 'POST', credentials: 'include',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(r => r.json())
        .then(data => {
            setCreating(false);
            if (data.success) {
                showToast('Advertisement created successfully!', 'success');
                document.getElementById('adForm').reset();
                document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
                document.getElementById('type').value = '';
                document.getElementById('contentField').style.display = 'none';
                document.getElementById('mediaField').style.display = 'none';
                document.getElementById('uploadFilename').style.display = 'none';
                loadAds();
            } else {
                showToast(data.message || 'Failed to create ad', 'error');
            }
        })
        .catch(() => { setCreating(false); showToast('Connection error', 'error'); });
    }

    function loadAds() {
        const fmt = t => {
            if (!t) return '--:--';
            const parts = String(t).split(':');
            const hh = parseInt(parts[0], 10);
            const mm = parts[1] || '00';
            return `${hh % 12 || 12}:${mm} ${hh >= 12 ? 'PM' : 'AM'}`;
        };

        fetch(`${API_BASE}/ads.php`, { method: 'GET', credentials: 'include' })
            .then(r => r.json())
            .then(data => {
                const list = document.getElementById('adsList');

                if (!data.success) {
                    list.innerHTML = `<div class="empty-state"><div class="empty-title">API error</div><div class="empty-sub">${data.message || 'Unknown error'}</div></div>`;
                    return;
                }

                const ads = data.ads || [];

                document.getElementById('statTotal').textContent = ads.length;
                document.getElementById('statActive').textContent = ads.filter(a => a.is_active == 1).length;
                document.getElementById('statInactive').textContent = ads.filter(a => a.is_active != 1).length;

                if (ads.length === 0) {
                    list.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-icon">📭</div>
                            <div class="empty-title">No advertisements yet</div>
                            <div class="empty-sub">Create your first ad using the form on the left</div>
                        </div>`;
                    return;
                }

                list.innerHTML = '';
                ads.forEach(ad => {
                    const hasMedia = ad.media_path && String(ad.media_path).trim() !== '';
                    const adType = ad.ad_type || 'text';
                    const typeIcon = { text: '📝', image: '🖼️', video: '🎬' }[adType] || '📄';
                    const mediaLabel = adType === 'text'
                        ? '<span class="badge badge-text">📝 Text content</span>'
                        : hasMedia
                            ? '<span class="badge badge-media-ok">✓ Media attached</span>'
                            : '<span class="badge badge-media-no">✕ No media</span>';

                    const card = document.createElement('div');
                    card.className = 'ad-card';
                    card.id = 'adcard-' + ad.id;
                    card.innerHTML = `
                        <div class="ad-card-top">
                            <div class="ad-title-row">
                                <div class="ad-title">${escHtml(ad.title || '')}</div>
                                <div class="ad-time">⏰ ${fmt(ad.start_time)} — ${fmt(ad.end_time)} &nbsp;·&nbsp; ⏱ ${ad.duration || 10}s</div>
                            </div>
                            <span class="status-pill ${ad.is_active == 1 ? 'status-active' : 'status-inactive'}">
                                ${ad.is_active == 1 ? 'Active' : 'Inactive'}
                            </span>
                        </div>
                        <div class="ad-badges">
                            <span class="badge badge-type">${typeIcon} ${adType.toUpperCase()}</span>
                            ${mediaLabel}
                        </div>
                        <div class="ad-actions" id="actions-${ad.id}">
                            <button class="btn-sm ${ad.is_active == 1 ? 'btn-deactivate' : 'btn-activate'}"
                                    onclick="toggleAd(${ad.id})">
                                ${ad.is_active == 1 ? '⏸ Deactivate' : '▶ Activate'}
                            </button>
                            <button class="btn-sm btn-del" onclick="confirmDelete(${ad.id})">🗑 Delete</button>
                        </div>`;
                    list.appendChild(card);
                });
            })
            .catch(err => {
                console.error('loadAds error:', err);
                document.getElementById('adsList').innerHTML =
                    `<div class="empty-state"><div class="empty-title">Failed to load ads</div><div class="empty-sub">${err.message}</div></div>`;
            });
    }

    function toggleAd(id) {
        fetch(`${API_BASE}/ads.php?id=${id}&action=toggle`, { method: 'PUT', credentials: 'include' })
            .then(r => r.json())
            .then(data => { if (data.success) loadAds(); });
    }

    function confirmDelete(id) {
        const actions = document.getElementById('actions-' + id);
        actions.innerHTML = `
            <span style="font-size:13px;color:var(--muted);align-self:center;">Delete this ad?</span>
            <button class="btn-sm btn-del" onclick="deleteAd(${id})">Yes, Delete</button>
            <button class="btn-sm btn-cancel-del" onclick="loadAds()">Cancel</button>`;
    }

    function deleteAd(id) {
        fetch(`${API_BASE}/ads.php?id=${id}&action=delete`, { method: 'POST', credentials: 'include' })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    showToast('Advertisement deleted', 'info');
                } else {
                    showToast(data.message || 'Delete failed', 'error');
                }
                loadAds();
            })
            .catch(() => {
                showToast('Connection error', 'error');
                loadAds();
            });
    }

    function logout() {
        fetch(`${API_BASE}/auth.php?action=logout`, { method: 'POST', credentials: 'include' })
            .then(() => location.href = 'index.php');
    }

    let toastTimer;
    function showToast(msg, type = 'info') {
        const el = document.getElementById('toast');
        document.getElementById('toastMsg').textContent = msg;
        el.className = 'toast ' + type;
        void el.offsetWidth;
        el.classList.add('visible');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => el.classList.remove('visible'), 4000);
    }

    function escHtml(s) {
        return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
</script>
</body>
</html>
