<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<style>
    .lampiran-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 10px;
    }

    .lampiran-item {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 2px solid #E5E7EB;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #F9FAFB;
    }

    .lampiran-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: #0053C5;
    }

    .lampiran-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.5) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
        pointer-events: none;
    }

    .lampiran-item:hover::before {
        opacity: 1;
    }

    .lampiran-label {
        position: absolute;
        top: 12px;
        left: 12px;
        background: linear-gradient(135deg, #0053C5 0%, #003d91 100%);
        color: white;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
    }

    .lampiran-zoom-icon {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.95);
        color: #0053C5;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.3s ease;
        z-index: 2;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
    }

    .lampiran-item:hover .lampiran-zoom-icon {
        opacity: 1;
        transform: scale(1);
    }

    .lampiran-item img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }

    .lampiran-item:hover img {
        transform: scale(1.05);
    }

    .no-lampiran {
        text-align: center;
        padding: 60px 20px;
        background: linear-gradient(135deg, #F9FAFB 0%, #F3F4F6 100%);
        border-radius: 16px;
        border: 2px dashed #D1D5DB;
    }

    .no-lampiran i {
        font-size: 64px;
        color: #D1D5DB;
        margin-bottom: 16px;
        opacity: 0.7;
    }

    .no-lampiran h3 {
        color: #6B7280;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .no-lampiran p {
        color: #9CA3AF;
        font-size: 14px;
        margin: 0;
    }

    .info-card {
        background: linear-gradient(135deg, #E8F1FD 0%, #F5F9FF 100%);
        border-left: 4px solid #0053C5;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .info-card i {
        font-size: 24px;
        color: #0053C5;
    }

    .info-card-content {
        flex: 1;
    }

    .info-card-title {
        font-size: 14px;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 4px;
    }

    .info-card-text {
        font-size: 13px;
        color: #4B5563;
        margin: 0;
    }

    /* Lightbox Customization */
    .lightbox .lb-image {
        border-radius: 8px;
    }

    .lightbox .lb-dataContainer {
        border-radius: 0 0 8px 8px;
    }

    @media (max-width: 768px) {
        .lampiran-container {
            grid-template-columns: 1fr;
        }

        .lampiran-item img {
            height: 220px;
        }
    }
</style>

<div class="info-card">
    <i class="fas fa-info-circle"></i>
    <div class="info-card-content">
        <div class="info-card-title">Lampiran Pengeluaran</div>
        <div class="info-card-text">Klik pada gambar untuk melihat dalam ukuran penuh</div>
    </div>
</div>

@php
    $hasLampiran = $transaksi->lampiran || $transaksi->lampiran2 || $transaksi->lampiran3;
@endphp

@if ($hasLampiran)
<div class="lampiran-container">
    @if ($transaksi->lampiran)
    <div class="lampiran-item">
        <span class="lampiran-label">Lampiran 1</span>
        <a href="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran) }}" data-lightbox="lampiran-gallery" data-title="Lampiran 1">
            <img src="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran) }}" alt="Lampiran 1" />
            <div class="lampiran-zoom-icon">
                <i class="fas fa-search-plus"></i>
            </div>
        </a>
    </div>
    @endif

    @if ($transaksi->lampiran2)
    <div class="lampiran-item">
        <span class="lampiran-label">Lampiran 2</span>
        <a href="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran2) }}" data-lightbox="lampiran-gallery" data-title="Lampiran 2">
            <img src="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran2) }}" alt="Lampiran 2" />
            <div class="lampiran-zoom-icon">
                <i class="fas fa-search-plus"></i>
            </div>
        </a>
    </div>
    @endif

    @if ($transaksi->lampiran3)
    <div class="lampiran-item">
        <span class="lampiran-label">Lampiran 3</span>
        <a href="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran3) }}" data-lightbox="lampiran-gallery" data-title="Lampiran 3">
            <img src="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran3) }}" alt="Lampiran 3" />
            <div class="lampiran-zoom-icon">
                <i class="fas fa-search-plus"></i>
            </div>
        </a>
    </div>
    @endif
</div>
@else
<div class="no-lampiran">
    <i class="fas fa-image"></i>
    <h3>Tidak Ada Lampiran</h3>
    <p>Transaksi ini tidak memiliki lampiran yang dilampirkan</p>
</div>
@endif

<script>
    // Lightbox configuration
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': "Gambar %1 dari %2",
        'disableScrolling': true,
        'fadeDuration': 300,
        'imageFadeDuration': 300
    });
</script>