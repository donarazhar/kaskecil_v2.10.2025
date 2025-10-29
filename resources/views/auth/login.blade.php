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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Base Styles -->
    <link href="{{ asset('assets/sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #0053C5;
            --primary-dark: #003d91;
            --primary-light: #e8f1fd;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-900: #111827;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8f1fd 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(0, 83, 197, 0.08) 0%, transparent 70%);
            top: -200px;
            right: -200px;
            border-radius: 50%;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(0, 83, 197, 0.05) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
            border-radius: 50%;
            pointer-events: none;
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            background: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow-xl), 0 0 0 1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-card:hover {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
            padding: 48px 40px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.5;
        }

        .logo-wrapper {
            position: relative;
            margin-bottom: 24px;
        }

        .logo-wrapper img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.15));
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .login-title {
            color: var(--white);
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
            position: relative;
        }

        .login-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 15px;
            font-weight: 400;
            position: relative;
        }

        .card-body {
            padding: 40px;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 32px;
        }

        .welcome-text h6 {
            color: var(--gray-900);
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .welcome-text p {
            color: var(--gray-600);
            font-size: 14px;
            margin: 0;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            color: var(--gray-700);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 16px;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            font-size: 15px;
            font-weight: 400;
            color: var(--gray-900);
            background: var(--white);
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control::placeholder {
            color: var(--gray-400);
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(0, 83, 197, 0.1);
        }

        .form-control:focus+.input-icon {
            color: var(--primary-blue);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .text-danger {
            color: #ef4444;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid var(--gray-300);
            border-radius: 6px;
            cursor: pointer;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        .form-check-label {
            color: var(--gray-700);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            user-select: none;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: 12px;
            color: var(--white);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 83, 197, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 83, 197, 0.4);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            margin-right: 8px;
        }

        .login-footer {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--gray-200);
            text-align: center;
        }

        .login-footer p {
            color: var(--gray-600);
            font-size: 13px;
            margin-bottom: 4px;
            line-height: 1.6;
        }

        .login-footer strong {
            color: var(--primary-blue);
            font-weight: 600;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            color: var(--gray-400);
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-200);
        }

        .divider span {
            padding: 0 16px;
        }

        @media (max-width: 576px) {
            .login-container {
                max-width: 100%;
            }

            .card-header {
                padding: 40px 24px 32px;
            }

            .card-body {
                padding: 32px 24px;
            }

            .login-title {
                font-size: 24px;
            }

            .logo-wrapper img {
                width: 70px;
                height: 70px;
            }

            .welcome-text h6 {
                font-size: 18px;
            }
        }

        /* Loading Animation */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-login.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            left: 50%;
            margin-left: -8px;
            margin-top: -8px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Smooth Page Transition */
        .page-transition {
            animation: pageLoad 0.5s ease-out;
        }

        @keyframes pageLoad {
            from {
                opacity: 0;
                filter: blur(10px);
            }

            to {
                opacity: 1;
                filter: blur(0);
            }
        }
    </style>
</head>

<body class="page-transition">

    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <div class="logo-wrapper">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Kas Kecil">
                </div>
                <h1 class="login-title">Kas Kecil App V.2.0</h1>
                <p class="login-subtitle">Sistem Manajemen Keuangan Kas Kecil</p>
            </div>

            <div class="card-body">
                <div class="welcome-text">
                    <h6>Selamat Datang Kembali</h6>
                    <p>Silakan masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <form action="/proseslogin" method="POST" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Alamat Email</label>
                        <div class="input-wrapper">
                            <input type="text"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                autocomplete="email">
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="input-wrapper">
                            <input type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan kata sandi Anda"
                                autocomplete="current-password">
                            <i class="fas fa-lock input-icon"></i>
                        </div>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input type="checkbox"
                            id="remember"
                            class="form-check-input"
                            name="remember">
                        <label for="remember" class="form-check-label">Ingat saya selama 30 hari</label>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk ke Dashboard
                    </button>
                </form>

                <div class="login-footer">
                    <p>Aplikasi Kas Kecil Metode Imprest</p>
                    <p>© 2025 <strong>Masjid Agung Al Azhar</strong></p>
                    <p style="font-size: 12px; margin-top: 8px;">Dikembangkan oleh Dal Army</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/js/sb-admin-2.min.js') }}"></script>
    @include('sweetalert::alert')

    <script>
        // Add loading state on form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn-login');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memproses...';
        });

        // Input focus animation
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.querySelector('.form-label').style.color = 'var(--primary-blue)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.parentElement.querySelector('.form-label').style.color = 'var(--gray-700)';
            });
        });
    </script>

</body>

</html>