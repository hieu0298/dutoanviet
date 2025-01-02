<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../models/User.php';
require_once '../utils/Response.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error('Method not allowed', 405);
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['username']) || !isset($data['password'])) {
    Response::error('Username and password are required');
}

$database = new Database();
$db = $database->connect();
$user = new User($db);

$result = $user->login($data['username'], $data['password']);

if ($result) {
    // Lưu thông tin user vào session
    $_SESSION['user_id'] = $result['id'];
    $_SESSION['username'] = $result['username'];
    $_SESSION['email'] = $result['email'];
    
    Response::success([
        'user' => [
            'id' => $result['id'],
            'username' => $result['username'],
            'email' => $result['email'],
            'fullname' => $result['fullname']
        ]
    ], 'Login successful');
} else {
    Response::error('Invalid credentials');
} 