<?php
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";

    $auth = new AuthController();
    $auth->checkAdmin();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['postID']) && isset($_POST['province'])) {
            $adController = new AdminController();
            $adController->updatePost();
        }
        else{
            echo "<script>alert('Vui Lòng Điền Đủ Thông Tin!');</script>";
            echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
        }
    }
    else{
        echo "<script>alert('Không Có Sự Kiện Submit Nào!');</script>";
        echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
    }
?>