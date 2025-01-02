<?php
require_once __DIR__ . '/API/config/config.php';

echo "<h2>Configuration Test</h2>";
echo "<pre>";
echo "BASE_URL: " . BASE_URL . "\n";
echo "API_URL: " . API_URL . "\n";
echo "ASSET_URL: " . ASSET_URL . "\n";
echo "Current URL: " . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "\n";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "</pre>";

// Test Database Connection
try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    echo "<p style='color:green'>Database connection successful!</p>";
} catch(PDOException $e) {
    echo "<p style='color:red'>Database connection failed: " . $e->getMessage() . "</p>";
} 