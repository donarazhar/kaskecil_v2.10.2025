<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Penggantian Kas Kecil</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <style>
        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            
            .no-print {
                display: none;
            }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000000;
            line-height: 1.4;
        }

        .sheet {
            padding: 20mm;
        }

        /* Header Styles */
        .letterhead {
            display: table;
            width: 100%;
            margin-bottom: 5mm;
        }

        .letterhead-logo {
            display: table-cell;
            width: 100px;
            vertical-align: middle;
            text-align: center;
        }

        .letterhead-logo img {
            width: 90px;
            height: auto;
        }

        .letterhead-content {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            padding: 0 5px;
        }

        .organization-name {
            font-size: 18px;
            font-weight: bold;
            color: #00843D;
            margin-bottom: 1px;
        }

        .organization-title {
            font-size: 28px;
            font-weight: bold;
            color: #00843D;
            margin: 1px 0;
            letter-spacing: 0.5px;
        }

        .organization-address {
            font-size: 12px;
            color: #00843D;
            line-height: 1.5;
            margin-top: 5px;
        }

        .divider-single {
            height: 1px;
            background-color: #00843D;
            margin: 3px 0;
        }

        .divider-double {
            height: 3px;
            background-color: #00843D;
            margin-top: 2px;
            margin-bottom: 8mm;
        }

        /* Letter Content */
        .letter-meta {
            margin-bottom: 6mm;
        }

        .letter-meta table {
            width: 100%;
            border-collapse: collapse;
        }

        .letter-meta td {
            padding: 1px 0;
            vertical-align: top;
        }

        .meta-label {
            width: 80px;
            font-weight: bold;
            font-size: 13px;
        }

        .meta-colon {
            width: 15px;
            font-weight: bold;
        }

        .meta-value {
            font-weight: bold;
            font-size: 13px;
        }

        .letter-date {
            text-align: right;
            font-weight: bold;
            font-size: 13px;
        }

        .recipient {
            margin-bottom: 5mm;
            font-size: 13px;
        }

        .recipient p {
            margin: 2px 0;
        }

        .greeting {
            margin-bottom: 5mm;
            font-style: italic;
            font-size: 13px;
        }

        .letter-body {
            text-align: justify;
            font-size: 13px;
            line-height: 1.8;
        }

        .letter-body p {
            margin-bottom: 4mm;
        }

        .amount-text {
            margin: 6mm 0;
            padding-left: 20px;
        }

        .amount-text p {
            font-size: 16px;
            font-weight: bold;
        }

        .attachment-note {
            font-style: italic;
            font-size: 13px;
            color: #333;
            margin: 4mm 0;
        }

        .closing {
            margin-top: 5mm;
            font-style: italic;
            font-size: 13px;
            line-height: 1.8;
        }

        .signature-section {
            margin-top: 8mm;
        }

        .signature-box {
            display: inline-block;
            text-align: left;
            font-size: 13px;
        }

        .signature-box p {
            margin: 2px 0;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }

        /* Print Button */
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #00843D 0%, #006030 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .print-button:hover {
            background: linear-gradient(135deg, #006030 0%, #004d25 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .print-button i {
            margin-right: 8px;
        }

        /* Responsive adjustments */
        @media screen and (max-width: 768px) {
            .sheet {
                padding: 15mm;
            }

            .organization-title {
                font-size: 20px;
            }

            .amount-value {
                font-size: 18px;
            }
        }
    </style>
</head>

<body class="A4">
    <!-- Print Button -->
    <button class="print-button no-print" onclick="window.print()">
        <i>🖨️</i> Cetak Surat
    </button>

    <section class="sheet">
        <!-- Letterhead -->
        <div class="letterhead">
            <div class="letterhead-logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            </div>
            <div class="letterhead-content">
                <div class="organization-name">Yayasan Pesantren Islam Al Azhar</div>
                <div class="organization-title">MASJID AGUNG AL AZHAR</div>
                <div class="organization-address">
                    Jl. Sisingamangaraja Kebayoran Baru Jakarta Selatan 12110 | Telp. 021-72783683<br>
                    Website: www.masjidagungalazhar.com | Email: masjidagungalazhar@gmail.com
                </div>
            </div>
        </div>

        <div class="divider-single"></div>
        <div class="divider-double"></div>

        <!-- Letter Metadata -->
        <div class="letter-meta">
            <table>
                <tr>
                    <td class="meta-label">Nomor</td>
                    <td class="meta-colon">:</td>
                    <td class="meta-value">..../YPIA-MAA/{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('m') }}/{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('Y') }}</td>
                    <td rowspan="3" class="letter-date">
                        Jakarta, {{ \Carbon\Carbon::parse($transaksi->tanggal)->isoFormat('DD MMMM YYYY') }}
                    </td>
                </tr>
                <tr>
                    <td class="meta-label">Lampiran</td>
                    <td class="meta-colon">:</td>
                    <td class="meta-value">- Lembar</td>
                </tr>
                <tr>
                    <td class="meta-label">Perihal</td>
                    <td class="meta-colon">:</td>
                    <td class="meta-value">{{ $transaksi->perincian }}</td>
                </tr>
            </table>
        </div>

        <!-- Recipient -->
        <div class="recipient">
            <p>Yang Terhormat,</p>
            <p><strong>Pengurus YPI Al Azhar</strong></p>
            <p>di Tempat</p>
        </div>

        <!-- Greeting -->
        <div class="greeting">
            <p>Assalamualaikum Warrahmatullahi Wabarakatuh,</p>
        </div>

        <!-- Letter Body -->
        <div class="letter-body">
            <p>
                Salam ta'zim kami sampaikan semoga Allah SWT senantiasa melimpahkan rahmat, taufiq dan hidayah-Nya 
                serta memberikan kesehatan kepada kita semua sehingga dapat menjalankan tugas dan aktivitas sehari-hari.
            </p>

            <p>
                Bersama ini kami sampaikan laporan penggantian Kas Kecil Masjid Agung Al Azhar 
                <strong>{{ \Carbon\Carbon::parse($transaksi->tanggal)->isoFormat('MMMM YYYY') }}</strong> sebagai berikut:
            </p>
        </div>

        <!-- Amount -->
        <div class="amount-text">
            <p>Sebesar Rp {{ number_format($transaksi->jumlah, 0, '.', '.') }},-</p>
        </div>

        <!-- Attachment Note -->
        <div class="attachment-note">
            <p>* Terlampir kwitansi</p>
        </div>

        <!-- Closing Statement -->
        <div class="letter-body">
            <p>
                Demikian ini kami sampaikan. Atas perhatiannya kami ucapkan terima kasih.
            </p>
        </div>

        <div class="closing">
            <p>Billahit Taufiq wal Hidayah,</p>
            <p>Wassalamualaikum Warrahmatullahi Wabarakatuh</p>
        </div>

        <!-- Signature -->
        <div class="signature-section">
            <div class="signature-box">
                @foreach ($instansi as $d)
                    <p>{{ $d->nama }}</p>
                    <p>Kepala Kantor</p>
                    <br><br>
                    <p class="signature-name">{{ $d->pimpinan }}</p>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() { window.print(); }
        
        // Keyboard shortcut for printing
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
        });
    </script>
</body>

</html>