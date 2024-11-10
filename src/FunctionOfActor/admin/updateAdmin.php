<?php
include_once "../../Controllers/adminController.php";
include_once "../../Controllers/authController.php";

$auth = new AuthController();
$admin = new AdminController();

// $auth->checkAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin->updateAdmin();
}
?>
