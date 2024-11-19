document.addEventListener('DOMContentLoaded', () => {
    const popup1Overlay = document.getElementById('popup1Overlay');
    const popup2Overlay = document.getElementById('popup2Overlay');
    const popup3Overlay = document.getElementById('popup3Overlay');
    const popup = document.getElementById('popup');

    // Lấy các nút đóng popup
    const noBtn = document.getElementById('no-btn');

    document.getElementById('closepopup1')?.addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup1Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancelButton')?.addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
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

    // Popup 2 (Chỉnh sửa bài viết)
    window.addEventListener('click', (event) => {
        if (event.target === popup2Overlay) {
            if (confirm("Xác Nhận Hủy?")) {
                popup2Overlay.style.display = 'none';
            }
        }
    });
    document.querySelectorAll('.edit').forEach(button => {
        button.addEventListener('click', () => {
            popup2Overlay.style.display = 'flex';
        });
    });

    document.getElementById('openpopup1')?.addEventListener('click', () => {
        popup1Overlay.style.display = 'flex';
    });

    document.getElementById('edit-post-detail-btn')?.addEventListener('click', () => {
        popup2Overlay.style.display = 'flex';
    });

    document.getElementById('closepopup2')?.addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup2Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancelButton2')?.addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup2Overlay.style.display = 'none';
        }
    });
     //Popup 3
    document.getElementById('closepopup3')?.addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup3Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancelButton3')?.addEventListener('click', () => {
        event.preventDefault();
        if(confirm("Xác Nhận Hủy?")){
            popup3Overlay.style.display = 'none';
        }
    });
    
    window.addEventListener('click', (event) => {
        if (event.target === popup3Overlay) {
            if (confirm("Xác Nhận Hủy?")) {
                popup3Overlay.style.display = 'none';
            }
        }
    });
    
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', () => {
            popup.style.display = 'flex';
        });
    });
    
    
    // Đóng popup xóa bài viết
    noBtn.addEventListener('click', (event) => {
        event.preventDefault();
        popup.style.display = 'none';
    });
    
});