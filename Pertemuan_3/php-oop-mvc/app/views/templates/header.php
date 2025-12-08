<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($judul) ? htmlspecialchars($judul) : 'MVC Framework'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 20px; }
        .navbar { margin-bottom: 20px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASEURL; ?>">
                <i class="fas fa-graduation-cap"></i> UNISKA MVC
            </a>
            <div class="navbar-nav">
                <a class="nav-link" href="<?php echo BASEURL; ?>">Home</a>
                <a class="nav-link" href="<?php echo BASEURL; ?>/mahasiswa">Data Mahasiswa</a>
                <a class="nav-link" href="<?php echo BASEURL; ?>/Home/test/a/b">Test Routing</a>
            </div>
            <!-- Di dalam navbar, tambahkan link: -->
<li class="nav-item">
    <a class="nav-link" href="<?php echo BASEURL; ?>/matakuliah">
        <i class="fas fa-book"></i> Matakuliah
    </a>
</li>
        </div>
    </nav>
    
    <div class="container">