<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tỉnh thành</title>
    <link rel="stylesheet" href="../../../public/css/destination.css">
    <script src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../../../public/js/destination.js" defer></script>
    <?php
        include_once "../../Controllers/bothController.php";
        $controller = new bothController();
        $imgDes =  $controller->getDestinationPage();
    ?>
</head>

<body>
    <!-- mục này header -->
    <script>  
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
                            <a href="home.php">Trang chủ</a>
                            <a href="province.php">Tỉnh Thành</a>
                            <a href="storiesList.php">Blogs</a>
                            <a href="WriteReview.php">Viết Blog</a>
                            ${data.role_ === 'Admin' && data.loggedIn  ? `<a href="../admin/admin.php">Admin</a>` : '`<a href="profile.php">Hồ sơ</a>` '}
                        </nav>    
                        <nav class="sub_nav">
                            ${data.loggedIn ? 
                                `<a href="../../FunctionOfActor/both/logout.php?action=logout" class="btn-login">Đăng xuất</a>` : 
                                `<a href="../createAccount.html" class="btn-signup">Đăng ký</a>
                                <a href="../login.html" class="btn-login">Đăng nhập</a>`}
                        </nav>
                    </header>`;
                    document.body.insertAdjacentHTML('afterbegin', header);
                }
            catch (error) {
                console.error('Error fetching session data:', error);
            alert('Không thể tải trạng thái đăng nhập. Vui lòng thử lại sau.');
            }   
            document.body.insertAdjacentHTML('afterbegin', header);
        }); 
    </script>    

    <div class="container">
        <!-- Nút điều hướng trái -->
        <button id="prev-btn" class="nav-btn">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </button>

        <!-- Vùng hiển thị slide -->
        <div class="slider-container">
            <div class="slider">
                <?php
                // Loop hình destinations
                foreach ($imgDes as $img) {
                    echo '<div class="slide">';
                    echo '<img src="' . $img['imgDesURL'] . '" alt="' . htmlspecialchars($img['destinationName']) . '">';
                    echo '<p>' . htmlspecialchars($img['destinationName']) . '</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <!-- Nút điều hướng phải -->
        <button id="next-btn" class="nav-btn">
            <ion-icon name="arrow-forward-outline"></ion-icon>
        </button>
    </div>

    <!-- lấy hình destination -->
    <script>
        const slidesData = <?php echo json_encode($imgDes); ?>;
    </script>

</body>
</html>