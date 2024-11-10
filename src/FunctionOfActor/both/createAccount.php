<?php
    include_once "../../Controllers/authController.php";

    $auth = new AuthController();
    $auth->signUp();
?>