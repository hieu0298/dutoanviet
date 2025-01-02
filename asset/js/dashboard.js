document.addEventListener('DOMContentLoaded', function() {
    const logoutBtn = document.getElementById('logout-btn');

    if (logoutBtn) {
        logoutBtn.addEventListener('click', async function() {
            try {
                const response = await fetch('/API/auth/logout.php', {
                    method: 'POST',
                    credentials: 'include'
                });

                const data = await response.json();

                if (data.success) {
                    // Xóa thông tin user từ localStorage
                    localStorage.removeItem('user');
                    // Chuyển về trang đăng nhập
                    window.location.href = '/index.php';
                }
            } catch (error) {
                console.error('Logout error:', error);
                alert('Có lỗi xảy ra khi đăng xuất');
            }
        });
    }
}); 