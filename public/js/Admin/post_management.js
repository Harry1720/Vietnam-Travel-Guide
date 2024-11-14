document.addEventListener('DOMContentLoaded', () => {
    const postForm = document.getElementById("post-form");
    const searchInput = document.querySelector('.search-bar');
    const popup1Overlay = document.getElementById('popup1Overlay');
    const popup2Overlay = document.getElementById('popup2Overlay');
    const popup3Overlay = document.getElementById('popup3Overlay');
    const popup = document.getElementById('popup');
    const popup1 = document.getElementById('popup1');

    // Search functionality
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

    window.addEventListener('click', (event) => {
        if (event.target === popup1Overlay && confirm("Xác Nhận Hủy?")) {
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

    window.addEventListener('click', (event) => {
        if (event.target === popup2Overlay && confirm("Xác nhận hủy?")) {
            popup2Overlay.style.display = 'none';
        }
    });

    // Popup 3 (Chỉnh sửa chi tiết bài viết)
    document.querySelectorAll('.edit-post-detail').forEach(button => {
        button.addEventListener('click', () => {
            resetFormState();
            popup3Overlay.style.display = 'flex';
        });
    });

    document.getElementById('closepopup3')?.addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup3Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancelButton3')?.addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup3Overlay.style.display = 'none';
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup3Overlay && confirm("Xác Nhận Hủy?")) {
            popup3Overlay.style.display = 'none';
        }
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

    // Đóng popup xóa bài viết khi nhấn "Không"
    document.getElementById('no-btn').addEventListener('click', () => {
        if (confirm("Xác nhận hủy?")) {
            popup.style.display = 'none';
        }
    });

    // Đóng popup xóa chi tiết bài viết khi nhấn "Không"
    document.getElementById('no-btn1').addEventListener('click', () => {
        if (confirm("Xác nhận hủy?")) {
            popup1.style.display = 'none';
        }
    });
});

function toggleDestinations(id) {
    const allDestinationRows = document.querySelectorAll('.destination-row');

    allDestinationRows.forEach(row => {
        row.style.display = (row.id === `destinations-${id}` && row.style.display !== 'table-row') ? 'table-row' : 'none';
    });
}

function toggleIcon() {
    const searchInput = document.querySelector('.search-bar');
    const searchIcon = document.querySelector('.search-icon');
    
    searchIcon.classList.toggle('hidden', searchInput.value.trim() !== '');
}

async function editpost(postID) {
    try {
        console.log('Fetching user data for ID:', postID);
        const response = await fetch(`../../FunctionOfActor/admin/getPost.php?editPostID=${postID}`);
        
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        
        const rawData = await response.text();
        const PostData = JSON.parse(rawData);

        document.getElementById('province-edit').value = PostData.province;
        document.getElementById('image-posted').src = PostData.imagepost;
        document.getElementById('postID').value = PostData.postID;
        document.getElementById('imageposted').value = PostData.imagepost;

    } catch (error) {
        console.error('Error in editPost function:', error);
        alert('Error loading post data. Please check console for details.');
    }
}

async function editpostdetail(postDetailID) {
    try {
        console.log('Fetching post detail for ID:', postDetailID);
        const response = await fetch(`../../FunctionOfActor/admin/getPostDetail.php?editPostDetailID=${postDetailID}`);
        
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        
        const rawData = await response.text();
        const postDetailData = JSON.parse(rawData);

        document.getElementById('displayTitle').textContent = postDetailData.sectionTitle;
        document.getElementById('title').value = postDetailData.sectionTitle;
        document.getElementById('postDetailID').value = postDetailData.postDetailID;
        document.getElementById('content').value = postDetailData.sectionContent;
        document.getElementById('data_img').src = postDetailData.imgPostDetURL;
        document.getElementById('imgposted').value = postDetailData.imgPostDetURL;

    } catch (error) {
        console.error('Error in editpostdetail function:', error);
        alert('Error loading post detail data. Please check console for details.');
    }
}
