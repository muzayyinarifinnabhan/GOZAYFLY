<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon (Logo GoZay) -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}">
    <title>@yield('title', 'Admin GoZay') - Panel Administrasi</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <!-- Custom GoZay -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @include('partials.flash')
</head>
<body>
    @include('partials.skeleton')
    <div class="d-flex">

        <!-- Sidebar -->
        <aside class="admin-sidebar d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 240px;">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none fw-bold fs-5">
                <i class="bi bi-airplane-fill me-2 text-info"></i>GoZay<span class="text-info">&nbsp;Admin</span>
            </a>
            <hr class="border-secondary opacity-25">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="bi bi-layout-text-window-reverse me-2"></i>Konten Website
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.airports.index') }}" class="nav-link {{ request()->routeIs('admin.airports.*') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt me-2"></i>Bandara
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.airlines.index') }}" class="nav-link {{ request()->routeIs('admin.airlines.*') ? 'active' : '' }}">
                        <i class="bi bi-building me-2"></i>Maskapai
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.flights.index') }}" class="nav-link {{ request()->routeIs('admin.flights.*') || request()->routeIs('admin.seats.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-event me-2"></i>Penerbangan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                        <i class="bi bi-cash-coin me-2"></i>Pembayaran
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.boarding-passes.index') }}" class="nav-link {{ request()->routeIs('admin.boarding-passes.*') ? 'active' : '' }}">
                        <i class="bi bi-qr-code me-2"></i>Boarding Pass
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i>User
                    </a>
                </li>
            </ul>
            <hr class="my-3 opacity-25">
            <!-- Logout admin -->
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm w-100">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </form>
        </aside>

        <!-- Content -->
        <div class="admin-content flex-grow-1">
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>