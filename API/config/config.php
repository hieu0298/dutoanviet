<?php
// Tắt error reporting cho production
error_reporting(0);
ini_set('display_errors', 0);

// Base URL configuration
define('BASE_URL', 'https://dutoanviet.com');
define('API_PATH', '/API');
define('ASSET_PATH', '/asset');

// Full paths
define('SITE_URL', BASE_URL);
define('API_URL', BASE_URL . API_PATH);
define('ASSET_URL', BASE_URL . ASSET_PATH);

// Database configuration
define('DB_HOST', '103.77.162.14');
define('DB_NAME', 'damod148_dutoanviet');
define('DB_USER', 'damod148_admindutoanviet');
define('DB_PASS', '{bp83G~*r9^[');

// Session configuration
session_start();
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1); // Khi có HTTPS

// JWT configuration
define('JWT_SECRET', 'your-secret-key-here');
define('JWT_EXPIRE', 86400); // 24 hours

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