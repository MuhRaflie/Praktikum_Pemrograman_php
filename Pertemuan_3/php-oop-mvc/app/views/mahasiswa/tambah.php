<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>

<form action="<?php echo BASEURL; ?>/mahasiswa/store" method="POST" class="row g-3">
    <div class="col-md-6">
        <label for="nama" class="form-label">Nama Lengkap *</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    
    <div class="col-md-6">
        <label for="npm" class="form-label">NPM *</label>
        <input type="text" class="form-control" id="npm" name="npm" required>
    </div>
    
    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    
    <div class="col-md-6">
        <label for="jurusan" class="form-label">Jurusan *</label>
        <select class="form-select" id="jurusan" name="jurusan" required>
            <option value="">Pilih Jurusan</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknik Elektro">Teknik Elektro</option>
            <option value="Manajemen">Manajemen</option>
        </select>
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