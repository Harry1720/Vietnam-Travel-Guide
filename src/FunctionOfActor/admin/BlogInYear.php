<?php

    include_once "../../Controllers/adminController.php";

    try {
        // Instantiate the controller
        $controller = new AdminController();
        
        if (isset($_GET['year'])) {
            $year = $_GET['year'];
            
            // Call the method on the correct variable ($controller)
            $data = $controller->getTotalBlogInYear($year);
            
            if ($data) {
                echo json_encode($data, JSON_UNESCAPED_UNICODE);  // Corrected the variable name here too
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Không có blog trong năm.'], JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing year parameter.'], JSON_UNESCAPED_UNICODE);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Internal server error.'], JSON_UNESCAPED_UNICODE);
    }
?>
