<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Per {{ date('d-m-Y', strtotime($periodeawal)) }}
        s.d {{ date('d-m-Y', strtotime($periodeakhir)) }}

    </title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <style>
        @page {
            size: legal;
            margin: 8mm;
            /* Atur margin sesuai kebutuhan */
        }

        section.sheet {
            padding-top: 10mm;
            /* Sesuaikan dengan margin atas */
        }

        table {
    border-collapse: collapse;
    width: 100%;
    page-break-inside: auto;
    page-break-after: auto; /* atau ganti menjadi 'avoid' jika ingin mencegah pemberhentian halaman setelah tabel */
}

    </style>


</head>

<body class="legal potrait">
    <section class="sheet padding-10mm">
        <table style="border-collapse: collapse; width: 100%;">
            <tr>
                <td style="width: 20%; ">
                    <!-- Isi kolom pertama -->
                </td>
                <td style="font-size: 14px; width: 60%;text-align: center; solid black;">
                    Yayasan Pesantren Islam Al Azhar<br>
                    Masjid Masjid Agung Al Azhar<br>
                    <small style="font-size: 16px;">Kas Kecil Per {{ date('d-m-Y', strtotime($periodeawal)) }} s.d
                        {{ date('d-m-Y', strtotime($periodeakhir)) }}
                    </small>
                </td>
                <td style="width: 20%; ">
                    <!-- Isi kolom ketiga -->
                </td>
            </tr>
        </table>
        <br>
        {{-- Data Table Pengeluaran Kas Kecil --}}

        <table style="border-collapse: collapse; width: 100%; font-size: 9px; page-break-inside: auto; page-break-after: auto;">
            <thead style="width: auto; text-align: center; border: 1px solid black;">
                <tr>
                    <th style="width: auto; text-align: center; border: 1px solid black;">No.</th>
                    <th style="width: auto; text-align: center; border: 1px solid black;">No. Akun AAS</th>
                    <th style="width: auto; text-align: center; border: 1px solid black;">Mata Anggaran</th>
                    <th colspan="2" style="width: auto; text-align: center; border: 1px solid black;">URAIAN</th>
                    <th colspan="2" style="width: auto; text-align: center; border: 1px solid black;">Besaran (Rp)
                    </th>
                </tr>
            </thead>
            <tbody style="width: auto; text-align: center; border: 1px solid black; page-break-inside: auto; page-break-after: auto;">
                @php
                    $totals = []; // Menyimpan total setiap kode_matanggaran dan kode_aas
                    $currentKodeMatanggaran = null;
                    $currentKodeAAS = null;
                    $currentTotal = 0;
                @endphp
                @forelse ($pengeluaranbulanini as $d)
                    {{-- Periksa perubahan pada kode_matanggaran atau kode_aas --}}
                    @if ($currentKodeMatanggaran !== $d->kode_matanggaran || $currentKodeAAS !== $d->kode_aas)
                        {{-- Tampilkan total untuk kode_matanggaran dan kode_aas sebelumnya --}}
                        @if ($currentKodeMatanggaran !== null && $currentKodeAAS !== null)
                            <tr>
                                <td colspan="5" style="text-align: right;">Jumlah</td>
                                <td></td>
                                <td>{{ number_format($currentTotal, 0, ',', '.') }}</td>
                            </tr>
                            @php
                                $totals["$currentKodeMatanggaran-$currentKodeAAS"] = $currentTotal; // Simpan total untuk kode_matanggaran dan kode_aas sebelumnya
                                $currentTotal = 0; // Reset total setelah menampilkan total
                            @endphp
                        @endif

                        {{-- Update currentKodeMatanggaran dan currentKodeAAS --}}
                        @php
                            $currentKodeMatanggaran = $d->kode_matanggaran;
                            $currentKodeAAS = $d->kode_aas;
                        @endphp
                    @endif

                    {{-- Tambahkan jumlah untuk total --}}
                    @php
                        $currentTotal += $d->jumlah; // Menggunakan total_jumlah dari query
                    @endphp

                    {{-- Tampilkan baris untuk setiap kode_matanggaran dan kode_aas --}}
                    <tr>
                        <td style="width: auto; text-align: center; border: 1px solid black;">{{ $loop->iteration }}.
                        </td>
                        <td style="width: 80px; text-align: center; border: 1px solid black;">{{ $d->kode_aas }}</td>
                        <td style="width: 30px; text-align: center; border: 1px solid black;">{{ $d->kode_matanggaran }}
                        </td>
                        <td style="width: 80px; text-align: center; border: 1px solid black;">{{ $d->nama_aas }}</td>
                        <td style="width: auto; text-align: center; border: 1px solid black;">{{ $d->perincian }}</td>
                        <td style="width: 80px; text-align: center; border: 1px solid black;">
                            {{ number_format($d->jumlah, 0, ',', '.') }}</td>
                        <td style="width: 80px; text-align: center; border: 1px solid black;"></td>
                    </tr>
                @empty
                @endforelse
                {{-- Tampilkan total untuk kode_matanggaran dan kode_aas terakhir --}}
                @if ($currentKodeMatanggaran !== null && $currentKodeAAS !== null)
                    <tr>
                        <td colspan="5" style="text-align: right;">Jumlah</td>
                        <td></td>
                        <td>{{ number_format($currentTotal, 0, ',', '.') }}</td>
                    </tr>
                    @php
                        $totals["$currentKodeMatanggaran-$currentKodeAAS"] = $currentTotal; // Simpan total untuk kode_matanggaran dan kode_aas terakhir
                    @endphp
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-center"><b>Total</b></th>
                    <th colspan="1" class="text-center">
                        <b>
                            @if ($request->input('tanggalawal') == 'periodeawal')
                                {{ number_format($totalpengeluaran->total_pengeluaran, 0, ',', '.') }}
                            @elseif($request->input('tanggalakhir') == 'periodeakhir')
                                {{ number_format($totalpengeluaran->total_pengeluaran, 0, ',', '.') }}
                            @else
                                {{ number_format($totalpengeluaran->total_pengeluaran, 0, ',', '.') }}
                            @endif
                        </b>
                    </th>
                    <th colspan="1" class="text-center">
                        <!-- Menampilkan total_pengeluaran_per_periode pada kolom kedua -->
                        <b>
                            @if ($request->input('tanggalawal') == 'periode1')
                                {{ number_format($totalpengeluaran->total_pengeluaran, 0, ',', '.') }}
                            @elseif($request->input('tanggalakhir') == 'periodeakhir')
                                {{ number_format($totalpengeluaran->total_pengeluaran, 0, ',', '.') }}
                            @else
                                {{ number_format($totalpengeluaran->total_pengeluaran, 0, ',', '.') }}
                            @endif
                        </b>
                    </th>
                </tr>
            </tfoot>
        </table>
        <table style="border-collapse: collapse; width: 100%; margin-left:80px; margin-right:140px; font-size:9px; page-break-inside: auto; page-break-after: auto;">
            <th>
            <td>
                <p>Mengetahui,<br>
                    Kepala Kantor Masjid Agung Al Azhar<br><br><br>
                    <strong>H. Tatang Komara</strong>
                </p>
            </td>
            <td>
                <p>
                    Jakarta, {{ date('d-m-Y') }}<br>
                    Dibuat oleh,<br>
                    Tata Usaha<br><br><br>
                    <strong>Donarsi Y</strong>
                </p>
            </td>
            </th>
        </table>

    </section>
</body>

</html>
