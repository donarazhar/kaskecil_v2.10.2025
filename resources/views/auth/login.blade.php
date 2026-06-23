<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login Aplikasi Kas Kecil Metode Imprest">
    <meta name="author" content="Dal Army">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon" />
    <title>Kas Kecil App | Login</title>

    <!-- Fonts & Icons -->
    <link href="{{ asset('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --blue-50:  #eff6ff;
            --blue-100: #dbeafe;
            --blue-500: #3b82f6;
            --blue-600: #2563eb;
            --blue-700: #1d4ed8;
            --blue-800: #1e40af;
            --blue-900: #1e3a8a;
            --primary:  #0053C5;
            --primary-dark: #003d91;
            --white: #ffffff;
            --gray-50:  #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --danger:   #ef4444;
            --radius-sm:  8px;
            --radius-md:  12px;
            --radius-lg:  16px;
            --radius-xl:  24px;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--gray-50);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            -webkit-font-smoothing: antialiased;
        }

        /* ===== LAYOUT ===== */
        .login-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* ===== LEFT PANEL ===== */
        .panel-left {
            flex: 0 0 45%;
            background: linear-gradient(160deg, var(--primary) 0%, var(--primary-dark) 60%, #001f5c 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        .panel-left::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            top: -150px;
            right: -150px;
            pointer-events: none;
        }
        .panel-left::after {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            bottom: -80px;
            left: -80px;
            pointer-events: none;
        }

        .panel-left-top {
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 64px;
        }

        .brand-logo img {
            width: 44px;
            height: 44px;
            object-fit: contain;
            filter: brightness(0) invert(1);
            opacity: 0.9;
        }

        .brand-name {
            color: rgba(255,255,255,0.95);
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .panel-headline {
            position: relative;
            z-index: 1;
        }

        .panel-headline .badge-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.9);
            font-size: 12px;
            font-weight: 500;
            padding: 5px 14px;
            border-radius: 100px;
            margin-bottom: 20px;
            letter-spacing: 0.2px;
        }

        .panel-headline h1 {
            color: var(--white);
            font-size: clamp(28px, 3vw, 38px);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.8px;
            margin-bottom: 16px;
        }

        .panel-headline p {
            color: rgba(255,255,255,0.7);
            font-size: 15px;
            line-height: 1.7;
            max-width: 340px;
        }

        /* Feature list */
        .feature-list {
            list-style: none;
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.85);
            font-size: 14px;
            font-weight: 400;
        }

        .feature-list .feat-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 13px;
            color: rgba(255,255,255,0.9);
        }

        .panel-left-bottom {
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(255,255,255,0.12);
            padding-top: 24px;
        }

        .panel-left-bottom p {
            color: rgba(255,255,255,0.5);
            font-size: 13px;
            line-height: 1.6;
        }

        .panel-left-bottom strong {
            color: rgba(255,255,255,0.8);
        }

        /* ===== RIGHT PANEL (FORM) ===== */
        .panel-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            background: var(--white);
            position: relative;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            animation: slideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .form-header .logo-img-wrap {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: var(--blue-50);
            border: 2px solid var(--blue-100);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            padding: 10px;
            box-shadow: 0 4px 14px rgba(0, 83, 197, 0.12);
        }

        .form-header .logo-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .form-header h2 {
            color: var(--gray-900);
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .form-header p {
            color: var(--gray-500);
            font-size: 14px;
            line-height: 1.5;
        }

        /* Alert error */
        .alert-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: var(--radius-md);
            padding: 12px 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .alert-box i { color: var(--danger); margin-top: 1px; font-size: 14px; }
        .alert-box p { color: #991b1b; font-size: 13px; line-height: 1.5; margin: 0; }

        /* Form */
        .field-group {
            margin-bottom: 20px;
        }

        .field-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 7px;
            letter-spacing: 0.1px;
        }

        .field-input-wrap {
            position: relative;
        }

        .field-input-wrap .f-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .field-input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 400;
            color: var(--gray-900);
            background: var(--white);
            transition: all 0.2s ease;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        .field-input::placeholder {
            color: var(--gray-400);
            font-weight: 400;
        }

        .field-input:hover {
            border-color: var(--gray-300);
        }

        .field-input:focus {
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(0, 83, 197, 0.1);
        }

        .field-input:focus ~ .f-icon {
            color: var(--primary);
        }

        .field-input.is-error {
            border-color: var(--danger);
        }

        .field-input.is-error:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .error-msg {
            margin-top: 5px;
            font-size: 12px;
            color: var(--danger);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Toggle password */
        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            padding: 0;
            line-height: 1;
            font-size: 15px;
            transition: color 0.2s;
        }
        .toggle-pw:hover { color: var(--gray-600); }

        /* Row options */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .check-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .check-wrap input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
            cursor: pointer;
            border-radius: 4px;
        }

        .check-wrap label {
            font-size: 13px;
            color: var(--gray-600);
            cursor: pointer;
            font-weight: 400;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 13px 24px;
            background: var(--primary);
            border: none;
            border-radius: var(--radius-md);
            color: var(--white);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.1px;
            box-shadow: 0 1px 3px rgba(0, 83, 197, 0.25), 0 4px 12px rgba(0, 83, 197, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(255,255,255,0), rgba(255,255,255,0.08));
            pointer-events: none;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            box-shadow: 0 1px 3px rgba(0, 83, 197, 0.3), 0 6px 16px rgba(0, 83, 197, 0.3);
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 1px 2px rgba(0, 83, 197, 0.2);
        }

        /* Divider */
        .or-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0 0;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-100);
        }

        .or-divider span {
            color: var(--gray-400);
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
        }

        /* Footer text */
        .form-footer {
            text-align: center;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-100);
        }

        .form-footer p {
            color: var(--gray-400);
            font-size: 12.5px;
            line-height: 1.7;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .panel-left {
                flex: 0 0 40%;
                padding: 36px 32px;
            }
            .panel-right {
                padding: 40px 32px;
            }
            .panel-headline h1 {
                font-size: 26px;
            }
            .feature-list { display: none; }
        }

        @media (max-width: 640px) {
            .login-wrapper {
                flex-direction: column;
            }
            .panel-left {
                flex: none;
                padding: 28px 24px;
                min-height: auto;
            }
            .panel-left-bottom { display: none; }
            .panel-headline h1 { font-size: 22px; margin-bottom: 8px; }
            .panel-headline p  { font-size: 13px; }
            .brand-logo { margin-bottom: 28px; }
            .panel-right {
                padding: 32px 20px;
            }
            .form-container { max-width: 100%; }
        }

        @media (max-width: 380px) {
            .panel-right { padding: 24px 16px; }
            .form-header h2 { font-size: 20px; }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">

        <!-- ===== LEFT PANEL ===== -->
        <div class="panel-left">
            <div class="panel-left-top">
                <div class="brand-logo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                    <span class="brand-name">Kas Kecil App</span>
                </div>

                <div class="panel-headline">
                    <div class="badge-chip">
                        <i class="fas fa-shield-alt"></i>
                        Sistem Terpercaya
                    </div>
                    <h1>Manajemen Keuangan Kas Kecil Metode Imprest</h1>
                    <p>Sistem pencatatan dan pelaporan kas kecil yang akurat, efisien, dan mudah digunakan untuk operasional harian.</p>
                </div>

                <ul class="feature-list">
                    <li>
                        <span class="feat-icon"><i class="fas fa-layer-group"></i></span>
                        Kelola Pembentukan & Pengisian Kas
                    </li>
                    <li>
                        <span class="feat-icon"><i class="fas fa-receipt"></i></span>
                        Catat Pengeluaran Secara Real-time
                    </li>
                    <li>
                        <span class="feat-icon"><i class="fas fa-file-invoice"></i></span>
                        Laporan & Cetak Dokumen Otomatis
                    </li>
                    <li>
                        <span class="feat-icon"><i class="fas fa-lock"></i></span>
                        Keamanan Data Terjamin
                    </li>
                </ul>
            </div>

            <div class="panel-left-bottom">
                <p>© 2025 <strong>Masjid Agung Al Azhar</strong><br>Dikembangkan oleh Dal Army</p>
            </div>
        </div>

        <!-- ===== RIGHT PANEL (FORM) ===== -->
        <div class="panel-right">
            <div class="form-container">

                <div class="form-header">
                    <div class="logo-img-wrap">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Kas Kecil">
                    </div>
                    <h2>Selamat Datang Kembali</h2>
                    <p>Masukkan kredensial Anda untuk mengakses dashboard</p>
                </div>

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="alert-box">
                        <i class="fas fa-exclamation-circle"></i>
                        <p>
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </p>
                    </div>
                @endif

                <form action="/proseslogin" method="POST" novalidate id="loginForm">
                    @csrf

                    <!-- Email -->
                    <div class="field-group">
                        <label for="email" class="field-label">Alamat Email</label>
                        <div class="field-input-wrap">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="field-input @error('email') is-error @enderror"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                autocomplete="email"
                                required>
                            <i class="fas fa-envelope f-icon"></i>
                        </div>
                        @error('email')
                            <span class="error-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="field-group">
                        <label for="password" class="field-label">Kata Sandi</label>
                        <div class="field-input-wrap">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="field-input @error('password') is-error @enderror"
                                placeholder="Masukkan kata sandi Anda"
                                autocomplete="current-password"
                                required>
                            <i class="fas fa-lock f-icon"></i>
                            <button type="button" class="toggle-pw" id="togglePw" aria-label="Tampilkan kata sandi">
                                <i class="fas fa-eye" id="togglePwIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="error-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Options -->
                    <div class="form-options">
                        <label class="check-wrap">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat saya</label>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-submit" id="btnSubmit">
                        <i class="fas fa-arrow-right-to-bracket"></i>
                        Masuk ke Dashboard
                    </button>
                </form>

                <div class="form-footer">
                    <p>Kas Kecil App V.2.0 &mdash; Metode Imprest<br>
                    © 2025 Masjid Agung Al Azhar</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @include('sweetalert::alert')

    <script>
        // Toggle password visibility
        const togglePw   = document.getElementById('togglePw');
        const pwInput    = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePwIcon');

        togglePw.addEventListener('click', function () {
            const isHidden = pwInput.type === 'password';
            pwInput.type = isHidden ? 'text' : 'password';
            toggleIcon.classList.toggle('fa-eye', !isHidden);
            toggleIcon.classList.toggle('fa-eye-slash', isHidden);
        });

        // Loading state on submit
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memproses...';
        });

        // Animate f-icon color on input focus
        document.querySelectorAll('.field-input').forEach(function(input) {
            input.addEventListener('focus', function() {
                const icon = this.parentElement.querySelector('.f-icon');
                if (icon) icon.style.color = '#0053C5';
            });
            input.addEventListener('blur', function() {
                const icon = this.parentElement.querySelector('.f-icon');
                if (icon) icon.style.color = '';
            });
        });
    </script>

</body>

</html>