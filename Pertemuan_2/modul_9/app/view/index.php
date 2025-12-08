<?php 
// Memanggil header
require_once __DIR__ . '/../templates/header.php'; 
?>

<!-- Konten Spesifik Halaman Home -->
<h1><?php echo isset($judul) ? htmlspecialchars($judul) : 'Selamat Datang!'; ?></h1> 
<h2>Framework MVC Lokal Anda</h2> 
<p>Aplikasi ini dijalankan oleh <strong>Controller Home</strong> melalui <strong>Metode index()</strong>.</p> 

<?php if (isset($nama)) : ?> 
    <div class="info-box"> 
        <p>Data dinamis berhasil dikirimkan dari Controller:</p> 
        <p>Halo, nama saya adalah <strong><?php echo htmlspecialchars($nama); ?></strong>.</p> 
    </div> 
<?php endif; ?> 

<p>Lanjutkan ke Modul 9 untuk integrasi Model dan data yang sesungguhnya!</p>

<?php 
// Memanggil footer
require_once __DIR__ . '/../templates/footer.php'; 
?>