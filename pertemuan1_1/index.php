<?php
// 1. Masukkan (include) file class Mahasiswa.
require_once 'Mahasiswa.php';

// 2. Instansiasi Objek (Menciptakan objek nyata dari blueprint Mahasiswa)
$mhs1 = new Mahasiswa();

// 3. Mengisi Properti Objek (Mengakses data di dalam objek)
$mhs1->nama = "Muhammad Raflie Ramadhan";
$mhs1->nim = "2310010432";

// 4. Membuat objek kedua (optional, untuk menunjukkan setiap objek unik)
$mhs2 = new Mahasiswa();
$mhs2->nama = "Sinta Dewi";
$mhs2->nim = "2023006";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Modul 1: Dasar OOP</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f9; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 20px auto; background-color: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
        h1 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        h2 { color: #34495e; margin-top: 30px; }
        .output { background-color: #ecf0f1; border-left: 5px solid #3498db; padding: 15px; margin-bottom: 20px; border-radius: 6px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modul 1: Konsep Dasar OOP (Class & Object)</h1>

        <h2>Objek Pertama: <?php echo $mhs1->nama; ?></h2>
        <div class="output">
            <!-- 5. Memanggil Metode Objek -->
            <?php $mhs1->sayHello(); ?>
        </div>

        <h2>Objek Kedua: <?php echo $mhs2->nama; ?></h2>
        <div class="output">
            <!-- Memanggil Metode Objek Kedua -->
            <?php $mhs2->sayHello(); ?>
        </div>

        <p class="mt-4">
            <em>(Lihat kode di 'Mahasiswa.php' untuk definisi kelas, dan kode di 'index.php' untuk cara menggunakannya.)</em>
        </p>
    </div>
</body>
</html>