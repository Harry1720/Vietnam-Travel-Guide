<?php
include_once "../../Controller/bloggerController.php";
include_once "../../Controller/authController.php";

$auth = new AuthController();
$auth->checkBlogger();

$controller = new bloggerController();
$controller->deleteBlog($blogId);
?>