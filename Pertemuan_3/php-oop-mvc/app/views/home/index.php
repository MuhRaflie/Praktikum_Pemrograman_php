<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>

<div class="alert alert-success">
    <h4>🎉 Selamat! MVC Framework Anda Berjalan!</h4>
    <p>Halo, <?php echo htmlspecialchars($nama); ?>!</p>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">📋 Data Mahasiswa</h5>
                <p class="card-text">Lihat dan kelola data mahasiswa.</p>
                <a href="<?php echo BASEURL; ?>/mahasiswa" class="btn btn-primary">Lihat Data</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">➕ Tambah Data</h5>
                <p class="card-text">Tambahkan data mahasiswa baru.</p>
                <a href="<?php echo BASEURL; ?>/mahasiswa/tambah" class="btn btn-success">Tambah Data</a>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">🔗 Test Routing</h5>
            <p class="card-text">Coba test routing dengan parameter.</p>
            <a href="<?php echo BASEURL; ?>/Home/test/parameter1/parameter2" class="btn btn-warning">Test Routing</a>
        </div>
    </div>
</div>

<!-- Tambahkan card baru di row -->
<div class="col-md-4 mb-3">
    <div class="card">
        <div class="card-body">
            <i class="fas fa-book fa-3x text-info mb-3"></i>
            <h5 class="card-title">📚 Matakuliah</h5>
            <p class="card-text">Kelola data matakuliah (CRUD).</p>
            <a href="<?php echo BASEURL; ?>/matakuliah" class="btn btn-info">Lihat Matakuliah</a>
        </div>
    </div>
</div>