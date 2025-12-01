<?php
/**
 * Model spesifik untuk mengelola data Mahasiswa
 */
class MahasiswaModel
{
    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        // Instansiasi kelas Database
        $this->db = new Database();
    }

    /**
     * Mengambil semua data mahasiswa
     * @return array Daftar mahasiswa
     */
    public function getAllMahasiswa()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY id DESC');
        return $this->db->resultSet();
    }

    /**
     * Mengambil data mahasiswa berdasarkan ID
     * @param int $id ID Mahasiswa
     * @return array Data mahasiswa tunggal
     */
    public function getMahasiswaById($id)
    {
        // Menggunakan placeholder :id untuk prepared statement
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        
        // Binding nilai (Aman dari SQL Injection)
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Menambahkan data mahasiswa baru (CREATE)
     * @param array $data Data mahasiswa dari form (npm, nama, email, jurusan)
     * @return int Jumlah baris yang berhasil ditambahkan
     */
    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO " . $this->table . " (nama, npm, email, jurusan) 
                  VALUES (:nama, :npm, :email, :jurusan)";
        
        $this->db->query($query);
        
        // Binding semua parameter
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('npm', $data['npm']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Menghapus data mahasiswa (DELETE)
     * @param int $id ID Mahasiswa
     * @return int Jumlah baris yang berhasil dihapus
     */
    public function hapusDataMahasiswa($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        
        $this->db->query($query);
        $this->db->bind('id', $id);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Mengubah data mahasiswa (UPDATE)
     * @param array $data Data mahasiswa dari form (id, npm, nama, email, jurusan)
     * @return int Jumlah baris yang berhasil diubah
     */
    public function ubahDataMahasiswa($data)
    {
        $query = "UPDATE " . $this->table . " SET 
                  nama = :nama,
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
}
?>