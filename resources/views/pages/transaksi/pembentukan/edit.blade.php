<form action="/transaksi/pembentukan/{{ $transaksi->id }}/update" method="post" id="frmpembentukanedit">
    @csrf
    <div class="form-group">
        <label for="edit_kode_matanggaran" class="form-label">Mata Anggaran</label>
        <select name="kode_matanggaran" id="edit_kode_matanggaran" class="form-select form-control">
            <option value="">- Pilih Akun Mata Anggaran -</option>
            @foreach ($matanggaran as $d)
                @if ($d->status == 'k' && $d->kategori == 'pembentukan')
                    <option value="{{ $d->kode_matanggaran }}" {{ $pembentukan->kode_matanggaran == $d->kode_matanggaran ? 'selected' : '' }}>
                        {{ $d->kode_matanggaran }} | {{ $d->nama_aas }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="edit_jumlah" class="form-label">Jumlah (Rp)</label>
        <input type="text" name="jumlah" id="edit_jumlah" class="form-control" value="{{ $pembentukan->jumlah }}">
    </div>
    
    <input type="hidden" name="kategori" id="edit_kategori" value="pembentukan">
    
    <div class="form-group">
        <label for="edit_tanggal" class="form-label">Tanggal</label>
        <input type="date" name="tanggal" id="edit_tanggal" class="form-control" value="{{ $pembentukan->tanggal }}">
    </div>

    <div class="form-group">
        <label for="edit_perincian" class="form-label">Perincian</label>
        <textarea name="perincian" id="edit_perincian" class="form-control" placeholder="Masukkan perincian transaksi">{{ $pembentukan->perincian }}</textarea>
    </div>
    
    <button type="submit" class="btn-modern btn-success-modern w-100">
        <i class="fas fa-save"></i>
        Update Data
    </button>
</form>

<style>
    #frmpembentukanedit .form-group {
        margin-bottom: 22px;
    }

    #frmpembentukanedit .form-label {
        display: block;
        color: #374151;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    #frmpembentukanedit .form-control,
    #frmpembentukanedit .form-select {
        padding: 13px 18px;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        font-size: 14px;
        transition: all 0.3s ease;
        width: 100%;
        background: #ffffff;
        color: #111827;
        font-weight: 500;
    }

    #frmpembentukanedit .form-control::placeholder {
        color: #9CA3AF;
        font-weight: 400;
    }

    #frmpembentukanedit .form-control:focus,
    #frmpembentukanedit .form-select:focus {
        border-color: #0053C5;
        box-shadow: 0 0 0 4px #F5F9FF;
        outline: none;
    }

    #frmpembentukanedit .form-select {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%234B5563' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 16px 12px;
        padding-right: 40px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    #frmpembentukanedit .form-select option {
        color: #111827;
        background: #ffffff;
        padding: 10px;
        font-weight: 500;
    }

    #frmpembentukanedit .form-select option:disabled {
        color: #9CA3AF;
        font-style: italic;
    }

    #frmpembentukanedit textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    #frmpembentukanedit .btn-modern {
        padding: 12px 26px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    #frmpembentukanedit .btn-success-modern {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    #frmpembentukanedit .btn-success-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    #frmpembentukanedit .btn-success-modern:active {
        transform: scale(0.98);
    }
</style>

<script>
    $(function() {
        // Validasi jQuery Mask
        $("#edit_jumlah").mask('000.000.000', {
            reverse: true
        });

        // Script validasi inputan form
        $("#frmpembentukanedit").submit(function(e) {
            var kode_matanggaran = $("#edit_kode_matanggaran").val();
            var jumlah = $("#edit_jumlah").val();
            var tanggal = $("#edit_tanggal").val();
            var perincian = $("#edit_perincian").val();
            
            if (kode_matanggaran == "") {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Akun Mata Anggaran harus dipilih',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                }).then((result) => {
                    $("#edit_kode_matanggaran").focus();
                });
                return false;
            } else if (jumlah == "") {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Jumlah harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                }).then((result) => {
                    $("#edit_jumlah").focus();
                });
                return false;
            } else if (tanggal == "") {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Tanggal harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                }).then((result) => {
                    $("#edit_tanggal").focus();
                });
                return false;
            } else if (perincian == "") {
                e.preventDefault();
                Swal.fire({
                    title: 'Perhatian!',
                    text: 'Perincian harus diisi',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0053C5'
                }).then((result) => {
                    $("#edit_perincian").focus();
                });
                return false;
            }
        });
    });
</script>