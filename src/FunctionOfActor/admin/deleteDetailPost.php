<?php
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";

    // $auth = new AuthController();
    // $auth->checkAdmin();

    $controller = new AdminController();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $postDetailID = $_POST['deleteDetailID'];
        $controller->deletePostDetail($postDetailID);
    }
    else{
        echo "<script>alert('Không Có Sự Kiện Submit Nào!');</script>";
        echo "<script>window.location.href = '../../Views/admin/post_management.php';</script>";
    }
?>