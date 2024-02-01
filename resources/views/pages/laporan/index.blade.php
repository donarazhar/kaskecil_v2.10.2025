@extends('layouts.sidebar')
@section('title', 'Laporan Kas Kecil')
@section('header-title', 'Laporan Kas Kecil')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-black">Laporan Kas Kecil</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ url('/laporan/cetaklaporan') }}" method="GET" target="_blank">
                        @csrf

                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <input type="date" name="tanggalawal" id="tanggalawal" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <input type="date" name="tanggalakhir" id="tanggalakhir" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <button type="submit" name="tampilkan" class="btn btn-primary w-100">Cetak</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
