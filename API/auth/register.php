<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../models/User.php';
require_once '../utils/Response.php';
require_once '../utils/Validator.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error('Method not allowed', 405);
}

$data = json_decode(file_get_contents("php://input"), true);

// Validate input
$validator = new Validator();
$validator->validate($data, [
    'username' => 'required|min:4',
    'password' => 'required|min:8',
    'email' => 'required|email',
    'fullname' => 'required|min:2',
    'phone' => 'required|phone'
]);

if (!$validator->passes()) {
    Response::error($validator->errors());
}

$database = new Database();
$db = $database->connect();
$user = new User($db);

try {
    if ($user->create($data)) {
        Response::success(null, 'User registered successfully');
    } else {
        Response::error('Registration failed');
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { // Duplicate entry
        Response::error('Username or email already exists');
    } else {
        Response::error('Registration failed: ' . $e->getMessage());
    }
} 