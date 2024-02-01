@extends('layouts.sidebar')
@section('title', 'Master Akun')
@section('header-title', 'Master Akun AAS')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-black">Master Akun AAS</h6>
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
                    <a href="#" class="btn btn-primary mb-4 form-group" id="btnTambahAas">
                        Tambah Data
                    </a>
                @endif

                <div class="row mt-2">
                    <div class="col-12">
                        <form action="/master/aas" method="GET">
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
                {{-- Data table AAS --}}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-black">Data Akun AAS</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-container">
                                <table class="table table-striped table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode AAS</th>
                                            <th>Nama Akun</th>
                                            <th>Status</th>
                                            <th>Kategori</th>
                                            @if (Auth::user()->level == 'admin')
                                                <th>Tindakan</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($aas as $d)
                                            <tr>
                                                <td>{{ $loop->iteration + $aas->firstItem() - 1 }}.</td>
                                                <td>{{ $d->kode_aas }}
                                                <td>{{ $d->nama_aas }}</td>
                                                <td>
                                                    @if ($d->status == 'k')
                                                        Kredit
                                                    @elseif ($d->status == 'd')
                                                        Debit
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($d->kategori == 'pembentukan')
                                                        Pembentukan Kas
                                                    @elseif ($d->kategori == 'pengisian')
                                                        Pengisian Kas Kecil
                                                    @elseif ($d->kategori == 'pengeluaran')
                                                        Pengeluaran Kas Kecil
                                                    @endif
                                                </td>
                                                @if (Auth::user()->level == 'admin')
                                                    <td>
                                                        <a class="btn btn-primary btn-sm mb-2 mr-1 d-inline edit"
                                                            href="#" id="{{ $d->id }}">
                                                            <i class="fas fa-pencil-alt">
                                                            </i>
                                                        </a>
                                                        <form action="/master/aas/{{ $d->id }}/deleteaas"
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
                                {{ $aas->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<<<<<<< HEAD
        {{-- Modal input AAS --}}
        <div class="modal modal-primary fade" id="modal-frmaas" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-light">Master Akun AAS</h6>
                        </div>
                    </div>
                    <div class="card shadow col-lg-12">
                        <div class="card-body">
                            <form action="/master/storeaas" id="frmaas" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="kode_aas">Kode AAS</label>
                                    <input type="text" name="kode_aas" id="kode_aas" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nama_aas">Nama Akun AAS</label>
                                    <input name="nama_aas" rows="3" id="nama_aas" class="form-control"></input>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status Akun</label>
                                    <select name="status" id="status" class="form-select form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="d">Debet</option>
                                        <option value="k">Kredit</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori Akun</label>
                                    <select name="kategori" id="kategori" class="form-select form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="pembentukan">Pembentukan Kas</option>
                                        <option value="pengisian">Pengisian Kas</option>
                                        <option value="pengeluaran">Pengeluaran Kas</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary btn-block" id="btnSimpanData">Kirim</button>
                            </form>
                        </div>
=======
    {{-- Modal input AAS --}}
    <div class="modal modal-primary fade" id="modal-frmaas" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Akun AAS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card shadow col-lg-12">
                    <div class="card-body">
                        <form action="/master/storeaas" id="frmaas" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="kode_aas">Kode AAS</label>
                                <input type="text" name="kode_aas" id="kode_aas" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama_aas">Nama Akun AAS</label>
                                <input name="nama_aas" rows="3" id="nama_aas" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Akun</label>
                                <select name="status" id="status" class="form-select form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="d">Debet</option>
                                    <option value="k">Kredit</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori Akun</label>
                                <select name="kategori" id="kategori" class="form-select form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="pembentukan">Pembentukan Kas</option>
                                    <option value="pengisian">Pengisian Kas</option>
                                    <option value="pengeluaran">Pengeluaran Kas</option>
                                </select>
                            </div>
                            <button class="btn btn-primary btn-block" id="btnSimpanData">Kirim</button>
                        </form>
>>>>>>> ac4b8352d836eacbd0a29d8d323f181c2ab4cedd
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit AAS --}}
        <div class="modal modal-blur fade" id="modal-editAas" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="card-header bg-primary">
                            <h6 class="m-0 font-weight-bold text-light">Edit Master Akun AAS</h6>
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
                $("#kode_aas").mask('0000000000');

                //Script takan tombol tambah
                $("#btnTambahAas").click(function() {
                    $("#modal-frmaas").modal("show");
                });

                // Proses simpan dengan AJAX
                $("#btnSimpanData").click(function(e) {

                    var kode_aas = $("#kode_aas").val();
                    var nama_aas = $("#nama_aas").val();
                    var status = $("#status").val();
                    var kategori = $("#kategori").val();

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
                    } else if (nama_aas == "") {
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Nama Akun AAS Harus Diisi',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            $("#nama_aas").focus();
                        });
                        return false;
                    } else if (status == "") {
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Status Akun Harus Diisi',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            $("#status").focus();
                        });
                        return false;
                    } else if (kategori == "") {
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Kategori Akun Harus Diisi',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            $("#kategori").focus();
                        });
                        return false;
                    }

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

<<<<<<< HEAD
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
=======
            });
>>>>>>> ac4b8352d836eacbd0a29d8d323f181c2ab4cedd

            });
        </script>
    @endpush
