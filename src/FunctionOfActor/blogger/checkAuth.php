<?php
    //file này để kiểm tra session cho login 


    session_start();

    // gửi 1 file JSON - để header.js biết nên hiển thị header nào 
    header('Content-Type: application/json');

    //check bang id authController
    if (isset($_SESSION['blogger_id']) && isset($_SESSION['role'])) {
        // If logged in, send loggedIn as true, and also send role or user ID if needed
        echo json_encode(['loggedIn' => true, 'userID' => $_SESSION['blogger_id'], 'role_' => $_SESSION['role']]);
    } else {
        // If not logged in, send loggedIn as false
        echo json_encode(['loggedIn' => false]);

    }

?>
