document.addEventListener('DOMContentLoaded', () => {
    const destinationForm = document.getElementById("destination-form");
    const popup1Overlay = document.getElementById('popup1Overlay');
    const searchInput = document.querySelector('.search-bar');
    let isEditing = false;
    let editingDiamondId = null;

    searchInput.addEventListener('input', () => {
        const searchText = searchInput.value.trim().toLowerCase();
        const rows = document.querySelectorAll('#province-List tr');

        rows.forEach(row => {
            const postTitle = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = postTitle.includes(searchText) ? 'table-row' : 'none';
        });
    });

    document.getElementById('open').addEventListener('click', () => {
        destinationForm.reset();
        popup1Overlay.style.display = 'flex';
        resetFormState();
    });

    document.getElementById('close').addEventListener('click', () => {
        if (confirm("Xác Nhận Hủy?")) {
            popup1Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancelButton').addEventListener('click', () => {
        if (confirm("Xác Nhận Hủy?")) {
            popup1Overlay.style.display = 'none';
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup1Overlay) {
            if (confirm("Xác Nhận Hủy?")) {
                popup1Overlay.style.display = 'none';
            }
        }
    });

    function resetFormState() {
        isEditing = false;
        editingDiamondId = null;
    }
});



function toggleDestinations(id) {
    // Lấy tất cả các hàng điểm đến
    const allDestinationRows = document.querySelectorAll('.destination-row');

    // Đóng tất cả các bảng con khác
    allDestinationRows.forEach(row => {
        if (row.id !== `destinations-${id}`) {
            row.style.display = 'none';
        }
    });

    // Lấy hàng điểm đến của tỉnh thành được chọn
    const destinationRow = document.getElementById(`destinations-${id}`);

    // Chuyển đổi hiển thị của hàng điểm đến được chọn
    if (destinationRow.style.display === 'none' || destinationRow.style.display === '') {
        destinationRow.style.display = 'table-row';
    } else {
        destinationRow.style.display = 'none';
    }
}
