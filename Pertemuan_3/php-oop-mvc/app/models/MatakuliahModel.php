<?php
/**
 * Model Matakuliah - CRUD untuk tabel matakuliah
 */
class MatakuliahModel
{
    private $table = 'matakuliah';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Ambil SEMUA data matakuliah
     */
    public function getAllMatakuliah()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY semester ASC, nama_mk ASC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * Ambil data matakuliah by ID
     */
    public function getMatakuliahById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Ambil data matakuliah by Kode MK
     */
    public function getMatakuliahByKode($kode_mk)
    {
        $query = "SELECT * FROM {$this->table} WHERE kode_mk = :kode_mk";
        $this->db->query($query);
        $this->db->bind('kode_mk', $kode_mk);
        return $this->db->single();
    }

    /**
     * Cari data matakuliah
     */
    public function searchMatakuliah($keyword)
    {
        $query = "SELECT * FROM {$this->table} 
                  WHERE kode_mk LIKE :keyword 
                  OR nama_mk LIKE :keyword 
                  OR semester LIKE :keyword 
                  ORDER BY semester ASC, nama_mk ASC";
        
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    /**
     * TAMBAH data matakuliah baru
     */
    public function tambahDataMatakuliah($data)
    {
        // Cek apakah kode_mk sudah ada
        if ($this->isKodeMKExists($data['kode_mk'])) {
            return -1; // Kode error untuk kode_mk duplikat
        }

        $query = "INSERT INTO {$this->table} (kode_mk, nama_mk, semester, sks, status_id) 
                  VALUES (:kode_mk, :nama_mk, :semester, :sks, :status_id)";
        
        $this->db->query($query);
        $this->db->bind('kode_mk', $data['kode_mk']);
        $this->db->bind('nama_mk', $data['nama_mk']);
        $this->db->bind('semester', $data['semester']);
        $this->db->bind('sks', $data['sks']);
        $this->db->bind('status_id', $data['status_id'] ?? 1);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * UPDATE data matakuliah
     */
    public function ubahDataMatakuliah($data)
    {
        // Cek apakah kode_mk sudah digunakan oleh matakuliah lain
        if ($this->isKodeMKExists($data['kode_mk'], $data['id'])) {
            return -1;
        }

        $query = "UPDATE {$this->table} 
                  SET kode_mk = :kode_mk, 
                      nama_mk = :nama_mk, 
                      semester = :semester, 
                      sks = :sks,
                      status_id = :status_id
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('kode_mk', $data['kode_mk']);
        $this->db->bind('nama_mk', $data['nama_mk']);
        $this->db->bind('semester', $data['semester']);
        $this->db->bind('sks', $data['sks']);
        $this->db->bind('status_id', $data['status_id'] ?? 1);
        $this->db->bind('id', $data['id']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * HAPUS data matakuliah
     */
    public function hapusDataMatakuliah($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Cek apakah kode_mk sudah ada
     */
    private function isKodeMKExists($kode_mk, $excludeId = null)
    {
        if ($excludeId) {
            $query = "SELECT COUNT(*) as count FROM {$this->table} 
                      WHERE kode_mk = :kode_mk AND id != :excludeId";
            $this->db->query($query);
            $this->db->bind('kode_mk', $kode_mk);
            $this->db->bind('excludeId', $excludeId);
        } else {
            $query = "SELECT COUNT(*) as count FROM {$this->table} WHERE kode_mk = :kode_mk";
            $this->db->query($query);
            $this->db->bind('kode_mk', $kode_mk);
        }
        
        $result = $this->db->single();
        return $result['count'] > 0;
    }

    /**
     * Hitung total matakuliah
     */
    public function countAllMatakuliah()
    {
        $query = "SELECT COUNT(*) as total FROM {$this->table}";
        $this->db->query($query);
        $result = $this->db->single();
        return $result['total'];
    }

    /**
     * Get matakuliah by semester
     */
    public function getMatakuliahBySemester($semester)
    {
        $query = "SELECT * FROM {$this->table} 
                  WHERE semester = :semester 
                  ORDER BY nama_mk ASC";
        
        $this->db->query($query);
        $this->db->bind('semester', $semester);
        return $this->db->resultSet();
    }

    /**
     * Get total SKS per semester
     */
    public function getTotalSKSBySemester($semester)
    {
        $query = "SELECT SUM(sks) as total_sks FROM {$this->table} 
                  WHERE semester = :semester";
        
        $this->db->query($query);
        $this->db->bind('semester', $semester);
        $result = $this->db->single();
        return $result['total_sks'] ?? 0;
    }
}
?>