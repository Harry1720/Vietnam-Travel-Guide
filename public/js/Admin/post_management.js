document.addEventListener('DOMContentLoaded', () => {
    const postForm = document.getElementById("post-create-form");
    const searchInput = document.querySelector('.search-bar-post');
    const popup1 = document.getElementById('popup1');
    const noBtn1 = document.getElementById('no-btn1');
    const popup1Overlay = document.getElementById('popup1Overlay');

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

    document.getElementById('openpopup1')?.addEventListener('click', () => {
        popup1Overlay.style.display = 'flex';
        resetFormState();
    });

    // Popup 3 (Chỉnh sửa chi tiết bài viết)
    document.querySelectorAll('.edit-post-detail').forEach(button => {
        button.addEventListener('click', () => {
            resetFormState();
            popup3Overlay.style.display = 'flex';
        });
    });

    // Mở popup xóa chi tiết bài viết
    document.querySelectorAll('.delete-post-detail').forEach(button => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();
            popup1.style.display = 'flex';
        });
    });

    // Đóng popup xóa chi tiết bài viết
    noBtn1.addEventListener('click', (event) => {
        event.preventDefault();
        popup1.style.display = 'none';
    });
});

function deleteID(id){
    console.log("Main: ",id);
    document.getElementById('deleteID').value=id;
}

function deleteDetailID(id){
    console.log("Detail: ",id);
    document.getElementById('deleteDetailID').value=id;
}

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
