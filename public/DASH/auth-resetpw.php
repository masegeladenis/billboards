<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Set New Password | Billboard Manager</title>
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

<body>

    <div class="auth-maintenance d-flex align-items-center min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">
                                <div class="text-center mb-4">
                                    <a href="index.php" class="text-decoration-none">
                                        <h3 class="fw-bold text-dark mb-0">📢 Billboard Manager</h3>
                                    </a>
                                    <p class="text-muted mt-2">Billboard Advertisement Management System</p>
                                </div>

                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div class="bg-overlay bg-primary"></div>
                                            <div class="h-100 bg-auth align-items-end">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18">Set New Password</h4>
                                                        <p class="text-muted">Choose a new password for your account.</p>
                                                    </div>

                                                    <div class="alert alert-danger d-none mt-4" id="resetAlert" role="alert"></div>

                                                    <form id="resetForm" class="auth-input">
                                                        <div class="mb-2">
                                                            <label class="form-label" for="new-password">New Password</label>
                                                            <input type="password" class="form-control" id="new-password" placeholder="Enter new password" required minlength="6">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="confirm-password">Confirm Password</label>
                                                            <input type="password" class="form-control" id="confirm-password" placeholder="Re-enter new password" required minlength="6">
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary w-100" type="submit" id="resetBtn">Update Password</button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <p class="mb-0">Back to <a href="auth-login.php" class="fw-medium text-primary"> Log in </a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->

                                <div class="mt-5 text-center">
                                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Billboard Manager</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        const API_BASE = location.pathname.replace(/\/public\/DASH\/.*$/, '') + '/api';
        const params = new URLSearchParams(location.search);
        const email = params.get('email');
        const token = params.get('token');

        const alertBox = document.getElementById('resetAlert');
        const showError = msg => {
            alertBox.textContent = msg;
            alertBox.classList.remove('d-none', 'alert-success');
            alertBox.classList.add('alert-danger');
        };

        if (!email || !token) {
            showError('Invalid reset link. Please request a new one from the "Forgot password" page.');
            document.getElementById('resetForm').style.display = 'none';
        }

        document.getElementById('resetForm').addEventListener('submit', async e => {
            e.preventDefault();
            const pw = document.getElementById('new-password').value;
            const pw2 = document.getElementById('confirm-password').value;

            if (pw !== pw2) return showError('Passwords do not match');

            const btn = document.getElementById('resetBtn');
            btn.disabled = true;
            btn.textContent = 'Updating…';
            alertBox.classList.add('d-none');

            try {
                const res = await fetch(`${API_BASE}/password-reset.php?action=reset`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, token, password: pw })
                });
                const data = await res.json();

                if (data.success) {
                    alertBox.textContent = data.message + ' Redirecting to login…';
                    alertBox.classList.remove('d-none', 'alert-danger');
                    alertBox.classList.add('alert-success');
                    document.getElementById('resetForm').style.display = 'none';
                    setTimeout(() => location.href = 'auth-login.php', 2500);
                } else {
                    showError(data.message || 'Reset failed');
                }
            } catch {
                showError('Connection error. Please try again.');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Update Password';
            }
        });
    </script>

</body>

</html>
