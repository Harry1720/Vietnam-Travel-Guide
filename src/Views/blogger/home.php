<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/Blogger/home.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/header.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/footer.css">

    <title>Trang chủ</title>
    <style>
    </style>
</head>
<body>
    <!-- <iframe class="header" src="../../../include/header2.html"></iframe> -->
    <script src = "../../../include/header.js"></script>
    <script src = "../../../include/footer.js"></script>
    
    <!-- JS của nút click hình trong section-common -->
    <script src="../../../public/js/destination.js"></script>

    <?php
        include_once "../../Controllers/bothController.php";
        $controller = new bothController();
    
        // Get dữ liệu cho ba ô tỉnh thành tại trang home
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $limitPost= 3;
        $firstPost = 0; //lấy post 1 
        // Get posts for the current page - status = 1, có nghĩa là post đó vẫn còn trong DB
        $posts = $controller->getPostsByPage($limitPost, $firstPost);
        
    
        $destinations = $controller->getDestinationPage();

        // Get dữ liệu cho các ô blog tại trang home
        $limitBlog = 4;
        $firstBlog = 0; //lấy post số 1 cho đến 4 blogs
        $blogs = $controller->getBlogByPage($limitBlog,  $firstBlog);
    ?>
  


    <section class="provinces section-common">
        <h2>Tỉnh thành</h2>
        <p>Tổng hợp các tỉnh thành của Việt Nam</p>
        <a href="province.php" class="btn-page">Xem tất cả</a>
        <div class="grid-common">    
            <?php foreach ($posts as $post): ?>
                <a href="post.php?postID=<?php echo $post['postID']; ?> " class="card-common">
                    <img src="<?php echo htmlspecialchars($post['imgPostURL']); ?>" alt="province">
                    <div class="card-common">
                        <h4 style="color: #333"><?php echo htmlspecialchars($post['provinceName']); ?></h4>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="location section-common">
        <h2>Địa danh</h2>
        <p>Những địa danh nổi tiếng của Việt Nam</p>
        <a href="destination.php" class="btn-page">Xem các địa danh</a>
        <div class="grid-common">
            <?php foreach ($destinations as $destination): ?>
                <a href="destination.php" class="card-common">
                    <img src="<?php echo htmlspecialchars($destination['imgDesURL']); ?>">
                    <div class="card-common">
                        <h4 style="color: #333"><?php echo htmlspecialchars($destination['destinationName']); ?></h4>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!--Default, cho kéo 4 hình của 4 id đầu -->
    <section class="blog section-common">
        <h2>Những câu chuyện du lịch nổi bật</h2>
        <p>Khám phá những trải nghiệm đầy chân thật từ các bloggers</p>
        <a href="storiesList.php" class="btn-page">Xem tất cả Blogs</a>
        <div class="grid-common">

            <?php foreach ($blogs as $blog): ?>
                <a href="ViewBlog.php?blogID=<?php echo $blog['blogID']; ?> " class="card-common">
                    <img src="<?php echo htmlspecialchars($blog['imgBlogURL']); ?>" alt="province">
                    <div class="card-common">
                        <h4 style="color: #333"><?php echo htmlspecialchars($blog['blogTitle']); ?></h4>
                    </div>
                </a>
            <?php endforeach; ?>
            
        </div>
    </section>

</body>

</html>