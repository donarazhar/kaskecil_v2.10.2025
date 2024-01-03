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
    <style>
        body {
            background: url("https://minanews.net/wp-content/uploads/2023/02/Masjid-Agung-Al-Azhar-scaled.jpg") no-repeat center center fixed;
            background-size: cover;
        }
    </style>

</head>

<body class="bg-gray-600">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card o-hidden border-bottom-primary shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        {{-- <div class="row">
                            <div class="col-lg-12">
                                <div class="px-5 pt-5 text-center">
                                    <span class="text-gray-900 text-lg font-weight-bold text-monospace">
                                        <img src="{{ asset('assets/img/logo.png') }}" alt="" width="120px">
                                    </span>
                                    <hr>
                                </div>
                                <div class="px-5 pt-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-file-invoice" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path
                                                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                    <path d="M9 7l1 0" />
                                                    <path d="M9 13l6 0" />
                                                    <path d="M13 17l2 0" />
                                                </svg>
                                                Buku Kontrol</button>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-file-invoice" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path
                                                        d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                    <path d="M9 7l1 0" />
                                                    <path d="M9 13l6 0" />
                                                    <path d="M13 17l2 0" />
                                                </svg>
                                                Informasi Lain</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-5 pt-4">
                                    <div class="text-center mt-5 mb-4 text-monospace">
                                        <hr>
                                        <p>Aplikasi Kas Kecil Metode Imprest<br>E-Maa V.2.0 by Dal Army</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card border-left-success shadow h-100 py-2">
                                                    <div class="card-body">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div
                                                                    class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                                                    Pembentukan Kas</div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                    {{ 'Rp ' . number_format($total_pembentukan, 0, ',', '.') }}
                                                                </div>
                                                                <p class="text-gray mt-2">
                                                                    Pada Bulan ini
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
                                                                <div
                                                                    class="text-xs font-weight-bold text-black text-uppercase mb-1">
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
                                                                <div
                                                                    class="text-xs font-weight-bold text-black text-uppercase mb-1">
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
                                                                <div
                                                                    class="text-xs font-weight-bold text-black text-uppercase mb-1">
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
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                <!-- Tambahkan kolom untuk grafik -->
                                                <div class="col-lg-12">
                                                    <canvas id="myChart" style="height: 40vh;"></canvas>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                                    label: 'Akun Mata Anggaran',
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
