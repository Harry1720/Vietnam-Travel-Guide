document.addEventListener('DOMContentLoaded', () => {
    const customerForm = document.getElementById("user-form");
    const searchInput = document.querySelector('.search-bar');
    const popup1Overlay = document.getElementById('popup1Overlay');
    const token = localStorage.getItem('authToken');

    searchInput.addEventListener('input', () => {
        const searchText = searchInput.value.trim().toLowerCase();
        const rows = document.querySelectorAll('#customer-table-body tr');

        rows.forEach(row => {
            const customerName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = customerName.includes(searchText) ? 'table-row' : 'none';
        });
    });

    const resetFormState = () => {
        customerForm.reset();
    };

    document.getElementById('openpopup1').addEventListener('click', () => {
        resetFormState();
        popup1Overlay.style.display = 'flex';
    });

    document.getElementById('edit-btn').addEventListener('click', () => {
        resetFormState();
        popup2Overlay.style.display = 'flex';
    });

    document.getElementById('closepopup2').addEventListener('click', () => {
        if (confirm("Xác nhận hủy?")) {
            popup2Overlay.style.display = 'none';
            removeAdminOption();
        }
    });

    document.getElementById('closepopup1').addEventListener('click', () => {
        if (confirm("Xác nhận hủy?")) {
            popup1Overlay.style.display = 'none';
            removeAdminOption();
        }
    });

    document.getElementById('cancelButton').addEventListener('click', () => {
        if (confirm("Xác nhận hủy?")) {
            popup1Overlay.style.display = 'none';
            removeAdminOption();
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup1Overlay && confirm("Xác nhận hủy?")) {
            popup1Overlay.style.display = 'none';
            removeAdminOption();
        }
    });

    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const eyeIcon = this.querySelector('ion-icon');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        eyeIcon.name = passwordField.type === 'password' ? 'eye-off-outline' : 'eye-outline';
    });
});
