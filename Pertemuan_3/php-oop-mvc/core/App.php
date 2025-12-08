<?php
/**
 * Class App - Router Sederhana
 */
class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // DEBUG: Tampilkan path
        echo "<!-- DEBUG: Router dijalankan -->\n";
        
        // 1. Auto-load semua file core
        $this->loadCoreFiles();
        
        // 2. Dapatkan dan proses URL
        $url = $this->parseURL();
        
        // DEBUG
        echo "<!-- DEBUG: URL = " . print_r($url, true) . " -->\n";

        // 3. Tentukan Controller
        if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // DEBUG
        echo "<!-- DEBUG: Controller = $this->controller -->\n";

        // 4. Muat Controller
        $controllerFile = '../app/controllers/' . $this->controller . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            
            // 5. Buat instance Controller
            $this->controller = new $this->controller;
            
            // 6. Tentukan Method
            if (isset($url[1])) {
                if (method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
            
            // DEBUG
            echo "<!-- DEBUG: Method = $this->method -->\n";

            // 7. Tentukan Parameter
            if (!empty($url)) {
                $this->params = array_values($url);
            }

            // DEBUG
            echo "<!-- DEBUG: Params = " . print_r($this->params, true) . " -->\n";

            // 8. Jalankan Controller
            call_user_func_array([$this->controller, $this->method], $this->params);
            
        } else {
            die("<h2>ERROR: Controller '$this->controller' tidak ditemukan!</h2>");
        }
    }
    
    /**
     * Load semua file core
     */
    private function loadCoreFiles()
    {
        $coreFiles = ['Controller.php', 'Flasher.php', 'Database.php'];
        foreach ($coreFiles as $file) {
            $path = '../core/' . $file;
            if (file_exists($path)) {
                require_once $path;
                echo "<!-- DEBUG: Loaded $file -->\n";
            } else {
                echo "<!-- WARNING: File $file tidak ditemukan -->\n";
            }
        }
    }

    /**
     * Parse URL
     */
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
            // Kapitalisasi huruf pertama controller
            if (!empty($url[0])) {
                $url[0] = ucfirst($url[0]);
            }
            
            return $url;
        }
        return [$this->controller];
    }
}
?>