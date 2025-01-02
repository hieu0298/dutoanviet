document.addEventListener('DOMContentLoaded', function() {
    const forgotPasswordForm = document.getElementById('forgot-password-form');
    const errorMessage = document.getElementById('error-message');

    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;

            try {
                const response = await fetch('/API/auth/forgot-password.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email: email })
                });

                const data = await response.json();

                if (data.success) {
                    errorMessage.style.display = 'block';
                    errorMessage.style.color = 'green';
                    errorMessage.textContent = 'Link khôi phục mật khẩu đã được gửi đến email của bạn.';
                    forgotPasswordForm.reset();
                } else {
                    errorMessage.style.display = 'block';
                    errorMessage.style.color = 'red';
                    errorMessage.textContent = data.message;
                }
            } catch (error) {
                console.error('Error:', error);
                errorMessage.style.display = 'block';
                errorMessage.style.color = 'red';
                errorMessage.textContent = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
            }
        });
    }
}); 