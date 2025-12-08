<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Detail Matakuliah</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 fw-bold">Kode MK:</div>
            <div class="col-md-9">
                <span class="badge bg-primary"><?php echo htmlspecialchars($mk['kode_mk']); ?></span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">Nama Matakuliah:</div>
            <div class="col-md-9"><?php echo htmlspecialchars($mk['nama_mk']); ?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">Semester:</div>
            <div class="col-md-9">
                <span class="badge bg-info">Semester <?php echo htmlspecialchars($mk['semester']); ?></span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">SKS:</div>
            <div class="col-md-9">
                <span class="badge bg-secondary"><?php echo htmlspecialchars($mk['sks']); ?> SKS</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">Status:</div>
            <div class="col-md-9">
                <?php if ($mk['status_id'] == 1): ?>
                    <span class="badge bg-success">Aktif</span>
                <?php else: ?>
                    <span class="badge bg-danger">Non-Aktif</span>
                <?php endif; ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">Dibuat:</div>
            <div class="col-md-9"><?php echo date('d-m-Y H:i', strtotime($mk['created_at'])); ?></div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 fw-bold">Terakhir Diupdate:</div>
            <div class="col-md-9"><?php echo date('d-m-Y H:i', strtotime($mk['updated_at'])); ?></div>
        </div>
    </div>
    <div class="card-footer">
        <a href="<?php echo BASEURL; ?>/matakuliah/edit/<?php echo $mk['id']; ?>" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="<?php echo BASEURL; ?>/matakuliah/delete/<?php echo $mk['id']; ?>" 
           class="btn btn-danger" 
           onclick="return confirm('Yakin menghapus matakuliah ini?')">
            <i class="fas fa-trash"></i> Hapus
        </a>
        <a href="<?php echo BASEURL; ?>/matakuliah" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>