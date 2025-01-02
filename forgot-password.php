<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - Dự Toán Việt</title>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body>
    <div class="form-container">
        <h1>Khôi phục mật khẩu</h1>
        <form id="forgot-password-form">
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Nhập email đăng ký" required>
                <span class="error-text" id="email-error"></span>
            </div>

            <button type="submit" class="submit-button">Gửi yêu cầu</button>
        </form>

        <div class="additional-options">
            <a href="/index.php">Quay lại đăng nhập</a>
        </div>

        <p id="error-message" class="error-message" style="display: none;"></p>
    </div>

    <script src="/asset/js/forgot-password.js"></script>
</body>
</html> 