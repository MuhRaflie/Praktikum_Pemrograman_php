<?php
/**
 * Kelas Database - Koneksi PDO dengan MySQL
 */
class Database
{
    // Konfigurasi Database
    private $host = 'localhost';
    private $user = 'root';          // Username default XAMPP
    private $pass = '';              // Password default XAMPP (kosong)
    private $db_name = 'uniska_mvc'; // Nama database yang baru dibuat

    private $dbh; // Database Handler
    private $stmt; // Statement

    public function __construct()
    {
        // Data Source Name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name . ';charset=utf8mb4';
        
        // Options untuk koneksi PDO
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            // Debug: Uncomment jika ingin tahu koneksi berhasil
            // echo "<!-- DEBUG: Database connected successfully -->";
        } catch (PDOException $e) {
            // Tampilkan error dengan format yang lebih baik
            die("
                <div style='padding:20px; background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; border-radius:5px;'>
                    <h3>❌ Database Connection Failed</h3>
                    <p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                    <p><strong>Database:</strong> $this->db_name</p>
                    <p><strong>Host:</strong> $this->host</p>
                    <hr>
                    <p><strong>Solution:</strong></p>
                    <ol>
                        <li>Buka phpMyAdmin (<a href='http://localhost/phpmyadmin' target='_blank'>http://localhost/phpmyadmin</a>)</li>
                        <li>Buat database: <code>CREATE DATABASE uniska_mvc;</code></li>
                        <li>Import SQL dari langkah 1 di atas</li>
                    </ol>
                </div>
            ");
        }
    }

    /**
     * Prepare SQL statement
     */
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Bind parameter
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute prepared statement
     */
    public function execute()
    {
        try {
            return $this->stmt->execute();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /**
     * Get multiple rows
     */
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    /**
     * Get single row
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    /**
     * Get row count
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    /**
     * Get last inserted ID
     */
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    /**
     * Error handler
     */
    private function handleError($e)
    {
        // Jangan tampilkan error detail di production
        // Di development, kita tampilkan untuk debugging
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            die("
                <div style='padding:15px; background:#fff3cd; color:#856404; border:1px solid #ffeaa7; border-radius:5px;'>
                    <h4>⚠️ Database Error</h4>
                    <p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                    <p><strong>SQL State:</strong> " . $e->errorInfo[0] . "</p>
                    <p><strong>Driver Code:</strong> " . $e->errorInfo[1] . "</p>
                    <p><strong>SQL:</strong> " . htmlspecialchars($this->stmt->queryString) . "</p>
                </div>
            ");
        } else {
            die("Database error occurred. Please contact administrator.");
        }
    }
}
?>