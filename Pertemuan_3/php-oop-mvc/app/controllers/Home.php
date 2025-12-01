<?php
/**
 * Controller Default: Home
 * Mewarisi fungsionalitas dasar dari Base Controller
 */
class Home extends Controller
{
    /** 
     * Method default untuk Home Controller
     */
    public function index()
    {
        $data = [
            'judul' => 'Dashboard MVC',
            'nama' => 'Mahasiswa UNISKA'
        ];
        
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
    
    /**
     * Method untuk menguji parameter routing
     */
    public function test($param1 = 'TIDAK ADA', $param2 = 'TIDAK ADA')
    {
        $data = [
            'judul' => 'Uji Coba Parameter',
            'param1' => $param1,
            'param2' => $param2
        ];
        
        $this->view('templates/header', $data);
        $this->view('home/test', $data);
        $this->view('templates/footer');
    }
}
?>