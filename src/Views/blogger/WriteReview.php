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
                        
                        <p>Hãy chia sẽ những khoảng khắc tuyệt vời trong chuyến đi của bạn.</p>
                        
                        <div class="review-placeholder">
                            <label for="upload-photos">Đăng tải</label>
                            <input type="file" id="upload-photos" name="photos[]" accept="image/*" multiple>
                        </div>
                        <div id="photo-preview" class="photo-preview"></div>
                    </div>
                    <label for="title">Tiêu đề</label>
                    <input type="text" id="title" name="title" placeholder="Tiêu đề">
                    
                    <label for="review">Trải nghiệm của bạn</label>
                    <textarea id="review" name="review" placeholder="Đó là một hành trình đáng nhớ tại..."></textarea>

                    <label for="location">Địa điểm</label>
                    <select id="location" name="location" required>
                        <option value="">Chọn tỉnh/thành</option>
                        <?php
                            foreach ($provinces as $province) {
                                echo '<option value="' . $province['provinceID'] . '">' . $province['provinceName'] . '</option>';
                            }
                        ?>
                    </select>
                    
                    <label for="travel-date">Bạn đi trải nghiệm khi nào?</label>
                    <select id="travel-date" name="travel-date">
                        <option>Chọn một tháng</option>
                        <option>Tháng 1</option>
                        <option>Tháng 2</option>
                        <option>Tháng 3</option>
                        <option>Tháng 4</option>
                        <option>Tháng 5</option>
                        <option>Tháng 6</option>
                        <option>Tháng 7</option>
                        <option>Tháng 8</option>
                        <option>Tháng 9</option>
                        <option>Tháng 10</option>
                        <option>Tháng 11</option>
                        <option>Tháng 12</option>
                    </select>
                    
                    <button type="submit" class="submit-btn">Gửi đi</button>
                </form>
            </div>
        </div>
    </section>

    <script src="/public/js/WriteReview.js"></script>
</body>
</html>
