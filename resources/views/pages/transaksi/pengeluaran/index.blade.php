@extends('layoutsberanda.default')
@section('title', 'Data Pengeluaran')
@section('header-title', 'Data Pengeluaran')

@section('content')
    <div class="card shadow mb-4">
        {{-- Pesan error --}}
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::get('warning'))
            <div class="alert alert-warning">
                {{ Session::get('warning') }}
            </div>
        @endif
        <div class="card-body">
            <a href="#" class="btn btn-primary mb-4" id="btnTambahPengeluaran">
                <b>Tambah</b>
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>

            {{-- Form cari pemasukan --}}
            <form action="" method="GET">
                <input type="hidden" name="kategori" value="pengeluaran">
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

    {{-- Data table pemasukan --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Data Pengeluaran</h6>
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
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @forelse ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD/MM/YYYY HH:mm:ss') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM YYYY') }}</td>
                                <td>{!! $item->perincian !!}</td>
                                <td>{{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm d-inline mr-1 mb-1" href="">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Ubah
                                    </a>
                                    <form action="" method="post" class="d-inline"
                                        id="{{ 'form-hapus-transaksi-' . $item->id }}">
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

    {{-- Modal input pengeluaran --}}
    <div class="modal modal-blur fade" id="modal-frmpengeluaran" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card shadow col-lg-12">
                    <div class="card-body">

                        <form action="{{ route('transaksi.store') }}" method="post" id="frmpengeluaran">
                            @csrf
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" name="jumlah" id="jumlah" class="form-control">
                            </div>
                            <input type="hidden" name="kategori" value="pengeluaran">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal"
                                    class="form-control @error('tanggal') is-invalid @enderror"
                                    value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="perincian">Perincian</label>
                                <textarea name="perincian" rows="3" id="perincian" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>

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
    {{-- @include('sweetalert::alert') --}}
    <script>
        $(function() {
            // Validasi Juery Mask
            $('#jumlah').mask('000.000.000', {
                reverse: true
            });

            //Script takan tombol tambah
            $("#btnTambahPengeluaran").click(function() {
                // alert('test');
                $("#modal-frmpengeluaran").modal("show");
            });

            // Script validasi inpuan form
            $("#frmpengeluaran").submit(function() {
                var jumlah = $("#jumlah").val();
                var tanggal = $("#tanggal").val();
                var perincian = $("#perincian").val();
                if (jumlah == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Jumlah Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#jumlah").focus();
                    });
                    return false;
                } else if (tanggal == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Tanggal Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#tanggal").focus();
                    });
                    return false;
                } else if (perincian == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Perincian Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#perincian").focus();
                    });
                    return false;
                }
            });

        });
    </script>
@endpush
