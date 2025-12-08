<?php
// ================================
// FRONT CONTROLLER - TITIK MASUK UTAMA
// ================================

// 1. Mulai session
session_start();

// 2. Definisikan BASEURL
define('BASEURL', 'http://localhost/Praktikum_Pemrograman_php/Pertemuan_3/php-oop-mvc/public');

// 3. Tampilkan header untuk debugging
echo "<!DOCTYPE html>
<html>
<head>
    <title>MVC Framework</title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
        .debug-info { background: #f8f9fa; padding: 10px; margin: 10px 0; border-left: 4px solid #007bff; }
    </style>
</head>
<body>
<div class=\"container mt-4\">
<div class=\"debug-info\">
    <strong>DEBUG INFO:</strong><br>
    BASEURL: " . BASEURL . "<br>
    Requested URL: " . ($_GET['url'] ?? '/') . "
</div>";

// 4. Load Router
require_once '../core/App.php';

// 5. Jalankan aplikasi
try {
    $app = new App();
} catch (Exception $e) {
    echo "<div class=\"alert alert-danger\">
            <h4>Error:</h4>
            <pre>" . htmlspecialchars($e->getMessage()) . "</pre>
          </div>";
}

echo "</div></body></html>";
?>