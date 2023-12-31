<form action="/master/aas/{{ $aas->id }}/updateaas" method="POST" id="frmEditAas">
    @csrf
    <div class="form-group">
        <label for="kode_aas">Kode AAS</label>
        <input type="text" name="kode_aas" id="kode_aas" class="form-control" value="{{ $aas->kode_aas }}">
    </div>
    <div class="form-group">
        <label for="nama_aas">Nama Akun AAS</label>
        <input name="nama_aas" rows="3" id="nama-aas" class="form-control" value="{{ $aas->nama_aas }}"></input>
    </div>
    <button type="submit" class="btn btn-primary btn-block" id="btnSimpanData">Kirim</button>
</form>
<script>
    // Proses simpan dengan AJAX
    $("#frmEditAas").submit(function(e) {
        // Validasi input
        if (kode_aas === "" || nama_aas === "") {
            Swal.fire({
                title: "Warning!",
                text: "Kode Akun AAS dan Nama Akun harus diisi",
                icon: "warning",
                confirmButtonText: "OK"
            });
            return false;
        }
    });
</script>
