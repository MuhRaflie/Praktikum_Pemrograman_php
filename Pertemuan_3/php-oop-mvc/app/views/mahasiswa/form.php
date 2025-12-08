<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>

<!-- Notifikasi -->
<?php Flasher::flash(); ?>

<form action="<?php echo $action; ?>" method="POST" class="row g-3" id="formMahasiswa">
    <!-- Hidden field untuk ID (untuk edit) -->
    <?php if (isset($mhs['id'])): ?>
        <input type="hidden" name="id" value="<?php echo $mhs['id']; ?>">
    <?php endif; ?>
    
    <div class="col-md-6">
        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="nama" name="nama" 
               value="<?php echo isset($mhs['nama']) ? htmlspecialchars($mhs['nama']) : ''; ?>" 
               required placeholder="Masukkan nama lengkap">
        <div class="invalid-feedback">Nama harus diisi</div>
    </div>
    
    <div class="col-md-6">
        <label for="npm" class="form-label">NPM <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="npm" name="npm" 
               value="<?php echo isset($mhs['npm']) ? htmlspecialchars($mhs['npm']) : ''; ?>" 
               required placeholder="Contoh: 2023001" pattern="\d{7,}" 
               title="NPM harus angka minimal 7 digit">
        <div class="invalid-feedback">NPM harus angka minimal 7 digit</div>
    </div>
    
    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" 
               value="<?php echo isset($mhs['email']) ? htmlspecialchars($mhs['email']) : ''; ?>" 
               placeholder="nama@example.com">
        <div class="invalid-feedback">Format email tidak valid</div>
    </div>
    
    <div class="col-md-6">
        <label for="jurusan" class="form-label">Jurusan <span class="text-danger">*</span></label>
        <select class="form-select" id="jurusan" name="jurusan" required>
            <option value="">Pilih Jurusan</option>
            <option value="Teknik Informatika" <?php echo (isset($mhs['jurusan']) && $mhs['jurusan'] == 'Teknik Informatika') ? 'selected' : ''; ?>>
                Teknik Informatika
            </option>
            <option value="Sistem Informasi" <?php echo (isset($mhs['jurusan']) && $mhs['jurusan'] == 'Sistem Informasi') ? 'selected' : ''; ?>>
                Sistem Informasi
            </option>
            <option value="Teknik Elektro" <?php echo (isset($mhs['jurusan']) && $mhs['jurusan'] == 'Teknik Elektro') ? 'selected' : ''; ?>>
                Teknik Elektro
            </option>
            <option value="Manajemen" <?php echo (isset($mhs['jurusan']) && $mhs['jurusan'] == 'Manajemen') ? 'selected' : ''; ?>>
                Manajemen
            </option>
            <option value="Akuntansi" <?php echo (isset($mhs['jurusan']) && $mhs['jurusan'] == 'Akuntansi') ? 'selected' : ''; ?>>
                Akuntansi
            </option>
            <option value="Lainnya" <?php echo (isset($mhs['jurusan']) && $mhs['jurusan'] == 'Lainnya') ? 'selected' : ''; ?>>
                Lainnya
            </option>
        </select>
        <div class="invalid-feedback">Pilih jurusan</div>
    </div>
    
    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Data
        </button>
        <a href="<?php echo BASEURL; ?>/mahasiswa" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</form>

<script>
// Validasi form dengan Bootstrap
(function () {
    'use strict'
    
    var forms = document.querySelectorAll('#formMahasiswa')
    
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                
                form.classList.add('was-validated')
            }, false)
        })
})()
</script>