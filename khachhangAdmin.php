<?php

require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();

    // Xây dựng câu truy vấn SQL
    $query = "SELECT id_user, name, email, phone, address FROM user WHERE id_role = 2";

    // Thực hiện truy vấn
    $result = mysqli_query($connection, $query);

    if ($result) {
        $response['value'] = 1;
        $response['message'] = "Thành công";
        $response['data'] = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $response['data'][] = $row;
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } else {
        $response['value'] = 2;
        $response['message'] = "Lỗi khi truy vấn dữ liệu";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response['value'] = 3;
    $response['message'] = "Phương thức yêu cầu không hợp lệ";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>
