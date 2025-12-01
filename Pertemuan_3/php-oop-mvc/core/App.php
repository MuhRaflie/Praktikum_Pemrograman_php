<?php
class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // 1. Load Base Controller - PASTIKAN PATH BENAR
        $controllerPath = '../core/Controller.php';
        if (file_exists($controllerPath)) {
            require_once $controllerPath;
        } else {
            die("ERROR: File Controller.php tidak ditemukan di: $controllerPath");
        }
        
        // 2. Dapatkan dan proses URL
        $url = $this->parseURL();

        // 3. Tentukan Controller
        if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // 4. Muat Controller yang benar
        $controllerFile = '../app/controllers/' . $this->controller . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
        } else {
            die("ERROR: Controller '$this->controller' tidak ditemukan di: $controllerFile");
        }

        // 5. Buat instansi Controller
        $this->controller = new $this->controller;

        // 6. Tentukan Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 7. Tentukan Parameter
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // 8. Jalankan Controller, Method, dan kirimkan Parameter
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            if (!empty($url[0])) {
                $url[0] = ucfirst($url[0]);
            }

            return $url;
        }
        return [$this->controller];
    }
}
?>