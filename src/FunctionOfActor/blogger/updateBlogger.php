<?php
include_once "../../Controllers/bloggerController.php";
include_once "../../Controllers/authController.php";

$auth = new AuthController();
$blogger = new bloggerController();

// $auth->checkAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blogger->updateBlogger();
}
?>
