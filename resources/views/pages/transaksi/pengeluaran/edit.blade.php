<form action="/transaksi/pengeluaran/{{ $transaksi->id }}/update" method="post" id="frmpengeluaranedit"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="nama_matanggaran">Mata Anggaran</label>
        <select name="kode_matanggaran" id="kode_matanggaran" class="form-select form-control">
            <option value="{{ $pengeluaran->kode_matanggaran }}">{{ $pengeluaran->kode_matanggaran }} |
                {{ $pengeluaran->nama_aas }}
            </option>
            @foreach ($matanggaran as $d)
                @if ($d->status == 'd' && $d->kategori == 'pengeluaran')
                    <option value="{{ $d->kode_matanggaran }}">
                        {{ $d->kode_matanggaran }} | {{ $d->nama_aas }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <input type="text" name="jumlah" id="jumlah" class="form-control" value="{{ $pengeluaran->jumlah }}">
    </div>
    <input type="hidden" name="kategori" id="kategori" value="pengeluaran">
    <div class="form-group">
        <label for="">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $pengeluaran->tanggal }}">
    </div>

    <div class="form-group">
        <label for="perincian">Perincian</label>
        <input name="perincian" rows="3" id="perincian" class="form-control"
            value="{{ $pengeluaran->perincian }}"></input>
    </div>
    <div class="form-group mb-3">
        <label class="form-label" for="lampiran">Lampiran</label>
        <input class="form-control" id="lampiran" name="lampiran" type="file"
            onchange="previewImage('lampiran', 'preview-image1', 'preview-container1')"
            value="{{ $pengeluaran->lampiran }}">
        <!-- Menampilkan pratinjau gambar jika sudah ada -->
        @if ($pengeluaran->lampiran)
            <img id="preview-image1" style="width: 100%; margin-top: 10px;"
                src="{{ asset('storage/uploads/lampiran/img/' . $pengeluaran->lampiran) }}" alt="Preview" />
        @endif
    </div>
    <div class="form-group mb-3">
        <input class="form-control" id="lampiran2" name="lampiran2" type="file"
            onchange="previewImage('lampiran2', 'preview-image2', 'preview-container2')"
            value="{{ $pengeluaran->lampiran2 }}">
        @if ($pengeluaran->lampiran2)
            <img id="preview-image2" style="width: 100%; margin-top: 10px;"
                src="{{ asset('storage/uploads/lampiran/img/' . $pengeluaran->lampiran2) }}" alt="Preview" />
        @endif
    </div>
    <div class="form-group mb-3">
        <input class="form-control" id="lampiran3" name="lampiran3" type="file"
            onchange="previewImage('lampiran3', 'preview-image3', 'preview-container3')"
            value="{{ $pengeluaran->lampiran3 }}">
        @if ($pengeluaran->lampiran3)
            <img id="preview-image3" style="width: 100%; margin-top: 10px;"
                src="{{ asset('storage/uploads/lampiran/img/' . $pengeluaran->lampiran3) }}" alt="Preview" />
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
    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
</form>

<script>
    $(function() {

        // Validasi Juery Mask
        $("#frmpengeluaranedit").find('#jumlah').mask('00.000.000', {
            reverse: true
        });

        // Script validasi inptuan form
        $("#frmpengeluaranedit").submit(function() {
            var kode_matanggaran = $("#frmpengeluaranedit").find("#kode_matanggaran").val();
            var jumlah = $("#frmpengeluaranedit").find("#jumlah").val();
            var tanggal = $("#frmpengeluaranedit").find("#tanggal").val();
            var perincian = $("#frmpengeluaranedit").find("#perincian").val();
            if (kode_matanggaran == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Akun Mata Anggaran Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#kode_matanggaran").focus();
                });
                return false;
            } else if (jumlah == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jumlah Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#jumlah").focus();
                });
                return false;
            } else if (tanggal == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Tanggal Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#tanggal").focus();
                });
                return false;
            } else if (perincian == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Perincian Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#perincian").focus();
                });
                return false;
            }
        });
    });
</script>
