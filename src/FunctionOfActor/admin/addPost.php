<?php
include_once "../../Controller/adminController.php";
include_once "../../Controller/authController.php";

$auth = new AuthController();
$auth->checkAdmin();

$controller = new AdminController();
$controller->addPost();
?>