<?php
// 1. Masukkan (include) file class Mahasiswa.
require_once 'Mahasiswa.php';

// 2. Instansiasi Objek DENGAN PARAMETER
// $mhs1 (NIM valid)
$mhs1 = new Mahasiswa("Muhammad Raflie Ramadhan", "2310010432");

// $mhs2 (NIM tidak valid, akan ditolak oleh konstruktor/setter)
$mhs2 = new Mahasiswa("Citra Kirana", "20230000002"); // NIM 11 digit

// 3. Demonstrasi Akses Data (Setter/Getter)

// Mencoba mengubah NIM (Setter) - Sukses
echo "<h3 style='color:#296009;'>--- DEMO SETTER (mhs1) ---</h3>";
$mhs1->setNim("2310010432"); // 10 digit - Sukses

// Mencoba mengubah NIM (Setter) - Gagal (validasi di dalam setter menolak)
$mhs1->setNim("999"); // 3 digit - Gagal
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Modul 3: Encapsulation</title>
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
        <h1>Modul 3: Encapsulation (Pengamanan Data)</h1>

        <h2>Objek Pertama: <?php echo $mhs1->nama; ?></h2>
        <div class="output">
            <!-- 4. Memanggil Metode Objek -->
            <?php $mhs1->sayHello(); ?>
            <p><strong>NIM Saat Ini (via Getter):</strong> <span style="font-weight: bold; color: #e67e22;"><?php echo $mhs1->getNim(); ?></span></p>
        </div>

        <h2>Objek Kedua: <?php echo $mhs2->nama; ?></h2>
        <div class="output">
            <!-- Memanggil Metode Objek Kedua -->
            <?php $mhs2->sayHello(); ?>
            <p><strong>NIM Saat Ini (via Getter):</strong> <span style="font-weight: bold; color: #e67e22;"><?php echo $mhs2->getNim(); ?></span></p>
            <p style="color: red;">*Objek ini dibuat dengan NIM tidak valid, namun Setter mencegahnya masuk ke properti.</p>
        </div>

        <p>
            <em>(Coba hapus method **getNim()** dari kode dan akses NIM secara langsung: **$mhs1->nim**. Anda akan mendapatkan Fatal Error karena NIM bersifat private!)</em>
        </p>
    </div>
</body>
</html>