<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - SIPAGI</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('niceadmin') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('niceadmin') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('niceadmin') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('niceadmin') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('niceadmin') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('niceadmin') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('niceadmin') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{ asset('niceadmin') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('niceadmin') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('niceadmin') }}/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="logo d-flex align-items-center">
                <img src="{{ asset('niceadmin') }}/assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">SIPAGI</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('niceadmin') }}/assets/img/profile-img.jpg" alt="Profile"
                            class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ ucfirst(Auth::user()->name) }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ ucfirst(Auth::user()->name) }}</h6>
                            <span>{{ ucfirst(Auth::user()->role->name) }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <button type="submit"
                                        class="dropdown-item d-flex align-items-center border-0 bg-transparent p-0 w-100"
                                        style="outline: none; box-shadow: none;">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Sign Out
                                    </button>
                                </a>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard*') ? '' : 'collapsed' }}" href="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            @if (Gate::allows('create-jadwal') || Gate::allows('delete-jadwal') || Gate::allows('update-jadwal'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('jadwal*') ? '' : 'collapsed' }}" href="/jadwal">
                        <i class="bi bi-journal-text"></i>
                        <span>Jadwal</span>
                    </a>
                </li><!-- End Jadwal Nav -->
            @endif

            @if (Gate::allows('create-gudang') || Gate::allows('delete-gudang') || Gate::allows('update-gudang'))
                <li>
                    <a class="nav-link {{ request()->is('gudang*') ? '' : 'collapsed' }}" href="/gudang">
                        <i class="bi bi-layout-text-window-reverse"></i>
                        <span>Gudang</span>
                    </a>
                </li><!-- End Gudang Nav -->
            @endif

            @if (Gate::allows('CRUD-stok'))
                <li>
                    <a class="nav-link {{ request()->is('stok-gabah*') ? '' : 'collapsed' }}" href="/stok-gabah">
                        <i class="ri-stack-line"></i>
                        <span>Stok</span>
                    </a>
                </li><!-- End Stok Nav -->
            @endif

            @if (Gate::allows('CRUD-role'))
                <li>
                    <a class="nav-link {{ request()->is('role-manage*') ? '' : 'collapsed' }}" href="/role-manage">
                        <i class="bx bxs-user-badge"></i>
                        <span>Role Manager</span>
                    </a>
                </li><!-- End Role Manager Nav -->
            @endif

            <li class="nav-item">
                <a class="nav-link {{ request()->is('faq*') ? '' : 'collapsed' }}" href="/faq">
                    <i class="bi bi-question-circle"></i>
                    <span>F.A.Q</span>
                </a>
            </li><!-- End F.A.Q Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('niceadmin') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('niceadmin') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('niceadmin') }}/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="{{ asset('niceadmin') }}/assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{ asset('niceadmin') }}/assets/vendor/quill/quill.js"></script>
    <script src="{{ asset('niceadmin') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{ asset('niceadmin') }}/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('niceadmin') }}/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('niceadmin') }}/assets/js/main.js"></script>

</body>

</html>
