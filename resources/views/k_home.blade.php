@extends('layouts.sidebarhome')
@section('title', 'Transaksi')
@section('header-title', 'Data Transaksi')
@section('content')

    <style>
        /* Mengatur tinggi maksimum dan overflow untuk card-body */
        .card-body {
            max-height: 400px;
            overflow-y: auto;
        }

        /* Mengatur lebar tabel menjadi 100% dan memberikan batas di tepi tabel */
        table {
            max-height: 400px;
            overflow-y: auto;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
            /* Menghapus margin bawaan Bootstrap untuk menghindari double margin */
        }

        /* Mengatur lebar kolom-kolom tabel dan properti lainnya */
        th,
        td {
            border: 1px solid #ddd;
            padding: 1px;
            text-align: left;
        }
    </style>
    <!-- Main Content -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-home fa-2x text-white-50"></i> Dashboard Kas Kecil</a>
            </div>

            <!-- Konten Saldo -->
            <div class="row">
                <!-- Pembentukan Kas Kecil -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Pembentukan Kas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ 'Rp ' . number_format($pembentukan->sum('jumlah'), 0, ',', '.') }}
                                    </div>
                                    <p class="text-gray mt-2">
                                        Awal Proses
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pengeluaran Kas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pengeluaran Kas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ 'Rp ' . number_format($pengeluaranbulanini->sum('jumlah'), 0, ',', '.') }}
                                    </div>
                                    <p class="text-gray mt-2">
                                        Bulan ini
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pengisian Kas -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pengisian Kas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ 'Rp ' . number_format($pengisianbulanini->sum('jumlah'), 0, ',', '.') }}
                                    </div>
                                    <p class="text-gray mt-2">
                                        Bulan ini
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Saldo Berjalan -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Saldo berjalan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ 'Rp ' . number_format($saldoberjalan->total_result ?? 0, 0, ',', '.') }}
                                    </div>
                                    <p class="text-gray mt-2">
                                        Bulan ini
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tachometer-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Grafik Anggaran -->
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Mata Anggaran</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">

                            <div class="table-responsive" style="font-size: 14px; line-height:0rem;">
                                <div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered" style="width: 100%;">
                                                <thead>
                                                    <tr role="row">
                                                        <th style="width: auto;">Kode</th>
                                                        <th style="width: auto;">Nama Anggaran</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($matanggaran as $mata)
                                                        <tr class="odd">
                                                            <td class="sorting_1">{{ $mata->kode_matanggaran }}</td>
                                                            <td>{{ $mata->nama_aas }}</td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="chart-area">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="myAreaChart" height="100%" style="display: block;"
                                    class="chartjs-render-monitor"></canvas>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Grafik Pengeluaran Anggaran</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="myPieChart" height="100%" style="display: block;"
                                    class="chartjs-render-monitor"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Rekap Bulanan -->
            <div class="row">

                <!-- Rekap Bulanan -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Rekap Bulan {{ $namaBulan }}
                                {{ $tahunini }} </h6>
                        </div>
                        <div class="card-body">
                            @php
                                $colors = ['bg-success', 'bg-info', 'bg-warning', 'bg-danger', 'bg-primary'];
                            @endphp

                            @foreach ($rekapperbulan as $index => $data)
                                @php
                                    $maxTotalPerbulan = max($rekapperbulan->pluck('total_perbulan')->toArray());
                                    $percentage = $maxTotalPerbulan !== 0 ? ($data->total_perbulan / $maxTotalPerbulan) * 100 : 0;
                                    $progressBarClass = $percentage == 100 ? 'bg-primary' : $colors[$index % count($colors)]; // Pilih warna berdasarkan indeks
                                @endphp

                                <h4 class="small font-weight-bold">{{ $data->nama_aas }}
                                    <span class="float-right">Rp.
                                        {{ number_format($data->total_perbulan, 0, ',', '.') }}</span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar {{ $progressBarClass }}" role="progressbar"
                                        style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Datatables Perbulan --}}
                <div class="col-lg-6 mb-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Datatables Bulan
                                {{ $namaBulan }}
                                {{ $tahunini }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="font-size: 14px; line-height:1rem;">
                                <table class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tgl</th>
                                            <th>Akun AAS</th>
                                            <th>Mata Anggaran</th>
                                            <th>Nama Akun</th>
                                            <th>Perincian</th>
                                            <th>Status</th>
                                            <th>Jumlah (Rp)</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @forelse ($pengeluaranbulanini as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}.</td>
                                                <td>{{ \Carbon\Carbon::parse($d->tanggal)->isoFormat('DD/MM/YYYY') }}
                                                </td>
                                                <td>{{ $d->kode_aas }}</td>
                                                <td>{{ $d->kode_matanggaran }}</td>
                                                <td>{{ $d->nama_aas }}</td>
                                                <td>{{ $d->perincian }}</td>
                                                <td>
                                                    @if ($d->status == 'k')
                                                        Kredit
                                                    @elseif ($d->status == 'd')
                                                        Debet
                                                    @endif
                                                </td>
                                                <td>{{ number_format($d->jumlah, 0, ',', '.') }}</td>
                                                @php
                                                    $total += $d->jumlah;
                                                @endphp
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="7" class="text-center"><b>Pengeluaran Perbulan</b></th>
                                            <th colspan="2" class="text-center">
                                                <b>{{ number_format($pengeluaranbulanini->sum('jumlah'), 0, ',', '.') }}
                                                </b>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- History Pengisian --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">History Pengisian Kas</h6>
                        </div>
                        <div class="row my-2 mx-2">
                            @foreach ($combinedData as $data)
                                @if (is_object($data))
                                    <!-- Add a check to ensure $data is an object -->
                                    <div class="col-xl-3 col-md-3 mb-4">
                                        <div class="card bg-primary text-white shadow">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto mr-2">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div>
                                                    <div class="col mr-1">
                                                        Pengisian Kas
                                                        <div class="text-white-50 small">
                                                            @if (isset($data->tanggal))
                                                                {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('DD/MM/YYYY') }}<br>
                                                            @endif
                                                            @if (isset($data->perincian))
                                                                {{ $data->perincian }}
                                                            @endif
                                                        </div>
                                                        <div class="text-white large">
                                                            {{ 'Rp ' . number_format($data->jumlah ?? 0, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        @if (isset($data->id_pengisian))
                                                            @if (DB::table('transaksi')->where('id_pengisian', $data->id_pengisian)->exists())
                                                                <span href="" class="badge bg-success">Sudah
                                                                    Cair</span>
                                                            @elseif (DB::table('transaksi_shadow')->where('id_pengisian', $data->id_pengisian)->exists())
                                                                <span class="badge bg-danger">Belum Cair</span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach


                        </div>
                        <div class="pagination justify-content-center">
                            {{ $combinedData->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->


@endsection

@push('after-style')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('after-script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

    <script>
        var ctx = document.getElementById('myAreaChart').getContext('2d');
        var matanggaranData = <?php echo json_encode($matanggaran);
        ?>;
        var backgroundColors = [
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(54, 162, 235, 0.2)',
        ];

        var borderColors = backgroundColors.map(color => color.replace('0.2', '1'));

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: matanggaranData.map(data => data.kode_matanggaran),
                datasets: [{
                    label: 'Saldo Anggaran',
                    data: matanggaranData.map(data => data.saldo),
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                // Ubah nilai pada sumbu Y ke ratusan atau jutaan
                                if (value >= 1000000) {
                                    return (value / 1000000).toFixed(1) + 'J';
                                } else if (value >= 1000) {
                                    return (value / 1000).toFixed(1) + 'R';
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
        var ctxPie = document.getElementById('myPieChart').getContext('2d');
        var pengeluaranData = <?php echo json_encode($pengeluaranbulanini); ?>;

        var backgroundColors = [
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            // Tambahkan warna lain sesuai kebutuhan
        ];

        var borderColors = backgroundColors.map(color => color.replace('0.2', '1'));

        var myPieChart = new Chart(ctxPie, {
            type: 'bar',
            data: {
                labels: pengeluaranData.map(data => data.kode_matanggaran),
                datasets: [{
                    label: 'Pengeluaran',
                    data: pengeluaranData.map(data => data.jumlah),
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                // Ubah nilai pada sumbu Y ke ratusan atau jutaan
                                if (value >= 1000000) {
                                    return (value / 1000000).toFixed(1) + 'J';
                                } else if (value >= 1000) {
                                    return (value / 1000).toFixed(1) + 'R';
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
