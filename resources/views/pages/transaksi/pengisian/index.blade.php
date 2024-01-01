@extends('layoutsberanda.default')
@section('title', 'Pengisian Kas Kecil')
@section('header-title', 'Pengisian Kas Kecil')

@section('content')
    <div class="card shadow">
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

        {{-- Tombol tambah --}}
        <div class="card-body">
            <a href="#" class="btn btn-primary" id="btnTambahPengisian">
                <b>Tambah</b>
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    {{-- Data Table Pengisian Kas Kecil --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-black">Pengisian Kas Kecil</h6>
        </div>
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
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @forelse ($pengisian as $d)
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
                                <td>
                                    <a class="btn btn-info btn-sm mb-1 mr-1 d-inline edit" href="#"
                                        id="{{ $d->id }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                    <form action="{{ route('transaksi.destroy', $d->id) }}" method="post" class="d-inline"
                                        id="">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-danger btn-sm delete-confirm" data-id="{{ $d->id }}"
                                            type="submit">
                                            <i class="fas fa-trash">
                                            </i>
                                        </a>
                                    </form>
                                </td>
                                @php
                                    $total += $d->jumlah;
                                @endphp
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Input Pengisian Kas Kecil --}}
    <div class="modal modal-blur fade" id="modal-frmpengisian" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengisian Kas Kecil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card shadow col-lg-12">
                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="post" id="frmpengisian">
                            @csrf
                            <div class="form-group">
                                <label for="nama_matanggaran">Mata Anggaran</label>
                                <select name="kode_matanggaran" id="kode_matanggaran" class="form-select">
                                    <option value="">- Akun Mata Anggaran -</option>
                                    @foreach ($matanggaran as $d)
                                        @if ($d->status == 'k' && $d->kategori == 'pengisian')
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
                            <input type="hidden" name="kategori" id="kategori" value="pengisian">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="perincian">Perincian</label>
                                <textarea name="perincian" rows="3" id="perincian" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Pengisian Kas Kecil --}}
    <div class="modal modal-blur fade" id="modal-editpengisian" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengisian Kas Kecil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">
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

    <script>
        $(function() {
            $('#jumlah').mask('00.000.000', {
                reverse: true
            });
            //Script takan tombol tambah
            $("#btnTambahPengisian").click(function() {
                // alert('test');
                $("#modal-frmpengisian").modal("show");
            });

            // Script validasi inputan form
            $("#frmpengisian").submit(function() {
                var kode_matanggaran = $("#kode_matanggaran").val();
                var jumlah = $("#jumlah").val();
                var tanggal = $("#tanggal").val();
                var perincian = $("#perincian").val();
                if (kode_matanggaran == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Akun Mata Anggaran Harus Diisi',
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
                    url: '/transaksi/pengisian/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $('#loadeditform').html(respond);
                    }
                });
                $("#modal-editpengisian").modal("show");
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
