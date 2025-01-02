const API_URL = 'https://dutoanviet.com/API';
async function registerUser(userData) {
    try {
        const response = await fetch(`${API_URL}/auth/register.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(userData)
        });
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function loginUser(credentials) {
    try {
        const response = await fetch(`${API_URL}/auth/login.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(credentials),
            credentials: 'include'
        });
        return await response.json();
    } catch (error) {
        console.error('Login error:', error);
        throw error;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Kiểm tra xem có thông báo đăng ký thành công không
    const urlParams = new URLSearchParams(window.location.search);
    const registrationSuccess = urlParams.get('registration');
    
    if (registrationSuccess === 'success') {
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.style.display = 'block';
            errorMessage.style.color = 'green';
            errorMessage.textContent = 'Bạn đã đăng ký thành công, vui lòng đăng nhập để sử dụng phần mềm.';
        }
    }

    // Xử lý form đăng ký
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateForm()) {
                // Giả lập API call đăng ký
                setTimeout(() => {
                    alert('Đăng ký thành công!');
                    window.location.href = './login.html?registration=success';
                }, 1000);
            }
        });
    }

    // Xử lý form đăng nhập
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('error-message');

            if (username && password) {
                try {
                    const response = await loginUser({
                        username: username,
                        password: password
                    });
                    
                    if (response.success) {
                        // Lưu thông tin user vào localStorage (không cần token)
                        localStorage.setItem('user', JSON.stringify(response.data.user));
                        
                        // Chuyển hướng đến trang dashboard
                        window.location.href = './Page/dashboard.html';
                    } else {
                        if (errorMessage) {
                            errorMessage.style.display = 'block';
                            errorMessage.style.color = 'red';
                            errorMessage.textContent = response.message;
                        }
                    }
                } catch (error) {
                    console.error('Login error:', error);
                    if (errorMessage) {
                        errorMessage.style.display = 'block';
                        errorMessage.style.color = 'red';
                        errorMessage.textContent = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
                    }
                }
            }
        });
    }

    // Toggle password visibility
    const toggleButtons = document.querySelectorAll('.toggle-password');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Validation functions
    function validateForm() {
        let isValid = true;

        // Validate fullname
        const fullname = document.getElementById('fullname').value;
        if (!fullname || fullname.length < 2) {
            showFieldError('fullname', 'Họ tên phải có ít nhất 2 ký tự');
            isValid = false;
        }

        // Validate email
        const email = document.getElementById('email').value;
        if (!isValidEmail(email)) {
            showFieldError('email', 'Email không hợp lệ');
            isValid = false;
        }

        // Validate username
        const username = document.getElementById('username').value;
        if (!username || username.length < 4) {
            showFieldError('username', 'Tên đăng nhập phải có ít nhất 4 ký tự');
            isValid = false;
        }

        // Validate password
        const password = document.getElementById('password').value;
        if (!isValidPassword(password)) {
            showFieldError('password', 'Mật khẩu không đủ mạnh');
            isValid = false;
        }

        // Validate confirm password
        const confirmPassword = document.getElementById('confirm-password').value;
        if (password !== confirmPassword) {
            showFieldError('confirm-password', 'Mật khẩu xác nhận không khớp');
            isValid = false;
        }

        // Validate phone
        const phone = document.getElementById('phone').value;
        if (!isValidPhone(phone)) {
            showFieldError('phone', 'Số điện thoại không hợp lệ');
            isValid = false;
        }

        // Validate terms
        if (!document.getElementById('terms').checked) {
            showFieldError('terms', 'Bạn phải đồng ý với điều khoản sử dụng');
            isValid = false;
        }

        return isValid;
    }

    function showFieldError(fieldId, message) {
        const errorElement = document.getElementById(`${fieldId}-error`);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function isValidPassword(password) {
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(password);
    }

    function isValidPhone(phone) {
        return /^[0-9]{10}$/.test(phone);
    }
});
