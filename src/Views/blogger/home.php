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
    
    <section class="provinces section-common">
        <h2>Tỉnh thành</h2>
        <p>Tổng hợp các tỉnh thành của Việt Nam</p>
        <a href="province.php" class="btn-page">Xem tất cả</a>
        <div class="grid-common">
                <?php
                    include_once "../../Controllers/adminController.php";
                    $controller = new AdminController();
                
                    // Get current page number from URL, default to 1 if not set
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                    $limitPost= 3;
                    $firstPost = 0; //lấy post 1 
                    // Get posts for the current page - status = 1, có nghĩa là post đó vẫn còn trong DB
                    $posts = $controller->getPostsByPage($limitPost, $firstPost, 1);

                    foreach ($posts as $post):
                ?>
                    <a href="../post.php?postID=<?php echo $post['postID']; ?> " class="card-common">
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
        <a href="#" class="btn-page">Xem tất cả</a>
        <div class="grid-common">
            <div class="card-common">
                <img src="../../../public/image/NinhBinh.jpeg" alt="province">
                <p>Ninh Bình</p>
                <h4>Tràng An</h4>
            </div>
            <div class="card-common">
                <img src="../../../public/image/Hue.jpeg" alt="province">
                <p>Huế</p>
                <h4>Lăng Khải Định</h4>
            </div>
            <div class="card-common">
                <img src="../../../public/image/QB.jpg" alt="province">
                <p>Quảng Bình</p>
                <h4>Hang Sơn Đoòng</h4>
            </div>
        </div>
    </section>

    <!--Default, cho kéo 4 hình của 4 id đầu -->
    <section class="blog section-common">
        <h2>Những câu chuyện du lịch nổi bật</h2>
        <p>Khám phá những trải nghiệm đầy chân thật từ các bloggers</p>
        <a href="storiesList.html" class="btn-page">Xem tất cả Blogs</a>
        <div class="grid-common">
            <div class="card-common">
                <img src="../../..//public/image/ChoNoi.jpg" alt="Mumbai, India">
                <div class="card-content">
                    <div class="location_time">
                        <p class="location">Barcelona, Spain</p>
                        <p class="time">Feb 27, 2023 • 5 min read</p>
                    </div>
                         Wonderful Journey to India</h4>
                    <span>I had always been interested in spirituality...</span>
                </div>
            </div>
            <div class="card-common">
                <img src="../../../public/image/Hue.jpeg" alt="Barcelona, Spain">
                <div class="card-content">
                    <div class="location_time">
                        <p class="location">Barcelona, Spain</p>
                        <p class="time">Feb 27, 2023 • 5 min read</p>
                    </div>
                    <h4>A Solo Trip Across Europe</h4>
                    <span>I had just graduated from college...</span>
                </div>
            </div>
            <div class="card-common">
                <img src="../../..//public/image/QB.jpg" alt="Barcelona, Spain">
                <div class="card-content">
                    <div class="location_time">
                        <p class="location">Barcelona, Spain</p>
                        <p class="time">Feb 27, 2023 • 5 min read</p>
                    </div>
                    <h4>A Solo Trip Across Europe</h4>
                    <span>I had just graduated from college...</span>
                </div>
            </div>
            <div class="card-common">
                <img src="../../..//public/image/Hue.jpeg" alt="Barcelona, Spain">
                <div class="card-content">
                    <div class="location_time">
                        <p class="location">Barcelona, Spain</p>
                        <p class="time">Feb 27, 2023 • 5 min read</p>
                    </div>
                    <h4>A Solo Trip Across Europe</h4>
                    <span>I had just graduated from college...</span>
                </div>
            </div>
        </div>
    </section>

</body>

</html>