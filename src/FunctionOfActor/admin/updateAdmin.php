<?php
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";

    $auth = new AuthController();
    $admin = new AdminController();

    $auth->checkAdmin();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $admin->updateAdmin();
    }
    else{
        echo "<script>alert('Không Có Sự Kiện Submit Nào!');</script>";
        echo "<script>window.location.href = '../../Views/admin/admin.php';</script>";
    }
?>
