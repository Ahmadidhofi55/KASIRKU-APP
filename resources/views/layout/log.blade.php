<!doctype html>
<html lang="en">

<head>
    <title>LOGIN | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="/images/kasir.png" type="image/x-icon">
    <link href="/fonts/fonts.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>
    <section class="ftco-section bg-info">
        @yield('content')
    </section>
    <script src="/js/sweetalert2@11.js"></script>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Login Gagal!',
                text: '{{ session('error') }}', // Ambil pesan dari session
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        </script>
    @endif
</body>

</html>
