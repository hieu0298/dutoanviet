class FormValidator {
    constructor(form, fields) {
        this.form = form;
        this.fields = fields;
        this.errors = new Map();
        this.setupValidation();
    }

    setupValidation() {
        this.fields.forEach(field => {
            const input = this.form.querySelector(`#${field}`);
            if (input) {
                input.addEventListener('input', () => {
                    this.validateField(input);
                });

                input.addEventListener('blur', () => {
                    this.validateField(input);
                });
            }
        });

        this.form.addEventListener('submit', e => {
            e.preventDefault();
            if (this.validateAll()) {
                this.submitForm();
            }
        });
    }

    validateField(field) {
        const fieldName = field.id;
        const value = field.value.trim();

        switch(fieldName) {
            case 'username':
                return this.validateUsername(value);
            case 'email':
                return this.validateEmail(value);
            case 'password':
                return this.validatePassword(value);
            case 'confirm-password':
                const password = this.form.querySelector('#password').value;
                return this.validateConfirmPassword(value, password);
            case 'phone':
                return this.validatePhone(value);
            case 'fullname':
                return this.validateFullname(value);
        }
    }

    validateUsername(value) {
        if (value.length < 4) {
            this.showError('username', 'Tên đăng nhập phải có ít nhất 4 ký tự');
            return false;
        }
        if (!/^[a-zA-Z0-9_]+$/.test(value)) {
            this.showError('username', 'Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới');
            return false;
        }
        this.showSuccess('username');
        return true;
    }

    validateEmail(value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            this.showError('email', 'Email không hợp lệ');
            return false;
        }
        this.showSuccess('email');
        return true;
    }

    validatePassword(value) {
        if (value.length < 8) {
            this.showError('password', 'Mật khẩu phải có ít nhất 8 ký tự');
            return false;
        }
        if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(value)) {
            this.showError('password', 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường và 1 số');
            return false;
        }
        this.showSuccess('password');
        return true;
    }

    validateConfirmPassword(value, password) {
        if (value !== password) {
            this.showError('confirm-password', 'Mật khẩu xác nhận không khớp');
            return false;
        }
        this.showSuccess('confirm-password');
        return true;
    }

    validatePhone(value) {
        if (!/^[0-9]{10}$/.test(value)) {
            this.showError('phone', 'Số điện thoại không hợp lệ');
            return false;
        }
        this.showSuccess('phone');
        return true;
    }

    validateFullname(value) {
        if (value.length < 2) {
            this.showError('fullname', 'Họ tên phải có ít nhất 2 ký tự');
            return false;
        }
        this.showSuccess('fullname');
        return true;
    }

    showError(fieldName, message) {
        const field = this.form.querySelector(`#${fieldName}`);
        const errorElement = this.form.querySelector(`#${fieldName}-error`);
        const formGroup = field.closest('.form-group');

        formGroup.classList.remove('success');
        formGroup.classList.add('error');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }

    showSuccess(fieldName) {
        const field = this.form.querySelector(`#${fieldName}`);
        const errorElement = this.form.querySelector(`#${fieldName}-error`);
        const formGroup = field.closest('.form-group');

        formGroup.classList.remove('error');
        formGroup.classList.add('success');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }

    validateAll() {
        let isValid = true;
        this.fields.forEach(fieldName => {
            const field = this.form.querySelector(`#${fieldName}`);
            if (field && !this.validateField(field)) {
                isValid = false;
            }
        });
        return isValid;
    }

    async submitForm() {
        const submitButton = this.form.querySelector('button[type="submit"]');
        submitButton.classList.add('button-loading');

        try {
            const formData = new FormData(this.form);
            const response = await fetch(this.form.action, {
                method: 'POST',
                body: JSON.stringify(Object.fromEntries(formData)),
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            const data = await response.json();
            
            if (data.success) {
                this.showFormSuccess(data.message);
                if (this.form.id === 'login-form') {
                    window.location.href = '/Page/dashboard.php';
                } else {
                    window.location.href = '/index.php';
                }
            } else {
                this.showFormError(data.message);
            }
        } catch (error) {
            this.showFormError('Có lỗi xảy ra. Vui lòng thử lại sau.');
        } finally {
            submitButton.classList.remove('button-loading');
        }
    }

    showFormSuccess(message) {
        const alert = document.createElement('div');
        alert.className = 'alert alert-success';
        alert.textContent = message;
        this.form.insertBefore(alert, this.form.firstChild);
        setTimeout(() => alert.remove(), 5000);
    }

    showFormError(message) {
        const alert = document.createElement('div');
        alert.className = 'alert alert-error';
        alert.textContent = message;
        this.form.insertBefore(alert, this.form.firstChild);
        setTimeout(() => alert.remove(), 5000);
    }
} 