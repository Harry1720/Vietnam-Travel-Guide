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
        $response['username'] = $_SESSION['username'] ?? 'Guest';
    }
    else {
        $response['loggedIn'] = false;
        $response['username'] = " ";
    }

    echo json_encode($response);
    exit;
?>
