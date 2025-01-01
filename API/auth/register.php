<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="asset/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="asset/js/main.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="register-container">
        <div class="logo-placeholder">LOGO</div>
        <h1>Đăng ký tài khoản</h1>
        
        <form id="register-form">
            <!-- Thông tin cá nhân -->
            <div class="form-group">
                <input type="text" id="fullname" name="fullname" placeholder="Họ và tên" required>
                <span class="error-text" id="fullname-error"></span>
            </div>

            <!-- Thông tin đăng nhập -->
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <span class="error-text" id="email-error"></span>
            </div>

            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required>
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
                <span class="password-requirements">Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và số</span>
            </div>

            <div class="form-group">
                <div class="password-input-container">
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Xác nhận mật khẩu" required>
                    <button type="button" class="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <span class="error-text" id="confirm-password-error"></span>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="form-group">
                <input type="tel" id="phone" name="phone" placeholder="Số điện thoại" required>
                <span class="error-text" id="phone-error"></span>
            </div>

            <!-- Ngày sinh và giới tính -->
            <div class="form-group">
                <label for="birthdate">Ngày sinh:</label>
                <input type="date" id="birthdate" name="birthdate" required>
                <span class="error-text" id="birthdate-error"></span>
            </div>

            <div class="form-group">
                <label>Giới tính:</label>
                <div class="gender-options">
                    <label>
                        <input type="radio" name="gender" value="male" required>
                        Nam
                    </label>
                    <label>
                        <input type="radio" name="gender" value="female">
                        Nữ
                    </label>
                    <label>
                        <input type="radio" name="gender" value="other">
                        Khác
                    </label>
                </div>
            </div>

            <!-- Điều khoản và điều kiện -->
            <div class="form-group terms">
                <label>
                    <input type="checkbox" id="terms" name="terms" required>
                    Tôi đồng ý với <a href="#">điều khoản sử dụng</a> và <a href="#">chính sách bảo mật</a>
                </label>
                <span class="error-text" id="terms-error"></span>
            </div>

            <button type="submit" class="register-button">Đăng ký</button>
        </form>

        <div class="login-link">
            Đã có tài khoản? <a href="./login.html">Đăng nhập ngay</a>
        </div>

        <p id="error-message" class="error-message" style="display: none;"></p>
    </div>

</body>
</html>
