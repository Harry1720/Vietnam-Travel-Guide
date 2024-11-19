<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viết Blog</title>
    <link rel="stylesheet" href="../../../public/css/Blogger/WriteReview.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/header2.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/footer.css">
</head>
<body>
    <script src = "../../../include/header2.js"></script>
    <script src = "../../../include/footer.js"></script>
    <script src = "../../../public/js/blogger/WriteReview.js"></script>

    <?php   
        include_once "../../Controllers/bothController.php";
        include_once "../../Controllers/authController.php";

        $controller = new bothController();
        $provinces = $controller->getAllProvinces();
        
        
        // Kiểm tra xem người dùng đã đăng nhập chưa  -> nếu chưa thì vào login
        if (!isset($_SESSION['blogger_id'])) {
        // Nếu chưa đăng nhập, chuyển hướng tới login.php
            header("Location: ../login.html");
            exit();
        }
    ?>


    <section class="main-section">            
            <div class="flex-container">
                <form action="../../FunctionOfActor/blogger/addBlog.php" method="POST" name = "" enctype="multipart/form-data">
                    <div class="top-places">
                        <h2>Đăng tải hình ảnh</h2>
                        
                        <p>Hãy chia sẽ những khoảnh khắc tuyệt vời trong chuyến đi của bạn.</p>
                        
                        <div class="review-placeholder">
                            <label for="upload-photos">Đăng tải</label>
                            <input type="file" id="upload-photos" name="photos[]" accept="image/*" multiple onchange="previewImages()" required>
                        </div>
                        
                        <div id="photo-preview" class="photo-preview">
                        </div>
                    </div>
                    <label for="title">Tiêu đề</label>
                    <input type="text" id="title" name="title" placeholder="Tiêu đề" required>
                    
                    <label for="review">Trải nghiệm của bạn</label>
                    <textarea id="review" name="review" placeholder="Đó là một hành trình đáng nhớ tại..." required></textarea>

                    <label for="location">Địa điểm</label>
                    <select id="location" name="location" required>
                        <option value="">Chọn tỉnh/thành</option>
                        <?php
                            foreach ($provinces as $province) {
                                echo '<option value="' . $province['provinceID'] . '">' . $province['provinceName'] . '</option>';
                            }
                        ?>
                    </select>
                    <!-- viết theo format để lưu 2023-11-23 -->
                    <!-- <label for="travel-date">Bạn đã đi từ khi nào?</label>
                    <input type="text" id="date" name="date" oninput="validateDateFormat(this)" placeholder="Ngày tháng - (YYYY-MM-DD)"> -->

                    
                    <button type="submit" class="submit-btn">Gửi đi</button>
                </form>
            </div>
        </div>
    </section>

    <script src="../../../public/js/blogger/WriteReview.js"></script>
</body>
</html>
