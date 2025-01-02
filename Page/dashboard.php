<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Dự Toán Việt</title>
    <link rel="stylesheet" href="/asset/css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="logo-placeholder">DỰ TOÁN VIỆT</div>
            <div class="user-info">
                <span id="welcome-message">Xin chào, <span id="user-name"><?php echo htmlspecialchars($_SESSION['fullname']); ?></span></span>
                <button id="logout-btn" class="logout-button">Đăng xuất</button>
            </div>
        </header>

        <main class="dashboard-content">
            <h1 class="dashboard-title">Bảng điều khiển</h1>
            
            <div class="user-profile">
                <h2>Thông tin tài khoản</h2>
                <div class="profile-info">
                    <p><strong>Họ tên:</strong> <?php echo htmlspecialchars($_SESSION['fullname']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                    <p><strong>Tài khoản:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                </div>
            </div>

            <div class="update-message">
                <div class="message-box">
                    <h2>🚧 Thông báo 🚧</h2>
                    <p>Hệ thống đang trong quá trình cập nhật và phát triển.</p>
                    <p>Vui lòng quay lại sau!</p>
                </div>
            </div>
        </main>
    </div>

    <script src="/asset/js/dashboard.js"></script>
</body>
</html>
