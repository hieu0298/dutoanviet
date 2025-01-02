<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Dự Toán Việt</title>
    <link rel="stylesheet" href="/asset/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="register-container">
        <div class="logo-section">
            <div class="logo">DỰ TOÁN VIỆT</div>
            <h1>Đăng ký tài khoản</h1>
        </div>

        <form id="register-form" class="register-form">
            <div class="form-group">
                <label for="fullname">Họ và tên</label>
                <input type="text" id="fullname" name="fullname" required>
                <span class="error-message" id="fullname-error"></span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <span class="error-message" id="email-error"></span>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="tel" id="phone" name="phone" required>
                <span class="error-message" id="phone-error"></span>
            </div>

            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
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

            <div class="form-group">
                <label for="confirm-password">Xác nhận mật khẩu</label>
                <div class="password-input">
                    <input type="password" id="confirm-password" name="confirm-password" required>
                    <button type="button" class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <span class="error-message" id="confirm-password-error"></span>
            </div>

            <div class="form-group terms">
                <label class="checkbox-label">
                    <input type="checkbox" id="terms" name="terms" required>
                    <span>Tôi đồng ý với <a href="/terms.php">điều khoản sử dụng</a></span>
                </label>
                <span class="error-message" id="terms-error"></span>
            </div>

            <button type="submit" class="register-button">Đăng ký</button>
        </form>

        <div class="login-section">
            <p>Đã có tài khoản? <a href="/index.php">Đăng nhập</a></p>
        </div>

        <div id="error-container" class="error-container"></div>
    </div>

    <script src="/asset/js/form-validation.js"></script>
    <script src="/asset/js/main.js"></script>
</body>
</html> 