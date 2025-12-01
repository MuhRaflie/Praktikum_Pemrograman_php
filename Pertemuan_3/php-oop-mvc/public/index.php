<?php
// ================================
// FRONT CONTROLLER - TITIK MASUK UTAMA APLIKASI
//

// Mulai session
session_start();

// PERBAIKAN: Sesuaikan dengan path folder Anda
define('BASEURL', 'http://localhost/Praktikum_Pemrograman_php/Pertemuan_3/php-oop-mvc');

// Pastikan file Router (App.php) dimuat
require_once '../core/App.php';

// Instansiasi dan jalankan App (Router)
$app = new App;
?>