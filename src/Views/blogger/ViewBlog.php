<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog</title>
    <link rel="stylesheet" href="../../../public/css/Blogger/ViewBlog.css">
</head>

<body>
    <!-- Header (được import từ file khác) -->
    <div id="header"></div>

    <div class="main-container">
        <div class="blog-image">
            <button id="prev-btn" onclick="prevImage()">&#x25C0;</button>
            <img id="blog-img" src="/public/image/ChoNoi.jpg" alt="Blog Image">
            <button id="next-btn" onclick="nextImage()">&#x25B6;</button>
        </div>
        
        <div class="blog-list">
            <ul>
                <li onclick="displayBlog(0)"> <!-- Blog 1 -->
                    <img src="/public/image/diengio.jpg" alt="Blog Thumbnail">
                    <p>Blog 1 Title</p>
                </li>
                <li onclick="displayBlog(1)"> <!-- Blog 2 -->
                    <img src="/public/image/Hue.jpeg" alt="Blog Thumbnail">
                    <p>Blog 2 Title</p>
                </li>
                <!-- Thêm các blog khác tương tự -->
            </ul>
        </div>
        
        <div class="blog-content" id="blog-content">
            <h2 id="blog-title">Blog Title</h2>
            <p id="blog-text">Blog content goes here...</p>
        </div>
    </div>

    <!-- Footer (được import từ file khác) -->
    <div id="footer"></div>

    <script src="/public/js/ViewBlog.js"></script>
</body>
</html>
