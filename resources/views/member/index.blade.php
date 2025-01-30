@extends('layout.tables')
@extends('member.create')
@extends('member.show')
@extends('member.edit')
@section('title', 'Kasirku | Member')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Tombol Kembali -->
        <a href="{{ route('kasir.kasir') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left "></i>
            </span>
            <span class="text">Member</span>
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

    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="javascript:void(0)" class="btn btn-primary mb-2" id="btn-create-post">TAMBAH</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered yajra-datatable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>No. Hp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/sweetalert2@11.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('member.read') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    render: function(data, type, row, meta) {
                        return meta.row + 1 + '.';
                    }
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'no_hp',
                    name: 'no_hp'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                }, ]
            });

        });

        $(document).ready(function() {
            table = $('#dataTable').DataTable();
        });

        $('body').on('click', '#btn-create-post', function() {
            // Open modal
            $('#modal-create').modal('show');
        });

        // Button create post event
        $(document).on('click', '#store', function(e) {
            e.preventDefault();

            // Define variables
            let name = $('#name').val();
            let no_hp = $('#no_hp').val();
            let token = $('meta[name="csrf-token"]').attr('content');

            // Buat objek FormData
            let formData = new FormData();
            formData.append('name', name);
            formData.append('no_hp', no_hp);
            formData.append('_token', token);

            // AJAX
            $.ajax({
                url: '{{ route('member.store') }}',
                type: 'POST',
                cache: false,
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });

                    // Reload DataTable
                    var dataTable = $('#dataTable').DataTable();
                    dataTable.ajax.reload(null, false);

                    // Clear form
                    $('#create-form')[0].reset();

                    // Close modal
                    $('#modal-create').modal('hide');
                },
                error: function(error) {
                        if (error.responseJSON && error.responseJSON.errors) {
                            let errorMessages = '';

                            // Loop melalui semua error dan tambahkan ke pesan
                            $.each(error.responseJSON.errors, function(key, messages) {
                                errorMessages += messages[0] + '<br>';
                            });

                            // Tampilkan SweetAlert dengan pesan error
                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal!',
                                html: errorMessages,
                            });
                        } else {
                            // Tangani error umum
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                text: 'Tidak dapat memproses permintaan.',
                            });
                        }
                    }
            });
        });


        function deleteData(id) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan loading saat proses penghapusan berlangsung
            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu, data sedang dihapus.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: '/member/delete/' + id,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === "success") {
                        Swal.fire({
                            title: 'Sukses!',
                            text: response.message,
                            icon: 'success',
                            timer: 2000
                        });

                        // Reload DataTable jika ada
                        var dataTable = $('#dataTable').DataTable();
                        if ($.fn.DataTable.isDataTable('#dataTable')) {
                            dataTable.ajax.reload(null, false);
                        }
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: response.message,
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = "Terjadi kesalahan saat menghapus data.";

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error'
                    });
                }
            });
        }
    });
}


        $('body').on('click', '#btn-edit-post', function() {
            let user_id = $(this).data('id');

            // Fetch detail post with ajax
            $.ajax({
                url: `/member/show/${user_id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    // Fill data to form
                    $('#user_id').val(response.id);
                    $('#name-edit').val(response.name);
                    $('#no_hp-edit').val(response.no_hp);

                    // Open modal
                    $('#modal-edit').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle error case
                    console.log("Terjadi kesalahan dalam permintaan Ajax:", textStatus, errorThrown);
                }
            });
        });

        // Action update post
        $('#update').click(function(e) {
            e.preventDefault();

            // Define variables
            let user_id = $('#user_id2').val();
            let name = $('#name-edit2').val();
            let no_hp = $('#no_hp-edit2').val();
            let token = $("meta[name='csrf-token']").attr("content");

            // Ajax
            $.ajax({
                url: `/member/update/${user_id}`,
                type: "PUT",
                cache: false,
                data: {
                    "name": name,
                    "no_hp": no_hp,
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
                    $('#modal-edit').modal('hide');

                    // Fetch updated data and update the displayed data
                    $.ajax({
                        url: `/member/show/${user_id}`,
                        type: "GET",
                        cache: false,
                        success: function(response) {
                            // Update the displayed data
                            $('#name-display').text(response.name);
                            $('#no_hp-display').text(response.no_hp);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Handle error case
                            console.log("Terjadi kesalahan dalam permintaan Ajax:",
                                textStatus, errorThrown);
                        }
                    });
                },
                error: function(error) {
                    if (error.responseJSON.name[0]) {
                        // Show alert
                        $('#alert-name-edit').removeClass('d-none');
                        $('#alert-name-edit').addClass('d-block');

                        // Add message to alert
                        $('#alert-name-edit').html(error.responseJSON.name[0]);
                    }
                    if (error.responseJSON.no_hp) {
                        // Show alert
                        $('#alert-no_hp-edit2').removeClass('d-none');
                        $('#alert-no_hp-edit2').addClass('d-block');

                        // Add message to alert
                        $('#alert-no_hp-edit2').html(error.responseJSON.no_hp[0]);
                    }
                }
            });
        });

        //edit kelas
        //button create post event


        $(document).ready(function() {
            // ...
            $('body').on('click', '#btn-edit-post2', function() {
                let member_id = $(this).data('id');

                // Fetch detail post with ajax
                $.ajax({
                    url: `/member/show/${member_id}`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        // Fill data to form
                        $('#member_id2').val(response.id);
                        $('#name-edit2').val(response.name);
                        $('#no_hp-edit2').val(response.no_hp);
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
                let member_id = $('#member_id2').val();
                let name = $('#name-edit2').val();
                let no_hp = $('#no_hp-edit2').val();
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append("name", name);
                formData.append("no_hp-edit2", no_hp); // Append the image file
                formData.append("_token", token);
                // Ajax
                $.ajax({
                    url: `/member/update/${member_id}`,
                    type: "POST",
                    cache: false,
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Don't set content type
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
                        if (error.responseJSON && error.responseJSON.errors) {
                            let errorMessages = '';

                            // Loop melalui semua error dan tambahkan ke pesan
                            $.each(error.responseJSON.errors, function(key, messages) {
                                errorMessages += messages[0] + '<br>';
                            });

                            // Tampilkan SweetAlert dengan pesan error
                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal!',
                                html: errorMessages,
                            });
                        } else {
                            // Tangani error umum
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                text: 'Tidak dapat memproses permintaan.',
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
