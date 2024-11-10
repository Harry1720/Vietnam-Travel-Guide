<?php
    // Include các controller cần thiết
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";
    
    $adController = new AdminController();
    
    // Kiểm tra nếu form "Thêm Người Dùng" được submit
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userName"])) {
        $adController->addUser();
    }
    else{
        echo "Không có sự kiện thêm người dùng nào";
    }
?>