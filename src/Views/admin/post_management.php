<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý post</title>
    <link rel="stylesheet" href="../../../public/css/Admin/post_management.css">
    <link rel="stylesheet" href="../../../public/css/navbar.css">
    <link rel="stylesheet" href="../../../public/css/sidebar.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <?php
        include_once "../../Controllers/adminController.php";

        $adcontroller = new AdminController();
        $post = $adcontroller->getAllPost();

        //Phan Trang
        $limit= 10;
        $stt = 1;
        $CountData = mysqli_num_rows($post);

        $countPage = ceil($CountData/$limit);

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $Start = ($page - 1) * $limit;
        $stt1 = $Start+1;

        $PostOfPage = $adcontroller->getPostOfPage($Start,$limit);
    ?>

    <?php
        include_once "../../Controllers/bothController.php";
        
            $bothcontroller = new bothController();
            $provinces = $bothcontroller->getAllProvinces();
    ?>
</head>
<body>
    <script src="../../../public/js/Admin/post_management.js"></script>
    <script src="../../../include/navbar.js"></script>
    <script src="../../../include/sidebar.js"></script>
    <script src="../../../public/js/Admin/Notifications.js"></script>

    <div class="main-content">
        <div class="post-management">
            <button class="add-post-btn" id="openpopup1">
                Thêm Bài Viết <ion-icon style="margin-left: 5px;" name="add-circle-outline"></ion-icon>
            </button>
    
            <div class="search-container">
                <input type="text" placeholder="Tìm kiếm bài viết" class="search-bar" oninput="toggleIcon()">
                <ion-icon name="search-outline" class="search-icon"></ion-icon>
            </div>
    
            <div class="table-wrapper" >
            <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tỉnh thành</th>
                    <th>Ngày tạo</th>
                    <th>Đường dẫn ảnh</th>
                    <th>Lựa Chọn</th>
                </tr>
            </thead>
            <tbody id="post-table-body">
                <?php
                if (mysqli_num_rows($PostOfPage) > 0) {
                    while ($post = mysqli_fetch_array($PostOfPage)) {
                        ?>
                        <tr onclick="toggleDestinations(<?php echo $stt ?>)">
                            <td><?php echo $stt1++; $stt++ ?></td>
                            <td><?php echo $post['provinceName'] ?? 'Lỗi Hiển Thị' ?></td>
                            <td><?php echo $post['postCreateDate'] ?? 'Lỗi Hiển Thị' ?></td>
                            <td><?php echo $post['imgPostURL'] ?? 'Lỗi Hiển Thị' ?></td>
                            <td class="action-btn-frame">
                            <button onclick="editpost(<?php echo $post['postID'] ?>)" class="action-btn edit">
                                    <ion-icon name="create"></ion-icon>
                                </button>
                                <button class="action-btn delete" id="delete-btn-<?php echo $post['postID']; ?>">
                                    <ion-icon name="trash"></ion-icon>
                                </button>
                            </td>
                        </tr>
                            <?php
                            $postDetails = $adcontroller->getAllPostDetailByPostID($post['postID']);
                            if (mysqli_num_rows($postDetails) > 0) {
                            ?>
                            <!-- Bảng con ẩn chứa các điểm đến -->
                            <tr class="destination-row" id="destinations-<?php echo $stt-1; ?>" style="display: none;">
                                <td colspan="5">
                                    <div class="destination-table-wrapper">
                                        <table class="destination-table">
                                            <thead>
                                                <tr>
                                                    <th>PostDetailID</th>
                                                    <th>Tiêu đề tiểu mục</th>
                                                    <th>Nội dung</th>
                                                    <th>Đường dẫn ảnh</th>
                                                    <th>Lựa Chọn</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($postDetail = mysqli_fetch_array($postDetails)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $postDetail['postDetailID'] ?? 'Lỗi Hiển Thị' ?></td>
                                                        <td><?php echo $postDetail['sectionTitle'] ?? 'Lỗi Hiển Thị' ?></td>
                                                        <td><?php echo $postDetail['sectionContent'] ?? 'Lỗi Hiển Thị' ?></td>
                                                        <td><?php echo $postDetail['imgPostDetURL'] ?? 'Lỗi Hiển Thị' ?></td>
                                                        <td class="action-btn-frame">
                                                            <button class="action-btn edit-post-detail" id="edit-post-detail-btn> " onclick="editpostdetail(<?php echo $postDetail['postDetailID']; ?>)">
                                                                <ion-icon name="create"></ion-icon>
                                                            </button>
                                                            <button class="action-btn delete">
                                                                <ion-icon name="trash"></ion-icon>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
                else{
                    echo "Không Lấy được dữ liệu";
                }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
                for ($i = 1; $i <= $countPage; $i++) {
                    $activeClass = ($i == $page) ? 'active' : '';
                    echo "<a class='page-btn $activeClass' href='?page=$i'>$i</a>";
                }
            ?>
        </div>

                
                <div id="popup" class="popup-overlay">
                    <div class="popup-content">
                        <p>Are you sure you want to delete this post?</p>
                        <button id="yes-btn" class="popup-btn">Yes</button>
                        <button id="no-btn" class="popup-btn">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="popup1-overlay" id="popup1Overlay">
        <div class="popup1-content">
            <ion-icon name="close-outline" class="popup1-close" id="closepopup1"></ion-icon>
    
            <div class="wrapper" >
                <form id="post-form" enctype="multipart/form-data" name = "add" action="../../FunctionOfActor/admin/addPost.php" method="POST">
    
                    <div class="field">
                        <label style="float: left; margin-top: 10px;" for="province">Tỉnh/Thành phố</label>
                        <select name="province" id="province">
                        <?php
                            foreach ($provinces as $province) {
                                echo '<option value="' . $province['provinceID'] . '">' . $province['provinceName'] . '</option>';
                            }
                        ?>  
                        </select>
                        <input style="width: 41%; margin:0;" type="file" id="image-post" name="image-post">
                    </div>
    
                    <div class="field-row">
                        <div class="field">
                            <label for="transport">Mô Tả</label>
                            <textarea wrap="soft" id="describe" name="describe" placeholder="Mô tả về tỉnh thành" required></textarea>
                            <input type="file" id="image-describe" name="image-describe">
                        </div>
                        <div class="field">
                            <label for="food">Ẩm thực</label>
                            <textarea wrap="soft" id="food" name="food" placeholder="Món ăn đặc sản" required></textarea>
                            <input type="file" id="image-food" name="image-food">
                        </div>
                        <div class="field">
                            <label for="festival">Lễ hội</label>
                            <textarea wrap="soft" id="festival" name="festival" placeholder="Lễ hội đặc trưng,..." required></textarea>
                            <input type="file" id="image-festival" name="image-festival">
                        </div>
                        <div class="field">
                            <label style="margin-bottom: 15px; margin-top: 5px" for="factory_tour">Tham Quan</label>
                            <textarea wrap="soft" id="factory_tour" name="factory_tour" placeholder="Điểm tham quan,..." required></textarea>
                            <input type="file" id="image-factory_tour" name="image-factory_tour">
                        </div>
                        <div class="field">
                            <input style="margin-bottom: 3px" type="text" placeholder="Tiêu đề mới" >
                            <textarea wrap="soft" id="new" name="new" placeholder="Mô tả về tiêu đề mới"></textarea>
                            <input type="file" id="image-new" name="image-new">
                        </div>
                    </div>
    
                    <div class="button">
                        <input type="submit" value="Lưu" class="save" id="saveButton">
                        <input type="button" value="Hủy" class="cancel" id="cancelButton">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="popup1-overlay" id="popup2Overlay">
        <div class="popup1-content">
            <ion-icon name="close-outline" class="popup1-close" id="closepopup2"></ion-icon>
    
            <div class="wrapper">
                <form id="post-form" enctype="multipart/form-data" name="editPost" method="POST" action="../../FunctionOfActor/admin/updatePost.php">
                    <div class="field">                           
                        <input type="hidden" id="postID" name="postID">
                        <input type="hidden" id="imageposted" name="imageposted">
                        <label style="float: left; margin-top: 10px;" for="province">Tỉnh/Thành phố</label>
                        <select name="province" id="province-edit">
                        <?php
                            foreach ($provinces as $province) {
                                echo '<option value="' . $province['provinceID'] . '">' . $province['provinceName'] . '</option>';
                            }
                        ?>
                        </select>
                        <img src="" alt="Lỗi hiển thị ảnh" id = "image-posted">
                        <input style="width: 40%; margin:0;" type="file" id="new-image-post" name="new-image-post">
                    </div>
                    <div class="button">
                        <input type="submit" value="Lưu" class="save" id="saveButton2">
                        <input type="button" value="Hủy" class="cancel" id="cancelButton2">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="popup1-overlay" id="popup3Overlay">
        <div class="popup1-content">
            <ion-icon name="close-outline" class="popup1-close" id="closepopup3"></ion-icon>
            <form style="margin-left: 40px;"id="post-form" enctype="multipart/form-data" name="editPostDetail" method="POST" action="../../FunctionOfActor/admin/updatePostDetail.php">
                <div class="wrapper">
                    <div class="field-row">
                        <div class="field">
                            <label for="title" id="displayTitle"></label>
                            <input type="hidden" id ="imgposted" name = "imgposted">
                            <input type="hidden" id="title" name="title">
                            <input type="hidden" id="postDetailID" name="postDetailID">
                            <textarea wrap="soft" id="content" name="content" required></textarea>
                            <img src="" alt="Lỗi Hiển Thị Ảnh" id = "data_img">
                            <input type="file" id="imagenew" name="imagenew">
                        </div>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Lưu" class="save" id="saveButton3">
                    <input type="button" value="Hủy" class="cancel" id="cancelButton3">
                </div>
    
            </form>
            </div>
        </div>
    </div>
</body>
</html>