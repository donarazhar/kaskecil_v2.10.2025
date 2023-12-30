@extends('layoutsberanda.default')
@section('title', 'Beranda')
@section('header-title', 'Beranda')

@section('content')
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                Saldo</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ 'Rp ' . number_format($saldo->total ?? 0, 2, ',', '.') }}</div>
                            <p class="text-gray mt-2">
                                {{ $tanggal }}
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                Pemasukan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ 'Rp ' . number_format($jumlah_pemasukan, 2, ',', '.') }}</div>
                            <p class="text-gray mt-2">
                                Bulan ini
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-black text-uppercase mb-1">
                                Pengeluaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ 'Rp ' . number_format($jumlah_pengeluaran, 2, ',', '.') }}</div>
                            <p class="text-gray mt-2">
                                Bulan ini
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">10 Transaksi Terakhir</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Perincian</th>
                            <th>Pemasukan (Rp)</th>
                            <th>Pengeluaran (Rp)</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $jumlah_pemasukan = 0;
                            $jumlah_pengeluaran = 0;
                        @endphp
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM YYYY') }}</td>
                                <td>{!! $item->perincian !!}</td>
                                <td>
                                    @if ($item->kategori == 'pemasukan')
                                        {{ 'Rp ' . number_format($item->jumlah, 2, ',', '.') }}
                                        @php
                                            $jumlah_pemasukan += $item->jumlah;
                                        @endphp
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if ($item->kategori == 'pengeluaran')
                                        {{ number_format($item->jumlah, 2, ',', '.') }}
                                        @php
                                            $jumlah_pengeluaran += $item->jumlah;
                                        @endphp
                                    @else
                                    @endif
                                </td>
                                <td>{{ number_format($item->saldo->total, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data untuk saat ini</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
@push('after-script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
@endpush
