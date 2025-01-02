<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Dự Toán Việt</title>
    <link rel="stylesheet" href="/asset/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo">DỰ TOÁN VIỆT</div>
            <h1>Đăng nhập hệ thống</h1>
        </div>

        <form id="login-form" class="login-form">
            <div class="form-group">
                <label for="username">Tài khoản</label>
                <input type="text" id="username" name="username" required>
                <span class="error-message" id="username-error"></span>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <div class="password-input">
                    <input type="password" id="password" name="password" required>
                    <button type="button" class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <span class="error-message" id="password-error"></span>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <span>Ghi nhớ đăng nhập</span>
                </label>
                <a href="/forgot-password.php" class="forgot-link">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="login-button">Đăng nhập</button>
        </form>

        <div class="register-section">
            <p>Chưa có tài khoản? <a href="/register.php">Đăng ký ngay</a></p>
        </div>

        <div id="error-container" class="error-container"></div>
    </div>

    <script src="/asset/js/form-validation.js"></script>
    <script src="/asset/js/main.js"></script>
</body>
</html> 