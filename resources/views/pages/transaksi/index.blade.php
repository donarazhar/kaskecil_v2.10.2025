@extends('layoutsberanda.default')
@section('title', 'Data Transaksi')
@section('header-title', 'Data Transaksi')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- <form action="{{ route('transaksi.cari') }}" method="GET"> --}}
            <form action="" method="GET">
                <input type="hidden" name="kategori" value="transaksi">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="">Tanggal Awal</label>
                        <input type="date" class="form-control @error('tanggal_awal') is-invalid @enderror"
                            name="tanggal_awal" value="{{ old('tanggal_awal') }}">
                        @error('tanggal_awal')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Tanggal Akhir</label>
                        <input type="date" class="form-control @error('tanggal_akhir') is-invalid @enderror"
                            name="tanggal_akhir" value="{{ old('tanggal_akhir') }}">
                        @error('tanggal_akhir')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><b>Cari</b></button>
            </form>
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
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Input Data</th>
                            <th>Tanggal</th>
                            <th>Perincian</th>
                            <th>Pemasukan (Rp)</th>
                            <th>Pengeluaran (Rp)</th>
                            <th>Saldo (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_pemasukan = 0;
                            $total_pengeluaran = 0;
                        @endphp
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $item->created_at->isoFormat('DD/MM/YYYY HH:mm:ss') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM YYYY') }}</td>

                                <td>{!! $item->perincian !!}</td>
                                <td>
                                    @if ($item->kategori == 'pemasukan')
                                        {{ number_format($item->jumlah, 2, ',', '.') }}
                                        @php
                                            $total_pemasukan += $item->jumlah;
                                        @endphp
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if ($item->kategori == 'pengeluaran')
                                        {{ number_format($item->jumlah, 2, ',', '.') }}
                                        @php
                                            $total_pengeluaran += $item->jumlah;
                                        @endphp
                                    @else
                                    @endif
                                </td>
                                <td>{{ number_format($item->saldo->total, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-center"><b>Total</b></th>
                            <th><b>{{ 'Rp ' . number_format($total_pemasukan, 2, ',', '.') }}</b></th>
                            <th colspan="2"><b>{{ 'Rp ' . number_format($total_pengeluaran, 2, ',', '.') }}</b></th>
                        </tr>
                    </tfoot>
                </table>
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
