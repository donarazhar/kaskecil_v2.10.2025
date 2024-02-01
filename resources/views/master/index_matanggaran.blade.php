@extends('layouts.sidebar')
@section('title', 'Master Akun')
@section('header-title', 'Master Akun Mata Anggaran')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-black">Master Akun Mata Anggaran</h6>
        </div>
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
                @if (Auth::user()->level == 'admin')
                    <a href="#" class="btn btn-primary mb-4 form-group" id="btnTambahMatanggaran">
                        Tambah Data
                    </a>
                @endif

                <div class="row mt-2">
                    <div class="col-12">
                        <form action="/master/matanggaran" method="GET">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="nama_akunaas" id="nama_akunaas"
                                        placeholder="Pencarian..." value="{{ Request('nama_akunaas') }}">
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-search" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                <path d="M21 21l-6 -6" />
                                            </svg>
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Data table Anggaran --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-black">Data Akun Anggaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-container">
                                <table class="table table-striped table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Mata Anggaran</th>
                                            <th>Kode AAS</th>
                                            <th>Nama Akun</th>
                                            <th>Saldo</th>
                                            @if (Auth::user()->level == 'admin')
                                                <th>Tindakan</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matanggaran as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}.</td>
                                                <td>{{ $d->kode_matanggaran }}
                                                <td>{{ $d->kode_aas }}
                                                <td>{{ $d->nama_aas }}</td>
                                                <td>{{ number_format($d->saldo, 0, ',', '.') }}</td>
                                                @if (Auth::user()->level == 'admin')
                                                    <td>
                                                        <a class="btn btn-primary btn-sm mb-1 mr-1 d-inline edit"
                                                            href="#" id="{{ $d->id }}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                        </a>
                                                        <form
                                                            action="/master/matanggaran/{{ $d->id }}/deletematanggaran"
                                                            method="post" class="d-inline" id="">
                                                            @csrf
                                                            <a class="btn btn-danger btn-sm btn-hapus delete-confirm">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                            </a>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $matanggaran->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<<<<<<< HEAD
        {{-- Modal input matanggaran --}}
        <div class="modal modal-primary fade" id="modal-frmmatanggaran" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-light">Master Akun Mata Anggaran</h6>
                        </div>
                    </div>
                    <div class="card shadow col-lg-12">
                        <div class="card-body">
                            <form action="/master/storematanggaran" id="frmmatanggaran" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="kode_matanggaran">Kode Mata Anggaran</label>
                                    <input type="text" name="kode_matanggaran" id="kode_matanggaran"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nama_matanggaran">Nama Akun Mata Anggaran</label>
                                    <select name="kode_aas" id="kode_aas" class="form-select form-control">
                                        <option value="">- Nama Anggaran -</option>
                                        @foreach ($aas as $d)
                                            <option value="{{ $d->kode_aas }}">
                                                {{ $d->kode_aas }} | {{ $d->nama_aas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="saldo_matanggaran">Saldo Anggaran</label>
                                    <input type="text" name="saldo_matanggaran" id="saldo_matanggaran"
                                        class="form-control">
                                </div>
                                <button class="btn btn-primary btn-block" id="btnSimpanData">Kirim</button>
                            </form>
                        </div>
=======
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
                        <form action="/master/storematanggaran" id="frmmatanggaran" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="kode_matanggaran">Kode Mata Anggaran</label>
                                <input type="text" name="kode_matanggaran" id="kode_matanggaran" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_matanggaran">Nama Akun Mata Anggaran</label>
                                <select name="kode_aas" id="kode_aas" class="form-select form-control">
                                    <option value="">- Nama Anggaran -</option>
                                    @foreach ($aas as $d)
                                        <option value="{{ $d->kode_aas }}">
                                            {{ $d->kode_aas }} | {{ $d->nama_aas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="saldo_matanggaran">Saldo Anggaran</label>
                                <input type="text" name="saldo_matanggaran" id="saldo_matanggaran" class="form-control">
                            </div>
                            <button class="btn btn-primary btn-block" id="btnSimpanData">Kirim</button>
                        </form>
>>>>>>> ac4b8352d836eacbd0a29d8d323f181c2ab4cedd
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit matanggaran --}}
        <div class="modal modal-blur fade" id="modal-editmatanggaran" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-light">Edit Master Akun Mata Anggaran</h6>
                        </div>
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
                $("#kode_matanggaran").mask('0.0.0000');
                $('#saldo_matanggaran').mask("#.##0", {
                    reverse: true
                });

                //Script takan tombol tambah
                $("#btnTambahMatanggaran").click(function() {
                    $("#modal-frmmatanggaran").modal("show");
                });

                // Proses simpan dengan AJAX
                $("#btnSimpanData").click(function(e) {
                    var kode_matanggaran = $("#kode_matanggaran").val();
                    var kode_aas = $("#kode_aas").val();
                    var saldo_matanggaran = $("#saldo_matanggaran").val();

                    if (kode_aas == "") {
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Kode AAS Harus Diisi',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            $("#kode_aas").focus();
                        });
                        return false;
                    } else if (kode_matanggaran == "") {
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Nama Akun AAS Harus Diisi',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            $("#kode_matanggaran").focus();
                        });
                        return false;
                    } else if (saldo_matanggaran == "") {
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Saldo Anggaran Harus Diisi',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            $("#saldo_matanggaran").focus();
                        });
                        return false;
                    }

                });

                // Proses edit dengan AJAX
                $(".edit").click(function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: 'POST',
                        url: '/master/editmatanggaran',
                        cache: false,
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(respond) {
                            $('#loadeditform').html(respond);
                        }
                    });
                    $("#modal-editmatanggaran").modal("show");
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
<<<<<<< HEAD
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
=======
                        $("#kode_matanggaran").focus();
                    });
                    return false;
                } else if (saldo_matanggaran == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Saldo Anggaran Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#saldo_matanggaran").focus();
                    });
                    return false;
                }

            });
>>>>>>> ac4b8352d836eacbd0a29d8d323f181c2ab4cedd

            });
        </script>
    @endpush
