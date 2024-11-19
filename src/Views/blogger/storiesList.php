<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/Blogger/storiesList.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/header2.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/footer.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/paging.css">

    <title>Blogs</title>
    <style>
    </style>
</head>
<body>
<script src = "../../../include/header2.js"></script>
<script src = "../../../include/footer.js"></script>
    
    <?php
        include_once "../../Controllers/bothController.php";
        $controller = new bothController();
    
        // Get dữ liệu cho ba ô tỉnh thành tại trang home
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $limitPost= 3;
        $firstPost = 0; //lấy post 1 
        // Get posts for the current page - status = 1, có nghĩa là post đó vẫn còn trong DB
        $posts = $controller->getPostsByPage($limitPost, $firstPost);
        
    ?>
    <section class="provinces section-common">
        <h2>Blogs</h2>
        <p>Khám phá những câu chuyện thực tế</p>
        <div class="grid-common">
            
        <?php
            include_once "../../Controllers/bothController.php";
            $controller = new bothController();
        
            // Get current page number from URL, default là 1
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            $blogsPerPage = 10;
            $offset = ($page - 1) * $blogsPerPage; //offset là lấy từ vị trí hàng nào trong db

            $totalBlogs = $controller->getTotalBlogsCount(); // lấy total số post
            $totalPages = ceil($totalBlogs / $blogsPerPage);

            // Get các trang blog để hiển thị 
            $blogs = $controller->getBlogByPage($blogsPerPage, $offset);

            foreach ($blogs as $blog):
                if (!empty($blog['imgBlogURL'])):
        ?>



        <!--Khong can JS cho nay vi blogid truyền sang bên trang viewblog-->
        <a href="ViewBlog.php?blogID=<?php echo $blog['blogID']; ?> " class="card-common ">
            <img src="<?php echo htmlspecialchars($blog['imgBlogURL']); ?>" alt="blog picture">
            <div class="location_time">
                <h4 style="text-align: center; "><?php echo htmlspecialchars($blog['blogTitle']); ?></h4>
                <p><?php echo date('d/m/Y', strtotime($blog['blogCreateDate'])); ?></p>
            </div>
        </a>
        <?php                 
            endif; // End check for imgPostURL
        endforeach; ?>

        
    </section>
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
</body>
</html>