<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Simpan Pinjam">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pace/pace.css') }}" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/bumdes.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/bumdes.png') }}" />

    <!-- Title -->
    <title>Login - Aplikasi Simpan Pinjam</title>
</head>

<body>
    <div class="app app-auth-sign-in align-content-stretch d-flex justify-content-end flex-wrap">
        <div class="app-auth-background">

        </div>
        <form action="{{ route('prosesLogin') }}" method="POST">
            @csrf
            <div class="app-auth-container">
                <div class="logo">
                    <a href="">Login</a>
                </div>

                {{-- Tampilkan jika ada pesan error --}}
                @if (session('alert'))
                    <span class="text-danger mt-2">{{ session('alert') }}</span>
                @endif

                {{-- Tampilkan jika ada pesan sukses --}}
                @if (session('success'))
                    <span class="text-success mt-2">{{ session('success') }}</span>
                @endif

                <div class="my-5">
                    <h6 class="mb-3">Login sebagai:</h6>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="guard" value="admin"
                                id="admin" checked>
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="pegawai" class="form-check-input" type="radio" name="guard"
                                value="pegawai">
                            <label class="form-check-label" for="pegawai">Pegawai</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="pengawas" class="form-check-input" type="radio" name="guard"
                                value="pengawas">
                            <label class="form-check-label" for="pengawas">Pengawas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="direktur" class="form-check-input" type="radio" name="guard"
                                value="direktur">
                            <label class="form-check-label" for="direktur">Direktur</label>
                        </div>
                    </div>
                </div>

                <div class="auth-credentials m-b-xxl">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" type="text" class="form-control m-b-md"
                        placeholder="Username" required>

                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" class="form-control"
                        placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>

                <div class="auth-submit d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="{{ route('halamanLupaPassword') }}">Lupa Password</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Javascripts -->
    <script src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('js/main.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
