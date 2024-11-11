<?php
include_once "../../Controllers/adminController.php";
include_once "../../Controllers/authController.php";

$controller = new AdminController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['destinationName']) && isset($_POST['province']) && isset($_POST['description']) && isset($_FILES['image'])) {
        $controller->addDestination();
    }
}
else{
    echo "Không có sự kiện submit nào";
}
?>