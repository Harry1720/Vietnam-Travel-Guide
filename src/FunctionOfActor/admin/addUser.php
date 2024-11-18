<?php
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";
    
    $adController = new AdminController();
    $auth = new AuthController();
    $auth->checkAdmin();
    
    // Kiểm tra nếu form "Thêm Người Dùng" được submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['address']) 
        && isset($_POST['password']) && isset($_POST['role']) && isset($_POST['gender'])) {
            $adController->addUser();
        }
        else{
            echo "<script>alert('Vui Lòng Điền Đủ Thông Tin!');</script>";
            echo "<script>window.location.href = '../../Views/admin/user_management.php';</script>";
        }
    }
    else{
        echo "<script>alert('Không Có Sự Kiện Submit Nào!');</script>";
        echo "<script>window.location.href = '../../Views/admin/user_management.php';</script>";
    }
?>