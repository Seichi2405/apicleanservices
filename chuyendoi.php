<?php

require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $response = array();

    if (isset($_POST['id_role'])) {
        $id_role = mysqli_real_escape_string($connection, $_POST['id_role']);

        // Xây dựng câu truy vấn SQL để lấy thông tin từ bảng user dựa trên id_role
        $query = "SELECT id_user, name, email, phone, address, id_role FROM user WHERE id_role = '$id_role'";

        // Thực hiện truy vấn
        $result = mysqli_query($connection, $query);

        if ($result) {
            $users = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }

            $response['value'] = 1;
            $response['message'] = "Lấy thông tin user thành công";
            $response['user_info'] = $users;
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } else {
            $response['value'] = 2;
            $response['message'] = "Lỗi khi truy vấn dữ liệu: " . mysqli_error($connection);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response['value'] = 3;
        $response['message'] = "Thiếu thông tin id_role";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response['value'] = 4;
    $response['message'] = "Phương thức yêu cầu không hợp lệ";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>
