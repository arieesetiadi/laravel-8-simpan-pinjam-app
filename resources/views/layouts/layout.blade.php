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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/pace/pace.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datatables/datatables.min.css') }}" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ asset('css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/neptune.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/neptune.png') }}" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- Title -->
    <title>Aplikasi Simpan Pinjam</title>
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <div class="app-sidebar">
            <div class="logo">
                <a href="{{ route('halamanDashboard') }}" class="logo-icon"><span class="logo-text">Dashboard</span></a>
                <div class="sidebar-user-switcher user-activity-online">
                    <a href="{{ route('halamanProfile') }}">
                        {{-- Tampilkan profile pengguna --}}
                        <img src="{{ asset('images/avatars/' . strtolower(user()->jenis_kelamin) . '.png') }}">
                        <span class="activity-indicator"></span>
                        <span class="user-info-text">{{ user()->nama }}<br>
                            <span class="user-state-info">Online</span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="app-menu">
                <ul class="accordion-menu">
                    <li class="sidebar-title">
                        Utama
                    </li>

                    <li class="active-page">
                        <a href="{{ route('halamanDashboard') }}" class="text-dark"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
                    </li>

                    <li class="sidebar-title {{ !role('pegawai') ? 'd-none' : '' }}">
                        Kelola
                    </li>

                    <li class="active-page {{ !role('pegawai') ? 'd-none' : '' }}">
                        <a href="{{ route('halamanUtamaPengawas') }}" class="text-dark"><i class="material-icons-two-tone">account_circle</i>Pengawas</a>
                    </li>
                    <li class="active-page {{ !role('pegawai') ? 'd-none' : '' }}">
                        <a href="{{ route('halamanUtamaPegawai') }}" class="text-dark"><i class="material-icons-two-tone">account_circle</i>Pegawai</a>
                    </li>
                    <li class="active-page {{ !role('pegawai') ? 'd-none' : '' }}">
                        <a href="{{ route('halamanUtamaDirektur') }}" class="text-dark"><i class="material-icons-two-tone">account_circle</i>Direktur</a>
                    </li>
                    <li class="active-page {{ !role('pegawai') ? 'd-none' : '' }}">
                        <a href="{{ route('halamanUtamaNasabah') }}" class="text-dark"><i class="material-icons-two-tone">account_circle</i>Nasabah</a>
                    </li>

                    <li class="sidebar-title {{ !role('pegawai') ? 'd-none' : '' }}">
                        Simpan & Pinjam
                    </li>

                    <li class="active-page {{ !role('pegawai') ? 'd-none' : '' }}">
                        <a href="{{ route('halamanUtamaPengawas') }}" class="text-dark"><i class="material-icons-two-tone">account_circle</i>No Tabungan</a>
                    </li>

                    <li class="sidebar-title">
                        Lainnya
                    </li>

                    <li class="active-page">
                        <a href="{{ route('prosesLogout') }}" class="text-dark"><i class="material-icons-two-tone">indeterminate_check_box</i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="app-container">
            <div class="search">
                <form>
                    <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
                </form>
                <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
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
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/main.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('js/pages/datatables.js') }}"></script>
</body>

</html>
