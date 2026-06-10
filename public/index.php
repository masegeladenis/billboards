<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billboard Manager — Sign In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --primary-glow: rgba(99,102,241,0.3);
            --success: #10b981;
            --error: #ef4444;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
            --bg: #f1f5f9;
            --card: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: var(--bg);
            background-image:
                radial-gradient(ellipse 60% 50% at 20% 50%, rgba(99,102,241,0.13) 0%, transparent 100%),
                radial-gradient(ellipse 50% 40% at 80% 15%, rgba(139,92,246,0.09) 0%, transparent 100%);
        }

        /* Toast */
        .toast-wrap {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            background: #0f172a;
            box-shadow: 0 8px 24px rgba(0,0,0,0.18), 0 0 0 1px rgba(255,255,255,0.05);
            opacity: 0;
            transform: translateY(-12px) scale(0.97);
            transition: opacity 0.25s ease, transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
            pointer-events: none;
            white-space: nowrap;
        }

        .toast.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .toast-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .toast.success .toast-dot { background: var(--success); }
        .toast.error .toast-dot   { background: var(--error); }

        /* Card */
        .card {
            background: var(--card);
            border-radius: 24px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow:
                0 0 0 1px rgba(0,0,0,0.05),
                0 4px 6px rgba(0,0,0,0.04),
                0 16px 48px rgba(0,0,0,0.07);
        }

        /* Brand */
        .brand { text-align: center; margin-bottom: 32px; }

        .brand-icon {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin-bottom: 16px;
            box-shadow: 0 6px 20px rgba(99,102,241,0.45);
        }

        .brand h1 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.4px;
        }

        .brand p {
            font-size: 14px;
            color: var(--muted);
            margin-top: 4px;
        }

        /* Tabs */
        .tabs {
            display: flex;
            background: var(--bg);
            border-radius: 12px;
            padding: 4px;
            margin-bottom: 28px;
        }

        .tab-btn {
            flex: 1;
            padding: 9px 12px;
            background: none;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: var(--muted);
            transition: all 0.18s ease;
            font-family: inherit;
        }

        .tab-btn.active {
            background: #fff;
            color: var(--text);
            box-shadow: 0 1px 4px rgba(0,0,0,0.09), 0 0 0 1px rgba(0,0,0,0.04);
        }

        /* Form */
        .tab-content { display: none; }
        .tab-content.active { display: block; }

        .form-group { margin-bottom: 16px; }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 7px;
        }

        .form-group label .opt {
            font-weight: 400;
            color: var(--muted);
        }

        .form-group input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text);
            background: #fff;
            transition: border-color 0.18s, box-shadow 0.18s;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        .form-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.13);
        }

        .form-group input::placeholder { color: #94a3b8; }

        /* Submit button */
        .btn-submit {
            width: 100%;
            margin-top: 8px;
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
            letter-spacing: -0.1px;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            box-shadow: 0 4px 18px var(--primary-glow);
            transform: translateY(-1px);
        }

        .btn-submit:active { transform: translateY(0); box-shadow: none; }
        .btn-submit:disabled { opacity: 0.6; cursor: default; transform: none; box-shadow: none; }

        .spinner {
            width: 16px; height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.65s linear infinite;
            display: none;
        }

        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>

<div class="toast-wrap">
    <div class="toast" id="toast">
        <div class="toast-dot"></div>
        <span id="toastMsg"></span>
    </div>
</div>

<div class="card">
    <div class="brand">
        <div class="brand-icon">📺</div>
        <h1>Billboard Manager</h1>
        <p>Advertisement Management System</p>
    </div>

    <div class="tabs">
        <button class="tab-btn active" onclick="switchTab('login', this)">Sign In</button>
        <button class="tab-btn" onclick="switchTab('register', this)">Create Account</button>
    </div>

    <!-- Login -->
    <div class="tab-content active" id="login-tab">
        <form id="loginForm">
            <div class="form-group">
                <label>Email address</label>
                <input type="email" id="loginEmail" placeholder="you@example.com" required autocomplete="email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="loginPassword" placeholder="Your password" required>
            </div>
            <button type="submit" class="btn-submit" id="loginBtn">
                <div class="spinner" id="loginSpinner"></div>
                <span id="loginBtnText">Sign In</span>
            </button>
        </form>
    </div>

    <!-- Register -->
    <div class="tab-content" id="register-tab">
        <form id="registerForm">
            <div class="form-group">
                <label>Full name</label>
                <input type="text" id="registerName" placeholder="Your full name" required>
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" id="registerEmail" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
                <label>Company <span class="opt">(optional)</span></label>
                <input type="text" id="registerCompany" placeholder="Your company name">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="registerPassword" placeholder="Min. 6 characters" required>
            </div>
            <div class="form-group">
                <label>Confirm password</label>
                <input type="password" id="registerPasswordConfirm" placeholder="Repeat password" required>
            </div>
            <button type="submit" class="btn-submit" id="registerBtn">
                <div class="spinner" id="registerSpinner"></div>
                <span id="registerBtnText">Create Account</span>
            </button>
        </form>
    </div>
</div>

<script>
    const API_BASE = '<?= rtrim(dirname(dirname($_SERVER["SCRIPT_NAME"])), "/") ?>/api';

    fetch(`${API_BASE}/auth.php?action=check`, { credentials: 'include' })
        .then(r => r.json()).then(d => { if (d.success) location.href = 'dashboard'; });

    function switchTab(tab, btn) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
        document.getElementById(tab + '-tab').classList.add('active');
        btn.classList.add('active');
    }

    let toastTimer;
    function showToast(msg, type = 'info') {
        const el = document.getElementById('toast');
        document.getElementById('toastMsg').textContent = msg;
        el.className = 'toast ' + type;
        void el.offsetWidth;
        el.classList.add('visible');
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => el.classList.remove('visible'), 3800);
    }

    function setLoading(id, loading, defaultText) {
        document.getElementById(id + 'Btn').disabled = loading;
        document.getElementById(id + 'Spinner').style.display = loading ? 'block' : 'none';
        document.getElementById(id + 'BtnText').textContent = loading ? 'Please wait…' : defaultText;
    }

    document.getElementById('loginForm').addEventListener('submit', async e => {
        e.preventDefault();
        setLoading('login', true, 'Sign In');
        try {
            const data = await fetch(`${API_BASE}/auth.php`, {
                method: 'POST', credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email: loginEmail.value, password: loginPassword.value })
            }).then(r => r.json());

            if (data.success) {
                showToast('Welcome back! Redirecting…', 'success');
                setTimeout(() => location.href = 'dashboard', 900);
            } else {
                showToast(data.message || 'Incorrect email or password', 'error');
                setLoading('login', false, 'Sign In');
            }
        } catch {
            showToast('Connection error. Please try again.', 'error');
            setLoading('login', false, 'Sign In');
        }
    });

    document.getElementById('registerForm').addEventListener('submit', async e => {
        e.preventDefault();
        if (registerPassword.value !== registerPasswordConfirm.value)
            return showToast('Passwords do not match', 'error');
        if (registerPassword.value.length < 6)
            return showToast('Password must be at least 6 characters', 'error');
        setLoading('register', true, 'Create Account');
        try {
            const data = await fetch(`${API_BASE}/auth.php`, {
                method: 'POST', credentials: 'include',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    name: registerName.value, email: registerEmail.value,
                    company_name: registerCompany.value, password: registerPassword.value
                })
            }).then(r => r.json());

            if (data.success) {
                showToast('Account created! Signing you in…', 'success');
                setTimeout(async () => {
                    const login = await fetch(`${API_BASE}/auth.php`, {
                        method: 'POST', credentials: 'include',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ email: registerEmail.value, password: registerPassword.value })
                    }).then(r => r.json());
                    if (login.success) location.href = 'dashboard';
                }, 800);
            } else {
                showToast(data.message || 'Registration failed', 'error');
                setLoading('register', false, 'Create Account');
            }
        } catch {
            showToast('Connection error. Please try again.', 'error');
            setLoading('register', false, 'Create Account');
        }
    });
</script>
</body>
</html>
