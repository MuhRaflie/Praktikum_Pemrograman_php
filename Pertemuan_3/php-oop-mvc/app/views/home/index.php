<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>
<p class="lead">Selamat datang di aplikasi MVC sederhana.</p>

<div class="row mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users text-primary"></i> Data Mahasiswa</h5>
                <p class="card-text">Kelola data mahasiswa dengan operasi CRUD lengkap.</p>
                <a href="<?php echo BASEURL; ?>/mahasiswa" class="btn btn-primary">Lihat Data</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-plus-circle text-success"></i> Tambah Data</h5>
                <p class="card-text">Tambahkan data mahasiswa baru ke dalam sistem.</p>
                <a href="<?php echo BASEURL; ?>/mahasiswa/tambah" class="btn btn-success">Tambah Data</a>
            </div>
        </div>
    </div>
</div>