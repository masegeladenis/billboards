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
                                <a href="announcements.php" class="waves-effect active">
                                    <i class="uim uim-comment-message"></i>
                                    <span>Announcements</span>
                                </a>
                            </li>

                            <li>
                                <a href="../dashboard.php" class="waves-effect">
                                    <i class="uim uim-box"></i>
                                    <span>Create Announcement</span>
                                </a>
                            </li>

                            <li>
                                <a href="../display.php" target="_blank" class="waves-effect">
                                    <i class="uim uim-window-grid"></i>
                                    <span>Billboard Display</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:appLogout();" class="waves-effect">
                                    <i class="uim uim-sign-in-alt"></i>
                                    <span>Logout</span>
                                </a>
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
                                    <div class="avatar-title border bg-light text-primary rounded-circle text-uppercase" id="sbUserAvatar">?</div>
                                </div>
                            </div>

                            <div class="flex-grow-1 ms-2 text-start">
                                <span class="ms-1 fw-medium user-name-text" id="sbUserName">…</span>
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
                                            <a href="../dashboard.php" class="btn btn-primary btn-sm">+ Create Announcement</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
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
                    document.getElementById('sbUserName').textContent = name;
                    document.getElementById('sbUserAvatar').textContent = name[0].toUpperCase();
                })
                .catch(() => {});

            function appLogout() {
                fetch(`${API_BASE}/auth.php?action=logout`, { method: 'POST', credentials: 'include' })
                    .then(() => location.href = 'auth-login.php');
            }

            function loadAllAds() {
                fetch(`${API_BASE}/ads.php?all=1`, { credentials: 'include' })
                    .then(r => r.json())
                    .then(data => {
                        const tb = document.getElementById('adsTableBody');

                        if (!data.success) {
                            tb.innerHTML = `<tr><td colspan="8" class="text-center text-danger py-4">${esc(data.message || 'Failed to load')}</td></tr>`;
                            return;
                        }

                        const ads = data.ads || [];
                        if (ads.length === 0) {
                            tb.innerHTML = '<tr><td colspan="8" class="text-center text-muted py-4">No announcements yet</td></tr>';
                            return;
                        }

                        const typeBadge = {
                            text:  '<span class="badge bg-subtle-primary text-primary font-size-12">📝 TEXT</span>',
                            image: '<span class="badge bg-subtle-success text-success font-size-12">🖼️ IMAGE</span>',
                            video: '<span class="badge bg-subtle-warning text-warning font-size-12">🎬 VIDEO</span>'
                        };

                        tb.innerHTML = ads.map((a, i) => `
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
                            </tr>`).join('');
                    })
                    .catch(() => {
                        document.getElementById('adsTableBody').innerHTML =
                            '<tr><td colspan="8" class="text-center text-danger py-4">Connection error</td></tr>';
                    });
            }

            loadAllAds();
        </script>

    </body>

</html>
