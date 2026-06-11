<!doctype html>
<html lang="en">

    
<head>
        
        <meta charset="utf-8" />
        <title>Dashboard | Billboard Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Billboard Advertisement Management System" name="description" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- plugin css -->

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
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                          <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.php" class="logo logo-dark">
                                <span class="logo-sm" style="font-size:20px;">&#128226;</span>
                                <span class="logo-lg" style="font-size:15px;font-weight:700;letter-spacing:0.3px;">&#128226; Billboard Manager</span>
                            </a>

                            <a href="index.php" class="logo logo-light">
                                <span class="logo-sm" style="font-size:20px;">&#128226;</span>
                                <span class="logo-lg" style="font-size:15px;font-weight:700;letter-spacing:0.3px;">&#128226; Billboard Manager</span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn" id="vertical-menu-btn">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>
            
                      <!-- start page title -->
                      <div class="page-title-box align-self-center d-none d-md-block">
                        <h4 class="page-title mb-0">Dashboard</h4>
                      </div>
                      <!-- end page title -->
                    </div>

                    <div class="d-flex">

                         <!-- App Search-->
                         <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="ri-search-line"></span>
                            </div>
                        </form>

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-search-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                    
                                <form class="p-3">
                                    <div class="mb-3 m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item waves-effect"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="" src="assets/images/flags/us.jpg" alt="Header Language" height="16">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                    
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-apps-2-line"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <div class="px-lg-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/github.png" alt="Github">
                                                <span>GitHub</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                                <span>Bitbucket</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                                <span>Mail Chimp</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/slack.png" alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="ri-fullscreen-line"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-notification-3-line"></i>
                                <span class="noti-dot"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="#" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-3.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-4.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top">
                                    <div class="d-grid">
                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="ri-settings-2-line"></i>
                            </button>
                        </div>
            
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                 <!-- LOGO -->
                 <div class="navbar-brand-box">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm" style="font-size:20px;">&#128226;</span>
                        <span class="logo-lg" style="font-size:15px;font-weight:700;letter-spacing:0.3px;">&#128226; Billboard Manager</span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm" style="font-size:20px;">&#128226;</span>
                        <span class="logo-lg" style="font-size:15px;font-weight:700;letter-spacing:0.3px;">&#128226; Billboard Manager</span>
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
                                    <i class="uim uim-airplay"></i><span class="badge rounded-pill bg-success float-end" id="menuActiveBadge"></span>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="uim uim-comment-message"></i>
                                    <span>Announcements</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="announcements.php">All Announcements</a></li>
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
                    <button type="button" class="btn w-100 px-0 border-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs rounded-circle flex-shrink-0">
                                    <div class="avatar-title border bg-light text-primary rounded-circle text-uppercase user-sort-name">?</div>
                                </div>
                            </div>

                            <div class="flex-grow-1 ms-2 text-start">
                                <span class="ms-1 fw-medium user-name-text">&hellip;</span>
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
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                    <i class="uim uim-briefcase"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden ms-4">
                                                <p class="text-muted text-truncate font-size-15 mb-2"> Total Users</p>
                                                <h3 class="fs-4 flex-grow-1 mb-3" id="statUsers">&mdash;</h3>
                                                <p class="text-muted mb-0 text-truncate">registered accounts</p>
                                            </div>
                                            <div class="flex-shrink-0 align-self-start">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-fill text-muted font-size-16"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                        <a class="dropdown-item" href="#">Today</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                    <i class="uim uim-layer-group"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden ms-4">
                                                <p class="text-muted text-truncate font-size-15 mb-2"> Announcements</p>
                                                <h3 class="fs-4 flex-grow-1 mb-3" id="statAds">&mdash;</h3>
                                                <p class="text-muted mb-0 text-truncate"><span class="badge bg-subtle-success text-success font-size-12 fw-normal me-1" id="statAdsActive">&mdash;</span> currently active</p>
                                            </div>
                                            <div class="flex-shrink-0 align-self-start">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-fill text-muted font-size-16"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                        <a class="dropdown-item" href="#">Today</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                    <i class="uim uim-scenery"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden ms-4">
                                                <p class="text-muted text-truncate font-size-15 mb-2"> Connected Billboards</p>
                                                <h3 class="fs-4 flex-grow-1 mb-3" id="statDisplays">&mdash;</h3>
                                                <p class="text-muted mb-0 text-truncate">screens online now</p>
                                            </div>
                                            <div class="flex-shrink-0 align-self-start">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-fill text-muted font-size-16"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                        <a class="dropdown-item" href="#">Today</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-md flex-shrink-0">
                                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                                    <i class="uim uim-airplay"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden ms-4">
                                                <p class="text-muted text-truncate font-size-15 mb-2"> Active Air Time</p>
                                                <h3 class="fs-4 flex-grow-1 mb-3" id="statHours">&mdash;</h3>
                                                <p class="text-muted mb-0 text-truncate">scheduled hours across active ads</p>
                                            </div>
                                            <div class="flex-shrink-0 align-self-start">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-fill text-muted font-size-16"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Yearly</a>
                                                        <a class="dropdown-item" href="#">Monthly</a>
                                                        <a class="dropdown-item" href="#">Weekly</a>
                                                        <a class="dropdown-item" href="#">Today</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END ROW -->

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex pb-0">
                                        <h4 class="card-title mb-0 flex-grow-1">Advertisement Schedule Coverage</h4>
                                        <div>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                ALL
                                            </button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                1M
                                            </button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                6M
                                            </button>
                                            <button type="button" class="btn btn-soft-primary btn-sm">
                                                1Y
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-xl-8 audiences-border">
                                                <div id="column-chart" class="apex-charts"></div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div id="donut-chart" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex pb-1">
                                        <h4 class="card-title mb-0 flex-grow-1">Top Users</h4>
                                        <div>
                                            <a href="announcements.php" class="btn btn-soft-primary btn-sm">View Ads</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive" data-simplebar style="max-height: 346px;">
                                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                <tbody id="topUsersBody">
                                                    <tr><td class="text-center text-muted py-4">Loading...</td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END ROW -->


                        <div class="row">
                           <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex pb-0">
                                        <h4 class="card-title mb-0 flex-grow-1">Latest Announcements</h4>
                                        <div>
                                            <a href="announcements.php" class="btn btn-soft-primary btn-sm">View All</a>
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
                                                <tbody id="latestAdsBody">
                                                    <tr><td colspan="8" class="text-center text-muted py-4">Loading...</td></tr>
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

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.html">
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="layout-3">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css">
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

            
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Icon -->
        <script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Vector map-->


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

            // Require login + personalize sidebar user blocks
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

            const typeBadge = {
                text:  '<span class="badge bg-subtle-primary text-primary font-size-12">TEXT</span>',
                image: '<span class="badge bg-subtle-success text-success font-size-12">IMAGE</span>',
                video: '<span class="badge bg-subtle-warning text-warning font-size-12">VIDEO</span>'
            };
            const statusBadge = a => a.is_active == 1
                ? '<span class="badge badge-soft-success font-size-12">Active</span>'
                : '<span class="badge badge-soft-danger font-size-12">Inactive</span>';

            fetch(`${API_BASE}/stats.php`, { credentials: 'include' })
                .then(r => r.json())
                .then(s => {
                    if (!s.success) return;

                    document.getElementById('statUsers').textContent = s.users;
                    document.getElementById('statAds').textContent = s.ads_total;
                    document.getElementById('statAdsActive').textContent = s.ads_active;
                    document.getElementById('statDisplays').textContent = s.displays;
                    document.getElementById('statHours').textContent = s.active_hours + ' hrs';
                    document.getElementById('menuActiveBadge').textContent = s.ads_active;

                    // Top users
                    const tu = document.getElementById('topUsersBody');
                    tu.innerHTML = (s.top_users || []).map(u => `
                        <tr>
                            <td style="width:20px;">
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-subtle-primary text-primary rounded-circle font-size-16">${esc((u.name || '?')[0].toUpperCase())}</span>
                                </div>
                            </td>
                            <td>
                                <h6 class="font-size-15 mb-1">${esc(u.name)}</h6>
                                <p class="text-muted mb-0 font-size-14">${esc(u.email)}</p>
                            </td>
                            <td class="text-muted text-end">${u.ads_count} ads</td>
                        </tr>`).join('') || '<tr><td class="text-center text-muted py-4">No users yet</td></tr>';

                    // Latest announcements
                    const la = document.getElementById('latestAdsBody');
                    la.innerHTML = (s.recent_ads || []).map((a, i) => `
                        <tr>
                            <td class="text-muted">${i + 1}</td>
                            <td><h6 class="font-size-15 mb-0">${esc(a.title)}</h6></td>
                            <td>
                                <h6 class="font-size-14 mb-1">${esc(a.user_name || '')}</h6>
                                <p class="text-muted mb-0 font-size-13">${esc(a.user_email || '')}</p>
                            </td>
                            <td>${typeBadge[a.ad_type] || a.ad_type}</td>
                            <td class="text-muted">${fmtTime(a.start_time)} &mdash; ${fmtTime(a.end_time)}</td>
                            <td class="text-muted">${a.duration || 10}s</td>
                            <td>${statusBadge(a)}</td>
                            <td class="text-muted font-size-13">${(a.created_at || '').split(' ')[0]}</td>
                        </tr>`).join('') || '<tr><td colspan="8" class="text-center text-muted py-4">No announcements yet</td></tr>';

                    // Column chart: active ads per hour of day
                    new ApexCharts(document.querySelector('#column-chart'), {
                        chart: { type: 'bar', height: 350, toolbar: { show: false } },
                        series: [{ name: 'Active ads on air', data: s.ads_by_hour }],
                        xaxis: { categories: Array.from({length: 24}, (_, h) => h + 'h'), tickAmount: 12 },
                        yaxis: { labels: { formatter: v => Math.round(v) } },
                        colors: ['#7269ef'],
                        plotOptions: { bar: { columnWidth: '55%', borderRadius: 3 } },
                        dataLabels: { enabled: false },
                        grid: { borderColor: '#f1f1f1' }
                    }).render();

                    // Donut: ads by type
                    new ApexCharts(document.querySelector('#donut-chart'), {
                        chart: { type: 'donut', height: 280 },
                        series: [s.ads_by_type.text || 0, s.ads_by_type.image || 0, s.ads_by_type.video || 0],
                        labels: ['Text', 'Image', 'Video'],
                        colors: ['#7269ef', '#46c79e', '#f7b84b'],
                        legend: { position: 'bottom' },
                        dataLabels: { enabled: false }
                    }).render();
                })
                .catch(err => console.error('stats error:', err));
        </script>
    </body>


</html>