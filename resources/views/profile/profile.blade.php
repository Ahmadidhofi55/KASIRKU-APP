@extends('layout.tables')
@extends('users.edit')
@section('title', 'Profile')
@section('content')
    <script src="js/sweetalert2@11.js"></script>
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

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> <a class="nav-link" href=""><i
                            class="fas fa-arrow-circle-left"></i> Profile </a></h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" readonly class="form-control" id="name" name="name"
                        value="{{ Auth::user()->username }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" readonly class="form-control" id="email" name="email"
                        value="{{ Auth::user()->email }}">
                </div>
                <div class="form-group">
                    <label for="img">Image</label>
                    <br>
                    <img class="img-profile rounded-circle"
                        src="{{ Auth::user()->img ? asset('images/' . Auth::user()->img) : asset('images/user-default.png') }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" readonly class="form-control" id="password" name="password"
                        value="{{ Auth::user()->password }}">
                </div>
                @if(Auth::check() && Auth::user()->level !== 'kasir')
                <a href="javascript:void(0)" data-id="{{ Auth::user()->id }}" id="btn-edit-post2"
                    class="edit btn btn-primary btn-sm nav-link bg-black text-center">
                    <i class="fas fa-user-edit"></i>
                </a>
            @endif
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        function logoutConfirmation() {
            event.preventDefault();
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
                    document.getElementById('logout-form').submit();
                }
            });
        }

        $(document).ready(function() {
            // ...
            $('body').on('click', '#btn-edit-post2', function() {
                let user_id = $(this).data('id');

                // Fetch detail post with ajax
                $.ajax({
                    url: `/user/show/${user_id}`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        // Fill data to form
                        $('#user_id2').val(response.id);
                        $('#name-edit2').val(response.name);
                        $('#email-edit2').val(response.email);
                        $('#img-edit').attr('src', '/images/' + response.img);
                        var password = response.password;
                        var maskedPassword = "****" + password.substring(4);
                        $('#password-edit2').val(maskedPassword);

                        // Open modal
                        $('#modal-edit2').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle error case
                        console.log("Terjadi kesalahan dalam permintaan Ajax:", textStatus,
                            errorThrown);
                    }
                });
            });

            // Action update post
            $('#update2').click(function(e) {
                e.preventDefault();

                // Define variables
                let user_id = $('#user_id2').val();
                let name = $('#name-edit2').val();
                let email = $('#email-edit2').val();
                let img = $('#img-edit2').val();
                let password = $('#password-edit2').val();
                let token = $("meta[name='csrf-token']").attr("content");

                // Ajax
                $.ajax({
                    url: `/user/update/${user_id}`,
                    type: "PUT",
                    cache: false,
                    data: {
                        "name": name,
                        'email': email,
                        'img': img,
                        'password': password,
                        "_token": token,
                    },
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        // Close modal
                        $('#modal-edit2').modal('hide');

                        var dataTable = $('#dataTable').DataTable();
                        dataTable.ajax.reload(null, false);
                        // Mengambil data terbaru setelah edit
                    },
                    error: function(error) {
                        if (error.responseJSON.name[0]) {
                            // Show alert
                            $('#alert-name-edit2').removeClass('d-none');
                            $('#alert-name-edit2').addClass('d-block');

                            // Add message to alert
                            $('#alert-name-edit2').html(error.responseJSON.name[0]);
                        }
                        if (error.responseJSON.email[0]) {
                            // Show alert
                            $('#alert-email-edit2').removeClass('d-none');
                            $('#alert-email-edit2').addClass('d-block');

                            // Add message to alert
                            $('#alert-email-edit2').html(error.responseJSON.email[0]);
                        }
                        if (error.responseJSON.img[0]) {
                            // Show alert
                            $('#alert-img-edit2').removeClass('d-none');
                            $('#alert-img-edit2').addClass('d-block');

                            // Add message to alert
                            $('#alert-img-edit2').html(error.responseJSON.img[0]);
                        }
                        if (error.responseJSON.password[0]) {
                            // Show alert
                            $('#alert-password-edit2').addClass('d-block');

                            // Add message to alert
                            $('#alert-password-edit2').html(error.responseJSON.password[0]);
                        }
                    }
                });
            });
        });
    </script>
@endsection
