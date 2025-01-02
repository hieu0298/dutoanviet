<?php
// Tạo file test_final.php để kiểm tra
require_once __DIR__ . '/API/config/config.php';
require_once __DIR__ . '/API/config/database.php';

echo "<h2>Final System Check</h2>";

// 1. Kiểm tra kết nối database
try {
    $database = new Database();
    $db = $database->connect();
    echo "<p style='color:green'>✓ Database connection successful</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>✗ Database connection failed: " . $e->getMessage() . "</p>";
}

// 2. Kiểm tra các thư mục quan trọng
$directories = [
    'API/auth',
    'API/config',
    'API/middleware',
    'API/models',
    'API/utils',
    'Page',
    'asset/css',
    'asset/js'
];

foreach ($directories as $dir) {
    if (is_dir($dir)) {
        echo "<p style='color:green'>✓ Directory exists: $dir</p>";
    } else {
        echo "<p style='color:red'>✗ Directory missing: $dir</p>";
    }
}

// 3. Kiểm tra các file quan trọng
$files = [
    'API/auth/login.php',
    'API/auth/register.php',
    'API/auth/logout.php',
    'API/auth/forgot-password.php',
    'API/config/config.php',
    'API/config/database.php',
    'API/middleware/check-auth.php',
    'API/models/User.php',
    'API/utils/Response.php',
    'API/utils/Validator.php',
    'Page/dashboard.php',
    'asset/css/style.css',
    'asset/css/dashboard.css',
    'asset/js/main.js',
    'asset/js/dashboard.js',
    'asset/js/form-validation.js',
    '.htaccess',
    '.user.ini',
    'index.php',
    'register.php',
    'forgot-password.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p style='color:green'>✓ File exists: $file</p>";
    } else {
        echo "<p style='color:red'>✗ File missing: $file</p>";
    }
}

// 4. Kiểm tra PHP settings
$phpSettings = [
    'display_errors',
    'error_reporting',
    'session.cookie_httponly',
    'session.use_only_cookies',
    'session.cookie_secure',
    'upload_max_filesize',
    'post_max_size',
    'memory_limit'
];

echo "<h3>PHP Settings:</h3>";
foreach ($phpSettings as $setting) {
    echo "<p>$setting: " . ini_get($setting) . "</p>";
}

// 5. Kiểm tra permissions
$writableDirs = [
    'API/logs',
    'asset/uploads'
];

foreach ($writableDirs as $dir) {
    if (is_writable($dir)) {
        echo "<p style='color:green'>✓ Directory is writable: $dir</p>";
    } else {
        echo "<p style='color:red'>✗ Directory not writable: $dir</p>";
    }
} 