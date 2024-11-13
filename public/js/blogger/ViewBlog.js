
fetch("../../../include/footer.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("footer").innerHTML = data;
    });

fetch("../../../include/header2.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("header").innerHTML = data;
    });

// Use the images array passed from PHP
let currentImageIndex = 0;

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

// Hàm zoom để khi bấm vào hình, hình sẽ zoom lên  
function zoomImage() {
    const zoomContainer = document.getElementById("zoomContainer");
    const zoomedImage = document.getElementById("zoomedImage");
    zoomedImage.src = images[currentImageIndex];
    zoomContainer.style.display = "flex";
}

function closeZoom() {
    const zoomContainer = document.getElementById("zoomContainer");
    zoomContainer.style.display = "none";
}


// Initial display on page load
window.onload = () => {
    if (images.length > 0) {
        showImage(0);
    }
};
