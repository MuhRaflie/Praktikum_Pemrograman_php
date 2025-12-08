<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Detail Data Mahasiswa</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 fw-bold">Nama:</div>
            <div class="col-md-9"><?php echo htmlspecialchars($mhs['nama']); ?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">NPM:</div>
            <div class="col-md-9"><?php echo htmlspecialchars($mhs['npm']); ?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">Email:</div>
            <div class="col-md-9">
                <?php echo !empty($mhs['email']) ? htmlspecialchars($mhs['email']) : '<em class="text-muted">Tidak ada</em>'; ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">Jurusan:</div>
            <div class="col-md-9"><?php echo htmlspecialchars($mhs['jurusan']); ?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">Dibuat:</div>
            <div class="col-md-9"><?php echo date('d-m-Y H:i', strtotime($mhs['created_at'])); ?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">Terakhir Diupdate:</div>
            <div class="col-md-9"><?php echo date('d-m-Y H:i', strtotime($mhs['updated_at'])); ?></div>
        </div>
    </div>
    <div class="card-footer">
        <a href="<?php echo BASEURL; ?>/mahasiswa/edit/<?php echo $mhs['id']; ?>" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="<?php echo BASEURL; ?>/mahasiswa/delete/<?php echo $mhs['id']; ?>" 
           class="btn btn-danger" 
           onclick="return confirm('Yakin menghapus data ini?')">
            <i class="fas fa-trash"></i> Hapus
        </a>
        <a href="<?php echo BASEURL; ?>/mahasiswa" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>