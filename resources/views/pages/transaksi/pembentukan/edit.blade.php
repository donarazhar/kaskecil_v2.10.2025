<form action="/transaksi/pembentukan/{{ $transaksi->id }}/update" method="post" id="frmpembentukanedit">
    @csrf
    <div class="form-group">
        <label for="nama_matanggaran">Mata Anggaran</label>
        <select name="kode_matanggaran" id="kode_matanggaran" class="form-select">
            <option value="{{ $pembentukan->kode_matanggaran }}">{{ $pembentukan->kode_matanggaran }} |
                {{ $pembentukan->nama_aas }}
            </option>
            @foreach ($matanggaran as $d)
                @if ($d->status == 'k' && $d->kategori == 'pembentukan')
                    <option value="{{ $d->kode_matanggaran }}">
                        {{ $d->kode_matanggaran }} | {{ $d->nama_aas }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <input type="text" name="jumlah" id="jumlah" class="form-control" value="{{ $pembentukan->jumlah }}">
    </div>
    <input type="hidden" name="kategori" id="kategori" value="pembentukan">
    <div class="form-group">
        <label for="">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $pembentukan->tanggal }}">
    </div>

    <div class="form-group">
        <label for="perincian">Perincian</label>
        <input name="perincian" rows="3" id="perincian" class="form-control"
            value="{{ $pembentukan->perincian }}"></input>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
</form>

<script>
    $(function() {

        // Validasi Juery Mask
        $("#frmpembentukanedit").find('#jumlah').mask('000.000.000', {
            reverse: true
        });

        // Script validasi inptuan form
        $("#frmpembentukanedit").submit(function() {
            var kode_matanggaran = $("#frmpembentukanedit").find("#kode_matanggaran").val();
            var jumlah = $("#frmpembentukanedit").find("#jumlah").val();
            var tanggal = $("#frmpembentukanedit").find("#tanggal").val();
            var perincian = $("#frmpembentukanedit").find("#perincian").val();
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
