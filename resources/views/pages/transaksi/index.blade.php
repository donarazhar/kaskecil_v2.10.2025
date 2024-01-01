@extends('layoutsberanda.default')
@section('title', 'Transaksi')
{{-- @section('header-title', 'Data Transaksi') --}}

@section('content')
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
                            <th rowspan="2"style="vertical-align: middle;">Akun AAS</th>
                            <th rowspan="2"style="vertical-align: middle;">Mata Anggaran</th>
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
                            <th colspan="4" class="text-center"><b>Total</b></th>
                            <th><b>{{ 'Rp ' . number_format($total_pengeluaran, 0, ',', '.') }}</b></th>
                            <th><b>{{ 'Rp ' . number_format($total_pengisian, 0, ',', '.') }}</b></th>
                            <th colspan="2"><b>{{ 'Rp ' . number_format($total_result, 0, ',', '.') }}</b>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
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
@endpush
