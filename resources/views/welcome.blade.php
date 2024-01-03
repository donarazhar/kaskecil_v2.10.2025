<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Kas Kecil App - E.Maa v.2.0</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background: url("https://minanews.net/wp-content/uploads/2023/02/Masjid-Agung-Al-Azhar-scaled.jpg") no-repeat center center fixed;
            background-size: cover;
        }
    </style>

</head>

<body>
    <nav class="navbar bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="60" height="48"
                    class="d-inline-block align-text-center rounded-3">
                <b>Aplikasi Kas Kecil v.2.0</b>
            </a>
            <form class="d-flex" role="search">
                <a class="btn btn-md btn-warning text-dark mr-3" href="/panel"><i class="fas fa-lock-open"></i>
                    Login</a>
            </form>
        </div>
    </nav>
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card o-hidden border-bottom-primary shadow-lg my-5">
                <div class="card-header text-center" style="color:rgb(255, 255, 255); background: #0D6EFD;">
                    <h4>Kontrol Kas Kecil</h4>
                </div>
                <div class="car">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                                    Pembentukan Kas</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ 'Rp ' . number_format($total_pembentukan, 0, ',', '.') }}
                                                </div>
                                                <p class="text-gray mt-2">
                                                    Awal Proses
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                                    Pengeluaran Kas</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}
                                                </div>
                                                <p class="text-gray mt-2">
                                                    Bulan ini
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                                    Pengisian Kas</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ 'Rp ' . number_format($total_pengisian ?? 0, 0, ',', '.') }}
                                                </div>
                                                <p class="text-gray mt-2">
                                                    Bulan ini
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                                    Saldo berjalan</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{ 'Rp ' . number_format($total_result ?? 0, 0, ',', '.') }}
                                                </div>
                                                <p class="text-gray mt-2">
                                                    Bulan ini
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <canvas id="myChart" style="height: 20vh;"></canvas>
                            </div>
                            <div class="col-lg-6">
                                <canvas id="myChartpengeluaran" style="height: 20vh;"></canvas>
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
    @push('after-script')
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var matanggaranData = {!! json_encode($matanggaran) !!};

            // Array warna yang berbeda untuk setiap kolom
            var backgroundColors = [
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                // Tambahkan warna lain sesuai kebutuhan
            ];

            var borderColors = backgroundColors.map(color => color.replace('0.2', '1'));

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: matanggaranData.map(data => data.nama_aas),
                    datasets: [{
                        label: 'Saldo Mata Anggaran',
                        data: matanggaranData.map(data => data.saldo),
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    // Ubah nilai pada sumbu Y ke ratusan atau jutaan
                                    if (value >= 1000000) {
                                        return (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return (value / 1000).toFixed(1) + 'K';
                                    } else {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                }
            });
        </script>
        <script>
            var ctx = document.getElementById('myChartpengeluaran').getContext('2d');
            var pengeluaranData = {!! json_encode($pengeluaran) !!};

            // Array warna yang berbeda untuk setiap kolom
            var backgroundColors = [
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                // Tambahkan warna lain sesuai kebutuhan
            ];

            var borderColors = backgroundColors.map(color => color.replace('0.2', '1'));

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: pengeluaranData.map(data => data.nama_aas),
                    datasets: [{
                        label: 'Penggunaan Mata Anggaran',
                        data: pengeluaranData.map(data => data.total_pengeluaran),
                        backgroundColor: backgroundColors,
                        borderColor: borderColors,
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value, index, values) {
                                    // Ubah nilai pada sumbu Y ke ratusan atau jutaan
                                    if (value >= 1000000) {
                                        return (value / 1000000).toFixed(1) + 'M';
                                    } else if (value >= 1000) {
                                        return (value / 1000).toFixed(1) + 'K';
                                    } else {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                }
            });
        </script>


    </body>

    </html>
