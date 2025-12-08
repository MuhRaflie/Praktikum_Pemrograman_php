<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>

<!-- Notifikasi -->
<?php Flasher::flash(); ?>

<!-- Info Jumlah Data -->
<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> Total: <strong><?php echo $total ?? 0; ?></strong> mahasiswa
</div>

<!-- Form Pencarian -->
<div class="card mb-4">
    <div class="card-body">
        <form action="<?php echo BASEURL; ?>/mahasiswa/cari" method="POST" class="row g-2">
            <div class="col-md-10">
                <input type="text" name="keyword" class="form-control" 
                       placeholder="Cari berdasarkan nama, npm, email, atau jurusan..." 
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
    <a href="<?php echo BASEURL; ?>/mahasiswa/tambah" class="btn btn-success">
        <i class="fas fa-plus"></i> Tambah Data Baru
    </a>
    <a href="<?php echo BASEURL; ?>/mahasiswa" class="btn btn-secondary">
        <i class="fas fa-sync"></i> Refresh
    </a>
</div>

<!-- Tabel Data -->
<?php if (empty($mhs)): ?>
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i> 
        <?php echo isset($keyword) ? 'Data tidak ditemukan untuk pencarian: ' . htmlspecialchars($keyword) : 'Tidak ada data mahasiswa.'; ?>
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($mhs as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td>
                        <span class="badge bg-primary"><?php echo htmlspecialchars($row['npm']); ?></span>
                    </td>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td>
                        <?php if (!empty($row['email'])): ?>
                            <a href="mailto:<?php echo htmlspecialchars($row['email']); ?>">
                                <?php echo htmlspecialchars($row['email']); ?>
                            </a>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge bg-success"><?php echo htmlspecialchars($row['jurusan']); ?></span>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="<?php echo BASEURL; ?>/mahasiswa/detail/<?php echo $row['id']; ?>" 
                               class="btn btn-info" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo BASEURL; ?>/mahasiswa/edit/<?php echo $row['id']; ?>" 
                               class="btn btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?php echo BASEURL; ?>/mahasiswa/delete/<?php echo $row['id']; ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Hapus data <?php echo addslashes($row['nama']); ?>?')"
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