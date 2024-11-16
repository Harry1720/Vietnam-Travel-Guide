<?php

    include_once "../../Controllers/adminController.php";
    include_once "../../Controllers/authController.php";
    
    $auth = new AuthController();
    $auth->checkAdmin();

    try {
        // Instantiate the controller
        $controller = new AdminController();
        
        if (isset($_GET['editDestinationID'])) {
            $destinationID = $_GET['editDestinationID'];
            
            // Call the method on the correct variable ($controller)
            $destination = $controller->getDestination($destinationID);
            
            if ($destination) {
                $destinationData = [
                    'destinationID' => $destination['destinationID'] ?? 0,
                    'destinationName' => $destination['destinationName'] ?? 'Lỗi Hiển Thị',
                    'destinationContent' => $destination['destinationContent'] ?? 'Lỗi Hiển Thị',
                    'imgDesURL' => $destination['imgDesURL'] ?? 'Lỗi Hiển Thị'
                ];
                echo json_encode($destinationData, JSON_UNESCAPED_UNICODE);  // Corrected the variable name here too
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Địa danh không tồn tại.'], JSON_UNESCAPED_UNICODE);
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
