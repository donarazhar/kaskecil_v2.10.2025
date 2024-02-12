<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Surat Penggantian Kas Kecil</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #alamat {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: hsl(125, 100%, 36%);
        }

        #title {
            font-family: 'Times New Roman', Times, serif;
            font-size: 16px;
            font-weight: bold;
            color: hsl(125, 100%, 36%);
        }

        h2#subjudul {
            font-family: 'Times New Roman', Times, serif;
            font-size: 30px;
            font-weight: bold;
            color: hsl(125, 100%, 36%);

        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            /* border: 1px solid black; */
            padding: 8px;
            text-align: left;
        }

        td img {
            display: block;
            /* Menghilangkan whitespace di sekitar gambar */
        }

        td#title {
            text-align: center;
            line-height: 10%;
        }

        hr {
            margin: 2px 0;
            border: none;
            height: 0.5px;
            background-color: hsl(125, 100%, 36%);
            border: 1px solid hsl(125, 100%, 36%);
        }

        hr#tebal {
            margin: 5px 0;
            border: none;
            height: 2px;
            background-color: hsl(125, 100%, 36%);
            border: 1.2px solid hsl(125, 100%, 36%);
        }

        p {
            font-family: 'Times New Roman', Times, serif;
            margin: 2px 0;
            line-height: 130%;
            font-size: 14px;
            color: hsl(0, 0%, 0%);
        }

        p#jumlah {
            font-family: 'Times New Roman', Times, serif;
            font-size: 18px;
            color: hsl(0, 0%, 0%);
        }
    </style>
</head>

<body class="A4 potrait">
    <section class="sheet padding-10mm">
        <table>
            <tr>
                <td style="width: 10px; text-align:center;">
                    <img src="{{ asset('assets/img/logo.png') }}" width="130%">
                </td>
                <td id="title" style="width: 60px;">
                    <span id="title">
                        Yayasan Pesantren Islam Al Azhar<br>
                        <h2 id="subjudul">Masjid Masjid Agung Al Azhar</h2>
                    </span><br>
                    <span>
                        <small id="alamat">Jl. Sisingamangaraja Kebayoran Baru Jakarta Selatan 12110 Telp.
                            021-72783683</small>
                    </span>
                    <br> <br> <br> <br> <br><br><br><br><span><small id="alamat">Website :
                            www.masjidagungalazhar.com | Email : masjidagungalazhar@gmail.com</small></span>
                </td>
            </tr>
        </table>
        <hr>
        <hr id="tebal">
        <br>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 10%; text-align:left;">
                    <p><b>Nomor<br>Lamp<br>Perihal</b></p>
                </td>
                <td style="width: 65%; text-align:left;">
                    <p><b>: ..../YPIA-MAA/&nbsp;&nbsp;/2024<br>: - Lembar <br>: {{ $transaksi->perincian }}</b></p>
                </td>

                <td style="width: 25%; text-align:right">
                    <p><b>Jakarta,
                            {{ \Carbon\Carbon::parse($transaksi->tanggal)->isoFormat('DD/MM/YYYY') }}</b><br><br><br>
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:left;">
                    <p>Yang terhormat, <br><b>Pengurus YPI Al Azhar</b><br>di Tempat</p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:left;">
                    <p><i>Assalamualaikum Warrahmatullahi Wabarakatuh,</p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    <p>Salam ta'zim kami sampaikan semoga Allah SWT senantiasa melimpahkan rahmat, taufiq dan
                        hidayahNya serta memberikan kesehatan kepada kita semua sehingga dapat menjalankan tugas
                        dan aktifitas sehari-hari.
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    <p>Bersama ini kami sampaikan laporan penggantian Kas Kecil Masjid Agung Al Azhar
                        <b>{{ \Carbon\Carbon::parse($transaksi->tanggal)->isoFormat('MMMM YYYY') }}</b> sebagai
                        berikut:
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 8%;"></td>
                <td style="width: 90%; text-align:left;">
                    <p id="jumlah"><b>Sebesar Rp. {{ number_format($transaksi->jumlah, 0, ',', '.') }},-</b>
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    <p><i>Terlampir kwitansi</i>
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    <p>Demikian ini kami sampaikan, Atas perhatiannya kami ucapkan terima kasih.
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    <p><i>Billahit Taufiq wal Hidayah</i>
                    <p><i>Wassalamualaikum Warrahmatullahi Wabarakatuh</i>
                    </p>
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table><br>
        <table>
            <tr>
                <td style="width: 2%;"></td>
                <td style="width: 96%; text-align:justify;">
                    @foreach ($instansi as $d)
                        <p>{{ $d->nama }}
                        <p>Kepala Kantor <br><br><br><br>
                        <p><b>{{ $d->pimpinan }}</b>
                        </p>
                    @endforeach
                </td>
                <td style="width: 2%;"></td>
            </tr>
        </table>

    </section>

</body>

</html>
