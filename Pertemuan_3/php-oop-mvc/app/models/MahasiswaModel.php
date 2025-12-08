<?php
/**
 * Model Mahasiswa dengan database real
 */
class MahasiswaModel
{
    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Ambil SEMUA data mahasiswa dari database
     */
    public function getAllMahasiswa()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY nama ASC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * Ambil data mahasiswa by ID
     */
    public function getMahasiswaById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Ambil data mahasiswa by NPM
     */
    public function getMahasiswaByNPM($npm)
    {
        $query = "SELECT * FROM {$this->table} WHERE npm = :npm";
        $this->db->query($query);
        $this->db->bind('npm', $npm);
        return $this->db->single();
    }

    /**
     * Cari data mahasiswa berdasarkan keyword
     */
    public function searchMahasiswa($keyword)
    {
        $query = "SELECT * FROM {$this->table} 
                  WHERE nama LIKE :keyword 
                  OR npm LIKE :keyword 
                  OR email LIKE :keyword 
                  OR jurusan LIKE :keyword 
                  ORDER BY nama ASC";
        
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    /**
     * TAMBAH data mahasiswa baru
     */
    public function tambahDataMahasiswa($data)
    {
        // Cek apakah NPM sudah ada
        if ($this->isNPMExists($data['npm'])) {
            return -1; // Kode error untuk NPM duplikat
        }

        $query = "INSERT INTO {$this->table} (nama, npm, email, jurusan) 
                  VALUES (:nama, :npm, :email, :jurusan)";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('npm', $data['npm']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * UPDATE data mahasiswa
     */
    public function ubahDataMahasiswa($data)
    {
        // Cek apakah NPM sudah digunakan oleh orang lain
        if ($this->isNPMExists($data['npm'], $data['id'])) {
            return -1; // Kode error untuk NPM duplikat
        }

        $query = "UPDATE {$this->table} 
                  SET nama = :nama, 
                      npm = :npm, 
                      email = :email, 
                      jurusan = :jurusan 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('npm', $data['npm']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        $this->db->bind('id', $data['id']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * HAPUS data mahasiswa
     */
    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Cek apakah NPM sudah ada
     * @param string $npm NPM yang dicek
     * @param int $excludeId ID yang dikecualikan (untuk update)
     */
    private function isNPMExists($npm, $excludeId = null)
    {
        if ($excludeId) {
            $query = "SELECT COUNT(*) as count FROM {$this->table} 
                      WHERE npm = :npm AND id != :excludeId";
            $this->db->query($query);
            $this->db->bind('npm', $npm);
            $this->db->bind('excludeId', $excludeId);
        } else {
            $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE npm = :npm";
            $this->db->query($query);
            $this->db->bind('npm', $npm);
        }
        
        $result = $this->db->single();
        return $result['count'] > 0;
    }

    /**
     * Hitung total mahasiswa
     */
    public function countAllMahasiswa()
    {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $this->db->query($query);
        $result = $this->db->single();
        return $result['total'];
    }

    /**
     * Ambil data dengan pagination
     */
    public function getMahasiswaPaginated($limit, $offset)
    {
        $query = "SELECT * FROM {$this->table} 
                  ORDER BY nama ASC 
                  LIMIT :limit OFFSET :offset";
        
        $this->db->query($query);
        $this->db->bind('limit', $limit, PDO::PARAM_INT);
        $this->db->bind('offset', $offset, PDO::PARAM_INT);
        
        return $this->db->resultSet();
    }
}
?>