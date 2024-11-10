<?php
    include_once "../../Controllers/bothController.php";
    $controller = new bothController();
    $provinces = $controller->getAllProvinces();
    
    foreach ($provinces as $province) {
        echo $province['provinceID'];
    }
?>