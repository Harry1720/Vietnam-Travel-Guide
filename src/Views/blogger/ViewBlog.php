<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog</title>
    <link rel="stylesheet" href="../../../public/css/Blogger/ViewBlog.css">
    <!-- <link rel="stylesheet" href="../../../public/css/Blogger/province.css"> -->
    <link rel="stylesheet" href="../../../public/css/Blogger/header2.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/footer.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/paging.css">
</head>

<body>
    
    <script src = "../../../include/header2.js"></script>
    <script src = "../../../include/footer.js"></script>
    <!-- Lấy DL từ BE -->
    <?php 
        include_once("../../Controllers/bothController.php");
        $controller = new bothController();

        //$_GET['postID']: Lay tu story sang day blogID (e.g., blog.php?postID=1).
        //intval(): dam bao la int value tu ben kia lay sang : 1 (co nghia la, mac dinh se lay trang Hanoi )
        $blogID = isset($_GET['blogID']) ? intval($_GET['blogID']) : 1;
        $content = $controller->getBlogbyID($blogID);  //get đầu mục cho header
        $imgArray = $controller->getPictureBlogbyID( $blogID); //Lầy hình hiển thị nội dung cho trang 

        //Lấy comment từ BE  hien thi cho blog --> blogid được lấy từ trang storieslist hiện sang
        $comments = $controller->getCommentsAndReplies($blogID); // Store the returned array of comments
    ?>


</head>

<body>
    <!-- $content có chứa blog id -->
    
    <!-- rót dữ liệu từ hàm trên  -->
    <div class="main-container">
        <div class="blog-image">
            <button id="prev-btn" onclick="prevImage()">&#x25C0;</button>
                <img id="blog-img" src="<?php echo $imgArray[0]['imgBlogURL'] ?? '/public/image/default.jpg'; ?>" alt="Blog Image "  onclick="zoomImage()">
            <button id="next-btn" onclick="nextImage()">&#x25B6;</button>
        </div>

        <!-- Blog List (list các hình) -->
        <div class="blog-list">
            <h2>Hình ảnh</h2>
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
    </div>

    <!-- Zoomed khi bấm vào hình, thử click hình ở giữa -->
    <div class="zoom-container" id="zoomContainer">
        <button class="close-btn" onclick="closeZoom()">&times</button>
        <img id="zoomedImage" src="" alt="Zoomed Image">
    </div>

    <!-- Blog Content -->
    <div class="blog-content" id="blog-content">
        <h2 id="blog-title"><?php echo $content['blogTitle'] ?></h2>
        <p id="blog-text"><?php echo nl2br($content['blogContent']); ?></p>
        <!-- Hàm nl2br() sẽ chuyển đổi các ký tự xuống dòng (\n) trong chuỗi thành thẻ <br>-->
    </div>

    <script>
    // Truyền 1 mảng imgArray, mới lấy ở trên ở dạng JSON file 
        let images = <?php echo json_encode(value: array_map(function($img) {
            return $img['imgBlogURL'];
        }, $imgArray)); ?>;
    </script>

    <!-- <div class = "comment-frame">
        <h3>Bình luận</h3>
        <form class="comment" action="#">
            <input class="comment_input" type="text" placeholder="Chia sẻ ý kiến của bạn" required>
            <input class="comment_send_button" type="submit">
        </form>
        <div class = "blogger-comment">
             Họ và Tên
        </div>
    </div> -->

    <div class="comment-frame">
    <?php if (!empty($comments)) { ?>
        
        <?php foreach ($comments as $comment) { ?>
            <div class="comment-box">
                <p><strong><?php echo htmlspecialchars($comment['userName']); ?></strong> 
                <?php echo htmlspecialchars($comment['createDate']); ?> : <?php echo htmlspecialchars($comment['cmtContent']); ?></p>
                
                <!-- ô hiển thị chổ để điền comment  -->
                <form class="reply" action="../../Controllers/commentController.php" method="post">
                    <input type="hidden" name="blogID" value="<?php echo $blogID; ?>">
                    <input type="hidden" name="parentCommentID" value="<?php echo $comment['commentID']; ?>">
                    <input class="reply_input" name="reply" type="text" placeholder="Trả lời bình luận" required>
                    <input class="reply_send_button" type="submit" value="Gửi">
                </form>

                <!-- khúc này hiển thi reply -->
                <?php if (!empty($comment['replies'])) { ?>
                    <!-- nút ẩn hiện, khi onclick thì sẽ ẩn rep  . Do onchange buộc phải đổi data, dùng phương án bài thầy cho-->
                    <button class="show-replies-button" onclick="toggleReplies(this)">Show Replies</button>
                    <div class="replies-section">
                        <?php foreach ($comment['replies'] as $reply) { ?>
                            <div class="reply-box">
                                <p><strong><?php echo htmlspecialchars($reply['userName']); ?></strong> <?php echo htmlspecialchars($reply['createDateRep']); ?>: <?php echo htmlspecialchars($reply['repContent']); ?></p>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No comments yet. Be the first to comment!</p>
    <?php } ?>
    </div>

    <!-- Footer (được import từ file khác) -->
    

</body>
</html>
