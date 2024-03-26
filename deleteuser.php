<?php

require "config.php";

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $response = array();

    if (isset($_POST['id_user'])) {
        $id_user = mysqli_real_escape_string($connection, $_POST['id_user']);

        
        $query = "DELETE FROM user WHERE id_user = ?";
        $stmt = mysqli_prepare($connection, $query);

      
        if ($stmt) {
         
            mysqli_stmt_bind_param($stmt, "s", $id_user);

       
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $response['value'] = 1;
                $response['message'] = "Xóa thành công";
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            } else {
                $response['value'] = 2;
                $response['message'] = "Lỗi khi xóa dữ liệu: " . mysqli_error($connection);
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }

            mysqli_stmt_close($stmt);
        } else {
            $response['value'] = 2;
            $response['message'] = "Lỗi khi xóa dữ liệu: " . mysqli_error($connection);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    } else {
        $response['value'] = 3;
        $response['message'] = "Thiếu thông tin id_user";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
} else {
    $response['value'] = 4;
    $response['message'] = "Phương thức yêu cầu không hợp lệ";
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>
