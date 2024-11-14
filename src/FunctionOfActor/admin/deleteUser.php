<?php
include_once "../../Controllers/adminController.php";
include_once "../../Controllers/authController.php";

// $auth = new AuthController();
// $auth->checkAdmin();

$controller = new AdminController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['deleteID'];
    $controller->deleteUser($userID);
}
else{
    echo "fail";
}
?>