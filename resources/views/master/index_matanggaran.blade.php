@extends('layoutsberanda.default')
@section('title', 'Master Akun Mata Anggaran')
@section('header-title', 'Master Akun Mata Anggaran')

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
        {{-- Tombol tambah --}}
        <div class="card-body">
            <a href="#" class="btn btn-primary mb-4" id="btnTambahMatanggaran">
                <b>Tambah</b>
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>

            {{-- Data table Anggaran --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">Data Akun Anggaran</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-container">
                            <style>
                                .table-container {
                                    max-height: 400px;
                                    overflow-y: auto;
                                    text-align: center;

                                }
                            </style>
                            <table class="table table-striped table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Mata Anggaran</th>
                                        <th>Nama Akun</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matanggaran as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>{{ $d->kode_matanggaran }}
                                            <td>{{ $d->nama_matanggaran }}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm mb-1 mr-1 d-inline edit" href="#"
                                                    id="{{ $d->id }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Ubah
                                                </a>
                                                <form action="/master/matanggaran/{{ $d->id }}/deletematanggaran"
                                                    method="post" class="d-inline" id="">
                                                    @csrf
                                                    <a class="btn btn-danger btn-sm btn-hapus delete-confirm">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        Hapus
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal input matanggaran --}}
    <div class="modal modal-primary fade" id="modal-frmmatanggaran" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Akun Mata Anggaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card shadow col-lg-12">
                    <div class="card-body">
                        <form action="#" id="frmMatanggaran">
                            @csrf
                            <div class="form-group">
                                <label for="kode_matanggaran">Kode Mata Anggaran</label>
                                <input type="text" name="kode_matanggaran" id="kode_matanggaran" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_matanggaran">Nama Akun Mata Anggaran</label>
                                <select name="kode_aas" id="kode_aas" class="form-select">
                                    <option value="">- Nama Anggaran -</option>
                                    @foreach ($aas as $d)
                                        <option value="{{ $d->kode_aas }}">
                                            {{ $d->kode_aas }} | {{ $d->nama_aas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" id="btnSimpanData">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit matanggaran --}}
    <div class="modal modal-blur fade" id="modal-editmatanggaran" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Akun Mata Anggaran</h5>
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
    <script>
        $(function() {

            // Script mask inputan kode tidak boleh lebih dari 10 angka
            $("#kode_matanggaran").mask('0000000000');

            //Script takan tombol tambah
            $("#btnTambahMatanggaran").click(function() {
                $("#modal-frmmatanggaran").modal("show");
            });

            // Script validasi inputan form
            $("#frmMatanggaran").submit(function() {
                // console.log("Skrip validasi dijalankan");
                var kode_matanggaran = $("#kode_matanggaran").val();
                var kode_aas = $("#namkodes").val();
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
                } else if (kode_aas == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Akun Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#kode_aas").focus();
                    });
                    return false;
                }
            });

            // Proses simpan dengan AJAX
            $("#btnSimpanData").click(function() {
                var kode_matanggaran = $("#kode_matanggaran").val();
                var kode_aas = $("#kode_aas").val();

                $.ajax({
                    type: 'POST',
                    url: '/master/storematanggaran',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_matanggaran: kode_matanggaran,
                        kode_aas: kode_aas
                    },
                    cache: false,
                    success: function(response) {
                        // Tambahkan alert ketika simpan berhasil
                        if (response.status === 'success') {
                            alert('Data berhasil disimpan!');
                        } else {
                            alert('Gagal menyimpan data. Silakan coba lagi.');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Tambahkan alert untuk menangani kesalahan
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });

            // Proses edit dengan AJAX
            // $(".edit").click(function() {
            //     var id = $(this).attr('id');
            //     $.ajax({
            //         type: 'POST',
            //         url: '/master/editaas',
            //         cache: false,
            //         data: {
            //             _token: "{{ csrf_token() }}",
            //             id: id
            //         },
            //         success: function(respond) {
            //             $('#loadeditform').html(respond);
            //         }
            //     });
            //     $("#modal-editAas").modal("show");
            // });

            // Proses delet dengan AJAX
            // $(".delete-confirm").click(function(e) {
            //     var form = $(this).closest('form');
            //     e.preventDefault();
            //     Swal.fire({
            //         title: "Yakin Hapus Data?",
            //         text: "Data anda akan terhapus permanen!",
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonColor: "#3085d6",
            //         cancelButtonColor: "#d33",
            //         confirmButtonText: "Hapus"
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             form.submit();
            //             Swal.fire({
            //                 title: "Terhapus!",
            //                 text: "Data anda berhasil terhapus",
            //                 icon: "success"
            //             });
            //         }
            //     });
            // });

        });
    </script>
@endpush
