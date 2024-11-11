document.addEventListener('DOMContentLoaded', function () {
    const selects = document.querySelectorAll('select');

    selects.forEach(select => {
        updateSelectColor(select);

        // Thay đổi màu khi người dùng chọn giá trị mới
        select.addEventListener('change', () => updateSelectColor(select));
    });

    function updateSelectColor(select) {
        // Xóa các lớp cũ
        select.classList.remove('status-pending', 'status-approved', 'status-rejected');

        // Thêm lớp màu dựa trên giá trị đã chọn
        if (select.value === 'Chờ duyệt') {
            select.classList.add('status-pending');
        } else if (select.value === 'Đã duyệt') {
            select.classList.add('status-approved');
        } else if (select.value === 'Không được duyệt') {
            select.classList.add('status-rejected');
        }
    }
});

function toggleIcon() {
    const searchInput = document.querySelector('.search-bar');
    const searchIcon = document.querySelector('.search-icon');
    
    if (searchInput.value.trim() !== '') {
        searchIcon.classList.add('hidden');
    } else {
        searchIcon.classList.remove('hidden');
    }
}
