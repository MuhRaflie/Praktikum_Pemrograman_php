<?php 
// Definisikan Variabel Informasi Diri 
$nama_lengkap = "Muhammad Farid"; 
$nim = "2310010420"; 
$tahun_masuk = 2023; 
  
// Definisikan Array untuk Hobi 
$hobi_list = [ 
    "Hobi Utama",  
    "Hobi Sampingan",  
    "Hobi Lain" 
]; 
  
// Tampilkan Informasi menggunakan HTML dan PHP 
?> 
<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Profil Praktikan - Bagian 0</title> 
    <style> 
        body { font-family: sans-serif; margin: 40px; } 
        h1 { color: #333; } 
        .data { border: 1px solid #ccc; padding: 15px; border-radius: 8px; max-width: 400px; } 
    </style> 
</head> 
<body> 
  
    <h1>Data Diri Praktikan</h1> 
  
    <div class="data"> 
        <p><strong>Nama:</strong> <?php echo $nama_lengkap; ?></p> 
        <p><strong>NIM:</strong> <?php echo $nim; ?></p> 
        <p><strong>Tahun Masuk:</strong> <?php echo $tahun_masuk; ?></p> 
  
        <h3>Daftar Hobi:</h3> 
        <ul> 
            <?php foreach ($hobi_list as $hobi): ?> 
                <li><?php echo $hobi; ?></li> 
            <?php endforeach; ?> 
        </ul> 
        <p><em>(Pastikan output ini tampil sempurna di browser Anda.)</em></p> 
    </div> 
  
</body> 
</html>