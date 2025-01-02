<?php
function checkAuth() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        Response::error('Unauthorized access', 401);
        exit;
    }
    return [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'email' => $_SESSION['email']
    ];
} 