<?php
/**
 * Controller Mahasiswa - CRUD Lengkap dengan Database
 */
class Mahasiswa extends Controller
{
    /**
     * READ: Tampilkan semua data
     */
    public function index()
    {
        // Load model
        $mahasiswaModel = $this->model('MahasiswaModel');
        
        // Ambil data dari database
        $data = [
            'judul' => 'Data Mahasiswa',
            'mhs' => $mahasiswaModel->getAllMahasiswa(),
            'total' => $mahasiswaModel->countAllMahasiswa()
        ];
        
        // Load view
        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    /**
     * CREATE: Tampilkan form tambah
     */
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Data Mahasiswa',
            'action' => BASEURL . '/mahasiswa/store'
        ];
        
        $this->view('templates/header', $data);
        $this->view('mahasiswa/form', $data);
        $this->view('templates/footer');
    }

    /**
     * CREATE: Proses simpan data baru
     */
    public function store()
    {
        // Validasi input
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Flasher::setFlash('gagal', 'ditambahkan!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }

        // Sanitasi input
        $nama = htmlspecialchars(trim($_POST['nama']));
        $npm = htmlspecialchars(trim($_POST['npm']));
        $email = htmlspecialchars(trim($_POST['email']));
        $jurusan = htmlspecialchars(trim($_POST['jurusan']));

        // Validasi wajib diisi
        if (empty($nama) || empty($npm) || empty($jurusan)) {
            Flasher::setFlash('gagal', 'ditambahkan (Semua field wajib diisi)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/tambah');
            exit;
        }

        // Validasi format NPM (contoh: minimal 7 digit)
        if (!preg_match('/^\d{7,}$/', $npm)) {
            Flasher::setFlash('gagal', 'ditambahkan (NPM harus angka minimal 7 digit)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/tambah');
            exit;
        }

        // Validasi format email (jika diisi)
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flasher::setFlash('gagal', 'ditambahkan (Format email tidak valid)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/tambah');
            exit;
        }

        // Siapkan data untuk model
        $data = [
            'nama' => $nama,
            'npm' => $npm,
            'email' => $email,
            'jurusan' => $jurusan
        ];

        // Simpan ke database
        $mahasiswaModel = $this->model('MahasiswaModel');
        $result = $mahasiswaModel->tambahDataMahasiswa($data);

        if ($result === -1) {
            Flasher::setFlash('gagal', 'ditambahkan (NPM sudah terdaftar)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/tambah');
            exit;
        } elseif ($result > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan (Terjadi kesalahan)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/tambah');
            exit;
        }
    }

    /**
     * READ: Tampilkan detail mahasiswa
     */
    public function detail($id)
    {
        $mahasiswaModel = $this->model('MahasiswaModel');
        $mhs = $mahasiswaModel->getMahasiswaById($id);

        if (!$mhs) {
            Flasher::setFlash('gagal', 'ditampilkan (Data tidak ditemukan)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }

        $data = [
            'judul' => 'Detail Mahasiswa',
            'mhs' => $mhs
        ];

        $this->view('templates/header', $data);
        $this->view('mahasiswa/detail', $data);
        $this->view('templates/footer');
    }

    /**
     * UPDATE: Tampilkan form edit
     */
    public function edit($id)
    {
        $mahasiswaModel = $this->model('MahasiswaModel');
        $mhs = $mahasiswaModel->getMahasiswaById($id);

        if (!$mhs) {
            Flasher::setFlash('gagal', 'diedit (Data tidak ditemukan)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }

        $data = [
            'judul' => 'Edit Data Mahasiswa',
            'mhs' => $mhs,
            'action' => BASEURL . '/mahasiswa/update'
        ];

        $this->view('templates/header', $data);
        $this->view('mahasiswa/form', $data);
        $this->view('templates/footer');
    }

    /**
     * UPDATE: Proses update data
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Flasher::setFlash('gagal', 'diupdate!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }

        // Sanitasi input
        $id = $_POST['id'];
        $nama = htmlspecialchars(trim($_POST['nama']));
        $npm = htmlspecialchars(trim($_POST['npm']));
        $email = htmlspecialchars(trim($_POST['email']));
        $jurusan = htmlspecialchars(trim($_POST['jurusan']));

        // Validasi
        if (empty($nama) || empty($npm) || empty($jurusan)) {
            Flasher::setFlash('gagal', 'diupdate (Semua field wajib diisi)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/edit/' . $id);
            exit;
        }

        if (!preg_match('/^\d{7,}$/', $npm)) {
            Flasher::setFlash('gagal', 'diupdate (NPM harus angka minimal 7 digit)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/edit/' . $id);
            exit;
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flasher::setFlash('gagal', 'diupdate (Format email tidak valid)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/edit/' . $id);
            exit;
        }

        // Siapkan data
        $data = [
            'id' => $id,
            'nama' => $nama,
            'npm' => $npm,
            'email' => $email,
            'jurusan' => $jurusan
        ];

        // Update database
        $mahasiswaModel = $this->model('MahasiswaModel');
        $result = $mahasiswaModel->ubahDataMahasiswa($data);

        if ($result === -1) {
            Flasher::setFlash('gagal', 'diupdate (NPM sudah digunakan)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa/edit/' . $id);
            exit;
        } elseif ($result > 0) {
            Flasher::setFlash('berhasil', 'diupdate!', 'success');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diupdate (Tidak ada perubahan)!', 'warning');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }
    }

    /**
     * DELETE: Hapus data
     */
    public function delete($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            Flasher::setFlash('gagal', 'dihapus (ID tidak valid)!', 'danger');
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }

        $mahasiswaModel = $this->model('MahasiswaModel');
        $result = $mahasiswaModel->hapusDataMahasiswa($id);

        if ($result > 0) {
            Flasher::setFlash('berhasil', 'dihapus!', 'success');
        } else {
            Flasher::setFlash('gagal', 'dihapus (Data tidak ditemukan)!', 'danger');
        }

        header('Location: ' . BASEURL . '/mahasiswa');
        exit;
    }

    /**
     * SEARCH: Cari data
     */
    public function cari()
    {
        $keyword = $_POST['keyword'] ?? '';
        
        if (empty($keyword)) {
            header('Location: ' . BASEURL . '/mahasiswa');
            exit;
        }

        $mahasiswaModel = $this->model('MahasiswaModel');
        
        $data = [
            'judul' => 'Hasil Pencarian: ' . htmlspecialchars($keyword),
            'mhs' => $mahasiswaModel->searchMahasiswa($keyword),
            'keyword' => $keyword
        ];

        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }
}
?>