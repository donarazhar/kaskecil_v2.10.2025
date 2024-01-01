<form action="/master/matanggaran/{{ $matanggaran->id }}/updatematanggaran" method="POST" id="frmmatanggaranedit">
    @csrf
    <div class="form-group">
        <label for="kode_matanggaran">Kode Mata Anggaran</label>
        <input type="text" name="kode_matanggaran" id="kode_matanggaran" class="form-control"
            value="{{ $matanggaran->kode_matanggaran }}">
    </div>
    <div class="form-group">
        <label for="Kode_aas">Nama Akun Mata Anggaran</label>
        <select name="kode_aas" id="kode_aas" class="form-select">
            <option value="{{ $matanggaran->kode_aas }}">{{ $matanggaran->kode_aas }} | {{ $matanggaran->nama_aas }}
            </option>
            @foreach ($aas as $d)
                <option value="{{ $d->kode_aas }}">
                    {{ $d->kode_aas }} | {{ $d->nama_aas }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary btn-block" id="btnSimpanData">Kirim</button>
</form>

<script>
    $(function() {

        // Script mask inputan kode tidak boleh lebih dari 10 angka
        $("#frmmatanggaranedit").find("#kode_matanggaran").mask('0.0.0000');

        $("#frmmatanggaranedit").submit(function() {
            var kode_matanggaran = $("#frmmatanggaranedit").find("#kode_matanggaran").val();
            var kode_aas = $("#frmmatanggaranedit").find("#kode_aas").val();

            if (kode_aas == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Akun Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#kode_aas").focus();
                });
                return false;
            } else if (kode_matanggaran == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kode Mata Anggaran Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#kode_matanggaran").focus();
                });
                return false;
            }
        });
    });
</script>
