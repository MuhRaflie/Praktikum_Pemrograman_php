<h1 class="mb-4"><?php echo htmlspecialchars($judul); ?></h1>
<div class="alert alert-info">
    <h4>Informasi Routing:</h4>
    <p><strong>Parameter 1:</strong> <?php echo htmlspecialchars($param1); ?></p>
    <p><strong>Parameter 2:</strong> <?php echo htmlspecialchars($param2); ?></p>
</div>
<a href="<?php echo BASEURL; ?>" class="btn btn-secondary">Kembali ke Home</a>