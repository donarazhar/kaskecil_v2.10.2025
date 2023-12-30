@extends('layoutsberanda.default')
@section('title', 'Data user')
@section('header-title', 'Data user')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-4">
                    Tambah
                    <i class="fa fa-plus" aria-hidden="true"></i>
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
                </a>
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($users)
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->level == 'bendahara')
                                            <span class="badge badge-primary">
                                            @else
                                                <span class="badge badge-success">
                                        @endif
                                        {{ $user->level }}
                                        </span>
                                    </td>
                                    <td>
                                        {{-- <a class="btn btn-info btn-sm" href="{{ route('users.edit', $user->id) }}"> --}}
                                        <a class="btn btn-info btn-sm" href="">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Ubah
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline"
                                            id="{{ 'form-hapus-user-' . $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm btn-hapus" data-id="{{ $user->id }}"
                                                data-email="{{ $user->email }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                Hapus
                                            </button>
                                        </form>
                                        <a href="{{ route('users.reset-password', $user->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fa fa-key"></i>
                                            Reset password
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        @endisset
                    </tbody>
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
    @include('sweetalert::alert')
    <script>
        $('.btn-hapus').on('click', function(e) {
            echo "Test";
            e.preventDefault();
            let id = $(this).data('id');
            let form = $('#form-hapus-user-' + id);
            let email = $(this).data('email');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: email + ' akan dihapus',
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
