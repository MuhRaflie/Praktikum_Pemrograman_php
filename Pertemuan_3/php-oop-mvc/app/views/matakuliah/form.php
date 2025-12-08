<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>

<!-- Notifikasi -->
<?php Flasher::flash(); ?>

<form action="<?php echo $action; ?>" method="POST" class="row g-3" id="formMatakuliah">
    <!-- Hidden field untuk ID (untuk edit) -->
    <?php if (isset($mk['id'])): ?>
        <input type="hidden" name="id" value="<?php echo $mk['id']; ?>">
    <?php endif; ?>
    
    <div class="col-md-6">
        <label for="kode_mk" class="form-label">Kode Matakuliah <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="kode_mk" name="kode_mk" 
               value="<?php echo isset($mk['kode_mk']) ? htmlspecialchars($mk['kode_mk']) : ''; ?>" 
               required placeholder="WEB101" pattern="[A-Z]{3}\d{3}" 
               title="Format: 3 huruf besar + 3 angka (contoh: WEB101)" 
               maxlength="6" style="text-transform:uppercase">
        <div class="form-text">Format: 3 huruf besar + 3 angka (contoh: WEB101)</div>
        <div class="invalid-feedback">Format kode tidak valid</div>
    </div>
    
    <div class="col-md-6">
        <label for="nama_mk" class="form-label">Nama Matakuliah <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="nama_mk" name="nama_mk" 
               value="<?php echo isset($mk['nama_mk']) ? htmlspecialchars($mk['nama_mk']) : ''; ?>" 
               required placeholder="Pemrograman Web 1" maxlength="32">
        <div class="invalid-feedback">Nama matakuliah harus diisi</div>
    </div>
    
    <div class="col-md-4">
        <label for="semester" class="form-label">Semester <span class="text-danger">*</span></label>
        <select class="form-select" id="semester" name="semester" required>
            <option value="">Pilih Semester</option>
            <?php foreach ($semesters as $sem): ?>
                <option value="<?php echo $sem; ?>" 
                    <?php echo (isset($mk['semester']) && $mk['semester'] == $sem) ? 'selected' : ''; ?>>
                    Semester <?php echo $sem; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Pilih semester</div>
    </div>
    
    <div class="col-md-4">
        <label for="sks" class="form-label">SKS <span class="text-danger">*</span></label>
        <select class="form-select" id="sks" name="sks" required>
            <option value="">Pilih SKS</option>
            <?php foreach ($sks_options as $sks): ?>
                <option value="<?php echo $sks; ?>" 
                    <?php echo (isset($mk['sks']) && $mk['sks'] == $sks) ? 'selected' : ''; ?>>
                    <?php echo $sks; ?> SKS
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Pilih jumlah SKS</div>
    </div>
    
    <div class="col-md-4">
        <label for="status_id" class="form-label">Status</label>
        <select class="form-select" id="status_id" name="status_id">
            <?php if (isset($status_options)): ?>
                <?php foreach ($status_options as $value => $label): ?>
                    <option value="<?php echo $value; ?>" 
                        <?php echo (isset($mk['status_id']) && $mk['status_id'] == $value) ? 'selected' : ''; ?>>
                        <?php echo $label; ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="1" selected>Aktif</option>
                <option value="0">Non-Aktif</option>
            <?php endif; ?>
        </select>
    </div>
    
    <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Data
        </button>
        <a href="<?php echo BASEURL; ?>/matakuliah" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</form>

<script>
// Validasi form
(function () {
    'use strict'
    
    var forms = document.querySelectorAll('#formMatakuliah')
    
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
    
    // Auto uppercase untuk kode_mk
    document.getElementById('kode_mk').addEventListener('input', function(e) {
        this.value = this.value.toUpperCase();
    });
})()
</script>