<?php

require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $response = array();

    // Kiểm tra xem các trường dữ liệu cần thiết có tồn tại không
    if (!empty($_POST['id_user'])) {
        $id_user = mysqli_real_escape_string($connection, $_POST['id_user']);

        // Chứa các cột bạn muốn cập nhật
        $updateColumns = array();

        if (!empty($_POST['name'])) {
            $name = mysqli_real_escape_string($connection, $_POST['name']);
            $updateColumns[] = "name = '$name'";
        }

        if (!empty($_POST['email'])) {
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $updateColumns[] = "email = '$email'";
        }

        if (!empty($_POST['phone'])) {
            $phone = mysqli_real_escape_string($connection, $_POST['phone']);
            $updateColumns[] = "phone = '$phone'";
        }

        if (!empty($_POST['address'])) {
            $address = mysqli_real_escape_string($connection, $_POST['address']);
            $updateColumns[] = "address = '$address'";
        }

        // Kiểm tra xem có cột cần cập nhật hay không
        if (!empty($updateColumns)) {
            // Chuyển mảng thành chuỗi, ngăn cách bởi dấu phẩy
            $updateColumnsString = implode(", ", $updateColumns);

            // Cập nhật thông tin người dùng
            $updateUserQuery = "UPDATE user SET $updateColumnsString WHERE id_user = '$id_user'";
            $updateUserResult = mysqli_query($connection, $updateUserQuery);

            if ($updateUserResult) {
                // Lấy thông tin người dùng sau khi cập nhật
                $getUserInfoQuery = "SELECT id_user, name, email, phone, address, id_role FROM user WHERE id_user = '$id_user'";
                $userInfoResult = mysqli_query($connection, $getUserInfoQuery);

                if ($userInfoResult) {
                    $userInfo = mysqli_fetch_assoc($userInfoResult);

                    $response['value'] = 1;
                    $response['message'] = "Cập nhật thông tin người dùng thành công";
                    $response['user_info'] = $userInfo;
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                } else {
                    $response['value'] = 2;
                    $response['message'] = "Lỗi khi lấy thông tin người dùng: " . mysqli_error($connection);
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                }
            } else {
                $response['value'] = 3;
                $response['message'] = "Lỗi khi cập nhật thông tin người dùng: " . mysqli_error($connection);
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }
        } else {
            $response['value'] = 4;
            $response['message'] = "Không có cột nào cần cập nhật";
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response['value'] = 5;
        $response['message'] = "Thiếu thông tin id_user";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response['value'] = 6;
    $response['message'] = "Phương thức yêu cầu không hợp lệ";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>
