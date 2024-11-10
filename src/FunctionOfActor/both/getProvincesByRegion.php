<?php
include_once "../../Controllers/authController.php";

$controller = new bothController();
$controller->getProvincesByRegion($provinceRegion);
?>