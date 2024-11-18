<?php
    include_once "../../Controllers/authController.php";
    
    $auth = new AuthController();
    $auth->checkAdmin();
    
    // Kiểm tra nếu form "Thêm Người Dùng" được submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['current-password']) && isset($_POST['new-password']) && isset($_POST['confirm-password'])) {
            $auth->changPasswordAdmin();
        }
        else{
            echo "<script>alert('Vui Lòng Điền Đủ Thông Tin!');</script>";
            echo "<script>window.location.href = '../../Views/admin/admin.php';</script>";
        }
    }
    else{
        echo "<script>alert('Không Có Sự Kiện Submit Nào!');</script>";
        echo "<script>window.location.href = '../../Views/admin/admin.php';</script>";
    }
?>