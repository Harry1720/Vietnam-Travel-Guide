document.addEventListener('DOMContentLoaded', () => {
    const destinationForm = document.getElementById("destination-form");
    const searchInput = document.querySelector('.search-bar');

    if (!popup) {
        console.error('Popup element not found');
    }
    

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

    document.querySelectorAll('.edit-btn').forEach(button => { //để kích hoạt mọi nút edit-btn mỗi dòng
        button.addEventListener('click', () => {
            resetFormState();
            popup2Overlay.style.display = 'flex';
        });
    });


    document.getElementById('close2').addEventListener('click', () => {
        if (confirm("Xác Nhận Hủy?")) {
            popup2Overlay.style.display = 'none';
        }
    });

    document.getElementById('cancelButton1').addEventListener('click', () => {
        if (confirm("Xác Nhận Hủy?")) {
            popup2Overlay.style.display = 'none';
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target === popup2Overlay) {
            if (confirm("Xác Nhận Hủy?")) {
                popup2Overlay.style.display = 'none';
            }
        }
    });

    document.querySelectorAll('.delete-destination').forEach(button => {
        button.addEventListener('click', (event) => {
            const destinationID = event.currentTarget.getAttribute('data-destination-id');
            console.log('Xóa điểm đến với ID:', destinationID); // Kiểm tra ID
            popup.style.display = 'flex';
        });
    });

    function resetFormState() {
        isEditing = false;
        editingDiamondId = null;
    }
});

function deleteID(id){
    console.log(id);
    document.getElementById('deleteID').value=id;
}

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

function toggleIcon() {
    const searchInput = document.querySelector('.search-bar');
    const searchIcon = document.querySelector('.search-icon');
    
    if (searchInput.value.trim() !== '') {
        searchIcon.classList.add('hidden');
    } else {
        searchIcon.classList.remove('hidden');
    }
}


async function editDestination(destinationID) {
    try {
        console.log('Fetching user data for ID:', destinationID);
        
        const response = await fetch(`../../FunctionOfActor/admin/getDestination.php?editDestinationID=${destinationID}`);
        console.log('Raw response:', response);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const rawData = await response.text();
        
        let destinationData;
        try {
            destinationData = JSON.parse(rawData); 
        } catch (parseError) {
            console.error('JSON parse error:', parseError);
            throw new Error('Invalid JSON response');
        }
    
        
        // Update form fields
        document.getElementById('destinationID').value = destinationData.destinationID;
        document.getElementById('destinationName1').value = destinationData.destinationName;
        document.getElementById('description1').value = destinationData.destinationContent;
        document.getElementById('imgdes').src = destinationData.imgDesURL;
        document.getElementById('imgdesURL').value = destinationData.imgDesURL;
        
    } catch (error) {
        console.error('Error in editUser function:', error);
    }
}