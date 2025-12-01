<?php
/**
 * Kelas Mahasiswa (Blueprint Objek Mahasiswa)
 * Modul 1: Konsep Dasar Class & Object
 */
class Mahasiswa
{
    // Properti (Attributes) - Data yang dimiliki objek
    public $nama;
    public $nim;

    /**
     * Metode (Method) - Perilaku yang dapat dilakukan objek
     * Menampilkan salam sapaan.
     */
    public function sayHello()
    {
        // Menggunakan variabel internal kelas
        echo "Halo, saya adalah Mahasiswa " . $this->nama . ".<br>";
        echo "NIM saya adalah " . $this->nim . ". Selamat datang di dunia OOP!";
    }
}
?>