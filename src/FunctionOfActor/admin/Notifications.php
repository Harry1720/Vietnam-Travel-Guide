<?php
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";

    // $auth = new AuthController();
    // $auth->checkAdmin();

    try {
        $controller = new AdminController();
        
            $blogs = $controller->TotalBlogsStatus('Chờ Duyệt');

            if ($blogs) {
                $count = [
                    'Count' => $blogs['TotalBlogs'] ?? 0,
                ];
                echo json_encode($count, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Người dùng không tồn tại.'], JSON_UNESCAPED_UNICODE);
            }
        } 
    catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Internal server error.'], JSON_UNESCAPED_UNICODE);
    }
?>