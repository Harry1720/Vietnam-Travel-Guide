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


    document.querySelectorAll('.edit-post-detail').forEach(button => { //để kích hoạt mọi nút edit-btn mỗi dòng
        button.addEventListener('click', () => {
            resetFormState();
            popup3Overlay.style.display = 'flex';
        });
    });

    document.getElementById('closepopup3').addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup3Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancelButton3').addEventListener('click', () => {
        if(confirm("Xác Nhận Hủy?")){
            popup3Overlay.style.display = 'none';
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup3Overlay) {
            if(confirm("Xác Nhận Hủy?")){
                popup3Overlay.style.display = 'none';
            }
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

    // Kiểm tra xem có hàng điểm đến tồn tại không trước khi chuyển đổi hiển thị
    if (destinationRow) {
        // Chuyển đổi hiển thị của hàng điểm đến được chọn
        if (destinationRow.style.display === 'none' || destinationRow.style.display === '') {
            destinationRow.style.display = 'table-row';
        } else {
            destinationRow.style.display = 'none';
        }
    } else {
        console.error(`Không tìm thấy hàng điểm đến với ID: destinations-${id}`);
    }
}


function toggleIcon() {
    const searchInput = document.querySelector('.search-bar');
    const searchIcon = document.querySelector('.search-icon');
    
    if (searchInput.value.trim() !== '') {
        searchIcon.classList.add('hidden');
    } else {
        searchIcon.classList.remove('hidden');
    }
}

async function editpost(postID) {
    try {
        console.log('Fetching user data for ID:', postID);
        
        const response = await fetch(`../../FunctionOfActor/admin/getPost.php?editPostID=${postID}`);
        console.log('Raw response:', response);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const rawData = await response.text();
        
        let PostData;
        try {
            PostData = JSON.parse(rawData); // Thử parse JSON
            console.log('Parsed user data:', PostData);
        } catch (parseError) {
            console.error('JSON parse error:', parseError);
            console.log('Failed to parse response:', rawData);
            throw new Error('Invalid JSON response');
        }
    
        
        // // Update form fields
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
        console.log('Fetching user data for ID:', postDetailID);
        
        const response = await fetch(`../../FunctionOfActor/admin/getPostDetail.php?editPostDetailID=${postDetailID}`);
        console.log('Raw response:', response);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const rawData = await response.text();
        
        let postDetailData;
        try {
            postDetailData = JSON.parse(rawData); // Thử parse JSON
            console.log('Parsed postDetail data:', postDetailData);
        } catch (parseError) {
            console.error('JSON parse error:', parseError);
            console.log('Failed to parse response:', rawData);
            throw new Error('Invalid JSON response');
        }

        // Update form fields
        document.getElementById('displayTitle').textContent = postDetailData.sectionTitle;
        document.getElementById('title').value = postDetailData.sectionTitle;
        document.getElementById('postDetailID').value = postDetailData.postDetailID;
        document.getElementById('content').value = postDetailData.sectionContent;
        document.getElementById('data_img').src = postDetailData.imgPostDetURL;
        document.getElementById('imgposted').value = postDetailData.imgPostDetURL;
        
    } catch (error) {
        console.error('Error in editUser function:', error);
        alert('Error loading user data. Please check console for details.');
    }
}