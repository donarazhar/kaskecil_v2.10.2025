@extends('layoutsberanda.default')
@section('title', 'Master Akun AAS')
@section('header-title', 'Master Akun AAS')

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
            <a href="#" class="btn btn-primary mb-4" id="btnTambahAas">
                <b>Tambah</b>
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>

            {{-- Data table Aas --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">Data Akun AAS</h6>
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
                                        <th>Kode AAS</th>
                                        <th>Nama Akun</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aas as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}.</td>
                                            <td>{{ $d->kode_aas }}
                                            <td>{{ $d->nama_aas }}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm mb-1 mr-1 d-inline edit" href="#"
                                                    id="{{ $d->id }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Ubah
                                                </a>
                                                <form action="/master/aas/{{ $d->id }}/deleteaas" method="post"
                                                    class="d-inline" id="">
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

    {{-- Modal input AAS --}}
    <div class="modal modal-primary fade" id="modal-frmAas" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Akun AAS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card shadow col-lg-12">
                    <div class="card-body">
                        <form action="#" id="frmAas">
                            @csrf
                            <div class="form-group">
                                <label for="kode_aas">Kode AAS</label>
                                <input type="text" name="kode_aas" id="kode_aas" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_aas">Nama Akun AAS</label>
                                <input name="nama_aas" rows="3" id="nama_aas" class="form-control"></input>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" id="btnSimpanData">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit AAS --}}
    <div class="modal modal-blur fade" id="modal-editAas" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Akun AAS</h5>
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
            $("#kode_aas").mask('0000000000');

            //Script takan tombol tambah
            $("#btnTambahAas").click(function() {
                $("#modal-frmAas").modal("show");
            });

            // Proses simpan dengan AJAX
            $("#btnSimpanData").click(function(e) {
                var kode_aas = $("#kode_aas").val();
                var nama_aas = $("#nama_aas").val();

                // Validasi input
                if (kode_aas === "" || nama_aas === "") {
                    Swal.fire({
                        title: "Warning!",
                        text: "Kode Akun AAS dan Nama Akun harus diisi",
                        icon: "warning",
                        confirmButtonText: "OK"
                    });
                    return; // Hentikan proses simpan jika validasi gagal
                }
                $.ajax({
                    type: 'POST',
                    url: '/master/storeaas',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_aas: kode_aas,
                        nama_aas: nama_aas
                    },
                    cache: false,
                    success: function(response) {
                        // Menampilkan SweetAlert setelah berhasil simpan
                        Swal.fire({
                            title: "Data Tersimpan!",
                            text: "Data anda berhasil disimpan",
                            icon: "success"
                        }).then(function() {
                            window.location.href = '/master/aas';
                        });
                    },
                    error: function(error) {
                        // Handle error if needed
                        console.error('Error:', error);
                        Swal.fire({
                            title: "Error!",
                            text: "Terjadi kesalahan saat menyimpan data",
                            icon: "error"
                        });
                    }
                });

                // Prevent default form submission
                e.preventDefault();
            });


            // Proses edit dengan AJAX
            $(".edit").click(function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '/master/editaas',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $('#loadeditform').html(respond);
                    }
                });
                $("#modal-editAas").modal("show");
            });

            // Proses delet dengan AJAX
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
