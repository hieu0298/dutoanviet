<?php
require_once '../config/config.php';
require_once '../config/database.php';
require_once '../models/User.php';
require_once '../utils/Response.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error('Method not allowed', 405);
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email'])) {
    Response::error('Email is required');
}

$database = new Database();
$db = $database->connect();
$user = new User($db);

// Tạo mã reset password
$resetToken = bin2hex(random_bytes(32));
$expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

if ($user->createPasswordReset($data['email'], $resetToken, $expiry)) {
    // Gửi email với link reset password
    $resetLink = SITE_URL . "/reset-password.php?token=" . $resetToken;
    $to = $data['email'];
    $subject = "Khôi phục mật khẩu - Dự Toán Việt";
    $message = "Để đặt lại mật khẩu, vui lòng click vào link sau:\n\n" . $resetLink;
    $headers = "From: no-reply@dutoanviet.com";

    if (mail($to, $subject, $message, $headers)) {
        Response::success(null, 'Reset password link has been sent to your email');
    } else {
        Response::error('Could not send reset password email');
    }
} else {
    Response::error('Email not found');
} 