<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Kos Management System')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Font Awesome 6 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Theme Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Main App Navigation -->
    <header class="app-navbar">
        <div class="container-xl">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Brand & Logo -->
                <div class="d-flex align-items-center">
                    <a href="{{ route('housekeepers.index') }}" class="text-decoration-none d-flex align-items-center">
                        <div class="brand-emblem">
                            <i class="fa-solid fa-hotel"></i>
                        </div>
                        <div class="brand-title">
                            Kos<span style="color: #60a5fa;">Management</span>
                            <span class="brand-subtitle">Sistem Pengelolaan Staf Kos</span>
                        </div>
                    </a>

                    <!-- Nav Items -->
                    <div class="d-none d-md-flex align-items-center ms-4 ps-3 border-start border-secondary border-opacity-25">
                        <a href="{{ route('housekeepers.index') }}" class="nav-link-custom active">
                            <i class="fa-solid fa-users-gear text-primary"></i>
                            <span>Daftar Housekeeper</span>
                        </a>
                    </div>
                </div>

                <!-- Right Side Actions & User Menu -->
                <div class="d-flex align-items-center gap-3">
                    @auth
                        <div class="user-profile-badge d-none d-sm-flex">
                            <div class="user-avatar-circle">
                                {{ strtoupper(substr(Auth::user()->name ?? 'Admin', 0, 2)) }}
                            </div>
                            <div>
                                <span class="user-meta-name">{{ Auth::user()->name ?? 'Administrator' }}</span>
                                <span class="user-meta-role">Pengelola Kos</span>
                            </div>
                        </div>

                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn-logout" title="Keluar dari sistem">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <span class="d-none d-sm-inline">Keluar</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3">
                            <i class="fa-solid fa-lock me-1"></i> Masuk
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Canvas -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- App Footer -->
    <footer class="app-footer">
        <div class="container-xl">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-primary"></i>
                    <span><strong>Kos Management System</strong> &bull; Portal Operasional & Kebersihan Kos</span>
                </div>
                <div class="text-secondary small">
                    Handcrafted for Quality &bull; Versi 2.0
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
