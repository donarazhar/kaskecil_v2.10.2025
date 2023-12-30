@extends('layouts.default')
@section('title','Edit transaksi')
@section('header-title','Edit transaksi')

@section('content')
<div class="card shadow mb-4 col-lg-6">
    <div class="card-body">
        @if (session()->has('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>{{ session()->get('pesan') }}</p>
        </div>
        @endif
        <form action="{{route('transaksi.update', $item->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="jumlah">jumlah</label>
                <input type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{old('jumlah') ?? $item->jumlah}}">
                @error('jumlah')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Kategori</label>
                @if ($item->kategori == 'pemasukan')
                <input type="text" class="form-control" name="kategori" value="pemasukan" readonly>
                @elseif($item->kategori == 'pengeluaran')
                <input type="text" class="form-control" name="kategori" value="pengeluaran" readonly>
                @endif
            </div>

            <div class="form-group">
                <label for="">Tanggal</label>
                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{old('tanggal') ?? $item->tanggal->isoFormat('YYYY-MM-DD')}}">
                @error('tanggal')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="perincian">Perincian</label>
                <textarea name="perincian" rows="3" id="perincian" class="form-control @error('perincian') is-invalid @enderror">{{old('perincian') ?? $item->perincian}}</textarea>
                @error('perincian')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>

    </div>
</div>
@endsection
