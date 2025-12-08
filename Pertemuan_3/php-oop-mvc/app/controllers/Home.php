<?php
/**
 * Controller Home
 */
class Home extends Controller
{
    public function index()
    {
        // Data untuk view
        $data = [
            'judul' => 'Dashboard MVC Framework',
            'nama' => 'Mahasiswa UNISKA'
        ];
        
        // Load view
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
    
    public function test($param1 = 'default1', $param2 = 'default2')
    {
        $data = [
            'judul' => 'Test Routing',
            'param1' => $param1,
            'param2' => $param2
        ];
        
        $this->view('templates/header', $data);
        $this->view('home/test', $data);
        $this->view('templates/footer');
    }
}
?>