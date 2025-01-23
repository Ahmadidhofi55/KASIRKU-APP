@extends('layout.tablekasir')
@section('title', 'Dashboard')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <a href="{{ route('kasir.kasir') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-tachometer-alt fa-1x"></i>
            </span>
            <span class="text font-weight-bold">DASHBOARD</span>
        </a>
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle"
                        src="{{ Auth::user()->img ? asset('images/' . Auth::user()->img) : asset('images/user-default.png') }}">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('profil') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button" class="dropdown-item" onclick="logoutConfirmation()">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Content Row -->

        <div class="row">

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    INCOME(DAY)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 " id="total_harga"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calculator fa-2x text-bg-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Transaksi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="transaksicount"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cash-register fa-2x text-bg-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pembayaran
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="pembayaran"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wallet fa-2x text-bg-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Produk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="produk"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-archive fa-2x text-bg-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

        </div>

        <div class="row">

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    PRODUK HABIS</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 " id="produkhabis"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-retweet fa-2x text-bg-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    JENIS PRODUK</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="jenisproduk"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-text-height fa-2x text-bg-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">MEREK PRODUK
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="merek"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-window-maximize fa-2x text-bg-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    MEMBER</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="member"></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-friends fa-2x text-bg-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <script src="/js/sweetalert2@11.js"></script>
    <script>
        //income(day)

        document.addEventListener("DOMContentLoaded", function() {
            // Fetch total harga via AJAX
            fetch("{{ route('getTransaksiCount') }}")
                .then(response => response.json())
                .then(data => {
                    // Update the total harga
                    document.getElementById('total_harga').textContent =
                        "Rp. " + new Intl.NumberFormat('id-ID').format(data.total_harga);
                })
                .catch(error => {
                    console.error('Error fetching total harga:', error);
                    document.getElementById('total_harga').textContent = 'Error';
                });
        });

        //fetch data total transaksi
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data using AJAX
            fetch("{{ route('getTransaksiCount') }}")
                .then(response => response.json())
                .then(data => {
                    // Update the transaksi count
                    document.getElementById('transaksicount').textContent = data.count;
                })
                .catch(error => {
                    console.error('Error fetching transaksi count:', error);
                    document.getElementById('transaksicount').textContent = 'Error';
                });
        });
        //fecth data total metode pembayaran
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data using AJAX
            fetch("{{ route('getTransaksiCount') }}")
                .then(response => response.json())
                .then(data => {
                    // Update the transaksi count
                    document.getElementById('pembayaran').textContent = data.pembayaran;
                })
                .catch(error => {
                    console.error('Error fetching pembayaran count:', error);
                    document.getElementById('pembayaran').textContent = 'Error';
                });
        });
        //fecth data total produk
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data using AJAX
            fetch("{{ route('getTransaksiCount') }}")
                .then(response => response.json())
                .then(data => {
                    // Update the transaksi count
                    document.getElementById('produk').textContent = data.produk;
                })
                .catch(error => {
                    console.error('Error fetching produk count:', error);
                    document.getElementById('produk').textContent = 'Error';
                });
        });


        //fecth data produk habis
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data using AJAX
            fetch("{{ route('getTransaksiCount') }}")
                .then(response => response.json())
                .then(data => {
                    // Update the transaksi count
                    document.getElementById('produkhabis').textContent = data.produkhabis;
                })
                .catch(error => {
                    console.error('Error fetching transaksi count:', error);
                    document.getElementById('produkhabis').textContent = 'Error';
                });
        });
        //fecth data jenis produk
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data using AJAX
            fetch("{{ route('getTransaksiCount') }}")
                .then(response => response.json())
                .then(data => {
                    // Update the transaksi count
                    document.getElementById('jenisproduk').textContent = data.jenisproduk;
                })
                .catch(error => {
                    console.error('Error fetching transaksi count:', error);
                    document.getElementById('jenisproduk').textContent = 'Error';
                });
        });
        //fetch data merek produk
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data using AJAX
            fetch("{{ route('getTransaksiCount') }}")
                .then(response => response.json())
                .then(data => {
                    // Update the transaksi count
                    document.getElementById('merek').textContent = data.merek;
                })
                .catch(error => {
                    console.error('Error fetching merek count:', error);
                    document.getElementById('merek').textContent = 'Error';
                });
        });
        //fetch data member
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch data using AJAX
            fetch("{{ route('getTransaksiCount') }}")
                .then(response => response.json())
                .then(data => {
                    // Update the transaksi count
                    document.getElementById('member').textContent = data.member;
                })
                .catch(error => {
                    console.error('Error fetching merek count:', error);
                    document.getElementById('member').textContent = 'Error';
                });
        });
        //logout
        function logoutConfirmation() {
            event.preventDefault(); // Mencegah tindakan default
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Anda Akan Logout',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form logout
                    document.getElementById('logout-form').submit();

                    // Menampilkan pesan sukses
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Logout berhasil!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil Login!',
                text: '{{ session('success') }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
