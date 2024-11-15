<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../public/css/Blogger/province.css">
        <link rel="stylesheet" href="../../../public/css/Blogger/header2.css">
        <link rel="stylesheet" href="../../../public/css/Blogger/footer.css">
        <link rel="stylesheet" href="../../../public/css/Blogger/paging.css">

        <title>Tỉnh thành Việt Nam</title>
        <style>
        </style>
    </head>
    <body>
    <script src = "../../../include/header2.js"></script>
    <script src = "../../../include/footer.js"></script>
    <!-- <script src="../../../public/js/Admin/Notifications.js"></script> -->

    <section class="provinces section-common">
            <h2>Tỉnh thành</h2>
            <p>Khám phá các vùng đất tại đất nước Việt Nam xinh đẹp</p>

            <div class="grid-common">
                <?php
                    include_once "../../Controllers/bothController.php";
                    $controller = new bothController();
                
                    // Get current page number from URL, default là 1
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                    $postsPerPage = 10;
                    $offset = ($page - 1) * $postsPerPage; //offset là lấy từ vị trí hàng nào trong db

                    $totalPosts = $controller->getTotalPostsCount(); // lấy total số post
                    $totalPages = ceil($totalPosts / $postsPerPage);

                    // Get posts for the current page
                    $posts = $controller->getPostsByPage($postsPerPage, $offset);

                    foreach ($posts as $post):
                        if (!empty($post['imgPostURL'])):
                ?>
                    <!--Khong can JS cho nay vi Anchor sang post voi ID-->
                    <a href="post.php?postID=<?php echo $post['postID']; ?> " class="card-common ">
                        <img src="<?php echo htmlspecialchars($post['imgPostURL']); ?>" alt="province">
                        <div class="location_time">
                            <h4 style="text-align: center; "><?php echo htmlspecialchars($post['provinceName']); ?></h4>
                            <p><?php echo date('M d, Y', strtotime($post['postCreateDate'])); ?></p>
                        </div>
                    </a>
                    <?php                 
                        endif; // End check for imgPostURL
                    endforeach; ?>
            </div>



            <!-- Pagination -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++):  ?>
                    <a href="?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>
        </section>
    </body>
    </html> 