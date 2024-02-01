@extends('layouts.sidebar')
@section('title', 'Pengeluaran')
@section('header-title', 'Pengeluaran Kas Kecil')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-black">Pengeluaran Kas Kecil</h6>
        </div>
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
            <div class="row">
                <div class="col-lg-3 form-group">
                    @if (Auth::user()->level == 'admin')
                        <a href="#" class="btn btn-primary w-100 form-group" id="btnTambahPengeluaran">
                            Tambah Data
                        </a>
                    @endif
                </div>
                <div class="col-lg-9">
                    <form action="{{ url('/transaksi/pengeluaran') }}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select name="bulan" id="bulan" class="form-select form-control"
                                        onchange="this.form.submit()">
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}"
                                                {{ ($bulan ?? date('m')) == $i ? 'selected' : '' }}>
                                                {{ $namabulan[$i] }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select name="tahun" id="tahun" class="form-select form-control"
                                        onchange="this.form.submit()">
                                        @for ($tahun = 2023; $tahun <= date('Y'); $tahun++)
                                            <option value="{{ $tahun }}"
                                                {{ ($tahun ?? date('Y')) == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <button type="submit" name="tampilkan" class="btn btn-primary w-100">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            // Mendapatkan nilai bulan dan tahun dari URL
            var urlParams = new URLSearchParams(window.location.search);
            var selectedBulan = urlParams.get('bulan');
            var selectedTahun = urlParams.get('tahun');
            // Mengatur nilai opsi pada dropdown bulan
            document.getElementById('bulan').value = selectedBulan;
            // Mengatur nilai opsi pada dropdown tahun
            document.getElementById('tahun').value = selectedTahun;
        </script>
        {{-- Data Table Pengeluaran Kas Kecil --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center" id="dataTable">
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
                            <th>Lamp</th>
                            @if (Auth::user()->level == 'admin')
                                <th>Tindakan</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @forelse ($pengeluaranbulanini as $d)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ \Carbon\Carbon::parse($d->tanggal)->isoFormat('DD/MM/YYYY') }}</td>
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
                                <td><a class="btn btn-primary btn-sm mb-1 mr-1 d-inline lihat" href="#"
                                        id="{{ $d->id }}">
                                        <i class="fas fa-search">
                                        </i>
                                    </a></td>

                                @if (Auth::user()->level == 'admin')
                                    <td>
                                        <a class="btn btn-primary btn-sm mb-1 mr-1 d-inline edit" href="#"
                                            id="{{ $d->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                        </a>
                                        <form action="/transaksi/hapuspengeluaran/{{ $d->id }}" method="post"
                                            class="d-inline" id="">
                                            @csrf
                                            <a class="btn btn-danger btn-sm delete-confirm" data-id="{{ $d->id }}"
                                                type="submit">
                                                <i class="fas fa-trash">
                                                </i>
                                            </a>
                                        </form>
                                    </td>
                                @endif
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
                                <b>{{ number_format($totalpengeluaran->total_pengeluaran, 0, ',', '.') }}
                                </b>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Input Pengeluaran Kas Kecil --}}
    <div class="modal modal-blur fade" id="modal-frmpengeluaran" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="card-header bg-primary">
                        <h6 class="m-0 font-weight-bold text-light">Pengeluaran Kas Kecil</h6>
                    </div>
                </div>
                <div class="card shadow col-lg-12">
                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="post" id="frmpengeluaran"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_matanggaran">Mata Anggaran</label>
                                <select name="kode_matanggaran" id="kode_matanggaran" class="form-select form-control">
                                    <option value="">- Akun Mata Anggaran -</option>
                                    @foreach ($matanggaran as $d)
                                        @if ($d->status == 'd' && $d->kategori == 'pengeluaran')
                                            <option value="{{ $d->kode_matanggaran }}">
                                                {{ $d->kode_matanggaran }} | {{ $d->nama_aas }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" name="jumlah" id="jumlah" class="form-control">
                            </div>
                            <input type="hidden" name="kategori" id="kategori" value="pengeluaran">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="perincian">Perincian</label>
                                <textarea name="perincian" rows="3" id="perincian" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="lampiran">Lampiran</label>
                                <input class="form-control" id="lampiran" name="lampiran" type="file"
                                    onchange="previewImage('lampiran', 'preview-image1', 'preview-container1')">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" id="lampiran2" name="lampiran2" type="file"
                                    onchange="previewImage('lampiran2', 'preview-image2', 'preview-container2')">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control" id="lampiran3" name="lampiran3" type="file"
                                    onchange="previewImage('lampiran3', 'preview-image3', 'preview-container3')">
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div id="preview-container1"
                                        style="display: none; justify-content: center; align-items: center; margin-top: 10px;">
                                        <img id="preview-image1" style="width: 100%;"
                                            src="{{ asset('assets/img/preview.png') }}" alt="Preview" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="preview-container2"
                                        style="display: none; justify-content: center; align-items: center; margin-top: 10px;">
                                        <img id="preview-image2" style="width: 100%;"
                                            src="{{ asset('assets/img/preview.png') }}" alt="Preview" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="preview-container3"
                                        style="display: none; justify-content: center; align-items: center; margin-top: 10px;">
                                        <img id="preview-image3" style="width: 100%;"
                                            src="{{ asset('assets/img/preview.png') }}" alt="Preview" />
                                    </div>
                                </div>
                            </div>

                            <script>
                                function previewImage(inputId, previewImageId, previewContainerId) {
                                    const input = document.getElementById(inputId);
                                    const previewContainer = document.getElementById(previewContainerId);
                                    const previewImage = document.getElementById(previewImageId);

                                    const file = input.files[0];

                                    if (file) {
                                        const reader = new FileReader();

                                        reader.onload = function(e) {
                                            previewImage.src = e.target.result;
                                            previewContainer.style.display = 'flex';
                                        };

                                        reader.readAsDataURL(file);
                                    } else {
                                        previewImage.src = '{{ asset('assets/img/preview.png') }}';
                                        previewContainer.style.display = 'none';
                                    }
                                }
                            </script>

                            <button type="submit" class="btn btn-primary btn-block mt-2">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Pengeluaran Kas Kecil --}}
    <div class="modal modal-blur fade" id="modal-editpengeluaran" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="card-header bg-primary">
                        <h6 class="m-0 font-weight-bold text-light">Edit Pengeluaran Kas Kecil</h6>
                    </div>
                </div>
                <div class="modal-body" id="loadeditform">
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Lihat Lampiran --}}
    <div class="modal modal-blur fade" id="modal-lihatlampiran" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="card-header bg-primary">
                        <h6 class="m-0 font-weight-bold text-light">Lampiran</h6>
                    </div>
                </div>
                <div class="modal-body" id="loadeditformlihat">
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
            $('#jumlah').mask('00.000.000', {
                reverse: true
            });

            //Script takan tombol tambah
            $("#btnTambahPengeluaran").click(function() {
                // alert('test');
                $("#modal-frmpengeluaran").modal("show");
            });

            // Script validasi inptuan form
            $("#frmpengeluaran").submit(function() {
                var kode_matanggaran = $("#kode_matanggaran").val();
                var jumlah = $("#jumlah").val();
                var tanggal = $("#tanggal").val();
                var perincian = $("#perincian").val();
                if (kode_matanggaran == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Kode Mata Anggaran Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#kode_matanggaran").focus();
                    });
                    return false;
                } else if (jumlah == "") {
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

            // Proses edit dengan AJAX
            $(".edit").click(function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '/transaksi/pengeluaran/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $('#loadeditform').html(respond);
                    }
                });
                $("#modal-editpengeluaran").modal("show");
            });

            // Proses lihat dengan AJAX
            $(".lihat").click(function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '/transaksi/pengeluaran/lihat',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $('#loadeditformlihat').html(respond);
                    }
                });
                $("#modal-lihatlampiran").modal("show");
            });

            // Proses delete dengan AJAX
            $(".delete-confirm").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: "Yakin Hapus Data?",
                    text: "Data anda akan terhapus permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            title: "Terhapus!",
                            text: "Data anda berhasil terhapus",
                            icon: "success"
                        });
                    }
                });
            });



        });
    </script>
@endpush
