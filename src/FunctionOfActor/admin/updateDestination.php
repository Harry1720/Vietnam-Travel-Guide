<?php
    // Include các controller cần thiết
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";
    
    $adController = new AdminController();
    
    // Kiểm tra nếu form "Thêm Người Dùng" được submit
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["destinationID"])) {
        if (isset($_POST['destinationName1']) && isset($_POST['destinationID']) && isset($_POST['description1'])){
            $adController->updateDestination();
        }
        else{
            echo "Vui Lòng Nhập đủ thôn tin";
        }
    }
    else{
        echo "Không có sự kiện sửa điểm đến nào";
    }
?>