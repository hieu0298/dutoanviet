<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1); // nếu có HTTPS

// Database configuration
define('DB_HOST', '103.77.162.14');
define('DB_NAME', 'damod148_dutoanviet');
define('DB_USER', 'damod148_admindutoanviet');
define('DB_PASS', '{bp83G~*r9^[');

// JWT configuration
define('JWT_SECRET', 'your-secret-key-here');
define('JWT_EXPIRE', 86400); // 24 hours

// Application configuration
define('SITE_URL', 'http://dutoanviet.com');
define('API_URL', 'http://dutoanviet.com/API');

// CORS configuration
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

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