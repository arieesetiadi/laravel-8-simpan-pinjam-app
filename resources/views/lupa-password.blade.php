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
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pace/pace.css') }}" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link type="image/png" href="{{ asset('images/bumdes.png') }}" rel="icon" sizes="32x32" />
    <link type="image/png" href="{{ asset('images/bumdes.png') }}" rel="icon" sizes="16x16" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- Title -->
    <title>Lupa Password - Aplikasi Simpan Pinjam</title>
</head>

<body>
    <div class="app app-auth-sign-in align-content-stretch d-flex justify-content-end flex-wrap">
        <div class="app-auth-background"></div>

        @if (!isset($email))
        <form action="{{ route('emailLupaPassword') }}" method="POST">
            @csrf
            <div class="app-auth-container">
                <div class="logo">
                    <a href="">Lupa Password</a>
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
                    <h6 class="mb-3">Jenis akun:</h6>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="pegawai" name="guard" type="radio" value="pegawai" checked>
                            <label class="form-check-label" for="pegawai">Pegawai</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="pengawas" name="guard" type="radio" value="pengawas">
                            <label class="form-check-label" for="pengawas">Pengawas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" id="direktur" name="guard" type="radio" value="direktur">
                            <label class="form-check-label" for="direktur">Direktur</label>
                        </div>
                    </div>
                </div>

                <div class="auth-credentials m-b-xxl">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control mb-1" id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="d-block text-danger"><i class="fa-solid fa-circle-info"></i> {{ $message }}</small>
                    @enderror
                    <small class="d-block text-dark"><i class="fa-solid fa-circle-info"></i> Link reset password akan dikirimkan ke alamat email ini.</small>
                </div>

                <div class="auth-submit">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
        @else
        <form action="{{ route('prosesLupaPassword') }}" method="POST">
            @csrf
            <div class="app-auth-container">
                <div class="logo mb-5">
                    <a href="">Atur Ulang Password</a>
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="type" value="{{ $type }}">
                </div>

                {{-- Tampilkan jika ada pesan error --}}
                @if (session('alert'))
                <span class="text-danger mt-2">{{ session('alert') }}</span>
                @endif
                
                {{-- Tampilkan jika ada pesan sukses --}}
                @if (session('success'))
                    <span class="text-success mt-2">{{ session('success') }}</span>
                @endif

                <div class="auth-credentials m-b-xxl">
                    <label for="password" class="form-label">Password Baru</label>
                    <input name="password" type="password" class="form-control mb-1" id="password"
                        placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                    @error('password')
                        <small class="d-block text-danger"><i class="fa-solid fa-circle-info"></i> {{ $message }}</small>
                    @enderror

                    <label for="password_confirmation" class="form-label d-block mt-4">Konfirmasi Password Baru</label>
                    <input name="password_confirmation" type="password" class="form-control mb-1" id="password_confirmation"
                        placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                    @error('password')
                        <small class="d-block text-danger"><i class="fa-solid fa-circle-info"></i> {{ $message }}</small>
                    @enderror
                </div>

                <div class="auth-submit">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
        @endif

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
