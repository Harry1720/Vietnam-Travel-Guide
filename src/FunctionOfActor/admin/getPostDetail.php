<?php
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";

    $auth = new AuthController();
    $auth->checkAdmin();

    try {
        $controller = new AdminController();
        
        if (isset($_GET['editPostDetailID'])) {
            $postDetailID = $_GET['editPostDetailID'];
            $editPostDetail = $controller->getPostDetailByID($postDetailID);
            
            if ($editPostDetail) {
                $PostDetailData = [
                    'postDetailID' => $editPostDetail['postDetailID'] ?? 0,
                    'sectionTitle' => $editPostDetail['sectionTitle'] ?? 'Lỗi Hiển Thị',
                    'sectionContent' => $editPostDetail['sectionContent'] ?? 'Lỗi Hiển Thị',
                    'imgPostDetURL' => $editPostDetail['imgPostDetURL'] ?? 'Lỗi Hiển Thị'
                ];
                echo json_encode($PostDetailData, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Chi tiết bài post không tồn tại.'], JSON_UNESCAPED_UNICODE);
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