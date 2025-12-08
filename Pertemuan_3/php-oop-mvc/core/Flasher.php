<?php
class Flasher
{
    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe,
            'timestamp' => time()
        ];
    }
    
    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            $icon = '';
            switch ($_SESSION['flash']['tipe']) {
                case 'success':
                    $icon = 'fas fa-check-circle';
                    break;
                case 'danger':
                    $icon = 'fas fa-times-circle';
                    break;
                case 'warning':
                    $icon = 'fas fa-exclamation-triangle';
                    break;
                case 'info':
                    $icon = 'fas fa-info-circle';
                    break;
            }
            
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
                    <i class="' . $icon . ' me-2"></i>
                    <strong>' . ucfirst($_SESSION['flash']['pesan']) . '</strong> ' . $_SESSION['flash']['aksi'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            
            unset($_SESSION['flash']);
        }
    }
}
?>