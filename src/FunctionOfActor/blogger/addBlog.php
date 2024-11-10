<?php
include_once "../../Controllers/bloggerController.php";
include_once "../../Controllers/authController.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new bloggerController();
        $controller->addblog();
    }
?>