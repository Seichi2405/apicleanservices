<?php

require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $response = array();

    if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($connection, $_POST['email']);

        // Truy vấn để lấy id_user từ bảng user dựa trên email
        $getUserQuery = "SELECT id_user FROM user WHERE email = '$email'";
        $getUserResult = mysqli_query($connection, $getUserQuery);

        if ($getUserResult) {
            $userData = mysqli_fetch_assoc($getUserResult);

            if ($userData) {
                $response['value'] = 1;
                $response['message'] = "Lấy id_user thành công";
                $response['id_user'] = $userData['id_user'];
            } else {
                $response['value'] = 2;
                $response['message'] = "Không tìm thấy người dùng với email này";
            }
        } else {
            $response['value'] = 3;
            $response['message'] = "Lỗi khi truy vấn: " . mysqli_error($connection);
        }
    } else {
        $response['value'] = 4;
        $response['message'] = "Thiếu thông tin email";
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
} else {
    $response['value'] = 5;
    $response['message'] = "Phương thức yêu cầu không hợp lệ";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>

