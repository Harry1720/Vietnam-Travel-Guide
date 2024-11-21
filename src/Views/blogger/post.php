<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/post.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/headerPost.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/footer.css">
    <script src = "../../../include/footer.js"></script>
    <title>Posts</title>
    <style>
    </style>
</head>
<body>


    <?php
        include_once "../../../src/Controllers/bothController.php";
        $controller = new bothController();

        //$_GET['postID']: Lay tu story sang day postID (e.g., post.php?postID=1).
        //intval(): dam bao la int value tu ben kia lay sang : 1 (co nghia la, mac dinh se lay trang Hanoi )
        $postID = isset($_GET['postID']) ? intval($_GET['postID']) : 1;

        $header = $controller->getPostProvince($postID);  //get đầu mục cho header
        $data = $controller->getAllPostDetail($postID); //Lầy hình hiển thị nội dung cho trang 
    ?>

    <script>
        // data để hiện thị lên từng trang 
        const provinceName = <?php echo json_encode($header['provinceName']); ?>;
        const imgPostURL = <?php echo json_encode($header['imgPostURL']); ?>;
        
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                //check sesion
                const response = await fetch('../../FunctionOfActor/blogger/checkAuth.php');
                if (!response.ok) {
                    throw new Error('Failed to fetch session data. Status: ' + response.status);
                }
                const data = await response.json();
            
                const header = `
                    <header class="header">
                        <div class="logo">
                            <img src="../../../public/image/logo_colored.png" alt="Logo">
                        </div>
                        <nav class="nav">
                            <a style = "color: white; text-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);" href="home.php">Trang chủ</a>
                            <a style = "color: white;text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);" href="province.php">Tỉnh Thành</a>
                            <a style = "color: white;text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);" href="storiesList.php">Blogs</a>
                            <a style = "color: white;text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);" href="WriteReview.php">Viết Blog</a>
                            ${data.role_ === 'Admin' && data.loggedIn  ? '<a style = "color: white;text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);" href="../admin/admin.php">Admin</a>' : '<a style = "color: white;text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);" href="profile.php">Hồ sơ</a>'}
                        </nav>    
                        <nav class="sub_nav">
                            ${data.loggedIn ? 
                                `<a href="../../FunctionOfActor/both/logout.php?action=logout" class="btn-login">Đăng xuất</a>` : 
                                `<a style = "color: white;text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);" href="../createAccount.html" class="btn-signup">Đăng ký</a>
                                <a href="../login.html" class="btn-login">Đăng nhập</a>`}
                        </nav>
                    </header>
                    
                    <section class="hero">
                        <h1 style="font-size: 100px; color: #F5F5DC;text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);">${provinceName}</h1>
                        <section class="destinations">
                            <a href="#" class="article">
                                <img src="${imgPostURL}" alt="provinces">
                            </a>
                        </section>
                    </section>`;
                    document.body.insertAdjacentHTML('afterbegin', header);
                }
            catch (error) {
                console.error('Error fetching session data:', error);
            alert('Không thể tải trạng thái đăng nhập. Vui lòng thử lại sau.');
            }   
            document.body.insertAdjacentHTML('afterbegin', header);
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