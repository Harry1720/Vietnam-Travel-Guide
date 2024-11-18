let images = [];  // Initialize the images array globally
let currentImageIndex = 0;

//hiển thị lên main container
function showImage(index) {
    if (images.length > 0) {
        const blogImg = document.getElementById("blog-img");
        blogImg.src = images[index];
        currentImageIndex = index;
    }
}

function nextImage() {
    if (images.length > 0) {
        currentImageIndex = (currentImageIndex + 1) % images.length; // Loop to first image after last
        showImage(currentImageIndex);
    }
}

function prevImage() {
    if (images.length > 0) {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length; // Loop to last image before first
        showImage(currentImageIndex);
    }
}

// hiện hình của list thumbnail lên main container  
function displayBlog(index) {
    currentImageIndex = index;
    showImage(currentImageIndex);  // Update the main image to the clicked thumbnail
    zoomOut(); // Zoom out effect when thumbnail is clicked
}



// Hàm zoom để khi bấm vào hình, hình sẽ zoom lên  
function zoomImage() {
    const zoomContainer = document.getElementById("zoomContainer");
    const zoomedImage = document.getElementById("zoomedImage");
    zoomedImage.src = images[currentImageIndex];
    zoomContainer.style.display = "flex";
}

//tắt zoom  
function closeZoom() {
    const zoomContainer = document.getElementById("zoomContainer");
    zoomContainer.style.display = "none";
}

//zoom out hình ở list thumbnai;
function zoomOut() {
    const blogImg = document.getElementById("blog-img");
    blogImg.classList.add('zoom-out'); 
    setTimeout(() => {
        blogImg.classList.remove('zoom-out'); 
    }, 300);  
}

// hàm này khơi tạo mảng hình được nhận từ php
function initializeImages(imgArray) {
    images = imgArray;
    if (images.length > 0) {
        showImage(0);
    }
}


//hàm dùng để ẩn reply comment 
function toggleReplies(button) {
    
    //nếu không dùng currentDisplace -> thì lần đầu mặc định click, trang browser sẽ tự trả về chuổi rỗng -> tức kh có onchange
    const repliesSection = button.nextElementSibling;
    // repSection - nó lưu vị trí của sibling element -> tức là nó lưu cái replysection 
    //nó lưu displace hiện tại của repsec 
    const currentDisplay = window.getComputedStyle(repliesSection).display;

    //nếu reply none thì -> rep hiện và có nút hide 
    if (currentDisplay === 'none') {
        repliesSection.style.display = 'block';
        button.textContent = 'Ẩn trả lời';
    } else {
        repliesSection.style.display = 'none';
        button.textContent = 'Trả lời';
    }
}



// Initial display on page load
window.onload = () => {
    if (images.length > 0) {
        showImage(0);
    }
}; 





