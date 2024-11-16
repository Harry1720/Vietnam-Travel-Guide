<?php
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";

    $auth = new AuthController();
    $auth->checkAdmin();

    try {
        $controller = new AdminController();
        
        if (isset($_GET['editPostID'])) {
            $postID = $_GET['editPostID'];
            $editPost = $controller->getPostbyID($postID);
            
            if ($editPost) {
                $postData = [
                    'postID' => $editPost['postID'] ?? 0,
                    'imagepost' => $editPost['imgPostURL'] ?? 'Lỗi Hiển Thị',
                    'province' => $editPost['provinceID'] ?? 'Lỗi Hiển Thị'
                ];
                echo json_encode($postData, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Bài Post không tồn tại.'], JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing editId parameter.'], JSON_UNESCAPED_UNICODE);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Internal server error.'], JSON_UNESCAPED_UNICODE);
    }
?>