<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>

<!-- Notifikasi -->
<?php Flasher::flash(); ?>

<!-- Info -->
<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> 
    <?php if (isset($semester_filter)): ?>
        Semester <?php echo $semester_filter; ?> | 
        Total SKS: <strong><?php echo $total_sks ?? 0; ?></strong> |
    <?php endif; ?>
    Total Matakuliah: <strong><?php echo count($mk ?? []); ?></strong>
</div>

<!-- Filter Semester -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title"><i class="fas fa-filter"></i> Filter by Semester</h5>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?php echo BASEURL; ?>/matakuliah" class="btn btn-outline-primary">
                Semua
            </a>
            <?php foreach ($semesters as $sem): ?>
                <a href="<?php echo BASEURL; ?>/matakuliah/semester/<?php echo $sem; ?>" 
                   class="btn btn-outline-primary <?php echo (isset($semester_filter) && $semester_filter == $sem) ? 'active' : ''; ?>">
                    Semester <?php echo $sem; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Form Pencarian -->
<div class="card mb-4">
    <div class="card-body">
        <form action="<?php echo BASEURL; ?>/matakuliah/cari" method="POST" class="row g-2">
            <div class="col-md-10">
                <input type="text" name="keyword" class="form-control" 
                       placeholder="Cari berdasarkan kode, nama, atau semester..." 
                       value="<?php echo isset($keyword) ? htmlspecialchars($keyword) : ''; ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tombol Aksi -->
<div class="mb-3">
    <a href="<?php echo BASEURL; ?>/matakuliah/tambah" class="btn btn-success">
        <i class="fas fa-plus"></i> Tambah Matakuliah
    </a>
    <a href="<?php echo BASEURL; ?>/matakuliah" class="btn btn-secondary">
        <i class="fas fa-sync"></i> Refresh
    </a>
</div>

<!-- Tabel Data -->
<?php if (empty($mk)): ?>
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i> 
        <?php echo isset($keyword) ? 'Data tidak ditemukan untuk pencarian: ' . htmlspecialchars($keyword) : 'Tidak ada data matakuliah.'; ?>
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Kode MK</th>
                    <th>Nama Matakuliah</th>
                    <th>Semester</th>
                    <th>SKS</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($mk as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td>
                        <span class="badge bg-primary"><?php echo htmlspecialchars($row['kode_mk']); ?></span>
                    </td>
                    <td><?php echo htmlspecialchars($row['nama_mk']); ?></td>
                    <td>
                        <span class="badge bg-info">Semester <?php echo htmlspecialchars($row['semester']); ?></span>
                    </td>
                    <td>
                        <span class="badge bg-secondary"><?php echo htmlspecialchars($row['sks']); ?> SKS</span>
                    </td>
                    <td>
                        <?php if ($row['status_id'] == 1): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Non-Aktif</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="<?php echo BASEURL; ?>/matakuliah/detail/<?php echo $row['id']; ?>" 
                               class="btn btn-info" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo BASEURL; ?>/matakuliah/edit/<?php echo $row['id']; ?>" 
                               class="btn btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?php echo BASEURL; ?>/matakuliah/delete/<?php echo $row['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Hapus matakuliah <?php echo addslashes($row['nama_mk']); ?>?')"
                               title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>