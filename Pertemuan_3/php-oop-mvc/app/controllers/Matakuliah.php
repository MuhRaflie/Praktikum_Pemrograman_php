<?php
/**
 * Controller Matakuliah - CRUD Lengkap
 */
class Matakuliah extends Controller
{
    /**
     * READ: Tampilkan semua data
     */
    public function index()
    {
        $matakuliahModel = $this->model('MatakuliahModel');
        
        $data = [
            'judul' => 'Data Matakuliah',
            'mk' => $matakuliahModel->getAllMatakuliah(),
            'total' => $matakuliahModel->countAllMatakuliah(),
            'semesters' => ['1','2','3','4','5','6','7','8']
        ];
        
        $this->view('templates/header', $data);
        $this->view('matakuliah/index', $data);
        $this->view('templates/footer');
    }

    /**
     * CREATE: Tampilkan form tambah
     */
    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Data Matakuliah',
            'action' => BASEURL . '/matakuliah/store',
            'semesters' => ['1','2','3','4','5','6','7','8'],
            'sks_options' => [1,2,3,4,6]
        ];
        
        $this->view('templates/header', $data);
        $this->view('matakuliah/form', $data);
        $this->view('templates/footer');
    }

    /**
     * CREATE: Proses simpan data baru
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Flasher::setFlash('gagal', 'ditambahkan!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah');
            exit;
        }

        // Sanitasi input
        $kode_mk = htmlspecialchars(trim($_POST['kode_mk']));
        $nama_mk = htmlspecialchars(trim($_POST['nama_mk']));
        $semester = htmlspecialchars(trim($_POST['semester']));
        $sks = (int)$_POST['sks'];
        $status_id = isset($_POST['status_id']) ? (int)$_POST['status_id'] : 1;

        // Validasi
        if (empty($kode_mk) || empty($nama_mk) || empty($semester) || $sks < 1) {
            Flasher::setFlash('gagal', 'ditambahkan (Semua field wajib diisi)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/tambah');
            exit;
        }

        // Validasi format kode_mk (contoh: 3 huruf + 3 angka)
        if (!preg_match('/^[A-Z]{3}\d{3}$/', $kode_mk)) {
            Flasher::setFlash('gagal', 'ditambahkan (Format kode: 3 huruf + 3 angka, contoh: WEB101)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/tambah');
            exit;
        }

        // Validasi semester (1-8)
        if (!in_array($semester, ['1','2','3','4','5','6','7','8'])) {
            Flasher::setFlash('gagal', 'ditambahkan (Semester harus 1-8)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/tambah');
            exit;
        }

        // Validasi SKS (1-6)
        if ($sks < 1 || $sks > 6) {
            Flasher::setFlash('gagal', 'ditambahkan (SKS harus 1-6)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/tambah');
            exit;
        }

        // Siapkan data
        $data = [
            'kode_mk' => $kode_mk,
            'nama_mk' => $nama_mk,
            'semester' => $semester,
            'sks' => $sks,
            'status_id' => $status_id
        ];

        // Simpan ke database
        $matakuliahModel = $this->model('MatakuliahModel');
        $result = $matakuliahModel->tambahDataMatakuliah($data);

        if ($result === -1) {
            Flasher::setFlash('gagal', 'ditambahkan (Kode MK sudah terdaftar)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/tambah');
            exit;
        } elseif ($result > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/matakuliah');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan (Terjadi kesalahan)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/tambah');
            exit;
        }
    }

    /**
     * READ: Tampilkan detail
     */
    public function detail($id)
    {
        $matakuliahModel = $this->model('MatakuliahModel');
        $mk = $matakuliahModel->getMatakuliahById($id);

        if (!$mk) {
            Flasher::setFlash('gagal', 'ditampilkan (Data tidak ditemukan)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah');
            exit;
        }

        $data = [
            'judul' => 'Detail Matakuliah',
            'mk' => $mk,
            'status_labels' => [
                1 => 'Aktif',
                0 => 'Non-Aktif'
            ]
        ];

        $this->view('templates/header', $data);
        $this->view('matakuliah/detail', $data);
        $this->view('templates/footer');
    }

    /**
     * UPDATE: Tampilkan form edit
     */
    public function edit($id)
    {
        $matakuliahModel = $this->model('MatakuliahModel');
        $mk = $matakuliahModel->getMatakuliahById($id);

        if (!$mk) {
            Flasher::setFlash('gagal', 'diedit (Data tidak ditemukan)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah');
            exit;
        }

        $data = [
            'judul' => 'Edit Data Matakuliah',
            'mk' => $mk,
            'action' => BASEURL . '/matakuliah/update',
            'semesters' => ['1','2','3','4','5','6','7','8'],
            'sks_options' => [1,2,3,4,6],
            'status_options' => [
                1 => 'Aktif',
                0 => 'Non-Aktif'
            ]
        ];

        $this->view('templates/header', $data);
        $this->view('matakuliah/form', $data);
        $this->view('templates/footer');
    }

    /**
     * UPDATE: Proses update data
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Flasher::setFlash('gagal', 'diupdate!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah');
            exit;
        }

        // Sanitasi input
        $id = (int)$_POST['id'];
        $kode_mk = htmlspecialchars(trim($_POST['kode_mk']));
        $nama_mk = htmlspecialchars(trim($_POST['nama_mk']));
        $semester = htmlspecialchars(trim($_POST['semester']));
        $sks = (int)$_POST['sks'];
        $status_id = (int)$_POST['status_id'];

        // Validasi
        if (empty($kode_mk) || empty($nama_mk) || empty($semester) || $sks < 1) {
            Flasher::setFlash('gagal', 'diupdate (Semua field wajib diisi)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/edit/' . $id);
            exit;
        }

        if (!preg_match('/^[A-Z]{3}\d{3}$/', $kode_mk)) {
            Flasher::setFlash('gagal', 'diupdate (Format kode: 3 huruf + 3 angka)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/edit/' . $id);
            exit;
        }

        if (!in_array($semester, ['1','2','3','4','5','6','7','8'])) {
            Flasher::setFlash('gagal', 'diupdate (Semester harus 1-8)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/edit/' . $id);
            exit;
        }

        if ($sks < 1 || $sks > 6) {
            Flasher::setFlash('gagal', 'diupdate (SKS harus 1-6)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/edit/' . $id);
            exit;
        }

        // Siapkan data
        $data = [
            'id' => $id,
            'kode_mk' => $kode_mk,
            'nama_mk' => $nama_mk,
            'semester' => $semester,
            'sks' => $sks,
            'status_id' => $status_id
        ];

        // Update database
        $matakuliahModel = $this->model('MatakuliahModel');
        $result = $matakuliahModel->ubahDataMatakuliah($data);

        if ($result === -1) {
            Flasher::setFlash('gagal', 'diupdate (Kode MK sudah digunakan)!', 'danger');
            header('Location: ' . BASEURL . '/matakuliah/edit/' . $id);
            exit;
        } elseif ($result > 0) {
            Flasher::setFlash('berhasil', 'diupdate!', 'success');
            header('Location: ' . BASEURL . '/matakuliah');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diupdate (Tidak ada perubahan)!', 'warning');
            header('Location: ' . BASEURL . '/matakuliah');
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
            header('Location: ' . BASEURL . '/matakuliah');
            exit;
        }

        $matakuliahModel = $this->model('MatakuliahModel');
        $result = $matakuliahModel->hapusDataMatakuliah($id);

        if ($result > 0) {
            Flasher::setFlash('berhasil', 'dihapus!', 'success');
        } else {
            Flasher::setFlash('gagal', 'dihapus (Data tidak ditemukan)!', 'danger');
        }

        header('Location: ' . BASEURL . '/matakuliah');
        exit;
    }

    /**
     * SEARCH: Cari data
     */
    public function cari()
    {
        $keyword = $_POST['keyword'] ?? '';
        
        if (empty($keyword)) {
            header('Location: ' . BASEURL . '/matakuliah');
            exit;
        }

        $matakuliahModel = $this->model('MatakuliahModel');
        
        $data = [
            'judul' => 'Hasil Pencarian: ' . htmlspecialchars($keyword),
            'mk' => $matakuliahModel->searchMatakuliah($keyword),
            'keyword' => $keyword,
            'semesters' => ['1','2','3','4','5','6','7','8']
        ];

        $this->view('templates/header', $data);
        $this->view('matakuliah/index', $data);
        $this->view('templates/footer');
    }

    /**
     * FILTER: Filter by semester
     */
    public function semester($semester)
    {
        if (!in_array($semester, ['1','2','3','4','5','6','7','8'])) {
            header('Location: ' . BASEURL . '/matakuliah');
            exit;
        }

        $matakuliahModel = $this->model('MatakuliahModel');
        
        $data = [
            'judul' => 'Matakuliah Semester ' . $semester,
            'mk' => $matakuliahModel->getMatakuliahBySemester($semester),
            'semester_filter' => $semester,
            'semesters' => ['1','2','3','4','5','6','7','8'],
            'total_sks' => $matakuliahModel->getTotalSKSBySemester($semester)
        ];

        $this->view('templates/header', $data);
        $this->view('matakuliah/index', $data);
        $this->view('templates/footer');
    }
}
?>