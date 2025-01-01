<?php
define('DB_HOST', '103.77.162.14');
define('DB_NAME', 'damod148_dutoanviet');
define('DB_USER', 'damod148_admindutoanviet');
define('DB_PASS', '{bp83G~*r9^[');
define('JWT_SECRET', 'your-secret-key-here');
define('SITE_URL', 'http://dutoanviet.com');

require_once 'config.php';

class Database {
    private $conn;
    
    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
            return null;
        }
    }
}
?>