<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once '../config/config.php';
require_once '../config/database.php';
require_once '../models/User.php';
require_once '../utils/Response.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed', 405);
    }

    $input = file_get_contents("php://input");
    if (empty($input)) {
        throw new Exception('No data provided');
    }

    $data = json_decode($input, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON data');
    }

    if (empty($data['username']) || empty($data['password'])) {
        throw new Exception('Username and password are required');
    }

    $database = new Database();
    $db = $database->connect();
    $user = new User($db);

    $result = $user->login($data['username'], $data['password']);

    if ($result) {
        session_start();
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['fullname'] = $result['fullname'];
        
        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $result
            ]
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid credentials'
        ]);
    }
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} 