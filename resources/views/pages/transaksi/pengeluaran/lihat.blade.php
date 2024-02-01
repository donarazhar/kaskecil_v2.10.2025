<!-- Add these lines to the head section of your HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<div class="form-group mb-3">
    <!-- Menampilkan pratinjau gambar jika sudah ada -->
    @if ($transaksi->lampiran)
        <a href="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran) }}" data-lightbox="preview">
            <img id="preview-image1" style="width: 100%; margin-top: 10px;"
                src="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran) }}" alt="Preview" />
        </a>
    @endif
</div>
<div class="form-group mb-3">
    @if ($transaksi->lampiran2)
        <a href="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran2) }}" data-lightbox="preview">
            <img id="preview-image2" style="width: 100%; margin-top: 10px;"
                src="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran2) }}" alt="Preview" />
        </a>
    @endif
</div>
<div class="form-group mb-3">
    @if ($transaksi->lampiran3)
        <a href="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran3) }}" data-lightbox="preview">
            <img id="preview-image3" style="width: 100%; margin-top: 10px;"
                src="{{ asset('storage/uploads/lampiran/img/' . $transaksi->lampiran3) }}" alt="Preview" />
        </a>
    @endif
</div>


<script>
    function previewImage(inputId, previewImageId, previewContainerId) {
        const input = document.getElementById(inputId);
        const previewContainer = document.getElementById(previewContainerId);
        const previewImage = document.getElementById(previewImageId);

        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'flex';
            };

            reader.readAsDataURL(file);
        } else {
            previewImage.src = '{{ asset('assets/img/preview.png') }}';
            previewContainer.style.display = 'none';
        }
    }
</script>
