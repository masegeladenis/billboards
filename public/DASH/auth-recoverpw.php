<!doctype html>
<html lang="en">

    
<head>
        
        <meta charset="utf-8" />
        <title>Recover Password | Billboard Manager</title>
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
                                                                <h4 class="font-size-18">Reset Password</h4>
                                                                <p class="text-muted">Reset your Billboard Manager password.</p>
                                                            </div>

                                                            <div class="alert alert-success mt-4 pt-2" id="recoverInfo" role="alert">
                                                                Enter your Email and instructions will be sent to you!
                                                            </div>

                                                            <form id="recoverForm" class="auth-input">
                                                                <div class="mb-2">
                                                                    <label for="useremail" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" id="useremail" placeholder="Enter email" required>
                                                                </div>

                                                                <div class="mt-4">
                                                                    <button class="btn btn-primary w-100" type="submit">Reset</button>
                                                                </div>

                                                            </form>

                                                            <script>
                                                                document.getElementById('recoverForm').addEventListener('submit', e => {
                                                                    e.preventDefault();
                                                                    const info = document.getElementById('recoverInfo');
                                                                    info.classList.remove('alert-success');
                                                                    info.classList.add('alert-warning');
                                                                    info.textContent = 'Password reset by email is not available yet. Please contact your system administrator to reset your password.';
                                                                });
                                                            </script>
                                                        </div>
                                                    
                                                        <div class="mt-4 text-center">
                                                            <p class="mb-0">Remember your password ? <a href="auth-login.php" class="fw-medium text-primary"> Log in </a> </p>
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
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Icon -->
        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

        <script src="assets/js/app.js"></script>

    </body>

</html>
