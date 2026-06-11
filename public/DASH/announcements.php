<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Announcements | Billboard Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Billboard Advertisement Management System" name="description" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Layout Js -->
        <script src="assets/js/layout.js"></script>
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="colored">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.php" class="logo logo-dark">
                                <span class="logo-sm" style="font-size:20px;">📢</span>
                                <span class="logo-lg" style="font-size:16px;font-weight:700;color:#2b3940;">📢 Billboard Manager</span>
                            </a>
                            <a href="index.php" class="logo logo-light">
                                <span class="logo-sm" style="font-size:20px;">📢</span>
                                <span class="logo-lg" style="font-size:16px;font-weight:700;color:#fff;">📢 Billboard Manager</span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>

                        <!-- start page title -->
                        <div class="page-title-box align-self-center d-none d-md-block">
                            <h4 class="page-title mb-0">Announcements</h4>
                        </div>
                        <!-- end page title -->
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                 <!-- LOGO -->
                 <div class="navbar-brand-box">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm" style="font-size:20px;">📢</span>
                        <span class="logo-lg" style="font-size:16px;font-weight:700;color:#2b3940;">📢 Billboard Manager</span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm" style="font-size:20px;">📢</span>
                        <span class="logo-lg" style="font-size:16px;font-weight:700;color:#fff;">📢 Billboard Manager</span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
                    <i class="ri-menu-2-line align-middle"></i>
                </button>

                <div data-simplebar class="vertical-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="dropdown mx-3 sidebar-user user-dropdown select-dropdown">
                            <button type="button" class="btn btn-light w-100 waves-effect waves-light border-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs rounded-circle flex-shrink-0">
                                            <div class="avatar-title border bg-light text-primary rounded-circle text-uppercase user-sort-name">?</div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-2 text-start">
                                        <h6 class="mb-1 fw-medium user-name-text">&hellip;</h6>
                                        <p class="font-size-13 text-muted user-name-sub-text mb-0">Billboard Manager</p>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <i class="mdi mdi-chevron-down font-size-16"></i>
                                    </div>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end w-100">
                                <a class="dropdown-item d-flex align-items-center px-3" href="javascript:appLogout();">
                                    <i class="mdi mdi-logout text-muted font-size-16 me-2"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="index.php" class="waves-effect">
                                    <i class="uim uim-airplay"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="mm-active">
                                <a href="javascript: void(0);" class="has-arrow waves-effect active">
                                    <i class="uim uim-comment-message"></i>
                                    <span>Announcements</span>
                                </a>
                                <ul class="sub-menu mm-show" aria-expanded="true">
                                    <li class="mm-active"><a href="announcements.php" class="active">All Announcements</a></li>
                                    <li><a href="announcements.php?create=1">Create Announcement</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">Billboard</li>

                            <li>
                                <a href="../display.php" target="_blank" class="waves-effect">
                                    <i class="uim uim-window-grid"></i>
                                    <span>Live Display</span>
                                </a>
                            </li>

                            <li class="menu-title">Account</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uim uim-sign-in-alt"></i>
                                    <span>Authentication</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="auth-recoverpw.php">Reset Password</a></li>
                                    <li><a href="javascript:appLogout();">Logout</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                    <!-- Sidebar -->
                </div>

                <div class="dropdown px-3 sidebar-user sidebar-user-info">
                    <button type="button" class="btn w-100 px-0 border-0" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs rounded-circle flex-shrink-0">
                                    <div class="avatar-title border bg-light text-primary rounded-circle text-uppercase user-sort-name">?</div>
                                </div>
                            </div>

                            <div class="flex-grow-1 ms-2 text-start">
                                <span class="ms-1 fw-medium user-name-text">…</span>
                            </div>

                            <div class="flex-shrink-0 text-end">
                                <i class="mdi mdi-dots-vertical font-size-16"></i>
                            </div>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="javascript:appLogout();"><i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Logout</span></a>
                    </div>
                </div>

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex pb-0">
                                        <h4 class="card-title mb-0 flex-grow-1">All Announcements</h4>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createAdModal">+ Create Announcement</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-success d-none" id="flashMsg"></div>
                                        <div class="table-responsive">
                                            <table class="table align-middle table-centered table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Announcement</th>
                                                        <th scope="col">Owner</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Air Time</th>
                                                        <th scope="col">Duration</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Created</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="adsTableBody">
                                                    <tr><td colspan="8" class="text-center text-muted py-4">Loading…</td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END ROW -->

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Billboard Manager.
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Create Announcement Modal -->
        <div class="modal fade" id="createAdModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form id="createAdForm">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Announcement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger d-none" id="createAdAlert" role="alert"></div>

                            <div class="mb-3">
                                <label class="form-label" for="adTitle">Title</label>
                                <input type="text" class="form-control" id="adTitle" placeholder="e.g. Church Event" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Type</label>
                                <div class="btn-group" role="group">
                                    <input type="radio" class="btn-check" name="adType" id="typeText" value="text" checked>
                                    <label class="btn btn-outline-primary" for="typeText">&#128221; Text</label>
                                    <input type="radio" class="btn-check" name="adType" id="typeImage" value="image">
                                    <label class="btn btn-outline-primary" for="typeImage">&#128444;&#65039; Image</label>
                                    <input type="radio" class="btn-check" name="adType" id="typeVideo" value="video">
                                    <label class="btn btn-outline-primary" for="typeVideo">&#127916; Video</label>
                                </div>
                            </div>

                            <div class="mb-3" id="contentField">
                                <label class="form-label" for="adContent">Text Content</label>
                                <textarea class="form-control" id="adContent" rows="3" placeholder="The text shown on the billboard"></textarea>
                            </div>

                            <div class="mb-3 d-none" id="mediaField">
                                <label class="form-label" for="adMedia">Media File</label>
                                <input type="file" class="form-control" id="adMedia">
                                <div class="progress mt-2 d-none" id="uploadProgressWrap" style="height: 6px;">
                                    <div class="progress-bar bg-primary" id="uploadProgressBar" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="adStart">Start Time</label>
                                    <input type="time" class="form-control" id="adStart" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="adEnd">End Time</label>
                                    <input type="time" class="form-control" id="adEnd" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="adDuration">Seconds per Slide</label>
                                    <input type="number" class="form-control" id="adDuration" value="10" min="3" max="300">
                                </div>
                            </div>

                            <div class="mb-1">
                                <label class="form-label d-block">Days</label>
                                <div id="adDays">
                                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="adDay" value="Monday" id="dayMon" checked><label class="form-check-label" for="dayMon">Mon</label></div>
                                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="adDay" value="Tuesday" id="dayTue" checked><label class="form-check-label" for="dayTue">Tue</label></div>
                                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="adDay" value="Wednesday" id="dayWed" checked><label class="form-check-label" for="dayWed">Wed</label></div>
                                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="adDay" value="Thursday" id="dayThu" checked><label class="form-check-label" for="dayThu">Thu</label></div>
                                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="adDay" value="Friday" id="dayFri" checked><label class="form-check-label" for="dayFri">Fri</label></div>
                                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="adDay" value="Saturday" id="daySat" checked><label class="form-check-label" for="daySat">Sat</label></div>
                                    <div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="adDay" value="Sunday" id="daySun" checked><label class="form-check-label" for="daySun">Sun</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="createAdBtn">Create Announcement</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!-- Edit Announcement Modal -->
        <div class="modal fade" id="editAdModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="editAdForm">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Announcement</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger d-none" id="editAdAlert" role="alert"></div>
                            <input type="hidden" id="editId">

                            <div class="mb-3">
                                <label class="form-label" for="editTitle">Title</label>
                                <input type="text" class="form-control" id="editTitle" required>
                            </div>

                            <div class="mb-3" id="editContentField">
                                <label class="form-label" for="editContent">Text Content</label>
                                <textarea class="form-control" id="editContent" rows="3"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="editStart">Start Time</label>
                                    <input type="time" class="form-control" id="editStart" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="editEnd">End Time</label>
                                    <input type="time" class="form-control" id="editEnd" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="editDuration">Seconds per Slide</label>
                                    <input type="number" class="form-control" id="editDuration" min="3" max="300">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="editAdBtn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end edit modal -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Icon -->
        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            const API_BASE = location.pathname.replace(/\/public\/DASH\/.*$/, '') + '/api';

            const esc = s => String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            const fmtTime = t => {
                if (!t) return '--:--';
                const p = String(t).split(':');
                const h = parseInt(p[0], 10);
                return `${h % 12 || 12}:${p[1]} ${h >= 12 ? 'PM' : 'AM'}`;
            };

            // Require login
            fetch(`${API_BASE}/auth.php?action=check`, { credentials: 'include' })
                .then(r => r.json())
                .then(d => {
                    if (!d.success) { location.href = 'auth-login.php'; return; }
                    const name = d.user.name || d.user.email;
                    document.querySelectorAll('.user-name-text').forEach(el => el.textContent = name);
                    document.querySelectorAll('.user-sort-name').forEach(el => el.textContent = name[0].toUpperCase());
                    document.querySelectorAll('.user-name-sub-text').forEach(el => el.textContent = d.user.email);
                })
                .catch(() => {});

            function appLogout() {
                fetch(`${API_BASE}/auth.php?action=logout`, { method: 'POST', credentials: 'include' })
                    .then(() => location.href = 'auth-login.php');
            }

            let allAds = [];

            function flash(msg) {
                const f = document.getElementById('flashMsg');
                f.textContent = msg;
                f.classList.remove('d-none');
                setTimeout(() => f.classList.add('d-none'), 4000);
            }

            function loadAllAds() {
                fetch(`${API_BASE}/ads.php?all=1`, { credentials: 'include' })
                    .then(r => r.json())
                    .then(data => {
                        const tb = document.getElementById('adsTableBody');

                        if (!data.success) {
                            tb.innerHTML = `<tr><td colspan="9" class="text-center text-danger py-4">${esc(data.message || 'Failed to load')}</td></tr>`;
                            return;
                        }

                        allAds = data.ads || [];
                        if (allAds.length === 0) {
                            tb.innerHTML = '<tr><td colspan="9" class="text-center text-muted py-4">No announcements yet</td></tr>';
                            return;
                        }

                        const typeBadge = {
                            text:  '<span class="badge bg-subtle-primary text-primary font-size-12">📝 TEXT</span>',
                            image: '<span class="badge bg-subtle-success text-success font-size-12">🖼️ IMAGE</span>',
                            video: '<span class="badge bg-subtle-warning text-warning font-size-12">🎬 VIDEO</span>'
                        };

                        tb.innerHTML = allAds.map((a, i) => `
                            <tr>
                                <td class="text-muted">${i + 1}</td>
                                <td>
                                    <h6 class="font-size-15 mb-0">${esc(a.title)}</h6>
                                </td>
                                <td>
                                    <h6 class="font-size-14 mb-1">${esc(a.user_name || '')}</h6>
                                    <p class="text-muted mb-0 font-size-13">${esc(a.user_email || '')}</p>
                                </td>
                                <td>${typeBadge[a.ad_type] || a.ad_type}</td>
                                <td class="text-muted">${fmtTime(a.start_time)} — ${fmtTime(a.end_time)}</td>
                                <td class="text-muted">${a.duration || 10}s</td>
                                <td>${a.is_active == 1
                                    ? '<span class="badge badge-soft-success font-size-12">Active</span>'
                                    : '<span class="badge badge-soft-danger font-size-12">Inactive</span>'}</td>
                                <td class="text-muted font-size-13">${(a.created_at || '').split(' ')[0]}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-soft-primary btn-sm" onclick="openEdit(${a.id})">Edit</button>
                                        <button type="button" class="btn ${a.is_active == 1 ? 'btn-soft-warning' : 'btn-soft-success'} btn-sm" onclick="toggleAd(${a.id})">
                                            ${a.is_active == 1 ? 'Disable' : 'Enable'}
                                        </button>
                                        <button type="button" class="btn btn-soft-danger btn-sm" onclick="deleteAd(${a.id})">Delete</button>
                                    </div>
                                </td>
                            </tr>`).join('');
                    })
                    .catch(() => {
                        document.getElementById('adsTableBody').innerHTML =
                            '<tr><td colspan="9" class="text-center text-danger py-4">Connection error</td></tr>';
                    });
            }

            // ── Row actions ──
            function toggleAd(id) {
                fetch(`${API_BASE}/ads.php?id=${id}&action=toggle`, { method: 'PUT', credentials: 'include' })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) { flash('Announcement status updated'); loadAllAds(); }
                        else alert(data.message || 'Failed to update status');
                    })
                    .catch(() => alert('Connection error'));
            }

            function deleteAd(id) {
                const ad = allAds.find(a => a.id == id);
                if (!confirm(`Delete "${ad ? ad.title : 'this announcement'}"? This cannot be undone.`)) return;

                fetch(`${API_BASE}/ads.php?id=${id}&action=delete`, { method: 'POST', credentials: 'include' })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) { flash('Announcement deleted'); loadAllAds(); }
                        else alert(data.message || 'Failed to delete');
                    })
                    .catch(() => alert('Connection error'));
            }

            function openEdit(id) {
                const ad = allAds.find(a => a.id == id);
                if (!ad) return;

                document.getElementById('editAdAlert').classList.add('d-none');
                document.getElementById('editId').value = ad.id;
                document.getElementById('editTitle').value = ad.title || '';
                document.getElementById('editContent').value = ad.content || '';
                document.getElementById('editStart').value = (ad.start_time || '').slice(0, 5);
                document.getElementById('editEnd').value = (ad.end_time || '').slice(0, 5);
                document.getElementById('editDuration').value = ad.duration || 10;
                document.getElementById('editContentField').classList.toggle('d-none', ad.ad_type !== 'text');

                new bootstrap.Modal(document.getElementById('editAdModal')).show();
            }

            document.getElementById('editAdForm').addEventListener('submit', async e => {
                e.preventDefault();
                const editAlert = document.getElementById('editAdAlert');
                editAlert.classList.add('d-none');

                const btn = document.getElementById('editAdBtn');
                btn.disabled = true;
                btn.textContent = 'Saving…';

                try {
                    const id = document.getElementById('editId').value;
                    const res = await fetch(`${API_BASE}/ads.php?id=${id}`, {
                        method: 'PUT', credentials: 'include',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            title: document.getElementById('editTitle').value,
                            content: document.getElementById('editContent').value,
                            start_time: document.getElementById('editStart').value,
                            end_time: document.getElementById('editEnd').value,
                            duration: parseInt(document.getElementById('editDuration').value) || 10
                        })
                    });
                    const data = await res.json();

                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('editAdModal')).hide();
                        flash('Announcement updated successfully');
                        loadAllAds();
                    } else {
                        editAlert.textContent = data.message || 'Failed to save changes';
                        editAlert.classList.remove('d-none');
                    }
                } catch {
                    editAlert.textContent = 'Connection error. Please try again.';
                    editAlert.classList.remove('d-none');
                } finally {
                    btn.disabled = false;
                    btn.textContent = 'Save Changes';
                }
            });

            loadAllAds();

            // Auto-open the modal when arriving via "Create Announcement" menu link
            if (new URLSearchParams(location.search).get('create') === '1') {
                new bootstrap.Modal(document.getElementById('createAdModal')).show();
            }

            // ── Create Announcement modal ──
            const adAlert = document.getElementById('createAdAlert');
            const showAdError = msg => { adAlert.textContent = msg; adAlert.classList.remove('d-none'); };

            document.querySelectorAll('input[name="adType"]').forEach(radio => {
                radio.addEventListener('change', () => {
                    const isText = radio.value === 'text';
                    document.getElementById('contentField').classList.toggle('d-none', !isText);
                    document.getElementById('mediaField').classList.toggle('d-none', isText);
                });
            });

            function uploadMedia(file) {
                return new Promise((resolve, reject) => {
                    const fd = new FormData();
                    fd.append('file', file);

                    const wrap = document.getElementById('uploadProgressWrap');
                    const bar = document.getElementById('uploadProgressBar');
                    wrap.classList.remove('d-none');
                    bar.style.width = '0%';

                    const xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', e => {
                        if (e.lengthComputable) bar.style.width = Math.round(e.loaded / e.total * 100) + '%';
                    });
                    xhr.addEventListener('load', () => {
                        wrap.classList.add('d-none');
                        try {
                            const data = JSON.parse(xhr.responseText);
                            data.success ? resolve(data.file_path) : reject(new Error(data.message || 'Upload failed'));
                        } catch { reject(new Error('Upload failed')); }
                    });
                    xhr.addEventListener('error', () => { wrap.classList.add('d-none'); reject(new Error('Upload failed')); });
                    xhr.open('POST', `${API_BASE}/upload.php`);
                    xhr.withCredentials = true;
                    xhr.send(fd);
                });
            }

            document.getElementById('createAdForm').addEventListener('submit', async e => {
                e.preventDefault();
                adAlert.classList.add('d-none');

                const type = document.querySelector('input[name="adType"]:checked').value;
                const days = Array.from(document.querySelectorAll('input[name="adDay"]:checked')).map(el => el.value);
                const content = document.getElementById('adContent').value.trim();
                const file = document.getElementById('adMedia').files[0];

                if (type === 'text' && !content) return showAdError('Please enter the text content');
                if (type !== 'text' && !file)    return showAdError(`Please choose a ${type} file to upload`);
                if (!days.length)                return showAdError('Please select at least one day');

                const btn = document.getElementById('createAdBtn');
                btn.disabled = true;
                btn.textContent = 'Creating…';

                try {
                    let media_path = null;
                    if (type !== 'text') {
                        btn.textContent = 'Uploading…';
                        media_path = await uploadMedia(file);
                        btn.textContent = 'Creating…';
                    }

                    const res = await fetch(`${API_BASE}/ads.php`, {
                        method: 'POST', credentials: 'include',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            title: document.getElementById('adTitle').value,
                            ad_type: type,
                            content: type === 'text' ? content : '',
                            media_path,
                            start_time: document.getElementById('adStart').value,
                            end_time: document.getElementById('adEnd').value,
                            duration: parseInt(document.getElementById('adDuration').value) || 10,
                            days
                        })
                    });
                    const data = await res.json();

                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('createAdModal')).hide();
                        document.getElementById('createAdForm').reset();
                        document.getElementById('contentField').classList.remove('d-none');
                        document.getElementById('mediaField').classList.add('d-none');

                        const flash = document.getElementById('flashMsg');
                        flash.textContent = 'Announcement created successfully!';
                        flash.classList.remove('d-none');
                        setTimeout(() => flash.classList.add('d-none'), 4000);

                        loadAllAds();
                    } else {
                        showAdError(data.message || 'Failed to create announcement');
                    }
                } catch (err) {
                    showAdError(err.message || 'Connection error. Please try again.');
                } finally {
                    btn.disabled = false;
                    btn.textContent = 'Create Announcement';
                }
            });
        </script>

    </body>

</html>
