<?php
include_once "../../Controllers/adminController.php";
include_once "../../Controllers/authController.php";

$auth = new AuthController();
$adController = new AdminController();

// $auth->checkAdmin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tạo mảng để chứa tất cả dữ liệu từ form

    $formPost = array(
        'province' => $_POST['province'],
        'postCreateDate' => date('Y-m-d H:i:s'),
        'image_post' => $_FILES['image-post']['tmp_name']
    );


    $formPostDetail = array(
        '1' => array(
            'sectionTitle' => 'Mô tả',
            'sectionContent' => $_POST['describe'],
            'image' => $_FILES['image-describe']['tmp_name']
        ),
        '2' => array(
            'sectionTitle' => 'Ẩm Thực',
            'sectionContent' => $_POST['food'],
            'image' => $_FILES['image-food']['tmp_name']
        ),
        '3' => array(
            'sectionTitle' => 'Lễ Hội',
            'sectionContent' => $_POST['festival'],
            'image' => $_FILES['image-festival']['tmp_name']
        ),
        '4' => array(
            'sectionTitle' => 'Tham Quan',
            'sectionContent' => $_POST['factory_tour'],
            'image' => $_FILES['image-factory_tour']['tmp_name']
        )
    );

    if (!empty($_POST['new_title']) && !empty($_POST['new']) && !empty($_FILES['image-new']['tmp_name'])) {
        $formPostDetail['5'] = array(
            'sectionTitle' => $_POST['new_title'],
            'sectionContent' => $_POST['new'],
            'image' => $_FILES['image-new']['tmp_name']
        );
    }

    $adController->addPost($formPost,$formPostDetail);
}
else{
    echo "fail";
}
?>