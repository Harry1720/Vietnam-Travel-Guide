<?php
    //hàm này để lấy các comment cho blog.
    include_once("../../Controllers/bloggerController.php");
    $controller = new bothController();

    $blogID = 1;
    $controller->getCommentsAndReplies($blogID);
?>