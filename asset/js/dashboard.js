class DashboardManager {
    constructor() {
        this.token = localStorage.getItem('token');
        this.user = this.getUserFromStorage();
        this.initializeElements();
        this.setupEventListeners();
    }

    // Khởi tạo các elements
    initializeElements() {
        this.userNameElement = document.getElementById('user-name');
        this.logoutButton = document.getElementById('logout-btn');
        this.passwordInput = document.getElementById('password');
        this.togglePasswordButton = document.querySelector('.toggle-password img');
    }

    // Thiết lập event listeners
    setupEventListeners() {
        if (this.logoutButton) {
            this.logoutButton.addEventListener('click', () => this.handleLogout());
        }

        // Thêm event listener cho nút toggle password
        const toggleBtn = document.querySelector('.toggle-password');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => this.togglePassword());
        }

        // Lắng nghe sự kiện token hết hạn
        window.addEventListener('storage', (e) => this.handleStorageChange(e));
    }

    // Lấy thông tin user từ localStorage
    getUserFromStorage() {
        try {
            const userStr = localStorage.getItem('user');
            return userStr ? JSON.parse(userStr) : null;
        } catch (error) {
            console.error('Error parsing user data:', error);
            return null;
        }
    }

    // Kiểm tra authentication
    checkAuthentication() {
        if (!this.token || !this.user) {
            this.redirectToLogin();
            return false;
        }
        return true;
    }

    // Hiển thị thông tin người dùng
    displayUserInfo() {
        if (this.userNameElement && this.user) {
            const displayName = this.user.fullName || this.user.username || 'User';
            this.userNameElement.textContent = this.sanitizeHTML(displayName);
        }
    }

    // Xử lý đăng xuất
    handleLogout() {
        try {
            // Thêm animation cho nút logout
            if (this.logoutButton) {
                this.logoutButton.textContent = 'Đang đăng xuất...';
                this.logoutButton.disabled = true;
            }

            // Gọi API logout (nếu cần)
            this.logout();
        } catch (error) {
            console.error('Logout error:', error);
            alert('Có lỗi xảy ra khi đăng xuất. Vui lòng thử lại.');
        }
    }

    // Xử lý thay đổi trong localStorage
    handleStorageChange(event) {
        if (event.key === 'token' && !event.newValue) {
            this.redirectToLogin();
        }
    }

    // Thực hiện logout
    logout() {
        // Xóa dữ liệu authentication
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        sessionStorage.clear();
        
        // Xóa cookies liên quan (nếu có)
        this.clearAuthCookies();
        
        // Chuyển về trang đăng nhập
        this.redirectToLogin();
    }

    // Xóa cookies liên quan đến authentication
    clearAuthCookies() {
        document.cookie.split(";").forEach(cookie => {
            const name = cookie.split("=")[0].trim();
            document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
        });
    }

    // Chuyển hướng về trang đăng nhập
    redirectToLogin() {
        window.location.href = '/index.html';
    }

    // Sanitize HTML để tránh XSS
    sanitizeHTML(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Khởi tạo dashboard
    init() {
        if (this.checkAuthentication()) {
            this.displayUserInfo();
            this.setupInactivityTimer();
        }
    }

    // Thiết lập timer cho phiên làm việc
    setupInactivityTimer() {
        let inactivityTimeout = 30 * 60 * 1000; // 30 phút
        let timer;

        const resetTimer = () => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                alert('Phiên làm việc đã hết hạn. Vui lòng đăng nhập lại.');
                this.handleLogout();
            }, inactivityTimeout);
        };

        // Reset timer khi có hoạt động
        ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(
            event => document.addEventListener(event, resetTimer, false)
        );

        // Khởi động timer
        resetTimer();
    }
}

// Khởi tạo và chạy dashboard khi trang được load
document.addEventListener('DOMContentLoaded', () => {
    const dashboard = new DashboardManager();
    dashboard.init();
}); 