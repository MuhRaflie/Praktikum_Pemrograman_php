<?php
// Auto-load Flasher
require_once 'Flasher.php';

class Controller
{
    /** 
     * Metode untuk memuat View (Tampilan HTML)
     * @param string $view Nama file view (path relatif dari app/views/)
     * @param array $data Data yang akan dikirimkan ke view
     */
    public function view($view, $data = [])
    {
        // Ekstrak data array menjadi variabel individual.
        // Contoh: $data['nama'] menjadi $nama, tersedia langsung di View.
        if (!empty($data)) {
            extract($data);
        }
        
        // Tentukan path lengkap file view
        $viewPath = '../app/views/' . $view . '.php';
        
        // Cek apakah file view ada
        if (file_exists($viewPath)) {
            // Muat file view
            require_once $viewPath;
        } else {
            // Tampilkan pesan error jika view tidak ditemukan
            die("<h3>Error: File View tidak ditemukan di '$viewPath'</h3>");
        }
    }
    
    /**
     * Metode untuk memuat Model
     * @param string $model Nama kelas Model
     * @return object Instansi dari kelas Model
     */
    public function model($model)
    {
        // Tentukan path model
        $modelPath = '../app/models/' . $model . '.php';
        
        // Cek apakah file model ada
        if (file_exists($modelPath)) {
            require_once $modelPath;
            
            // Instansiasi model
            return new $model();
        } else {
            die("<h3>Error: File Model tidak ditemukan di '$modelPath'</h3>");
        }
    }
}
?>