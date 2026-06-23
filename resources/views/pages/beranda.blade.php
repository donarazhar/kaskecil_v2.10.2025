@extends('layouts.sidebar')
@section('title', 'Beranda')
@section('header-title', 'Dashboard')
@section('content')

<style>
    :root {
        --blue:      #0053C5;
        --blue-dark: #003d91;
        --blue-50:   #eff6ff;
        --blue-100:  #dbeafe;
        --green-50:  #f0fdf4;
        --green-500: #22c55e;
        --green-700: #15803d;
        --red-50:    #fef2f2;
        --red-500:   #ef4444;
        --red-700:   #b91c1c;
        --amber-50:  #fffbeb;
        --amber-500: #f59e0b;
        --amber-700: #b45309;
        --gray-50:   #f9fafb;
        --gray-100:  #f3f4f6;
        --gray-200:  #e5e7eb;
        --gray-300:  #d1d5db;
        --gray-400:  #9ca3af;
        --gray-500:  #6b7280;
        --gray-600:  #4b5563;
        --gray-700:  #374151;
        --gray-800:  #1f2937;
        --gray-900:  #111827;
    }

    /* ── Stat Cards ── */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (max-width: 1024px) { .stat-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 480px)  { .stat-grid { grid-template-columns: 1fr; } }

    .stat-card {
        background: #fff;
        border: 1px solid var(--gray-100);
        border-radius: 14px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .stat-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.08); transform: translateY(-2px); }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .stat-icon.blue   { background: var(--blue-50);  color: var(--blue); }
    .stat-icon.green  { background: var(--green-50);  color: var(--green-500); }
    .stat-icon.red    { background: var(--red-50);    color: var(--red-500); }
    .stat-icon.amber  { background: var(--amber-50);  color: var(--amber-500); }

    .stat-body { flex: 1; min-width: 0; }
    .stat-label { font-size: 12px; font-weight: 600; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .stat-value { font-size: 20px; font-weight: 700; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .stat-sub { font-size: 12px; color: var(--gray-400); margin-top: 2px; }

    /* ── Section Cards ── */
    .section-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }
    @media (max-width: 768px) { .section-grid-2 { grid-template-columns: 1fr; } }

    .panel {
        background: #fff;
        border: 1px solid var(--gray-100);
        border-radius: 14px;
        overflow: hidden;
    }

    .panel-header {
        padding: 16px 20px;
        border-bottom: 1px solid var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .panel-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-800);
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
    }

    .panel-title i { color: var(--blue); font-size: 15px; }

    .panel-body {
        padding: 0;
        max-height: 360px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: var(--gray-200) transparent;
    }

    .panel-body::-webkit-scrollbar { width: 4px; }
    .panel-body::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }

    /* ── Table ── */
    .dash-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .dash-table thead th {
        background: var(--gray-50);
        padding: 10px 16px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid var(--gray-200);
        position: sticky;
        top: 0;
        z-index: 1;
    }
    .dash-table tbody td { padding: 12px 16px; border-bottom: 1px solid var(--gray-50); color: var(--gray-700); vertical-align: middle; }
    .dash-table tbody tr:last-child td { border-bottom: none; }
    .dash-table tbody tr:hover td { background: var(--gray-50); }
    .dash-table tfoot th { padding: 12px 16px; background: var(--blue-50); color: var(--blue); font-size: 13px; font-weight: 700; border-top: 1px solid var(--blue-100); }

    /* ── Badge ── */
    .badge {
        display: inline-block;
        padding: 3px 9px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }
    .badge-blue   { background: var(--blue-50);  color: var(--blue); }
    .badge-green  { background: var(--green-50);  color: var(--green-700); }
    .badge-red    { background: var(--red-50);    color: var(--red-700); }

    /* ── Progress ── */
    .prog-list { padding: 16px 20px; display: flex; flex-direction: column; gap: 20px; }
    .prog-item {}
    .prog-row  { display: flex; justify-content: space-between; margin-bottom: 6px; }
    .prog-name { font-size: 13px; font-weight: 500; color: var(--gray-700); }
    .prog-val  { font-size: 13px; font-weight: 700; color: var(--blue); }
    .prog-bar  { height: 8px; background: var(--gray-100); border-radius: 10px; overflow: hidden; }
    .prog-fill { height: 100%; border-radius: 10px; background: var(--blue); transition: width 1s ease-out; }
    .prog-fill.c0 { background: linear-gradient(90deg, #0053C5, #2563eb); }
    .prog-fill.c1 { background: linear-gradient(90deg, #22c55e, #16a34a); }
    .prog-fill.c2 { background: linear-gradient(90deg, #3b82f6, #2563eb); }
    .prog-fill.c3 { background: linear-gradient(90deg, #f59e0b, #d97706); }
    .prog-fill.c4 { background: linear-gradient(90deg, #ef4444, #dc2626); }

    /* ── Chart ── */
    .chart-wrap { padding: 20px; height: 320px; }

    /* ── History Cards ── */
    .history-section { margin-bottom: 24px; }

    .history-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        padding: 20px;
    }

    @media (max-width: 1024px) { .history-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 480px)  { .history-grid { grid-template-columns: 1fr; } }

    .hist-card {
        border: 1.5px solid var(--gray-100);
        border-radius: 12px;
        padding: 16px;
        background: #fff;
        transition: box-shadow 0.2s, transform 0.2s;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .hist-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.08); transform: translateY(-2px); }

    .hist-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 8px; }

    .hist-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--blue-50);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .hist-amount {
        font-size: 17px;
        font-weight: 700;
        color: var(--gray-900);
    }

    .hist-meta { font-size: 12px; color: var(--gray-500); display: flex; flex-direction: column; gap: 3px; }
    .hist-meta span { display: flex; align-items: center; gap: 5px; }

    /* ── Empty State ── */
    .empty { text-align: center; padding: 48px 20px; }
    .empty i { font-size: 48px; color: var(--gray-300); margin-bottom: 12px; display: block; }
    .empty p { font-size: 14px; color: var(--gray-400); margin: 0; }

    /* ── Pagination ── */
    .pagi-wrap { padding: 16px 20px; border-top: 1px solid var(--gray-100); display: flex; justify-content: center; }
    .pagi-wrap .pagination { margin: 0; }
    .pagi-wrap .page-item .page-link { font-size: 13px; color: var(--blue); border-color: var(--gray-200); }
    .pagi-wrap .page-item.active .page-link { background: var(--blue); border-color: var(--blue); color: #fff; }

    /* fade in */
    .fade-in { animation: fi 0.4s ease both; }
    @keyframes fi { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
    .delay-1 { animation-delay: .05s; }
    .delay-2 { animation-delay: .10s; }
    .delay-3 { animation-delay: .15s; }
    .delay-4 { animation-delay: .20s; }
    .delay-5 { animation-delay: .25s; }
    .delay-6 { animation-delay: .30s; }
</style>

{{-- STAT CARDS --}}
<div class="stat-grid">
    <div class="stat-card fade-in delay-1">
        <div class="stat-icon blue"><i class="fas fa-wallet"></i></div>
        <div class="stat-body">
            <div class="stat-label">Pembentukan Kas</div>
            <div class="stat-value">Rp {{ number_format($pembentukan->sum('jumlah'), 0, ',', '.') }}</div>
            <div class="stat-sub">Awal periode</div>
        </div>
    </div>
    <div class="stat-card fade-in delay-2">
        <div class="stat-icon red"><i class="fas fa-arrow-trend-down"></i></div>
        <div class="stat-body">
            <div class="stat-label">Pengeluaran Kas</div>
            <div class="stat-value">Rp {{ number_format($pengeluaranbulanini->sum('jumlah'), 0, ',', '.') }}</div>
            <div class="stat-sub">Bulan {{ $namaBulan }}</div>
        </div>
    </div>
    <div class="stat-card fade-in delay-3">
        <div class="stat-icon green"><i class="fas fa-arrow-trend-up"></i></div>
        <div class="stat-body">
            <div class="stat-label">Pengisian Kas</div>
            <div class="stat-value">Rp {{ number_format($pengisianbulanini->sum('jumlah'), 0, ',', '.') }}</div>
            <div class="stat-sub">Bulan {{ $namaBulan }}</div>
        </div>
    </div>
    <div class="stat-card fade-in delay-4">
        <div class="stat-icon amber"><i class="fas fa-scale-balanced"></i></div>
        <div class="stat-body">
            <div class="stat-label">Saldo Berjalan</div>
            <div class="stat-value">Rp {{ number_format($saldoberjalan->total_result ?? 0, 0, ',', '.') }}</div>
            <div class="stat-sub">Saldo terkini</div>
        </div>
    </div>
</div>

{{-- ROW 2: Mata Anggaran + Grafik --}}
<div class="section-grid-2 fade-in delay-2">

    {{-- Mata Anggaran --}}
    <div class="panel">
        <div class="panel-header">
            <h6 class="panel-title"><i class="fas fa-list-alt"></i> Informasi Mata Anggaran</h6>
        </div>
        <div class="panel-body">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th style="width:35%">Kode</th>
                        <th>Nama Anggaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matanggaran as $mata)
                    <tr>
                        <td><span class="badge badge-blue">{{ $mata->kode_matanggaran }}</span></td>
                        <td>{{ $mata->nama_aas }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2"><div class="empty"><i class="fas fa-folder-open"></i><p>Belum ada data mata anggaran</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Grafik Pengeluaran --}}
    <div class="panel">
        <div class="panel-header">
            <h6 class="panel-title"><i class="fas fa-chart-bar"></i> Grafik Pengeluaran {{ $namaBulan }} {{ $tahunini }}</h6>
        </div>
        <div class="chart-wrap">
            <canvas id="myPieChart"></canvas>
        </div>
    </div>

</div>

{{-- ROW 3: Rekap + Detail Transaksi --}}
<div class="section-grid-2 fade-in delay-3">

    {{-- Rekap Progress --}}
    <div class="panel">
        <div class="panel-header">
            <h6 class="panel-title"><i class="fas fa-chart-pie"></i> Rekap {{ $namaBulan }} {{ $tahunini }}</h6>
        </div>
        @php
            $vals = $rekapperbulan->pluck('total_perbulan')->toArray();
            $maxVal = !empty($vals) ? max($vals) : 1;
        @endphp
        <div class="prog-list">
            @forelse($rekapperbulan as $i => $data)
            @php $pct = $maxVal ? round(($data->total_perbulan / $maxVal) * 100) : 0; @endphp
            <div class="prog-item">
                <div class="prog-row">
                    <span class="prog-name">{{ $data->nama_aas }}</span>
                    <span class="prog-val">Rp {{ number_format($data->total_perbulan, 0, ',', '.') }}</span>
                </div>
                <div class="prog-bar">
                    <div class="prog-fill c{{ $i % 5 }}" style="width:{{ $pct }}%"></div>
                </div>
            </div>
            @empty
            <div class="empty"><i class="fas fa-chart-pie"></i><p>Belum ada data rekap bulan ini</p></div>
            @endforelse
        </div>
    </div>

    {{-- Detail Transaksi --}}
    <div class="panel">
        <div class="panel-header">
            <h6 class="panel-title"><i class="fas fa-table"></i> Detail Pengeluaran {{ $namaBulan }} {{ $tahunini }}</h6>
        </div>
        <div class="panel-body">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Nama Akun</th>
                        <th>Status</th>
                        <th class="text-right">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengeluaranbulanini as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space:nowrap">{{ \Carbon\Carbon::parse($d->tanggal)->isoFormat('DD/MM/YY') }}</td>
                        <td><span class="badge badge-blue">{{ $d->kode_matanggaran }}</span></td>
                        <td>{{ $d->nama_aas }}</td>
                        <td>
                            @if($d->status == 'k') <span class="badge badge-green">Kredit</span>
                            @elseif($d->status == 'd') <span class="badge badge-red">Debet</span>
                            @endif
                        </td>
                        <td class="text-right"><strong>{{ number_format($d->jumlah, 0, ',', '.') }}</strong></td>
                    </tr>
                    @empty
                    <tr><td colspan="6"><div class="empty"><i class="fas fa-inbox"></i><p>Belum ada transaksi bulan ini</p></div></td></tr>
                    @endforelse
                </tbody>
                @if($pengeluaranbulanini->count() > 0)
                <tfoot>
                    <tr>
                        <th colspan="5">Total Pengeluaran</th>
                        <th class="text-right">{{ number_format($pengeluaranbulanini->sum('jumlah'), 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>

</div>

{{-- ROW 4: History Pengisian Kas --}}
<div class="panel history-section fade-in delay-4">
    <div class="panel-header">
        <h6 class="panel-title"><i class="fas fa-clock-rotate-left"></i> History Pengisian Kas</h6>
        <span style="font-size:12px; color:var(--gray-400);">Terbaru di atas</span>
    </div>

    @if(isset($combinedData) && $combinedData->count() > 0)
    <div class="history-grid">
        @foreach($combinedData as $data)
        @if(is_object($data))
        <div class="hist-card">
            <div class="hist-top">
                <div class="hist-icon"><i class="fas fa-money-bill-wave"></i></div>
                @if(isset($data->id_pengisian))
                    @if(DB::table('transaksi')->where('id_pengisian', $data->id_pengisian)->exists())
                        <span class="badge badge-green">Sudah Cair</span>
                    @else
                        <span class="badge badge-red">Belum Cair</span>
                    @endif
                @endif
            </div>
            <div class="hist-amount">Rp {{ number_format($data->jumlah ?? 0, 0, ',', '.') }}</div>
            <div class="hist-meta">
                @if(isset($data->tanggal))
                <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('DD MMM YYYY') }}</span>
                @endif
                @if(isset($data->perincian))
                <span><i class="fas fa-file-alt"></i> {{ Str::limit($data->perincian, 40) }}</span>
                @endif
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <div class="pagi-wrap">
        {{ $combinedData->links('vendor.pagination.bootstrap-5') }}
    </div>
    @else
    <div class="empty"><i class="fas fa-clock-rotate-left"></i><p>History pengisian kas masih kosong</p></div>
    @endif
</div>

@endsection

@push('after-style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('after-script')
<script>
    // Bar Chart
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var data = <?php echo json_encode($pengeluaranbulanini) ?>;
    var colors = ['#0053C5','#22c55e','#3b82f6','#f59e0b','#ef4444','#8b5cf6','#ec4899'];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(d => d.kode_matanggaran),
            datasets: [{
                label: 'Pengeluaran',
                data: data.map(d => d.jumlah),
                backgroundColor: colors.map(c => c + 'cc'),
                borderColor: colors,
                borderWidth: 2,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(17,24,39,0.9)',
                    padding: 12, cornerRadius: 8,
                    callbacks: {
                        label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11, weight: '600' }, color: '#374151' } },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    ticks: {
                        font: { size: 11 }, color: '#6b7280',
                        callback: v => v >= 1e6 ? (v/1e6).toFixed(1)+'Jt' : v >= 1e3 ? (v/1e3).toFixed(0)+'Rb' : v
                    }
                }
            },
            animation: { duration: 1200, easing: 'easeOutQuart' }
        }
    });

    // Animate progress bars
    document.querySelectorAll('.prog-fill').forEach(function(el) {
        var w = el.style.width;
        el.style.width = '0';
        setTimeout(function() { el.style.width = w; }, 200);
    });
</script>
@endpush
