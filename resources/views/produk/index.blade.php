@extends('layout.tables')
@extends('produk.create')
@extends('produk.show')
@extends('produk.edit')
@section('title', 'Kasirku | Produk')
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
            <span class="text">PRODUK</span>
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
                                <th>QR Produk</th>
                                <th>QR Image</th>
                                <th>Image</th>
                                <th>Merek</th>
                                <th>Jenis</th>
                                <th>Supliyer</th>
                                <th>Stok</th>
                                <th>Harga Jual</th>
                                <th>Harga Beli</th>
                                <th>Diskon</th>
                                <th>Tgl exp.</th>
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
                ajax: "{{ route('produk.read') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'qr_produk',
                        name: 'qr_produk'
                    },
                    {
                        data: 'qr_img',
                        name: 'qr_img',
                        render: function(data) {
                            return '<img src="/images/' + data +
                                '" alt="QR Image" width="100" height="100">';
                        }
                    },
                    {
                        data: 'img',
                        name: 'img',
                        render: function(data) {
                            return '<img src="/images/' + data +
                                '" alt="Image" width="100" height="100">';
                        }
                    },
                    {
                        data: 'merek',
                        name: 'merek'
                    }, // Nama merek
                    {
                        data: 'jenis',
                        name: 'jenis'
                    }, // Nama jenis
                    {
                        data: 'supliyer',
                        name: 'supliyer'
                    }, // Nama supliyer
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'harga_jual',
                        name: 'harga_jual'
                    },
                    {
                        data: 'harga_beli',
                        name: 'harga_beli'
                    },
                    {
                        data: 'diskon',
                        name: 'diskon'
                    },
                    {
                        data: 'tgl_exp',
                        name: 'tgl_exp'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });


        $(document).ready(function() {
            table = $('#dataTable').DataTable();
        });

        $('body').on('click', '#btn-create-post', function() {
            // Open modal
            $('#modal-create').modal('show');
        });

        $(document).ready(function() {
            // Load data into dropdowns
            function loadDropdown(url, dropdownId, placeholder) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        let options = `<option value="" selected disabled>${placeholder}</option>`;
                        data.forEach(function(item) {
                            options += `<option value="${item.id}">${item.name}</option>`;
                        });
                        $(dropdownId).html(options);
                    },
                    error: function(error) {
                        console.error(`Error fetching data for ${dropdownId}`, error);
                    }
                });
            }

            // Load merek, jenis, and supplier
            loadDropdown('/api/merek', '#merek_id', 'Pilih Merek');
            loadDropdown('/api/jenis', '#jenis_id', 'Pilih Jenis');
            loadDropdown('/api/supliyer', '#supliyer_id', 'Pilih Supplier');
        });

        // Button create post event
        $(document).on('click', '#store', function(e) {
            e.preventDefault();

            // Define variables
            let name = $('#name').val();
            let qr_produk = $('#qr_produk').val();
            let qr_img = $('#qr_img')[0].files[0]; // Ambil file dari input QR Image
            let img = $('#img')[0].files[0]; // Ambil file dari input image
            let merek_id = $('#merek_id').val();
            let jenis_id = $('#jenis_id').val();
            let supliyer_id = $('#supliyer_id').val();
            let stok = $('#stok').val();
            let harga_jual = $('#harga_jual').val();
            let harga_beli = $('#harga_beli').val();
            let diskon = $('#diskon').val();
            let tgl_exp = $('#tgl_exp').val();
            let token = $('meta[name="csrf-token"]').attr('content');
            // Buat objek FormData
            let formData = new FormData();
            formData.append('name', name);
            formData.append('qr_produk', qr_produk);
            formData.append('qr_img', qr_img);
            formData.append('img', img);
            formData.append('merek_id', merek_id);
            formData.append('jenis_id', jenis_id);
            formData.append('supliyer_id', supliyer_id);
            formData.append('stok', stok);
            formData.append('harga_jual', harga_jual);
            formData.append('harga_beli', harga_beli);
            formData.append('diskon', diskon);
            formData.append('tgl_exp', tgl_exp);
            formData.append('_token', token);

            // AJAX
            $.ajax({
                url: '{{ route('produk.store') }}',
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
                    $('#qr_produk').val('');
                    $('#qr_img').val('');
                    $('#img').val('');
                    $('#merek_id').val('');
                    $('#jenis_id').val('');
                    $('#supliyer_id').val('');
                    $('#stok').val('');
                    $('#harga_jual').val('');
                    $('#harga_beli').val('');
                    $('#diskon').val('');
                    $('#tgl_exp').val('');



                    // Close modal
                    $('#modal-create').modal('hide');

                    // Mengambil data terbaru setelah memasukkan data baru
                },
                error: function(error) {
                    if (error.responseJSON.name[0]) {
                        // Show alert
                        $('#alert-name').removeClass('d-none');
                        $('#alert-name').addClass('d-block');

                        // Add message to alert
                        $('#alert-name').html(error.responseJSON.name[0]);
                    }
                    if (error.responseJSON.qr_produk[0]) {
                        // Show alert
                        $('#alert-qr_produk').removeClass('d-none');
                        $('#alert-qr_produk').addClass('d-block');

                        // Add message to alert
                        $('#alert-qr_produk').html(error.responseJSON.qr_produk[0]);
                    }
                    if (error.responseJSON.qr_img[0]) {
                        // Show alert
                        $('#alert-qr_img').removeClass('d-none');
                        $('#alert-qr_img').addClass('d-block');

                        // Add message to alert
                        $('#alert-qr_img').html(error.responseJSON.qr_img[0]);
                    }
                    if (error.responseJSON.img[0]) {
                        // Show alert
                        $('#alert-img').removeClass('d-none');
                        $('#alert-img').addClass('d-block');

                        // Add message to alert
                        $('#alert-img').html(error.responseJSON.img[0]);
                    }
                    if (error.responseJSON.merek_id[0]) {
                        // Show alert
                        $('#alert-merek_id').removeClass('d-none');
                        $('#alert-merek_id').addClass('d-block');

                        // Add message to alert
                        $('#alert-merek_id').html(error.responseJSON.merek_id[0]);
                    }
                    if (error.responseJSON.jenis_id[0]) {
                        // Show alert
                        $('#alert-jenis_id').removeClass('d-none');
                        $('#alert-jenis_id').addClass('d-block');

                        // Add message to alert
                        $('#alert-jenis_id').html(error.responseJSON.jenis_id[0]);
                    }
                    if (error.responseJSON.supliyer_id[0]) {
                        // Show alert
                        $('#alert-supliyer_id').removeClass('d-none');
                        $('#alert-supliyer_id').addClass('d-block');

                        // Add message to alert
                        $('#alert-supliyer_id').html(error.responseJSON.supliyer_id[0]);
                    }
                    if (error.responseJSON.stok[0]) {
                        // Show alert
                        $('#alert-stok').removeClass('d-none');
                        $('#alert-stok').addClass('d-block');

                        // Add message to alert
                        $('#alert-stok').html(error.responseJSON.stok[0]);
                    }
                    if (error.responseJSON.harga_jual[0]) {
                        // Show alert
                        $('#alert-harga_jual').removeClass('d-none');
                        $('#alert-harga_jual').addClass('d-block');

                        // Add message to alert
                        $('#alert-harga_jual').html(error.responseJSON.harga_jual[0]);
                    }
                    if (error.responseJSON.harga_beli[0]) {
                        // Show alert
                        $('#alert-harga_beli').removeClass('d-none');
                        $('#alert-harga_beli').addClass('d-block');

                        // Add message to alert
                        $('#alert-harga_beli').html(error.responseJSON.harga_beli[0]);
                    }
                    if (error.responseJSON.diskon[0]) {
                        // Show alert
                        $('#alert-diskon').removeClass('d-none');
                        $('#alert-diskon').addClass('d-block');

                        // Add message to alert
                        $('#alert-diskon').html(error.responseJSON.diskon[0]);
                    }
                    if (error.responseJSON.tgl_exp[0]) {
                        // Show alert
                        $('#alert-tgl_exp').removeClass('d-none');
                        $('#alert-tgl_exp').addClass('d-block');

                        // Add message to alert
                        $('#alert-tgl_exp').html(error.responseJSON.tgl_exp[0]);
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
                    $.ajax({
                        url: '/produk/delete/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Sukses',
                                text: response.message,
                                icon: 'success',
                                timer: 2000
                            });
                            var dataTable = $('#dataTable').DataTable();
                            dataTable.ajax.reload(null, false);
                            // Mengambil data terbaru setelah menghapus
                        }
                    });
                }
            });
        }

        $('body').on('click', '#btn-edit-post', function() {
            let user_id = $(this).data('id');

            // Fetch detail post with ajax
            $.ajax({
                url: `/produk/show/${user_id}`,
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
                url: `/produk/update/${user_id}`,
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
                        url: `/merekjenis/show/${user_id}`,
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
                let produk_id = $(this).data('id');

                // Fetch detail post with ajax
                $.ajax({
                    url: `/produk/show/${produk_id}`,
                    type: "GET",
                    cache: false,
                    success: function(response) {
                        // Fill data to form
                        $('#produk_id2').val(response.id);
                        $('#name-edit2').val(response.name);
                        $('#qr_produk-edit2').val(response.qr_produk);
                        $('#qr_img-edit2').val(''); // Reset QR Image file input
                        $('#qr-img-preview').attr('src', '/images/' + response.qr_img);
                        $('#img-edit2').val(''); // Reset Image file input
                        $('#img-preview').attr('src', '/images/' + response.img);
                        $('#merek_id-edit2').val(response.merek_id);
                        $('#jenis_id-edit2').val(response.jenis_id);
                        $('#supliyer_id-edit2').val(response.supliyer_id);
                        $('#stok-edit2').val(response.stok);
                        $('#harga_jual-edit2').val(response.harga_jual);
                        $('#harga_beli-edit2').val(response.harga_beli);
                        $('#diskon-edit2').val(response.diskon);
                        $('#tgl_exp-edit2').val(response.tgl_exp);
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
                let produk_id = $('#produk_id2').val();
                let name = $('#name-edit2').val();
                let qr_produk = $('#qr_produk-edit2').val();
                let qr_img = $('#qr_img-edit2')[0].files[0];
                let img = $('#img-edit2')[0].files[0];
                let merek_id = $('#merek_id-edit2').val();
                let jenis_id = $('#jenis_id-edit2').val();
                let supliyer_id = $('#supliyer_id-edit2').val();
                let stok = $('#stok-edit2').val();
                let harga_jual = $('#harga_jual-edit2').val();
                let harga_beli = $('#harga_beli-edit2').val();
                let diskon = $('#diskon-edit2').val();
                let tgl_exp = $('#tgl_exp-edit2').val();

                let token = $("meta[name='csrf-token']").attr("content");

                let formData = new FormData();
                formData.append("produk_id", produk_id);
                formData.append("name", name);
                formData.append("qr_produk", qr_produk);
                formData.append("qr_img", qr_img); // Append the QR image file
                formData.append("img", img); // Append the image file
                formData.append("merek_id", merek_id);
                formData.append("jenis_id", jenis_id);
                formData.append("supliyer_id", supliyer_id);
                formData.append("stok", stok);
                formData.append("harga_jual", harga_jual);
                formData.append("harga_beli", harga_beli);
                formData.append("diskon", diskon);
                formData.append("tgl_exp", tgl_exp);
                formData.append("_token", token);
                // Ajax
                $.ajax({
                    url: `/produk/update/${produk_id}`,
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
                        // Error handling
                        if (error.responseJSON.name) {
                            $('#alert-name-edit2').removeClass('d-none');
                            $('#alert-name-edit2').addClass('d-block');
                            $('#alert-name-edit2').html(error.responseJSON.name[0]);
                        }
                        if (error.responseJSON.qr_produk) {
                            $('#alert-qr_produk-edit2').removeClass('d-none');
                            $('#alert-qr_produk-edit2').addClass('d-block');
                            $('#alert-qr_produk-edit2').html(error.responseJSON.qr_produk[0]);
                        }
                        if (error.responseJSON.qr_img) {
                            $('#alert-qr_img-edit2').removeClass('d-none');
                            $('#alert-qr_img-edit2').addClass('d-block');
                            $('#alert-qr_img-edit2').html(error.responseJSON.qr_img[0]);
                        }
                        if (error.responseJSON.img) {
                            $('#alert-img-edit2').removeClass('d-none');
                            $('#alert-img-edit2').addClass('d-block');
                            $('#alert-img-edit2').html(error.responseJSON.img[0]);
                        }
                        if (error.responseJSON.merek_id) {
                            $('#alert-merek_id-edit2').removeClass('d-none');
                            $('#alert-merek_id-edit2').addClass('d-block');
                            $('#alert-merek_id-edit2').html(error.responseJSON.merek_id[0]);
                        }
                        if (error.responseJSON.jenis_id) {
                            $('#alert-jenis_id-edit2').removeClass('d-none');
                            $('#alert-jenis_id-edit2').addClass('d-block');
                            $('#alert-jenis_id-edit2').html(error.responseJSON.jenis_id[0]);
                        }
                        if (error.responseJSON.supliyer_id) {
                            $('#alert-supliyer_id-edit2').removeClass('d-none');
                            $('#alert-supliyer_id-edit2').addClass('d-block');
                            $('#alert-supliyer_id-edit2').html(error.responseJSON.supliyer_id[
                                0]);
                        }
                        if (error.responseJSON.stok) {
                            $('#alert-stok-edit2').removeClass('d-none');
                            $('#alert-stok-edit2').addClass('d-block');
                            $('#alert-stok-edit2').html(error.responseJSON.stok[0]);
                        }
                        if (error.responseJSON.harga_jual) {
                            $('#alert-harga_jual-edit2').removeClass('d-none');
                            $('#alert-harga_jual-edit2').addClass('d-block');
                            $('#alert-harga_jual-edit2').html(error.responseJSON.harga_jual[0]);
                        }
                        if (error.responseJSON.harga_beli) {
                            $('#alert-harga_beli-edit2').removeClass('d-none');
                            $('#alert-harga_beli-edit2').addClass('d-block');
                            $('#alert-harga_beli-edit2').html(error.responseJSON.harga_beli[0]);
                        }
                        if (error.responseJSON.diskon) {
                            $('#alert-diskon-edit2').removeClass('d-none');
                            $('#alert-diskon-edit2').addClass('d-block');
                            $('#alert-diskon-edit2').html(error.responseJSON.diskon[0]);
                        }
                        if (error.responseJSON.tgl_exp) {
                            $('#alert-tgl_exp-edit2').removeClass('d-none');
                            $('#alert-tgl_exp-edit2').addClass('d-block');
                            $('#alert-tgl_exp-edit2').html(error.responseJSON.tgl_exp[0]);
                        }

                    }
                });
            });
        });
    </script>
@endsection
