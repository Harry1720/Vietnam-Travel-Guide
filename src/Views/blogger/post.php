<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/post.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/headerPost.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/footer.css">

    <title>Posts</title>
    <style>
    </style>
</head>
<body>

<!--ĐANG HARD CODE POST ID = 1-->
<?php
    include_once "../../../src/Controllers/bothController.php";
    $controller = new bothController();

    //$_GET['postID']: Lay tu story sang day postID (e.g., post.php?postID=1).
    //intval(): dam bao la int value tu ben kia lay sang : 1 (co nghia la, mac dinh se lay trang Hanoi )
    $postID = isset($_GET['postID']) ? intval($_GET['postID']) : 1;

    $header = $controller->getPostProvince($postID);  //get đầu mục cho header
    $data = $controller->getAllPostDetail($postID); //Lầy hình hiển thị nội dung cho trang 
?>

    <script src = "../../../include/footer.js"></script>
    <!-- <script src = "../../include/header2.js"></script> -->
    <!--Get picture for each post, header-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data passed from PHP to JavaScript
            const provinceName = <?php echo json_encode($header['provinceName']); ?>;
            const imgPostURL = <?php echo json_encode($header['imgPostURL']); ?>;

            
            const header2 = `
            <header class="header">
                <div class="logo">
                    <img src="../../../public/image/logo.png" alt="Logo">
                </div>
                <nav class="nav">
                    <a href = "home.php" ">Trang chủ</a>
                    <a href="province.php" ">Tỉnh Thành</a>
                    <a href="storiesList.html" ">Blogs</a>
                    <a href="WriteReview.php" ">Viết Blog</a>
                </nav>
                <nav class="sub_nav">
                    <a href="createAccount.html"  class="btn-login"">Đăng ký</a>
                    <a href="login.html" class="btn-login"">Đăng nhập</a>
                </nav>
            </header>
            <section class="hero">
                <h1 style="font-size: 100px; color: #F5F5DC;text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);">${provinceName}</h1>
                <section class="destinations">
                    <a href="#" class="article">
                        <img src="${imgPostURL}" alt="provinces">
                    </a>
                </section>
            </section>
            `;
            document.body.insertAdjacentHTML('afterbegin', header2);
    });
    </script>

    <div class="content">
        <div class="neo">
            <ul>
                <?php foreach ($data as $section): ?>
                    <li><a href="#<?php echo str_replace(' ', '', $section['sectionTitle']); ?>"><?php echo htmlspecialchars($section['sectionTitle']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php if (isset($data) && !empty($data)): $order = 1;?>

         
            <?php foreach ($data as $section): ?>
            
                <a name="<?php echo str_replace(' ', '', $section['sectionTitle']); ?>"></a>
                <h1><?php echo htmlspecialchars($section['sectionTitle']); ?></h1>

                <?php if (!empty($section['imgPostDetURL'])): ?>
            
                    <figure class="anh_blog">
                        <img src="<?php echo htmlspecialchars($section['imgPostDetURL']); ?>" alt="Post Image">
                        <figcaption><?php echo htmlspecialchars("Hình " . $order); ?></figcaption>
                        <?php $order++; ?>
                    </figure>
                <?php endif; ?>

                <p><?php echo htmlspecialchars($section['sectionContent']); ?></p>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
   
</body>

</html>