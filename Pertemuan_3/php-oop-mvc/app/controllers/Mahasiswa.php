<?php
class Mahasiswa extends Controller
{
    // Tampilkan daftar mahasiswa
    public function index()
    {
        $data['judul'] = 'Daftar Mahasiswa';
        $data['mhs'] = $this->model('MahasiswaModel')->getAllMahasiswa();
        
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }
    
    // Tampilkan form tambah data
    public function tambah()
    {
        $data['judul'] = 'Tambah Data Mahasiswa';
        
        $this->view('templates/header', $data);
        $this->view('mahasiswa/tambah', $data);
        $this->view('templates/footer');
    }
    
    // Proses tambah data baru
    public function store()
    {
        // Validasi sederhana
        if (empty($_POST['nama']) || empty($_POST['npm']) || empty($_POST['jurusan'])) {
            Flasher::setFlash("gagal", 'ditambahkan (Form harus lengkap!)', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/tambah');
            exit;
        }
        
        // Sanitasi input
        $data = [
            'nama' => htmlspecialchars(trim($_POST['nama'])),
            'npm' => htmlspecialchars(trim($_POST['npm'])),
            'email' => htmlspecialchars(trim($_POST['email'] ?? '')),
            'jurusan' => htmlspecialchars(trim($_POST['jurusan']))
        ];
        
        // Kirim ke Model
        if ($this->model('MahasiswaModel')->tambahDataMahasiswa($data) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash("gagal", 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/tambah');
            exit;
        }
    }
    
    // Tampilkan form edit dengan data lama
    public function edit($id)
    {
        $data['judul'] = 'Edit Data Mahasiswa';
        $data['mhs'] = $this->model('MahasiswaModel')->getMahasiswaById($id);
        
        if (!$data['mhs']) {
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }
        
        $this->view('templates/header', $data);
        $this->view('mahasiswa/edit', $data);
        $this->view('templates/footer');
    }
    
    // Proses update data
    public function update()
    {
        if (empty($_POST['nama']) || empty($_POST['npm']) || empty($_POST['jurusan'])) {
            Flasher::setFlash("gagal", 'diubah (Form harus lengkap!)', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/edit/' . $_POST['id']);
            exit;
        }
        
        $data = [
            'id' => $_POST['id'],
            'nama' => htmlspecialchars(trim($_POST['nama'])),
            'npm' => htmlspecialchars(trim($_POST['npm'])),
            'email' => htmlspecialchars(trim($_POST['email'] ?? '')),
            'jurusan' => htmlspecialchars(trim($_POST['jurusan']))
        ];
        
        if ($this->model('MahasiswaModel')->ubahDataMahasiswa($data) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash("gagal", 'diubah', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/edit/' . $data['id']);
            exit;
        }
    }
    
    // Hapus data
    public function delete($id)
    {
        if ($this->model('MahasiswaModel')->hapusDataMahasiswa($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
        } else {
            Flasher::setFlash("gagal", 'dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/mahasiswa');
        exit;
    }
}
?>