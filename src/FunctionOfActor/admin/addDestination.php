<?php
include_once "../../Controllers/adminController.php";
include_once "../../Controllers/authController.php";

    $controller = new AdminController();
    // $auth = new AuthController();
    // $auth->checkAdmin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if (isset($_POST['destinationName']) && isset($_POST['province']) && isset($_POST['description']) && isset($_FILES['image'])) {
            $controller->addDestination();
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