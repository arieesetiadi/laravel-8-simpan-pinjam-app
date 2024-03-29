<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
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
    <link href="{{ asset('plugins/datatables/datatables.min.css') }}" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link type="image/png" href="{{ asset('images/bumdes.png') }}" rel="icon" sizes="32x32" />
    <link type="image/png" href="{{ asset('images/bumdes.png') }}" rel="icon" sizes="16x16" />

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    {{-- Select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Title -->
    <title>Aplikasi Simpan Pinjam</title>
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <div class="app-sidebar">
            <div class="logo">
                <a class="logo-icon" href="{{ route('halamanDashboard') }}"><span class="logo-text">Dashboard</span></a>
                <div class="sidebar-user-switcher user-activity-online">
                    <a href="{{ route('halamanProfile') }}">
                        {{-- Tampilkan profile pengguna --}}
                        <img src="{{ asset('images/avatars/' . strtolower(user()->jenis_kelamin) . '.png') }}">
                        <span class="activity-indicator"></span>
                        <span class="user-info-text">{{ user()->nama }}<br>
                            <span class="user-state-info">{{ ucwords(request()->guard) }}</span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="app-menu">
                <ul class="accordion-menu">
                    <li class="sidebar-title">
                        Utama
                    </li>

                    {{-- <li class="active-page"> --}}
                    <li class="{{ $sidebarDashboard ?? '' }}">
                        <a href="{{ route('halamanDashboard') }}"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
                    </li>

                    <li class="sidebar-title {{ !role('pegawai') && !role('admin') ? 'd-none' : '' }}">
                        Kelola
                    </li>

                    <li class="{{ $sidebarPengawas ?? '' }} {{ !role('admin') ? 'd-none' : '' }}">
                        <a href="{{ route('halamanUtamaPengawas') }}"><i class="material-icons-two-tone">account_circle</i>Pengawas</a>
                    </li>
                    <li class="{{ $sidebarPegawai ?? '' }} {{ !role('admin') ? 'd-none' : '' }}">
                        <a href="{{ route('halamanUtamaPegawai') }}"><i class="material-icons-two-tone">account_circle</i>Pegawai</a>
                    </li>
                    <li class="{{ $sidebarDirektur ?? '' }} {{ !role('admin') ? 'd-none' : '' }}">
                        <a href="{{ route('halamanUtamaDirektur') }}"><i class="material-icons-two-tone">account_circle</i>Direktur</a>
                    </li>
                    <li class="{{ $sidebarNasabah ?? '' }} {{ !role('pegawai') ? 'd-none' : '' }}">
                        <a href="{{ route('halamanUtamaNasabah') }}"><i class="material-icons-two-tone">account_circle</i>Nasabah</a>
                    </li>

                    <li class="sidebar-title {{ role('admin') ? 'd-none' : '' }}">
                        Simpan & Pinjam
                    </li>

                    <li class="{{ $sidebarSimpanan ?? '' }} {{ role('admin') ? 'd-none' : '' }}">
                        <a href="#">
                            <i class="material-icons-two-tone">view_list</i>
                            Simpanan<i class="material-icons has-sub-menu">keyboard_arrow_right</i>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{ $sidebarNoTabungan ?? '' }}">
                                <a href="{{ route('halamanUtamaNoTabungan') }}">No Tabungan</a>
                            </li>
                            <li class="{{ $sidebarKasSimpanan ?? '' }}">
                                <a href="{{ route('halamanUtamaKasSimpanan') }}">Kas Simpanan</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ $sidebarPinjaman ?? '' }} {{ role('admin') ? 'd-none' : '' }}">
                        <a href="#">
                            <i class="material-icons-two-tone">list_alt</i>
                            Pinjaman<i class="material-icons has-sub-menu">keyboard_arrow_right</i>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{ $sidebarNoPinjaman ?? '' }}">
                                <a href="{{ route('halamanUtamaNoPinjaman') }}">No Pinjaman</a>
                            </li>
                            <li class="{{ $sidebarSubPinjaman ?? '' }}">
                                <a href="{{ route('halamanUtamaPinjaman') }}">Pinjaman</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ $sidebarLaporan ?? '' }}">
                        <a href="{{ route('halamanUtamaLaporan') }}"><i class="material-icons-two-tone">summarize</i>Laporan</a>
                    </li>

                    <li class="sidebar-title">
                        Lainnya
                    </li>

                    <li>
                        <a href="{{ route('prosesLogout') }}"><i class="material-icons text-dark">indeterminate_check_box</i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="app-container">
            <div class="search">
                <form>
                    <input class="form-control" type="text" aria-label="Search" placeholder="Type here...">
                </form>
                <a class="toggle-search" href="#"><i class="material-icons">close</i></a>
            </div>
            <div class="app-header">
                <nav class="navbar navbar-light navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="navbar-nav" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="app-content">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="{{ asset('plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    {{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
    {{-- <script src="{{ asset('plugins/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/main.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    {{-- <script src="{{ asset('js/pages/dashboard.js') }}"></script> --}}
    <script src="{{ asset('js/pages/datatables.js') }}"></script>

    {{-- Custome Scripts --}}
    <script>
        $(document).ready(function() {
            // Bind keypress event to all number input types
            $('input[type="number"]').keypress(function(event) {
                var keyCode = event.which;
                // Check if the pressed key is within the range of 0-9 (keyCode 48-57)
                if (keyCode < 48 || keyCode > 57) {
                    event.preventDefault(); // Prevent input if not a number
                }
            });
        });
    </script>

    {{-- Stack --}}
    @stack('after-scripts')
</body>

</html>
