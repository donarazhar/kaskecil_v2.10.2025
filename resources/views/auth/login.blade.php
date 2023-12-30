<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kas Kecil App - E.Maa v.2.0 | Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">
    <style>
        body {
            background: url("https://minanews.net/wp-content/uploads/2023/02/Masjid-Agung-Al-Azhar-scaled.jpg") no-repeat center center fixed;
            background-size: cover;
        }
    </style>

</head>

<body class="bg-gray-300">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card o-hidden border-bottom-primary shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="px-5 pt-5 text-center">
                                    <span class="text-gray-900 text-lg font-weight-bold text-monospace"><img
                                            src="{{ asset('assets/img/logo.png') }}" alt=""
                                            width="120px"></span>
                                </div>
                                <div class="px-5 pt-4">
                                    <div class="text-center mb-2">
                                        <span class="text-gray-900 text-lg font-weight-bold text-monospace">Silahkan
                                            Login !!!</span>
                                        <hr>
                                    </div>
                                    <form action="/proseslogin" method="post" autocomplete="off" novalidate>
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Masukkan Email</label>
                                            <input type="text" name="email" id="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" style="border-radius: 2rem"
                                                autocomplete="off">
                                            @error('email')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Masukkan Password</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                style="border-radius: 2rem">
                                            @error('password')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input type="checkbox" id="remember" class="form-check-input"
                                                        name="remember">
                                                    <label for="remember" class="form-check-label">
                                                        Ingat saya
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-lg btn-primary btn-block">Masuk</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center mt-5 mb-4 text-monospace">
                                        <hr>
                                        <p>Aplikasi Kas Kecil Metode Imprest<br>E-Maa V.2.0 by Dal Army</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    @include('sweetalert::alert')

</body>

</html>
