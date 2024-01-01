<form action="/master/aas/{{ $aas->id }}/updateaas" method="POST" id="frmaasedit">
    @csrf
    <div class="form-group">
        <label for="kode_aas">Kode AAS</label>
        <input type="text" name="kode_aas" id="kode_aas" class="form-control" value="{{ $aas->kode_aas }}">
    </div>
    <div class="form-group">
        <label for="nama_aas">Nama Akun AAS</label>
        <input name="nama_aas" rows="3" id="nama_aas" class="form-control" value="{{ $aas->nama_aas }}"></input>
    </div>
    <button class="btn btn-primary btn-block" id="btnSimpanData">Kirim</button>
</form>

<script>
    $(function() {

        // Script mask inputan kode tidak boleh lebih dari 10 angka
        $("#frmaasedit").find("#kode_aas").mask('0000000000');

        $("#frmaasedit").submit(function() {
            var kode_aas = $("#frmaasedit").find("#kode_aas").val();
            var nama_aas = $("#frmaasedit").find("#nama_aas").val();

            if (kode_aas == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Kode AAS Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#kode_aas").focus();
                });
                return false;
            } else if (nama_aas == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Akun AAS Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    $("#nama_aas").focus();
                });
                return false;
            }
        });
    });
</script>
