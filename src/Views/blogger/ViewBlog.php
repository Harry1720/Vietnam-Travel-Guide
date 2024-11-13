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

    <!-- Lấy DL từ BE -->
    <?php 
        include_once("../../Controllers/adminController.php");
        $controller = new AdminController();

        //$_GET['postID']: Lay tu story sang day blogID (e.g., blog.php?postID=1).
        //intval(): dam bao la int value tu ben kia lay sang : 1 (co nghia la, mac dinh se lay trang Hanoi )
        $blogID = isset($_GET['blogID']) ? intval($_GET['postID']) : 1;
    
        $content = $controller->getBlogbyID($blogID);  //get đầu mục cho header
        $imgArray = $controller->getPictureBlogbyID( $blogID); //Lầy hình hiển thị nội dung cho trang 
    ?>

    <!-- rót dữ liệu từ hàm trên  -->
    <div class="main-container">
        <div class="blog-image">
            <button id="prev-btn" onclick="prevImage()">&#x25C0;</button>
                <img id="blog-img" src="<?php echo $imgArray[0]['imgBlogURL'] ?? '/public/image/default.jpg'; ?>" alt="Blog Image "  onclick="zoomImage()">
            <button id="next-btn" onclick="nextImage()">&#x25B6;</button>
        </div>

        <!-- Blog List (list các hình) -->
        <div class="blog-list">
            <ul>       
                <?php
                    $tong = 1; 
                    foreach ($imgArray as $index => $img) { ?>
                    <li onclick="displayBlog(<?php echo $index; ?>)">
                        <img src="<?php echo $img['imgBlogURL']; ?>" alt="Blog Thumbnail"  onclick="zoomImage()">
                        <p><?php echo 'Hình '. $tong;  $tong++?></p>
                    </li>
                <?php } ?>
            </ul>   
        </div>

        <!-- Blog Content -->
        <div class="blog-content" id="blog-content">
            <h2 id="blog-title"><?php echo $content['blogTitle'] ?></h2>
            <p id="blog-text"><?php echo $content['blogContent'] ?></p>
        </div>

         <!-- Zoomed Image Container -->
        <div class="zoom-container" id="zoomContainer">
            <button class="close-btn" onclick="closeZoom()">Close</button>
            <img id="zoomedImage" src="" alt="Zoomed Image">
        </div>

    </div>

    <script>
    // Truyền 1 mảng imgArray, mới lấy ở trên ở dạng JSON file 
        let images = <?php echo json_encode(value: array_map(function($img) {
            return $img['imgBlogURL'];
        }, $imgArray)); ?>;
    </script>

    <!-- Footer (được import từ file khác) -->
    <div id="footer"></div>

    <script src="../../../public/js/blogger/ViewBlog.js"></script>
</body>
</html>
