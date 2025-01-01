<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Web App</title>
    <link rel="stylesheet" href="./frontend/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="./frontend/js/main.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
</head>

<body>
    <div class="welcome-container">
        <div class="logo-placeholder">LOGO</div>
        <h1>Welcome to Our Web App</h1>
        <p class="subtitle">Please log in to continue and explore our services</p>
        <form id="login-form">
            <div class="form-group">
                <input type="email" id="username" name="username" placeholder="Email/Username" required>
                <span class="error-text" id="username-error"></span>
            </div>
            <div class="form-group">
                <div class="password-input-container">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <span class="error-text" id="password-error"></span>
                <span class="password-requirements">Mật khẩu phải có ít nhất 8 ký tự</span>
            </div>
            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <span>Ghi nhớ đăng nhập</span>
                </label>
            </div>
            <div class="captcha-container">
                <div class="g-recaptcha" data-sitekey="your-site-key"></div>
            </div>
            <button type="submit" class="login-button">Đăng nhập</button>
        </form>
        <div class="additional-options">
            <a href="#" class="forgot-password">Quên mật khẩu</a>
            <span class="separator">|</span>
            <a href="./register.html" class="register-link">Đăng ký tài khoản mới</a>
        </div>
        <p id="error-message" class="error-message" style="display: none;">Login failed. Please try again.</p>
    </div>



</body>

</html>