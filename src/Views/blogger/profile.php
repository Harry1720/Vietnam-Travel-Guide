<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/Blogger/profile.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/header2.css">
    <link rel="stylesheet" href="../../../public/css/Blogger/footer.css">

    <title>Thông tin tài khoản</title>
    <style>
    </style>
</head>
<body>
    <script src = "../../../include/header2.js"></script>
    <script src = "../../../public/js/blogger/blogger.js"></script>


<!-- Get ID for user  -->
    <?php   
        include_once "../../Controllers/bloggerController.php";
        $blogger =  new bloggerController();
        $user = $blogger->getBloggerById();

        $name = isset($user['userName']) ? $user['userName'] : 'Lỗi Hiển Thị';
        $email = isset($user['email']) ? $user['email'] : 'Lỗi Hiển Thị';
        $role = isset($user['role_']) ? $user['role_'] : 'Lỗi Hiển Thị';
        $address = isset($user['address']) ? $user['address'] : 'Lỗi Hiển Thị';
        $gender = isset($user['gender']) ? $user['gender'] : 'Lỗi Hiển Thị';
    ?>

<!-- Get address for USER - default -->
    <?php
        include_once "../../Controllers/bothController.php";
        
        $bothcontroller = new bothController();
        $provinces = $bothcontroller->getAllProvinces();


        // Kiểm tra xem người dùng đã đăng nhập chưa  -> nếu chưa thì vào login
        if (!isset($_SESSION['blogger_id'])) {
            // Nếu chưa đăng nhập, chuyển hướng tới login.php
                header("Location: ../login.html");
                exit();
        }

    ?>


    <div class="container">        
        <form action = "../../FunctionOfActor/blogger/updateBlogger.php" name = "update_blogger" method="POST">

            <div class="profile-header">
                <div class="profile-info">
                    <!-- <img src="https://via.placeholder.com/80" alt="Profile" class="profile-image"> -->
                    <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-portrait-176256935.jpg" alt="Avatar" class="profile-image">
                     
                    <div>
                        <div class="profile-name"><?php echo $name?></div>
                        <div class="profile-email"><?php echo $email?></div>
                    </div>
                </div>
                <button type="button" id="unlock_blogger" class="edit-button">CHỈNH SỬA</button>
            </div>



            <div class="form-grid">
                <div class="form-group">
                    <label for="fullName" class="form-label">Họ và Tên</label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="Email" value="<?php echo $name?>" disabled>
                </div>

                <div class="form-group">
                    <label for="nickName" class="form-label">Email</label>
                    <input type="text" id="email" name="email" class="form-input" placeholder="Email" value="<?php echo $email?>" disabled>
                </div>

                <div class="form-group">
                    <label for="address"> Địa chỉ</label>
                    <select id="address" name="address"  class="form-select"  disabled>
                        <?php
                            foreach ($provinces as $province) {
                                $selected = ($province['provinceID'] == $user['address_']) ? 'selected' : '';
                                echo '<option value="' . $province['provinceID'] . '" ' . $selected . '>' . $province['provinceName'] . '</option>';
                            }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">     
                    <label for="role" class="form-label">Vai trò</label>
                    <input type="text" id="role" name="role" class="form-input" value="<?php echo $role?>" disabled>
                </div>

                <div class="form-group">     
                    <label for="gender" class="form-label">Giới tính</label>
                    <select name="gender" id="gender"  class="form-select" disabled>
                        <option value="Male" <?php if($gender == 'Male') echo 'selected'; else echo "nooooo"?>>Male</option>
                        <option value="Female" <?php if($gender == 'FeMale') echo 'selected'?>>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="birthdate" class="form-label">Ngày tháng năm sinh</label>
                    <input type="date" name="txtDate"  class="form-select" id="txtDate" min="1930-01-01" >
                </div>
                
            </div>

            <div class="email-section">
                <h2>Emails của tôi</h2>
                <div class="email-item">
                    <div class="email-icon">@</div>
                    <div class="email-details">
                        <div class="email-address"><?php echo $email?></div>
                        <div class="email-date">Tháng trước</div>
                    </div>
                </div>
                <a href="#" class="add-email">+ Thêm Email</a>
            </div>

            <button type="submit" class="submit-btn" id="Update_user">Lưu thay đổi</button>
        </form>


    </div>
    <script src = "../../../include/footer.js"></script>
</body>
</html>