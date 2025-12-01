/**
 * Metode untuk memuat Model
 * @param string $model Nama kelas Model
 * @return object Instansi dari kelas Model
 */
public function model($model)
{
    // Tentukan path model
    $modelPath = '../app/models/' . $model . '.php';
    
    // Cek apakah file model ada
    if (file_exists($modelPath)) {
        require_once $modelPath;
        
        // Instansiasi model
        return new $model();
    } else {
        die("Error: File Model tidak ditemukan di " . $modelPath);
    }
}