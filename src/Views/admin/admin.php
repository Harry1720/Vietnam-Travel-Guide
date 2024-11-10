<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="../../../public/css/Admin/admin.css">
    <link rel="stylesheet" href="../../../public/css/navbar.css">
    <link rel="stylesheet" href="../../../public/css/sidebar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <?php   
        include_once "../../Controllers/adminController.php";
        include_once "../../Controllers/authController.php";
        
        // $auth = new AuthController();
        // $auth->checkAuth();

        $admin =  new AdminController();
        $user = $admin->getAdminById();

        $name = isset($user['userName']) ? $user['userName'] : 'Lỗi Hiển Thị';
        $email = isset($user['email']) ? $user['email'] : 'Lỗi Hiển Thị';
        $role = isset($user['role_']) ? $user['role_'] : 'Lỗi Hiển Thị';
        $address = isset($user['address']) ? $user['address'] : 'Lỗi Hiển Thị';

    ?>
</head>
<body>
    <script src="../../../public/js/Admin/admin.js"></script>
    <script src="../../../include/navbar.js"></script>
    <script src="../../../include/sidebar.js"></script>

<div class="container">
    <div class="sidebar1">
        <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-portrait-176256935.jpg" alt="Avatar">
        <div class="user-name" id="user-name"><?php echo $name?></div>
    </div>

    <div class="content">
        <div id="account-info" class="section">
            <h2>TÀI KHOẢN CỦA TÔI</h2>
            <form action = "../../FunctionOfActor/admin/updateAdmin.php" name = "update_admin" method="POST">
                <div class = "form_user">
                    <label for="name"><i class="fa fa-user"></i> Họ và Tên</label>
                    <input type="text" id="name" name="name" value="<?php echo $name?>" disabled>
                </div>
                <div>
                    <label for="email1"><i class="fa fa-envelope"></i> Email</label>
                    <input type="email" id="email1" name="email1" value="<?php echo $email?>" disabled>
                </div>
                <div>
                    <label for="address"><i class="fa fa-address-book"></i> Địa chỉ</label>
                    <input type="text" id="address" name="address" value="<?php echo $address ?>" disabled>
                </div>
                <div>
                    <label for="role"><i class="fa fa-building"></i> Chức vụ</label>
                    <input type="text" id="role" name="role" value="<?php echo $role?>" disabled>
                </div>
                <!-- <div>
                    <label> <ion-icon name="transgender-outline"></ion-icon> Giới tính</label>
                    <select name="gender" id="genderSelect" disabled>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div> -->
                <div class="button-group">
                    <button type="button" id="unlock_user">CHỈNH SỬA</button>
                    <button type="submit" id="Update_user" style="display: none">CẬP NHẬT</button>
                    <!-- <button type="button" onclick="openChangePasswordForm()">Đổi Mật Khẩu</button> -->
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form đổi mật khẩu -->
<!-- <div id="change-password-form" class="overlay">
    <div class="form-container">
        <span class="close-btn" onclick="closeChangePasswordForm()">&times;</span>
        <h2>Đổi Mật Khẩu</h2>
        <form>
            <div>
                <label for="current-password">Mật khẩu hiện tại</label>
                <input type="password" id="current-password" placeholder="Nhập mật khẩu hiện tại">
            </div>
            <div>
                <label for="new-password">Mật khẩu mới</label>
                <input type="password" id="new-password" placeholder="Nhập mật khẩu mới">
            </div>
            <div>
                <label for="confirm-password">Xác nhận mật khẩu mới</label>
                <input type="password" id="confirm-password" placeholder="Xác nhận mật khẩu mới">
            </div>
            <div class="button-group">
                <button type="button" class="btn-confirm" onclick="submitChangePassword()">Xác nhận</button>
                <button type="button" class="btn-cancel" onclick="closeChangePasswordForm()" style="color: #0c3b5a;">Hủy</button>
            </div>
        </form>
    </div>
</div> -->

</body>
</html>