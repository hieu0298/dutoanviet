<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự Toán Việt - Phần Mềm Dự Toán Xây Dựng</title>
    <link rel="stylesheet" href="/asset/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="welcome-container">
        <div class="logo-placeholder">DỰ TOÁN VIỆT</div>
        <h1>Phần Mềm Dự Toán Xây Dựng</h1>
        <p class="subtitle">Đăng nhập để sử dụng phần mềm</p>
        
        <form id="login-form">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Email/Tên đăng nhập" required>
                <span class="error-text" id="username-error"></span>
            </div>

            <div class="form-group">
                <div class="password-input-container">
                    <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
                    <button type="button" class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <span class="error-text" id="password-error"></span>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <span>Ghi nhớ đăng nhập</span>
                </label>
            </div>

            <button type="submit" class="login-button">Đăng nhập</button>
        </form>

        <div class="additional-options">
            <a href="/forgot-password.php" class="forgot-password">Quên mật khẩu?</a>
            <span class="separator">|</span>
            <a href="/register.php" class="register-link">Đăng ký tài khoản mới</a>
        </div>

        <p id="error-message" class="error-message" style="display: none;"></p>
    </div>

    <script src="/asset/js/main.js"></script>
</body>
</html> 