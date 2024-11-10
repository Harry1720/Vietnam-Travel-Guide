<?php
    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";

    // $auth = new AuthController();
    // $auth->checkAdmin();

    try {
        $controller = new AdminController();
        
        if (isset($_GET['editId'])) {
            $userID = $_GET['editId'];
            $editUser = $controller->getUserbyId($userID);
            
            if ($editUser) {
                $userData = [
                    'userName' => $editUser['userName'] ?? 'Lỗi Hiển Thị',
                    'email' => $editUser['email'] ?? 'Lỗi Hiển Thị',
                    'role' => $editUser['role_'] ?? 'Lỗi Hiển Thị',
                    'address' => $editUser['address'] ?? 'Lỗi Hiển Thị',
                    'password' => $editUser['pass_word'] ?? 'Lỗi Hiển Thị'
                ];
                echo json_encode($userData, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Người dùng không tồn tại.'], JSON_UNESCAPED_UNICODE);
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