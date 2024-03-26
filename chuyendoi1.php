<?php

require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $response = array();

    if (!empty($_POST['id_user'])) {
        $id_user = mysqli_real_escape_string($connection, $_POST['id_user']);

        // Nếu `id_role` không được cung cấp, giá trị mặc định là 2
        $id_role = isset($_POST['id_role']) ? mysqli_real_escape_string($connection, $_POST['id_role']) : 3;

        // Cập nhật `id_role` thành giá trị mới cho người dùng có `id_user` tương ứng
        $updateRoleQuery = "UPDATE user SET id_role = '$id_role' WHERE id_user = '$id_user'";
        $updateRoleResult = mysqli_query($connection, $updateRoleQuery);

        if ($updateRoleResult) {
            // Lấy thông tin từ `id_user` sau khi cập nhật `id_role`
            $getUserInfoQuery = "SELECT id_user, name, email, phone, address, id_role FROM user WHERE id_user = '$id_user'";
            $userInfoResult = mysqli_query($connection, $getUserInfoQuery);

            if ($userInfoResult) {
                $userInfo = mysqli_fetch_assoc($userInfoResult);

                $response['value'] = 1;
                $response['message'] = "Cập nhật id_role thành công và lấy thông tin user";
                $response['user_info'] = $userInfo;
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            } else {
                $response['value'] = 2;
                $response['message'] = "Lỗi khi lấy thông tin user: " . mysqli_error($connection);
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }
        } else {
            $response['value'] = 3;
            $response['message'] = "Lỗi khi cập nhật id_role: " . mysqli_error($connection);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response['value'] = 4;
        $response['message'] = "Thiếu thông tin id_user";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response['value'] = 5;
    $response['message'] = "Phương thức yêu cầu không hợp lệ";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>
