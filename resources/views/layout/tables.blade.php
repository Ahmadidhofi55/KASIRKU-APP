<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title')</title>
    <link rel="shortcut icon" href="/images/kasir.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template -->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
       <!-- Page Wrapper -->
       <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('kasir.kasir') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="/images/kasir.png" alt="logo-dash">
                </div>
                <div class="sidebar-brand-text mx-3">KASIRKU</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('kasir.kasir') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-cash-register"></i>
                    <span>Transaksi</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-th-list"></i>
                    <span>List Transaksi</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('pembayaran.index') }}">
                    <i class="fas fa-wallet"></i>
                    <span>Pembayaran</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('produk.index') }}">
                    <i class="fas fa-archive"></i>
                    <span>Produk</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-retweet"></i>
                    <span>Produk Habis</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('jenis.index') }}">
                    <i class="fas fa-text-height"></i>
                    <span>Jenis Produk</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('merek.index') }}">
                    <i class="fas fa-window-maximize"></i>
                    <span>Merek Produk</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('member.index') }}">
                    <i class="fas fa-user-friends"></i>
                    <span>Member</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('supliyer.index') }}">
                    <i class="fas fa-warehouse"></i>
                    <span>Supliyer</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

</body>
 <!-- Bootstrap core JavaScript-->
 <script src="vendor/jquery/jquery.min.js"></script>
 <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="js/sb-admin-2.min.js"></script>

 <!-- Page level plugins -->
 <script src="vendor/datatables/jquery.dataTables.min.js"></script>
 <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="js/demo/datatables-demo.js"></script>
 <script src="js/sweetalert2@11.js"></script>

</body>

</html>
