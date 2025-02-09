@extends('layout.tables')
@extends('jenis.create')
@extends('jenis.show')
@extends('jenis.edit')
@section('title', 'Kasirku | Jenis Produk')
@section('content')
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Tombol Kembali -->
        <a href="{{ route('kasir.kasir') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left  "></i>
            </span>
            <span class="text">JENIS PRODUK</span>
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
                                <th>Image</th>
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
                ajax: "{{ route('jenis.read') }}",
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
                    data: 'img',
                    name: 'img',
                    render: function(data, type, full, meta) {
                        return '<img src="/images/' + data +
                            '" alt="Image" widht="100px" height="100px">';
                    }
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
            let img = $('#img')[0].files[0]; // Ambil file dari input image
            let token = $('meta[name="csrf-token"]').attr('content');

            // Buat objek FormData
            let formData = new FormData();
            formData.append('name', name);
            formData.append('img', img);
            formData.append('_token', token);

            // AJAX
            $.ajax({
                url: '{{ route('jenis.store') }}',
                type: 'POST',
                cache: false,
                processData: false, // Tidak memproses data secara otomatis
                contentType: false, // Mengatur tipe konten menjadi false agar browser dapat mengenali tipe konten secara otomatis
                data: formData, // Menggunakan objek FormData sebagai data yang dikirimkan
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    var dataTable = $('#dataTable').DataTable();
                    dataTable.ajax.reload(null, false);
                    $('#create-form')[0].reset();
                    // Clear form
                    $('#name').val('');
                    $('#img').val('');


                    // Close modal
                    $('#modal-create').modal('hide');

                    // Mengambil data terbaru setelah memasukkan data baru
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
                    // Menampilkan loading indikator saat penghapusan berlangsung
                    Swal.fire({
                        title: 'Menghapus...',
                        text: 'Mohon tunggu, data sedang dihapus.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: '/jenis/delete/' + id,
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

                                // Cek jika DataTable sudah ada sebelum melakukan reload
                                var dataTable = $('#dataTable').DataTable();
                                if ($.fn.DataTable.isDataTable('#dataTable')) {
                                    dataTable.ajax.reload(null, false);
                                }
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
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
                url: `/jenis/show/${user_id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    // Fill data to form
                    $('#user_id').val(response.id);
                    $('#name-edit').val(response.name);
                    $('#img-edit').attr('src', '/images/' + response.img);

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
            let img = $('#img-edit2').val();
            let token = $("meta[name='csrf-token']").attr("content");

            // Ajax
            $.ajax({
                url: `/jenis/update/${user_id}`,
                type: "PUT",
                cache: false,
                data: {
                    "name": name,
                    "img": img,
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
                        url: `/jenis/show/${user_id}`,
                        type: "GET",
                        cache: false,
                        success: function(response) {
                            // Update the displayed data
                            $('#name-display').text(response.name);
                            $('#img-display').text(response.img);
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
                    if (error.responseJSON.img[0]) {
                        // Show alert
                        $('#alert-img-edit').removeClass('d-none');
                        $('#alert-img-edit').addClass('d-block');

                        // Add message to alert
                        $('#alert-img-edit').html(error.responseJSON.img[0]);
                    }
                }
            });
        });

        //edit kelas
        //button create post event


        $(document).ready(function() {
            // ...
            $('body').on('click', '#btn-edit-post2', function() {
                let pembayaran_id = $(this).data('id');

                // Fetch detail post with ajax
                $.ajax({
                    url: `/jenis/show/${pembayaran_id}`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        // Fill data to form
                        $('#jenis_id2').val(response.id);
                        $('#name-edit2').val(response.name);
                        $('#img-edit2').val(''); // Reset file input
                        $('#img-preview').attr('src', '/images/' + response.img);
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
                let pembayaran_id = $('#jenis_id2').val();
                let name = $('#name-edit2').val();
                let img = $('#img-edit2')[0].files[0];
                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append("name", name);
                formData.append("img-edit2", img); // Append the image file
                formData.append("_token", token);
                // Ajax
                $.ajax({
                    url: `/jenis/update/${pembayaran_id}`,
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
@endsection
