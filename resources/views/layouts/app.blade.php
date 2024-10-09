<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Admin') }} | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div
                class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="image">
                        <img src="https://api.dicebear.com/6.x/identicon/svg?seed=Angel" class="img-circle elevation-2"
                            alt="avatar" height="160px" width="160px" />
                    </div>

                    <div class="info">
                        <span class="d-block text-light">{{ Auth::user()->name }}</span>
                    </div>

                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <!-- Begin::Dashboard Menu-->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <!-- End::Dashboard Menu-->

                        <!-- Begin::Customer Menu-->
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Customer</p>
                            </a>
                        </li>
                        <!-- End::Customer Menu-->

                        <!-- Begin::Reward Menu-->
                        <li class="nav-item">
                            <a href="{{ route('purchase.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>Purchase</p>
                            </a>
                        </li>
                        <!-- End::Reward Menu-->

                        <!-- Begin::Redeem Menu-->
                        <li class="nav-item">
                            <a href="{{ route('redeem.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <p>Redeem</p>
                            </a>
                        </li>
                        <!-- End::Redeem Menu-->


                        <!-- Begin::Report Menu-->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fab fa-whatsapp nav-icon"></i>

                                <p>
                                    Messenger
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('messenger.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Compose</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('messenger.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Report</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!-- End::Report Menu-->


                        <!-- Begin::Profile Menu-->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profile
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('profile.edit') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Edit Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('password.edit') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Change Password</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End::Profile Menu-->

                        <!-- Begin::Master Menu-->
                        @if (Auth::user()->email == config('admin.email'))
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('setting.reward.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Reword Setup</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('wa-template.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>WA Template</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <!-- End::Master Menu-->

                        <!-- Begin::Logout Menu-->
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link logout-btn">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                        <!-- End::Logout Menu-->

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('breadcrumb')
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                {{ $slot }}
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023-2024 <a href="#">Dipankar IT Solution</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}")
        </script>
    @endif

    @if (Session::has('danger'))
        <script>
            toastr.error("{{ Session::get('danger') }}")
        </script>
    @endif

    @yield('script')

</body>

</html>
