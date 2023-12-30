@extends('layoutsberanda.default')
@section('title', 'Data Pemasukan')
@section('header-title', 'Data Pemasukan')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- <a href="{{ route('transaksi.pemasukan.create') }}" class="btn btn-success mb-4"> --}}
            <a href="{{ route('transaksi.pemasukan.create') }}" class="btn btn-primary mb-4">
                <b>Tambah</b>
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
            {{-- <form action="{{route('transaksi.cari')}}" method="GET"> --}}
            <form action="" method="GET">
                <input type="hidden" name="kategori" value="pemasukan">
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
            <h6 class="m-0 font-weight-bold text-black">Data Pemasukan</h6>
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
                            <th>Jumlah (Rp)</th>
                            @can('isAdminOrBendahara', App\Transaksi::class)
                                <th>Tindakan</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $item->created_at->isoFormat('DD/MM/YYYY HH:mm:ss') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM YYYY') }}</td>
                                <td>{!! $item->perincian !!}</td>
                                <td>{{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                @can('isAdminOrBendahara', App\Transaksi::class)
                                    <td>
                                        <a class="btn btn-info btn-sm mb-1 mr-1 d-inline"
                                            href="{{ route('transaksi.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Ubah
                                        </a>
                                        <form action="{{ route('transaksi.destroy', $item->id) }}" method="post"
                                            class="d-inline" id="{{ 'form-hapus-transaksi-' . $item->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm btn-hapus" data-id="{{ $item->id }}"
                                                data-jumlah="{{ 'Rp ' . number_format($item->jumlah, 2, ',', '.') }}"
                                                type="submit">
                                                <i class="fas fa-trash">
                                                </i>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                @endcan
                                @php
                                    $total += $item->jumlah;
                                @endphp
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-center"><b>Total</b></th>
                            <th colspan="2"><b>{{ 'Rp ' . number_format($total, 2, ',', '.') }}</b></th>
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
    {{-- @include('sweetalert::alert') --}}
    <script>
        $('.btn-hapus').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let form = $('#form-hapus-transaksi-' + id);
            let jumlah = $(this).data('jumlah');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Pemasukan sebesar ' + jumlah + ' akan dihapus',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#5bc0de',
                confirmButtonColor: '#d9534f ',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            })

        });
    </script>
@endpush
