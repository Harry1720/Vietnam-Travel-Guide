<?php
    include_once "../../Controllers/adminController.php";
    
    header('Content-Type: application/json; charset=utf-8');  // Thêm dòng này

    try {
        // Instantiate the controller
        $controller = new AdminController();
        
        if (isset($_GET['year'])) {
            $year = $_GET['year'];
            
            // Call the method on the correct variable ($controller)
            $dataBlog = $controller->getTotalBlogInYear($year);
            $dataProvince = $controller->getTotalBlogInPorvinceAndYear($year);
            
            if ($dataBlog && $dataProvince) {
                // Combine both sets of data
                $result = [
                    'blogByMonth' => $dataBlog,
                    'blogByProvince' => $dataProvince
                ];
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Không có blog trong năm.'], JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Thiếu tham số year.'], JSON_UNESCAPED_UNICODE);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Internal server error.'], JSON_UNESCAPED_UNICODE);
    }
?>
