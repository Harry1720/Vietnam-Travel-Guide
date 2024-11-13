fetch("/include/footer.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("footer").innerHTML = data;
    });

fetch("/include/header2.html")
    .then(response => response.text())
    .then(data => {
        document.getElementById("header").innerHTML = data;
    });
const blogs = [
    {
        title: "Blog 1 Title",
        content: "This is the content for Blog 1.",
        images: ["image1.jpg", "image2.jpg", "image3.jpg"]
    },
    {
        title: "Blog 2 Title",
        content: "This is the content for Blog 2.",
        images: ["image4.jpg", "image5.jpg"]
    }
    // Thêm các blog khác tương tự
];

let currentBlogIndex = 0;
let currentImageIndex = 0;

function displayBlog(index) {
    currentBlogIndex = index;
    currentImageIndex = 0;
    const blog = blogs[index];
    document.getElementById("blog-title").innerText = blog.title;
    document.getElementById("blog-text").innerText = blog.content;
    document.getElementById("blog-img").src = blog.images[currentImageIndex];
}

function nextImage() {
    const blog = blogs[currentBlogIndex];
    if (currentImageIndex < blog.images.length - 1) {
        currentImageIndex++;
    } else {
        currentImageIndex = 0; // Quay lại ảnh đầu tiên
    }
    document.getElementById("blog-img").src = blog.images[currentImageIndex];
}

function prevImage() {
    const blog = blogs[currentBlogIndex];
    if (currentImageIndex > 0) {
        currentImageIndex--;
    } else {
        currentImageIndex = blog.images.length - 1; // Quay lại ảnh cuối cùng
    }
    document.getElementById("blog-img").src = blog.images[currentImageIndex];
}
