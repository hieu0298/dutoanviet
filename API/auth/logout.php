<?php
require_once '../utils/Response.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error('Method not allowed', 405);
}

// Xóa session
session_destroy();
Response::success(null, 'Logged out successfully'); 