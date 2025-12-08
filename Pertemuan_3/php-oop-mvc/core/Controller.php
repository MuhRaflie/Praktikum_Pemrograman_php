<?php
/**
 * Class Controller - Base Controller untuk semua controller
 */
class Controller
{
    /**
     * Memuat View
     */
    public function view($view, $data = [])
    {
        // 1. Extract data menjadi variabel
        if (!empty($data)) {
            extract($data);
        }
        
        // 2. Tentukan path view
        $viewPath = '../app/views/' . $view . '.php';
        
        // 3. Cek apakah file view ada
        if (file_exists($viewPath)) {
            // 4. Mulai buffer output
            ob_start();
            
            // 5. Include view file
            include $viewPath;
            
            // 6. Dapatkan konten dari buffer
            $content = ob_get_clean();
            
            // 7. Tampilkan konten
            echo $content;
        } else {
            // Jika view tidak ditemukan
            echo "<div class=\"alert alert-danger\">
                    <h4>Error: View tidak ditemukan</h4>
                    <p>File: <code>$viewPath</code> tidak ditemukan.</p>
                  </div>";
        }
    }
    
    /**
     * Memuat Model
     */
    public function model($model)
    {
        // 1. Tentukan path model
        $modelPath = '../app/models/' . $model . '.php';
        
        // 2. Cek apakah file model ada
        if (file_exists($modelPath)) {
            // 3. Load file model
            require_once $modelPath;
            
            // 4. Return instance model
            return new $model();
        } else {
            // Jika model tidak ditemukan
            die("<div class=\"alert alert-danger\">
                    <h4>Error: Model tidak ditemukan</h4>
                    <p>File: <code>$modelPath</code> tidak ditemukan.</p>
                  </div>");
        }
    }
}
?>