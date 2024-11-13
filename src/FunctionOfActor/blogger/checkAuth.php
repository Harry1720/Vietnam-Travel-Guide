<?php
    session_start();

    header('Content-Type: application/json');

    $response = [
        'loggedIn' => false,
        'username' => null
    ];

    // Kiểm tra trạng thái đăng nhập
    if (isset($_SESSION['blogger_id'])) {
        $response['loggedIn'] = true;
    }
    else {
        $response['loggedIn'] = false;
    }

    echo json_encode($response);
    exit;
?>
