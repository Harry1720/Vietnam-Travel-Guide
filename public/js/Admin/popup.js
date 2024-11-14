document.addEventListener('DOMContentLoaded', () => {
    const popup1Overlay = document.getElementById('popup1Overlay');
    const popup2Overlay = document.getElementById('popup2Overlay');
    const popup3Overlay = document.getElementById('popup3Overlay');
    const popup = document.getElementById('popup');
    const popup1 = document.getElementById('popup1');

    // Popup 1 (Form mở)
    document.getElementById('openpopup1')?.addEventListener('click', () => {
        popup1Overlay.style.display = 'flex';
        resetFormState();
    });

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

    // Popup 2 (Chỉnh sửa bài viết)
    document.querySelectorAll('.edit').forEach(button => {
        button.addEventListener('click', () => {
            popup2Overlay.style.display = 'flex';
        });
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
    
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', () => {
            popup.style.display = 'flex';
        });
    });

    // Mở popup xóa bài viết
    document.querySelectorAll('.delete-post').forEach(button => {
        button.addEventListener('click', () => {
            popup.style.display = 'flex';
        });
    });

    // Mở popup xóa chi tiết bài viết
    document.querySelectorAll('.delete-post-detail').forEach(button => {
        button.addEventListener('click', () => {
            popup1.style.display = 'flex';
        });
    });

    document.getElementById("no-btn").addEventListener("click", function(event) {
        if(confirm("Hủy bỏ thao tác xóa.")){
            // chặn submit form
            event.preventDefault();
            popup.style.display = 'none';
        }
    });

    document.getElementById("no-btn1").addEventListener("click", function(event) {
        if(confirm("Hủy bỏ thao tác xóa.")){
            // chặn submit form
            event.preventDefault();
            popup1.style.display = 'none';
        }
    });
});