@extends('layoutsberanda.default')
@section('title', 'Beranda')
@section('header-title', 'Beranda')

@section('content')
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
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (session()->has('info'))
                    <div class="alert alert-info">
                        {{ session()->get('info') }}
                    </div>
                @endif
                <table class="table table-striped table-bordered" id="dataTable" style="text-align: center;">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">No.</th>
                            <th rowspan="2" style="vertical-align: middle;">Tgl</th>
                            <th rowspan="2"style="vertical-align: middle;">Akun AAS</th>
                            <th rowspan="2"style="vertical-align: middle;">Mata Anggran</th>
                            <th rowspan="2"style="vertical-align: middle;">Perincian</th>
                            <th colspan="2">Besaran (Rp)</th>
                            <th rowspan="2"style="vertical-align: middle;">Saldo Awal (Rp)</th>
                        </tr>
                        <tr>
                            <th>Debet</th>
                            <th>Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                <td>{{ $item->kode_aas }}</td>
                                <td>{{ $item->kode_matanggaran }}</td>
                                <td>{!! $item->perincian !!}</td>
                                <td>
                                    @if ($item->status == 'd' && $item->kategori == 'pengeluaran')
                                        {{ number_format($item->jumlah, 0, ',', '.') }}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 'k' && $item->kategori == 'pengisian')
                                        {{ number_format($item->jumlah, 0, ',', '.') }}
                                    @else
                                    @endif
                                </td>
                                <td><b>
                                        @if ($item->status == 'k' && $item->kategori == 'pembentukan')
                                            {{ number_format($item->jumlah, 0, ',', '.') }}
                                        @else
                                        @endif
                                    </b>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="7"></th>
                            <th colspan="1">Saldo Berjalan (Rp)</th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-center"><b>Total</b></th>
                            <th><b>{{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</b></th>
                            <th><b>{{ 'Rp ' . number_format($total_pengisian, 0, ',', '.') }}</b></th>
                            <th colspan="2"><b>{{ 'Rp ' . number_format($total_result, 0, ',', '.') }}</b></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>





@endsection
@push('after-script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
@endpush
