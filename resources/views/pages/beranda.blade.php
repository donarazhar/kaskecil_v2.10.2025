@extends('layouts.sidebar')
@section('title', 'Beranda')
@section('header-title', 'Beranda')
@section('content')
    <div class="card shadow mb-4">
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
                                        {{ 'Rp ' . number_format($total_pembentukan, 0, ',', '.') }}</div>
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
                                    <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                        Pengeluaran Kas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</div>
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
                                        {{ 'Rp ' . number_format($total_pengisian ?? 0, 0, ',', '.') }}</div>
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
                                        {{ 'Rp ' . number_format($total_result ?? 0, 0, ',', '.') }}</div>
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
@endsection
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
@endpush
