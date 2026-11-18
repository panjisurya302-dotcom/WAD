<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk - Kos Management System</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 & Font Awesome 6 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Theme Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>
<body class="auth-wrapper">
    <div class="auth-card">
        <!-- Card Header / Brand -->
        <div class="auth-header">
            <div class="brand-emblem mx-auto mb-3" style="width: 48px; height: 48px; font-size: 1.35rem; border-radius: 12px;">
                <i class="fa-solid fa-hotel"></i>
            </div>
            <h2 class="fw-bold mb-1" style="font-size: 1.35rem; letter-spacing: -0.02em; color: var(--text-primary);">
                Kos<span style="color: var(--brand-blue);">Management</span>
            </h2>
            <p class="text-muted small mb-0">Portal Administrasi Staf & Pengelolaan Operasional</p>
        </div>

        <!-- Card Body -->
        <div class="auth-body">
            @if(session('success'))
                <div class="alert-custom alert-custom-success mb-3 py-2">
                    <div class="d-flex align-items-center gap-2 small">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-custom alert-custom-danger mb-3 py-2">
                    <div class="d-flex align-items-center gap-2 small">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label-custom">
                        Alamat Email
                    </label>
                    <div class="position-relative">
                        <span class="position-absolute top-50 translate-middle-y text-muted ps-3" style="font-size: 0.9rem;">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" 
                               name="email" 
                               class="form-control-custom ps-5" 
                               value="{{ old('email') }}" 
                               placeholder="nama@email.com" 
                               required 
                               autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <label class="form-label-custom mb-0">
                            Kata Sandi
                        </label>
                    </div>
                    <div class="position-relative">
                        <span class="position-absolute top-50 translate-middle-y text-muted ps-3" style="font-size: 0.9rem;">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" 
                               name="password" 
                               id="passwordInput"
                               class="form-control-custom ps-5 pe-5" 
                               placeholder="••••••••" 
                               required>
                        <button type="button" 
                                class="btn position-absolute top-50 end-0 translate-middle-y text-muted border-0 bg-transparent pe-3" 
                                onclick="togglePasswordVisibility()" 
                                tabindex="-1">
                            <i class="fa-regular fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-primary-custom w-100 justify-content-center py-2" style="font-size: 0.95rem;">
                    <span>Masuk ke Sistem</span>
                    <i class="fa-solid fa-arrow-right-to-bracket ms-1"></i>
                </button>
            </form>

            <div class="d-flex align-items-center justify-content-center gap-2 mt-4 pt-3 border-top text-muted" style="font-size: 0.75rem;">
                <i class="fa-solid fa-shield-halved text-primary"></i>
                <span>Sesi terlindungi enkripsi standar HTTPS</span>
            </div>
        </div>
    </div>

    <div class="auth-footer-text">
        &copy; {{ date('Y') }} Kos Management System &bull; Seluruh hak cipta dilindungi.
    </div>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
