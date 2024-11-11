document.addEventListener('DOMContentLoaded', () => {
    const postForm = document.getElementById("post-form");
    const searchInput = document.querySelector('.search-bar');
    const popup1Overlay = document.getElementById('popup1Overlay');
    const token = localStorage.getItem('authToken');
    const popup2Overlay = document.getElementById('popup2Overlay');

    searchInput.addEventListener('input', () => {
        const searchText = searchInput.value.trim().toLowerCase();
        const rows = document.querySelectorAll('#post-table-body tr');

        rows.forEach(row => {
            const postTitle = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            row.style.display = postTitle.includes(searchText) ? 'table-row' : 'none';
        });
    });

    const resetFormState = () => {
        postForm.reset();
    };


    document.getElementById('openpopup1').addEventListener('click', () => {
        // postForm.reset();
        popup1Overlay.style.display = 'flex';
        resetFormState();
    });

    document.getElementById('closepopup1').addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup1Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancelButton').addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup1Overlay.style.display = 'none';
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup1Overlay) {
            if(confirm("Xác Nhận Hủy?")){
                popup1Overlay.style.display = 'none';
            }
        }
    });

    document.querySelectorAll('.edit').forEach(button => { //để kích hoạt mọi nút edit-btn mỗi dòng
        button.addEventListener('click', () => {
            resetFormState();
            popup2Overlay.style.display = 'flex';
        });
    });
        
    document.getElementById('closepopup2').addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup2Overlay.style.display = 'none';
        }
    });
    
    document.getElementById('cancelButton2').addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup2Overlay.style.display = 'none';
        }
    });
        
    window.addEventListener('click', (event) => {
        if (event.target === popup2Overlay && confirm("Xác nhận hủy?")) {
            popup2Overlay.style.display = 'none';
            removeAdminOption();
        }
    });
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