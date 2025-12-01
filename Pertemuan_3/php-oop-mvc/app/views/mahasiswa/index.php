<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>

<!-- Flash Message -->
<?php Flasher::flash(); ?>

<!-- Tombol Tambah -->
<a href="<?php echo BASEURL; ?>/mahasiswa/tambah" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Tambah Data
</a>

<!-- Tabel Data -->
<table class="table table-striped">
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
        <?php if (empty($mhs)): ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data mahasiswa.</td>
            </tr>
        <?php else: ?>
            <?php $no = 1; ?>
            <?php foreach ($mhs as $row): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['npm']); ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['jurusan']); ?></td>
                <td>
                    <a href="<?php echo BASEURL; ?>/mahasiswa/edit/<?php echo $row['id']; ?>" 
                       class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="<?php echo BASEURL; ?>/mahasiswa/delete/<?php echo $row['id']; ?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('Yakin menghapus?')">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>