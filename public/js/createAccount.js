document.addEventListener('DOMContentLoaded', () => {
    const customerForm = document.getElementById("user-form");
    const searchInput = document.querySelector('.search-bar');
    const popup1Overlay = document.getElementById('popup1Overlay');
    const popup = document.getElementById('popup');

    // Kiểm tra form trước khi hiển thị popup
    document.getElementById('openpopup1').addEventListener('click', (e) => {
        e.preventDefault(); // Ngăn chặn gửi form mặc định

        // Lấy giá trị của các trường
        const userName = document.getElementById("userName").value.trim();
        const email = document.getElementById("email").value.trim();
        const address = document.getElementById("address").value.trim();
        const password = document.getElementById("password").value.trim();

        // Kiểm tra nếu bất kỳ trường nào trống
        if (!userName || !email || !address || !password) {
            popup1Overlay.style.display = 'flex'; // Hiển thị popup nếu form không hợp lệ
        } else {
            customerForm.submit(); // Gửi form nếu hợp lệ
        }
    });

    // Đóng popup khi người dùng xác nhận "Hủy"
    document.getElementById('closepopup1').addEventListener('click', () => {
        if (confirm("Xác nhận hủy?")) {
            popup1Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancelButton').addEventListener('click', () => {
        if (confirm("Xác nhận hủy?")) {
            popup1Overlay.style.display = 'none';
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup1Overlay && confirm("Xác nhận hủy?")) {
            popup1Overlay.style.display = 'none';
        }
    });

    // Toggle Password Visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const eyeIcon = this.querySelector('ion-icon');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        eyeIcon.name = passwordField.type === 'password' ? 'eye-off-outline' : 'eye-outline';
    });

    // Search bar logic
    searchInput.addEventListener('input', () => {
        const searchText = searchInput.value.trim().toLowerCase();
        const rows = document.querySelectorAll('#customer-table-body tr');

        rows.forEach(row => {
            const customerName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = customerName.includes(searchText) ? 'table-row' : 'none';
        });
    });
});
