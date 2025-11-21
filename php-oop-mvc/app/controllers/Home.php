<?php
/**
 * Controller Default: Home
 * Controller ini akan dipanggil jika tidak ada controller spesifik yang diminta di URL.
 */
class Home
{
    /**
     * Method default untuk Home Controller
     */
    public function index()
    {
        // Memuat view instead of echo langsung
        $this->view('home/index');
    }

    /**
     * Method untuk menguji parameter routing
     */
    public function test($param1 = 'TIDAK ADA', $param2 = 'TIDAK ADA')
    {
        // Tampilkan view untuk test
        echo "<h1>🧪 Uji Coba Parameter Routing</h1>";
        echo "<div style='background: #f0f8ff; padding: 20px; border-radius: 10px;'>";
        echo "<p>Anda berhasil memanggil: <strong>Controller Home</strong>, Method: <strong>test()</strong></p>";
        echo "<p>Parameter 1: <strong style='color: #e74c3c;'>{$param1}</strong></p>";
        echo "<p>Parameter 2: <strong style='color: #e74c3c;'>{$param2}</strong></p>";
        echo "</div>";
        echo "<a href='/' style='display: inline-block; margin-top: 20px; padding: 10px 15px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;'>← Kembali ke Home</a>";
    }

    /**
     * Method helper untuk memuat view
     */
    private function view($viewPath, $data = [])
    {
        $fullPath = '../app/views/' . $viewPath . '.php';
        if (file_exists($fullPath)) {
            extract($data);
            require_once $fullPath;
        } else {
            echo "View tidak ditemukan: " . $fullPath;
        }
    }
}
?>