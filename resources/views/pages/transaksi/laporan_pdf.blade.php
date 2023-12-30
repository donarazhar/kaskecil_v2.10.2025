@extends('layoutsberanda.laporan')
@section('title', "Laporan Transaksi $periode")
@section('content')
    <table>
        <tr>
            <td>Hal</td>
            <td>: Laporan Keuangan</td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>: {{ $periode }}</td>
        </tr>
        <tr>
            <td>Saldo Awal</td>
            <td>
                : Rp. {{ number_format($saldo_terakhir->total ?? 0, 2, ',', '.') }}
            </td>
        </tr>
    </table>
    <table class="tabel-info">
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Perincian</th>
                <th colspan="2">Transaksi</th>
                <th rowspan="2">Saldo(Rp)</th>
            </tr>
            <tr>
                <th>Pemasukan(Rp)</th>
                <th>Pengeluaran(Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $jumlah_pemasukan = 0;
                $jumlah_pengeluaran = 0;
            @endphp
            @forelse ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM YYYY') }}</td>
                    <td>{!! $item->perincian !!}</td>
                    <td>
                        @if ($item->kategori == 'pemasukan')
                            {{ number_format($item->jumlah, 2, ',', '.') }}
                            @php
                                $jumlah_pemasukan += $item->jumlah;
                            @endphp
                        @else
                        @endif
                    </td>
                    <td>
                        @if ($item->kategori == 'pengeluaran')
                            {{ number_format($item->jumlah, 2, ',', '.') }}
                            @php
                                $jumlah_pengeluaran += $item->jumlah;
                            @endphp
                        @else
                        @endif
                    </td>
                    <td>{{ number_format($item->saldo->total, 2, ',', '.') }}</td>
                    @php
                        $saldo = $item->saldo->total;
                    @endphp
                </tr>
            @empty
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3"><b>Total</b></th>
                <th class="total"><b>{{ number_format($jumlah_pemasukan, 2, ',', '.') }}</b></th>
                <th class="total"><b>{{ number_format($jumlah_pengeluaran, 2, ',', '.') }}</b></th>
                <th class="total"><b>{{ number_format($saldo ?? 0, 2, ',', '.') }}</b></th>
            </tr>
        </tfoot>
    </table>
@endsection
