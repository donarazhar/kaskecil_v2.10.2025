<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login Al Azhar Petty Cash System (APCS) Metode Imprest">
    <link rel="shortcut icon" href="https://siap.al-azhar.id/upload/favicon.ico" type="image/x-icon">
    <title>Login - Al Azhar Petty Cash System</title>

    <link href="{{ asset('assets/sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --blue:      #0053C5;
            --blue-dark: #003d91;
            --blue-50:   #eff6ff;
            --blue-100:  #dbeafe;
            --white:     #ffffff;
            --gray-50:   #f9fafb;
            --gray-100:  #f3f4f6;
            --gray-200:  #e5e7eb;
            --gray-300:  #d1d5db;
            --gray-400:  #9ca3af;
            --gray-500:  #6b7280;
            --gray-600:  #4b5563;
            --gray-700:  #374151;
            --gray-900:  #111827;
            --danger:    #ef4444;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            background-color: var(--gray-50);
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(0, 83, 197, 0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 80% 100%, rgba(0, 83, 197, 0.04) 0%, transparent 60%);
            -webkit-font-smoothing: antialiased;
        }

        /* ─── CARD ─── */
        .card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--gray-100);
            box-shadow:
                0 0 0 1px rgba(0,0,0,0.03),
                0 4px 6px -2px rgba(0,0,0,0.04),
                0 20px 40px -8px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 420px;
            padding: 40px 36px 36px;
            animation: rise 0.45s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ─── HEADER ─── */
        .card-top {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-box {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: var(--blue-50);
            border: 1.5px solid var(--blue-100);
            margin: 0 auto 20px;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 83, 197, 0.1);
        }

        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .card-top h1 {
            font-size: 22px;
            font-weight: 700;
            color: var(--gray-900);
            letter-spacing: -0.4px;
            margin-bottom: 6px;
        }

        .card-top p {
            font-size: 14px;
            color: var(--gray-500);
            line-height: 1.55;
        }

        /* ─── ALERT ─── */
        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .alert i { color: var(--danger); font-size: 14px; flex-shrink: 0; margin-top: 1px; }
        .alert span { font-size: 13px; color: #991b1b; line-height: 1.5; }

        /* ─── FORM ─── */
        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 7px;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 14px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrap input {
            width: 100%;
            padding: 11px 42px 11px 38px;
            font-size: 14px;
            font-family: inherit;
            color: var(--gray-900);
            background: var(--white);
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            appearance: none;
            -webkit-appearance: none;
        }

        .input-wrap input::placeholder { color: var(--gray-400); font-weight: 400; }

        .input-wrap input:hover { border-color: var(--gray-300); }

        .input-wrap input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(0, 83, 197, 0.1);
        }

        .input-wrap input:focus ~ .input-icon { color: var(--blue); }

        .input-wrap input.is-error { border-color: var(--danger); }
        .input-wrap input.is-error:focus { box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }

        .err-msg {
            margin-top: 5px;
            font-size: 12px;
            color: var(--danger);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Toggle PW button */
        .btn-eye {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            color: var(--gray-400);
            font-size: 14px;
            line-height: 1;
            transition: color 0.2s;
        }
        .btn-eye:hover { color: var(--gray-600); }

        /* ─── REMEMBER ─── */
        .row-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .row-check input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: var(--blue);
            cursor: pointer;
            border-radius: 4px;
        }

        .row-check label {
            font-size: 13px;
            color: var(--gray-500);
            cursor: pointer;
        }

        /* ─── SUBMIT ─── */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--blue);
            color: var(--white);
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.1px;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(0, 83, 197, 0.25);
        }

        .btn-submit:hover {
            background: var(--blue-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(0, 83, 197, 0.3);
        }

        .btn-submit:active { transform: translateY(0); }

        /* ─── FOOTER ─── */
        .card-foot {
            text-align: center;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-100);
        }

        .card-foot p {
            font-size: 12px;
            color: var(--gray-400);
            line-height: 1.8;
        }

        .card-foot strong { color: var(--gray-500); font-weight: 500; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 480px) {
            .card { padding: 32px 22px 28px; border-radius: 16px; }
            .card-top h1 { font-size: 20px; }
            .logo-box { width: 64px; height: 64px; border-radius: 16px; }
        }

        @media (min-width: 768px) {
            .card { max-width: 440px; }
        }
    </style>
</head>

<body>

    <div class="card">

        <!-- Header -->
        <div class="card-top">
            <div class="logo-box">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo APCS">
            </div>
            <h1>Selamat Datang</h1>
            <p>Silakan masuk ke akun Anda untuk<br>mengakses aplikasi APCS</p>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
            <div class="alert">
                <i class="fas fa-exclamation-circle"></i>
                <span>
                    @foreach ($errors->all() as $err)
                        {{ $err }}<br>
                    @endforeach
                </span>
            </div>
        @endif

        <!-- Form -->
        <form action="/proseslogin" method="POST" novalidate id="loginForm">
            @csrf

            <div class="field">
                <label for="email">Alamat Email</label>
                <div class="input-wrap">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="@error('email') is-error @enderror"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        autocomplete="email">
                    <i class="fas fa-envelope input-icon"></i>
                </div>
                @error('email')
                    <span class="err-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password">Kata Sandi</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="@error('password') is-error @enderror"
                        placeholder="Masukkan kata sandi Anda"
                        autocomplete="current-password">
                    <i class="fas fa-lock input-icon"></i>
                    <button type="button" class="btn-eye" id="togglePw" aria-label="Tampilkan kata sandi">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password')
                    <span class="err-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</span>
                @enderror
            </div>

            <div class="row-check">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-submit" id="btnSubmit">
                <i class="fas fa-sign-in-alt"></i>
                Masuk ke Dashboard
            </button>
        </form>

        <!-- Footer -->
        <div class="card-foot">
            <p>Al Azhar Petty Cash System (APCS) V.2.10.2025 &mdash; Metode Imprest</p>
            <p>© 2025 <strong>Masjid Agung Al Azhar</strong></p>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @include('sweetalert::alert')

    <script>
        // Toggle password
        const pwInput  = document.getElementById('password');
        const eyeIcon  = document.getElementById('eyeIcon');

        document.getElementById('togglePw').addEventListener('click', function () {
            const show = pwInput.type === 'password';
            pwInput.type = show ? 'text' : 'password';
            eyeIcon.classList.toggle('fa-eye',      !show);
            eyeIcon.classList.toggle('fa-eye-slash', show);
        });

        // Loading state on submit
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memproses...';
        });

        // Icon color on focus
        document.querySelectorAll('.input-wrap input').forEach(function (el) {
            el.addEventListener('focus', function () {
                var ic = this.parentElement.querySelector('.input-icon');
                if (ic) ic.style.color = '#0053C5';
            });
            el.addEventListener('blur', function () {
                var ic = this.parentElement.querySelector('.input-icon');
                if (ic) ic.style.color = '';
            });
        });
    </script>

</body>

</html>